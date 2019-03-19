<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\LayoutUser;
use App\OlApplicationMaster;
use App\OlApplicationStatus;
use App\Role;
use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Excel;

class RedevelopementController extends Controller
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

        $module_names = config('commanConfig.module_names');

        return view('admin.reports.redevelopement.period_wise_pendency',compact('module_names'));
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
    public function redevelopement_pending_reports(Request $request)
    {
        $roles = $this->roles();

        $period = $this->period($request->period);

        $period_title = $this->periodTitle($request->period);

        $layouts = $this->layouts();

        $master_ids = config('commanConfig.'.$request->module_master_id);

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }


        if (count($period) == 2 || count($period) == 1) {

            if($request->module_master_id == 'new_offer_letter_master_ids' ||
                $request->module_master_id == 'revalidation_master_ids' ||
                $request->module_master_id == 'tripartite_master_ids') {
                $data = $this->getofferLetterData($period_title,$period,$master_ids,$layouts,$roles);
            }

            $this->generateReport($data,$report_format);

        } else {
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
     * Roles for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $roles
     */
    public function roles(){
        //dd(auth()->user()->role_id);
        $roles = array();
        $role = Role::find(auth()->user()->role_id);
        // dd($layouts);
        switch ($role->name) {
            case config('commanConfig.ee_branch_head'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.dyce_branch_head'),
                    config('commanConfig.dyce_deputy_engineer'),
                    config('commanConfig.dyce_jr_user'),
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
            case config('commanConfig.dyce_branch_head'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.dyce_branch_head'),
                    config('commanConfig.dyce_deputy_engineer'),
                    config('commanConfig.dyce_jr_user'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.co_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ree_junior'),
                    config('commanConfig.ree_deputy_engineer'),
                    config('commanConfig.ree_assistant_engineer'),
                    config('commanConfig.ree_branch_head'),
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.dyce_branch_head'),
                    config('commanConfig.dyce_deputy_engineer'),
                    config('commanConfig.dyce_jr_user'),
                    config('commanConfig.co_engineer')
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
     * Offer letter report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getofferLetterData($period_title,$period,$master_ids,$layouts,$roles){
        if($period_title=="")
        {
            $data = OlApplicationStatus::join('ol_applications', 'ol_application_status_log.application_id', '=', 'ol_applications.id')
                ->join('ol_societies', 'ol_applications.society_id', '=', 'ol_societies.id')
                ->join('ol_application_master', 'ol_application_master.id', '=', 'ol_applications.application_master_id')
                ->join('users', 'users.id', '=', 'ol_application_status_log.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->where('ol_application_status_log.is_active', 1)
                ->whereIn('ol_application_status_log.role_id', $roles)
                ->where('ol_application_status_log.status_id', config('commanConfig.applicationStatus.in_process'))
                // ->where(DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at)'), '>=', $period[0])
                // ->where(DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at)'), '<=', $period[1])
                ->whereIn('ol_applications.layout_id', $layouts)
                ->whereIn('ol_applications.application_master_id',$master_ids)
                ->get(['roles.name as Role','ol_applications.application_no', 'ol_application_status_log.created_at', 'ol_societies.name as society_name', 'ol_societies.building_no', 'ol_application_master.model', 'users.name as User', DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at) as days_pending')]);

        }else
        {
            $data = OlApplicationStatus::join('ol_applications', 'ol_application_status_log.application_id', '=', 'ol_applications.id')
                ->join('ol_societies', 'ol_applications.society_id', '=', 'ol_societies.id')
                ->join('ol_application_master', 'ol_application_master.id', '=', 'ol_applications.application_master_id')
                ->join('users', 'users.id', '=', 'ol_application_status_log.user_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->where('ol_application_status_log.is_active', 1)
                ->whereIn('ol_application_status_log.role_id', $roles)
                ->where('ol_application_status_log.status_id', config('commanConfig.applicationStatus.in_process'))
                ->where(DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at)'), '>=', $period[0])
                ->where(DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at)'), '<=', $period[1])
                ->whereIn('ol_applications.layout_id', $layouts)
                ->whereIn('ol_applications.application_master_id',$master_ids)
                ->get(['roles.name as Role','ol_applications.application_no', 'ol_application_status_log.created_at', 'ol_societies.name as society_name', 'ol_societies.building_no', 'ol_application_master.model', 'users.name as User', DB::raw('DATEDIFF(NOW(),ol_application_status_log.created_at) as days_pending')]);

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
    public function generateReport($data, $report_format){
        $fileName = date('Y_m_d_H_i_s') . '_period_wise_pendency.pdf';

        if (count($data) > 0) {

            if($report_format=='pdf')
            {
                $content = view('admin.reports.redevelopement._period_wise_pendency', compact('data', 'period_title'));
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
            if($report_format=='excel')
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
                    $dataList['Model'] = $datas->model;
                    $dataList['Pending at User'] = $datas->User.' ['.$datas->Role.']';
                    $dataList['Pending Days'] = $datas->days_pending;
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }

                return Excel::create(date('Y_m_d_H_i_s') . '_period_wise_pendency', function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

        } else {
            return back()->with('error', 'No Record Found');
        }
    }
}