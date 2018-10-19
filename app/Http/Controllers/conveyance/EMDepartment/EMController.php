<?php

namespace App\Http\Controllers\conveyance\EMDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;

class EMController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
    }

	public function ScrutinyReamrk(Request $request,$applicationId){

		$data = scApplication::with(['societyApplication','scApplicationLog'])->where('id',$applicationId)->first();
		return view('admin.conveyance.em_department.scrutiny_remark',compact('data'));
	}
}
