<?php

namespace App\Http\Controllers\EEDepartment;

use App\Http\Controllers\Common\CommonController;
use App\MasterBuilding;
use App\MasterSociety;
use App\ServiceChargesRate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;

class ServiceChargesController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function serviceChargesRate($society_id,$building_id,Request $request,Datatables $datatables) {
        $society = MasterSociety::find($society_id);
        $building = MasterBuilding::where('society_id', $society_id)->find($building_id);

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'year','name' => 'year','title' => 'Years'],
            ['data' => 'tenant_type', 'name' => 'tenant_type','title' => 'Tenant Type'],
            ['data' => 'water_charges', 'name' => 'water_charges','title' => 'Water Charges'],
            ['data' => 'electric_city_charge', 'name' => 'electric_city_charge','title' => 'Electric City Charge'],
            ['data' => 'pump_man_and_repair_charges', 'name' => 'pump_man_and_repair_charges','title' => 'Pump Man & Repair Charges'],
            ['data' => 'external_expender_charge', 'name' => 'external_expender_charge','title' => 'External  Expender Charge'],
            ['data' => 'administrative_charge', 'name' => 'administrative_charge','title' => 'Administrative  Charge'],
            ['data' => 'lease_rent', 'name' => 'lease_rent','title' => 'Lease Rent.'],
            ['data' => 'na_assessment', 'name' => 'na_assessment','title' => 'N.A.Assessment'],
            ['data' => 'other', 'name' => 'other','title' => 'Other'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $service_charges = ServiceChargesRate::selectRaw('@rownum  := @rownum  + 1 AS rownum,service_charges_rates.*')->where('society_id',$society->id)->where('building_id',$building->id);
            return $datatables->of($service_charges)
            ->editColumn('actions', function ($service_charges){
                return "<a href='".url('service_charges/'.$service_charges->id.'/edit')."' class='btn m-btn--pill m-btn--custom btn-primary'>Update</a>";
                
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.service_charges.index', compact('html','society','building'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }
}
