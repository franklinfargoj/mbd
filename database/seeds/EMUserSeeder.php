<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\LayoutUser;
use App\Role;
use App\RoleUser;
use App\User;
use App\Permission;
use App\PermissionRole;
class EMUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $em_manager = Role::where('name', '=', 'em_manager')->select('id')->get();

        if (count($em_manager) == 0) {
        	$em_role_id = Role::insertGetId([
                'name' => 'em_manager',
                'redirect_to' => '/em',
                'parent_id' => NULL,
                'display_name' => 'EM Manager',
                'description' => 'EM Manager'
            ]);

        	$em_user_id = User::insertGetId([
                'name' => 'EM Manager',
                'email' => 'em@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $em_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $em_role_user = RoleUser::insert([
                'user_id' => $em_user_id,
                'role_id' => $em_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
            $em_permissions = [
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
                    'name' => 'add_tenant',
                    'display_name' => 'Add Tenant',
                    'description' => 'Add Tenant'
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
            ];

            $permission_role = [];

            foreach ($em_permissions as $ee) {
                $em_permission_id = Permission::insertGetId($ee);

                $em_permission_role[] = [
                    'permission_id' => $em_permission_id,
                    'role_id' => $em_role_id,
                ];
            }

            PermissionRole::insert($em_permission_role);


            //EM Clerk

            $em_cl_role_id = Role::insertGetId([
                'name' => 'em_clerk',
                'redirect_to' => '/em_clerk',
                'parent_id' => $em_role_id,
                'display_name' => 'EE Deputy Engineer',
                'description' => 'EE Deputy Engineer'
            ]);

            $em_cl_user_id = User::insertGetId([
                'name' => 'Amit Kadam',
                'email' => 'em_clerk@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $em_cl_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $em_cl_user_id,
                'role_id' => $em_cl_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

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

            $permission_role = [];

            foreach ($em_clerk_permissions as $em_clerk) {
                $em_clerk_permission_id = Permission::insertGetId($em_clerk);

                $em_clerk_permission_role[] = [
                    'permission_id' => $em_clerk_permission_id,
                    'role_id' => $em_cl_role_id,
                ];
            }

            PermissionRole::insert($em_clerk_permission_role);

            $layout_id = MasterLayout::first()->id;

            // Layout User Mapping

            LayoutUser::insert(['user_id' => $em_user_id, 'layout_id' => $layout_id]);
            LayoutUser::insert(['user_id' => $em_cl_user_id, 'layout_id' => $layout_id]);
        }

        //RC
        $rc_collector = Role::where('name', '=', 'rc_collector')->select('id')->get();

        if (count($rc_collector) == 0) {

            $rc_role_id = Role::insertGetId([
                'name' => 'rc_collector',
                'redirect_to' => '/rc',
                'parent_id' => NULL,
                'display_name' => 'RC Collector',
                'description' => 'RC Collector'
            ]);

            $rc_user_id = User::insertGetId([
                'name' => 'Amit Kadam',
                'email' => 'rc@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $rc_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $rc_user_id,
                'role_id' => $rc_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $rc_permissions = [
                [
                    'name' => 'rc.index',
                    'display_name' => 'List Collected Rents',
                    'description' => 'Listing Collected Rents'
                ],
                [
                    'name' => 'bill_collection_society',
                    'display_name' => 'Bill Collection Society',
                    'description' => 'Bill Collection Society'
                ],
                [
                    'name' => 'bill_collection_tenant', 
                    'display_name' => 'Bill Collection Tenant',
                    'description' => 'Bill Collection Tenant'
                ],
                [
                    'name' => 'get_wards', 
                    'display_name' => 'Get Wards Select Data',
                    'description' => 'Get Wards Select Data'
                ],
                [
                    'name' => 'get_colonies', 
                    'display_name' => 'Get Colonies Select Data',
                    'description' => 'Get Colonies Select Data'
                ],
                [
                    'name' => 'get_society_select', 
                    'display_name' => 'Get Societies Select Data',
                    'description' => 'Get Societies Select Data'
                ],
                [
                    'name' => 'get_building_select',
                    'display_name' => 'Selected Building',
                    'description' => 'Selected Building'
                ],
                [
                    'name' => 'arrears_calculations',
                    'display_name' => 'Arrears Calculations',
                    'description' => 'Arrears Calculations'
                ],
                [
                    'name' => 'billing_calculations',
                    'display_name' => 'Billing Calculations',
                    'description' => 'Billing Calculations'
                ],
                [
                    'name' => 'get_building_bill_collection', 
                    'display_name' => 'Get Buildings Bill Collection List Data',
                    'description' => 'Get Buildings Bill Collection List Data'
                ],
                [
                    'name' => 'get_tenant_bill_collection', 
                    'display_name' => 'Get Tenant Bill Collection List Data',
                    'description' => 'Get Tenant Bill Collection List Data'
                ],
                [
                    'name' => 'get_building_bill_collection',
                    'display_name' => 'Building Bill Collection',
                    'description' => 'Building Bill Collection'
                ],
                [
                    'name' => 'get_tenant_bill_collection',
                    'display_name' => 'Tenant Bill Collection',
                    'description' => 'Tenant Bill Collection'
                ],
            ];

            $permission_role = [];

            foreach ($rc_permissions as $rc ) {
                                 
                $rc_permission_id = Permission::insertGetId($rc);   
                               
                $rc_permission_role[] = [
                    'permission_id' => $rc_permission_id,
                    'role_id' => $rc_role_id,
                ];
            }

            PermissionRole::insert($rc_permission_role);
            
            $layout_id = MasterLayout::first()->id;
            // Layout User Mapping

            LayoutUser::insert(['user_id' => $rc_user_id, 'layout_id' => $layout_id]);
        }
    }
}
