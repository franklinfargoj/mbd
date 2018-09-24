<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class DYCEPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dyce_manager = Role::where('name', '=', 'dyce_engineer')->select('id')->get();

        if (count($dyce_manager) == 0) {
            // DYCE branch head
            $role_id = Role::insertGetId([
                'name'         => 'dyce_engineer',
                'redirect_to'  => '/dyce',
                'parent_id'    => NULL,
                'display_name' => 'DYCE_Engineer',
                'description'  => 'Login as DYCE Engineer'
            ]);

            $user_id = User::insertGetId([
                'name'     => 'Bhavana.Salunkhe',
                'email'    => 'bhavnasalunkhe@neosofttech.com',
                'password' => bcrypt('bhavnas123'),
                'role_id'  => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id'    => $user_id,
                'role_id'    => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permissions = [
                [
                    'name'         => 'dyce.index',
                    'display_name' => 'index',
                    'description'  => 'index'
                ],
                [
                    'name'         => 'dyce.store',
                    'display_name' => 'store dyce uploaded files',
                    'description'  => 'store dyce uploaded files'
                ],
                [
                    'name'         => 'dyce.scrutiny_remark',
                    'display_name' => 'scrutiny_remark',
                    'description'  => 'scrutiny_remark'
                ],
                [
                    'name'         => 'dyce.society_EE_documents',
                    'display_name' => 'society_EE_documents',
                    'description'  => 'society_EE_documents'
                ],
                [
                    'name'         => 'dyce.EE_Scrutiny_Remark',
                    'display_name' => 'EE_Scrutiny_Remark',
                    'description'  => 'EE_Scrutiny_Remark'
                ],
                [
                    'name'         => 'dyce.forward_application',
                    'display_name' => 'forward_application',
                    'description'  => 'forward_application'
                ],
                [
                    'name'         => 'dyce.forward_application_data',
                    'display_name' => 'forward_application_data',
                    'description'  => 'forward_application_data'
                ]
            ];

            $permission_role = [];

            foreach ($permissions as $per) {
                $permission_id = Permission::insertGetId($per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $role_id,
                ];
            }

            PermissionRole::insert($permission_role);

            // DYCE deputy Engineer

            $dyce_deputy_role_id = Role::insertGetId([
                'name'         => 'dyce_deputy_engineer',
                'redirect_to'  => '/dyce',
                'parent_id'    => $role_id,
                'display_name' => 'DYCE_deputy_Engineer',
                'description'  => 'Login as DYCE deputy Engineer'
            ]);

            $dyce_deputy_user_id = User::insertGetId([
                'name'     => 'dyce_deputy',
                'email'    => 'dyce1@gmail.com',
                'password' => bcrypt('user1'),
                'role_id'  => $dyce_deputy_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            $role_user1 = RoleUser::insert([
                'user_id'    => $dyce_deputy_user_id,
                'role_id'    => $dyce_deputy_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permission_role1 = [];

            foreach ($permissions as $per1) {
                $permission_id1 = Permission::insertGetId($per1);

                $permission_role1[] = [
                    'permission_id' => $permission_id1,
                    'role_id'       => $dyce_deputy_role_id,
                ];
            }
            PermissionRole::insert($permission_role1);

            // DYCE Junior Engineer

            $dyce_Jr_role_id = Role::insertGetId([
                'name'         => 'dyce_junior_engineer',
                'redirect_to'  => '/dyce',
                'parent_id'    => $dyce_deputy_role_id,
                'display_name' => 'DYCE_junior_Engineer',
                'description'  => 'Login as DYCE junior Engineer'
            ]);

            $dyce_Jr_user_id = User::insertGetId([
                'name'      => 'dyce_JR',
                'email'     => 'dyce2@gmail.com',
                'password'  => bcrypt('user1'),
                'role_id'   => $dyce_Jr_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            $role_user2 = RoleUser::insert([
                'user_id'    => $dyce_Jr_user_id,
                'role_id'    => $dyce_Jr_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permission_role2 = [];

            foreach ($permissions as $per2) {
                $permission_id2 = Permission::insertGetId($per2);

                $permission_role2[] = [
                    'permission_id' => $permission_id2,
                    'role_id'       => $dyce_Jr_role_id,
                ];
            }
            PermissionRole::insert($permission_role2);
        }
    }
}
