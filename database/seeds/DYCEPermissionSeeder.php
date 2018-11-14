<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\MasterLayout;
use App\LayoutUser;

class DYCEPermissionSeeder extends Seeder
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
            ],
            [
                'name'         => 'dyce.test',
                'display_name' => 'dyce test',
                'description'  => 'dyce test'
            ],
            [
                'name'         => 'dyce.test',
                'display_name' => 'dyce test',
                'description'  => 'dyce test'
            ],
            [
                'name'=>'dashboard',
                'display_name'=>'dashboard',
                'description'=>'Dashboard'
            ]
        ];

        // DYCE branch head
        $role_id = Role::where('name', '=', 'dyce_engineer')->value('id');

        if ($role_id == NULL)
            $role_id = Role::insertGetId([
                'name'         => 'dyce_engineer',
                'redirect_to'  => '/dashboard',
                'parent_id'    => NULL,
                'display_name' => 'DYCE_Engineer',
                'description'  => 'Login as DYCE Engineer'
            ]);


        // DYCE deputy Engineer
        $dyce_deputy_role_id = Role::where('name', '=', 'dyce_deputy_engineer')->value('id');

        if($dyce_deputy_role_id == NULL)
            $dyce_deputy_role_id = Role::insertGetId([
                'name'         => 'dyce_deputy_engineer',
                'redirect_to'  => '/dashboard',
                'parent_id'    => $role_id,
                'display_name' => 'DYCE_deputy_Engineer',
                'description'  => 'Login as DYCE deputy Engineer'
            ]);

        // DYCE Junior Engineer
        $dyce_Jr_role_id = Role::where('name', '=', 'dyce_junior_engineer')->value('id');

        if($dyce_Jr_role_id == NULL)
            $dyce_Jr_role_id = Role::insertGetId([
                'name'         => 'dyce_junior_engineer',
                'redirect_to'  => '/dashboard',
                'parent_id'    => $dyce_deputy_role_id,
                'display_name' => 'DYCE_junior_Engineer',
                'description'  => 'Login as DYCE junior Engineer'
            ]);

        // User and Role Mapping

        // DYCE branch head
        $user_id = User::where('email','bhavnasalunkhe@neosofttech.com')->value('id');

        if($user_id == NULL){
            $user_id = User::insertGetId([
                'name'     => 'Bhavana.Salunkhe',
                'email'    => 'bhavnasalunkhe@neosofttech.com',
                'password' => bcrypt('bhavnas123'),
                'role_id'  => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id'    => $user_id,
                'role_id'    => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // DYCE deputy Engineer
        $dyce_deputy_user_id = User::where('email','dyce1@gmail.com')->value('id');

        if($dyce_deputy_user_id == NULL){
            $dyce_deputy_user_id = User::insertGetId([
                'name'     => 'dyce_deputy',
                'email'    => 'dyce1@gmail.com',
                'password' => bcrypt('user1'),
                'role_id'  => $dyce_deputy_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id'    => $dyce_deputy_user_id,
                'role_id'    => $dyce_deputy_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // DYCE Junior Engineer
        $dyce_Jr_user_id = User::where('email','dyce2@gmail.com')->value('id');

        if($dyce_Jr_user_id == NULL){
            $dyce_Jr_user_id = User::insertGetId([
                'name'      => 'dyce_JR',
                'email'     => 'dyce2@gmail.com',
                'password'  => bcrypt('user1'),
                'role_id'   => $dyce_Jr_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id'    => $dyce_Jr_user_id,
                'role_id'    => $dyce_Jr_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // Permission

        foreach ($permissions as $permission) {

            $per = Permission::where('name', $permission['name'])->first();
            if ($per) {
                $permission_id=$per->id;
                //continue;
            } else {
                $permission_id = Permission::insertGetId($permission);
            }


            $dyce_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $role_id,
            ]];

            if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $role_id])->first())
            {

            }else
            {
                PermissionRole::insert($dyce_role_permission);
            }

            $dyce_deputy_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $dyce_deputy_role_id,
            ]];
            if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $dyce_deputy_role_id])->first())
            {

            }else
            {
                PermissionRole::insert($dyce_deputy_role_permission);
            }

            $dyce_jr_role_permission = [[
                'permission_id' => $permission_id,
                'role_id' => $dyce_Jr_role_id,
            ]];

            if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $dyce_Jr_role_id])->first())
            {

            }else
            {
                PermissionRole::insert($dyce_jr_role_permission);
            }

            // Layout Table entry
            $master_layout=MasterLayout::where([
                'layout_name' => 'Samata Nagar, Kandivali(E)',
                'Board' => 'Mumbai',
                'division' => 'Borivali',
            ])->first();
            if($master_layout)
            {
                $layout_id=$master_layout->id;
            }else
            {
                $layout_id = MasterLayout::insertGetId([
                    'layout_name' => 'Samata Nagar, Kandivali(E)',
                    'Board' => 'Mumbai',
                    'division' => 'Borivali',
                ]);
            }


            // Layout User Mapping
            if(LayoutUser::where(['user_id' => $user_id, 'layout_id' => $layout_id])->first())
            {

            }else
            {
                LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id]);
            }

            if(LayoutUser::where(['user_id' => $dyce_deputy_user_id, 'layout_id' => $layout_id])->first())
            {

            }else
            {
                LayoutUser::insert(['user_id' => $dyce_deputy_user_id, 'layout_id' => $layout_id]);
            }

            if(LayoutUser::where(['user_id' => $dyce_Jr_user_id, 'layout_id' => $layout_id])->first())
            {

            }else
            {
                LayoutUser::insert(['user_id' => $dyce_Jr_user_id, 'layout_id' => $layout_id]);
            }

        }
    }
}
