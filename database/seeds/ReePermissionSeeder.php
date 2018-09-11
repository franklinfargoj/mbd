<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class ReePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = Role::insertGetId([
            'name' => 'REE',
            'redirect_to' => '/ree_applications',
            'display_name' => 'Residential Executive Engineer',
            'description' => 'Login as Residential Executive Engineer'
        ]);

        $user_id = User::insertGetId([
            'name' => 'Neelam',
            'email' => 'neelam.tambe@wwindia.com',
            'password' => bcrypt('neelam123'),
            'role_id' => $role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no' => '9969054274',
            'address' => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id' => $user_id,
            'role_id' => $role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $permissions = [
            [
                'name' => 'ree_dashboard.index',
                'display_name' => 'REE Dashboard',
                'description' => 'REE Dashboard'
            ],
            [
                'name' => 'ree_applications.index',
                'display_name' => 'REE Dashboard',
                'description' => 'REE Dashboard'
            ],
            [
                'name' => 'ol_calculation_sheet.show',
                'display_name' => 'Calculation Sheet',
                'description' => 'Application calculation sheet'
            ],

        ];

        $permission_role = [];

        foreach($permissions as $ree_per)
        {
            $permission_id = Permission::insertGetId($ree_per);

            $permission_role[] = [
                'permission_id' => $permission_id,
                'role_id' => $role_id,
            ];
        }

        PermissionRole::insert($permission_role);
    }
}
