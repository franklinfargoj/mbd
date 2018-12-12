<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class ResolutionPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resolution_manager = Role::where('name', '=', 'RM')->select('id')->get();

        if (count($resolution_manager) == 0) {
            $role_id = Role::insertGetId([
                'name' => 'RM',
                'parent_id' => NULL,
                'redirect_to' => '/resolution',
                'dashboard' => '/resolution',
                'display_name' => 'resolution_manager',
                'description' => 'Login as Resolution Manger'
            ]);

            $user_id = User::insertGetId([
                'name' => 'Resolution Manager',
                'email' => 'resolution@gmail.com',
                'password' => bcrypt('resolution123'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permissions = [
                [
                    'name' => 'resolution.index',
                    'display_name' => 'List Resolution',
                    'description' => 'Listing of Resolutions'
                ],
                [
                    'name' => 'resolution.create',
                    'display_name' => 'Create a resolution',
                    'description' => 'Creating a new resolution'
                ],
                [
                    'name' => 'resolution.edit',
                    'display_name' => 'Edit a resolution',
                    'description' => 'Edit a resolution'
                ],
                [
                    'name' => 'resolution.update',
                    'display_name' => 'Update a resolution',
                    'description' => 'Updating data of a particular resolution'
                ],
                [
                    'name' => 'resolution.destroy',
                    'display_name' => 'Delete a resolution',
                    'description' => 'Delete a particular resolution'
                ],
                [
                    'name' => 'loadDeleteReasonOfResolutionUsingAjax',
                    'display_name' => 'Delete route from pop up',
                    'description' => 'Delete route from pop up'
                ],
                [
                    'name' => 'resolution.store',
                    'display_name' => 'Store a resolution a data',
                    'description' => 'Creating a new resolution'
                ],
                [
                    'name' => 'frontend_resolution_list',
                    'display_name' => 'Frontend resolution list',
                    'description' => 'Frontend resolution list'
                ],
            ];

            $permission_role = [];

            foreach ($permissions as $lm_per) {
                $permission_id = Permission::insertGetId($lm_per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }

            PermissionRole::insert($permission_role);
        }
    }
}
