<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\LayoutUser;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OlApplicationMaster;
use App\OlApplicationStatus;
use App\Role;
use App\TransBillGenerate;
use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Excel;

class EMController extends Controller
{
    /**
     * Show the form for Report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function period_wise_pendency()
    {

        $e_billing_type = config('commanConfig.e_billing_type');

        $ebilling_pendency_report_periods = config('commanConfig.ebilling_pendency_report_periods');

        return view('admin.reports.e_billing.period_wise_pendency',compact('e_billing_type','ebilling_pendency_report_periods'));
    }

    /**
     * Generate the period wise report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function ebilling_pending_reports(Request $request)
    {
        $from_date = date("Y-m-d", strtotime($request->report_date_from));
        $to_date = date("Y-m-d", strtotime($request->report_date_to));

        $layouts = $this->layouts();

        $report_format = $request->excel;

        $ebilling_type = $request->ebilling_type;

        $data = $this->getBillingData($from_date, $to_date, $layouts, $ebilling_type);

        if($data != null){
            $result = $this->generateReport($data, $report_format);
            if(!$result){
                return back()->with('error', 'Invalid Request');
            }
        }
        else {
            return back()->with('error', 'Invalid Request');
        }

    }

    /**
     * Login user's layout.
     *
     * Author: Prajakta Sisale.
     *
     * @return $layouts
     */
    public function layouts(){
        $layouts = LayoutUser::where(['user_id' => auth()->user()->id])->pluck('layout_id')->toArray();

        return $layouts;
    }

    /**
     * E-Billing report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getBillingData($from_date, $to_date, $layouts, $ebilling_type){

        $data = TransBillGenerate::
            join('lm_society_detail','lm_society_detail.id','=','trans_bill_generate.society_id')
            ->leftjoin('master_society_bill_level','master_society_bill_level.id','=','lm_society_detail.society_bill_level')
            ->leftjoin('master_layout','master_layout.id','=','lm_society_detail.layout_id')
            ->leftjoin('master_tenants','master_tenants.id','=','trans_bill_generate.tenant_id')
            ->where('lm_society_detail.society_bill_level',$ebilling_type)
            ->where('trans_bill_generate.created_at','>=' ,$from_date)
            ->where('trans_bill_generate.created_at','<=',$to_date)
            ->whereIn('lm_society_detail.layout_id',$layouts)
            ->where('society_bill_level',$ebilling_type)
            ->get(['trans_bill_generate.*','master_tenants.flat_no as flat_no','master_society_bill_level.name as society_bill_level','master_layout.layout_name as layout_name','lm_society_detail.society_name as society_name']);
        return $data;
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateReport($data, $report_format){

        if (count($data) > 0) {
            if($report_format == 'excel')
            {
                $dataListMaster = [];
                $i=1;
                $total_service_charge = 0;
                $total_arrear_balance = 0;
                $total_interest_on_arrear = 0;
                $total_bill = 0;

                foreach ($data as $datas) {

                    $dataList = [];
                    $dataList['Sr.No.'] = $i;
                    $dataList['Bill No'] = $datas->bill_number ?? '';
                    $dataList['Society Name'] = $datas->society_name ?? '';
                    $dataList['Society Bill Level'] = $datas->society_bill_level ?? '';
                    $dataList['Layout Name'] = $datas->layout_name ?? '';
//                    $dataList['Bill Date'] = $datas->bill_date ?? '';
//                    $dataList['Due Date'] = $datas->due_date ?? '';
//                    $dataList['Bill From'] = $datas->bill_from ?? '';
//                    $dataList['Bill To'] = $datas->bill_to ?? '';
//                    $dataList['Bill Month'] = $datas->bill_month ?? '';
//                    $dataList['Bill Year'] = $datas->bill_year ?? '';
                    $dataList['Total Bill'] = $datas->total_bill ?? '';
                    $dataList['Arrear Balance'] = $datas->arrear_balance ?? '';
                    $dataList['Service Charge Balance'] = $datas->service_charge_balance ?? '';
                    $dataList['Arrear Interest Balance'] = $datas->arrear_interest_balance ?? '';
                    $dataList['Credit Amount'] = $datas->credit_amount ?? '' ?? '';
                    if($datas->society_bill_level == 'Tenant Level Billing') {
                        $dataList['Tenant Flat No'] = $datas->flat_no ?? '';
                    }
                    $dataList['Previous Arrear Balance'] = $datas->prev_arrear_balance ?? '';
                    $dataList['Previous Service Charge Balance'] = $datas->prev_service_charge_balance ?? '';
                    $dataList['Previous Arrear Interest Balance '] = $datas->prev_arrear_interest_balance ?? '';
                    $dataList['Previous Credit'] = $datas->prev_credit ?? '';
                    $dataList['Monthly Bill'] = $datas->monthly_bill ?? '';
                    $dataList['Arrear Bill'] = $datas->arrear_bill ?? '';
                    $dataList['Total Service After Due'] = $datas->total_service_after_due ?? '';
                    $dataList['Late Fee Charge'] = $datas->late_fee_charge ?? '';
                    $dataList['Total Bill After Due Date'] = $datas->total_bill_after_due_date ?? '';
                    $dataList['Balance Amount'] = $datas->balance_amount ?? '';
                    $dataList['Consumer Number'] = $datas->consumer_number ?? '';
                    $dataList['Bill Status'] = $datas->status ?? '';

//                    $dataList['Paid By'] = $datas->paid_by ?? '';
//                    $dataList['Mode Of Payment'] = $datas->mode_of_payment ?? '';
//                    $dataList['Bill Amount'] = $datas->bill_amount ?? '';
//                    $dataList['Amount Paid'] = $datas->amount_paid ?? '';
//                    $dataList['DD Id'] = $datas->dd_id ?? '';

                    $total_service_charge += $datas->service_charge_balance ?? 0;
                    $total_arrear_balance +=  $datas->arrear_balance ?? 0;
                    $total_interest_on_arrear += $datas->arrear_interest_balance ?? 0;
                    $total_bill += $datas->total_bill ?? 0;

                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }

                $total_calcultaed_bill = $total_service_charge + $total_arrear_balance + $total_interest_on_arrear;

                $dataListMaster[] = [
                    'Sr.No.' => '',
                    'Bill No' => '',
                    'Society Name' => '',
                    'Society Bill Level' => '',
                    'Layout Name' => '',
                    'Total Bill' => '',
                    'Arrear Balance' =>  '',
                    'Service Charge Balance' => ''];
                $dataListMaster[] = [
                    'Sr.No.' => '',
                    'Bill No' => '',
                    'Society Name' => '',
                    'Society Bill Level' => '',
                    'Layout Name' => 'Total Bill',
                    'Total Bill' => $total_bill,
                    'Arrear Balance' =>  'Total calculated Bill',
                    'Service Charge Balance' => $total_calcultaed_bill];

                return Excel::create(date('Y_m_d_H_i_s') . '_period_wise_e_billing_report', function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }else {
                return false;
            }

            return true;

        } else {
            return false;
        }
    }
}