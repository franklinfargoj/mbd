<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchitectApplication;
use Config;

class ArchitectApplicationController extends Controller
{
  public $header_data = array(
    'menu' => 'Architect Apllication',
    'menu_url' => 'faq',
    'page' => '',
    'side_menu' => 'faq'
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
    $applications = ArchitectApplication::all();
    $header_data = $this->header_data;
    return view('admin.architect.index',compact('applications','header_data'));
  }


}
