<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\LayoutUser;
use App\Role;
use App\RoleUser;
use App\User;
use App\Permission;
use App\PermissionRole;
class RCUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                [
                    'name' => 'generate_receipt_society',
                    'display_name' => 'Generate Receipt Society',
                    'description' => 'Generate Receipt Society'
                ],
                [
                    'name' => 'generate_receipt_tenant',
                    'display_name' => 'Generate Receipt Tenant',
                    'description' => 'Generate Receipt Tenant'
                ],
                [
                    'name' => 'payment_receipt_society',
                    'display_name' => 'payment receipt society',
                    'description' => 'payment receipt society'
                ],
                [
                    'name' => 'payment_receipt_tenant',
                    'display_name' => 'payment receipt tenant',
                    'description' => 'payment receipt tenant'
                ]
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
