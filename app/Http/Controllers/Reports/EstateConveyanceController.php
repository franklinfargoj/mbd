<?php

namespace App\Http\Controllers\Reports;

use App\conveyance\scApplication;
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

        $module_names = '';

        return view('admin.reports.estate_conveyance.period_wise_pendency',compact('module_names'));
    }


}