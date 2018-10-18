<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

class EmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $em_manager = Role::where('name', '=', 'EM')->select('id')->first();

        if (!$em_manager) {
            $role_id = Role::insertGetId([
                'name' => 'EM',
                'redirect_to' => '/em',
                'display_name' => 'estate_manager',
                'description' => 'Login as Estae Manger',
            ]);
        } else {
            $role_id = $em_manager->id;
        }

        $em_user = User::where(['email' => 'em@gmail.com'])->first();
        if ($em_user) {
            $user_id = $em_user->id;
        } else {
            $user_id = User::insertGetId([
                'name' => 'estate namager',
                'email' => 'em@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '8785854587',
                'address' => 'Mumbai',
            ]);
        }

        $em_role_user = RoleUser::where(['user_id' => $user_id, 'role_id' => $role_id])->first();
        if ($em_role_user) {

        } else {
            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        $permissions = [
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
                'name' => 'architect_layout_get_scrtiny',
                'display_name' => 'architect_layout_get_scrtiny',
                'description' => 'architect_layout_get_scrtiny',
            ],
            [
                'name' => 'architect_layout_add_scrutiny_report',
                'display_name' => 'architect_layout_add_scrutiny_report',
                'description' => 'architect_layout_add_scrutiny_report',
            ],
            [
                'name' => 'architect_layout_post_scrutiny_report',
                'display_name' => 'architect_layout_post_scrutiny_report',
                'description' => 'architect_layout_post_scrutiny_report',
            ],
            [
                'name' => 'upload_em_checklist_and_remark_report',
                'display_name' => 'upload_em_checklist_and_remark_report',
                'description' => 'upload_em_checklist_and_remark_report',
            ],
            [
                'name' => 'post_em_checklist_and_remark_report',
                'display_name' => 'post_em_checklist_and_remark_report',
                'description' => 'post_em_checklist_and_remark_report',
            ],

        ];

        $permission_role = [];

        foreach ($permissions as $lm_per) {
            $permission = Permission::where(['name' => $lm_per['name']])->first();
            if ($permission) {
                $permission_id = $permission->id;
            } else {
                $permission_id = Permission::insertGetId($lm_per);
            }

            $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $role_id])->first();
            if (!$PermissionRole) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }

        }
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }
    }
}
