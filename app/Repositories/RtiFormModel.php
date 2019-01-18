<?php

namespace App\Repositories;

use App\RtiForm;

class RtiFormModel{

    public function all($request,$status="")
    {
        $rti_form=RtiForm::with(['rti_forward_status']);

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

    public function report_submitted_by_users($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users']);
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
        $rti_form=RtiForm::with(['rti_forward_status','users','department']);
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

    public function pending_rti($request)
    {
        $rti_form=RtiForm::with(['rti_forward_status','users','department'])->where('status','!=',config('commanConfig.rti_status.closed'));
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