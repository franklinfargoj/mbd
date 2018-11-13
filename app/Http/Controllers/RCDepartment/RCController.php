<?php

namespace App\Http\Controllers\RCDepartment;

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
use App\SocietyDetail;
use App\MasterBuilding;
use App\MasterTenant;
use App\ArrearsChargesRate;
use App\ArrearTenantPayment;
use App\ArrearCalculation;
use PDF;
use App\TransBillGenerate;
use App\TransPayment;
use App\DdDetails;

class RCController extends Controller
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
        $getData = $request->all();

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data =  $this->comman->listApplicationData($request);

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ee_application_data) {
                    $url = route('ee.view_application', $ee_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })                
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>".$listArray->eeApplicationSociety->address."</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
                    if($request->update_status){
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at','eeApplicationSociety.address'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.rc_department.index', compact('html','header_data','getData'));
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

    public function bill_collection_society(Request $request){
       $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies_data = SocietyDetail::where('society_bill_level', '=', '1')->whereIn('colony_id', $colonies)->get();

        //return $rate_card;
        return view('admin.rc_department.collect_bill_society', compact('layout_data', 'wards_data', 'colonies_data','societies_data'));
  
    }

    public function bill_collection_tenant(Request $request){
        
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
        $societies_data = SocietyDetail::where('society_bill_level', '=', '2')->whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

        //return $rate_card;
        return view('admin.rc_department.collect_bill_tenant', compact('layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }

     public function get_building_bill_collection(Request $request){

            $society_id = $request->input('id');
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            //return $buildings;
            return view('admin.rc_department.ajax_building_bill_collection', compact('buildings', 'society_id'));
    }

    public function get_tenant_bill_collection(Request $request){
         $tenament = DB::table('master_tenant_type')->get();
         $building_id = $request->input('id');
         $buildings = MasterTenant::where('building_id', '=', $request->input('id'))
                 ->get();
        // return $buildings;
        return view('admin.rc_department.ajax_tenant_bill_collection', compact('tenament','buildings', 'building_id'));
    }

    public function generate_receipt_society(Request $request){

       //dd($request->building_id);
       //dd($request->society_id);

        $bill = TransBillGenerate::where('building_id', '=', $request->building_id)
                                   ->where('bill_month', '=',  date('n'))
                                   ->where('bill_year', '=', date('Y'))
                                   ->with('tenant_detail')
                                   ->with('building_detail')
                                   ->with('society_detail')
                                   ->first();

         if(empty($bill) || is_null($bill)){
           return redirect()->back()->with('success', 'Bill Generation is not done for Society. Contact Estate Manager for bill generation.');
        }
                 
        $tenament = DB::table('master_tenant_type')->get();
        $building_id = $request->input('building_id');
        
        $buildings = MasterTenant::where('building_id', '=', $request->input('building_id'))
                 ->select("id", DB::raw("CONCAT(first_name,' ',last_name)  AS name"))->get()->toArray();

        $buildings = json_encode($buildings);
        //return $buildings;

        return view('admin.rc_department.generate_receipt_society', compact('bill', 'tenament', 'buildings'));
    }

    public function generate_receipt_tenant(Request $request){
       
        $bill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                   ->where('building_id', '=', $request->building_id)
                                   ->where('bill_month', '=',  date('n'))
                                   ->where('bill_year', '=', date('Y'))
                                   ->with('tenant_detail')
                                   ->with('building_detail')
                                   ->with('society_detail')
                                   ->first();

         if(empty($bill) || is_null($bill)){
           return redirect()->back()->with('warning', 'Receipt Generation is not done for user.');
        }

        return view('admin.rc_department.generate_receipt_tenant', compact('bill'));
    }

    public function payment_receipt_society(Request $request){

    //dd($request->all());
       
    if($request->bill_no){
            
          $receipt = TransPayment::with('dd_details')->with('bill_details')->where('bill_no', '=', $request->bill_no)->where('building_id', '=', $request->building_id)->where('society_id', '=', $request->society_id)->first();
          //dd($receipt);
            if(!$receipt){
                
                if($request->payment_mode == 'dd' && $request->dd_no != ''){
                    $dd = DdDetails::where('bill_no', '=', $request->bill_no)
                          ->where('dd_no', '=', $request->dd_no)->first();
                          if(!$dd){
                            $dd = new DdDetails;
                            $dd->bill_no = $request->bill_no;
                            $dd->dd_no = $request->dd_no;
                            $dd->bank_name = $request->bank_name;
                            $dd->dd_amount = $request->dd_amount;
                            $dd->status = 'Submitted';
                            $dd->save();                            
                          }
                        $dd = $dd->id;
                } else {
                    $dd = '';
                }

                if($request->payment_mode == 'cash'){
                         $amount_paid = $request->cash_amount;
                } else if($request->payment_mode == 'dd'){
                         $amount_paid = $request->dd_amount;
                } else {
                    $amount_paid = 0;
                }

               
            $tenants = MasterTenant::where('building_id',$request->building_id)->get();
            
            //dd($tenants);

            if($tenants){
                foreach($tenants as $row => $key){
                        $data[] =  [
                                    'bill_no'    => $request->bill_no,
                                    'tenant_id'  => $key->id,
                                    'building_id'    => $key->building_id,
                                    'society_id'     => $request->society_id,
                                    'paid_by'    => $request->amount_paid_by,
                                    'dd_id'    => $dd,
                                    'mode_of_payment' => $request->payment_mode,
                                    'bill_amount' => $request->bill_amount,
                                    'amount_paid' => $amount_paid,
                                    'from_date' => $request->from_date,
                                    'to_date' => $request->to_date,
                                    'balance_amount' => $request->balance_amount,
                                    'credit_amount' => $request->credit_amount,
                                  ];
                }
                    $bill = TransPayment::insert($data);
                                 
                } else {
                    return redirect()->back()->with('success', 'Check bill details once.');    
                }
        

                $receipt = TransPayment::with('dd_details')->with('bill_details')->where('bill_no', '=', $request->bill_no)->where('building_id', '=', $request->building_id)->where('society_id', '=', $request->society_id)->first();


                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society'] = SocietyDetail::find($data['building']->society_id);

                $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->get();

                $data['bill'] = $receipt;
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
                $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
                //dd($data['number_of_tenants']->tenant_count()->first());
                if(!$data['number_of_tenants']->tenant_count()->first()) {
                    return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
                }
                $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
                return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');

            } else {
              

                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society'] = SocietyDetail::find($data['building']->society_id);

                $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->get();

                $data['bill'] = $receipt;
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
                 $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
                //dd($data);
                 //dd($data['number_of_tenants']->tenant_count()->first());
            if(!$data['number_of_tenants']->tenant_count()->first()) {
                return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
            }

                $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
                return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');
            }
          
        } else {
           return redirect()->back()->with('warning', 'Invalid Bill Data.');
        }

    }

    public function payment_receipt_tenant(Request $request){
        
       // dd($request->all());
        if($request->bill_no){
            
            $receipt = TransPayment::with('dd_details')->with('bill_details')->where('bill_no', '=', $request->bill_no)->first();

            if(!$receipt){

                if($request->payment_mode == 'dd' && $request->dd_no != ''){
                    $dd = DdDetails::where('bill_no', '=', $request->bill_no)
                          ->where('dd_no', '=', $request->dd_no)->first();
                          if(!$dd){
                            $dd = new DdDetails;
                            $dd->bill_no = $request->bill_no;
                            $dd->dd_no = $request->dd_no;
                            $dd->bank_name = $request->bank_name;
                            $dd->dd_amount = $request->dd_amount;
                            $dd->status = 'Submitted';
                            $dd->save();                            
                          }
                        $dd = $dd->id;
                } else {
                    $dd = '';
                }

                if($request->payment_mode == 'cash'){
                         $amount_paid = $request->cash_amount;
                } else if($request->payment_mode == 'dd'){
                         $amount_paid = $request->dd_amount;
                } else {
                    $amount_paid = 0;
                }

                $bill = new TransPayment;
                $bill->bill_no = $request->bill_no;
                $bill->tenant_id = $request->tenant_id;
                $bill->building_id = $request->building_id;
                $bill->society_id = $request->society_id;
                $bill->paid_by = $request->amount_paid_by;
                $bill->dd_id = $dd;
                $bill->mode_of_payment = $request->payment_mode;
                $bill->bill_amount = $request->bill_amount;
                $bill->amount_paid = $amount_paid;
                $bill->from_date = $request->from_date;
                $bill->to_date = $request->to_date;
                $bill->balance_amount = $request->balance_amount;
                $bill->credit_amount = $request->credit_amount;

                $bill->save();

                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society'] = SocietyDetail::find($data['building']->society_id);
                $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();
                $data['bill'] = $bill;
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

                $pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
                       return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');

            } else {
                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society'] = SocietyDetail::find($data['building']->society_id);
                $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();
                $data['bill'] = $receipt;
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

                $pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
                       return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');
                return redirect()->back()->with('warning', 'Bill Already Paid.');
            }
          
        } else {
           return redirect()->back()->with('warning', 'Invalid Bill Data.');
        }

    }

}
