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


class EMController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
    }

	public function ScrutinyRemark(Request $request,$applicationId){

		$data = scApplication::with(['societyApplication','scApplicationLog'])->where('id',$applicationId)->first();
        $data->folder = $this->conveyance_common->getCurrentRoleFolderName();
		return view('admin.conveyance.em_department.scrutiny_remark',compact('data'));
	}

    public function saveNoDuesCertificate(Request $request){

        $applicationId = 1;
        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'conveyance_no_dues_certificate';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = time().'renewal_no_dues_certificate_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        dd($filePath);
        $this->CommonController->ftpFileUpload($folder_name,$request->file('offer_letter_application_form'),$name);
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

    public function RenewalScrutinyRemark(Request $request,$applicationId){

//        $data = scApplication::with(['societyApplication','scApplicationLog'])->where('id',$applicationId)->first();
//        dd($data);
        return view('admin.conveyance.em_department.renewal_scrutiny_remark');
    }

    public function saveRenewalNoDuesCertificate(Request $request){
//        die('here');

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

    public function uploadCoveringLetter(Request $request){
//        die('here');
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
