<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmploymentOfArchitect\EoaApplication;
use App\ArchitectApplicationStatusLog;
use DB;
use App\Role;
class AppointingArchitectController extends Controller
{
    public function total_number_of_application()
    {
       // $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return EoaApplication::all()->count();
    }

    public function total_shortlisted_application()
    {
        return EoaApplication::where('application_status',config('commanConfig.architect_application_status.shortListed'))->get()->count();
    }

    public function total_final_application()
    {
        return EoaApplication::where('application_status',config('commanConfig.architect_application_status.final'))->get()->count();
    }

    public function pending_at_current_user()
    {
        //dd(config('commanConfig.architect_applicationStatus.scrutiny_pending'));
        return EoaApplication::where(DB::raw(config('commanConfig.architect_applicationStatus.scrutiny_pending')), '=', function ($q) {
            $q->from('architect_application_status_logs')
                ->select('status_id')
                ->where('architect_application_id', '=', DB::raw('eoa_applications.id'))
                ->where('user_id', auth()->user()->id)
                ->where('role_id', session()->get('role_id'))
                ->limit(1)
                ->orderBy('id', 'desc');
        })->get()->count();
    }

    public function pending_at_user($role)
    {
        $roles = $role;
        $status = array(config('commanConfig.architect_applicationStatus.scrutiny_pending'));
        $ArchRoles = Role::whereIn('name', $roles)->pluck('id');
        return EoaApplication::where(DB::raw(config('commanConfig.architect_applicationStatus.scrutiny_pending')), '=', function ($q){
            $q->from('architect_application_status_logs')
                ->select('status_id')
                ->where('architect_application_id', '=', DB::raw('eoa_applications.id'))
                ->limit(1)
                ->orderBy('id', 'desc');
        })->where(DB::raw($ArchRoles[0]), function ($q){
            $q->from('architect_application_status_logs')
                ->select('role_id')
                ->where('architect_application_id', '=', DB::raw('eoa_applications.id'))
                ->limit(1)
                ->orderBy('id', 'desc');
        })->get()->count();
    }
}
