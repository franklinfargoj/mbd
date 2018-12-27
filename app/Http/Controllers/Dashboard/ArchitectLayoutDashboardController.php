<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayoutStatusLog;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\Layout\ArchitectLayout;

class ArchitectLayoutDashboardController extends Controller
{

    public function total_number_of_layouts()
    {
       // $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayout::all()->count();
    }

    public function appln_sent_for_arroval()
    {
        $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open' => 1])->whereNotIn('status_id', $status)->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->count();
    }

    public function approved_layouts()
    {
        $status = array(config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open' => 1])->whereIn('status_id', $status)->count();
    }

    public function total_no_of_appln_for_revision_and_approval()
    {
        $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open' => 1])->whereNotIn('status_id', $status)->count();
        //SELECT count(id) FROM architect_layout_status_logs where open=1 and status_id not in(1,6)
    }

    public function total_no_of_appln_for_revision()
    {
        $status = array(config('commanConfig.architect_layout_status.new_application'), config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open' => 1])->whereNotIn('status_id', $status)->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->count();
        //SELECT count(id) FROM architect_layout_status_logs where open=1 and status_id not in(1,6)
    }

    public function pending_at_current_user()
    {
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'), config('commanConfig.architect_layout_status.sent_for_revision'));
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'user_id' => auth()->user()->id])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('status_id', $status)->count();
        //SELECT * FROM `architect_layout_status_logs` where user_id=19 and current_status=1 and status_id in(2)
    }

    public function pending_at_jr_architect()
    {
        $roles = array(config('commanConfig.junior_architect'));
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'), config('commanConfig.architect_layout_status.sent_for_revision'));
        $JrArchRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1])->whereIn('user_id', function ($q) use ($JrArchRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $JrArchRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->whereIn('status_id', $status)->count();
    }

    public function pending_at_sr_architect()
    {
        $roles = array(config('commanConfig.senior_architect'));
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'), config('commanConfig.architect_layout_status.sent_for_revision'));
        $SrArchRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1])->whereIn('user_id', function ($q) use ($SrArchRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $SrArchRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->whereIn('status_id', $status)->count();
    }

    public function sent_to_ee()
    {
        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('user_id', function ($q) use ($EERoles) {
            $q->from('users')->select('id')->whereIn('role_id', $EERoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function ee_pending_at_role($role)
    {
         $roles = array($role);

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

         $EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('user_id', function ($q) use ($EERoles) {
            $q->from('users')->select('id')->whereIn('role_id', $EERoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function ree_pending_at_role($role)
    {
         $roles = array($role);

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

         $REERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($REERoles) {
            $q->from('users')->select('id')->whereIn('role_id', $REERoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_layout_before_layout_and_excel($layout_excel_status=null)
    {
        $layout_and_excel_status=0;
        $layout_and_excel_status=$layout_excel_status!=null?1:0;
        // $roles = array(config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        // $EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) use($layout_and_excel_status) {
            $q->where('layout_excel_status', $layout_and_excel_status);
        })->whereIn('user_id', [auth()->user()->id])->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function forwarded_layout_before_layout_and_excel($layout_excel_status=0)
    {
        $layout_and_excel_status=0;
        $layout_and_excel_status=$layout_excel_status!=null?1:0;
        //$roles = array(config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.forward');

        //$EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) use($layout_and_excel_status){
            $q->where('layout_excel_status', $layout_and_excel_status);
        })->whereIn('user_id', [auth()->user()->id])->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function reverted_layout_before_layout_and_excel($layout_excel_status=0)
    {
        $layout_and_excel_status=0;
        $layout_and_excel_status=$layout_excel_status!=null?1:0;
        //$roles = array(config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.reverted');

        //$EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) use($layout_and_excel_status){
            $q->where('layout_excel_status', $layout_and_excel_status);
        })->whereIn('user_id', [auth()->user()->id])->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function vp_approved_and_forwarded_layout()
    {
        //$roles = array(config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.approved');

        //$EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q){
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', [auth()->user()->id])->groupBy(['user_id', 'architect_layout_id'])->count();
        
    }

    public function sent_to_em()
    {
        $roles = array(config('commanConfig.estate_manager'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $EMRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('user_id', function ($q) use ($EMRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $EMRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id

    }

    public function sent_to_lm()
    {
        $roles = array(config('commanConfig.land_manager'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $LmRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('user_id', function ($q) use ($LmRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $LmRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function sent_to_ree()
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $ReeRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 0);
        })->whereIn('user_id', function ($q) use ($ReeRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $ReeRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function pending_at_ree()
    {
        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $ReeRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($ReeRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $ReeRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_at_co()
    {
        $roles = array(config('commanConfig.co_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $CoRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($CoRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $CoRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_at_cap()
    {
        $roles = array(config('commanConfig.cap_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $CapRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($CapRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $CapRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_at_sap()
    {
        $roles = array(config('commanConfig.senior_architect_planner'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $SapRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($SapRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $SapRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_at_la()
    {
        $roles = array(config('commanConfig.la_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $LaRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => $status])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($LaRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $LaRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function pending_at_vp()
    {
        $roles = array(config('commanConfig.vp_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $VpRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status' => 1, 'status_id' => 2])->whereHas('architect_layout', function ($q) {
            $q->where('layout_excel_status', 1);
        })->whereIn('user_id', function ($q) use ($VpRoles) {
            $q->from('users')->select('id')->whereIn('role_id', $VpRoles);
        })->groupBy(['user_id', 'architect_layout_id'])->count();
    }

    public function dashboard()
    {
        if (in_array(session()->get('role_name'),array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect')))) {
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['pending_at_current_user'] = $this->pending_at_current_user();
            $architect_data['sent_to_ee'] = $this->sent_to_ee();
            $architect_data['sent_to_ree'] = $this->sent_to_ree();
            $architect_data['sent_to_lm'] = $this->sent_to_lm();
            $architect_data['sent_to_em'] = $this->sent_to_em();
            $architect_data['approved_layouts'] = $this->approved_layouts();
            $architect_data['appln_sent_for_arroval'] = $this->appln_sent_for_arroval();
            $architect_data['pending_at_ree'] = $this->pending_at_ree();
            $architect_data['pending_at_co'] = $this->pending_at_co();
            $architect_data['pending_at_cap'] = $this->pending_at_cap();
            $architect_data['pending_at_sap'] = $this->pending_at_sap();
            $architect_data['pending_at_la'] = $this->pending_at_la();
            $architect_data['pending_at_vp'] = $this->pending_at_vp();
            $architect_data['pending_at_jr_architect'] = $this->pending_at_jr_architect();
            $architect_data['pending_at_sr_architect'] = $this->pending_at_sr_architect();
        }

        if (session()->get('role_name') == config('commanConfig.land_manager')) {
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['application_pending'] = $this->pending_layout_before_layout_and_excel();
            $architect_data['lm_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel();
        }

        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['application_pending'] = $this->pending_layout_before_layout_and_excel();
            $architect_data['em_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel();
        }

        if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head')))) {
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['application_pending'] = $this->pending_layout_before_layout_and_excel();
            $architect_data['ee_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel();
            if(session()->get('role_name')==config('commanConfig.ee_branch_head'))
            {
                $architect_data['jr_ee_pending'] = $this->ee_pending_at_role(config('commanConfig.ee_junior_engineer'));
                $architect_data['dy_ee_pending'] = $this->ee_pending_at_role(config('commanConfig.ee_deputy_engineer'));
                $architect_data['head_ee_pending'] = $this->ee_pending_at_role(config('commanConfig.ee_branch_head'));
            }
        }

        if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['application_pending'] = $this->pending_layout_before_layout_and_excel();
            $architect_data['ree_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel();
            $architect_data['appln_sent_for_arroval'] = $this->appln_sent_for_arroval();
            $architect_data['application_pending_after_layout_and_excel'] = $this->pending_layout_before_layout_and_excel(1);
            $architect_data['application_forwarded_after_layout_and_excel'] = $this->forwarded_layout_before_layout_and_excel(1);
            
            
            if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
            {
                $architect_data['jr_ree_pending'] = $this->ree_pending_at_role(config('commanConfig.ree_junior'));
                $architect_data['dy_ree_pending'] = $this->ree_pending_at_role(config('commanConfig.ree_deputy_engineer'));
                $architect_data['assistant_ree_pending'] = $this->ree_pending_at_role(config('commanConfig.ree_assistant_engineer'));
                $architect_data['head_ree_pending'] = $this->ree_pending_at_role(config('commanConfig.ree_branch_head'));
            }
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))
        {
            $architect_data['total_no_of_layout']=$this->total_number_of_layouts();
            $architect_data['layout_in_process']=$this->total_no_of_appln_for_revision_and_approval();
            $architect_data['approved_by_vp']=$this->approved_layouts();
            $architect_data['total_no_of_appln_for_revision'] = $this->total_no_of_appln_for_revision();
            $architect_data['pending_at_current_user'] = $this->pending_layout_before_layout_and_excel(1);
            $architect_data['sent_to_ee'] = $this->sent_to_ee();
            $architect_data['sent_to_ree'] = $this->sent_to_ree();
            $architect_data['sent_to_lm'] = $this->sent_to_lm();
            $architect_data['sent_to_em'] = $this->sent_to_em();
            $architect_data['approved_layouts'] = $this->approved_layouts();
            $architect_data['appln_sent_for_arroval'] = $this->appln_sent_for_arroval();
            $architect_data['pending_at_ree'] = $this->pending_at_ree();
            $architect_data['pending_at_co'] = $this->pending_at_co();
            $architect_data['pending_at_cap'] = $this->pending_at_cap();
            $architect_data['pending_at_sap'] = $this->pending_at_sap();
            $architect_data['pending_at_la'] = $this->pending_at_la();
            $architect_data['pending_at_vp'] = $this->pending_at_vp();
        }
        
        if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
        {
            $architect_data['total_no_of_appln_for_approval'] = $this->appln_sent_for_arroval();;
            $architect_data['layouts_pending_at_sap'] = $this->pending_layout_before_layout_and_excel(1);
            $architect_data['sap_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel(1);
            $architect_data['sap_reverted_layouts'] =$this->reverted_layout_before_layout_and_excel(1);
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
        {
            $architect_data['total_no_of_appln_for_approval'] = $this->appln_sent_for_arroval();;
            $architect_data['layouts_pending_at_cap'] = $this->pending_layout_before_layout_and_excel(1);
            $architect_data['cap_forwarded_layouts'] = $this->forwarded_layout_before_layout_and_excel(1);
            $architect_data['cap_reverted_layouts'] =$this->reverted_layout_before_layout_and_excel(1);
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
        {
            $architect_data['total_no_of_layout']=$this->total_number_of_layouts();
            $architect_data['layout_in_process']=$this->total_no_of_appln_for_revision_and_approval();
            $architect_data['approved_by_vp']=$this->approved_layouts();

            $architect_data['total_no_of_appln_for_approval'] = $this->appln_sent_for_arroval();;
            $architect_data['layouts_pending_at_vp'] = $this->pending_layout_before_layout_and_excel(1);
            $architect_data['vp_forwarded_and_approved_layouts'] = $this->vp_approved_and_forwarded_layout();
            $architect_data['vp_reverted_layouts'] =$this->reverted_layout_before_layout_and_excel(1);
        }

        return view('admin.dashboard.architect_layout.dashboard', compact('architect_data'));
    }

   

//     public function dashboard(){
    //         dd(Auth::id());
    //         dd($this->common->getEERoles());
    //         $user_id = Auth::id();
    //         $architect_status_count = ArchitectLayoutStatusLog::whereIn('id',function($query) use ($user_id){
    //             $query->select(DB::raw('max(id)'))
    //                 ->from('architect_layout_status_logs')
    //                 ->where('user_id',$user_id)
    //                 ->groupby('architect_layout_id');
    //         })
    //             ->select('status_id',DB::raw('count(status_id) as count'))
    //             ->groupby('status_id')
    //             ->get();
    //         //dd($architect_status_count->toArray());
    //         $architect_status_count = $architect_status_count->toArray();
    // //        dd($user_id);
    //         $status_type = config('commanConfig.architect_layout_status');
    //         //dd($status_type);
    //         $count_array=[];
    //         $match = 0;
    //         $count_array['total'] = 0;
    //         foreach ($status_type as $key => $status){
    //             foreach($architect_status_count as $architect_count){
    //                 if($architect_count['status_id'] == $status){
    //                     $count_array[$key] = $architect_count['count'];
    //                     $match = 1;
    //                     break;
    //                 }
    //                 $match = 0;
    //             }
    //             if($match != 1){
    //                 $count_array[$key] = 0;
    //             }
    //             $count_array['total'] = $count_array['total'] + $count_array[$key];
    //         }

//        return view('admin.dashboard.architect_layout.dashboard');
    //     }

}
