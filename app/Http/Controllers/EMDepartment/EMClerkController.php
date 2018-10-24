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
use App\ArrearCalculation;

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
            ['data' => 'total_amount', 'name' => 'total_amount','title' => 'Final Rent Amount'],
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
            ->editColumn('total_amount', function ($tenant){
                if($tenant->total_amount == null){
                     return 'Not Calculated';
                } else {
                    return $tenant->total_amount;
                }                               
            })
            ->editColumn('actions', function ($tenant){
                if($tenant->total_amount == null || $tenant->payment_status == null || $tenant->payment_status == 0 ){
                    return "<a href='".url('tenant_arrear_calculation/'.$tenant->id)."' class='btn m-btn--pill m-btn--custom btn-primary'>edit</a>"; 
                } else {
                    return '';
                } 
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
        $tenant = MasterTenant::leftJoin('arrear_calculation', 'master_tenants.id', '=', 'arrear_calculation.tenant_id')->where('master_tenants.id', '=', $id)
            ->select('*','master_tenants.id as id')->get();

        $rate_card = ArrearsChargesRate::where('building_id', '=', $tenant[0]->building_id)
                        ->where('year', '=', date("Y"))
                        ->get();

        $society = MasterSociety::where('id', '=', $rate_card[0]->society_id)->get();

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("n", strtotime( date( 'Y-m-01' )." -$i months"));
            $years[] = date("Y", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        $years = array_unique($years);        
        // return $months;
        $arrear = ArrearCalculation::leftjoin('arrears_charges_rates', function($join) use ($tenant){
                                        $join->on('arrears_charges_rates.year', '=', 'arrear_calculation.year')
                                            ->where('arrears_charges_rates.building_id', '=', $tenant[0]->building_id);
                                    })
                                    ->where('tenant_id', '=', $tenant[0]->id)
                                    ->whereIn('arrear_calculation.month', $months)
                                    ->whereIn('arrear_calculation.year', $years)
                                    ->get();
        // return $arrear;

        

        return view('admin.em_clerk_department.arrear_calculation', compact('tenant', 'rate_card', 'society'));
    }

    public function create_arrear_calculation(Request $request){

        $temp = array(
        'tenant_id' => 'required',
        'society_id' => 'required',
        'year' => 'required',
        'month' => 'required',
        'oir_year' => 'required',
        'oir_month' => 'required',
        'old_intrest_amount' => 'required',
        'difference_amount' => 'required',
        'ida_year' => 'required',
        'ida_month' => 'required',
        'difference_intrest_amount' => 'required',
        'payment_status' => 'required',
        'total_amount' => 'required'
        );
        // validate the job application form data.
        $this->validate($request, $temp);

        // return $request->all();

        $arrear_calculation = new ArrearCalculation;
        $arrear_calculation->tenant_id = $request->input('tenant_id');
        $arrear_calculation->society_id = $request->input('society_id');
        $arrear_calculation->year = $request->input('year');
        $arrear_calculation->month = $request->input('month');
        $arrear_calculation->oir_year = $request->input('oir_year');
        $arrear_calculation->oir_month = $request->input('oir_month');
        $arrear_calculation->old_intrest_amount = $request->input('old_intrest_amount');
        $arrear_calculation->difference_amount = $request->input('difference_amount');
        $arrear_calculation->ida_year = $request->input('ida_year');
        $arrear_calculation->ida_month = $request->input('ida_month');
        $arrear_calculation->difference_intrest_amount = $request->input('difference_intrest_amount');
        $arrear_calculation->payment_status = $request->input('payment_status');
        $arrear_calculation->total_amount = $request->input('total_amount');
        $arrear_calculation->save();       
        
        //return $request->all();

        return redirect()->back()->with('message', 'Submitted Successfully.');
       

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

