<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\LayoutUser;
use App\Role;
use App\RoleUser;
use App\User;
use App\Permission;
use App\PermissionRole;

class EEUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EE Department Head
        $ee_role_id = Role::insertGetId([
            'name' => 'ee_engineer',
            'redirect_to' => '/ee',
            'parent_id' => NULL,
            'display_name' => 'EE Engineer',
            'description' => 'EE Engineer'
        ]);

        $ee_user_id = User::insertGetId([
            'name' => 'Nitin Gadkari',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => $ee_role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no' => '7412589635',
            'address' => 'Mumbai'
        ]);

        $ee_role_user = RoleUser::insert([
            'user_id' => $ee_user_id,
            'role_id' => $ee_role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $ee_permissions = [
            [
                'name' => 'ee.index',
                'display_name' => 'List EE Application',
                'description' => 'Listing EE Application'
            ]
        ];

        $permission_role = [];

        foreach($ee_permissions as $ee)
        {
            $ee_permission_id = Permission::insertGetId($ee);

            $ee_permission_role[] = [
                'permission_id' => $ee_permission_id,
                'role_id' => $ee_role_id,
            ];
        }

        PermissionRole::insert($ee_permission_role);

        // EE Deputy Engineer

        $ee_dy_role_id = Role::insertGetId([
            'name' => 'ee_dy_engineer',
            'redirect_to' => '/ee',
            'parent_id' => $ee_role_id,
            'display_name' => 'EE Junior Engineer',
            'description' => 'EE Junior Engineer'
        ]);

        $ee_dy_user_id = User::insertGetId([
            'name' => 'Amit Kadam',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => $ee_dy_role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no' => '7412589635',
            'address' => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id' => $ee_dy_user_id,
            'role_id' => $ee_dy_role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $ee_dy_permissions = [
            [
                'name' => 'ee.index',
                'display_name' => 'List EE Application',
                'description' => 'Listing EE Application'
            ]
        ];

        $permission_role = [];

        foreach($ee_dy_permissions as $ee_dy)
        {
            $ee_dy_permission_id = Permission::insertGetId($ee_dy);

            $ee_dy_permission_role[] = [
                'permission_id' => $ee_dy_permission_id,
                'role_id' => $ee_dy_role_id,
            ];
        }

        PermissionRole::insert($ee_dy_permission_role);

        // EE Junior Engineer

        $ee_jr_role_id = Role::insertGetId([
            'name' => 'ee_junior_engineer',
            'redirect_to' => '/ee',
            'parent_id' => $ee_dy_role_id,
            'display_name' => 'EE Junior Engineer',
            'description' => 'EE Junior Engineer'
        ]);

        $ee_jr_user_id = User::insertGetId([
            'name' => 'Suryakant Teli',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => $ee_jr_role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no' => '7412589635',
            'address' => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id' => $ee_jr_user_id,
            'role_id' => $ee_jr_role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $ee_jr_permissions = [
            [
                'name' => 'ee.index',
                'display_name' => 'List EE Application',
                'description' => 'Listing EE Application'
            ]
        ];

        $permission_role = [];

        foreach($ee_jr_permissions as $ee_jr)
        {
            $ee_jr_permission_id = Permission::insertGetId($ee_jr);

            $ee_jr_permission_role[] = [
                'permission_id' => $ee_jr_permission_id,
                'role_id' => $ee_jr_role_id,
            ];
        }

        PermissionRole::insert($ee_jr_permission_role);

        // Layout Table entry

        $layout_id = MasterLayout::insertGetId([
            'layout_name' => 'Samata Nagar, Kandivali(E)',
            'Board' => 'Mumbai',
            'division' => 'Borivali',
        ]);

        // Layout User Mapping

        LayoutUser::insert(['user_id' => $ee_user_id, 'layout_id' => $layout_id]);
        LayoutUser::insert(['user_id' => $ee_dy_user_id, 'layout_id' => $layout_id]);
        LayoutUser::insert(['user_id' => $ee_jr_user_id, 'layout_id' => $layout_id]);
    }
}
