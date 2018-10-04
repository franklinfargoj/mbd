<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchitectApplication;
use App\ArchitectApplicationMark;
use Config;
use App\Http\Requests\architect\EvaluationMarkRequest;
use App\Http\Requests\architect\CertificateUploadRequest;
use Mpdf\Mpdf;
use App\Http\Controllers\Common\CommonController;
use App\ArchitectCertificate;
use File;
use App\Role;
use App\User;
use Carbon\Carbon;
use App\ArchitectApplicationStatusLog;

class ArchitectApplicationController extends Controller
{
  public $header_data = array(
    'menu' => 'Architect Application',
    'menu_url' => 'architect_application',
    'page' => '',
    'side_menu' => 'architect_application'
  );
  protected $list_num_of_records_per_page;
  protected $CommonController;
  public function __construct(CommonController $CommonController)
  {
    $this->CommonController=$CommonController;
    $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $applications = ArchitectApplication::with(['ArchitectApplicationStatusForLoginListing'=>function($query){
      return $query->where(['user_id'=>auth()->user()->id,'role_id'=>session()->get('role_id')])->orderBy('id','desc');
    }])->select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))->get();
    
    $shortlisted = $applications->where('application_status', 3);
    $finalSelected = $applications->where('application_status', 4);
    $header_data = $this->header_data;
    return view('admin.architect.index',compact('applications','header_data','shortlisted','finalSelected'));
  }

  public function shortlistedIndex()
  {
    $shortlisted = ArchitectApplication::with('ArchitectApplicationStatusForLoginListing')->select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
                                        ->where('application_status', 3)
                                        ->get();
    $applications = $finalSelected = array();
    $header_data = $this->header_data;
    return view('admin.architect.shortlisted',compact('applications','header_data','shortlisted','finalSelected'));
  }


  public function finalIndex()
  {
    $finalSelected = ArchitectApplication::with('ArchitectApplicationStatusForLoginListing')->select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
                                        ->where('application_status', 4)
                                        ->get();
    $applications = $shortlisted = array();
    $header_data = $this->header_data;
    return view('admin.architect.final',compact('applications','header_data','shortlisted','finalSelected'));
  }

  public function viewApplication($encryptedId)
  {
   // return decrypt($id);
   $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
    return view('admin.architect.view_application',compact('ArchitectApplication'));
  }
  

  public function evaluateApplication($encryptedId)
  {
    $id = decrypt($encryptedId);
    $application = ArchitectApplicationMark::where('architect_application_id',$id)->get();
    $header_data = $this->header_data;
    return view('admin.architect.evaluate',compact('application','header_data'));
  }

  public function saveEvaluateMarks(EvaluationMarkRequest $request)
  {
    $marks = $request->get('marks');
    $ids = $request->get('id');
    $remark = $request->get('remark');

    foreach ($ids as $key=> $id) {
      ArchitectApplicationMark::where('id',$id)->update(['marks'=>$marks[$key],'remark'=>$remark[$key]]);
    }

    return redirect()->back()->with('success',"Marks updated succesfully!!!");
  }

  public function getGenerateCertificate($encryptedId)
  {
    $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
    if($ArchitectApplication->drafted_certificate!=null)
    {
      return redirect()->route('finalCertificateGenerate',['id'=>$encryptedId]);
    }
    return view('admin.architect.generate_certificate',compact('header_data','encryptedId'));
  }

  public function getFinalCertificateGenerate($encryptedId)
  {
    $uploadPath = '/uploads/temp_certificate';
    $destination = public_path($uploadPath);
    $certificate_generated=0;
    $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
    if($ArchitectApplication)
    {
      if($ArchitectApplication->drafted_certificate==null)
      {
        if ((!is_dir($destination))){
          File::makeDirectory($destination, $mode = 0777, true, true);
        }
        $content=view('admin.architect.certificate',compact('ArchitectApplication'));
        File::put($destination."/".$ArchitectApplication->id.$ArchitectApplication->application_number.".txt", $content);
        $ArchitectApplication->drafted_certificate='uploads/temp_certificate/'.$ArchitectApplication->application_number.".txt";
        $ArchitectApplication->save();
      }
      return view('admin.architect.final_generate_certificate',compact('header_data','encryptedId','ArchitectApplication'));
    }
    
  }

  public function edit_certificate($encryptedId)
  {
    $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
     return view('admin.architect.edit_certificate',compact('ArchitectApplication'));
  }

  public function update_certificate(Request $request)
  {
        $ArchitectApplication=ArchitectApplication::where('id',$request->applicationId)->first();
        $uploadPath = '/uploads/temp_certificate';
        $destination = public_path($uploadPath);
        $content = $request->ckeditorText;
        File::put($destination."/".$ArchitectApplication->id.$ArchitectApplication->application_number.".txt", $content);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = $ArchitectApplication->id.$ArchitectApplication->application_number.'.pdf';
        $draftedCertificate = $uploadPath."/".$fileName;
        if ((!is_dir($destination))){
            File::makeDirectory($destination, $mode = 0777, true, true);
        }
        $pdf->save(storage_path()."/temp_certificate"."/".$fileName);
        $folder_name='temp_certificate';
        if (!(\Storage::disk('ftp')->has($folder_name))) 
        {
           \Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true); 
        } 
        $filePath=$folder_name."/".$fileName;
        $file_local = \Storage::disk('local')->get($filePath);
        \Storage::disk('ftp')->put($filePath, $file_local);
        $ArchitectApplication->certificate_path=$filePath;
        $ArchitectApplication->save();
          ArchitectCertificate::create([
            'architect_application_id'=>$ArchitectApplication->id,
            'certificate_name'=>$folder_name."/".$fileName,
            'certificate_path'=>$folder_name
          ]);
        return redirect('finalCertificateGenerate/'.encrypt($request->applicationId));
  }

  // public function getTempCertificateGenerate($encryptedId)
  // {
  //   $application = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
  //   ->where('id',decrypt($encryptedId))
  //   ->first();

  //   $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
  //   $content=view('admin.architect.certificate',compact('ArchitectApplication'));
    
  //   $phpWord = new \PhpOffice\PhpWord\PhpWord();
  //   $section = $phpWord->addSection();
  //   $text = $section->addText("Applicant Number: ".$application->application_number);
  //   $text = $section->addText("Applicant Name: ".$application->candidate_name);
  //   $text = $section->addText("Applicant Email: ".$application->candidate_email);
  //   $text = $section->addText("Applicant Mobile NO: ".$application->candidate_mobile_no);

  //   $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
  //   try {
  //   $objWriter->save(storage_path('temp_certificate/'.$application->application_number.'.docx'));
  //   } catch (Exception $e) {
  //   }
  //   return response()->download(storage_path('temp_certificate/'.$application->application_number.'.docx'));
  // }

  public function postFinalCertificateGenerate(CertificateUploadRequest $request)
  {

    if($request->hasFile('certificate'))
    {
      $applicationId = decrypt($request->get('ap_no'));
      $application = ArchitectApplication::where('id',$applicationId)->first();
      $extension = $request->file('certificate')->getClientOriginalExtension();
      $path = \Storage::putFileAs( '/architect_certificates', $request->file('certificate'), $applicationId.$application->application_number.'.'.$extension, 'public');
      $input['architect_application_id'] = $applicationId;
      $input['certificate_name'] = $applicationId.$application->application_number;
      $input['certificate_path'] = $path;
      $application->certificate_path=$path;
      $application->final_signed_certificate_status=1;
      $application->save();
      ArchitectCertificate::create($input);
      return redirect()->back()->with('success',"Certificate Uploaded succesfully.");
    }
    else {
      return redirect()->back()->with('error',"Look like something went wrong.");
    }
  }

  public function getForwardApplication($encryptedId)
  {
    $arrData['architect_details'] = ArchitectApplication::where('id', decrypt($encryptedId))->first();

        $parentData = $this->CommonController->getForwardApplicationArchitectParentData();
      //dd($parentData);
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];
//        $arrData['application_status'] = $this->comman->getCurrentApplicationStatus($application_id);

        if(session()->get('role_name') != config('commanConfig.junior_architect')) {
           // $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
           // $result = json_decode($child_role_id[0]->child_id);
            $status_user = ArchitectApplication::where(['id' => decrypt($encryptedId)])->pluck('id')->toArray();

            // $final_child = User::with('roles')->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->get();

            // $arrData['application_status'] = $final_child;
        }

//        dd($arrData['application_status']);
        // DyCE Junior Forward Application
        $commitee_role_id = Role::where('name', '=', config('commanConfig.selection_commitee'))->first();

        $arrData['get_forward_commitee'] = User::where('role_id', $commitee_role_id->id)->get();

        $arrData['commitee_role_name'] = strtoupper(str_replace('_', ' ', $commitee_role_id->name));
    return view('admin.architect.forward_application',compact('arrData'));
  }

  public function forward_application(Request $request)
  {
    $forward_application = [
        [
        'architect_application_id' => $request->application_id,
        'user_id' => auth()->user()->id,
        'role_id' => session()->get('role_id'),
        'status_id' => config('commanConfig.architect_applicationStatus.forward'),
        'to_user_id' => $request->to_user_id,
        'to_role_id' => $request->to_role_id,
        'remark' => $request->remark,
        'changed_at' => Carbon::now()
        ],
        [
          'architect_application_id' => $request->application_id,
          'user_id' => $request->to_user_id,
          'role_id' => $request->to_role_id,
          'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
          'to_user_id' => NULL,
          'to_role_id' => NULL,
          'remark' => $request->remark,
          'changed_at' => Carbon::now()
          ],
    ];

    if(ArchitectApplicationStatusLog::insert($forward_application))
    {
      return redirect()->route('architect_application');
    }
  }


}
