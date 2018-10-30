<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class AppointingArchitectPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'         => 'appointing_architect.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],
            [
                'name'         => 'appointing_architect.step1',
                'display_name' => 'step1',
                'description'  => 'step1'
            ],
            [
                'name'         => 'appointing_architect.step1_post',
                'display_name' => 'step1_post',
                'description'  => 'step1_post'
            ],
            [
                'name'         => 'appointing_architect.step2',
                'display_name' => 'step2',
                'description'  => 'step2'
            ],
            [
                'name'         => 'appointing_architect.step2_post',
                'display_name' => 'step2_post',
                'description'  => 'step2_post'
            ],
            [
                'name'         => 'appointing_architect.step3',
                'display_name' => 'step3',
                'description'  => 'step3'
            ],
            [
                'name'         => 'appointing_architect.step3_post',
                'display_name' => 'step3_post',
                'description'  => 'step3_post'
            ],
            [
                'name'         => 'appointing_architect.step4',
                'display_name' => 'step4',
                'description'  => 'step4'
            ],
            [
                'name'         => 'appointing_architect.step4_post',
                'display_name' => 'step4_post',
                'description'  => 'step4_post'
            ],
            [
                'name'         => 'appointing_architect.step5',
                'display_name' => 'step5',
                'description'  => 'step5'
            ],
            [
                'name'         => 'appointing_architect.step5_post',
                'display_name' => 'step5_post',
                'description'  => 'step5_post'
            ],
            [
                'name'         => 'appointing_architect.step6',
                'display_name' => 'step6',
                'description'  => 'step6'
            ],
            [
                'name'         => 'appointing_architect.step6_post',
                'display_name' => 'step6_post',
                'description'  => 'step6_post'
            ],
            [
                'name'         => 'appointing_architect.step7',
                'display_name' => 'step7',
                'description'  => 'step7'
            ],
            [
                'name'         => 'appointing_architect.step7_post',
                'display_name' => 'step7_post',
                'description'  => 'step7_post'
            ],
            [
                'name'         => 'appointing_architect.step8',
                'display_name' => 'step8',
                'description'  => 'step8'
            ],
            [
                'name'         => 'appointing_architect.step8_post',
                'display_name' => 'step8_post',
                'description'  => 'step8_post'
            ],
            [
                'name'=>'appointing_architect.delete_imp_project',
                'display_name'=>'appointing_architect.delete_imp_project',
                'description'=>'Delete imp project'
            ],
            [
                'name'=>'appointing_architect.delete_imp_project_work_handled',
                'display_name'=>'appointing_architect.delete_imp_project_work_handled',
                'description'=>'appointing_architect.delete_imp_project_work_handled'
            ],
            [
                'name'=>'appointing_architect.delete_imp_senior_professional',
                'display_name'=>'appointing_architect.delete_imp_senior_professional',
                'description'=>'appointing_architect.delete_imp_senior_professional'
            ]
        ];
        $appointing_architect = Role::where('name', '=', 'appointing_architect')->select('id')->first();

        if($appointing_architect)
        {
            $role_id=$appointing_architect->id;
        }else
        {
            $role_id = Role::insertGetId([
                'name'         => 'appointing_architect',
                'redirect_to'  => '/appointing_architect/index',
                'parent_id'    => NULL,
                'display_name' => 'appointing_architect',
                'description'  => 'appointing_architect'
            ]);
        }

        $permission_role = [];

        foreach($permissions as $per)
        {
            $permission=Permission::where(['name'=>$per['name']])->first();
            if($permission)
            {
                $permission_id=$permission->id;
            }else
            {
                $permission_id = Permission::insertGetId($per);
            }
            
            if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $role_id])->first())
            {

            }else
            {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }
            
        }
        if(count($permission_role)>0)
        {
            PermissionRole::insert($permission_role); 
        }
               
    }
}
