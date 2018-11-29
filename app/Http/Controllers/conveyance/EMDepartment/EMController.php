<?php

namespace App\Http\Controllers\conveyance\EMDepartment;

use App\conveyance\RenewalDocumentStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\conveyance\renewalCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplication;
use App\conveyance\RenewalApplication;
use App\conveyance\ScApplicationAgreements;
use Illuminate\Support\Facades\Storage;
use File;
use App\conveyance\SocietyConveyanceDocumentStatus;
use App\conveyance\scApplicationType;
use Auth;
use Mpdf\Mpdf;
use Maatwebsite\Excel\Facades\Excel;

class EMController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
        $this->renewal_common = new renewalCommonController();
    }


    /**
     * Display a scrutiny remark forms.
     * Author: Amar Prajapati
     * @param $request, $applicationId
     * @return \Illuminate\Http\Response
     */
	public function ScrutinyRemark(Request $request,$applicationId){
        $data = scApplication::with(['societyApplication','scApplicationLog', 'sc_form_request', 'scDocumentStatus' => function($q) use($applicationId){
            $q->where('application_id', $applicationId);
            $q->where('society_flag', 0)->get();
        }])->where('id',$applicationId)->first();
        $data->folder = $this->conveyance_common->getCurrentRoleFolderName();

        $no_dues_certificate_docs_defined = config('commanConfig.documents.em_conveyance.no_dues_certificate');
        $bonafide_docs_defined = config('commanConfig.documents.em_conveyance.bonafide');
        $covering_letter_docs_defined = config('commanConfig.documents.em_conveyance.covering_letter');
        $documents = $this->conveyance_common->getDocumentIds(array_merge($no_dues_certificate_docs_defined, $bonafide_docs_defined, $covering_letter_docs_defined), $data->sc_application_master_id);

        foreach($documents as $document){
            if(in_array($document->document_name, $no_dues_certificate_docs_defined) == 1){
                $no_dues_certificate_docs[$document->document_name] = $document;
                if($document->sc_document_status != null){
                    $no_dues_certificate_docs[$document->document_name]['sc_document_status'] = $document->sc_document_status;
                }else{
                    $no_dues_certificate_docs[$document->document_name]['sc_document_status'] = '';
                }
            }
            if(in_array($document->document_name, $bonafide_docs_defined) == 1){
                $bonafide_docs[$document->document_name] = $document;
                if($document->sc_document_status != null){
                    $bonafide_docs[$document->document_name]['sc_document_status'] = $document->sc_document_status;
                }else{
                    $bonafide_docs[$document->document_name]['sc_document_status'] = '';
                }
            }
            if(in_array($document->document_name, $covering_letter_docs_defined) == 1){
                $covering_letter_docs[$document->document_name] = $document;
                if($document->sc_document_status != null){
                    $covering_letter_docs[$document->document_name]['sc_document_status'] = $document->sc_document_status;
                }else{
                    $covering_letter_docs[$document->document_name]['sc_document_status'] = '';
                }
            }
        }

        if(!empty($no_dues_certificate_docs['text_no_dues_certificate']['sc_document_status'])){
            $content = $this->CommonController->getftpFileContent($no_dues_certificate_docs['text_no_dues_certificate']['sc_document_status']->document_path);
        }else{
            $content = "";
        }
//        dd($bonafide_docs['bonafide_list']->sc_document_status->document_path);
        return view('admin.conveyance.em_department.scrutiny_remark',compact('data', 'content', 'no_dues_certificate_docs', 'bonafide_docs', 'covering_letter_docs'));
    }

    /**
     * Uploads no dues certificate for conveyance.
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function saveNoDuesCertificate(Request $request){
        $folder_name = 'conveyance_no_dues_certificate';
        $id = $request->applicationId;
        if($request->hasFile('no_dues_certificate')){

            $fileName = time().'no_dues_certificate_'.$id.'.pdf';
            $filePath = $folder_name."/".$fileName;
            $file_uploaded = $this->CommonController->ftpFileUpload($folder_name, $request->file('no_dues_certificate'), $filePath);
            if($file_uploaded){
                $this->conveyance_common->uploadDocumentStatus($request->applicationId, config('commanConfig.no_dues_certificate.db_columns.upload'), $filePath);
//                scApplication::where('id',$request->applicationId)->update([config('commanConfig.no_dues_certificate.db_columns.upload') => $file_uploaded]);

                $message = config('commanConfig.no_dues_certificate.redirect_message.upload');
                $message_status = config('commanConfig.no_dues_certificate.redirect_message_status.upload');
            }
        }else{
            //pdf format no dues certificate
//            dd($request->all());
            $content = str_replace('_', "", $_POST['ckeditorText']);

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $fileName = time().'no_dues_certificate_'.$id.'.pdf';
            $filePath = $folder_name."/".$fileName;

            $file_uploaded_pdf = $this->CommonController->ftpGeneratedFileUpload($folder_name, $pdf->output(), $filePath);
            $pdf_input = array(
                "application_id" => $id,
                "user_id" => Auth::user()->id,
                "society_flag" => 0,
                "status_id" => null,
                "document_id" => $request->pdf_document_id,
                "document_path" => $filePath
            );
            $inputs[] = $pdf_input;

            //text format no dues certificate

            $file_name_text =  time()."text_no_dues_certificate_".$id.'.txt';
            $filePath_text = $folder_name."/".$file_name_text;

            $file_uploaded_text = $this->CommonController->ftpGeneratedFileUpload($folder_name, $content, $filePath_text);
            $doc_status_columns = new SocietyConveyanceDocumentStatus();
            $document_status_columns  = count($doc_status_columns->getFillable());

            $text_input = array(
                "application_id" => $id,
                "user_id" => Auth::user()->id,
                "society_flag" => 0,
                "status_id" => null,
                "document_id" => $request->text_document_id,
                "document_path" => $filePath_text
            );
            $inputs[] = $text_input;
            if($file_uploaded_pdf && $file_uploaded_text && count($pdf_input) == $document_status_columns && count($text_input) == $document_status_columns){
                SocietyConveyanceDocumentStatus::insert($inputs);
                $message = config('commanConfig.no_dues_certificate.redirect_message.draft_text');
                $message_status = config('commanConfig.no_dues_certificate.redirect_message_status.draft_text');
            }

        }
        return redirect()->route('em.scrutiny_remark',$id);
    }

    /**
     * Display renewal scrutiny forms.
     * Author: Amar Prajapati
     * @param $request, $applicationId
     * @return \Illuminate\Http\Response
     */
    public function RenewalScrutinyRemark(Request $request,$applicationId){

        $data = RenewalApplication::with(['societyApplication','srApplicationLog', 'sr_form_request'])->where('id',$applicationId)->first();
        $data->folder = $this->conveyance_common->getCurrentRoleFolderName();

        $no_dues_certificate_docs_defined = config('commanConfig.documents.em_renewal.no_dues_certificate');
        $bonafide_docs_defined = config('commanConfig.documents.em_renewal.bonafide');
        $covering_letter_docs_defined = config('commanConfig.documents.em_renewal.covering_letter');
        $documents = $this->renewal_common->getDocumentIds(array_merge($no_dues_certificate_docs_defined, $bonafide_docs_defined, $covering_letter_docs_defined), $data->application_master_id);

        foreach($documents as $document){
            if(in_array($document->document_name, $no_dues_certificate_docs_defined) == 1){
                $no_dues_certificate_docs[$document->document_name] = $document;
                if($document->sr_document_status != null){
                    $no_dues_certificate_docs[$document->document_name]['sr_document_status'] = $document->sr_document_status;
                }else{
                    $no_dues_certificate_docs[$document->document_name]['sr_document_status'] = '';
                }
            }
            if(in_array($document->document_name, $bonafide_docs_defined) == 1){
                $bonafide_docs[$document->document_name] = $document;
                if($document->sc_document_status != null){
                    $bonafide_docs[$document->document_name]['sr_document_status'] = $document->sr_document_status;
                }else{
                    $bonafide_docs[$document->document_name]['sr_document_status'] = '';
                }
            }
            if(in_array($document->document_name, $covering_letter_docs_defined) == 1){
                $covering_letter_docs[$document->document_name] = $document;
                if($document->sr_document_status != null){
                    $covering_letter_docs[$document->document_name]['sr_document_status'] = $document->sr_document_status;
                }else{
                    $covering_letter_docs[$document->document_name]['sr_document_status'] = '';
                }
            }
        }
        if(!empty($no_dues_certificate_docs['text_no_dues_certificate']['sr_document_status'])){
            $content = $this->CommonController->getftpFileContent($no_dues_certificate_docs['text_no_dues_certificate']['sr_document_status']->document_path);
        }else{
            $content = "";
        }

        return view('admin.renewal.em_department.scrutiny_remark',compact('data', 'content', 'no_dues_certificate_docs', 'bonafide_docs', 'covering_letter_docs'));
    }

    /**
     * Uploads No dues certificate for renewal section.
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function saveRenewalNoDuesCertificate(Request $request){
        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
//        dd(config('commanConfig.documents.em_renewal.no_dues_certificate'));

        $folder_name = 'renewal_no_dues_certificate';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = time().'renewal_no_dues_certificate_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('local')->has($folder_name))) {
            Storage::disk('local')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('local')->put($filePath, $pdf->output());

        //text offer letter

        $folder_name1 = 'text_renewal_no_dues_certificate';

        if (!(Storage::disk('local')->has($folder_name1))) {
            Storage::disk('local')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }
        $file_nm =  time()."text_renewal_no_dues_certificate_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('local')->put($filePath1, $content);
        foreach(config('commanConfig.documents.em_renewal.no_dues_certificate') as $document){
            $documents_required[$document] = $document;
        }
        unset($documents_required['renewal_uploaded_no_dues_certificate']);

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $document_ids = $this->renewal_common->getDocumentIds($documents_required, $application_type);

        foreach($document_ids as $document_id){
            $input_arr[] = array(
                'application_id' => $id,
                'user_id' => Auth::user()->id,
                'society_flag' => 0,
                'document_id' => $document_id->id,
            );
        }

        RenewalDocumentStatus::insert($input_arr);

        return redirect()->route('em.renewal_scrutiny_remark', $request->applicationId);
    }

    /**
     * Uploads list of bonafide & no-bonafide allottees
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function uploadListOfAllottees(Request $request){

        if($request->file('document_path')) {
            $file = $request->file('document_path');
            $file_name = time() . $file->getFileName() . '.' . $file->getClientOriginalExtension();
            $extension = $request->file('document_path')->getClientOriginalExtension();
            $request->flash();
            if ($extension == "xls") {
                $time = time();
                $name = File::name(str_replace(' ', '_',$request->file('document_path')->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('document_path'), $name);
                $count = 0;
                $sc_excel_headers = [];
                $broken_word_count = 0;

//                dd($request->file('document_path'));
                Excel::load($request->file('document_path')->getRealPath(), function ($reader)use(&$count, &$sc_excel_headers, &$broken_word_count) {
                    if(count($reader->toArray()) > 0){
                        $excel_headers = $reader->first()->keys()->toArray();
                        $sc_excel_headers = config('commanConfig.sc_excel_headers_em');
//                        dd(($sc_excel_headers));
                        foreach($excel_headers as $excel_headers_key => $excel_headers_val){
                            $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                            $excel_headers_value = str_replace(str_split('\\() '), '', $excel_headers_value);

                            if($excel_headers_value == $excel_headers_val){
                                $count++;
                            }else{
                                $exploded = explode('_', $excel_headers_value);

                                foreach($exploded as $exploded_key => $exploded_value){
                                    if(!empty(strpos($excel_headers_val, $exploded_value))){
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                });
                if($count != 0){
                    if($count == count($sc_excel_headers)){
                        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
                        $document = $this->conveyance_common->getDocumentId(config('commanConfig.documents.em_conveyance.bonafide')[0], $application_type);

                        $sc_document_status = new SocietyConveyanceDocumentStatus;
                        $sc_document_status_arr = array_flip($sc_document_status->getFillable());

                        $sc_document_status_arr['application_id'] = $request->application_id;
                        $sc_document_status_arr['user_id'] = Auth::user()->id;
                        $sc_document_status_arr['society_flag'] = 0;
                        $sc_document_status_arr['status_id'] = null;
                        $sc_document_status_arr['document_id'] = $document;
                        $sc_document_status_arr['document_path'] = $path;

                        $inserted_document_log = SocietyConveyanceDocumentStatus::create($sc_document_status_arr);

                        if($inserted_document_log == true){
                            return redirect()->route('em.scrutiny_remark', $request->application_id);
                        }
                    }else{
                        return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
        }
    }

    /**
     * Uploads list of bonafide & no-bonafide allottees
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function uploadRenewalListOfAllottees(Request $request){
//        dd($request->all());
        if($request->file('document_path')) {
            $file = $request->file('document_path');
            $file_name = time() . $file->getFileName() . '.' . $file->getClientOriginalExtension();
            $extension = $request->file('document_path')->getClientOriginalExtension();
            $request->flash();
            if ($extension == "xls") {
                $time = time();
                $name = File::name(str_replace(' ', '_',$request->file('document_path')->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('document_path'), $name);
                $count = 0;
                $sc_excel_headers = [];
                Excel::load($request->file('document_path')->getRealPath(), function ($reader)use(&$count, &$sc_excel_headers) {
                    if(count($reader->toArray()) > 0){
                        $excel_headers = $reader->first()->keys()->toArray();
                        $sc_excel_headers = config('commanConfig.sc_excel_headers_em');

                        foreach($excel_headers as $excel_headers_key => $excel_headers_val){
                            $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                            if($excel_headers_value == $excel_headers_val){
                                $count++;
                            }else{
                                $exploded = explode('_', $excel_headers_value);
                                foreach($exploded as $exploded_key => $exploded_value){
                                    if(!empty(strpos($excel_headers_val, $exploded_value))){
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                });

                if($count != 0){
                    if($count == count($sc_excel_headers)){
                        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
                        $document = $this->conveyance_common->getDocumentId(config('commanConfig.documents.em_renewal.bonafide')[0], $application_type);

                        $sc_document_status = new RenewalDocumentStatus;
                        $sc_document_status_arr = array_flip($sc_document_status->getFillable());

                        $sc_document_status_arr['application_id'] = $request->application_id;
                        $sc_document_status_arr['user_id'] = Auth::user()->id;
                        $sc_document_status_arr['society_flag'] = 0;
                        $sc_document_status_arr['status_id'] = null;
                        $sc_document_status_arr['document_id'] = $document;
                        $sc_document_status_arr['document_path'] = $path;

                        $inserted_document_log = RenewalDocumentStatus::create($sc_document_status_arr);

                        if($inserted_document_log == true){
                            return redirect()->route('em.renewal_scrutiny_remark', $request->application_id);
                        }
                    }else{
                        return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
        }
    }

    /**
     * Uploads covering letter
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCoveringLetter(Request $request){

        if($request->file('covering_letter'))
        {
            $file = $request->file('covering_letter');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('covering_letter')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('covering_letter')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "covering_letter_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('covering_letter'),$name);

                $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
                $document = $this->conveyance_common->getDocumentId(config('commanConfig.documents.em_conveyance.covering_letter')[0], $application_type);

                $sc_document_status = new RenewalDocumentStatus;
                $sc_document_status_arr = array_flip($sc_document_status->getFillable());

                $sc_document_status_arr['application_id'] = $request->applicationId;
                $sc_document_status_arr['user_id'] = Auth::user()->id;
                $sc_document_status_arr['society_flag'] = 0;
                $sc_document_status_arr['status_id'] = null;
                $sc_document_status_arr['document_id'] = $document;
                $sc_document_status_arr['document_path'] = $path;

                $inserted_document_log = SocietyConveyanceDocumentStatus::create($sc_document_status_arr);

                if($inserted_document_log == true){
                    return redirect()->route('em.scrutiny_remark', $request->applicationId);
                }

            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
    }

    /**
     * Uploads covering letter
     * Author: Amar Prajapati
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function uploadRenewalCoveringLetter(Request $request){
        if($request->file('covering_letter'))
        {
//            dd($request->all());
            $file = $request->file('covering_letter');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('covering_letter')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('covering_letter')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "covering_letter_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('covering_letter'),$name);

                $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
                $document = $this->conveyance_common->getDocumentId(config('commanConfig.documents.em_renewal.covering_letter')[0], $application_type);

                $sc_document_status = new RenewalDocumentStatus;
                $sc_document_status_arr = array_flip($sc_document_status->getFillable());

                $sc_document_status_arr['application_id'] = $request->application_id;
                $sc_document_status_arr['user_id'] = Auth::user()->id;
                $sc_document_status_arr['society_flag'] = 0;
                $sc_document_status_arr['status_id'] = null;
                $sc_document_status_arr['document_id'] = $document;
                $sc_document_status_arr['document_path'] = $path;

                $inserted_document_log = RenewalDocumentStatus::create($sc_document_status_arr);

                if($inserted_document_log == true){
                    return redirect()->route('em.renewal_scrutiny_remark', $request->application_id);
                }

            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
    }

}
