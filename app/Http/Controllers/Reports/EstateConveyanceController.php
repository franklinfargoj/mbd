<?php

namespace App\Http\Controllers\Reports;

use App\conveyance\scApplication;
use App\conveyance\scApplicationType;
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

        $module_names = scApplicationType::get()->toArray();

        return view('admin.reports.estate_conveyance.period_wise_pendency',compact('module_names'));
    }

    /**
     * Generate the period wise report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function estate_conveyance_pending_reports(Request $request ){

        $roles = $this->roles();

        die($roles);
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
            case config('commanConfig.dyco_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.dyco_engineer'),
                    config('commanConfig.dycdo_engineer'),
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
            case config('commanConfig.joint_co'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.joint_co'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.architect'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                ))->pluck('id')->toArray();
                break;
            case config('commanConfig.co_engineer'):
                $roles = Role::whereIn('name', array(
                    config('commanConfig.ee_branch_head'),
                    config('commanConfig.ee_deputy_engineer'),
                    config('commanConfig.ee_junior_engineer'),
                    config('commanConfig.co_engineer'),
                    config('commanConfig.dyco_engineer'),
                    config('commanConfig.dycdo_engineer'),
                    config('commanConfig.estate_manager'),
                    config('commanConfig.legal_advisor'),
                    config('commanConfig.joint_co'),
                    config('commanConfig.architect'),
                    config('commanConfig.junior_architect'),
                    config('commanConfig.senior_architect'),
                ))->pluck('id')->toArray();
                break;
            default:
                return back()->with('error', 'Invalid Request');
                break;
        }
        return $roles;
    }


}