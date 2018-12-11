<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayout;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\Layout\ArchitectLayoutStatusLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Common\CommonController;

class ArchitectLayoutDashboardController extends Controller
{

    public function dashboard(){
        $this->getAllRoles();
        $ee_roles = $this->getEERoles();
        $em_roles = $this->getEMRoles();
        $ree_roles = $this->getREERoles();


        $user_id = Auth::id();

        $allData = ['total'=>['user' => ['type'=>'user_id','id' => $user_id],
                              'status'=>[2,3,4,5],
                              'excel'=>0,
                              ],
                    'pending_at_user'=>['user' => ['type'=>'user_id','id' => $user_id],
                        'status'=>[2],
                        'excel'=>0,
                    ],
                    'sent_to_ee'=>['user' => ['type'=>'role_id','id' => $ee_roles],
                        'status'=>[2],
                        'excel'=>0,
                    ],
                    'sent_to_em'=>['user' => ['type'=>'role_id','id' => $em_roles],
                        'status'=>[2],
                        'excel'=>0,
                    ],
                    'sent_to_ree'=>['user' => ['type'=>'role_id','id' => $ree_roles],
                        'status'=>[2],
                        'excel'=>0,
                    ],
                    'forward_for_approval'=>['user' => ['type'=>'user_id','id' => $user_id],
                    'status'=>[3],
                    'excel'=>1,
                    ]
                   ];

        $count_array = [];
        foreach ($allData as $key => $data){
            $count_array[$key] = $this->getCountOfLayoutArchitect($data['user'],$data['status'],$data['excel']);
        }
       // print_r($count_array['total'][0]->count);
        //dd($count_array);

       return view('admin.dashboard.architect_layout.dashboard',compact('count_array'));
    }


    function getCountOfLayoutArchitect($user,$status,$excel){
        ($user['type'] == 'user_id')?$subquery = 'where':$subquery ='whereIn';

        $type = $user['type'];
        $id = $user['id'];


        $architect_status_count =  DB::table('architect_layout_status_logs AS logs')
            ->join('architect_layouts AS master','logs.architect_layout_id', '=', 'master.id');
            if(true==false)
            {
                $architect_status_count =$architect_status_count->join('layout_user as lu', 'lu.layout_id','=','master.layout_name');
            }

            $architect_status_count =$architect_status_count ->whereIn('logs.id',function($query) use ($subquery,$type,$id){
                $query->select(DB::raw('max(id)'))
                    ->from('architect_layout_status_logs')
                    ->$subquery($type,$id)
                    ->groupby('architect_layout_id');
            })
            ->whereIn('status_id',$status)
            ->where('layout_excel_status',$excel);
            if(true==false){
                $architect_status_count =$architect_status_count->whereIn('lu.user_id',function($query) use($id){
                $query->select(DB::raw('id'))
                    ->from('users')
                    ->whereIn('role_id',[$id]);
            });
            }


        $architect_status_count =$architect_status_count->select(DB::raw('count(status_id) as count'))
            ->get();

        return $architect_status_count->toArray();

    }

    function getEERoles(){
        $ee_roles = Role::whereIn('name',[config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_branch_head'),config('commanConfig.ee_deputy_engineer')])->pluck('id');
        return $ee_roles->toArray();
    }

    function getEMRoles(){
        $ee_roles = Role::whereIn('name',[config('commanConfig.estate_manager')])->pluck('id');
        return $ee_roles->toArray();
    }

    function getREERoles(){
        $ee_roles = Role::whereIn('name',[config('commanConfig.ree_junior'),config('commanConfig.ree_branch_head'),config('commanConfig.ree_deputy_engineer'),config('commanConfig.ree_assistant_engineer')])->pluck('id');
        return $ee_roles->toArray();
    }

    function getAllRoles(){

    }

}