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
                'name'=>'architect_layout_dashboard',
                'display_name' => 'Dashboard for Architect',
                'description' => 'Dashboard for Architect'
            ],
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
                'name'=>'delete_architect_layout_scrutiny_report',
                'display_name'=>'delete_architect_layout_scrutiny_report',
                'description'=>'delete_architect_layout_scrutiny_report'
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
            ],            
            [
                'name'=>'conveyance.index',
                'display_name'=>'conveyance',
                'description'=>'conveyance'
            ],           
            [
                'name'=>'conveyance.view_application',
                'display_name'=>'view application',
                'description'=>'view application'
            ],            
            [
                'name'=>'ee.sale_price_calculation',
                'display_name'=>'ee sale price calculation',
                'description'=>'ee sale price calculation'
            ],            
            [
                'name'=>'ee.save_calculation_data',
                'display_name'=>'save calculation data',
                'description'=>'save calculation data'
            ],
            [
                'name' => 'arrears_charges.create',
                'display_name' => 'Arrears charges create',
                'description' => 'Arrears charges create'
            ],
            [
                'name' => 'arrears_charges.store',
                'display_name' => 'Arrears charges store',
                'description' => 'Arrears charges store'
            ],
            [
                'name' => 'arrears_charges.edit',
                'display_name' => 'Arrears charges edit',
                'description' => 'Arrears charges edit'
            ],
            [
                'name' => 'arrears_charges.update',
                'display_name' => 'Arrears charges update',
                'description' => 'Arrears charges update'
            ],
            [
                'name' => 'arrears_charges',
                'display_name' => 'Arrears charges list',
                'description' => 'Arrears charges list'
            ],
            [
                'name' => 'service_charges.create',
                'display_name' => 'Service charges create',
                'description' => 'Service charges create'
            ],
            [
                'name' => 'service_charges.store',
                'display_name' => 'Service charges store',
                'description' => 'Service charges store'
            ],
            [
                'name' => 'service_charges.edit',
                'display_name' => 'Service charges edit',
                'description' => 'Service charges edit'
            ],
            [
                'name' => 'service_charges.update',
                'display_name' => 'Service charges update',
                'description' => 'Service charges update'
            ],
            [
                'name' => 'service_charges',
                'display_name' => 'Service charges list',
                'description' => 'Service charges list'
            ],
            [
                'name' => 'society.billing_level',
                'display_name' => 'Society billing level',
                'description' => 'Society billing level'
            ],
            [
                'name' => 'society.society_details',
                'display_name' => 'Society details',
                'description' => 'Society details'
            ],
            [
                'name' => 'ee.upload_ee_note',
                'display_name' => 'Upload EE Note',
                'description' => 'Upload EE Note'
            ],            
            [
                'name'          => 'ee.save_demarcation_plan',
                'display_name'  => 'save demarcation plan',
                'description'   => 'save demarcation plan'
            ],            
            [
                'name'          => 'ee.save_covering_letter',
                'display_name'  => 'save covering letter',
                'description'   => 'save covering letter'
            ],            
            [
                'name'          => 'conveyance.forward_application_sc',
                'display_name'  => 'forward application sc',
                'description'   => 'forward application sc'
            ],            
            [
                'name'          => 'ee.send_forward_application',
                'display_name'  => 'send forward application',
                'description'   => 'send forward application'
            ],
            [
                'name'=>'dashboard',
                'display_name'=>'dashboard',
                'description'=>'Dashboard'
            ],
            [
                'name' => 'conveyance.architect_scrutiny_remark',
                'display_name' => 'architect scrutiny remark',
                'description' => 'architect scrutiny remark',
            ],
            [
                'name' => 'renewal.index',
                'display_name' => 'renewal',
                'description' => 'renewal',
            ],            
            [
                'name' => 'renewal.view_application',
                'display_name' => 'renewal_view_application',
                'description' => 'renewal_view_application',
            ],
            [
                'name' => 'renewal.renewal_forward_application',
                'display_name' => 'renewal forward application',
                'description' => 'renewal forward application',
            ],            
            [
                'name' => 'renewal.save_forward_application_renewal',
                'display_name' => 'save forward application renewal',
                'description' => 'save forward application renewal',
            ],            
            [
                'name' => 'renewal.ee_scrutiny',
                'display_name' => 'ee scrutiny page',
                'description' => 'ee scrutiny page',
            ],            
            [
                'name' => 'renewal.save_ee_scrutiny',
                'display_name' => 'save renewal ee scrutiny',
                'description' => 'save renewal ee scrutiny',
            ],             
            [
                'name' => 'ee.upload_ee_scrutiny_documents',
                'display_name' => 'upload ee scrutiny documents',
                'description' => 'upload ee scrutiny documents',
            ],            
            [
                'name' => 'ee.save_scrutiny_remark',
                'display_name' => 'save scrutiny remark',
                'description' => 'save scrutiny remark',
            ],             
            [
                'name' => 'ee.delete_ee_scrutiny_documents',
                'display_name' => 'delete ee scrutiny documents',
                'description' => 'delete ee scrutiny documents',
            ],            
            [
                'name' => 'renewal.architect_scrutiny',
                'display_name' => 'renewal architect scrutiny',
                'description' => 'renewal architect scrutiny',
            ],             
            [
                'name' => 'conveyance.view_documents',
                'display_name' => 'view conveyance documents',
                'description' => 'view conveyance documents',
            ], 
            [
                'name'=>'renewal.view_documents',
                'display_name'=>'view renewal society documents',
                'description'=>'view renewal society documents'
            ],            
            [
                'name'=>'delete_ee_note',
                'display_name'=>'delete ee note',
                'description'=>'delete ee note'
            ],            
            [
                'name'=>'ee_variation_report',
                'display_name'=>'generate ee variation report',
                'description'=>'generate ee variation report'
            ],                                                  
            [
                'name'=>'redevelopement.period_wise_pendency_report',
                'display_name'=>'redevelopement.period_wise_pendency_report',
                'description'=>'redevelopement.period_wise_pendency_report'
            ],
            [
                'name'=>'redevelopement_pending_reports',
                'display_name'=>'redevelopement_pending_reports',
                'description'=>'redevelopement_pending_reports'
            ],                        
            [
                'name'=>'view_multiple_document',
                'display_name'=>'view multiple document',
                'description'=>'view multiple document'
            ]                                    
        ];

        // Role

        // EE Department Head
        $ee_role_id = Role::where('name', '=', 'ee_engineer')->value('id');

        if ($ee_role_id == NULL)
            $ee_role_id = Role::insertGetId([
                'name' => 'ee_engineer',
                'redirect_to' => '/ee',
                'dashboard' => '/dashboard',
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
                'dashboard' => '/dashboard',
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
                'dashboard' => '/dashboard',
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
                $master_layout=MasterLayout::where('layout_name','Samata Nagar, Kandivali(E)')->first();
                if($master_layout)
                {
                    $layout_id=$master_layout->id;
                }else
                {
                    $layout_id = MasterLayout::insertGetId([
                        'layout_name' => 'Samata Nagar, Kandivali(E)',
                        'Board' => '',
                        'division' => '',
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