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

    //Query used
    //SELECT ola.application_no,ola.created_at,ols.name,ols.building_no,olm.model,u.name,
    //DATEDIFF(NOW(),am.created_at) as difference FROM `ol_application_status_log` am
    //join ol_applications ola on am.application_id=ola.id join ol_societies ols on ola.society_id=ols.id
    //join ol_application_master olm on olm.id=ola.application_master_id join users u on u.id=am.user_id
    //where is_active=1 and am.role_id in(2,3,4) and am.status_id=1 and
    //DATEDIFF(NOW(),am.created_at)>=0 and DATEDIFF(NOW(),am.created_at)<=31
    //

    /**
     * Generate the periodwise report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function ebilling_pending_reports(Request $request)
    {
        $from_date = date("Y-m-d", strtotime($request->report_date_from));
        $to_date = date("Y-m-d", strtotime($request->report_date_to));

//        dd($from_date.'==='.$to_date);
//        $from_date = DATE_FORMAT($request->report_date_from,'Y-m-d');
//
//        $to_date =  DATE_FORMAT($request->report_date_to,'Y-m-d');

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

//dd($layouts);
        $data = TransBillGenerate::
            join('lm_society_detail','lm_society_detail.id','=','trans_bill_generate.society_id')
            ->leftjoin('trans_payment','trans_bill_generate.id','=','trans_payment.bill_no')
            ->where('lm_society_detail.society_bill_level',$ebilling_type)
//            ->whereDate('trans_bill_generate.created_at','>=' ,$from_date)
//            ->whereDate('trans_bill_generate.created_at','<=',$to_date)
            ->where('trans_bill_generate.created_at','>=' ,$from_date)
            ->where('trans_bill_generate.created_at','<=',$to_date)
            ->whereIn('lm_society_detail.layout_id',$layouts)
            ->where('society_bill_level',$ebilling_type)
            ->get();

        //created_at
//        var_dump($data[0]['created_at']->format('d-m-Y'));die();
//        var_dump(strtotime(date_format($data[0]['created_at'],'d-m-Y')) >= strtotime('21-01-2019' ));die();
//        var_dump(strtotime(DATE_FORMAT('trans_bill_generate.created_at','d-m-Y')));die();


//        dd($data[0]);
//        dd(count($data));
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
//
//        foreach ($data as $datas){
//            echo $datas->bill_number;
//            echo '<br/>';
//
//        }die();
//        dd('generataing report');

//        $fileName = date('Y_m_d_H_i_s') . '_period_wise_billing.pdf';

        if (count($data) > 0) {
            if($report_format == 'excel')
            {
                $dataListMaster = [];
                $i=1;
                foreach ($data as $datas) {

                    $dataList = [];
                    $dataList['Sr.No.'] = $i;
                    $dataList['Bill No'] = $datas->bill_number ?? '';
                    $dataList['Bill Date'] = $datas->bill_date ?? '';
                    $dataList['Due Date'] = $datas->due_date ?? '';
                    $dataList['Bill From'] = $datas->bill_from ?? '';
                    $dataList['Bill To'] = $datas->bill_to ?? '';
                    $dataList['Bill Month'] = $datas->bill_month ?? '';
                    $dataList['Bill Year'] = $datas->bill_year ?? '';
                    $dataList['Monthly Bill'] = $datas->monthly_bill ?? '';
                    $dataList['Arrear Bill'] = $datas->arrear_bill ?? '';
                    $dataList['Total Bill'] = $datas->total_bill ?? '';
                    $dataList['Total Service After Due'] = $datas->total_service_after_due ?? '';
                    $dataList['Late Fee Charge'] = $datas->late_fee_charge ?? '';
                    $dataList['Total Bill After Due Date'] = $datas->total_bill_after_due_date ?? '';
                    $dataList['Balance Amount'] = $datas->balance_amount ?? '';
                    $dataList['Consumer Number'] = $datas->consumer_number ?? '';
                    $dataList['Bill Status'] = $datas->status ?? '';
                    $dataList['Arrear Balance'] = $datas->arrear_balance ?? '';
                    $dataList['Service Charge Balance'] = $datas->service_charge_balance ?? '';
                    $dataList['Arrear Interest Balance'] = $datas->arrear_interest_balance ?? '';
                    $dataList['Credit Amount'] = $datas->credit_amount ?? '' ?? '';
                    $dataList['Previous Arrear Balance'] = $datas->prev_arrear_balance ?? '';
                    $dataList['Previous Service Charge Balance'] = $datas->prev_service_charge_balance ?? '';
                    $dataList['Previous Arrear Interest Balance '] = $datas->prev_arrear_interest_balance ?? '';
                    $dataList['Previous Credit'] = $datas->prev_credit ?? '';
                    $dataList['Society Name'] = $datas->society_name ?? '';
                    $dataList['Society Bill Level'] = $datas->society_bill_level ?? '';
                    $dataList['Layout Name'] = $datas->layout_id ?? '';
                    $dataList['Paid By'] = $datas->paid_by ?? '';
                    $dataList['Mode Of Payment'] = $datas->mode_of_payment ?? '';
                    $dataList['Bill Amount'] = $datas->bill_amount ?? '';
                    $dataList['Amount Paid'] = $datas->amount_paid ?? '';
                    $dataList['DD Id'] = $datas->dd_id ?? '';



                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }

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