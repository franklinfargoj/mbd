<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;

class AccountPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Account Role
        $account_role_id = Role::where('name', '=', 'Account')->value('id');

        if ($account_role_id == NULL)
            $account_role_id = Role::insertGetId([
                'name' => 'Account',
                'redirect_to' => '/search_accounts',
                'display_name' => 'accounts',
                'description' => 'Login as Account',
            ]);

        // Account User
        $account_user_id = User::where(['email' => 'account@gmail.com'])->value('id');

        if ($account_user_id == NULL )
            $account_user_id = User::insertGetId([
                'name' => 'account',
                'email' => 'account@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $account_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '8785854587',
                'address' => 'Mumbai',
            ]);
        
        // Account User and Account Role Mapping
        $account_role_user = RoleUser::where(['user_id' => $account_user_id, 'role_id' => $account_role_id])->first();

        if($account_role_user == NULL)
            RoleUser::insert([
                'user_id' => $account_user_id,
                'role_id' => $account_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

         // Account Permissions
        $permissions = [
            [
                'name'=>'search_accounts',
                'display_name'=>'Search Accounts'
            ],
            [
                'name' => 'get_building_select_society',
                'display_name' => 'Selected Building',
                'description' => 'Selected Building'
            ],
            [
                'name' => 'get_societies_select_layout',
                'display_name' => 'Selected Society',
                'description' => 'Selected Society'
            ],
            [
                'name' => 'account_search',
                'display_name' => 'Account Search',
                'description' => 'Account Search'
            ],
            [
                'name' => 'view_calculations',
                'display_name' => 'View Calculations',
                'description' => 'View Calculations'
            ],
            [
                'name' => 'payment_details',
                'display_name' => 'Payment Details',
                'description' => 'Payment Details'
            ],
            [
                'name' => 'downloadReceipt',
                'display_name' => 'View Receipt Details',
                'description' => 'View Receipt Details'
            ],
        ];

        $permission_role = [];

        foreach ($permissions as $lm_per) {
            $permission_id = Permission::where(['name' => $lm_per['name']])->value('id');

            if (!($permission_id))
                $permission_id = Permission::insertGetId($lm_per);

            $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $account_role_id])->first();

            if (!$PermissionRole) {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $account_role_id,
                ];
            }

        }
        
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }

        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->value('id');
        $layout_user =  \App\LayoutUser::where('user_id',$account_user_id)->where('layout_id',$layout_id)->first();

        if(!$layout_user){
            \App\LayoutUser::insert(['user_id' => $account_user_id, 'layout_id' => $layout_id]);
        }
    }
}
