<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class LmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = Role::insertGetId([
            'name' => 'LM',
            'redirect_to' => '/village_detail',
            'display_name' => 'land_manager',
            'description' => 'Login as Land Manger'
        ]);

        $user_id = User::insertGetId([
            'name' => 'martin.philipose',
            'email' => 'martin.philipose@wwindia.com',
            'password' => bcrypt('martinp123'),
            'role_id' => $role_id,
            'uploaded_note_path' => 'Test',
            'mobile_no' => '7412589635',
            'address' => 'Mumbai'
        ]);

        $role_user = RoleUser::insert([
            'user_id' => $user_id,
            'role_id' => $role_id,
            'start_date' => \Carbon\Carbon::now()
        ]);

        $permissions = [
            [
                'name' => 'village_detail.index',
                'display_name' => 'List village',
                'description' => 'Listing of village'
            ],
            [
                'name' => 'village_detail.create',
                'display_name' => 'Create a village',
                'description' => 'Creating a new village'
            ],
            [
                'name' => 'village_detail.edit',
                'display_name' => 'Edit a village',
                'description' => 'Edit a village'
            ],
            [
                'name' => 'village_detail.update',
                'display_name' => 'Update a village',
                'description' => 'Updating data of a particular village'
            ],
            [
                'name' => 'village_detail.destroy',
                'display_name' => 'Delete a village',
                'description' => 'Delete a particular village'
            ],
            [
                'name' => 'loadDeleteVillageUsingAjax',
                'display_name' => 'Delete route from pop up',
                'description' => 'Delete route from pop up'
            ],
            [
                'name' => 'village_detail.store',
                'display_name' => 'Store a village a data',
                'description' => 'Creating a new village'
            ],
            [
                'name' => 'society_detail.index',
                'display_name' => 'Society list',
                'description' => 'List all societies coming under particular village'
            ],
            [
                'name' => 'society_detail.create',
                'display_name' => 'Society Create',
                'description' => 'Create society for a particular village'
            ],
            [
                'name' => 'society_detail.store',
                'display_name' => 'Society Store',
                'description' => 'Store society data for a particular village'
            ],
            [
                'name' => 'society_detail.edit',
                'display_name' => 'Society Edit',
                'description' => 'Edit society data for a particular village'
            ],
            [
                'name' => 'society_detail.update',
                'display_name' => 'Society Update',
                'description' => 'Update society data for a particular village'
            ],
            [
                'name' => 'lease_detail.index',
                'display_name' => 'List Lease',
                'description' => 'List lease for a particular society'
            ],
            [
                'name' => 'lease_detail.create',
                'display_name' => 'Create Lease',
                'description' => 'Create lease for a particular society'
            ],
            [
                'name' => 'lease_detail.store',
                'display_name' => 'Store Lease',
                'description' => 'Store lease for a particular society'
            ],
            [
                'name' => 'renew-lease.renew',
                'display_name' => 'Renew Lease',
                'description' => 'Renew lease for a particular society'
            ],
            [
                'name' => 'renew-lease.update-lease',
                'display_name' => 'Updated Renew Lease data',
                'description' => 'Updated Renew Lease data'
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
