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
            [
                'name'         => 'Ree test',
                'display_name' => 'Ree test',
                'description'  => 'Ree test'
            ],

        ];

        // Role

        // REE branch head
        $ree_role_id = Role::where('name', 'ree_engineer')->value('id');
        if($ree_role_id == NULL)
            $ree_role_id = Role::insertGetId([
                'name'         => 'ree_engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => NULL,
                'display_name' => 'Residential Executive Engineer',
                'description'  => 'Login as Residential Executive Engineer'
            ]);

        // REE Assistant Engineer
        $ree_as_role_id = Role::where('name','REE Assistant Engineer')->value('id');
        if($ree_as_role_id == NULL)
        $ree_as_role_id = Role::insertGetId([
            'name'         => 'REE Assistant Engineer',
            'redirect_to'  => '/ree_applications',
            'parent_id'    => $ree_role_id,
            'display_name' => 'REE Assistant Engineer',
            'description'  => 'Login as REE Assistant Engineer'
        ]);

        // REE Deputy Engineer
        $ree_deputy_role_id = Role::where('name','REE deputy Engineer')->value('id');
        if($ree_deputy_role_id == NULL )
            $ree_deputy_role_id = Role::insertGetId([
                'name'         => 'REE deputy Engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => $ree_as_role_id,
                'display_name' => 'REE Deputy Engineer',
                'description'  => 'Login as REE Deputy Engineer'
            ]);

        // REE Junior Engineer
        $ree_Jr_role_id = Role::where('name','REE Junior Engineer')->value('id');
        if($ree_Jr_role_id == NULL)
            $ree_Jr_role_id = Role::insertGetId([
                'name'         => 'REE Junior Engineer',
                'redirect_to'  => '/ree_applications',
                'parent_id'    => $ree_deputy_role_id,
                'display_name' => 'REE Junior Engineer',
                'description'  => 'Login as REE Junior Engineer'
            ]);

        // User and Role Mapping

        // REE User
        $ree_user_id = User::where('email','neelam1.tambe@wwindia.com')->value('id');
        if($ree_user_id == NULL){
            $ree_user_id = User::insertGetId([
                'name'      => 'Neelam',
                'email'     => 'neelam1.tambe@wwindia.com',
                'password'  => bcrypt('neelam123'),
                'role_id'   => $ree_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            RoleUser::insert([
                'user_id'    => $ree_user_id,
                'role_id'    => $ree_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // REE Assisatant User
        $ree_as_user_id = User::where('email','ree1@gmail.com')->value('id');
        if($ree_as_user_id == NULL){
            $ree_as_user_id = User::insertGetId([
                'name'      => 'REE1',
                'email'     => 'ree1@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_as_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            RoleUser::insert([
                'user_id'    => $ree_as_user_id,
                'role_id'    => $ree_as_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // REE Deputy User
        $ree_deputy_user_id = User::where('email','ree2@gmail.com')->value('id');
        if($ree_deputy_user_id == NULL){
            $ree_deputy_user_id = User::insertGetId([
                'name'      => 'REE2',
                'email'     => 'ree2@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_deputy_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            RoleUser::insert([
                'user_id'    => $ree_deputy_user_id,
                'role_id'    => $ree_deputy_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // REE Junior User
        $ree_Jr_user_id = User::where('email','ree3@gmail.com')->value('id');
        if($ree_Jr_user_id == NULL){
            $ree_Jr_user_id = User::insertGetId([
                'name'      => 'REE3',
                'email'     => 'ree3@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $ree_Jr_role_id,
                'mobile_no' => '9969054274',
                'address'   => 'Mumbai',
                'uploaded_note_path' => 'Test'
            ]);

            RoleUser::insert([
                'user_id'    => $ree_Jr_user_id,
                'role_id'    => $ree_Jr_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // Permissions
        foreach ($permissions as $permission) {

            $per = Permission::where('name', $permission['name'])->first();
            if ($per) {
                continue;
            } else {

                $permission_id = Permission::insertGetId($permission);

                $ree_role_permission[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_role_id,
                ];

                $ree_as_role_permission[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $ree_as_role_id,
                ];

                $ree_deputy_role_permission[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_deputy_role_id,
                ];

                $ree_Jr_role_permission[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $ree_Jr_role_id,
                ];

                PermissionRole::insert($ree_role_permission);
                PermissionRole::insert($ree_as_role_permission);
                PermissionRole::insert($ree_deputy_role_permission);
                PermissionRole::insert($ree_Jr_role_permission);

                // Layout User Mapping
                $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();

                \App\LayoutUser::insert(['user_id' => $ree_user_id, 'layout_id' => $layout_id->id]);
                \App\LayoutUser::insert(['user_id' => $ree_as_user_id, 'layout_id' => $layout_id->id]);
                \App\LayoutUser::insert(['user_id' => $ree_deputy_user_id, 'layout_id' => $layout_id->id]);
                \App\LayoutUser::insert(['user_id' => $ree_Jr_user_id, 'layout_id' => $layout_id->id]);
            }
        }
    }
}
