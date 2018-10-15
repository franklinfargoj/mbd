<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

class EmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $land_manager = Role::where('name', '=', 'EM')->select('id')->get();

        if (count($land_manager) == 0) {
            $role_id = Role::insertGetId([
                'name' => 'EM',
                'redirect_to' => '/em',
                'display_name' => 'estate_manager',
                'description' => 'Login as Estae Manger',
            ]);

            $user_id = User::insertGetId([
                'name' => 'estate namager',
                'email' => 'em@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '8785854587',
                'address' => 'Mumbai',
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);

            $permissions = [
                // [
                //     'name' => 'village_detail.index',
                //     'display_name' => 'List village',
                //     'description' => 'Listing of village'
                // ],
            ];

            $permission_role = [];

            foreach ($permissions as $lm_per) {
                $permission_id = Permission::insertGetId($lm_per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }
            if (count($permission_role) > 0) {
                PermissionRole::insert($permission_role);
            }

        }
    }
}
