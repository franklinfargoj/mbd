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
        // CAP branch head
        $role_id = Role::insertGetId([
            'name'         => 'cap_engineer',
            'redirect_to'  => '/cap',
            'parent_id'    => NULL,
            'display_name' => 'CAP_Engineer',
            'description'  => 'Login as CAP Engineer'
        ]);

        $user_id = User::insertGetId([
            'name'               => 'cap user',
            'email'              => 'cap@gmail.com',
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
                'name'         => 'cap.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],                       
            [
                'name'         => 'cap.EE_scrutiny_remark',
                'display_name' => 'scrutiny_remark',
                'description'  => 'scrutiny_remark'
            ],            
            [
                'name'         => 'cap.society_EE_documents',
                'display_name' => 'society_EE_documents',
                'description'  => 'society_EE_documents'
            ],            
            [
                'name'         => 'cap.dyce_Scrutiny_Remark',
                'display_name' => 'EE_Scrutiny_Remark',
                'description'  => 'EE_Scrutiny_Remark'
            ],            
            [
                'name'         => 'cap.forward_application',
                'display_name' => 'forward_application',
                'description'  => 'forward_application'
            ],            
            [
                'name'         => 'cap.forward_application_data',
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
                'role_id' 		=> $role_id,
            ];
        }

        PermissionRole::insert($permission_role); 

        // CAP deputy Engineer

        $cap_deputy_role_id = Role::insertGetId([
            'name'         => 'cap_deputy_engineer',
            'redirect_to'  => '/cap',
            'parent_id'    => $role_id,
            'display_name' => 'cap_deputy_Engineer',
            'description'  => 'Login as CAP deputy Engineer'
        ]);

        $cap_deputy_user_id = User::insertGetId([
            'name'               => 'cap1',
            'email'              => 'cap1@gmail.com',
            'password'           => bcrypt('1234'),
            'role_id'            => $cap_deputy_role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no'          => '9765238678',
            'address'            => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id'    => $cap_deputy_role_id,
            'role_id'    => $cap_deputy_user_id,
            'start_date' => \Carbon\Carbon::now()
        ]); 

        $permission_role1 = []; 

        foreach($permissions as $per1)
        {
            $permission_id1 = Permission::insertGetId($per1);

            $permission_role1[]  = [
                'permission_id' => $permission_id1,
                'role_id'       => $cap_deputy_role_id,
            ];
        }
        PermissionRole::insert($permission_role1);

        // CAL Junior Engineer

        $cap_Jr_role_id = Role::insertGetId([
            'name'         => 'cap_junior_engineer',
            'redirect_to'  => '/cap',
            'parent_id'    => $role_id,
            'display_name' => 'CAP_junior_Engineer',
            'description'  => 'Login as CAP junior Engineer'
        ]);

        $cap_Jr_user_id = User::insertGetId([
            'name'               => 'cap2',
            'email'              => 'cap2@gmail.com',
            'password'           => bcrypt('1234'),
            'role_id'            => $cap_Jr_role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no'          => '9765238678',
            'address'            => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id'    => $cap_Jr_role_id,
            'role_id'    => $cap_Jr_user_id,
            'start_date' => \Carbon\Carbon::now()
        ]);  

        $permission_role2 = [];

        foreach($permissions as $per2)
        {
            $permission_id2 = Permission::insertGetId($per2);

            $permission_role2[]  = [
                'permission_id' => $permission_id2,
                'role_id'       => $cap_Jr_role_id,
            ];
        }
        PermissionRole::insert($permission_role2);                                                    
    }
}
