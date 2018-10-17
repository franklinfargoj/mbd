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
            $columns = [
            ['data' => 'id','name' => 'id','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Room No'],
            ['data' => 'first_name', 'name' => 'first_name','title' => 'Tenant First Name'],
            ['data' => 'last_name', 'name' => 'last_name','title' => 'Tenant Last Name'],
            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status'],
            ['data' => 'final_amount', 'name' => 'final_amount','title' => 'Final Rent Amount'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
            ];

        if ($datatables->getRequest()->ajax()) {
            
            $tenant = MasterTenant::with('arrear')->where('building_id', '=', $request->input('building'))->get();
            return $datatables->of($tenant)
            ->editColumn('actions', function ($tenant){
                return "<a href='".url('tenant_arrear_charges/'.$tenant->id)."' class='btn m-btn--pill m-btn--custom btn-primary'>edit</a>";                
            })
            ->rawColumns(['actions'])
            ->make(true);
        } else {
            $tenant = MasterTenant::with('arrear')->where('building_id', '=', $request->input('building'))->get();
            //dd($tenant);
            $datatables->of($tenant)
            ->editColumn('actions', function ($tenant){
                return "<a href='".url('tenant_arrear_charges/'.$tenant->id)."' class='btn m-btn--pill m-btn--custom btn-primary'>edit</a>";                
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        //dd($html);
        return view('admin.em_clerk_department.tenant_list', compact('html'));
       
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