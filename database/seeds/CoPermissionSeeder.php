<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

class CoPermissionSeeder extends Seeder
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
                'name'=>'architect_layout_dashboard',
                'display_name' => 'Dashboard for Architect',
                'description' => 'Dashboard for Architect'
            ],
            [
                'name' => 'co.index',
                'display_name' => 'index',
                'description' => 'index',
            ],
            [
                'name' => 'co.society_EE_documents',
                'display_name' => 'society_EE_documents',
                'description' => 'society_EE_documents',
            ],
            [
                'name'=>'common.EE_Scrutiny_Remark',
                'display_name'=>'EE Scrutiny Remark',
                'description'=>'EE Scrutiny Remark'
            ],             
            // [
            //     'name' => 'co.EE_Scrutiny_Remark',
            //     'display_name' => 'EE_Scrutiny_Remark',
            //     'description' => 'EE_Scrutiny_Remark',
            // ],
            // [
            //     'name' => 'co.scrutiny_remark',
            //     'display_name' => 'scrutiny_remark',
            //     'description' => 'scrutiny_remark',
            // ],
            [
                'name' => 'common.dyce_scrutiny_remark',
                'display_name' => 'dyce scrutiny remark',
                'description' => 'dyce scrutiny remark',
            ],
            [
                'name' => 'co.forward_application',
                'display_name' => 'forward_application',
                'description' => 'forward_application',
            ],
            [
                'name' => 'co.forward_application_data',
                'display_name' => 'forward_application_data',
                'description' => 'forward_application_data',
            ],
            [
                'name' => 'co.download_cap_note',
                'display_name' => 'download_cap_note',
                'description' => 'download_cap_note',
            ],
            [
                'name' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'display_name' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
                'description' => 'architect_Layout_scrutiny_of_ee_em_lm_ree',
            ],
            [
                'name' => 'architect_layout_prepare_layout_excel',
                'display_name' => 'architect_layout_prepare_layout_excel',
                'description' => 'architect_layout_prepare_layout_excel',
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
                'name'=>'conveyance.sale_lease_agreement',
                'display_name'=>'sale lease agreement',
                'description'=>'sale lease agreement'
            ],
            [
                'name' => 'conveyance.save_agreement_comments',
                'display_name' => 'save agreement comments',
                'description' => 'save agreement comments',
            ], 
            [
                'name' => 'conveyance.approved_sale_lease_agreement',
                'display_name' => 'approved sale lease agreement',
                'description' => 'approved sale lease agreement',
            ],
            [
                'name' => 'conveyance.stamp_duty_agreement',
                'display_name' => 'stamp duty agreement',
                'description' => 'stamp duty agreement',
            ],
            [
                'name' => 'conveyance.stamp_signed_duty_agreement',
                'display_name' => 'stamp signed duty agreement',
                'description' => 'stamp signed duty agreement',
            ],
            [
                'name' => 'conveyance.register_sale_lease_agreement',
                'display_name' => 'register sale lease agreement',
                'description' => 'register sale lease agreement',
            ], 
            [
                'name' => 'conveyance.checklist',
                'display_name' => 'checklist',
                'description' => 'checklist',
            ], 
            [
                'name' => 'conveyance.forward_application_sc',
                'display_name' => 'forward application data',
                'description' => 'forward application data',
            ],                       
            [
                'name' => 'conveyance.save_forward_application',
                'display_name' => 'forward application data',
                'description' => 'forward application data',
            ],
            [
                'name' => 'conveyance.view_ee_documents',
                'display_name' => 'view ee documents',
                'description' => 'view ee documents',

            ],
            [
                'name'=>'dashboard',
                'display_name'=>'dashboard',
                'description'=>'Dashboard'
            ],
            [
                'name'=>'co_applications.reval',
                'display_name'=>'Applications for revalidation',
                'description'=>'Applications for revalidation'
            ],
            [
                'name'=>'co.view_reval_application',
                'display_name'=>'View Revalidation Application',
                'description'=>'View Revalidation Application'

            ],
            [
                'name'=>'co.society_reval_documents',
                'display_name'=>'View Society Revalidation Documents',
                'description'=>'View Society Revalidation Documents'

            ],
            [
                'name' => 'co.show_reval_calculation_sheet',
                'display_name' => 'show Revalidation calculation sheet',
                'description' => 'show Revalidation calculation sheet',
            ],
            [
                'name'=>'co.forward_reval_application',
                'display_name'=>'Forward Revalidation Application',
                'description'=>'Forward Revalidation Application'

            ],
            [
                'name' => 'co.forward_reval_application_data',
                'display_name' => 'Forward Revalidation Application Data',
                'description' => 'Forward Revalidation Application Data',
            ],
            // [
            //     'name' => 'renewal.index',
            //     'display_name' => 'renewal',
            //     'description' => 'renewal',
            // ],            
            // [
            //     'name' => 'renewal.view_application',
            //     'display_name' => 'renewal_view_application',
            //     'description' => 'renewal_view_application',
            // ],            
            // [
            //     'name' => 'renewal.prepare_renewal_agreement',
            //     'display_name' => 'prepare renewal agreement',
            //     'description' => 'prepare renewal agreement',
            // ],
            // [
            //     'name' => 'renewal.approve_renewal_agreement',
            //     'display_name' => 'approve renewal agreement',
            //     'description' => 'approve renewal agreement',
            // ],
            // [
            //     'name' => 'renewal.renewal_forward_application',
            //     'display_name' => 'renewal forward application',
            //     'description' => 'renewal forward application',
            // ],            
            // [
            //     'name' => 'renewal.save_forward_application_renewal',
            //     'display_name' => 'save forward application renewal',
            //     'description' => 'save forward application renewal',
            // ],            
            // [
            //     'name' => 'renewal.stamp_renewal_agreement',
            //     'display_name' => 'stamp renewal agreement',
            //     'description' => 'stamp renewal agreement',
            // ],             
            // [
            //     'name' => 'renewal.save_stamp_renewal_agreement',
            //     'display_name' => 'save stamp renewal agreement',
            //     'description' => 'save stamp renewal agreement',
            // ],             
            // [
            //     'name' => 'renewal.save_agreement_comments',
            //     'display_name' => 'save agreement comments',
            //     'description' => 'save agreement comments',
            // ],
            // [
            //     'name' => 'renewal.ee_scrutiny',
            //     'display_name' => 'renewal ee scrutiny',
            //     'description' => 'renewal ee scrutiny',
            // ],            
            // [
            //     'name' => 'renewal.architect_scrutiny',
            //     'display_name' => 'renewal architect scrutiny',
            //     'description' => 'renewal architect scrutiny',
            // ],            
            [
                'name' => 'conveyance.architect_scrutiny_remark',
                'display_name' => 'conveyance architect scrutiny remark',
                'description' => 'conveyance architect scrutiny remark',
            ],
            [
                'name'=>'conveyance.view_documents',
                'display_name'=>'view conveyance documents',
                'description'=>'view conveyance documents'
            ],
            [
                'name'=>'em.scrutiny_remark',
                'display_name'=>'EM scrutiny remark',
                'description'=>'EM scrutiny remark'
            ],
            [
                'name'=>'conveyance.save_draft_sign_conveyance_agreement',
                'display_name'=>'save draft sign conveyance agreement',
                'description'=>'save draft sign conveyance agreement'
            ],             
            [
                'name'=>'conveyance.draft_sign_conveyance_agreement',
                'display_name'=>'draft sign conveyance agreement',
                'description'=>'draft sign conveyance agreement'
            ]   ,
            [
                'name'=>'co.dashboard',
                'display_name'=>'CO Offer Letter Dashboard',
                'description'=>'CO Offer Letter Dashboard'
            ],
            [
                'name'=>'tripartite.index',
                'display_name'=>'display tripartite list of application',
                'description'=>'display tripartite list of application'
            ],
            [
                'name'=>'tripartite.view_application',
                'display_name'=>'view tripartite application submitted by society',
                'description'=>'view tripartite application submitted by society'
            ],
            [
                'name'=>'tripartite.view_society_documents',
                'display_name'=>'tripartite.view_society_documents',
                'description'=>'tripartite.view_society_documents'
            ],
            [
                'name'=>'tripartite.tripartite_agreement',
                'display_name'=>'tripartite.tripartite_agreement',
                'description'=>'tripartite.tripartite_agreement'
            ],
            [
                'name'=>'tripartite.ree_note',
                'display_name'=>'tripartite.ree_note',
                'description'=>'tripartite.ree_note'
            ],
            [
                'name'=>'tripartite.setTripartiteRemark',
                'display_name'=>'tripartite.setTripartiteRemark',
                'description'=>'tripartite.setTripartiteRemark'
            ],
            [
                'name'=>'tripartite.forward_application',
                'display_name'=>'tripartite.forward_application',
                'description'=>'tripartite.forward_application'
            ],
            [
                'name'=>'tripartite.post_forward_application',
                'display_name'=>'tripartite.post_forward_application',
                'description'=>'tripartite.post_forward_application'
            ],
            [
                'name'=>'upload_signed_tripartite_agreement',
                'display_name'=>'upload_signed_tripartite_agreement',
                'description'=>'upload_signed_tripartite_agreement'
            ],
            [
                'name'=>'co_applications.noc',
                'display_name'=>'co_applications.noc',
                'description'=>'co_applications.noc'
            ],
            [
                'name'=>'co.view_noc_application',
                'display_name'=>'co.view_noc_application',
                'description'=>'co.view_noc_application'
            ],
            [
                'name'=>'co.society_noc_documents',
                'display_name'=>'co.society_noc_documents',
                'description'=>'co.society_noc_documents'
            ],
            [
                'name'=>'co.noc_scrutiny_remarks',
                'display_name'=>'co.noc_scrutiny_remarks',
                'description'=>'co.noc_scrutiny_remarks'
            ],
            [
                'name'=>'co.approve_noc',
                'display_name'=>'co.approve_noc',
                'description'=>'co.approve_noc'
            ],
            [
                'name'=>'co.issue_noc_letter_to_ree',
                'display_name'=>'co.issue_noc_letter_to_ree',
                'description'=>'co.issue_noc_letter_to_ree'
            ],
            [
                'name'=>'co.forward_noc_application',
                'display_name'=>'co.forward_noc_application',
                'description'=>'co.forward_noc_application'
            ],
            [
                'name'=>'co.forward_noc_application_data',
                'display_name'=>'co.forward_noc_application_data',
                'description'=>'co.forward_noc_application_data'
            ],
            [
                'name'=>'co_applications.noc_cc',
                'display_name'=>'co_applications.noc_cc',
                'description'=>'co_applications.noc_cc'
            ],
            [
                'name'=>'co.view_noc_cc_application',
                'display_name'=>'co.view_noc_cc_application',
                'description'=>'co.view_noc_cc_application'
            ],
            [
                'name'=>'co.society_noc_cc_documents',
                'display_name'=>'co.society_noc_cc_documents',
                'description'=>'co.society_noc_cc_documents'
            ],
            [
                'name'=>'co.noc_cc_scrutiny_remarks',
                'display_name'=>'co.noc_cc_scrutiny_remarks',
                'description'=>'co.noc_cc_scrutiny_remarks'
            ],
            [
                'name'=>'co.approve_noc_cc',
                'display_name'=>'co.approve_noc_cc',
                'description'=>'co.approve_noc_cc'
            ],
            [
                'name'=>'co.issue_noc_cc_letter_to_ree',
                'display_name'=>'co.issue_noc_cc_letter_to_ree',
                'description'=>'co.issue_noc_cc_letter_to_ree'
            ],
            [
                'name'=>'co.forward_noc_cc_application',
                'display_name'=>'co.forward_noc_cc_application',
                'description'=>'co.forward_noc_cc_application'
            ],
            [
                'name'=>'co.forward_noc_cc_application_data',
                'display_name'=>'co.forward_noc_cc_application_data',
                'description'=>'co.forward_noc_cc_application_data'
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
            ]   
        ];
        $ree_role_id = Role::where('name', 'ree_engineer')->value('id');
        if ($ree_role_id == null) {
            $ree_role_id = Role::insertGetId([
                'name' => 'ree_engineer',
                'redirect_to' => '/ree_applications',
                'dashboard' => '/ree_dashboard',
                'parent_id' => null,
                'display_name' => 'Residential Executive Engineer',
                'description' => 'Login as Residential Executive Engineer',
            ]);
        }

        $co_manager = Role::where('name', '=', 'co_engineer')->first();
        if ($co_manager) {
            $role_id = $co_manager->id;
        } else {
            $role_id = Role::insertGetId([
                'name' => 'co_engineer',
                'redirect_to' => '/co',
                'dashboard' => '/co_dashboard',
                'parent_id' => null,
                'display_name' => 'Co_Engineer',
                'description' => 'Login as CO Engineer',
            ]);
        }

        $co_user = User::where(['email' => 'co@gmail.com'])->first();
        if ($co_user) {
            $user_id = $co_user->id;
        } else {
            $user_id = User::insertGetId([
                'name' => 'CO',
                'email' => 'co@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address' => 'Mumbai',
            ]);

        }
        if (RoleUser::where(['user_id' => $user_id, 'role_id' => $role_id])->first()) {

        } else {
            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }

        $permission_role = [];

        foreach ($permissions as $per) {
            $per1 = Permission::where(['name' => $per['name']])->first();
            if ($per1) {
                $permission_id = $per1->id;
            } else {
                $permission_id = Permission::insertGetId($per);
            }

            if (PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $role_id])->first()) {
            } else {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }
        }
        if (count($permission_role) > 0) {
            PermissionRole::insert($permission_role);
        }

        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        if ($layout_id) {
            if (\App\LayoutUser::where(['user_id' => $user_id, 'layout_id' => $layout_id->id])->first()) {

            } else {
                \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
            }

        }

    }
}
