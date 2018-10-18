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
                'name' => 'test3',
                'display_name' => 'EE test 3',
                'description' => 'EE test3'
            ],
            [
                'name' => 'architect_layout.index',
                'display_name' => 'List layouts',
                'description' => 'Listing of architect layouts',
            ],
            [
                'name' => 'architect_layouts_layout_details.index',
                'display_name' => 'architect_layouts_layout_details.index',
                'description' => 'architect_layouts_layout_details.index',
            ],
            [
                'name' => 'architect_layout_details.view',
                'display_name' => 'architect_layout_details.view',
                'description' => 'architect_layout_details.view',
            ],
            [
                'name' => 'architect_layout_detail_view_cts_plan',
                'display_name' => 'architect_layout_detail_view_cts_plan',
                'description' => 'architect_layout_detail_view_cts_plan',
            ],
            [
                'name' => 'architect_layout_detail_view_prc_detail',
                'display_name' => 'architect_layout_detail_view_prc_detail',
                'description' => 'architect_layout_detail_view_prc_detail',
            ],
            [
                'name' => 'architect_detail_dp_crz_remark_view',
                'display_name' => 'architect_detail_dp_crz_remark_view',
                'description' => 'architect_detail_dp_crz_remark_view',
            ],
            [
                'name' => 'view_court_case_or_dispute_on_land',
                'display_name' => 'view_court_case_or_dispute_on_land',
                'description' => 'view_court_case_or_dispute_on_land',
            ],
            [
                'name' => 'forward_architect_layout',
                'display_name' => 'forward_architect_layout',
                'description' => 'forward_architect_layout',
            ],
            [
                'name' => 'post_forward_architect_layout',
                'display_name' => 'post_forward_architect_layout',
                'description' => 'post_forward_architect_layout',
            ],
            [
                'name' => 'architect_layout_get_scrtiny',
                'display_name' => 'architect_layout_get_scrtiny',
                'description' => 'architect_layout_get_scrtiny',
            ],
            [
                'name' => 'architect_layout_add_scrutiny_report',
                'display_name' => 'architect_layout_add_scrutiny_report',
                'description' => 'architect_layout_add_scrutiny_report',
            ],
            [
                'name' => 'architect_layout_post_scrutiny_report',
                'display_name' => 'architect_layout_post_scrutiny_report',
                'description' => 'architect_layout_post_scrutiny_report',
            ],
            [
                'name'=>'upload_ee_checklist_and_remark_report',
                'display_name'=>'upload_ee_checklist_and_remark_report',
                'description'=>'upload_ee_checklist_and_remark_report'
            ],
            [
                'name'=>'post_ee_checklist_and_remark_report',
                'display_name'=>'post_ee_checklist_and_remark_report',
                'description'=>'post_ee_checklist_and_remark_report'
            ]
        ];

        // Role

        // EE Department Head
        $ee_role_id = Role::where('name', '=', 'ee_engineer')->value('id');

        if ($ee_role_id == NULL)
            $ee_role_id = Role::insertGetId([
                'name' => 'ee_engineer',
                'redirect_to' => '/ee',
                'parent_id' => NULL,
                'display_name' => 'EE Engineer',
                'description' => 'EE Engineer'
            ]);

        // EE Deputy Engineer
        $ee_dy_role_id = Role::where('name','ee_dy_engineer')->value('id');

        if($ee_dy_role_id  == NULL)
            $ee_dy_role_id = Role::insertGetId([
                'name' => 'ee_dy_engineer',
                'redirect_to' => '/ee',
                'parent_id' => $ee_role_id,
                'display_name' => 'EE Deputy Engineer',
                'description' => 'EE Deputy Engineer'
            ]);

        // EE Junior Engineer
        $ee_jr_role_id = Role::where('name','ee_junior_engineer')->value('id');

        if($ee_jr_role_id == NULL)
            $ee_jr_role_id = Role::insertGetId([
                'name' => 'ee_junior_engineer',
                'redirect_to' => '/ee',
                'parent_id' => $ee_dy_role_id,
                'display_name' => 'EE Junior Engineer',
                'description' => 'EE Junior Engineer'
            ]);

        // User and Role Mapping

        // EE User
        $ee_user_id = User::where('email','user1@gmail.com')->value('id');

        if($ee_user_id == NULL){
            $ee_user_id = User::insertGetId([
                'name' => 'Nitin Gadkari',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $ee_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $ee_user_id,
                'role_id' => $ee_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // EE Deputy Engineer
        $ee_dy_user_id = User::where('email','user2@gmail.com')->value('id');

        if($ee_dy_user_id == NULL){
            $ee_dy_user_id = User::insertGetId([
                'name' => 'Amit Kadam',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $ee_dy_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $ee_dy_user_id,
                'role_id' => $ee_dy_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // EE Junior Engineer
        $ee_jr_user_id = User::where('email','user3@gmail.com')->value('id');

        if($ee_jr_user_id == NULL){
            $ee_jr_user_id = User::insertGetId([
                'name' => 'Suryakant Teli',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => $ee_jr_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $ee_jr_user_id,
                'role_id' => $ee_jr_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // Permissions
        foreach ($ee_permissions as $permission) {

            $per = Permission::where('name', $permission['name'])->first();
            if ($per) {
                $permission_id=$per->id;
                //continue;
            } else {
                $permission_id = Permission::insertGetId($permission);
            }

                
                $ee_permission_role = [[
                    'permission_id' => $permission_id,
                    'role_id' => $ee_role_id,
                ]];

                if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $ee_role_id])->first())
                {

                }else
                {
                    PermissionRole::insert($ee_permission_role);
                }

                $ee_dy_permission_role = [[
                    'permission_id' => $permission_id,
                    'role_id' => $ee_dy_role_id,
                ]];
                if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $ee_dy_role_id])->first())
                {

                }else
                {
                    PermissionRole::insert($ee_dy_permission_role);
                }

                $ee_jr_permission_role = [[
                    'permission_id' => $permission_id,
                    'role_id' => $ee_jr_role_id,
                ]];
                
                if(PermissionRole::where(['permission_id' => $permission_id,'role_id' => $ee_jr_role_id])->first())
                {

                }else
                {
                    PermissionRole::insert($ee_jr_permission_role);
                }

                
                
                
                

                // Layout Table entry
                $master_layout=MasterLayout::where([
                    'layout_name' => 'Samata Nagar, Kandivali(E)',
                    'Board' => 'Mumbai',
                    'division' => 'Borivali',
                ])->first();
                if($master_layout)
                {
                    $layout_id=$master_layout->id;
                }else
                {
                    $layout_id = MasterLayout::insertGetId([
                        'layout_name' => 'Samata Nagar, Kandivali(E)',
                        'Board' => 'Mumbai',
                        'division' => 'Borivali',
                    ]);
                }
                

                // Layout User Mapping
                if(LayoutUser::where(['user_id' => $ee_user_id, 'layout_id' => $layout_id])->first())
                {

                }else
                {
                    LayoutUser::insert(['user_id' => $ee_user_id, 'layout_id' => $layout_id]);
                }

                if(LayoutUser::where(['user_id' => $ee_dy_user_id, 'layout_id' => $layout_id])->first())
                {

                }else
                {
                    LayoutUser::insert(['user_id' => $ee_dy_user_id, 'layout_id' => $layout_id]);
                }

                if(LayoutUser::where(['user_id' => $ee_jr_user_id, 'layout_id' => $layout_id])->first())
                {

                }else
                {
                    LayoutUser::insert(['user_id' => $ee_jr_user_id, 'layout_id' => $layout_id]);
                }
                
                
                
            
        }
    }
}
