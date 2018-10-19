<?php

namespace App\Http\Controllers\EMDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationDetails;
use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationDetails;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRelocationVerificationDetails;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlTitBitVerificationDetails;
use App\OlTitBitVerificationQuestionMaster;
use App\Role;
use App\SocietyOfferLetter;
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
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterSociety;
use App\MasterBuilding;
use App\MasterTenant;
use App\ArrearsChargesRate;
use App\ArrearTenantPayment;

class EMClerkController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();

        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);
        $societies = MasterSociety::whereIn('colony_id', $colonies)->pluck('id');

        $societies_data = MasterSociety::whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

        return view('admin.em_clerk_department.index', compact('layout_data', 'societies_data', 'building_data'));
    }
 
    public function society_list(Request $request){
        if($request->input('id')){            
            $wards = MasterWard::where('layout_id', '=', $request->input('id'))->pluck('id');
            $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
            $societies = MasterSociety::whereIn('colony_id', $colonies)->get();

            $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society" required>
                                        <option value="" style="font-weight: normal;">Select Society</option>';
                                        foreach($societies as $key => $value){
                                        $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                                        }
                                    $html .= '</select>';
            return $html;

        } else {
            return 'false';
        }
    }

    public function building_list(Request $request){
        if($request->input('id')){            
            $buildings = MasterBuilding::where('society_id', '=', $request->input('id'))->get();

            $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building" required>
                                        <option value="" style="font-weight: normal;">Select Building</option>';
                                        foreach($buildings as $key => $value){
                                        $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                                        }
                                    $html .= '</select>';
            return $html;
        } else {
            return 'false';
        }
    }

    public function tenant_payment_list(Request $request, Datatables $datatables){
        //dd($request->all());     
        $getData = $request->all();  

           $columns = [
            ['data' => 'id','name' => 'id','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Room No'],
            ['data' => 'first_name', 'name' => 'first_name','title' => 'Tenant First Name'],
            ['data' => 'last_name', 'name' => 'last_name','title' => 'Tenant Last Name'],
            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status'],
            ['data' => 'final_amount', 'name' => 'final_amount','title' => 'Final Rent Amount'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false]
            ];

        if ($datatables->getRequest()->ajax()) {            
            
            $tenant = MasterTenant::leftJoin('arrear_calculation', 'master_tenants.id', '=', 'arrear_calculation.tenant_id')->where('building_id', '=', $request->input('building'))->select('*','master_tenants.id as id')->get();

            //dd($tenant);

            return $datatables->of($tenant)
            ->editColumn('payment_status', function ($tenant){
                if($tenant->payment_status == null){
                     return 'Not Calculated';
                } elseif ($tenant->payment_status == 0) {
                     return 'Not Paid';
                } elseif ($tenant->payment_status == 1) {
                    return 'Paid';
                }                               
            })
            ->editColumn('final_amount', function ($tenant){
                if($tenant->final_amount == null){
                     return 'Not Calculated';
                } else {
                    return $tenant->final_amount;
                }                               
            })
            ->editColumn('actions', function ($tenant){
                return "<a href='".url('tenant_arrear_calculation/'.$tenant->id)."' class='btn m-btn--pill m-btn--custom btn-primary'>edit</a>";                
            })
            ->rawColumns(['actions'])
            ->make(true);
        } 

        //dd($datatables);

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        //dd($html);
        return view('admin.em_clerk_department.tenant_list', compact('html'));
       
    }

    public function tenant_arrear_calculation($id, Request $request){
        // return $id;
        $tenant = MasterTenant::leftJoin('arrear_calculation', 'master_tenants.id', '=', 'arrear_calculation.tenant_id')->where('master_tenants.id', '=', $id)->select('*','master_tenants.id as id')->get();
 
        $rate_card = ArrearsChargesRate::where('building_id', '=', $tenant[0]->building_id)
                                ->where('year', '=', date("Y"))
                                 ->get();
        
        return view('admin.em_clerk_department.arrear_calculation', compact('tenant', 'rate_card'));

    }


    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [1, "asc" ],
            'dom' => 'Bfrtip',
            'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print'],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Tenant_data_' . date('YmdHis');
    }

}

