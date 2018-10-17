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
        $ee_permissions = [
            [
                'name' => 'ee.index',
                'display_name' => 'List EE Application',
                'description' => 'Listing EE Application'
            ],
            [
                'name' => 'scrutiny-remark',
                'display_name' => 'Scrutiny Remark',
                'description' => 'Scrutiny Remark by EE'
            ],
            [
                'name' => 'ee-scrutiny-document',
                'display_name' => 'Scrutiny document',
                'description' => 'Scrutiny document'
            ],
            [
                'name' => 'get-ee-scrutiny-data',
                'display_name' => 'Scrutiny Remark data fetch',
                'description' => 'Scrutiny Remark data fetch'
            ],
            [
                'name' => 'edit-ee-scrutiny-document',
                'display_name' => 'Scrutiny document edit',
                'description' => 'Scrutiny document edit'
            ],
            [
                'name' => 'ee-document-scrutiny-delete',
                'display_name' => 'Scrutiny document delete',
                'description' => 'Scrutiny document delete'
            ],
            [
                'name' => 'document-submitted',
                'display_name' => 'Document submitted',
                'description' => 'Document submitted'
            ],
            [
                'name' => 'get-forward-application',
                'display_name' => 'Forward Application form',
                'description' => 'Forward Application form'
            ],
            [
                'name' => 'forward-application',
                'display_name' => 'Forward Application form data store',
                'description' => 'Forward Application form data store'
            ],

            [
                'name' => 'consent-verfication',
                'display_name' => 'Consent verification data store',
                'description' => 'Consent verification data store'
            ],

            [
                'name' => 'ee-demarcation',
                'display_name' => 'EE Demarcation data store',
                'description' => 'EE Demarcation data store'
            ],

            [
                'name' => 'ee-tit-bit',
                'display_name' => 'EE TIT BIT data store',
                'description' => 'EE TIT BIT data store'
            ],

            [
                'name' => 'ee-rg-relocation',
                'display_name' => 'EE RG Relocation data store',
                'description' => 'EE RG Relocation data store'
            ],
            [
                'name' => 'ee-abc-relocation',
                'display_name' => 'EE RG Relocation data store',
                'description' => 'EE RG Relocation data store'
            ],
        ];

        // Role

        // EE Department Head
        $ee_manager = Role::where('name', '=', 'ee_engineer')->select('id')->get();

        if (count($ee_manager) == 0)
            $ee_role_id = Role::insertGetId([
                'name' => 'ee_engineer',
                'redirect_to' => '/ee',
                'parent_id' => NULL,
                'display_name' => 'EE Engineer',
                'description' => 'EE Engineer'
            ]);
        else
            $ee_role_id = $ee_manager[0]['id'];

        // EE Deputy Engineer
        $ee_deputy_engineer = Role::where('name','ee_dy_engineer')->select('id')->get();

        if(count($ee_deputy_engineer) == 0)
            $ee_dy_role_id = Role::insertGetId([
                'name' => 'ee_dy_engineer',
                'redirect_to' => '/ee',
                'parent_id' => $ee_role_id,
                'display_name' => 'EE Deputy Engineer',
                'description' => 'EE Deputy Engineer'
            ]);
        else
            $ee_dy_role_id = $ee_deputy_engineer[0]['id'];

        // EE Junior Engineer
        $ee_junior_engineer = Role::where('name','ee_junior_engineer')->select('id')->get();

        if(count($ee_junior_engineer) == 0)
            $ee_jr_role_id = Role::insertGetId([
                'name' => 'ee_junior_engineer',
                'redirect_to' => '/ee',
                'parent_id' => $ee_dy_role_id,
                'display_name' => 'EE Junior Engineer',
                'description' => 'EE Junior Engineer'
            ]);
        else
            $ee_jr_role_id = $ee_junior_engineer[0]['id'];


        // User and Role Mapping

        // EE User
        $ee_user = User::select('id')->where('email','user1@gmail.com')->get()->toArray();

        if(count($ee_user) == 0){
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
        }else{
            $ee_user_id = $ee_user[0]['id'];
        }



        // EE Deputy Engineer
        $ee_dy_user = User::select('id')->where('email','user2@gmail.com')->get()->toArray();

        if(count($ee_dy_user)){
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
        }else{
            $ee_dy_user_id = $ee_dy_user[0]['id'];
        }


        // EE Junior Engineer
        $ee_jr_user = User::select('id')->where('email','user3@gmail.com')->get()->toArray();

        if(count($ee_jr_user)){
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
        }else{
            $ee_jr_user_id = $ee_jr_user;
        }

        // Permissions
        foreach ($ee_permissions as $permission) {

            $per = Permission::where('name', $permission['name'])->first();
            if ($per) {
                continue;
            } else {

                $permission_id = Permission::insertGetId($permission);

                $ee_permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $ee_role_id,
                ];

                $ee_dy_permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $ee_dy_role_id,
                ];

                $ee_jr_permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $ee_jr_role_id,
                ];

                PermissionRole::insert($ee_permission_role);
                PermissionRole::insert($ee_dy_permission_role);
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
    }
}
