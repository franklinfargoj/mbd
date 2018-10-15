<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Yajra\DataTables\DataTables;

class DYCOController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->common = new conveyanceCommonController();
    }	
	public function index(Request $request, Datatables $datatables){

        $data = $this->common->

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {


            return $datatables->of($dyce_application_data)
                ->editColumn('rownum', function () {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function () {
                    // $url = route('dyce.view_application', $dyce_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="village_data_id"><span></span></label>';
                })                
                ->editColumn('eeApplicationSociety.name', function () {
                    // return $dyce_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function () {
                    // return $dyce_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function () {
                    // return "<span>".$dyce_application_data->eeApplicationSociety->address."</span>";
                })                
                ->editColumn('date', function () {
                    // return date(config('commanConfig.dateFormat'), strtotime($dyce_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($dyce_application_data) use($request){
                //    return view('admin.DYCE_department.action', compact('dyce_application_data','request'))->render();
                // })
                ->editColumn('Status', function () {
                    // $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                    // if($request->update_status)
                    // {
                    //     if($request->update_status == $status){
                    //         $config_array = array_flip(config('commanConfig.applicationStatus'));
                    //         $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    //         return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    //     }
                    // }else{
                    //     $config_array = array_flip(config('commanConfig.applicationStatus'));
                    //     $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    //     return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    // }

                })
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','eeApplicationSociety.address'])
                ->make(true);
        }                                    

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());    
        return view('admin.conveyance.dyco_department.index', compact('html','header_data','getData'));    		

	}

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    public function showChecklist(Request $request){
    	return view('admin.conveyance.dyco_department.checklist_office_note');
    }
}
