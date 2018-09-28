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
        $ree_manager = Role::where('name', '=', 'ree_engineer')->select('id')->get();

        if (count($ree_manager) == 0) {
            // REE branch head
            $ree_role_id = Role::insertGetId([
                'name'         => 'ree_engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => NULL,
                'display_name' => 'Residential Executive Engineer',
                'description'  => 'Login as Residential Executive Engineer'
            ]);

            $ree_user_id = User::insertGetId([
                'name'      => 'Neelam',
                'email'     => 'neelam1.tambe@wwindia.com',
                'password'  => bcrypt('neelam123'),
                'role_id'   => $ree_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            $role_user = RoleUser::insert([
                'user_id'    => $ree_user_id,
                'role_id'    => $ree_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permissions = [
                [
                    'name'         => 'ree_dashboard.index',
                    'display_name' => 'REE Dashboard',
                    'description'  => 'REE Dashboard'
                ],
                [
                    'name'         => 'ree_applications.index',
                    'display_name' => 'REE Dashboard',
                    'description'  => 'REE Dashboard'
                ],
                [
                    'name'         => 'ol_calculation_sheet.show',
                    'display_name' => 'Calculation Sheet',
                    'description'  => 'Application calculation sheet'
                ],
                [
                    'name'         => 'ree.society_EE_documents',
                    'display_name' => 'society EE documents',
                    'description'  => 'society EE documents'
                ],
                [
                    'name'         => 'ree.EE_Scrutiny_Remark',
                    'display_name' => 'EE Scrutiny Remark',
                    'description'  => 'EE Scrutiny Remark'
                ],
                [
                    'name'         => 'ree.dyce_scrutiny_remark',
                    'display_name' => 'dyce scrutiny remark',
                    'description'  => 'dyce scrutiny remark'
                ],
                [
                    'name'         => 'ree.forward_application',
                    'display_name' => 'forward application',
                    'description'  => 'forward application'
                ],
                [
                    'name'         => 'ree.forward_application_data',
                    'display_name' => 'forward application data',
                    'description'  => 'forward application data'
                ],                
                [
                    'name'         => 'ree.download_cap_note',
                    'display_name' => 'download cap note',
                    'description'  => 'download cap note'
                ],
                [
                    'name'         => 'save_calculation_details',
                    'display_name' => 'Save calculation details',
                    'description'  => 'Save calculation details'
                ],
                [
                    'name'         => 'ree.upload_ree_note',
                    'display_name' => 'Upload ree note',
                    'description'  => 'Upload ree note'
                ],
                [
                    'name'         => 'ol_sharing_calculation_sheet.show',
                    'display_name' => 'Sharing Calculation Sheet',
                    'description'  => 'Sharing Application calculation sheet'
                ],
                [
                    'name'         => 'save_sharing_calculation_details',
                    'display_name' => 'Save sharing calculation details',
                    'description'  => 'Save sharing calculation details'
                ],

            ];

            $permission_role = [];

            foreach ($permissions as $ree_per) {
                $permission_id = Permission::insertGetId($ree_per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_role_id,
                ];
            }

            PermissionRole::insert($permission_role);

            // REE Assistant Engineer
            $ree_as_role_id = Role::insertGetId([
                'name'         => 'REE Assistant Engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => $ree_role_id,
                'display_name' => 'REE Assistant Engineer',
                'description'  => 'Login as REE Assistant Engineer'
            ]);

            $ree_as_user_id = User::insertGetId([
                'name'      => 'REE1',
                'email'     => 'ree1@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_as_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            $role_user = RoleUser::insert([
                'user_id'    => $ree_as_user_id,
                'role_id'    => $ree_as_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permission_role1 = [];

            foreach ($permissions as $ree_per1) {
                $permission_id = Permission::insertGetId($ree_per1);

                $permission_role1[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $ree_as_role_id,
                ];
            }

            PermissionRole::insert($permission_role1);

            // REE Deputy Engineer
            $ree_deputy_role_id = Role::insertGetId([
                'name'         => 'REE deputy Engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => $ree_as_role_id,
                'display_name' => 'REE Deputy Engineer',
                'description'  => 'Login as REE Deputy Engineer'
            ]);

            $ree_deputy_user_id = User::insertGetId([
                'name'      => 'REE2',
                'email'     => 'ree2@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_deputy_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            $role_user = RoleUser::insert([
                'user_id'    => $ree_deputy_user_id,
                'role_id'    => $ree_deputy_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permission_role2 = [];

            foreach ($permissions as $ree_per2) {
                $permission_id = Permission::insertGetId($ree_per2);

                $permission_role2[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_deputy_role_id,
                ];
            }

            PermissionRole::insert($permission_role2);

            // REE Junior Engineer
            $ree_Jr_role_id = Role::insertGetId([
                'name'         => 'REE Junior Engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => $ree_deputy_role_id,
                'display_name' => 'REE Junior Engineer',
                'description'  => 'Login as REE Junior Engineer'
            ]);

            $ree_Jr_user_id = User::insertGetId([
                'name'      => 'REE3',
                'email'     => 'ree3@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_Jr_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            $role_user = RoleUser::insert([
                'user_id'    => $ree_Jr_user_id,
                'role_id'    => $ree_Jr_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permission_role3 = [];

            foreach ($permissions as $ree_per3) {
                $permission_id = Permission::insertGetId($ree_per3);

                $permission_role3[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_Jr_role_id,
                ];
            }

            PermissionRole::insert($permission_role3);

            // Layout User Mapping
            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();

            \App\LayoutUser::insert(['user_id' => $ree_user_id, 'layout_id' => $layout_id->id]);
            \App\LayoutUser::insert(['user_id' => $ree_as_user_id, 'layout_id' => $layout_id->id]);
            \App\LayoutUser::insert(['user_id' => $ree_deputy_user_id, 'layout_id' => $layout_id->id]);
            \App\LayoutUser::insert(['user_id' => $ree_Jr_user_id, 'layout_id' => $layout_id->id]);
        }
    }
}
