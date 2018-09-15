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
        $role_id = Role::insertGetId([
            'name' => 'DYCE',
            'redirect_to' => '/dyce',
            'display_name' => 'DYCE_Engineer',
            'description' => 'Login as DYCE Engineer'
        ]);

        $user_id = User::insertGetId([
            'name' => 'Bhavana.Salunkhe',
            'email' => 'bhavnasalunkhe@neosofttech.com',
            'password' => bcrypt('bhavnas123'),
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
                'name' => 'DYCE_scrutiny_remark',
                'display_name' => 'scrutiny_remark',
                'description' => 'scrutiny_remark'
            ],            
            [
                'name' => 'dyce.store',
                'display_name' => 'scrutiny_remark',
                'description' => 'scrutiny_remark'
            ],
        ];

        $permission_role = [];

        foreach($permissions as $lm_per)
        {
            $permission_id = Permission::insertGetId($lm_per);

            $permission_role[] = [
                'permission_id' => $permission_id,
                'role_id' => $role_id,
            ];
        }

        PermissionRole::insert($permission_role);                               
    }
}
