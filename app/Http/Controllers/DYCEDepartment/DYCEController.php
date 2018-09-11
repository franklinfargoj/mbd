<?php

namespace App\Http\Controllers\DYCEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Config;

class DYCEController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }	
    public function index(Request $request, Datatables $datatables){
        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'society_name','name' => 'society_name','title' => 'Society Name'],
            ['data' => 'building_name','no' => 'building_o','title' => 'building No'],
            ['data' => 'society_address','name' => 'society_address','title' => 'Address'],
            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.DYCE_department.index', compact('html','getData'));    	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [8, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 
    // function used to DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request){
        return view('admin.DYCE_department.scrutiny_remark');
    }   
}
