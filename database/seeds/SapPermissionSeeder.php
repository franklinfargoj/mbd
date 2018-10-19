<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\RoleUser;
use App\User;
use App\PermissionRole;
use App\Permission;

class SapPermissionSeeder extends Seeder
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
        ];
    
        $sap = Role::where('name', '=', 'senior_architect_planner')->first();
        if ($sap) {
            $role_id = $sap->id;
        } else {
            $role_id = Role::insertGetId([
                'name' => 'senior_architect_planner',
                'redirect_to' => '/architect_layouts',
                'parent_id' => null,
                'display_name' => 'SAP',
                'description' => 'Login as SAP',
            ]);
        }

        $sap_user = User::where(['email' => 'sap@gmail.com'])->first();
        if ($sap_user) {
            $user_id = $sap_user->id;
        } else {
            $user_id = User::insertGetId([
                'name' => 'SAP',
                'email' => 'sap@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address' => 'Mumbai',
            ]);

        }
        if (RoleUser::where(['user_id' => $user_id, 'role_id' => $role_id])->first()) {

        } else {
            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        $permission_role = [];

        foreach ($permissions as $per) {
            $per = Permission::where(['name' => $per['name']])->first();
            if ($per) {
                $permission_id = $per->id;
            } else {
                $permission_id = Permission::insertGetId($per);
            }

            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $role_id])->first()) {
            } else {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }
        }
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }

        // $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        // if ($layout_id) {
        //     if (\App\LayoutUser::where(['user_id' => $user_id, 'layout_id' => $layout_id->id])->first()) {

        //     } else {
        //         \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
        //     }

        // }

    }
}
