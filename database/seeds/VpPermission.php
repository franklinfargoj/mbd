<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class VpPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vp_manager = Role::where('name', '=', 'vp_engineer')->select('id')->get();

        if (count($vp_manager) == 0) {
            $role_id = Role::insertGetId([
                'name'         => 'vp_engineer',
                'redirect_to'  => '/vp',
                'parent_id'    => NULL,
                'display_name' => 'VP_Engineer',
                'description'  => 'Login as VP Engineer'
            ]);

            $user_id = User::insertGetId([
                'name'      => 'VP user',
                'email'     => 'vp@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $role_id,
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
                    'name'         => 'vp.index',
                    'display_name' => 'index',
                    'description'  => 'index'
                ],
                [
                    'name'         => 'vp.EE_scrutiny_remark',
                    'display_name' => 'scrutiny_remark',
                    'description'  => 'scrutiny_remark'
                ],
                [
                    'name'         => 'vp.society_EE_documents',
                    'display_name' => 'society_EE_documents',
                    'description'  => 'society_EE_documents'
                ],
                [
                    'name'         => 'vp.dyce_Scrutiny_Remark',
                    'display_name' => 'EE_Scrutiny_Remark',
                    'description'  => 'EE_Scrutiny_Remark'
                ],
                [
                    'name'         => 'vp.forward_application',
                    'display_name' => 'forward_application',
                    'description'  => 'forward_application'
                ],
                [
                    'name'         => 'vp.forward_application_data',
                    'display_name' => 'forward_application_data',
                    'description'  => 'forward_application_data'
                ],
                [
                    'name'         => 'vp.cap_notes',
                    'display_name' => 'cap notes',
                    'description'  => 'cap notes'
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

            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();

            \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
        }
    }
}
