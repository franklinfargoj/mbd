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
        // EM Manager
        $em_manager_id = Role::where('name', '=', 'EM')->value('id');

        if ($em_manager_id == NULL)
            $em_manager_id = Role::insertGetId([
                'name' => 'EM',
                'redirect_to' => '/conveyance',
                'display_name' => 'estate_manager',
                'description' => 'Login as Estae Manger',
            ]);

        // EM User
        $em_user_id = User::where(['email' => 'em@gmail.com'])->value('id');

        if ($em_user_id == NULL )
            $em_user_id = User::insertGetId([
                'name' => 'estate manager',
                'email' => 'em@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $em_manager_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '8785854587',
                'address' => 'Mumbai',
            ]);

        // EM User and EM Manager Role Mapping
        $em_manager_role_user = RoleUser::where(['user_id' => $em_user_id, 'role_id' => $em_manager_id])->first();

        if($em_manager_role_user == NULL)
            RoleUser::insert([
                'user_id' => $em_user_id,
                'role_id' => $em_manager_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        // EM Manager Permissions
        $permissions = [
            [
                'name'=>'scrutiny-remark',
                'display_name'=>'list'
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
                'name' => 'upload_em_checklist_and_remark_report',
                'display_name' => 'upload_em_checklist_and_remark_report',
                'description' => 'upload_em_checklist_and_remark_report',
            ],
            [
                'name' => 'post_em_checklist_and_remark_report',
                'display_name' => 'post_em_checklist_and_remark_report',
                'description' => 'post_em_checklist_and_remark_report',
            ],
            [
                'name'         => 'conveyance.index',
                'display_name' => 'conveyance',
                'description'  => 'conveyance'
            ],
            [
                'name'         => 'conveyance.view_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
            ],
            [
                'name'         => 'em.scrutiny_remark',
                'display_name' => 'em scrutiny remark',
                'description'  => 'em scrutiny remark'
            ],
            [
                'name'         => 'em.save_renewal_no_dues_certificate',
                'display_name' => 'em save renewal no dues certificate',
                'description'  => 'em save renewal no dues certificate'
            ],
            [
                'name'         => 'em.upload_covering_letter',
                'display_name' => 'em upload covering letter',
                'description'  => 'em upload covering letter'
            ],
            [
                'name' => 'em.index',
                'display_name' => 'List EM Application',
                'description' => 'Listing EM Application'
            ],
            [
                'name' => 'get_societies',
                'display_name' => 'List Societies',
                'description' => 'Listing Societies'
            ],
            [
                'name' => 'get_buildings',
                'display_name' => 'List Buildings',
                'description' => 'Listing Buildings'
            ],
            [
                'name' => 'get_tenants',
                'display_name' => 'List Tenants',
                'description' => 'Listing Tenants'
            ],
            [
                'name' => 'soc_bill_level',
                'display_name' => 'Society bill level',
                'description' => 'Society bill level'
            ],
            [
                'name' => 'update_soc_bill_level',
                'display_name' => 'Update Society Bill Level',
                'description' => 'Update Society Bill Level'
            ],
            [
                'name' => 'soc_ward_colony',
                'display_name' => 'Society Ward Colony',
                'description' => 'Society Ward Colony'
            ],
            [
                'name' => 'update_soc_ward_colony',
                'display_name' => 'Update Society Ward Colony',
                'description' => 'Update Society Ward Colony'
            ],
            [
                'name' => 'get_wards',
                'display_name' => 'Get Wards',
                'description' => 'Get Wards'
            ],
            [
                'name' => 'get_colonies',
                'display_name' => 'Get Colonies',
                'description' => 'Get Colonies'
            ],
            [
                'name' => 'get_society_select',
                'display_name' => 'Selected Society',
                'description' => 'Selected Society'
            ],
            [
                'name' => 'get_building_ajax',
                'display_name' => 'Ajax building',
                'description' => 'Ajax building'
            ],
            [
                'name' => 'get_building_select',
                'display_name' => 'Selected Building',
                'description' => 'Selected Building'
            ],
            [
                'name' => 'get_tenant_ajax',
                'display_name' => 'Ajax Tenant',
                'description' => 'Ajax Tenant'
            ],
            [
                'name' => 'add_building',
                'display_name' => 'Add Building',
                'description' => 'Add Building'
            ],
            [
                'name' => 'edit_building',
                'display_name' => 'Edir Building Data',
                'description' => 'Edir Building Data'
            ],
            [
                'name' => 'create_building',
                'display_name' => 'Create Building',
                'description' => 'Create Building'
            ],
            [
                'name' => 'update_building',
                'display_name' => 'Update Building',
                'description' => 'Update Building'
            ],
            [
                'name' => 'add_tenant',
                'display_name' => 'Add Tenant',
                'description' => 'Add Tenant'
            ],
            [
                'name' => 'edit_tenant',
                'display_name' => 'Edit Tenant',
                'description' => 'Edit Tenant'
            ],
            [
                'name' => 'create_tenant',
                'display_name' => 'Create Tenant',
                'description' => 'Create Tenant'
            ],
            [
                'name' => 'update_tenant',
                'display_name' => 'Update Tenant',
                'description' => 'Update Tenant'
            ],
            [
                'name' => 'delete_tenant',
                'display_name' => 'Delete Tenant',
                'description' => 'Delete Tenant'
            ],
            [
                'name' => 'generate_soc_bill',
                'display_name' => 'Generate Society Bill',
                'description' => 'Generate Society Bill'
            ],
            [
                'name' => 'generate_tenant_bill',
                'display_name' => 'Generate Tenant Bill',
                'description' => 'Generate Tenant Bill'
            ],
            [
                'name' => 'arrears_calculations',
                'display_name' => 'Arrears Calculations',
                'description' => 'Arrears Calculationst'
            ],
            [
                'name' => 'billing_calculations',
                'display_name' => 'Biiling Calculations',
                'description' => 'Biiling Calculations'
            ],
            [
                'name' => 'generateTenantBill',
                'display_name' => 'Generate Tenant Bill',
                'description' => 'Generate Tenant Bill'
            ],
            [
                'name' => 'generateBuildingBill',
                'display_name' => 'Generate Building Bill',
                'description' => 'Generate Building Bill'
            ],
            [
                'name' => 'create_tenant_bill',
                'display_name' => 'Create Tenant Bill',
                'description' => 'Create Tenant Bill'
            ],
            [
                'name' => 'create_society_bill',
                'display_name' => 'Create Building Bill',
                'description' => 'Create Building Bill'
            ],
            [
                'name' => 'conveyance.view_documents',
                'display_name' => 'View Documents',
                'description' => 'View Documents Submitted'
            ],
            [
                'name' => 'em.save_conveyance_no_dues_certificate',
                'display_name' => 'Save no dues certificate',
                'description' => 'Saves no dues certificate'
            ]
        ];

        $permission_role = [];

        foreach ($permissions as $lm_per) {
            $permission_id = Permission::where(['name' => $lm_per['name']])->value('id');

            if (!($permission_id))
                $permission_id = Permission::insertGetId($lm_per);

            $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $em_manager_id])->first();

            if (!$PermissionRole) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $em_manager_id,
                ];
            }

        }
        
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }

        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->value('id');
        $layout_user =  \App\LayoutUser::where('user_id',$em_user_id)->where('layout_id',$layout_id)->first();

        if(!$layout_user){
            \App\LayoutUser::insert(['user_id' => $em_user_id, 'layout_id' => $layout_id]);
        }


        // EM Clerk
        $em_cl_role_id = Role::where('name','em_clerk')->value('id');

        if($em_cl_role_id  == NULL)
            $em_cl_role_id = Role::insertGetId([
                'name' => 'em_clerk',
                'redirect_to' => '/em_clerk',
                'parent_id' => $em_manager_id,
                'display_name' => 'EM Clerk',
                'description' => 'EM Clerk'
            ]);

        // EM Clerk User
        $em_cl_user_id = User::where(['email' => 'em_clerk@gmail.com'])->value('id');

        if ($em_cl_user_id == NULL)
            $em_cl_user_id = User::insertGetId([
                'name' => 'Amit Kadam',
                'email' => 'em_clerk@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $em_cl_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

        // EM Clerk User and EM Clerk Role Mapping
        $em_cl_role_user = RoleUser::where(['user_id' => $em_cl_user_id, 'role_id' => $em_cl_role_id])->first();

        if($em_cl_role_user == NULL)
            RoleUser::insert([
                'user_id' => $em_cl_user_id,
                'role_id' => $em_cl_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        // EM Clerk Permission
        $em_clerk_permissions = [
            [
                'name' => 'em_clerk.index',
                'display_name' => 'List EM  ClerkApplication',
                'description' => 'Listing EM Clerk Application'
            ],
            [
                'name' => 'em_society_list',
                'display_name' => 'List EM  Society',
                'description' => 'Listing EM Society'
            ],
            [
                'name' => 'em_building_list',
                'display_name' => 'List EM  Building',
                'description' => 'Listing EM Building'
            ],
            [
                'name' => 'tenant_payment_list',
                'display_name' => 'List Tenant Payment',
                'description' => 'Listing Tenant Payment'
            ],
            [
                'name' => 'tenant_arrear_calculation',
                'display_name' => 'Tenant Arrear Calculation',
                'description' => 'Tenant Arrear Calculation'
            ],
            [
                'name' => 'create_arrear_calculation',
                'display_name' => 'Create Arrear Calculation',
                'description' => 'Create Arrear Calculation'
            ],
        ];

        $em_clerk_permission_role = [];

        foreach ($em_clerk_permissions as $em_clerk) {
            $em_clerk_permission_id = Permission::where(['name' => $em_clerk['name']])->value('id');
            if ($em_clerk_permission_id == NULL) {
                $em_clerk_permission_id = Permission::insertGetId($em_clerk);
            }

            $PermissionRole = PermissionRole::where(['permission_id' => $em_clerk_permission_id, 'role_id' => $em_cl_role_id])->first();
            if (!$PermissionRole) {
                $em_clerk_permission_role[] = [
                    'permission_id' => $em_clerk_permission_id,
                    'role_id' => $em_cl_role_id,
                ];
            }

        }
        if (count($em_clerk_permission_role) > 0) {
            PermissionRole::insert($em_clerk_permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->value('id');
        $layout_user =  \App\LayoutUser::where('user_id',$em_cl_user_id)->where('layout_id',$layout_id)->first();

        if(!$layout_user){
            \App\LayoutUser::insert(['user_id' => $em_cl_user_id, 'layout_id' => $layout_id]);
        }
    }
}
