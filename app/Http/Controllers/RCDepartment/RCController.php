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
use App\ServiceChargesRate;
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
        return $this->bill_collection_society($request);
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
        $html ='';
        //return $rate_card;
        return view('admin.rc_department.collect_bill_tenant', compact('html','layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }

     public function get_building_bill_collection(Request $request, Datatables $datatables){
            
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

        $columns = [
                ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
                ['data' => 'building_no','name' => 'building_no','title' => 'Building / Chawl Number'],
                ['data' => 'name','name' => 'name','title' => 'Building / Chawl Name'],
                ['data' => 'tenant_count','name' => 'tenant_count','title' => 'Tenant Count'],
                ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
            ];
            $society_id = $request->input('id');
            if ($datatables->getRequest()->ajax()) {
                DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
                $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $request->input('id'))
                ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_buildings.*');  
                    return $datatables->of($buildings)
                        ->editColumn('tenant_count', function ($buildings){  
                           $value = $buildings->tenant_count->toArray(); 
                           if($value) {
                               foreach($value as $i) {
                                 return $i['count'];
                               }
                            } else {
                                return 0;
                            }
                        })
                        ->editColumn('actions', function ($buildings){
                            return "<div class='d-flex btn-icon-list'>
                            <a href='".route('billing_calculations', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Billing Details</a>
                        
                            <a href='".route('generate_receipt_society', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Generate Reciept</a>

                            <a href='".route('view_bill_building', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Bill</a>
            
                        </div>";
                            
                        })               
                        ->rawColumns(['actions'])
                        ->make(true);
            }
            //return $buildings;
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

            return view('admin.rc_department.collect_bill_tenant', compact('layout_data','societies_data','wards_data','colonies_data','html', 'society_id'));
    }

    public function get_tenant_bill_collection(Request $request, Datatables $datatables){
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
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Flat No.'],
            ['data' => 'salutation','name' => 'salutation','title' => 'Salutation'],
            ['data' => 'first_name','name' => 'first_name','title' => 'First Name'],
            ['data' => 'last_name','name' => 'last_name','title' => 'Last Name'],
            ['data' => 'use','name' => 'use','title' => 'Use'],
            ['data' => 'carpet_area','name' => 'carpet_area','title' => 'Carpet Area'],
            ['data' => 'tenant_type','name' => 'tenant_type','title' => 'Tenant Type'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false]
        ];
        $tenament = DB::table('master_tenant_type')->get();
        $building_id = $request->input('building');
       
       
        if ($datatables->getRequest()->ajax()) {
            
            $society_id = MasterBuilding::where('id', '=', $request->input('building'))->first()->society_id;
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings = MasterTenant::where('building_id', '=', $request->input('building'))
            ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*');
            return $datatables->of($buildings)
                ->editColumn('actions', function ($buildings){
                    return "<div class='d-flex btn-icon-list'>
                    <a href='".route('billing_calculations', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Billing Details</a>
                
                    <a href='".route('generate_receipt_tenant', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Generate Reciept</a>

                    <a href='".route('view_bill_tenant', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Bill</a>
    
                </div>";
                    
                })               
                ->rawColumns(['actions'])
                ->make(true);
            
        }
      
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
 
        // return $buildings;
        return view('admin.rc_department.collect_bill_tenant', compact('layout_data','societies_data','wards_data','colonies_data','tenament','html', 'building_id', 'society_id'));
    }

    public function generate_receipt_society(Request $request){
        $request->building_id = decrypt($request->building_id);
        $request->society_id = decrypt($request->society_id);
        
        $Tenant_bill_id = DB::table('building_tenant_bill_association')->where('building_id', '=', $request->building_id)->where('bill_month', '=',  date('n'))->where('bill_year', '=', date('Y'))->first();

        if(empty($Tenant_bill_id) || is_null($Tenant_bill_id)){
           return redirect()->back()->with('success', 'Bill Generation is not done for Society. Contact Estate Manager for bill generation.');
        }

        $bill_ids =  explode(',',$Tenant_bill_id->bill_id);                          
        
        $bill = TransBillGenerate::findMany($bill_ids);
        //dd($bill);
        if(!empty($bill)){
        $data = array('monthly_bill' => 0,'arrear_bill' => 0 , 'total_bill' => 0, 'total_service_after_due' => 0, 'late_fee_charge' => 0, 'arrear_id' => '', 'bill_year' => $bill[0]->bill_year, 'bill_month' => $bill[0]->bill_month, 'building_id' => $bill[0]->building_id, 'society_id' => $bill[0]->society_id, 'bill_date' => $bill[0]->bill_date, 'due_date' => $bill[0]->due_date, 'bill_from' => $bill[0]->bill_from, 'bill_to' => $bill[0]->bill_to, 'consumer_number' => $bill[0]->consumer_number);    
        } else {
          return redirect()->back()->with('success', 'Bill Generation is not done for Society. Contact Estate Manager for bill generation.');
        }
        foreach ($bill as $key => $value) {
            $data['monthly_bill'] +=  $value->monthly_bill;
            $data['arrear_bill']  += $value->arrear_bill;
            $data['total_bill']  += $value->total_bill;
            $data['total_service_after_due']  += $value->total_service_after_due;
            $data['late_fee_charge']  += $value->late_fee_charge;
            if($value->arrear_id != ''){
              if($data['arrear_id'] == ''){
                $data['arrear_id'] .= $value->arrear_id;
              } else {
                $data['arrear_id'] .= ','.$value->arrear_id;
              }
            }
        }
         //dd($data);  
        $tenament = DB::table('master_tenant_type')->get();
        $building_id = $request->input('building_id');
        
        $buildings = MasterTenant::where('building_id', '=', $request->building_id)
                 ->select("id", DB::raw("CONCAT(first_name,' ',last_name)  AS name"))->get()->toArray();
         array_unshift($buildings, array('id'=> '', 'name' => 'NA'));
        //dd($buildings);
       
        $buildings = json_encode($buildings);

        $building_detail = MasterBuilding::where('id', $request->building_id)->first();
        $society_detail = SocietyDetail::where('id', $request->society_id)->first();

        //return $buildings;

        return view('admin.rc_department.generate_receipt_society', compact('tenament', 'buildings', 'data', 'Tenant_bill_id', 'building_detail', 'society_detail'));
    }

    public function generate_receipt_tenant(Request $request){
       
       $request->tenant_id = decrypt($request->tenant_id);
       $request->building_id = decrypt($request->building_id);

        $bill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                   ->where('building_id', '=', $request->building_id)
                                   ->where('bill_month', '=',  date('n'))
                                   ->where('bill_year', '=', date('Y'))
                                   ->with('tenant_detail')
                                   ->with('building_detail')
                                   ->with('society_detail')
                                   ->orderBy('id','DESC')
                                   ->first();

         if(empty($bill) || is_null($bill)){
           return redirect()->back()->with('warning', 'Receipt Generation is not done for user.');
        }

        return view('admin.rc_department.generate_receipt_tenant', compact('bill'));
    }



    public function payment_receipt_society(Request $request){

      if($request->bill_no){  
            
           $Tenant_bill_id = DB::table('building_tenant_bill_association')->where('id', '=', $request->bill_no)->first();

           $bill_ids =  explode(',',$Tenant_bill_id->bill_id); 
           
           $receipt = TransPayment::with('dd_details')->with('bill_details')->whereIn('bill_no', $bill_ids)->where('building_id', '=', $request->building_id)->where('society_id', '=', $request->society_id)->get();
           
          if(count($receipt) <= 0 ){
            $bill = TransBillGenerate::where('status', '!=', 'paid')->findMany($bill_ids);
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

            foreach ($bill as $key => $value) {
                if(in_array( $value->tenant_id, $request->except_tenaments)){
                  $Akey = array_search($value->tenant_id, $request->except_tenaments);
                    $paid_amt = $request->tenant_credit_amt[$Akey];
                    //dd($value->total_bill);
                    //dd($paid_amt);
                      //dd($value->arrear_id);
                      if($value->arrear_id != ''){
                      $ids = explode(',', $value->arrear_id);
                        $tenant_arrear = ArrearCalculation::whereIn('id', $ids)->get();
                        if(count($tenant_arrear) > 0){
                          foreach ($tenant_arrear as $key => $value2) {
                            if($value2->total_amount < $paid_amt){
                              $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                              $paid_amt -= $value2->total_amount;
                            } else {                              

                            }
                          }
                        }
                       // dd($tenant_arrear);
                       // $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                      }

                      if($paid_amt > $value->total_bill){
                        $credit_amt = $paid_amt - $value->total_bill;
                        $balance = 0;

                        $credit = MasterTenant::where('id', $value->tenant_id)->first();                       
                        if(is_null($credit->credit)){
                          $credit->credit = $credit_amt;
                        } else {
                          $credit->credit = $credit->credit + $credit_amt;
                        }   
                        $credit->save(); 

                        $bill_status = TransBillGenerate::find($value->id)->update(array('status' => 'Paid')); 
                        //dd($credit);

                      } else {
                        $balance = $value->total_bill - $paid_amt;
                        $credit_amt = 0;
                      }

                    $data[] =  [
                            'bill_no'    => $value->id,
                            'tenant_id'  => $value->tenant_id,
                            'building_id'    => $value->building_id,
                            'society_id'     => $value->society_id,
                            'paid_by'    => $request->amount_paid_by,
                            'dd_id'    => $dd,
                            'mode_of_payment' => $request->payment_mode,
                            'bill_amount' => $value->total_bill,
                            'amount_paid' => $request->tenant_credit_amt[$Akey],
                            'from_date' => $request->from_date,
                            'to_date' => $request->to_date,
                            'balance_amount' => $balance,
                            'credit_amount' => $credit_amt,
                          ]; 
                    //dd($data);

                } else {

                  $data[] =  [
                            'bill_no'    => $value->id,
                            'tenant_id'  => $value->tenant_id,
                            'building_id'    => $value->building_id,
                            'society_id'     => $value->society_id,
                            'paid_by'    => $request->amount_paid_by,
                            'dd_id'    => $dd,
                            'mode_of_payment' => $request->payment_mode,
                            'bill_amount' => $value->total_bill,
                            'amount_paid' => $value->total_bill,
                            'from_date' => $request->from_date,
                            'to_date' => $request->to_date,
                            'balance_amount' => 0,
                            'credit_amount' => 0,
                          ];   
                          //dd($data);
                  $bill_status = TransBillGenerate::find($value->id)->update(array('status' => 'Paid')); 

                }            
            }

                $bill = TransPayment::insert($data);

                $receipt = TransPayment::with('dd_details')->with('bill_details')->whereIn('bill_no', $bill_ids)->where('building_id', '=', $request->building_id)->where('society_id', '=', $request->society_id)->get();

                //dd($receipt);
                $data['bill_amount'] = 0;
                $data['amount_paid'] = 0;
                foreach ($receipt as $key => $value) {
                  $value->id = $request->bill_no;   
                  $data['bill_amount'] += $value->bill_amount;
                  $data['amount_paid'] += $value->amount_paid;    
                }

                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society']  = SocietyDetail::find($data['building']->society_id);

                $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->whereNotIn('id', $request->except_tenaments)->get();

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
              
               
              $receipt1 = TransPayment::with('dd_details')->with(array('bill_details'=>function($query){
                             $query->where('status', '=' ,'paid');
                          }))->whereIn('bill_no', $bill_ids)->where('building_id', '=', $request->building_id)->where('society_id', '=', $request->society_id)->get();

                //dd($receipt);
                $data['bill_amount'] = 0;
                $data['amount_paid'] = 0;
                foreach ($receipt as $key => $value) {
                  $value->id = $request->bill_no;   
                  $data['bill_amount'] += $value->bill_amount;
                  $data['amount_paid'] += $value->amount_paid;    
                }

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

                    $bill_status = TransBillGenerate::find($request->bill_no);
                    $bill_status->status = 'paid';
                    $bill_status->save(); 

                    // update Arrear of tenant user
                    if($bill_status->arrear_id != ''){
                      $ids = explode(',', $bill_status->arrear_id);
                      $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                    }

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

    public function view_bill_building(Request $request,$is_download=false){

        if($request->has('building_id') && '' != $request->building_id) {

            $data['month'] = date('m');
            $data['year'] = date('Y');

            if($request->has('month') && !empty($request->month)) {
                $data['month'] = $request->month;
            }

            if($request->has('year') && !empty($request->year)) {
              $data['year'] = $request->year;
            }

            $request->building_id = decrypt($request->building_id);
            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$data['year'])->first();

         //  dd($data['serviceChargesRate']); 
            if(!$data['serviceChargesRate']){
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

          $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('year',$data['year'])->where('payment_status','0')->get();
            
            $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
         //dd($data['number_of_tenants']->tenant_count()->first());
            if(!$data['number_of_tenants']->tenant_count()->first()) {
                return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
            }

            
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
            if(true == $is_download) {
              $pdf = PDF::loadView('admin.rc_department.view_bill_building', $data);
              print_r($pdf);exit;
              return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');
            } else {
              return view('admin.rc_department.view_bill_building',$data);
            }
        }   
    }

     public function view_bill_tenant(Request $request,$is_download=false){

          if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $request->building_id = decrypt($request->building_id);
            $request->tenant_id = decrypt($request->tenant_id);

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $data['month'] = date('m');
            $data['year'] = date('Y');

            if($request->has('month') && !empty($request->month)) {
                $data['month'] = $request->month;
            }

            if($request->has('year') && !empty($request->year)) {
              $data['year'] = $request->year;
            }

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$data['year'])->first();

            if(!$data['serviceChargesRate']){
                //dd($data);
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('year',$data['year'])->where('payment_status','0')->get();

            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);
            $data['is_download'] = $is_download;
            if(true == $is_download) {
              $pdf = PDF::loadView('admin.rc_department.view_bill_tenant', $data);
              return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');
            } else {
                return view('admin.rc_department.view_bill_tenant',$data);
            }
        }

     }

     public function downloadBill(Request $request) {
         if($request->has('building_id') && '' != $request->building_id) {
          
          $data['building'] = MasterBuilding::find(decrypt($request->building_id));
          $data['society'] = SocietyDetail::find($data['building']->society_id);

          if($request->has('tenant_id') && !empty($request->tenant_id)) {
            
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',decrypt($request->tenant_id))->first();
            $this->view_bill_tenant($request,true);
          } else {
            $this->view_bill_building($request,true);
          }
        }
     }

     public function get_building_select_updated_RC(Request $request){
    
        if($request->input('id')){
            $society = SocietyDetail::find($request->input('id'));
            if(Config::get('commanConfig.SOCIETY_LEVEL_BILLING') == $society->society_bill_level) {
                
                $html ='<div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Society Level Biiling
                                </div>
                            </div>                          
                    </div>
                    <div class="row align-items-center mb-0">           
                        <div class="col-md-9">
                        <form action="get_building_bill_collection" method="get">
                            <input type="hidden" name="id" id="building_id"/>
                            <div class="form-group m-form__group">
                                <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="search" value="Search">
                            </div>
                        </form>
                        </div>
                </div>
                </div>';
            $society_id = $request->input('id');
            $buildings = MasterBuilding::with(['TransBillGenerate'=>function($query) use($society_id){
                $query->where('society_id', '=', $society_id)->where('bill_month', '=', date('m'))->where('bill_year', '=', date('Y'));
            }])->with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            // return $buildings;

            //  $html .= view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'))->render();
             return $html;

            } else {
                
                $building = MasterBuilding::where('society_id', '=', $request->input('id'))->get();
                $html = '<div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Tenant Level Biiling
                                </div>
                            </div>                          
                    </div>
                </div>
               
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                 <form action="get_tenant_bill_collection" method="get">       
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building">';
                                    $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

                                        foreach($building as $key => $value){
                                            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                                        }   
                                    $html .= '</select>
                                </div>
                            </div>                          
                    </div>
                    <div class="row align-items-center mb-0">           
                        <div class="col-md-9">
                            <div class="form-group m-form__group">
                                <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="search" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
               </div>
                
                ';         

                return $html;
            }
        }
    }
    public function get_building_bill_collection_RC(Request $request, Datatables $datatables) {
        $id = $request->input('id');
        echo "hit";
    }
}
