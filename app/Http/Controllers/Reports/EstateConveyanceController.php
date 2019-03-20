<?php

namespace App\Http\Controllers\Reports;

use App\conveyance\scApplication;
use App\conveyance\scApplicationLog;
use App\conveyance\scApplicationType;
use App\Http\Controllers\Controller;
use App\LayoutUser;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OlApplicationMaster;
use App\OlApplicationStatus;
use App\Role;
use App\SocietyConveyanceApplicationType;
use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Excel;

class EstateConveyanceController extends Controller
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

        $module_names = scApplicationType::get()->toArray();

        return view('admin.reports.estate_conveyance.period_wise_pendency',compact('module_names'));
    }

    /**
     * Generate the period wise report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function estate_conveyance_pending_reports(Request $request ){

        $roles = $this->roles();

        $period = $this->period($request->period);

        $period_title = $this->periodTitle($request->period);

        $layouts = $this->layouts();

        $master_id = $request->module_master_id;

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        $modules = scApplicationType::get()->toArray();

        foreach ($modules as $key => $value){
            if($value['id'] == $request->module_master_id){
                $module_name = $value['application_type'] ;
            }
        }

        if (count($period) == 2 || count($period) == 1) {
            
            if($request->module_master_id == '1') {
                $data = $this->getConveyanceData($period_title,$period,$master_id,$layouts,$roles);

            }

            if($data){

                $result = $this->generateReport($data, $report_format, $period_title, $module_name);
                if(!$result){
                    return back()->with('error', 'No Record Found');
                }
            }else{
                return back()->with('error', 'No Record Found');

            }
        }
        else {
            return back()->with('error', 'Invalid Request');
        }
    }

    /**
     * Roles for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $roles
     */
    public function roles(){

        $roles = array();
        $role = Role::find(auth()->user()->role_id);

        switch ($role->name) {
            case config('commanConfig.ee_branch_head'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.dyco_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.dyco_engineer'),
                    config('commanConfig.dycdo_engineer'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.estate_manager'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.estate_manager'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.legal_advisor'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.legal_advisor'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.joint_co'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.joint_co'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.architect'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.co_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.co_engineer'),
                    config('commanConfig.dyco_engineer'),
                    config('commanConfig.dycdo_engineer'),
                    config('commanConfig.estate_manager'),
                    config('commanConfig.legal_advisor'),
                    config('commanConfig.joint_co'),
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                ))->pluck('id')->toArray();
                break;
            default:
                return back()->with('error', 'Invalid Request');
                break;
        }
        return $roles;
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
     * Offer letter report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getConveyanceData($period_title,$period,$master_id,$layouts,$roles){

        $status = array(config('commanConfig.conveyance_status.in_process'),
                        config('commanConfig.conveyance_status.Draft_sale_&_lease_deed'),
                        config('commanConfig.conveyance_status.Approved_sale_&_lease_deed'),
                        config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed'),
                        config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed'),
                        config('commanConfig.conveyance_status.Registered_sale_&_lease_deed'),
                        config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty'),
                        config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease'),
                        config('commanConfig.conveyance_status.NOC_Issued'));


        if($period_title=="")
        {
            $data = scApplicationLog::join('sc_application', 'sc_application_log.application_id', '=', 'sc_application.id')
                ->join('ol_societies', 'sc_application.society_id', '=', 'ol_societies.id')
                ->join('sc_application_master', 'sc_application_master.id', '=', 'sc_application.sc_application_master_id')
                ->join('users', 'users.id', '=', 'sc_application_log.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->where('sc_application_log.is_active', 1)
                ->whereIn('sc_application_log.role_id', $roles)
                ->whereIn('sc_application_log.status_id', $status)
                ->whereIn('sc_application.layout_id', $layouts)
                ->where('sc_application.sc_application_master_id',$master_id)
                ->get(['roles.name as Role','sc_application.application_no', 'sc_application_log.created_at', 'ol_societies.name as society_name', 'ol_societies.building_no', 'users.name as User', DB::raw('DATEDIFF(NOW(),sc_application_log.created_at) as days_pending')]);

        }else
        {
            $data = scApplicationLog::join('sc_application', 'sc_application_log.application_id', '=', 'sc_application.id')
                ->join('ol_societies', 'sc_application.society_id', '=', 'ol_societies.id')
                ->join('sc_application_master', 'sc_application_master.id', '=', 'sc_application.sc_application_master_id')
                ->join('users', 'users.id', '=', 'sc_application_log.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->where('sc_application_log.is_active', 1)
                ->whereIn('sc_application_log.role_id', $roles)
                ->whereIn('sc_application_log.status_id', $status)
                ->where(DB::raw('DATEDIFF(NOW(),sc_application_log.created_at)'), '>=', $period[0])
                ->where(DB::raw('DATEDIFF(NOW(),sc_application_log.created_at)'), '<=', $period[1])
                ->whereIn('sc_application.layout_id', $layouts)
                ->where('sc_application.sc_application_master_id',$master_id)
                ->get(['roles.name as Role','sc_application.application_no', 'sc_application_log.created_at', 'ol_societies.name as society_name', 'ol_societies.building_no', 'users.name as User', DB::raw('DATEDIFF(NOW(),sc_application_log.created_at) as days_pending')]);

        }
        return $data;
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateReport($data, $report_format, $period_title, $module_name){
        $fileName = date('Y_m_d_H_i_s') . '_period_wise_pendency.pdf';

        if (count($data) > 0) {

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.estate_conveyance._period_wise_pendency', compact('data', 'period_title','module_name'));
                $header_file = view('admin.REE_department.offer_letter_header');
                $footer_file = view('admin.REE_department.offer_letter_footer');
                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHTMLHeader($header_file);
                $pdf->SetHTMLFooter($footer_file);
                $pdf->WriteHTML($content);
                $pdf->Output($fileName, 'D');
            }
            if($report_format == 'excel')
            {
                $dataListMaster = [];
                $i=1;
                foreach ($data as $datas) {

                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Application No'] = $datas->application_no;
                    $dataList['Submission Date'] = $datas->created_at;
                    $dataList['Society Name'] = $datas->society_name;
                    $dataList['Building No'] = $datas->building_no;
                    $dataList['Pending at User'] = $datas->User.' ['.$datas->Role.']';
                    $dataList['Pending Days'] = $datas->days_pending;
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }

                $module_name = str_replace(' ','_',$module_name);
                return Excel::create(date('Y_m_d_H_i_s') . '_period_wise_pendency_'.$module_name, function($excel) use($dataListMaster){

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


}