<?php

use Illuminate\Database\Seeder;

use App\Role;

use App\User;

use App\RoleUser;

use App\Permission;

use App\PermissionRole;

class SelectionCommiteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $architect_permissions = [
            [
                'name' => 'architect_application',
                'display_name' => 'List architect Application',
                'description' => 'Listing EE Application'
            ],
            [
                'name' => 'shortlisted_architect_application',
                'display_name' => 'shortlisted_architect_application',
                'description' => 'shortlisted_architect_application'
            ],
            [
                'name' => 'final_architect_application',
                'display_name' => 'final_architect_application',
                'description' => 'final_architect_application'
            ],
            [
                'name' => 'architect.post_forward_application',
                'display_name' => 'post_forward_application',
                'description' => 'post_forward_application'
            ],
            [
                'name' => 'evaluate_architect_application',
                'display_name' => 'evaluate_architect_application',
                'description' => 'evaluate_architect_application'
            ],
            [
                'name' => 'architect.forward_application',
                'display_name' => 'forward_application',
                'description' => 'forward_application'
            ],
            [
                'name' => 'finalise_architect_application',
                'display_name' => 'finalise_architect_application',
                'description' => 'finalise_architect_application'
            ],
            [
                'name'=>'view_architect_application',
                'display_name'=>'view_architect_application',
                'description'=>'view_architect_application'
            ],
            [
                'name'=>'appointing_architect_dashboard',
                'display_name'=>'appointing_architect_dashboard',
                'description'=>'appointing_architect_dashboard'
            ],
            [
                'name'=>'appointing_architect_dashboard.ajax',
                'display_name'=>'appointing_architect_dashboard AJAX',
                'description'=>'appointing_architect_dashboard ajax'
            ],

        ];
        if(Role::where(['name'=>'selection_commitee'])->first())
            {
                $selection_commitee_id=Role::where(['name'=>'selection_commitee'])->first();
                $selection_commitee_id=$selection_commitee_id->id;
                $dashboard_path=Role::where(['name'=>'selection_commitee','dashboard' => '/architect_application'])->first();
                if($dashboard_path)
                {
                    //dd($dashboard_path);
                    $dashboard_path->dashboard='/appointing_architect_dashboard';
                    $dashboard_path->save();
                }
            }else
            {
                $selection_commitee_id=Role::insertGetId([
                    'name' => 'selection_commitee',
                    'redirect_to' => '/architect_application',
                    'dashboard' => '/appointing_architect_dashboard',
                    'parent_id' => NULL,
                    'display_name' => 'Selection Commitee',
                    'description' => 'Selection Commitee'
                ]);
            }
            if(User::where(['email'=>'amar.prajapati@gmail.com'])->first())
            {
                $selection_commitee_user_id=User::where(['email'=>'amar.prajapati@gmail.com'])->first();
                $selection_commitee_user_id=$selection_commitee_user_id->id;
            }else
            {
                $selection_commitee_user_id = User::insertGetId([
                    'name' => 'Amar Prajapati',
                    'email' => 'amar.prajapati@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $selection_commitee_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '8585652545',
                    'address' => 'Mumbai'
                ]);
            }

            if(!RoleUser::where(['user_id'=>$selection_commitee_user_id,'role_id'=>$selection_commitee_id])->first())
            {
                $architect_role_user = RoleUser::insert([
                    'user_id' => $selection_commitee_user_id,
                    'role_id' => $selection_commitee_id,
                    'start_date' => \Carbon\Carbon::now()
                ]);
            }

            $architect_permission_role = [];
            $ee_permission_id="";
            foreach ($architect_permissions as $ee) {
                $permission=Permission::where(['name'=>$ee['name']])->first();
                if($permission)
                {
                    $ee_permission_id = $permission->id;
                }else
                {
                    $ee_permission_id = Permission::insertGetId($ee);
                }
               
                if(!PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$selection_commitee_id])->first())
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $selection_commitee_id,
                    ];
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
            }
    }
}
