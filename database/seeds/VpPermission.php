<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class VpPermission extends Seeder
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
                'name'         => 'vp.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],
            [
                'name'         => 'vp.EE_scrutiny_remark',
                'display_name' => 'scrutiny_remark',
                'description'  => 'scrutiny_remark'
            ],
            [
                'name'         => 'vp.society_EE_documents',
                'display_name' => 'society_EE_documents',
                'description'  => 'society_EE_documents'
            ],
            [
                'name'         => 'vp.dyce_Scrutiny_Remark',
                'display_name' => 'EE_Scrutiny_Remark',
                'description'  => 'EE_Scrutiny_Remark'
            ],
            [
                'name'         => 'vp.forward_application',
                'display_name' => 'forward_application',
                'description'  => 'forward_application'
            ],
            [
                'name'         => 'vp.forward_application_data',
                'display_name' => 'forward_application_data',
                'description'  => 'forward_application_data'
            ],
            [
                'name'         => 'vp.cap_notes',
                'display_name' => 'cap notes',
                'description'  => 'cap notes'
            ],
            [
                'name' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'display_name' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'description' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
            ],
            [
                'name' => 'architect_layout_prepare_layout_excel',
                'display_name' => 'architect_layout_prepare_layout_excel',
                'description' => 'architect_layout_prepare_layout_excel',
            ],
            [
                'name' => 'architect_layout.index',
                'display_name' => 'List layouts',
                'description' => 'Listing of architect layouts',
            ],
            [
                'name' => 'architect_layouts_layout_details.index',
                'display_name' => 'architect_layouts_layout_details.index',
                'description' => 'architect_layouts_layout_details.index',
            ],
            [
                'name' => 'architect_layout_details.view',
                'display_name' => 'architect_layout_details.view',
                'description' => 'architect_layout_details.view',
            ],
            [
                'name' => 'architect_layout_detail_view_cts_plan',
                'display_name' => 'architect_layout_detail_view_cts_plan',
                'description' => 'architect_layout_detail_view_cts_plan',
            ],
            [
                'name' => 'architect_layout_detail_view_prc_detail',
                'display_name' => 'architect_layout_detail_view_prc_detail',
                'description' => 'architect_layout_detail_view_prc_detail',
            ],
            [
                'name' => 'architect_detail_dp_crz_remark_view',
                'display_name' => 'architect_detail_dp_crz_remark_view',
                'description' => 'architect_detail_dp_crz_remark_view',
            ],
            [
                'name' => 'view_court_case_or_dispute_on_land',
                'display_name' => 'view_court_case_or_dispute_on_land',
                'description' => 'view_court_case_or_dispute_on_land',
            ],
            [
                'name' => 'forward_architect_layout',
                'display_name' => 'forward_architect_layout',
                'description' => 'forward_architect_layout',
            ],
            [
                'name' => 'post_forward_architect_layout',
                'display_name' => 'post_forward_architect_layout',
                'description' => 'post_forward_architect_layout',
            ],
            [
                'name'=>'dashboard',
                'display_name'=>'dashboard',
                'description'=>'Dashboard'
            ]
        ];

        $vp_manager = Role::where('name', '=', 'vp_engineer')->first();
        if($vp_manager)
        {
            $role_id = $vp_manager->id;
        }else
        {
            $role_id = Role::insertGetId([
                'name'         => 'vp_engineer',
                'redirect_to'  => '/dashboard',
                'parent_id'    => NULL,
                'display_name' => 'VP_Engineer',
                'description'  => 'Login as VP Engineer'
            ]);
        }
        $vp_user=User::where(['email'=>'vp@gmail.com'])->first();
        if($vp_user)
        {
            $user_id=$vp_user->id;
        }else
        {
            $user_id = User::insertGetId([
                'name'      => 'VP user',
                'email'     => 'vp@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);
        }
        
        if(RoleUser::where(['user_id' => $user_id,'role_id'=> $role_id])->first())
        {

        }else
        {   
            $role_user = RoleUser::insert([
                'user_id'    => $user_id,
                'role_id'    => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        $permission_role = [];

        foreach ($permissions as $per) {
            $permission=Permission::where(['name'=>$per['name']])->first();
            if($permission)
            {   
                $permission_id = $permission->id;
            }else
            {
                $permission_id = Permission::insertGetId($per);
            }
            
            if(PermissionRole::where(['permission_id' => $permission_id,'role_id'=> $role_id])->first())
            {

            }else
            {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $role_id,
                ];
            }
            
        }
        if(count($permission_role)>0)
        {
            PermissionRole::insert($permission_role);
        }
        
            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
            if($layout_id)
            {
                if(\App\LayoutUser::where(['user_id' => $user_id, 'layout_id' => $layout_id->id])->first())
                {

                }else
                {
                    \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
                }
                
            }
    }
}
