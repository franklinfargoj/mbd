<?php

namespace App\Http\Controllers\Reports;
use App\conveyance\scApplicationType;
use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayoutStatusLog;
use App\LayoutUser;
use App\Role;
use DB;
use Illuminate\Http\Request;
use Excel;
use Mpdf\Mpdf;

class architectController extends Controller
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
        return view('admin.reports.architect.period_wise_pendency');
    }

    /**
     * Generate the period wise report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function architect_pending_reports(Request $request ){

        $roles = $this->roles();

        $period = $this->period($request->period);

        $period_title = $this->periodTitle($request->period);

        $layouts = $this->layouts();

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        $module_name = 'Architect Layout';


        if (count($period) == 2 || count($period) == 1) {


            $data = $this->getArchitectData($period_title,$period,$layouts,$roles);

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
            case config('commanConfig.vp_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.vp_engineer'),
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
            case config('commanConfig.senior_architect_planner'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.senior_architect_planner'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.architect'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.cap_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.cap_engineer'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.ree_branch_head'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.co_engineer'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.ree_branch_head'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ree_junior'),
                    config('commanConfig.ree_deputy_engineer'),
                    config('commanConfig.ree_assistant_engineer'),
                    config('commanConfig.ree_branch_head'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.co_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.co_engineer'),
                    config('commanConfig.vp_engineer'),
                    config('commanConfig.cap_engineer'),
                    config('commanConfig.la_engineer'),
                    config('commanConfig.land_manager'),
                    config('commanConfig.estate_manager'),
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                    config('commanConfig.ree_junior'),
                    config('commanConfig.ree_deputy_engineer'),
                    config('commanConfig.ree_assistant_engineer'),
                    config('commanConfig.ree_branch_head'),
                    config('commanConfig.senior_architect_planner'),
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
    public function getArchitectData($period_title,$period,$layouts,$roles){

        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'),
            config('commanConfig.architect_layout_status.sent_for_revision'));


        if($period_title=="")
        {
            $data = $data = ArchitectLayoutStatusLog::join('architect_layouts', 'architect_layout_status_logs.architect_layout_id', '=', 'architect_layouts.id')
                ->join('users', 'users.id', '=', 'architect_layout_status_logs.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->join('master_layout', 'architect_layouts.layout_name', '=', 'master_layout.id')
                ->where('current_status', 1)
                ->whereIn('architect_layout_status_logs.role_id', $roles)
                ->whereIn('architect_layout_status_logs.status_id', $status)

                //                ->where(DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at)'), '>=', $period[0])
//                ->where(DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at)'), '<=', $period[1])
                ->whereIn('architect_layouts.layout_name', $layouts)
                ->whereHas('architect_layout', function ($q) {
                    $q->where('layout_excel_status', 0);})
                ->whereIn('status_id', $status)
                ->get(['roles.name as Role','architect_layouts.layout_no', 'architect_layout_status_logs.created_at','master_layout.layout_name as layout_name', 'users.name as User', DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at) as days_pending')]);

        }else
        {
            $data = ArchitectLayoutStatusLog::join('architect_layouts', 'architect_layout_status_logs.architect_layout_id', '=', 'architect_layouts.id')
                ->join('users', 'users.id', '=', 'architect_layout_status_logs.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->join('master_layout', 'architect_layouts.layout_name', '=', 'master_layout.id')
                ->where('current_status', 1)
                ->whereIn('architect_layout_status_logs.role_id', $roles)
                ->whereIn('architect_layout_status_logs.status_id', $status)
                ->where(DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at)'), '>=', $period[0])
                ->where(DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at)'), '<=', $period[1])
                ->whereIn('architect_layouts.layout_name', $layouts)
                ->whereHas('architect_layout', function ($q) {
                        $q->where('layout_excel_status', 0);})
                ->whereIn('status_id', $status)
                ->get(['roles.name as Role','architect_layouts.layout_no', 'architect_layout_status_logs.created_at','master_layout.layout_name as layout_name', 'users.name as User', DB::raw('DATEDIFF(NOW(),architect_layout_status_logs.created_at) as days_pending')]);

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
                $content = view('admin.reports.architect._period_wise_pendency', compact('data', 'period_title','module_name'));
                $header_file = view('admin.REE_department.offer_letter_header');
                $footer_file = view('admin.REE_department.offer_letter_footer');
                //$pdf = \App::make('dompdf.wrapper');
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
                    $dataList['Layout No'] = $datas->layout_no;
                    $dataList['Submission Date'] = $datas->created_at;
                    $dataList['Layout Name'] = $datas->layout_name;
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