<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class AddSuperAdminToRoleTableSeeder extends Seeder
{
    public function run()
    {
        $super_admin_permissions = [
            [
                'name' => 'superadmin.dashboard',
                'display_name' => 'Super admin Dashboard',
                'description' => 'Super admin Dashboard'

            ],
            [
                'name' => 'roles.index',
                'display_name' => 'List Roles',
                'description' => 'Listing Roles'
            ],
            [
                'name' => 'roles.create',
                'display_name' => 'Create Role',
                'description' => 'Creating role'
            ],
            [
                'name' => 'roles.show',
                'display_name' => 'Create Role',
                'description' => 'Creating role'
            ],
            [
                'name' => 'roles.store',
                'display_name' => 'Store Role',
                'description' => 'Storing Role'
            ],
            [
                'name' => 'roles.edit',
                'display_name' => 'Edit Role',
                'description' => 'EDiting Role'
            ],
            [
                'name' => 'roles.update',
                'display_name' => 'Update Role',
                'description' => 'updating Role'
            ],
            [
                'name' => 'roles.destroy',
                'display_name' => 'Delete Role ',
                'description' => 'Deleting Role'
            ],
            [
                'name' => 'loadDeleteRoleUsingAjax',
                'display_name' => 'Delete Roles Ajax',
                'description' => 'Deleting Roles using Ajax'
            ],
            [
                'name' => 'application_status.index',
                'display_name' => 'List Application Status',
                'description' => 'Listing Application Status'
            ],
            [
                'name' => 'application_status.create',
                'display_name' => 'Create Application Status',
                'description' => 'Creating Application Status'
            ],
            [
                'name' => 'application_status.show',
                'display_name' => 'Create Application Status',
                'description' => 'Creating Application Status'
            ],
            [
                'name' => 'application_status.store',
                'display_name' => 'Store Application Status',
                'description' => 'Storing Application Status'
            ],
            [
                'name' => 'application_status.edit',
                'display_name' => 'Edit Application Status',
                'description' => 'EDiting Application Status'
            ],
            [
                'name' => 'application_status.update',
                'display_name' => 'Update Application Status',
                'description' => 'updating Application Status'
            ],
            [
                'name' => 'application_status.destroy',
                'display_name' => 'Delete Application Status',
                'description' => 'Deleting Application Status'
            ],
            [
                'name' => 'loadDeleteApplicationStatusUsingAjax',
                'display_name' => 'Delete Application Status Ajax',
                'description' => 'Deleting Application Status using Ajax'
            ],
            [
                'name' => 'hearing_status.index',
                'display_name' => 'List Hearing Status',
                'description' => 'Listing Hearing Status'
            ],
            [
                'name' => 'hearing_status.create',
                'display_name' => 'Create Hearing Status',
                'description' => 'Creating Hearing Status'
            ],
            [
                'name' => 'hearing_status.show',
                'display_name' => 'Create Hearing Status',
                'description' => 'Creating Hearing Status'
            ],
            [
                'name' => 'hearing_status.store',
                'display_name' => 'Store Hearing Status',
                'description' => 'Storing Hearing Status'
            ],
            [
                'name' => 'hearing_status.edit',
                'display_name' => 'Edit Hearing Status',
                'description' => 'EDiting Hearing Status'
            ],
            [
                'name' => 'hearing_status.update',
                'display_name' => 'Update Hearing Status',
                'description' => 'updating Hearing Status'
            ],
            [
                'name' => 'hearing_status.destroy',
                'display_name' => 'Delete Hearing Status',
                'description' => 'Deleting Hearing Status'
            ],
            [
                'name' => 'DeleteHearingStatusUsingAjax',
                'display_name' => 'Delete Hearing Status Ajax',
                'description' => 'Deleting Hearing Status using Ajax'
            ],
            [
                'name' => 'rti_status.index',
                'display_name' => 'List RTI Status',
                'description' => 'Listing RTI Status'
            ],
            [
                'name' => 'rti_status.create',
                'display_name' => 'Create RTI Status',
                'description' => 'Creating RTI Status'
            ],
            [
                'name' => 'rti_status.show',
                'display_name' => 'Create RTI Status',
                'description' => 'Creating RTI Status'
            ],
            [
                'name' => 'rti_status.store',
                'display_name' => 'Store RTI Status',
                'description' => 'Storing RTI Status'
            ],
            [
                'name' => 'rti_status.edit',
                'display_name' => 'Edit RTI Status',
                'description' => 'EDiting RTI Status'
            ],
            [
                'name' => 'rti_status.update',
                'display_name' => 'Update RTI Status',
                'description' => 'updating RTI Status'
            ],
            [
                'name' => 'rti_status.destroy',
                'display_name' => 'Delete RTI Status',
                'description' => 'Deleting RTI Status'
            ],
            [
                'name' => 'DeleteRTIStatusUsingAjax',
                'display_name' => 'Delete RTI Status Ajax',
                'description' => 'Deleting RTI Status using Ajax'
            ]
            ,
            [
                'name' => 'layouts.index',
                'display_name' => 'List Layouts',
                'description' => 'Listing Layouts'
            ],
            [
                'name' => 'layouts.create',
                'display_name' => 'Create Layout',
                'description' => 'Creating Layout'
            ],
            [
                'name' => 'layouts.show',
                'display_name' => 'Create Layout',
                'description' => 'Creating Layout'
            ],
            [
                'name' => 'layouts.store',
                'display_name' => 'Store Layout',
                'description' => 'Storing Layout'
            ],
            [
                'name' => 'layouts.edit',
                'display_name' => 'Edit Layout',
                'description' => 'EDiting Layout'
            ],
            [
                'name' => 'layouts.update',
                'display_name' => 'Update Layout',
                'description' => 'updating Layout'
            ],
            [
                'name' => 'layouts.destroy',
                'display_name' => 'Delete Layout ',
                'description' => 'Deleting Layout'
            ],
            [
                'name' => 'loadDeleteLayoutUsingAjax',
                'display_name' => 'Delete Layouts Ajax',
                'description' => 'Deleting Layouts using Ajax'
            ],
            [
                'name' => 'users.index',
                'display_name' => 'List users',
                'description' => 'Listing users'
            ],
            [
                'name' => 'users.create',
                'display_name' => 'Create user',
                'description' => 'Creating user'
            ],
            [
                'name' => 'users.show',
                'display_name' => 'Create user',
                'description' => 'Creating user'
            ],
            [
                'name' => 'users.store',
                'display_name' => 'Store user',
                'description' => 'Storing user'
            ],
            [
                'name' => 'users.edit',
                'display_name' => 'Edit user',
                'description' => 'EDiting user'
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Update user',
                'description' => 'updating user'
            ],
            [
                'name' => 'users.destroy',
                'display_name' => 'Delete user ',
                'description' => 'Deleting user'
            ],
            [
                'name' => 'loadDeleteUserUsingAjax',
                'display_name' => 'Delete users Ajax',
                'description' => 'Deleting users using Ajax'
            ],
            [
                'name' => 'user_layouts.index',
                'display_name' => 'List User Layouts',
                'description' => 'Listing User Layouts'
            ],
            [
                'name' => 'user_layouts.create',
                'display_name' => 'Create User Layout',
                'description' => 'Creating User Layout'
            ],
            [
                'name' => 'user_layouts.show',
                'display_name' => 'Create User Layout',
                'description' => 'Creating User Layout'
            ],
            [
                'name' => 'user_layouts.store',
                'display_name' => 'Store User Layout',
                'description' => 'Storing User Layout'
            ],
            [
                'name' => 'user_layouts.edit',
                'display_name' => 'Edit User Layout',
                'description' => 'EDiting User Layout'
            ],
            [
                'name' => 'user_layouts.update',
                'display_name' => 'Update User Layout',
                'description' => 'updating User Layout'
            ],
            [
                'name' => 'user_layouts.destroy',
                'display_name' => 'Delete User Layout ',
                'description' => 'Deleting User Layout'
            ],
            [
                'name' => 'loadDeleteUserLayoutUsingAjax',
                'display_name' => 'Delete User Layouts Ajax',
                'description' => 'Deleting User Layouts using Ajax'
            ]
        ];

        $super_admin_role_id = Role::where('name', '=', 'superadmin')->value('id');

        if ($super_admin_role_id == NULL)
            // Super Admin
            $super_admin_role_id = Role::insertGetId([
                'name' => 'superadmin',
                'redirect_to' => '/crudadmin/dashboard',
                'dashboard' => '/crudadmin/dashboard',
                'parent_id' => NULL,
                'display_name' => 'Super Admin',
                'description' => 'Super Admin'
            ]);


        $super_admin_user_id = User::where('email','superadmin@gmail.com')->value('id');

        if($super_admin_user_id == Null){
            $super_admin_user_id = User::insertGetId([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('super123'),
                'role_id' => $super_admin_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $super_admin_user_id,
                'role_id' => $super_admin_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        $permission_role = [];

        foreach ($super_admin_permissions as $super) {
            $permission_id = Permission::where(['name' => $super['name']])->value('id');
            if (!($permission_id))
                $permission_id = Permission::insertGetId($super);

            $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $super_admin_role_id])->first();
            if (!$PermissionRole) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $super_admin_role_id,
                ];
            }

        }

        if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $super_admin_role_id])->first())
        {

        }else
        {
            PermissionRole::insert($permission_role);
        }


    }
}