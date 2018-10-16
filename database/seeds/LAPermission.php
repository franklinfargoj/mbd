<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class LAPermission extends Seeder
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
                'name'         => 'la.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],
            [
                'name'         => 'la.conveyance_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
            ],
        ];

        $role_id = Role::where('name', '=', 'la_engineer')->value('id');

        if (count($role_id) == 0) {
            $role_id = Role::insertGetId([
                'name'         => 'la_engineer',
                'redirect_to'  => '/la',
                'parent_id'    => NULL,
                'display_name' => 'la engineer',
                'description'  => 'Login as la Engineer'
            ]);
        }

        $user_id = User::where('email', '=', 'la@gmail.com')->value('id');

        if (count($user_id) == 0){

            $user_id = User::insertGetId([
                'name'      => 'la user',
                'email'     => 'la@gmail.com',
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
        }
        $permission_role = [];

        foreach ($permissions as $per) {
            $permission_id = Permission::where('name', '=', $per['name'])->value('id');
            if (count($permission_id) == 0){

                $permission_id = Permission::insertGetId($per);
            }

            $permission_roles = PermissionRole::where('permission_id',$permission_id)->where('role_id',$role_id)->first();


            if(count($permission_roles) == 0) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $role_id,
                ];
            }
        }
        if($permission_role > 0) {

            PermissionRole::insert($permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user =  \App\LayoutUser::where('user_id',$user_id)->where('layout_id',$layout_id->id)->first();

        if(count($layout_user) == 0){
            \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
        }
    }
}
