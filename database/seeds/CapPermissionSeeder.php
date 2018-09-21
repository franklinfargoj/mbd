<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class CapPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cap_manager = Role::where('name', '=', 'cap_engineer')->select('id')->get();

        if (count($cap_manager) == 0) {
            $role_id = Role::insertGetId([
                'name' => 'cap_engineer',
                'redirect_to' => '/cap',
                'parent_id' => NULL,
                'display_name' => 'CAP_Engineer',
                'description' => 'Login as CAP Engineer'
            ]);

            $user_id = User::insertGetId([
                'name' => 'cap user',
                'email' => 'cap@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address' => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permissions = [
                [
                    'name' => 'cap.index',
                    'display_name' => 'index',
                    'description' => 'index'
                ],
                [
                    'name' => 'cap.EE_scrutiny_remark',
                    'display_name' => 'scrutiny_remark',
                    'description' => 'scrutiny_remark'
                ],
                [
                    'name' => 'cap.society_EE_documents',
                    'display_name' => 'society_EE_documents',
                    'description' => 'society_EE_documents'
                ],
                [
                    'name' => 'cap.dyce_Scrutiny_Remark',
                    'display_name' => 'EE_Scrutiny_Remark',
                    'description' => 'EE_Scrutiny_Remark'
                ],
                [
                    'name' => 'cap.forward_application',
                    'display_name' => 'forward_application',
                    'description' => 'forward_application'
                ],
                [
                    'name' => 'cap.forward_application_data',
                    'display_name' => 'forward_application_data',
                    'description' => 'forward_application_data'
                ],
                [
                    'name' => 'cap.cap_notes',
                    'display_name' => 'cap notes',
                    'description' => 'cap notes'
                ]                
            ];

            $permission_role = [];

            foreach ($permissions as $per) {
                $permission_id = Permission::insertGetId($per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }

            PermissionRole::insert($permission_role);
        }
    }
}