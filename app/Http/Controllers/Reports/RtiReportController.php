<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\RtiFormModel;
use Illuminate\Http\Request;
use App\MasterRtiStatus;

class RtiReportController extends Controller
{
    protected $rti;
    public function __construct(RtiFormModel $rti)
    {
        $this->rti=$rti;
    }

    public function Dashboard(Request $request)
    {
        $data=array();
        $data['total_no_of_applications']=$this->rti->all($request);
        $data['number_of_rti_cases_closed']=$this->rti->all($request,config('commanConfig.rti_status.closed'));
        $data['pending_rti_count']=$this->rti->pending_rti_count($request,config('commanConfig.rti_status.closed'));
        return view('admin.reports.rti.dashboard',compact('data'));
    }

    public function rti_statstics_reports(Request $request)
    {
        $getData=$request->all();
        $data=array();
        $data['total_no_of_applications']=$this->rti->all($request);
        $data['number_of_rti_cases_closed']=$this->rti->all($request,config('commanConfig.rti_status.closed'));
        $data['pending_rti_count']=$this->rti->pending_rti_count($request,config('commanConfig.rti_status.closed'));
        return view('admin.reports.rti.statstics',compact('data','getData'));
    }

    public function rti_submitted_reports_by_users(Request $request)
    {
        $data=array();
        $getData=$request->all();
        $data['report_submitted_by_users']=$this->rti->report_submitted_by_users($request);
        //dd($data);
        return view('admin.reports.rti.report_submitted_by_users',compact('data','getData'));
    }

    public function reports_department(Request $request)
    {
        $data=array();
        $getData=$request->all();
        $data['report_departments']=$this->rti->deaprtment_reports($request);
        //dd($data);
        return view('admin.reports.rti.reports_department',compact('data','getData'));
    }

    public function reports_status(Request $request)
    {
        $data=array();
        $rti_statuses = MasterRtiStatus::all();
        $getData=$request->all();
        $data['report_status']=$this->rti->deaprtment_reports($request);
        //dd($data);
        return view('admin.reports.rti.reports_status',compact('data','getData','rti_statuses'));
    }

    public function pending_rti(Request $request)
    {
        $data=array();
        $getData=$request->all();
        $data['pending_rti']=$this->rti->pending_rti($request);
        //dd($data);
        return view('admin.reports.rti.pending_rti',compact('data','getData'));
    }

    public function period_wise_pendancy(Request $request)
    {
        $data=array();
        $rti_statuses = MasterRtiStatus::all();
        $getData=$request->all();
        $data['report_status']=$this->rti->deaprtment_reports($request);
        //dd($data);
        return view('admin.reports.rti.period_wise_pendancy_report',compact('data','getData','rti_statuses'));
    }
}
