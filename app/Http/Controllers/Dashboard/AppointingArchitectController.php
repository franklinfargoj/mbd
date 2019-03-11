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
    public function index()
    {
        //apponting architect
        $architect_dashboard = new AppointingArchitectController();
        $appointing_count = $architect_dashboard->total_number_of_application();
        return view('admin.dashboard.appointing_architect.main',compact('appointing_count'));
    }
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

    public function ajaxDashboard(Request $request){

        if ($request->ajax()) {
            $this->architect_dashboard = new AppointingArchitectController();

            if($request->module_name == 'Appointing Architect'){
                if (in_array(session()->get('role_name'),array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'),config('commanConfig.selection_commitee')))) {
                    $data['Total Number of Applications']=$this->architect_dashboard->total_number_of_application();
                    $data['Total Shortlisted Application'] = $this->architect_dashboard->total_shortlisted_application();
                    $data['Total Final Application'] = $this->architect_dashboard->total_final_application();
                    $data['Pending at Current User'] = $this->architect_dashboard->pending_at_current_user();

                    return $data;
                }
            }

            if($request->module_name == 'Appointing Architect Subordinate Pendency'){
                if (in_array(session()->get('role_name'),array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'),config('commanConfig.selection_commitee')))) {
                    $pending_at_jr_architect = $this->architect_dashboard->pending_at_user(array(config('commanConfig.junior_architect')));
                    $pending_at_sr_architect = $this->architect_dashboard->pending_at_user(array(config('commanConfig.senior_architect')));
                    $pending_at_architect = $this->architect_dashboard->pending_at_user(array(config('commanConfig.architect')));
                    $pending_at_selection_committee = $this->architect_dashboard->pending_at_user(array(config('commanConfig.selection_commitee')));

                    $data['Pending at Junior Architect'] = $pending_at_jr_architect;
                    $data['Pending at Senior Architect'] = $pending_at_sr_architect;
                    $data['Pending at Architect'] = $pending_at_architect;
                    $data['Pending at Selection Comitee'] = $pending_at_selection_committee;

                    return $data;
                }
            }


        }

    }


}
