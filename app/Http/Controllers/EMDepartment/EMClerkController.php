<?php

namespace App\Http\Controllers\EMDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\Role;
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
use Storage, Validator;
use Session;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\SocietyDetail;
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
        $this->tenant_level_billing = Config::get('commanConfig.TENANT_LEVEL_BILLING');
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
        
        $societies = SocietyDetail::whereIn('layout_id', $layouts)->pluck('id');

        $societies_data = SocietyDetail::whereIn('layout_id', $layouts)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();
        $html = '';
        $society = '';
        $building = '';
        $layoutData = '';
        return view('admin.em_clerk_department.index', compact('html','layout_data', 'societies_data', 'building_data','society','building','layoutData'));
    }
 
    public function society_list(Request $request){
        if($request->input('id')){            
            $wards = MasterWard::where('layout_id', '=', decrypt($request->id))->pluck('id');
            $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

            $societies = SocietyDetail::whereIn('layout_id',decrypt($request->id))->get();

            $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society" required>
                                        <option value="" style="font-weight: normal;">Select Society</option>';
                                        if(count($societies)) {
                                        foreach($societies as $key => $value){
                                        $html .= '<option value="'.encrypt($value->id).'">'.$value->society_name.'</option>';
                                        }
                                        }
                                    $html .= '</select>';
            return $html;

        } else {
            return 'false';
        }
    }

    public function building_list(Request $request){
        if($request->input('id')){            
            $buildings = MasterBuilding::where('society_id', '=', decrypt($request->id))->get();

            $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building" required>
                                        <option value="" style="font-weight: normal;">Select Building</option>';
                                        if(count($buildings)) {
                                        foreach($buildings as $key => $value){
                                        $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
                                        }
                                    }
                                    $html .= '</select>';
            return $html;
        } else {
            return 'false';
        }
    }

    public function tenant_payment_list(Request $request, Datatables $datatables){
        //dd($request->all());
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();

        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);
        
        $societies = SocietyDetail::whereIn('layout_id', $layouts)->pluck('id');

        $societies_data = SocietyDetail::whereIn('layout_id', $layouts)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

        $rules = [
            'layout' => 'required',
            'society' => 'required',            
            'building' => 'required',            
        ];
        $messages = [
            'layout.required' => 'Select Layout.',
            'society.required' => 'Select Society.',
            'building.required' => 'Select Building.'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $getData = $request->all();  
        $layoutData = MasterLayout::find(decrypt($request->layout));
        $society = SocietyDetail::find(decrypt($request->society));
        $building = MasterBuilding::find(decrypt($request->building));
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Room No'],
            ['data' => 'first_name', 'name' => 'first_name','title' => 'Tenant First Name'],
            ['data' => 'last_name', 'name' => 'last_name','title' => 'Tenant Last Name'],
            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status','searchable' => false],
            ['data' => 'total_amount', 'name' => 'total_amount','title' => 'Final Rent Amount','searchable' => false],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false]
        ];

        if ($datatables->getRequest()->ajax()) {            
          
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
          
            $tenant = MasterTenant::leftJoin('arrear_calculation', 'master_tenants.id', '=', 'arrear_calculation.tenant_id')->where('master_tenants.building_id', '=', decrypt($request->building))->selectRaw('@rownum  := @rownum  + 1 AS rownum, master_tenants.*, arrear_calculation.payment_status,arrear_calculation.total_amount ,master_tenants.id as mtid,arrear_calculation.id as acid')->groupBy(['tenant_id','building_id','society_id']);

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
                // if($tenant->total_amount == null || $tenant->payment_status == null || $tenant->payment_status == 0 ){
                    
                    return "<div class='d-flex btn-icon-list'><a href='".url('tenant_arrear_calculation?id='.encrypt($tenant->id))."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>edit</a></div>";
                // } else {
                //     return '';
                // } 
            })
            ->rawColumns(['actions'])
            ->make(true);
        } 

        //dd($datatables);

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        //dd($html);
        return view('admin.em_clerk_department.index', compact('html','building','society','layout_data','societies_data', 'building_data','layoutData'));
       
    }

    public function tenant_arrear_calculation(Request $request, Datatables $datatables){        
        
        $tenant = MasterTenant::leftJoin('arrear_calculation', 'master_tenants.id', '=', 'arrear_calculation.tenant_id')->where('master_tenants.id', '=', decrypt($request->id))
            ->select('*','master_tenants.id as id','master_tenants.building_id as building_id')->first();
        //dd($tenant);
        $currentMonth = date('m');
        if( $currentMonth <= 3) {
            $year = date('Y') -1 ;
        } else {
            $year = date('Y');
        }
        if(empty($tenant) || is_null($tenant)){
           return redirect()->back()->with('warning', 'Arrear Calculation is not done for user.');
        }

        $rate_card = ArrearsChargesRate::where('building_id', '=', $tenant->building_id)
                        ->where('year', '=', $year)
                        ->first();
        
        if(empty($rate_card) || is_null($rate_card)){          
           return redirect()->back()->with('warning', 'Arrear Calculation rate is not present for user building.');
        }
        $building = MasterBuilding::find($tenant->building_id);
        $society = SocietyDetail::where('id', '=', $building->society_id)->first();

        if(empty($society) || is_null($society)){          
           return redirect()->back()->with('warning', 'Society is not defined for building.');
        }

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("n", strtotime( date( 'Y-m-01' )." -$i months"));
            // if( $currentMonth <= 3) {
            //     $years[] = date("Y", strtotime( date( 'Y-m-01' )))-1;
            // } else {
                $years[] = date("Y", strtotime( date( 'Y-m-01' )." -$i months"));
            // }
        }
        $years = array_unique($years);        
        array_push($years, $year+1);
        // return $months;

        if($request->row_id){
            $arrear_row = ArrearCalculation::find(decrypt($request->row_id));
            //dd($arrear_row);
        } else {
            $arrear_row = (array) '';
        }

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'ac_month','name' => 'ac_month','title' => 'Month'],
            ['data' => 'ac_year','name' => 'ac_year','title' => 'Year'],
            ['data' => 'old_rate', 'name' => 'old_rate','title' => 'Old Rate','searchable' => false],
            ['data' => 'interest_on_old_rate', 'name' => 'interest_on_old_rate','title' => 'Interest on Old Rate','searchable' => false],
            ['data' => 'revise_rate', 'name' => 'revise_rate','title' => 'Revised Rate','searchable' => false],
            ['data' => 'interest_on_differance', 'name' => 'interest_on_differance','title' => 'Interest On Differance','searchable' => false],
            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status'],
            ['data' => 'total_amount', 'name' => 'total_amount','title' => 'Final Rent Amount'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false]
            ];

        if ($datatables->getRequest()->ajax()) {    

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
          // DB::enableQueryLog();
            $arrear = ArrearCalculation::leftjoin('arrears_charges_rates', function($join) use ($tenant,$year){
                                        $join->on('arrears_charges_rates.building_id', '=', 'arrear_calculation.building_id')
                                            ->where('arrears_charges_rates.year', '=', $year);
                                    })
                                    ->where('tenant_id', '=', $tenant->id)
                                    ->whereIn('arrear_calculation.month', $months)
                                    ->whereIn('arrear_calculation.year', $years)
                                    ->selectRaw('@rownum  := @rownum  + 1 AS rownum,arrears_charges_rates.*,arrear_calculation.*,arrear_calculation.year as ac_year,arrear_calculation.month as ac_month');

                                    // print_r(DB::getQueryLog());exit;
            return $datatables->of($arrear)
            ->editColumn('ac_month', function ($arrear){
                return date('M', mktime(0, 0, 0, $arrear->ac_month, 10));
            })
            ->editColumn('payment_status', function ($arrear){
                if($arrear->payment_status == null){
                     return 'Not Calculated';
                } elseif ($arrear->payment_status == 0) {
                     return 'Not Paid';
                } elseif ($arrear->payment_status == 1) {
                    return 'Paid';
                }                               
            })
            ->editColumn('total_amount', function ($arrear){
                if($arrear->total_amount == null){
                     return 'Not Calculated';
                } else {
                    return $arrear->total_amount;
                }                               
            })
            ->editColumn('actions', function ($arrear){
                // if($arrear->total_amount == null || $arrear->payment_status == null || $arrear->payment_status == 0 ){

                     return "<div class='d-flex btn-icon-list'><a href='".url('tenant_arrear_calculation?id='.encrypt($arrear->tenant_id).'&row_id='.encrypt($arrear->id))."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>edit</a></div>";
                // } else {
                //     return '';
                // } 
            })
            ->rawColumns(['actions'])
            ->make(true);
        }         

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        //dd($html->table());

        if($request->row_id){           
            return view('admin.em_clerk_department.edit_arrear_calculation', compact('tenant', 'rate_card', 'society', 'html', 'arrear_row'));
        } else {  
                    
            return view('admin.em_clerk_department.arrear_calculation', compact('tenant', 'rate_card', 'society', 'html'));
        }
    }

    public function create_arrear_calculation(Request $request){
        
        $temp = array(
        'tenant_id' => 'required',
        'building_id' => 'required',
        'society_id' => 'required',
        'year' => 'required',
        'month' => 'required',
        'oir_year' => 'required',
        'oir_month' => 'required',
        'old_intrest_amount' => 'required|numeric',
        'difference_amount' => 'required|numeric',
        'ida_year' => 'required',
        'ida_month' => 'required',
        'difference_intrest_amount' => 'required|numeric',
        'payment_status' => 'required',
        'total_amount' => 'required|numeric'
        );
        // validate the job application form data.
        $this->validate($request, $temp);

        // return $request->all();

        if($request->row_id && !empty($request->row_id)) {  
            $arrear_calculation = ArrearCalculation::find($request->row_id);
            //return $arrear_calculation;die;
        } else {            
            $arrear_calculation = new ArrearCalculation;
            //return 'hi hello';die;
        } 
        
        $arrear_calculation->tenant_id = $request->input('tenant_id');
        $arrear_calculation->building_id = $request->input('building_id');
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

        return redirect()->back()->with('success', 'Arreaer Calculation Submitted Successfully.');
       

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "asc" ],
            "searching" => false,
            // 'dom' => 'Bfrtip',
            // 'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print'],
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

    public function getArrearChargesByYear(Request $request) {
        if($request->has('year') && !empty($request->year) && $request->has('society_id') &&!empty($request->society_id) && $request->has('building_id') &&!empty($request->building_id)) {
            $arrearCharges = ArrearsChargesRate::where('society_id',decrypt($request->society_id))->where('building_id',decrypt($request->building_id))->where('year',$request->year)->orderBy('id','DESC')->first();

            echo json_encode(['result' => true,'data' => $arrearCharges]);
        } else {
            echo json_encode(['result'=>false]);
        }
        exit;
    }

    public function getArrearChargesByYears(Request $request) {
        if($request->has('start_year') && !empty($request->start_year) && $request->has('ida_year') && !empty($request->ida_year) && $request->has('society_id') &&!empty($request->society_id) && $request->has('building_id') &&!empty($request->building_id) && $request->has('ior_year') && !empty($request->ior_year)) {
            $years = [];

            if($request->ida_month <= 3) {
                $request->ida_year = $request->ida_year - 1;
            }
            if($request->ior_month <= 3 ) {
                $request->ior_year = $request->ior_year - 1;
            }
            if($request->ior_year < $request->ida_year) {
                $end_year = $request->ior_year;
            } else {
                $end_year = $request->ida_year;
            }

            $currentYear = date('Y');
            if($request->start_month <= 3 && $request->start_year == $currentYear) {
                $request->start_year = $request->start_year -1;
            }

            $isYearHaveCharges = true;
            for($i = $end_year; $i<= $request->start_year; $i++) {
                $years[] = $i; 
                $arrearCharges = ArrearsChargesRate::where('society_id',decrypt($request->society_id))->where('building_id',decrypt($request->building_id))->where('year',$i)->orderBy('id','DESC')->first();
                if(!$arrearCharges) {
                    $isYearHaveCharges = false;
                }
            }
            // print_r($years);exit;
            if(false == $isYearHaveCharges) {
                echo json_encode(['result'=>false]);
            } else {

                $arrearCharges = ArrearsChargesRate::where('society_id',decrypt($request->society_id))->where('building_id',decrypt($request->building_id))->whereIn('year',$years)->orderBy('id','DESC')->get();

                echo json_encode(['result' => true,'data' => $arrearCharges]);
            }
        } else {
            echo json_encode(['result'=>false]);
        }
        exit;
    }
}

