<?php

namespace App\Http\Controllers\RCDepartment;

use App\DisputeBillDetail;
use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\EMDepartment\BillingDetailController;
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
use Maatwebsite\Excel\Facades\Excel;
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
use Illuminate\Support\Facades\Redirect;
use Mpdf\Mpdf;

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
        return $this->bill_collection_tenant($request);
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
        $society_id = 0;
        $layoutId = 0;
        $wardId= 0;
        $colonyId=0;
        $buildingId=0;
        //return $rate_card;
        return view('admin.rc_department.collect_bill_tenant', compact('society_id','wardId','colonyId','layoutId','html','layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data','buildingId'));

    }

    public function bill_payment_report(){

        return view('admin.rc_department.bill_payment_report');
    }

    public function billing_report(Request $request){

//        dd($request->all());
        if($request->period != null)
            $period = $this->period($request->period);
        else
            $period = $request->period;

        $period_title = $this->periodTitle($request->period);

        $report_format = $request->excel;

        $payment_data = $this->getPaymentData($period);

        if(count($payment_data) > 0){
            $result = $this->generateReport($payment_data,$report_format,$period_title,'Payment Details');
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }else{
            return back()->with('error', 'No Record Found');
        }
    }
    /**
     * Period for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $period
     */
    public function period($request_period){

        $period = explode('-', $request_period);

        return $period;
    }

    /**
     * Period title for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $period_title
     */
    public function periodTitle($request_period){
        $period_title = isset(config('commanConfig.pendency_report_periods')[$request_period])?config('commanConfig.pendency_report_periods')[$request_period]:"";

        return $period_title;
    }

    /**
     * Payment report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getPaymentData($period){
        if($period == null){

            $payment_data = $payment_data = TransPayment::with('dd_details')->get();
        }
        else{

            $payment_data = TransPayment::with('dd_details','building','society_details','tenants')->where(DB::raw('DATEDIFF(NOW(),created_at)'), '>=', $period[0])
            ->where(DB::raw('DATEDIFF(NOW(),created_at)'), '<=', $period[1])
                ->get();

        }
        return $payment_data;
    }

    /**
     * Generate the Report in excel format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateReport($data, $report_format, $period_title, $module_name){

//        $application_types = ApplicationType::all();
        if (count($data) > 0) {
            if($report_format == 'excel')
            {
                $dataListMaster = [];
                $i=1;
                foreach ($data as $datas) {


                    $dataList = [];
                    $dataList['Sr. No.'] = $i;
                    $dataList['Bill No'] = $datas['bill_no'] ?? '';
                    $dataList['Building Name'] = $datas->building[0]->name ?? '';
                    $dataList['Tenant Name'] = $datas->tenants[0]->first_name.' '.$datas->tenants[0]->middle_name.' '.$datas->tenants[0]->last_name ?? '';
                    $dataList['Society Name'] = $datas->society_details['society_name'] ?? '';
                    $dataList['Paid By'] = $datas['paid_by'] ?? '';
                    $dataList['Mode of Payment'] = $datas['mode_of_payment'] ?? '';
                    $dataList['Bill amount'] = $datas['bill_amount'] ?? '';
                    $dataList['Amount Paid'] = $datas['amount_paid'] ?? '';
                    $dataList['From Date'] = $datas['from_date'] ?? '';
                    $dataList['To date'] = $datas['to_date'] ?? '';
                    $dataList['Balance Amount'] = $datas['balance_amount'] ?? '';
                    $dataList['Credit Amount'] = $datas['credit_amount'] ?? '';
                    if(($datas->dd_id)){
                        $dataList['DD No.'] = $datas->dd_details['dd_no'] ?? '';
                        $dataList['Bank Name'] = $datas->dd_details['bank_name'] ?? '';
                        $dataList['DD Amount'] = $datas->dd_details['dd_amount'] ?? '';
                        $dataList['DD Status'] = $datas->dd_details['status'] ?? '';
                    }
//                    $dataList['except_id'] = $datas['except_id'];

                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
                $module_name = str_replace(' ','_',$module_name);
                $period_title = str_replace(' ','_',$period_title);
                return Excel::create(date('Y_m_d_H_i_s') . '_Period_'.$period_title.$module_name, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }


     public function get_building_bill_collection(Request $request, Datatables $datatables){
        //print_r($request->all());exit;
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
        $society_id = decrypt($request->input('society'));
        $layoutId = decrypt($request->input('layout'));
        $wardId=decrypt($request->input('wards'));
        $colonyId=decrypt($request->input('colony'));

         if(isset($colonyId)){
             $society_list = SocietyDetail::where('colony_id', $colonyId)->get();
         }
         if(isset($wardId)){
             $colony_list = MasterColony::where('ward_id', $wardId)->get();
         }
         if(isset($layoutId)){
             $ward_list = MasterWard::where('layout_id', $layoutId)->get();
         }
         if(isset($society_id)){
             $building_list = MasterBuilding::where('society_id', $society_id)->get();
         }


        if(!$request->input('building')) {
        $columns = [
                ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
                ['data' => 'building_no','name' => 'building_no','title' => 'Building / Chawl Number'],
                ['data' => 'name','name' => 'name','title' => 'Building / Chawl Name'],
                ['data' => 'tenant_count','name' => 'tenant_count','title' => 'Tenant Count'],
                ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
            ];
            
            $society_name = SocietyDetail::where('id', $society_id)->first()->society_name;
            if ($datatables->getRequest()->ajax()) {
                DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
                $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($request->input('society')))
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
                            
                            <a href='".route('dispute_amount_society', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Dispute Bill</a>

                            <a href='".route('view_bill_building', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Bill</a>
            
                        </div>";
                            
                        })               
                        ->rawColumns(['actions'])
                        ->make(true);
            }
            //return $buildings;
            $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
            // return  Redirect::route('get_building_bill_collection')->with(array('html'=>$html));
            return view('admin.rc_department.collect_bill_tenant')
                ->with([
                    'society_list'=>$society_list ,
                    'colony_list'=>$colony_list,
                    'ward_list'=>$ward_list,
                    'building_list'=>$building_list,
                    'html'=>$html,'layout_data'=>$layout_data,'layoutId'=>$layoutId,'wards_data'=>$wards_data,'wardId'=>$wardId,'colonies_data'=>$colonies_data,'societies_data'=>$societies_data,'colonyId'=>$colonyId,'society_id'=>$society_id,'society_name'=>$society_name]);
    
        } else {

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
       
        $buildingId=decrypt($request->input('building'));
        $society_name = SocietyDetail::where('id', $society_id)->first()->society_name;
        $building_name = MasterBuilding::where('id',$buildingId)->first()->name;
        $society_Id = MasterBuilding::where('id', '=', $buildingId)->first()->society_id;
       // echo $society_Id;
        if ($datatables->getRequest()->ajax()) {
            
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings = MasterTenant::where('building_id', '=', decrypt($request->input('building')))
            ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*');
            return $datatables->of($buildings)
                ->editColumn('actions', function ($buildings) use($society_Id){
                    return "<div class='d-flex btn-icon-list'>
                    <a href='".route('billing_calculations', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Billing Details</a>
                
                    <a href='".route('generate_receipt_tenant', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Generate Reciept</a>
                    
                    <a href='".route('dispute_amount_tenant', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Dispute Bill</a>

                    <a href='".route('view_bill_tenant', ['tenant_id'=>encrypt($buildings->id),'building_id'=>encrypt($buildings->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Bill</a>
    
                </div>";
                    
                })               
                ->rawColumns(['actions'])
                ->make(true);
            
        }
      
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
        // return $buildings;
        return view('admin.rc_department.collect_bill_tenant', compact( 'society_list',
                    'colony_list',
                    'ward_list',
                    'building_list','layout_data','societies_data','wards_data','colonies_data','tenament','html', 'society_id','layoutId','wardId','colonyId','society_Id','society_name','buildingId','building_name','society_name'));
    }

    }

    public function generate_receipt_society(Request $request){
//        dd($request->all());
        $request->building_id = decrypt($request->building_id);
        $request->society_id = decrypt($request->society_id);
        
        $currentMonth = date('m');
        if($currentMonth < 4) {
            if($currentMonth == 1) {
                $data['month'] = 12;
                $data['year'] = date('Y') -1;
            } else {
                $data['month'] = date('m') -1;
                $data['year'] = date('Y') -1;
            }
        } else {
            $data['month'] = date('m') - 1;
            $data['year'] = date('Y');
        }
        
//        $Tenant_bill_id = DB::table('building_tenant_bill_association')
//            ->where('building_id', '=', $request->building_id)
//            ->where('bill_month', '=',  $data['month'])
//            ->where('bill_year', '=', $data['year'])
//            ->orderBy('id','DESC')->first();
//
//
//        // print_r($Tenant_bill_id);exit;
////        if(empty($Tenant_bill_id) || is_null($Tenant_bill_id)){
////           return redirect()->back()->with('success', 'Bill Generation is not done for Society. Contact Estate Manager for bill generation.');
////        }
//
//        $bill_ids =  explode(',',$Tenant_bill_id->bill_id);
//        //dd($bill_ids);
//        $bill = TransBillGenerate::findMany($bill_ids);
//         //dd($bill);


        $bill = TransBillGenerate::where('building_id',$request->building_id)
            ->where('society_id',$request->society_id)
            ->where('bill_month', '=',  $data['month'])
            ->where('bill_year', '=', $data['year'])
            ->orderBy('id','desc')
            ->get();

//        dd($bill);

        if(/*!empty($bill)*/ (count($bill) > 0 )){
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

        $receipt_data = TransPayment::where('building_id',$request->building_id)
            ->where('society_id',$request->society_id)
            ->orderBy('id','desc')
            ->get();
        //return $buildings;

        $dispute_data = DisputeBillDetail::where('trans_bill_generate_id', $bill['0']->id)->get()->toArray();

        return view('admin.rc_department.generate_receipt_society', compact('dispute_data','receipt_data','bill','tenament', 'buildings', 'data', 'Tenant_bill_id', 'building_detail', 'society_detail'));
    }

    public function generate_receipt_tenant(Request $request){
       
       $request->tenant_id = decrypt($request->tenant_id);
       $request->building_id = decrypt($request->building_id);
        
       $currentMonth = date('m');
        if($currentMonth < 4) {
            if($currentMonth == 1) {
                $data['month'] = 12;
                $data['year'] = date('Y') -1;
            } else {
                $data['month'] = date('m') -1;
                $data['year'] = date('Y');
            }
        } else {
            $data['month'] = date('m');
            $data['year'] = date('Y');
        }
       // dd($request->tenant_id." ". $request->building_id);
        $bill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                   ->where('building_id', '=', $request->building_id)
                                //    ->where('bill_month', '=',  $data['month'])
                                //    ->where('bill_year', '=', $data['year'])
                                   ->with('tenant_detail')
                                   ->with('building_detail')
                                   ->with('society_detail')
                                   ->orderBy('id','desc')
                                   ->first();
        
         if(empty($bill) || is_null($bill)){
           return redirect()->back()->with('warning', 'Receipt Generation is not done for user.');
        }

        $receipt_data = TransPayment::where('tenant_id',$request->tenant_id)
            ->where('building_id',$request->building_id)->orderBy('id','desc')->get()->toArray();

        $dispute_amount = DisputeBillDetail::where('trans_bill_generate_id',$bill->id)->get()->toArray();

         return view('admin.rc_department.generate_receipt_tenant', compact('bill','receipt_data','dispute_amount'));
    }

    public function payment_receipt_society(Request $request){
    //   echo '<pre>';
//       print_r($request->bill_no);exit;
        if($request->bill_no){
            
//           $Tenant_bill_id = DB::table('building_tenant_bill_association')->where('id', '=', $request->bill_no)->first();
//           $bill_ids =  explode(',',$Tenant_bill_id->bill_id);
//           //dd($bill_ids[0]);


            $receipt = TransPayment::with('dd_details')->with('bill_details')
               ->where('bill_no', $request->bill_no)
               ->where('building_id', '=', $request->building_id)
               ->where('society_id', '=', $request->society_id)
                ->orderBy('id','desc')
               ->get();

            if(date('m',strtotime($request->from_date)) < 4 ) {
                $year = date('Y',strtotime($request->from_date)) -1;
            } else {
                $year = date('Y',strtotime($request->from_date));
            }
            $number_of_tenants = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();

            $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$year)->first();
            
            $totalServiceCharge = ($serviceChargesRate->water_charges+$serviceChargesRate->pump_man_and_repair_charges+$serviceChargesRate->external_expender_charge+$serviceChargesRate->na_assessment+$serviceChargesRate->other+$serviceChargesRate->lease_rent+$serviceChargesRate->administrative_charge+$serviceChargesRate->electric_city_charge)*$number_of_tenants->tenant_count()->first()->count;
            
//            if(count($receipt->toArray()) <= 0 ){
                //dd($bill_ids);
//            $bill = TransBillGenerate::where('status', '!=', 'paid')
////                ->where('bill_no', $request->bill_no)
//                ->where('building_id', '=', $request->building_id)
//                ->where('society_id', '=', $request->society_id)
//                ->get();

            $currentMonth = date('m');
            if($currentMonth < 4) {
                if($currentMonth == 1) {
                    $data1['month'] = 12;
                    $data1['year'] = date('Y') -1;
                } else {
                    $data1['month'] = date('m') -1;
                    $data1['year'] = date('Y') -1;
                }
            } else {
                $data1['month'] = date('m') - 1;
                $data1['year'] = date('Y');
            }


            $bill = TransBillGenerate::where('building_id',$request->building_id)
                ->where('society_id',$request->society_id)
                ->where('bill_month', '=',  $data1['month'])
                ->where('bill_year', '=', $data1['year'])
                ->orderBy('id','desc')
                ->get();

//            dd($bill);

            //dd($request->cash_amount);
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
                
//                if( $amount_paid < $totalServiceCharge) {
//                    return redirect()->back()->with('warning', 'You need to pay atleast basic service charges.');
//                }
                
                foreach ($bill as $key => $value) {
                   // dump( $value->tenant_id);
                    // if(in_array( $value->tenant_id, $request->except_tenaments) && $value->tenant_id!=null){
                    //     dd('in if loop');
                    //   $Akey = array_search($value->tenant_id, $request->except_tenaments);
                    //     $paid_amt = $request->tenant_credit_amt[$Akey];
                    //     //dd($value->total_bill);
                    //     // dd($paid_amt);
                    //       //dd($value->arrear_id);
                    //       if($value->arrear_id != ''){
                    //       $ids = explode(',', $value->arrear_id);
                    //         $tenant_arrear = ArrearCalculation::whereIn('id', $ids)->get();
                    //         if(count($tenant_arrear) > 0){
                    //           foreach ($tenant_arrear as $key => $value2) {
                    //             if($value2->total_amount < $paid_amt){
                    //               $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                    //               $paid_amt -= $value2->total_amount;
                    //             } else {                              

                    //             }
                    //           }
                    //         }
                    //        // dd($tenant_arrear);
                    //        // $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                    //       }

                    //       if($paid_amt > $value->total_bill){
                    //         $credit_amt = $paid_amt - $value->total_bill;
                    //         $balance = 0;

                    //         $credit = MasterTenant::where('id', $value->tenant_id)->first();                       
                    //         if(is_null($credit->credit)){
                    //           $credit->credit = $credit_amt;
                    //         } else {
                    //           $credit->credit = $credit->credit + $credit_amt;
                    //         }   
                    //         $credit->save(); 

                    //         $bill_status = TransBillGenerate::find($value->id)->update(array('status' => 'Paid','credit_amount'=>$credit->credit)); 
                    //         //dd($credit);

                    //       } else {
                    //         $balance = 0;
                    //         $credit_amt = 0;
                    //         if($value->total_bill > $request->tenant_credit_amt[$Akey]) {
                                
                    //             $balance = $value->total_bill - $request->tenant_credit_amt[$Akey];
                    //             $value->balance_amount = $balance;
                    //         } elseif($value->total_bill < $request->tenant_credit_amt[$Akey]) {
                                
                    //             $credit_amt = $request->tenant_credit_amt[$Akey] - $value->total_bill ;    
                    //             $value->credit_amount = $credit_amt;
                    //         } else {
                    //             $credit_amt = 0;
                    //         }
                    //         // $balance = $value->total_bill - $paid_amt;
                    //       }
                    //       $value->balance_amount = $balance;
                    //       $value->save();

                    //     $data[] =  [
                    //             'bill_no'    => $value->id,
                    //             'tenant_id'  => $value->tenant_id,
                    //             'building_id'    => $value->building_id,
                    //             'society_id'     => $value->society_id,
                    //             'paid_by'    => $request->amount_paid_by,
                    //             'dd_id'    => $dd,
                    //             'mode_of_payment' => $request->payment_mode,
                    //             'bill_amount' => $value->total_bill,
                    //             'amount_paid' => $request->tenant_credit_amt[$Akey],
                    //             'from_date' => $request->from_date,
                    //             'to_date' => $request->to_date,
                    //             'balance_amount' => $balance,
                    //             'credit_amount' => $credit_amt,
                    //           ]; 
                    //     //dd($data);

                    // } else {
                        //dd('in else loop');
                        
                      $data[] =  [
                                'bill_no'    => $value->id,
                                'tenant_id'  => $value->tenant_id,
                                'building_id'    => $value->building_id,
                                'society_id'     => $value->society_id,
                                'paid_by'    => $request->amount_paid_by,
                                'dd_id'    => $dd,
                                'mode_of_payment' => $request->payment_mode,
                                'bill_amount' => $value->total_bill,
                                'amount_paid' => $amount_paid,
                                'from_date' => $request->from_date,
                                'to_date' => $request->to_date,
                                'balance_amount' => $request->balance_amount,
                                'credit_amount' => $request->credit_amount,
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')  
                            ];   
                             
                        $ids = explode(',', $value->arrear_id);
                        //dd($data);
                        $update = ArrearCalculation::whereIn('id', $ids)->update(['payment_status' => 1]);
                        $bill_status = TransBillGenerate::find($value->id)->update(array('status' => 'Paid')); 

                   // }            
                }
//                dd($data);
                // print_r($data);exit;
                $bill_data = TransPayment::insert($data);
                //dd($bill);
                $bill_status = TransBillGenerate::find($request->bill_no);
                if($bill_status->service_charge_balance<=$amount_paid)
                {
                    
                    $amount_paid=$amount_paid-ceil($bill_status->service_charge_balance);
                    $bill_status->service_charge_balance=0;
                    if($amount_paid>0)
                    {   
                        if($amount_paid>=ceil($bill_status->arrear_balance))
                        {
                            
                            $amount_paid=$amount_paid-ceil($bill_status->arrear_balance);
                            $bill_status->arrear_balance=0;
                            if($amount_paid>$bill_status->arrear_interest_balance)
                            {
                                $amount_paid=$amount_paid-ceil($bill_status->arrear_interest_balance);
                                $bill_status->arrear_interest_balance=0;
                            }else
                            {
                                $bill_status->arrear_interest_balance=ceil($bill_status->arrear_interest_balance)-$amount_paid;
                                $amount_paid=0;
                            }
                        }else
                        {
                            $bill_status->arrear_balance=$amount_paid-ceil($bill_status->arrear_balance);
                            $amount_paid=0;
                        }
                    }else
                    {
                        $bill_status->arrear_balance=ceil($bill_status->arrear_balance)-$amount_paid;
                        $amount_paid=0;
                    }
                }else
                {
                    $bill_status->service_charge_balance=ceil($bill_status->service_charge_balance)-$amount_paid;
                    $amount_paid=0;
                }
                $bill_status->status = 'paid';
                $bill_status->balance_amount = $request->balance_amount;
                $bill_status->credit_amount = $request->credit_amount;
                $bill_status->save();

                $receipt = TransPayment::with('dd_details')
                    ->with('bill_details')
                    ->where('bill_no', $request->bill_no)
                    ->where('building_id', '=', $request->building_id)
                    ->where('society_id', '=', $request->society_id)->get();

                //dd($receipt);
                $data['bill_amount'] = 0;
                $data['amount_paid'] = 0;
                $data['balance_amount'] = 0;
                $data['credit_amount'] = 0;
                foreach ($receipt as $key => $value) {
                  $value->id = $request->bill_no;   
                  $data['bill_amount'] += $value->bill_amount;
                  $data['amount_paid'] += $value->amount_paid;    
                  $data['credit_amount'] += $value->credit_amount;    
                  $data['balance_amount'] += $value->balance_amount;
                }

                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society']  = SocietyDetail::find($data['building']->society_id);
//                if(isset($request->except_tenaments)){
//                    $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->whereIn('id', $request->except_tenaments)->get();
//                }
                $data['bill'] = $receipt;
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
                $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
                //dd($data['number_of_tenants']->tenant_count()->first());
                if(!$data['number_of_tenants']->tenant_count()->first()) {
                    return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
                }

//                $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
//                return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');

//            } else {
//
//
//              $receipt1 = TransPayment::with('dd_details')->with(array('bill_details'=>function($query){
//                             $query->where('status', '=' ,'paid');
//                          }))
//                  ->where('bill_no', $request->bill_no)
//                  ->where('building_id', '=', $request->building_id)
//                  ->where('society_id', '=', $request->society_id)
//                  ->get();
//
//                //dd($receipt);
//                $data['bill_amount'] = 0;
//                $data['amount_paid'] = 0;
//                $data['balance_amount'] = 0;
//                $data['credit_amount'] = 0;
//                foreach ($receipt as $key => $value) {
//                  $value->id = $request->bill_no;
//                  $data['bill_amount'] += $value->bill_amount;
//                  $data['amount_paid'] += $value->amount_paid;
//                  $data['credit_amount'] += $value->credit_amount;
//                  $data['balance_amount'] += $value->balance_amount;
//                }
//
//                $data['building'] = MasterBuilding::find($request->building_id);
//                $data['society'] = SocietyDetail::find($data['building']->society_id);
//
//                $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->get();
//
//                $data['bill'] = $receipt;
//
//                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
//                 $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
//                //dd($data);
//                 //dd($data['number_of_tenants']->tenant_count()->first());
//                if(!$data['number_of_tenants']->tenant_count()->first()) {
//                    return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
//                }
//
////                $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
////                return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');
//            }



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

            $receipt_data = TransPayment::where('tenant_id',$request->tenant_id)
                ->where('building_id',$request->building_id)->get()->toArray();



//            dd($bill);
            return redirect()->back()->with(['bill' => $bill ,
                'receipt_data'=> $receipt_data,
                'tenament' => $tenament,
                'buildings' =>$buildings,
                'data' => $data,
                'building_detail' => $building_detail,
                'society_detail' => $society_detail,
            ] );

//            return view('admin.rc_department.generate_receipt_society', compact('receipt_data','bill','tenament', 'buildings', 'data', 'Tenant_bill_id', 'building_detail', 'society_detail'));




        } else {
           return redirect()->back()->with('warning', 'Invalid Bill Data.');
        }

    }

    public function payment_receipt_tenant(Request $request){
        
//     dd($request->all());

        if($request->bill_no){
            
            $receipt = TransPayment::with('dd_details')->with('bill_details')
                ->where('bill_no', '=', $request->bill_no)
                ->first();
            if(date('m',strtotime($request->from_date)) < 4 ) {
                $year = date('Y',strtotime($request->from_date)) -1;
            } else {
                $year = date('Y',strtotime($request->from_date));
            }
            $serviceChargesRate = ServiceChargesRate::where('building_id',$request->building_id)
                ->where('society_id',$request->society_id)->where('year',$year)
                ->first();

//dd($serviceChargesRate);

                if($serviceChargesRate != null){

                    $totalServiceCharge = $serviceChargesRate->water_charges+$serviceChargesRate->pump_man_and_repair_charges+$serviceChargesRate->external_expender_charge+$serviceChargesRate->na_assessment+$serviceChargesRate->other+$serviceChargesRate->lease_rent+$serviceChargesRate->administrative_charge+$serviceChargesRate->electric_city_charge;
                }

//            dd($totalServiceCharge);
//            if(!$receipt){

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

                $bill_status = TransBillGenerate::find($request->bill_no);
                
//                if( $amount_paid < $totalServiceCharge) {
//                    return redirect()->back()->with('warning', 'You need to pay atleast basic service charges.');
//                }
                
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
                    if($bill_status->service_charge_balance<=$amount_paid)
                    {
                        
                        $amount_paid=$amount_paid-ceil($bill_status->service_charge_balance);
                        $bill_status->service_charge_balance=0;
                        if($amount_paid>0)
                        {   
                            if($amount_paid>=ceil($bill_status->arrear_balance))
                            {
                                
                                $amount_paid=$amount_paid-ceil($bill_status->arrear_balance);
                                $bill_status->arrear_balance=0;
                                if($amount_paid>$bill_status->arrear_interest_balance)
                                {
                                    $amount_paid=$amount_paid-ceil($bill_status->arrear_interest_balance);
                                    $bill_status->arrear_interest_balance=0;
                                }else
                                {
                                    $bill_status->arrear_interest_balance=ceil($bill_status->arrear_interest_balance)-$amount_paid;
                                    $amount_paid=0;
                                }
                            }else
                            {
                                $bill_status->arrear_balance=$amount_paid-ceil($bill_status->arrear_balance);
                                $amount_paid=0;
                            }
                        }else
                        {
                            $bill_status->arrear_balance=ceil($bill_status->arrear_balance)-$amount_paid;
                            $amount_paid=0;
                        }
                    }else
                    {
                        $bill_status->service_charge_balance=ceil($bill_status->service_charge_balance)-$amount_paid;
                        $amount_paid=0;
                    }
                    $bill_status->status = 'paid';
                    $bill_status->balance_amount = $request->balance_amount;
                    $bill_status->credit_amount = $request->credit_amount;
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


//                $pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
//                       return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');

//            } else {
//                $data['building'] = MasterBuilding::find($request->building_id);
//                $data['society'] = SocietyDetail::find($data['building']->society_id);
//                $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();
//                $data['bill'] = $receipt;
//                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);
//
////                $receipt_data = TransPayment::where('tenant_id',$request->tenant_id)
////                    ->where('building_id',$request->building_id)->get();
//
////                $pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
////                       return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');
////                return redirect()->back()->with('warning', 'Bill Already Paid.');
//            }

            $bill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                ->where('building_id', '=', $request->building_id)
                //    ->where('bill_month', '=',  $data['month'])
                //    ->where('bill_year', '=', $data['year'])
                ->with('tenant_detail')
                ->with('building_detail')
                ->with('society_detail')
                ->orderBy('id','desc')
                ->first();

            $receipt_data = TransPayment::where('tenant_id',$request->tenant_id)
                ->where('building_id',$request->building_id)->get();

            return redirect()->back()->with(['bill' => $bill , 'receipt_data'=> $receipt_data ] );


//            return view('admin.rc_department.generate_receipt_tenant', compact('bill' , 'receipt_data'));

        } else {
           return redirect()->back()->with('warning', 'Invalid Bill Data.');
        }

    }

    public function view_bill_building(Request $request,$is_download=false){

        if($request->has('building_id') && '' != $request->building_id) {

            $data['month'] = date('m');
            $data['year'] = date('Y');

            $currentMonth = date('m');
            $bill_year = date('Y');
            //dd($request->month);
            if($request->has('month') && '' != $request->month) {
                $data['month'] = $request->month;
            }
            elseif($currentMonth < 4) {
                if($currentMonth == 1) {
                    $data['month'] = 12;
                    $data['year'] = date('Y') -1;
                    $bill_year = date('Y')-1;
                } else {
                    $data['month'] = date('m') -1;
                    $data['year'] = date('Y') -1;
                }
            } else {
                $data['month'] = date('m');
                $data['year'] = date('Y');
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
            //dump($request->building_id." ".$data['year']." ".$data['month']);
            //$data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('year',$bill_year)->where('payment_status','0')->get();            //dd($data['arreasCalculation']);
        
            $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
            //dd($data['number_of_tenants']->tenant_count()->first());
            if(!$data['number_of_tenants']->tenant_count()->first()) {
                return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
            }
            
            if($data['month'] != 1) {
                $lastBillMonth = $data['month'] -1;
            } else {
                $lastBillMonth = $data['month'];
            }
            $data['lastBill'] = TransBillGenerate::where('building_id', '=', $request->building_id)
                                    //->where('society_id', '=', $request->building_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $data['year'])
                                    ->orderBy('id','DESC')
                                    ->first();
            $data['currentBill'] = TransBillGenerate::with(['service_charges'])->where('building_id', '=', $request->building_id)
                                    ->where('bill_month', '=',$data['month'])
                                    ->where('bill_year', '=', $bill_year)
                                    ->orderBy('id','DESC')
                                    ->first();
            //dd($data['currentBill']);
            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->where('year',$data['currentBill']->bill_year)->where('month',(int)$data['currentBill']->bill_month)->orderby('year','month')->get();
            $data['association'] = DB::table('building_tenant_bill_association')->where('building_id',$request->building_id)->where('bill_year',$bill_year)->where('bill_month',$data['month'])->first();

            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
            if(true == $is_download) {
              // return view('admin.rc_department.download_building_bill', $data);
              $pdf = PDF::loadView('admin.rc_department.download_building_bill', $data);
              // print_r($pdf);exit;
              return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');
            } else {
              return view('admin.rc_department.view_bill_building',$data);
            }
        }   
    }

     public function view_bill_tenant(Request $request,$is_download=false){
            //dd('ok');
          if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $request->building_id = decrypt($request->building_id);
            $request->tenant_id = decrypt($request->tenant_id);

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $currentMonth = date('m');
            $bill_year = date('Y');

            if($request->has('month') && '' != $request->month) {
                $data['month'] = $request->month;
            }
            elseif($currentMonth < 4) {
                if($currentMonth == 1) {
                    $data['month'] = 12;
                    $data['year'] = date('Y') -1;
                    $bill_year = date('Y')-1;
                } else {
                    $data['month'] = date('m') -1;
                    $data['year'] = date('Y') -1;
                }
            } else {
                $data['month'] = date('m');
                $data['year'] = date('Y');
            }

            // print_r($data['month']);exit;
            // $data['month'] = date('m');
            // $data['year'] = date('Y');

            // if($request->has('month') && !empty($request->month)) {
            //     $data['month'] = $request->month;
            // }

            if($request->has('year') && !empty($request->year)) {
              $data['year'] = $request->year;
            }

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$data['year'])->first();

            if(!$data['serviceChargesRate']){
                //dd($data);
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            if($request->has('month') && '' != $request->month) {
                $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('tenant_id',$request->tenant_id)->where('year',$bill_year)->where('month','<=',$data['month'])->where('payment_status','0')->get();
            } else {
                $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('tenant_id',$request->tenant_id)->where('year',$bill_year)->where('payment_status','0')->get();
            }
            

            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);
            $data['is_download'] = $is_download;


            if($data['month'] != 1) {
                $lastBillMonth = $data['month'] -1;
            } else {
                $lastBillMonth = $data['month'];
            }
            $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $data['year'])
                                    ->orderBy('id','DESC')
                                    ->first();
            $data['currentBill'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=',$data['month'])
                                    ->where('bill_year', '=', $bill_year)
                                    ->orderBy('id','DESC')
                                    ->first();

            // echo '<pre>';
            // print_r($data['currentBill']);exit;
            if(true == $is_download) {
                // return view('admin.rc_department.download_tenant_bill', $data);
              $pdf = PDF::loadView('admin.rc_department.download_tenant_bill', $data);
              return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');
            } else {
                return view('admin.rc_department.view_bill_tenant',$data);
            }
        }

     }

     public function downloadBill(Request $request) {
         //dd($request->all());
         if($request->has('building_id') && '' != $request->building_id) {
          
          $data['building'] = MasterBuilding::find(decrypt($request->building_id));
          $data['society'] = SocietyDetail::find($data['building']->society_id);

          if($request->has('tenant_id') && !empty($request->tenant_id)) {

            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',decrypt($request->tenant_id))->first();
            
            if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
                $request->building_id = decrypt($request->building_id);
                $request->tenant_id = decrypt($request->tenant_id);

                $data['building'] = MasterBuilding::find($request->building_id);
                $data['society'] = SocietyDetail::find($data['building']->society_id);
                $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

                $data['TransBillGenerate'] = TransBillGenerate::find($request->id);
                
                if($request->has('year') && !empty($request->year)) {
                  $data['year'] = $request->year;
                }

                if($request->has('month') && '' != $request->month) {
                    
                    $data['month'] = $request->month;
                    if($request->month < 4 ) {
                        $data['year'] = date('Y') -1;
                    } else {
                        $data['year'] = date('Y');
                    }
                } else {
                    $data['month'] = date('m');
                    $data['year'] = date('Y');
                }

                if($data['month'] == 1) {
                    $lastBillMonth = 12;
                    $lastBillYear=$data['year']-1;
                } else {
                    $lastBillMonth = $data['month']-1;
                    $lastBillYear=$data['year'];
                }
               // dd($lastBillYear." ".$lastBillMonth);
                $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $lastBillYear)
                                    ->orderBy('id','DESC')
                                    ->first();
                //dd($data['lastBill']);
                $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$data['year'])->first();

                if(!$data['serviceChargesRate']){
                    //dd($data);
                    return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
                }

                $data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$request->tenant_id)->get();
                $arrear_balance=$arrear_interest_balance=0;
                if(count($data['arreasCalculation'])>0)
                {
                    foreach($data['arreasCalculation'] as $arreasCalculation)
                    {
                        $arrear_balance+=($arreasCalculation->total_amount - $arreasCalculation->old_intrest_amount -
                                    $arreasCalculation->difference_intrest_amount);
                        $arrear_interest_balance+=($arreasCalculation->old_intrest_amount +
                            $arreasCalculation->difference_intrest_amount);
                    }
                }
                
                //dd($data['arreasCalculation']);
                $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);
//                $pdf = PDF::loadView('admin.rc_department.download_tenant_bill', $data);
//                return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');
                
                $fileName = 'bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf';

                $mpdf = new Mpdf();
                $mpdf->autoScriptToLang = true;
                $mpdf->autoLangToFont = true;
                $contents = view('admin.rc_department.download_tenant_bill', compact('data'));
                $mpdf->WriteHTML($contents);
                $mpdf->Output($fileName,'D');
            
            
            }
            // $this->view_bill_tenant($request,true);
          } else {
            // $this->view_bill_building($request,true);
            
                if($request->has('building_id') && '' != $request->building_id) {

                    $data['month'] = date('m');
                    $data['year'] = date('Y');

                    if($request->has('year') && !empty($request->year)) {
                      $data['year'] = $request->year;
                    }

                    $bill_year = date('Y');
                    if($request->has('month') && '' != $request->month) {
                            
                        $data['month'] = $request->month;
                        if($request->month < 4 ) {
                            $data['year'] = date('Y') -1;
                        } else {
                            $data['year'] = date('Y');
                        }
                    } else {
                        $data['month'] = date('m');
                        $data['year'] = date('Y');
                    }
                    

                    $request->building_id = decrypt($request->building_id);
                    $data['building'] = MasterBuilding::find($request->building_id);
                    $data['society'] = SocietyDetail::find($data['building']->society_id);
                    $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$data['year'])->first();

                 //  dd($data['serviceChargesRate']); 
                    if(!$data['serviceChargesRate']){
                        return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
                    }
                    
                    $data['Tenant_bill_id'] = DB::table('building_tenant_bill_association')->where('building_id', '=', $request->building_id)->where('bill_month', '=',  $data['month'])->where('bill_year', '=', $bill_year)->orderBy('id','DESC')->first();

                    $bill_ids = '';
                    if($data['Tenant_bill_id']) {
                        $bill_ids = $data['Tenant_bill_id']->bill_id;
                    }
                    $data['TransBillGenerate'] = TransBillGenerate::selectRaw('sum(total_bill)as total_bill_temp,sum(arrear_bill) as arrear_bill_temp,sum(`total_service_after_due`) as `total_service_after_due_temp`,sum(`late_fee_charge`) as `late_fee_charge_temp`, sum(`total_bill_after_due_date`) as `total_bill_after_due_date_temp`, sum(`balance_amount`) as `balance_amount_temp`, sum(credit_amount) as credit_amount_temp,sum(monthly_bill) as monthly_bill_temp,trans_bill_generate.*')->whereIn('id',explode(',',$bill_ids))->first();

                    //  echo '<pre>';
                    // print_r($data['TransBillGenerate']);exit;
                    
                    $data['arrear_ids'] = TransBillGenerate::whereIn('id',explode(',', $bill_ids))->pluck('arrear_id')->toArray();
                    

                    $data['arrear_ids_temp'] = [];
                    if($data['arrear_ids']) {
                        foreach($data['arrear_ids'] as $arrear_id) {
                            if (strpos($arrear_id, ',') !== false) { 
                                $explode_ids = explode(',', $arrear_id);
                                foreach($explode_ids as $id) {
                                    $data['arrear_ids_temp'][] = $id;
                                }
                            } else {
                                $data['arrear_ids_temp'][] = $arrear_id;
                            }
                        }
                    }
                    $data['arreasCalculation'] = ArrearCalculation::whereIn('id',$data['arrear_ids_temp'])->get();
                    
                    $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
                 //dd($data['number_of_tenants']->tenant_count()->first());
                    if(!$data['number_of_tenants']->tenant_count()->first()) {
                        return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
                    }

                   // $data['TransBillGenerate'] = TransBillGenerate::find($request->id);

                    if($request->has('year') && !empty($request->year)) {
                    $data['year'] = $request->year;
                    }

                    if($request->has('month') && '' != $request->month) {
                        
                        $data['month'] = $request->month;
                        if($request->month < 4 ) {
                            $data['year'] = date('Y') -1;
                        } else {
                            $data['year'] = date('Y');
                        }
                    } else {
                        $data['month'] = date('m');
                        $data['year'] = date('Y');
                    }

                    if($data['month'] == 1) {
                        $lastBillMonth = 12;
                        $lastBillYear=$data['year']-1;
                    } else {
                        $lastBillMonth = $data['month']-1;
                        $lastBillYear=$data['year'];
                    }
                // dd($lastBillYear." ".$lastBillMonth);
                    $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                        ->where('bill_month', '=', $lastBillMonth)
                                        ->where('bill_year', '=', $lastBillYear)
                                        ->orderBy('id','DESC')
                                        ->first();
                    //dd($data['lastBill']);
                    $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
                      
//                    $pdf = PDF::loadView('admin.rc_department.download_building_bill', $data);
//
//                    return $pdf->download('bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf');

                    $fileName = 'bill_'.$data['building']->name.'_'.$data['building']->building_no.'.pdf';

                    $mpdf = new Mpdf();
                    $mpdf->autoScriptToLang = true;
                    $mpdf->autoLangToFont = true;
                    $contents = view('admin.rc_department.download_building_bill', compact('data'));
                    $mpdf->WriteHTML($contents);
                    $mpdf->Output($fileName,'D');



                }
          }
        }
     }

     public function get_building_select_updated_RC(Request $request){
    
        if($request->input('id')){
            $society = SocietyDetail::find(decrypt($request->input('id')));
            if(Config::get('commanConfig.SOCIETY_LEVEL_BILLING') == $society->society_bill_level) {
                
                $html ='<div class="form-group m-form__group ">
                            Billing Level : Society Level Biiling
                        </div>';
            $society_id = decrypt($request->input('id'));
            $buildings = MasterBuilding::with(['TransBillGenerate'=>function($query) use($society_id){
                $query->where('society_id', '=', $society_id)->where('bill_month', '=', date('m'))->where('bill_year', '=', date('Y'));
            }])->with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            // return $buildings;

            //  $html .= view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'))->render();
             return $html;

            } else {
                
                $building = MasterBuilding::where('society_id', '=', decrypt($request->input('id')))->get();
                $html = '<div class="form-group m-form__group ">Billing Level : Tenant Level Biiling</div>
                        <div class="row align-items-center"><div class="col-md-4"><div class="form-group m-form__group">
                            <select required class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" style="opacity:1" id="building" name="building">';
                            $html .= '<option value="" style="font-weight: normal;">Select Building</option>';
                                foreach($building as $key => $value){
                                    $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
                                }   
                            $html .= '</select>
                        </div></div></div>';
                return $html;
            }
        }
    }

     public function downloadReceipt(Request $request) {
         //dd('ok');
//         dd($request->flag);
        if($request->has('building_id') && '' != $request->building_id) {
          $request->building_id = decrypt($request->building_id);
          $request->bill_no = decrypt($request->bill_no);
          if($request->has('tenant_id') && !empty($request->tenant_id)) {
            $request->tenant_id = decrypt($request->tenant_id);
            if($request->flag) {
                $data = $this->downloadReceiptTenant($request);
                return view('admin.rc_department.view_payment_receipt_tenant',$data);
            } else {
                $this->downloadReceiptTenant($request);
            }
          } else {
             if($request->flag) {
                 $data = $this->downloadReceiptSociety($request);
                return view('admin.rc_department.view_payment_receipt_tenant',$data);
             } else {
                $this->downloadReceiptSociety($request);
             }
          }
        } 
     }


     public function downloadReceiptSociety(Request $request) {
//       print_r($request->bill_no);exit;

//         dd($request->bill_no);
        // $Tenant_bill_id = DB::table('building_tenant_bill_association')->where('id', '=', $request->bill_no)->first();
        $bill_ids =  explode(',',$request->bill_no); 

//        dd($bill_ids);
        $data['building'] = MasterBuilding::find($request->building_id);
        $data['society']  = SocietyDetail::find($data['building']->society_id);

//        $receipt = TransPayment::with('dd_details')->with('bill_details')
//            ->where('id', $request->bill_no)
//            ->where('building_id', '=', $request->building_id)
//            ->where('society_id', '=', $data['building']->society_id)
//            ->orderBy('id','desc')
//            ->get();

         $receipt = TransPayment::with('dd_details')->with('bill_details')
             ->whereIn('bill_no', $bill_ids)
             ->where('building_id', '=', $request->building_id)
             ->where('society_id', '=', $data['building']
                 ->society_id)
             ->get();


         //dd($receipt);
        $data['bill_amount'] = 0;
        $data['amount_paid'] = 0;
        $data['credit_amount'] = 0;
        $data['balance_amount'] = 0;
        foreach ($receipt as $key => $value) {
          $value->id = $request->bill_no;   
          $data['bill_amount'] += $value->bill_amount;
          $data['amount_paid'] += $value->amount_paid; 
          $data['credit_amount'] += $value->credit_amount;    
          $data['balance_amount'] += $value->balance_amount;   
        }
        $transexcept_tenaments = TransBillGenerate::whereIn('id',$bill_ids)->get();
        $except_tenaments = [];
        if(count($transexcept_tenaments)) {
            foreach($transexcept_tenaments as $transTenant) {
                if($transTenant->total_bill != $transTenant->balance_amount) {
                    $except_tenaments[] = $transTenant->tenant_id;
                }
            }
        }
        

        $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->whereIn('id', $except_tenaments)->get();

        $data['bill'] = $receipt;
        // echo '<pre>';
        // print_r($data['bill']);exit;
        $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
        $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
        //dd($data['number_of_tenants']->tenant_count()->first());
        if(!$data['number_of_tenants']->tenant_count()->first()) {
            return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
        }

//        dd($data);
        if($request->flag) {
            return $data; 
        } else {
//            dd($data);
           // $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
           $content=view('admin.rc_department.payment_receipt_society', $data);
                
            $fileName='payment_receipt_society'.date('YmdHis').'.pdf';
            $pdf=new Mpdf([
                'default_font_size' => 9,
                'default_font' => 'Times New Roman'
            ]);
            $pdf->autoScriptToLang = true;
            $pdf->autoLangToFont = true;
            $pdf->setAutoBottomMargin = 'stretch';
            $pdf->setAutoTopMargin = 'stretch';
            $pdf->WriteHTML($content);
            return $pdf->Output($fileName, 'D');
           // return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');
        }
     }


     public function downloadReceiptTenant(Request $request) {
//         dd($request->bill_no);
        if($request->bill_no){
//            $receipt = TransPayment::with('dd_details')
//                ->with('bill_details')
//                ->where('id', '=', $request->bill_no)
//                ->where('tenant_id',$request->tenant_id)
//                ->orderBy('id','desc')
//                ->first();

            $receipt = TransPayment::with('dd_details')
                ->with('bill_details')
                ->where('id', '=', $request->bill_no)
                ->first();

//            dd($receipt);
            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();
            $data['bill'] = $receipt;
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

//            dd($data);
//            dd($data['bill']['bill_details']);
             if($request->flag!=null) {
                 
                return  $data;
            } else {
                // dd('ok');
                //$pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
//                 dd($data);
                $content=view('admin.rc_department.payment_receipt_tenant', $data);
                
                $fileName='payment_receipt_tenant'.date('YmdHis').'.pdf';
                $pdf=new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman'
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->WriteHTML($content);
                return $pdf->Output($fileName, 'D');
                //dd($pdf);
                //return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');
            }
        }
     }


    public function downloadGeneratedReceipt(Request $request) {
            //dd('ok');
    //         dd($request->flag);
            if($request->has('building_id') && '' != $request->building_id) {
                $request->building_id = decrypt($request->building_id);
                $request->bill_no = decrypt($request->bill_no);
                if($request->has('tenant_id') && !empty($request->tenant_id)) {
                    $request->tenant_id = decrypt($request->tenant_id);
                    if($request->flag) {
                        $data = $this->downloadGeneratedReceiptTenant($request);
                        return view('admin.rc_department.view_payment_receipt_tenant',$data);
                    } else {
                        $this->downloadGeneratedReceiptTenant($request);
                    }
                } else {
                    if($request->flag) {
                        $data = $this->downloadGeneratedReceiptSociety($request);
                        return view('admin.rc_department.view_payment_receipt_tenant',$data);
                    } else {
                        $this->downloadGeneratedReceiptSociety($request);
                    }
                }
            }
        }

    public function downloadGeneratedReceiptSociety(Request $request) {

        $bill_ids =  explode(',',$request->bill_no);

        $data['building'] = MasterBuilding::find($request->building_id);
        $data['society']  = SocietyDetail::find($data['building']->society_id);

        $receipt = TransPayment::with('dd_details')->with('bill_details')
            ->where('id', $request->bill_no)
            ->where('building_id', '=', $request->building_id)
            ->where('society_id', '=', $data['building']->society_id)
            ->orderBy('id','desc')
            ->get();

        $data['bill_amount'] = 0;
        $data['amount_paid'] = 0;
        $data['credit_amount'] = 0;
        $data['balance_amount'] = 0;
        foreach ($receipt as $key => $value) {
            $value->id = $request->bill_no;
            $data['bill_amount'] += $value->bill_amount;
            $data['amount_paid'] += $value->amount_paid;
            $data['credit_amount'] += $value->credit_amount;
            $data['balance_amount'] += $value->balance_amount;
        }
        $transexcept_tenaments = TransBillGenerate::whereIn('id',$bill_ids)->get();
        $except_tenaments = [];
        if(count($transexcept_tenaments)) {
            foreach($transexcept_tenaments as $transTenant) {
                if($transTenant->total_bill != $transTenant->balance_amount) {
                    $except_tenaments[] = $transTenant->tenant_id;
                }
            }
        }


        $data['tenants'] = MasterTenant::where('building_id',$request->building_id)->whereIn('id', $except_tenaments)->get();

        $data['bill'] = $receipt;
        // echo '<pre>';
        // print_r($data['bill']);exit;
        $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);
        $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
        //dd($data['number_of_tenants']->tenant_count()->first());
        if(!$data['number_of_tenants']->tenant_count()->first()) {
            return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
        }

//        dd($data);
        if($request->flag) {
            return $data;
        } else {
//            dd($data);
            // $pdf = PDF::loadView('admin.rc_department.payment_receipt_society', $data);
            $content=view('admin.rc_department.payment_receipt_society', $data);

            $fileName='payment_receipt_society'.date('YmdHis').'.pdf';
            $pdf=new Mpdf([
                'default_font_size' => 9,
                'default_font' => 'Times New Roman'
            ]);
            $pdf->autoScriptToLang = true;
            $pdf->autoLangToFont = true;
            $pdf->setAutoBottomMargin = 'stretch';
            $pdf->setAutoTopMargin = 'stretch';
            $pdf->WriteHTML($content);
            return $pdf->Output($fileName, 'D');
            // return $pdf->download('payment_receipt_society'.date('YmdHis').'.pdf');
        }
    }

    public function downloadGeneratedReceiptTenant(Request $request) {
        if($request->bill_no){
            $receipt = TransPayment::with('dd_details')
                ->with('bill_details')
                ->where('id', '=', $request->bill_no)
                ->where('tenant_id',$request->tenant_id)
                ->orderBy('id','desc')
                ->first();

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();
            $data['bill'] = $receipt;
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

//            dd($data);
//            dd($data['bill']['bill_details']);
            if($request->flag!=null) {

                return  $data;
            } else {
                // dd('ok');
                //$pdf = PDF::loadView('admin.rc_department.payment_receipt_tenant', $data);
//                 dd($data);
                $content=view('admin.rc_department.payment_receipt_tenant', $data);

                $fileName='payment_receipt_tenant'.date('YmdHis').'.pdf';
                $pdf=new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman'
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->WriteHTML($content);
                return $pdf->Output($fileName, 'D');
                //dd($pdf);
                //return $pdf->download('payment_receipt_tenant'.date('YmdHis').'.pdf');
            }
        }
    }


     public function dispute_amount_tenant(Request $request){

//         dd('dispute_amount_tenant');

         $request->tenant_id = decrypt($request->tenant_id);
         $request->building_id = decrypt($request->building_id);

         $currentMonth = date('m');
         if($currentMonth < 4) {
             if($currentMonth == 1) {
                 $data['month'] = 12;
                 $data['year'] = date('Y') -1;
             } else {
                 $data['month'] = date('m') -1;
                 $data['year'] = date('Y');
             }
         } else {
             $data['month'] = date('m');
             $data['year'] = date('Y');
         }
         // dd($request->tenant_id." ". $request->building_id);
         $bill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
             ->where('building_id', '=', $request->building_id)
             //    ->where('bill_month', '=',  $data['month'])
             //    ->where('bill_year', '=', $data['year'])
             ->with('tenant_detail')
             ->with('building_detail')
             ->with('society_detail')
             ->orderBy('id','desc')
             ->first();

         if(empty($bill) || is_null($bill)){
             return redirect()->back()->with('warning', 'Receipt Generation is not done for user.');
         }

         $dispute_data = DisputeBillDetail::where('trans_bill_generate_id', $bill->id)->get()->toArray();

         return view('admin.rc_department.dispute_amount_tenant', compact('bill','dispute_data'));


     }

     public function dispute_amount_society(Request $request){

         $request->building_id = decrypt($request->building_id);
         $request->society_id = decrypt($request->society_id);

         $currentMonth = date('m');
         if($currentMonth < 4) {
             if($currentMonth == 1) {
                 $data['month'] = 12;
                 $data['year'] = date('Y') -1;
             } else {
                 $data['month'] = date('m') -1;
                 $data['year'] = date('Y') -1;
             }
         } else {
             $data['month'] = date('m') - 1;
             $data['year'] = date('Y');
         }

         $bill = TransBillGenerate::where('building_id',$request->building_id)
             ->where('society_id',$request->society_id)
             ->where('bill_month', '=',  $data['month'])
             ->where('bill_year', '=', $data['year'])
             ->orderBy('id','desc')
             ->get();

//        dd($bill);

         if(/*!empty($bill)*/ (count($bill) > 0 )){
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

         $dispute_data = DisputeBillDetail::where('trans_bill_generate_id',$bill[0]['id'])
             ->get()->toArray();
         //return $buildings;

         return view('admin.rc_department.dispute_amount_society', compact('dispute_data','bill','tenament', 'buildings', 'data', 'Tenant_bill_id', 'building_detail', 'society_detail'));
     }

     public function payment_dispute_tenant(Request $request){

//         dd($request->all());
         if ($request->trans_bill_generate_id) {

             $total_amount = ceil($request->service_charge_balance) + ceil($request->arrear_balance) + ceil($request->arrear_interest_balance);

             if($total_amount == 0){

                 return redirect()->back()->with('warning', 'Bill has no balance amount to dispute.');

             }else{
                 $bill = new DisputeBillDetail();
                 $bill->trans_bill_generate_id = $request->trans_bill_generate_id;
                 $bill->amount = $request->amount;
                 $bill->remark = $request->remark;
                 $bill->save();

                 $amount_paid = $request->amount;

                 $bill_status = TransBillGenerate::find($request->trans_bill_generate_id);
                 if ($bill_status->service_charge_balance <= $amount_paid) {

                     $amount_paid = $amount_paid - ceil($bill_status->service_charge_balance);
                     $bill_status->service_charge_balance = 0;
                     if ($amount_paid > 0) {
                         if ($amount_paid >= ceil($bill_status->arrear_balance)) {

                             $amount_paid = $amount_paid - ceil($bill_status->arrear_balance);
                             $bill_status->arrear_balance = 0;
                             if ($amount_paid > $bill_status->arrear_interest_balance) {
                                 $amount_paid = $amount_paid - ceil($bill_status->arrear_interest_balance);
                                 $bill_status->arrear_interest_balance = 0;
                             } else {
                                 $bill_status->arrear_interest_balance = ceil($bill_status->arrear_interest_balance) - $amount_paid;
                                 $amount_paid = 0;
                             }
                         } else {
                             $bill_status->arrear_balance = $amount_paid - ceil($bill_status->arrear_balance);
                             $amount_paid = 0;
                         }
                     } else {
                         $bill_status->arrear_balance = ceil($bill_status->arrear_balance) - $amount_paid;
                         $amount_paid = 0;
                     }
                 } else {
                     $bill_status->service_charge_balance = ceil($bill_status->service_charge_balance) - $amount_paid;
                     $amount_paid = 0;
                 }

                 $bill_status->status = 'Generated';
                 $bill_status->balance_amount = ceil($bill_status->balance_amount) - $request->amount;
                 $bill_status->credit_amount = $bill_status->credit_amount;
                 $bill_status->save();


                 $dispute_data = DisputeBillDetail::where('trans_bill_generate_id', $request->trans_bill_generate_id)->get()->toArray();

                 return redirect()->back()->with(['bill' => $bill, 'dispute_data' => $dispute_data]);

             }



//            return view('admin.rc_department.generate_receipt_tenant', compact('bill' , 'receipt_data'));

         } else {
             return redirect()->back()->with('warning', 'Invalid Bill Data.');
         }

     }

     public function payment_dispute_society(Request $request){

         if ($request->trans_bill_generate_id) {

             $total_amount = ceil($request->service_charge_balance) + ceil($request->arrear_balance) + ceil($request->arrear_interest_balance);

             if ($total_amount == 0) {
                 return redirect()->back()->with('warning', 'Bill has no balance amount to dispute.');
             } else {


                 $bill = new DisputeBillDetail();
                 $bill->trans_bill_generate_id = $request->trans_bill_generate_id;
                 $bill->amount = $request->amount;
                 $bill->remark = $request->remark;
                 $bill->save();

                 $amount_paid = $request->amount;

                 //             dd($amount_paid);
                 $bill_status = TransBillGenerate::find($request->trans_bill_generate_id);
//                 dd($bill_status);
                 if ($bill_status->service_charge_balance <= $amount_paid) {
                     //                 dd('here.if');

                     $amount_paid = $amount_paid - ceil($bill_status->service_charge_balance);
                     $bill_status->service_charge_balance = 0;
                     if ($amount_paid > 0) {
                         if ($amount_paid >= ceil($bill_status->arrear_balance)) {

                             $amount_paid = $amount_paid - ceil($bill_status->arrear_balance);
                             $bill_status->arrear_balance = 0;
                             if ($amount_paid > $bill_status->arrear_interest_balance) {
                                 $amount_paid = $amount_paid - ceil($bill_status->arrear_interest_balance);
                                 $bill_status->arrear_interest_balance = 0;
                             } else {
                                 $bill_status->arrear_interest_balance = ceil($bill_status->arrear_interest_balance) - $amount_paid;
                                 $amount_paid = 0;
                             }
                         } else {
                             $bill_status->arrear_balance = $amount_paid - ceil($bill_status->arrear_balance);
                             $amount_paid = 0;
                         }
                     } else {
                         $bill_status->arrear_balance = ceil($bill_status->arrear_balance) - $amount_paid;
                         $amount_paid = 0;
                     }
                 } else {

                     //                 dd('here.else');
                     $bill_status->service_charge_balance = ceil($bill_status->service_charge_balance) - $amount_paid;
                     $amount_paid = 0;
                 }
                 $bill_status->status = 'Generated';
                 $bill_status->balance_amount = ceil($bill_status->balance_amount) - $request->amount;
                 $bill_status->credit_amount = ceil($bill_status->credit_amount);
                 $bill_status->save();

                 $dispute_data = DisputeBillDetail::where('trans_bill_generate_id', $request->trans_bill_generate_id)->get();

                 return redirect()->back()->with(['bill' => $bill, 'dispute_data' => $dispute_data]);

             }
         }
         else {
                 return redirect()->back()->with('warning', 'Invalid Bill Data.');
             }

     }


}
