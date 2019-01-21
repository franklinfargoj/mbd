<?php

namespace App\Repositories;

use App\RtiForm;
use DB;

class RtiFormModel{

    public function todays_rti_meetings()
    {
        return RtiForm::with(['rti_schedule_meetings'=>function($q){
            $q->where(DB::raw("DATE(meeting_scheduled_date) = '".date('Y-m-d')."'"));
        }])->whereHas('rti_schedule_meetings',function($q){
            $q->where(DB::raw("DATE(meeting_scheduled_date) = '".date('Y-m-d')."'"))->where('department_id',auth()->user()->department->department_id);
        })->get();
    }

    public function all($request,$status="")
    {
        $rti_form=RtiForm::with(['rti_forward_status'])->where('department_id',auth()->user()->department->department_id);

        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        if($status!="")
        {
            $rti_form=$rti_form->where('status','=',$status);
        }

        return $rti_form->count();
    }

    public function pending_rti_count($request,$status)
    {
        $rti_form=RtiForm::with(['rti_forward_status'])->where('department_id',auth()->user()->department->department_id);

        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        if($status!="")
        {
            $rti_form=$rti_form->where('status','!=',$status);
        }

        return $rti_form->count();
    }

    public function report_submitted_by_users($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users'])->where('department_id',auth()->user()->department->department_id);
        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        return $rti_form->get();
    }

    public function deaprtment_reports($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users','department'])->where('department_id',auth()->user()->department->department_id);
        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        if($request->status)
        {
            $rti_form=$rti_form->where('status','=',$request->status);
        }

        return $rti_form->get();
    }

    public function period_wise_pendancy($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users','department'])->where('department_id',auth()->user()->department->department_id);
        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        if($request->status)
        {
            $rti_form=$rti_form->where('status','=',$request->status);
        }

        return $rti_form->where('status','!=',config('commanConfig.rti_status.closed'))->get();
    }

    public function pending_rti($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users','department'])->where('department_id',auth()->user()->department->department_id)->where('status','!=',config('commanConfig.rti_status.closed'));
        if($request->from_date)
        {
            $rti_form=$rti_form->where('created_at','>=',date('Y-m-d',strtotime($request->from_date))." 00:00:01");
        }
        
        if($request->to_date)
        {
            $rti_form=$rti_form->where('created_at','<=',date('Y-m-d',strtotime($request->to_date))." 23:59:59");
        }

        return $rti_form->get();
    }   
}