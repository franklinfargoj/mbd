<?php

namespace App\Http\Controllers\ArchitectLayout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayout;
use Storage;
use App\Layout\ArchitectLayoutDetailCtsPlanDetail;

class LayoutArchitectDetailController extends Controller
{
    public function add_detail($layout_id)
    {
        $layout_id=decrypt($layout_id);
        $ArchitectLayoutDetail=ArchitectLayoutDetail::with(['architect_layout'])->where(['id'=> $layout_id])->first();
        return view('admin.architect_layout_detail.add',compact('ArchitectLayoutDetail'));
    }

    public function uploadLatestLayoutAjax(Request $request)
    {
        $response_array=array();
        $file=$request->file('file');
        if ($file->getClientMimeType() == 'application/pdf')
        {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $storage=Storage::disk('ftp')->putFileAs($dir,$request->file('file'),$filename);
            if($storage)
            {
            $ArchitectLayoutDetail=ArchitectLayoutDetail::find($request->architect_layout_detail_id);
            if($request->field_name=='latest_layout')
            {
                $ArchitectLayoutDetail->latest_layout=$storage;
            }
            if($request->field_name=='old_approved_layout')
            {
                $ArchitectLayoutDetail->old_approved_layout=$storage;
            }
            if($request->field_name=='last_submitted_layout_for_approval')
            {
                $ArchitectLayoutDetail->last_submitted_layout_for_approval=$storage;
            }
            $ArchitectLayoutDetail->save();
            $response_array=array(
                'status'=>true,
                'file_path'=>config('commanConfig.storage_server')."/".$storage
            );
            }else
            {
                $response_array=array(
                    'status'=>false,
                );
            }
        }else
        {
            $response_array=array(
                'status'=>false,
                'message'=>'PDF file is required'
            );
        }
        
        return response()->json($response_array);
    }

    public function add_cts_detail($layout_detail_id)
    {
        $layout_detail_id=decrypt($layout_detail_id);
        $ArchitectLayoutDetail=ArchitectLayoutDetail::with(['architect_layout','cts_plan_details'])->where(['id'=> $layout_detail_id])->first();
        return view('admin.architect_layout_detail.cts_plan_detail',compact('ArchitectLayoutDetail'));
    }

    public function post_cts_detail(Request $request)
    {
        $file=$request->file('cts_plan_file');
        if ($file->getClientMimeType() == 'application/pdf')
        {
            $extension = $request->file('cts_plan_file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $storage=Storage::disk('ftp')->putFileAs($dir,$request->file('cts_plan_file'),$filename);
            if($storage)
            {
                $ArchitectLayoutDetail=ArchitectLayoutDetail::find($request->architect_layout_detail_id);
                $ArchitectLayoutDetail->cts_plan=$storage;
                $ArchitectLayoutDetail->save();
                if($ArchitectLayoutDetail)
                {
                    foreach($request->cts_no as $cts_n)
                    {
                        $Cts_plan=new ArchitectLayoutDetailCtsPlanDetail;
                        $Cts_plan->architect_layout_detail_id=$ArchitectLayoutDetail->id;
                        $Cts_plan->cts_no=$cts_n;
                        $Cts_plan->save();
                    }   
                }
                return back()->withSuccess('Data added successfully');
            }
            return back()->withError('File not uploaded');
        }else
        {
            return back()->withError('pdf file is required');
        }
    }

    public function add_prc_detail($layout_detail_id)
    {
        $layout_detail_id=decrypt($layout_detail_id);
        $ArchitectLayoutDetail=ArchitectLayoutDetail::with(['architect_layout','cts_plan_details'])->where(['id'=> $layout_detail_id])->first();
        return view('admin.architect_layout_detail.prc_detail',compact('ArchitectLayoutDetail'));
    }
}
