<?php

namespace App\Http\Controllers\conveyance\EMDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;
use Illuminate\Support\Facades\Storage;
use File;
use App\conveyance\SocietyConveyanceDocumentStatus;
use Auth;


class EMController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
    }


    /**
     * Display a scrutiny remark forms.
     *
     * @return \Illuminate\Http\Response
     */
	public function ScrutinyRemark(Request $request,$applicationId){
        $data = scApplication::with(['societyApplication','scApplicationLog', 'sc_form_request'])->where('id',$applicationId)->first();
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
//            dd($no_dues_certificate_docs['text_no_dues_certificate']['sc_document_status']->document_path);
            $content = $this->CommonController->getftpFileContent($no_dues_certificate_docs['text_no_dues_certificate']['sc_document_status']->document_path);
        }else{
            $content = "";
        }

//        dd($no_dues_certificate_docs);
        return view('admin.conveyance.em_department.scrutiny_remark',compact('data', 'content', 'no_dues_certificate_docs', 'bonafide_docs', 'covering_letter_docs'));
    }

    /**
     * Uploads no dues certificate for conveyance.
     *
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
                scApplication::where('id',$request->applicationId)->update([config('commanConfig.no_dues_certificate.db_columns.upload') => $file_uploaded]);
                $message = config('commanConfig.no_dues_certificate.redirect_message.upload');
                $message_status = config('commanConfig.no_dues_certificate.redirect_message_status.upload');
            }
        }else{
            //pdf format no dues certificate

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
     *
     * @return \Illuminate\Http\Response
     */
    public function RenewalScrutinyRemark(Request $request,$applicationId){

//        $data = scApplication::with(['societyApplication','scApplicationLog'])->where('id',$applicationId)->first();
//        dd($data);
        return view('admin.conveyance.em_department.renewal_scrutiny_remark');
    }

    /**
     * Uploads No dues certificate for renewal section.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveRenewalNoDuesCertificate(Request $request){

        $applicationId = 1;
        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Renewal_no_dues_certificate';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = time().'renewal_no_dues_certificate_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('local')->has($folder_name))) {
            Storage::disk('local')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('local')->put($filePath, $pdf->output());
        die('end');

        //text offer letter

        $folder_name1 = 'text_renewal_no_dues_certificate';

        if (!(Storage::disk('ftp')->has($folder_name1))) {
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }
        $file_nm =  time()."text_renewal_no_dues_certificate_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

//        OlApplication::where('id',$request-> )->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);

//        return redirect('generate_offer_letter/'.$request->applicationId);
    }

    /**
     * Uploads list of bonafide & no-bonafide allottees
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadListOfAllottees(Request $request){
        dd($request->all());
    }

    /**
     * Uploads covering letter
     *
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
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s')
                );
                die('uploaded');
            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('renewal_scrutiny_remark_em/1');
    }




}
