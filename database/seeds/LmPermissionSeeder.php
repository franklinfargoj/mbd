<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class LmPermissionSeeder extends Seeder
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
                'name'=>'architect_layout_dashboard',
                'display_name' => 'Dashboard for Architect',
                'description' => 'Dashboard for Architect'
            ],
            [
                'name' => 'village_detail.index',
                'display_name' => 'List village',
                'description' => 'Listing of village'
            ],
            [
                'name' => 'village_detail.create',
                'display_name' => 'Create a village',
                'description' => 'Creating a new village'
            ],
            [
                'name' => 'village_detail.edit',
                'display_name' => 'Edit a village',
                'description' => 'Edit a village'
            ],
            [
                'name' => 'village_detail.show',
                'display_name' => 'Show a village data',
                'description' => 'Show a village data'
            ],
            [
                'name' => 'village_detail.update',
                'display_name' => 'Update a village',
                'description' => 'Updating data of a particular village'
            ],
            [
                'name' => 'village_detail.destroy',
                'display_name' => 'Delete a village',
                'description' => 'Delete a particular village'
            ],
            [
                'name' => 'loadDeleteVillageUsingAjax',
                'display_name' => 'Delete route from pop up',
                'description' => 'Delete route from pop up'
            ],
            [
                'name' => 'village_detail.store',
                'display_name' => 'Store a village a data',
                'description' => 'Creating a new village'
            ],
            [
                'name' => 'society_detail.index',
                'display_name' => 'Society list',
                'description' => 'List all societies coming under particular village'
            ],
            [
                'name' => 'society_detail.create',
                'display_name' => 'Society Create',
                'description' => 'Create society for a particular village'
            ],
            [
                'name' => 'society_detail.store',
                'display_name' => 'Society Store',
                'description' => 'Store society data for a particular village'
            ],
            [
                'name' => 'society_detail.edit',
                'display_name' => 'Society Edit',
                'description' => 'Edit society data for a particular village'
            ],
            [
                'name' => 'society_detail.update',
                'display_name' => 'Society Update',
                'description' => 'Update society data for a particular village'
            ],
            [
                'name' => 'society_detail.show',
                'display_name' => 'Show society data',
                'description' => 'Show society data'
            ],
            [
                'name' => 'lease_detail.index',
                'display_name' => 'List Lease',
                'description' => 'List lease for a particular society'
            ],
            [
                'name' => 'lease_detail.create',
                'display_name' => 'Create Lease',
                'description' => 'Create lease for a particular society'
            ],
            [
                'name' => 'lease_detail.store',
                'display_name' => 'Store Lease',
                'description' => 'Store lease for a particular society'
            ],
            [
                'name' => 'renew-lease.renew',
                'display_name' => 'Renew Lease',
                'description' => 'Renew lease for a particular society'
            ],
            [
                'name' => 'renew-lease.update-lease',
                'display_name' => 'Updated Renew Lease data',
                'description' => 'Updated Renew Lease data'
            ],
            [
                'name' => 'edit-lease.edit',
                'display_name' => 'Shows edit page for Edit Lease data',
                'description' => 'Shows edit page for Edit Lease data'
            ],
            [
                'name' => 'update-lease.update',
                'display_name' => 'Updated Latest Lease data',
                'description' => 'Updated Latest Lease data'
            ],
            [
                'name' => 'view-lease.view',
                'display_name' => 'Views Latest Lease data',
                'description' => 'Views Latest Lease data'
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
                'name'=>'upload_lm_checklist_and_remark_report',
                'display_name' => 'upload_lm_checklist_and_remark_report',
                'description' => 'upload_lm_checklist_and_remark_report',
            ],
            [
                'name'=>'post_lm_checklist_and_remark_report',
                'display_name'=>'post_lm_checklist_and_remark_report',
                'description'=>'post_lm_checklist_and_remark_report'
            ],
            [
                'name' => 'society_detail.show_end_date_lease',
                'display_name' => 'Shows society data with 3 days before end date for lease',
                'description' => 'Shows society data with 3 days before end date for lease'
            ],
            [
                'name' => 'land.dashboard',
                'display_name' => 'Land Dashboard',
                'description' => 'Shows Land Dashboard'
            ],
            [
                'name' => 'dashboard.ajax.land',
                'display_name' => 'Land Dashboard using ajax',
                'description' => 'Shows Land Dashboard using ajax'
            ],
            [
                'name'=>'architect.period_wise_pendency_report',
                'display_name'=>'architect.period_wise_pendency_report',
                'description'=>'architect.period_wise_pendency_report'
            ],
            [
                'name'=>'architect_pending_reports',
                'display_name'=>'architect_pending_reports',
                'description'=>'architect_pending_reports'
            ],
            [
                'name'=>'scrutiny_report_by_em',
                'display_name'=>'scrutiny_report_by_em',
                'description'=>'scrutiny_report_by_em'
            ],
            [
                'name'=>'getTalukaByAjax',
                'display_name'=>'get taluka of districts',
                'description'=>'get taluka of districts'
            ],
            [
                'name'=>'land.village_society_reports',
                'display_name'=>'land.village_society_reports',
                'description'=>'land.village_society_reports'
            ],
            [
                'name'=>'village_society_reports',
                'display_name'=>'village_society_reports',
                'description'=>'village_society_reports'
            ],
            [
                'name'=>'village_society_area_reports',
                'display_name'=>'village_society_area_reports',
                'description'=>'village_society_area_reports'
            ],
            [
                'name'=>'village_society_layout_area_reports',
                'display_name'=>'village_society_layout_area_reports',
                'description'=>'village_society_layout_area_reports'
            ],
            [
                'name'=>'payment_details.lease',
                'display_name'=>'Payment details of society',
                'description'=>'Payment details of society'
            ],
            [
                'name'=>'loadDDDetailsUsingAjax',
                'display_name'=>'DD details of society payment',
                'description'=>'DD details of society payment'
            ],
            [
                'name'=>'getTenantsByAjax',
                'display_name'=>'Tenants',
                'description'=>'Tenants'
            ],


        ];

        $land_manager = Role::where('name', '=', 'LM')->select('id')->first();
        if($land_manager)
        {
            $role_id=$land_manager->id;
        }else
        {
            $role_id = Role::insertGetId([
                'name' => 'LM',
                'redirect_to' => '/village_detail',
                'dashboard' => '/land_dashboard',
                'display_name' => 'land_manager',
                'description' => 'Login as Land Manger'
            ]);
        }
        $lm_user=User::where(['email'=>'martin.philipose@wwindia.com'])->first();
        if($lm_user)
        {
            $user_id=$lm_user->id;
        }else
        {
            $user_id = User::insertGetId([
                'name' => 'martin.philipose',
                'email' => 'martin.philipose@wwindia.com',
                'password' => bcrypt('martinp123'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);
        }

        $lm_rol_user=RoleUser::where(['user_id'=>$user_id,'role_id'=>$role_id])->first();
        if($lm_rol_user)
        {
            
        }else
        {
            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }
        
        $permission_role = [];

            foreach ($permissions as $lm_per) {
                $permission=Permission::where(['name'=>$lm_per['name']])->first();
                if($permission)
                {
                    $permission_id = $permission->id;
                }else
                {
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
            if(count($permission_role)>0)
            {
                PermissionRole::insert($permission_role);
            }
            
        
        // $land_manager = Role::where('name', '=', 'LM')->select('id')->get();

        //if (count($land_manager) == 0) {
            // $role_id = Role::insertGetId([
            //     'name' => 'LM',
            //     'redirect_to' => '/village_detail',
            //     'display_name' => 'land_manager',
            //     'description' => 'Login as Land Manger'
            // ]);

            // $user_id = User::insertGetId([
            //     'name' => 'martin.philipose',
            //     'email' => 'martin.philipose@wwindia.com',
            //     'password' => bcrypt('martinp123'),
            //     'role_id' => $role_id,
            //     'uploaded_note_path' => 'Test',
            //     'mobile_no' => '7412589635',
            //     'address' => 'Mumbai'
            // ]);

            // $role_user = RoleUser::insert([
            //     'user_id' => $user_id,
            //     'role_id' => $role_id,
            //     'start_date' => \Carbon\Carbon::now()
            // ]);

            

            // $permission_role = [];

            // foreach ($permissions as $lm_per) {
            //     $permission_id = Permission::insertGetId($lm_per);

            //     $permission_role[] = [
            //         'permission_id' => $permission_id,
            //         'role_id' => $role_id,
            //     ];
            // }

            // PermissionRole::insert($permission_role);
        //}
    }
}
