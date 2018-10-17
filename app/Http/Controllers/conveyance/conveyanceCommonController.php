<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\scApplication;
use App\conveyance\scApplicationLog;
use App\Role;
use Carbon\Carbon;
use Config;
use App\User;
use Auth;

class conveyanceCommonController extends Controller
{	
	// list all data
    public function listApplicationData($request){

		$applicationData = scApplication::with(['applicationLayoutUser','societyApplication','scApplicationLog' => function($q) {
	        	$q->where('user_id', Auth::user()->id)
	            ->where('role_id', session()->get('role_id'))
	            ->where('society_flag', 0)
	            ->orderBy('id', 'desc');
		}])

        ->whereHas('scApplicationLog', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('society_flag', 0)
                ->orderBy('id', 'desc');
        }); 

        $applicationData = $applicationData->orderBy('sc_application.id', 'desc')->get();
        $listArray = [];

        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->scApplicationLog[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        }           
        return $listArray;       	
    }

    public function getForwardApplicationChildData(){

        $role_id = Role::where('id',Auth::user()->role_id)->first();
        $result = json_decode($role_id->conveyance_child_id);
        $child = User::with(['roles','LayoutUser' => function($q){
            $q->where('layout_id', session('layout_id'));
        }])
        ->whereHas('LayoutUser' ,function($q){
            $q->where('layout_id', session('layout_id'));
        })
        ->whereIn('role_id',$result)->get();
        return $child;
    }

    // forward and revert application
    public function forwardApplication($request){
 
        if ($request->check_status == 1) {
            $status = config('commanConfig.applicationStatus.forwarded');
        }else{
            $status = config('commanConfig.applicationStatus.reverted');
        } 
            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => $status,
                'to_user_id'     => $request->to_user_id,
                'to_role_id'     => $request->to_role_id,
                'remark'         => $request->remark,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $request->to_user_id,
                'role_id'       => $request->to_role_id,
                'status_id'     => config('commanConfig.applicationStatus.in_process'),
                'to_user_id'    => null,
                'to_role_id'    => null,
                'remark'        => $request->remark,
                'created_at'    => Carbon::now(),
            ],
            ];

            scApplicationLog::insert($application);      
    }
}
