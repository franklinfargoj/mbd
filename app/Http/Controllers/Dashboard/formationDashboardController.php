<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\SfApplication;
use App\conveyance\SfApplicationStatusLog;
use App\Role;

class formationDashboardController extends Controller
{
    public function total_number_of_application()
    {
       // $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return SfApplication::all()->count();
    }

    public function pending_at_current_user()
    {
        $status = array(config('commanConfig.formation_status.in_process'));
        return SfApplicationStatusLog::where(['current_status' => 1, 'user_id' => auth()->user()->id])->whereIn('status_id', $status)->count();
        //SELECT * FROM `architect_layout_status_logs` where user_id=19 and current_status=1 and status_id in(2)
    }

    public function pending_at_EM()
    {
        $roles = array(config('commanConfig.estate_manager'));
        $status = array(config('commanConfig.formation_status.in_process'));
        $EmRoles = Role::whereIn('name', $roles)->pluck('id');
        return SfApplicationStatusLog::where(['current_status' => 1])->whereIn('user_id', function ($q) use ($EmRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $EmRoles);
        })->groupBy(['user_id', 'application_id'])->whereIn('status_id', $status)->count();
    }

    public function pending_at_Dyco()
    {
        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

        $status = config('commanConfig.formation_status.in_process');

        $DycoRoles = Role::whereIn('name', $roles)->pluck('id');
        return SfApplicationStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereIn('user_id', function ($q) use ($DycoRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $DycoRoles);
        })->groupBy(['user_id', 'application_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function send_to_ddr()
    {
        $roles = array(config('commanConfig.dyco_engineer'));
        $status = array(config('commanConfig.formation_status.processed_to_DDR'));
        $EmRoles = Role::whereIn('name', $roles)->pluck('id');
        return SfApplicationStatusLog::where(['current_status' => 1])->whereIn('user_id', function ($q) use ($EmRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $EmRoles);
        })->groupBy(['user_id', 'application_id'])->whereIn('status_id', $status)->count();
    }
}
