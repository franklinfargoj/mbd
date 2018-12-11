<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Layout\ArchitectLayoutStatusLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Common\CommonController;
use App\Role;

class ArchitectLayoutDashboardController extends Controller
{
    protected $common;
    public function __construct(CommonController $common){
        $this->common = $common;
    }

    public function appln_sent_for_arroval()
    {
        $status = array(config('commanConfig.architect_layout_status.new_application'),config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open'=>1])->whereNotIn('status_id',$status)->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->count();
    }

    public function approved_layouts()
    {
        $status = array(config('commanConfig.architect_layout_status.approved'));
        return ArchitectLayoutStatusLog::where(['open'=>1])->whereIn('status_id',$status)->count();
    }

    public function total_no_of_appln_for_revision()
    {
        $status = array(config('commanConfig.architect_layout_status.new_application'),config('commanConfig.architect_layout_status.approved'));
       return ArchitectLayoutStatusLog::where(['open'=>1])->whereNotIn('status_id',$status)->whereHas('architect_layout',function($q){
        $q->where('layout_excel_status',0);
    })->count();
        //SELECT count(id) FROM architect_layout_status_logs where open=1 and status_id not in(1,6)
    }

    public function pending_at_current_user()
    {
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'),config('commanConfig.architect_layout_status.sent_for_revision'));
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'user_id'=>auth()->user()->id])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',0);
        })->whereIn('status_id',$status)->count();
        //SELECT * FROM `architect_layout_status_logs` where user_id=19 and current_status=1 and status_id in(2)
    }

    public function pending_at_jr_architect()
    {
        $roles = array(config('commanConfig.junior_architect'));
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'),config('commanConfig.architect_layout_status.sent_for_revision'));
        $JrArchRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1])->whereIn('user_id',function($q) use($JrArchRoles){
            $q->from('users')->select('id')->whereIn('role_id',$JrArchRoles);
        })->groupBy(['user_id','architect_layout_id'])->whereIn('status_id',$status)->count();
    }

    public function pending_at_sr_architect()
    {
        $roles = array(config('commanConfig.senior_architect'));
        $status = array(config('commanConfig.architect_layout_status.scrutiny_pending'),config('commanConfig.architect_layout_status.sent_for_revision'));
        $SrArchRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1])->whereIn('user_id',function($q) use($SrArchRoles){
            $q->from('users')->select('id')->whereIn('role_id',$SrArchRoles);
        })->groupBy(['user_id','architect_layout_id'])->whereIn('status_id',$status)->count();
    }

    public function sent_to_ee()
    {
        $roles = array(config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.ee_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $EERoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',0);
        })->whereIn('user_id',function($q) use($EERoles){
            $q->from('users')->select('id')->whereIn('role_id',$EERoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function sent_to_em()
    {
        $roles = array(config('commanConfig.estate_manager'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $EMRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',0);
        })->whereIn('user_id',function($q) use($EMRoles){
            $q->from('users')->select('id')->whereIn('role_id',$EMRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    
    }

    public function sent_to_lm()
    {
        $roles = array(config('commanConfig.land_manager'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $LmRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',0);
        })->whereIn('user_id',function($q) use($LmRoles){
            $q->from('users')->select('id')->whereIn('role_id',$LmRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function sent_to_ree()
    {
       
        $roles = array(config('commanConfig.ree_junior'),config('commanConfig.ree_deputy_engineer'),config('commanConfig.ree_assistant_engineer'),config('commanConfig.ree_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $ReeRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',0);
        })->whereIn('user_id',function($q) use($ReeRoles){
            $q->from('users')->select('id')->whereIn('role_id',$ReeRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
        //select * from architect_layout_status_logs  where user_id in (11,10,9,8) and current_status=1 and status_id=2 group by user_id,architect_layout_id
    }

    public function pending_at_ree()
    {
        $roles = array(config('commanConfig.ree_junior'),config('commanConfig.ree_deputy_engineer'),config('commanConfig.ree_assistant_engineer'),config('commanConfig.ree_branch_head'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $ReeRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($ReeRoles){
            $q->from('users')->select('id')->whereIn('role_id',$ReeRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function pending_at_co()
    {
        $roles = array(config('commanConfig.co_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $CoRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($CoRoles){
            $q->from('users')->select('id')->whereIn('role_id',$CoRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function pending_at_cap()
    {
        $roles = array(config('commanConfig.cap_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $CapRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($CapRoles){
            $q->from('users')->select('id')->whereIn('role_id',$CapRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function pending_at_sap()
    {
        $roles = array(config('commanConfig.senior_architect_planner'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $SapRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($SapRoles){
            $q->from('users')->select('id')->whereIn('role_id',$SapRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function pending_at_la()
    {
        $roles = array(config('commanConfig.la_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $LaRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>$status])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($LaRoles){
            $q->from('users')->select('id')->whereIn('role_id',$LaRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function pending_at_vp()
    {
        $roles = array(config('commanConfig.vp_engineer'));

        $status = config('commanConfig.architect_layout_status.scrutiny_pending');

        $VpRoles = Role::whereIn('name', $roles)->pluck('id');
        return ArchitectLayoutStatusLog::where(['current_status'=>1,'status_id'=>2])->whereHas('architect_layout',function($q){
            $q->where('layout_excel_status',1);
        })->whereIn('user_id',function($q) use($VpRoles){
            $q->from('users')->select('id')->whereIn('role_id',$VpRoles);
        })->groupBy(['user_id','architect_layout_id'])->count();
    }

    public function dashboard(){
     $data['total_no_of_appln_for_revision']=$this->total_no_of_appln_for_revision();
     $data['pending_at_current_user']=$this->pending_at_current_user();
     $data['sent_to_ee']=$this->sent_to_ee();
     $data['sent_to_ree']=$this->sent_to_ree();
     $data['sent_to_lm']=$this->sent_to_lm();
     $data['sent_to_em']=$this->sent_to_em();
     $data['approved_layouts']=$this->approved_layouts();
     $data['appln_sent_for_arroval']=$this->appln_sent_for_arroval();
     $data['pending_at_ree']=$this->pending_at_ree();
     $data['pending_at_co']=$this->pending_at_co();
     $data['pending_at_cap']=$this->pending_at_cap();
     $data['pending_at_sap']=$this->pending_at_sap();
     $data['pending_at_la']=$this->pending_at_la();
     $data['pending_at_vp']=$this->pending_at_vp();
     $data['pending_at_jr_architect']=$this->pending_at_jr_architect();
     $data['pending_at_sr_architect']=$this->pending_at_sr_architect();
       return view('admin.dashboard.architect_layout.dashboard',compact('data'));
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