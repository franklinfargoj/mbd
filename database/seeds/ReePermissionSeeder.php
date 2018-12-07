<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

class ReePermissionSeeder extends Seeder
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
                'name' => 'ree_dashboard.index',
                'display_name' => 'REE Dashboard',
                'description' => 'REE Dashboard',
            ],
            [
                'name' => 'ree_applications.index',
                'display_name' => 'REE Dashboard',
                'description' => 'REE Dashboard',
            ],
            [
                'name' => 'ol_calculation_sheet.show',
                'display_name' => 'Calculation Sheet',
                'description' => 'Application calculation sheet',
            ],
            [
                'name' => 'ree.society_EE_documents',
                'display_name' => 'society EE documents',
                'description' => 'society EE documents',
            ],
            [
                'name' => 'ree.EE_Scrutiny_Remark',
                'display_name' => 'EE Scrutiny Remark',
                'description' => 'EE Scrutiny Remark',
            ],
            [
                'name' => 'ree.dyce_scrutiny_remark',
                'display_name' => 'dyce scrutiny remark',
                'description' => 'dyce scrutiny remark',
            ],
            [
                'name' => 'ree.forward_application',
                'display_name' => 'forward application',
                'description' => 'forward application',
            ],
            [
                'name' => 'ree.forward_application_data',
                'display_name' => 'forward application data',
                'description' => 'forward application data',
            ],
            [
                'name' => 'ree.download_cap_note',
                'display_name' => 'download cap note',
                'description' => 'download cap note',
            ],
            [
                'name' => 'save_calculation_details',
                'display_name' => 'Save calculation details',
                'description' => 'Save calculation details',
            ],
            [
                'name' => 'ree.upload_ree_note',
                'display_name' => 'Upload ree note',
                'description' => 'Upload ree note',
            ],
            [
                'name' => 'ol_sharing_calculation_sheet.show',
                'display_name' => 'Sharing Calculation Sheet',
                'description' => 'Sharing Application calculation sheet',
            ],
            [
                'name' => 'save_sharing_calculation_details',
                'display_name' => 'Save sharing calculation details',
                'description' => 'Save sharing calculation details',
            ],
            [
                'name' => 'Ree test',
                'display_name' => 'Ree test',
                'description' => 'Ree test',
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
                'name'=>'delete_architect_layout_scrutiny_report',
                'display_name'=>'delete_architect_layout_scrutiny_report',
                'description'=>'delete_architect_layout_scrutiny_report'
            ],
            [
                'name' => 'upload_ree_checklist_and_remark_report',
                'display_name' => 'upload_ree_checklist_and_remark_report',
                'description' => 'upload_ree_checklist_and_remark_report',
            ],
            [
                'name' => 'post_ree_checklist_and_remark_report',
                'display_name' => 'post_ree_checklist_and_remark_report',
                'description' => 'post_ree_checklist_and_remark_report',
            ],
            [
                'name'=>'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'display_name'=>'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'description'=>'architect_Layout_scrutiny_of_ee_em_lm_ree'
            ],
            [
                'name'=>'architect_layout_prepare_layout_excel',
                'display_name'=>'architect_layout_prepare_layout_excel',
                'description'=>'architect_layout_prepare_layout_excel'
            ],
            [
                'name'=>'ree_applications.reval',
                'display_name'=>'Applications for revalidation',
                'description'=>'Applications for revalidation'
            ],
            [
                'name'=>'ree.society_reval_documents',
                'display_name'=>'Society Revalidation Documents',
                'description'=>'Society Revalidation Documents'
            ],
            [
                'name'=>'ree.forward_reval_application',
                'display_name'=>'Forward Revalidation Application',
                'description'=>'Forward Revalidation Application'
            ],
            [
                'name'=>'save_reval_calculation_details',
                'display_name'=>'Save Revalidation Calculation Details',
                'description'=>'Save Revalidation Calculation Details'
            ],
            [
                'name'=>'ol_reval_calculation_sheet.show',
                'display_name'=>'Show Revalidation Calculation Sheet',
                'description'=>'Show Revalidation Calculation Sheet'
            ],
            [
                'name'=>'save_reval_sharing_calculation_details',
                'display_name'=>'Save Revalidation Calculation Details',
                'description'=>'Save Revalidation Calculation Details'
            ],
            [
                'name'=>'ol_reval_sharing_calculation_sheet.show',
                'display_name'=>'Show Revalidation Sharing Calculation Sheet',
                'description'=>'Show Revalidation Sharing Calculation Sheet'
            ],
            [
                'name'=>'ree.dashboard',
                'display_name'=>'ree dashboard',
                'description'=>'REE Dashboard'
            ],
            [
                'name'=>'ree.save_custom_calculation_data',
                'display_name'=>'save custom calculation data',
                'description'=>'save custom calculation data'
            ],            
            [
                'name'=>'ree_applications.custom_calculation_sheet',
                'display_name'=>'custom calculation sheet',
                'description'=>'custom calculation sheet'
            ],            
            [
                'name'=>'ree_applications.calculation_sheet_options',
                'display_name'=>'calculation sheet options',
                'description'=>'calculation sheet options'
            ],
            [
                'name'=>'ree.forward_reval_application_data',
                'display_name'=>'forward revalidation application',
                'description'=>'forward revalidation application'
            ],
            [
                'name'=>'ree.download_reval_cap_note',
                'display_name'=>'Download revalidation application cap note',
                'description'=>'Download revalidation application cap note'
            ],
            [
                'name'=>'ree.send_reval_letter_society',
                'display_name'=>'Send approved & revalidated offer letter to society',
                'description'=>'Send approved & revalidated offer letter to society'
            ]
        ];

        // Role

        // REE branch head
        $ree_role_id = Role::where('name', 'ree_engineer')->value('id');
        if ($ree_role_id == null) {
            $ree_role_id = Role::insertGetId([
                'name' => 'ree_engineer',
                'redirect_to' => '/ree_applications',
                'dashboard' => '/ree_dashboard',
                'parent_id' => null,
                'display_name' => 'Residential Executive Engineer',
                'description' => 'Login as Residential Executive Engineer',
            ]);
        }

        // REE Assistant Engineer
        $ree_as_role_id = Role::where('name', 'REE Assistant Engineer')->value('id');
        if ($ree_as_role_id == null) {
            $ree_as_role_id = Role::insertGetId([
                'name' => 'REE Assistant Engineer',
                'redirect_to' => '/ree_applications',
                'dashboard' => '/ree_dashboard',
                'parent_id' => $ree_role_id,
                'display_name' => 'REE Assistant Engineer',
                'description' => 'Login as REE Assistant Engineer',
            ]);
        }

        // REE Deputy Engineer
        $ree_deputy_role_id = Role::where('name', 'REE deputy Engineer')->value('id');
        if ($ree_deputy_role_id == null) {
            $ree_deputy_role_id = Role::insertGetId([
                'name' => 'REE deputy Engineer',
                'redirect_to' => '/ree_applications',
                'dashboard' => '/ree_dashboard',
                'parent_id' => $ree_as_role_id,
                'display_name' => 'REE Deputy Engineer',
                'description' => 'Login as REE Deputy Engineer',
            ]);
        }

        // REE Junior Engineer
        $ree_Jr_role_id = Role::where('name', 'REE Junior Engineer')->value('id');
        if ($ree_Jr_role_id == null) {
            $ree_Jr_role_id = Role::insertGetId([
                'name' => 'REE Junior Engineer',
                'redirect_to' => '/ree_applications',
                'dashboard' => '/ree_dashboard',
                'parent_id' => $ree_deputy_role_id,
                'display_name' => 'REE Junior Engineer',
                'description' => 'Login as REE Junior Engineer',
            ]);
        }

        // User and Role Mapping

        // REE User
        $ree_user_id = User::where('email', 'neelam1.tambe@wwindia.com')->value('id');
        if ($ree_user_id == null) {
            $ree_user_id = User::insertGetId([
                'name' => 'Neelam',
                'email' => 'neelam1.tambe@wwindia.com',
                'password' => bcrypt('neelam123'),
                'role_id' => $ree_role_id,
                'mobile_no' => '9969054274',
                'address' => 'Mumbai',
                'uploaded_note_path' => 'Test',
            ]);

            RoleUser::insert([
                'user_id' => $ree_user_id,
                'role_id' => $ree_role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        // REE Assisatant User
        $ree_as_user_id = User::where('email', 'ree1@gmail.com')->value('id');
        if ($ree_as_user_id == null) {
            $ree_as_user_id = User::insertGetId([
                'name' => 'REE1',
                'email' => 'ree1@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $ree_as_role_id,
                'mobile_no' => '9969054274',
                'address' => 'Mumbai',
                'uploaded_note_path' => 'Test',
            ]);

            RoleUser::insert([
                'user_id' => $ree_as_user_id,
                'role_id' => $ree_as_role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        // REE Deputy User
        $ree_deputy_user_id = User::where('email', 'ree2@gmail.com')->value('id');
        if ($ree_deputy_user_id == null) {
            $ree_deputy_user_id = User::insertGetId([
                'name' => 'REE2',
                'email' => 'ree2@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $ree_deputy_role_id,
                'mobile_no' => '9969054274',
                'address' => 'Mumbai',
                'uploaded_note_path' => 'Test',
            ]);

            RoleUser::insert([
                'user_id' => $ree_deputy_user_id,
                'role_id' => $ree_deputy_role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        // REE Junior User
        $ree_Jr_user_id = User::where('email', 'ree3@gmail.com')->value('id');
        if ($ree_Jr_user_id == null) {
            $ree_Jr_user_id = User::insertGetId([
                'name' => 'REE3',
                'email' => 'ree3@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $ree_Jr_role_id,
                'mobile_no' => '9969054274',
                'address' => 'Mumbai',
                'uploaded_note_path' => 'Test',
            ]);

            RoleUser::insert([
                'user_id' => $ree_Jr_user_id,
                'role_id' => $ree_Jr_role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        // Permissions
        foreach ($permissions as $permission) {

            $per = Permission::where('name', $permission['name'])->first();
            if ($per) {
                $permission_id = $per->id;
            } else {

                $permission_id = Permission::insertGetId($permission);
            }

            $ree_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $ree_role_id,
            ]];
            
            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $ree_role_id])->first()) {
            } else {
                PermissionRole::insert($ree_role_permission);
            }
            
            $ree_as_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $ree_as_role_id,
            ]];
            
            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $ree_as_role_id])->first()) {
            } else {
                PermissionRole::insert($ree_as_role_permission);
            }

            $ree_deputy_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $ree_deputy_role_id,
            ]];
            
            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $ree_deputy_role_id])->first()) {
            } else {
                PermissionRole::insert($ree_deputy_role_permission);
            }
            $ree_Jr_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $ree_Jr_role_id,
            ]];
            
            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $ree_Jr_role_id])->first()) {
            } else {
                PermissionRole::insert($ree_Jr_role_permission);
            }

            // Layout User Mapping
           // $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();

            $layouts = \App\MasterLayout::pluck('id')->toArray();

            foreach($layouts as $layout_id) {
                if (\App\LayoutUser::where(['user_id' => $ree_user_id, 'layout_id' => $layout_id])->first()) {

                } else {
                    \App\LayoutUser::insert(['user_id' => $ree_user_id, 'layout_id' => $layout_id]);
                }

                if (\App\LayoutUser::where(['user_id' => $ree_as_user_id, 'layout_id' => $layout_id])->first()) {

                } else {
                    \App\LayoutUser::insert(['user_id' => $ree_as_user_id, 'layout_id' => $layout_id]);
                }

                if (\App\LayoutUser::where(['user_id' => $ree_deputy_user_id, 'layout_id' => $layout_id])->first()) {

                } else {
                    \App\LayoutUser::insert(['user_id' => $ree_deputy_user_id, 'layout_id' => $layout_id]);
                }

                if (\App\LayoutUser::where(['user_id' => $ree_Jr_user_id, 'layout_id' => $layout_id])->first()) {

                } else {
                    \App\LayoutUser::insert(['user_id' => $ree_Jr_user_id, 'layout_id' => $layout_id]);
                }
            }
        }
    }
}
