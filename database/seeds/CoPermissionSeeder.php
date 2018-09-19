<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class CoPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = Role::insertGetId([
            'name'         => 'co_engineer',
            'redirect_to'  => '/co',
            'parent_id'    => NULL,
            'display_name' => 'Co_Engineer',
            'description'  => 'Login as CO Engineer'
        ]); 

        $user_id = User::insertGetId([
            'name'               => 'CO',
            'email'              => 'co@gmail.com',
            'password'           => bcrypt('1234'),
            'role_id'            => $role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no'          => '9765238678',
            'address'            => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id'    => $user_id,
            'role_id'    => $role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $permissions = [
            [
                'name'         => 'co.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],            
            [
                'name'         => 'co.society_EE_documents',
                'display_name' => 'society_EE_documents',
                'description'  => 'society_EE_documents'
            ],            
            [
                'name'         => 'co.EE_Scrutiny_Remark',
                'display_name' => 'EE_Scrutiny_Remark',
                'description'  => 'EE_Scrutiny_Remark'
            ],            
            [
                'name'         => 'co.scrutiny_remark',
                'display_name' => 'scrutiny_remark',
                'description'  => 'scrutiny_remark'
            ],            
            [
                'name'         => 'co.forward_application',
                'display_name' => 'forward_application',
                'description'  => 'forward_application'
            ],            
            [
                'name'         => 'co.forward_application_data',
                'display_name' => 'forward_application_data',
                'description'  => 'forward_application_data'
            ]
        ];

        $permission_role = [];

        foreach($permissions as $per)
        {
            $permission_id = Permission::insertGetId($per);

            $permission_role[] = [
                'permission_id' => $permission_id,
                'role_id' => $role_id,
            ];
        }

        PermissionRole::insert($permission_role);                                  
    }
}
