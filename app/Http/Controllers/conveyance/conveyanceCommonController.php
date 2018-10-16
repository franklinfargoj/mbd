<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\scApplication;
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
}
