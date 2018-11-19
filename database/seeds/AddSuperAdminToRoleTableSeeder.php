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
        $super_admin = Role::where('name', '=', 'superadmin')->select('id')->get();

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
            ]
        ];

        if (count($super_admin) == 0) {

            // Super Admin
            $super_admin_role_id = Role::insertGetId([
                'name' => 'superadmin',
                'redirect_to' => '/crudadmin/roles',
                'parent_id' => NULL,
                'display_name' => 'Super Admin',
                'description' => 'Super Admin'
            ]);

            $super_admin_user_id = User::insertGetId([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('super123'),
                'role_id' => $super_admin_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $super_admin_role_user = RoleUser::insert([
                'user_id' => $super_admin_user_id,
                'role_id' => $super_admin_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $super_admin_permission_role = [];

            foreach ($super_admin_permissions as $super) {
                $super_admin_permission_id = Permission::insertGetId($super);

                $super_admin_permission_role[] = [
                    'permission_id' => $super_admin_permission_id,
                    'role_id' => $super_admin_role_id,
                ];
            }

            PermissionRole::insert($super_admin_permission_role);

        } else {

            $super_admin_permission_role = [];

            foreach ($super_admin_permissions as $super) {

                $per = Permission::where('name', $super['name'])->first();
                if ($per) {
                    continue;
                } else {

                    $super_admin_permission_id = Permission::insertGetId($super);

                    $super_admin_permission_role[] = [
                        'permission_id' => $super_admin_permission_id,
                        'role_id' => $super_admin[0]['id'],
                    ];
                    PermissionRole::insert($super_admin_permission_role);
                }
            }
        }
    }
}