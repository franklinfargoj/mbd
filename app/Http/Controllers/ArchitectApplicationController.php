<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchitectApplication;
use App\ArchitectApplicationMark;
use Config;
use App\Http\Requests\architect\EvaluationMarkRequest;
use App\Http\Requests\architect\CertificateUploadRequest;

class ArchitectApplicationController extends Controller
{
  public $header_data = array(
    'menu' => 'Architect Application',
    'menu_url' => 'architect_application',
    'page' => '',
    'side_menu' => 'architect_application'
  );
  protected $list_num_of_records_per_page;

  public function __construct()
  {
    $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $applications = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))->get();
    $shortlisted = $applications->where('application_status', 3);
    $finalSelected = $applications->where('application_status', 4);
    $header_data = $this->header_data;
    return view('admin.architect.index',compact('applications','header_data','shortlisted','finalSelected'));
  }

  public function shortlistedIndex()
  {
    $shortlisted = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
                                        ->where('application_status', 3)
                                        ->get();
    $applications = $finalSelected = array();
    $header_data = $this->header_data;
    return view('admin.architect.shortlisted',compact('applications','header_data','shortlisted','finalSelected'));
  }


  public function finalIndex()
  {
    $finalSelected = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
                                        ->where('application_status', 4)
                                        ->get();
    $applications = $shortlisted = array();
    $header_data = $this->header_data;
    return view('admin.architect.final',compact('applications','header_data','shortlisted','finalSelected'));
  }

  public function viewApplication($id)
  {
    return decrypt($id);
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
    return view('admin.architect.generate_certificate',compact('header_data','encryptedId'));
  }

  public function getFinalCertificateGenerate($encryptedId)
  {
    return view('admin.architect.final_generate_certificate',compact('header_data','encryptedId'));
  }

  public function getTempCertificateGenerate($encryptedId)
  {
        $application = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
                                              ->where('id',decrypt($encryptedId))
                                              ->first();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText("Applicant Number: ".$application->application_number);
        $text = $section->addText("Applicant Name: ".$application->candidate_name);
        $text = $section->addText("Applicant Email: ".$application->candidate_email);
        $text = $section->addText("Applicant Mobile NO: ".$application->candidate_mobile_no);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('temp_certificate/'.$application->application_number.'.docx'));
        } catch (Exception $e) {
        }
        return response()->download(storage_path('temp_certificate/'.$application->application_number.'.docx'));
  }

  public function postFinalCertificateGenerate(CertificateUploadRequest $request)
  {

    if($request->hasFile('certificate'))
    {
      $applicationId = decrypt($request->get('ap_no'));
      $application = ArchitectApplication::where('id',$applicationId)->first();
      $extension = $request->file('certificate')->getClientOriginalExtension();
      $path = \Storage::putFileAs( '/architect_certificates', $request->file('certificate'), $applicationId.$application->application_number.'.'.$extension, 'public');
      $input['architect_application_id'] = $applicationId;
      $input['document_name'] = $applicationId.$application->application_number;
      $input['document_path'] = $path;
      $input['final_certificate'] = '1';

        ArchitectApplicationMark::create($input);
        return redirect()->back()->with('success',"Certificate Uploaded succesfully.");
    }
    else {
      return redirect()->back()->with('error',"Look like something went wrong.");
    }
  }

  public function getForwardApplication($encryptedId)
  {

  }




}
