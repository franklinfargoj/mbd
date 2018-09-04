<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchitectApplication;
use App\ArchitectApplicationMark;
use Config;

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

  public function viewApplication()
  {

  }

  public function evaluateApplication($encryptedId)
  {
    $id = decrypt($encryptedId);
    $application = ArchitectApplicationMark::where('architect_application_id',$id)->get();
    $header_data = $this->header_data;
    return view('admin.architect.evaluate',compact('application','header_data'));
  }
}
