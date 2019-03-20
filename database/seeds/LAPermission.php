<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class LAPermission extends Seeder
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
                'name'         => 'la.index',
                'display_name' => 'index',
                'description'  => 'index'
            ],
            [
                'name'         => 'la.conveyance_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
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
                'name' => 'conveyance.index',
                'display_name' => 'List of Conveyance Applications',
                'description' => 'List of Conveyance Applications',
            ],
            [
                'name' => 'conveyance.view_documents',
                'display_name' => 'View Documents',
                'description' => 'View Documents Submitted'
            ],
            [
                'name' => 'em.save_conveyance_no_dues_certificate',
                'display_name' => 'Save no dues certificate',
                'description' => 'Saves no dues certificate'
            ],
            [
                'name'         => 'conveyance.view_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
            ],
            [
                'name' => 'conveyance.forward_application_sc',
                'display_name' => 'Forward Application',
                'description' => 'Forwards conveyance Application'
            ],
            [
                'name' => 'conveyance.save_forward_application',
                'display_name' => 'Saves Forward Application',
                'description' => 'Saves Forwards conveyance Application'
            ],
            [
                'name'         => 'sc_upload_docs',
                'display_name' => 'Upload Documents',
                'description'  => 'Shows society conveyance docuemnts list'
            ],
            [
                'name'         => 'conveyance.la_agreement_riders',
                'display_name' => 'Sale & Lease deed agreements',
                'description'  => 'Sale & Lease deed agreements'
            ],
            [
                'name'         => 'conveyance.upload_la_agreement_riders',
                'display_name' => 'Uploads Sale & Lease deed agreements riders',
                'description'  => 'Uploads Sale & Lease deed agreements riders'
            ],
            [
                'name'=>'renewal.index',
                'display_name'=>'List of Applications for Renewal',
                'description'=>'Shows Lists of Applications for Renewal'
            ],
            [
                'name'=>'renewal.show',
                'display_name'=>'View Application',
                'description'=>'View Application in pdf format.'
            ],
            [
                'name'=>'renewal.view_application',
                'display_name'=>'View Application',
                'description'=>'View Application in pdf format.'
            ],
            [
                'name'=>'renewal.view_documents',
                'display_name'=>'View Society Documents',
                'description'=>'View Society Documents.'
            ],
            [
                'name'=>'renewal.la_agreement_riders',
                'display_name'=>'Agreement',
                'description'=>'Agreement riders.'
            ],
            [
                'name'=>'renewal.upload_la_agreement_riders',
                'display_name'=>'Uploads Agreement and riders',
                'description'=>'Uploads Agreement and riders.'
            ],
            [
                'name'=>'renewal.renewal_forward_application',
                'display_name'=>'Forward Application',
                'description'=>'Forwards Application'
            ],
            [
                'name'=>'renewal.save_forward_application_renewal',
                'display_name'=>'Forward Application',
                'description'=>'Forwards Application'
            ], 
            [
                'name'=>'conveyance.checklist',
                'display_name'=>'checklist',
                'description'=>'checklist'
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
            ],
            [
                'name' => 'conveyance.view_ee_documents',
                'display_name' => 'view ee documents',
                'description' => 'view ee documents',
            ], 
            [
                'name' => 'conveyance.architect_scrutiny_remark',
                'display_name' => 'architect scrutiny remark',
                'description' => 'architect scrutiny remark',
            ],
            [
                'name'=>'em.scrutiny_remark',
                'display_name'=>'EM scrutiny remark',
                'description'=>'EM scrutiny remark'
            ], 
            [
                'name'=>'conveyance.dashboard',
                'display_name'=>'conveyance dashboard',
                'description'=>'conveyance dashboard'
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
                'name'=>'dashboard.ajax.conveyance',
                'display_name'=>'conveyance dashboard ajax',
                'description'=>'conveyance dashboard ajax'
            ],
            [
                'name'=>'estate-conveyance.period_wise_pendency_report',
                'display_name'=>'estate-conveyance.period_wise_pendency_report',
                'description'=>'estate-conveyance.period_wise_pendency_report'
            ],
            [
                'name'=>'estate_conveyance_pending_reports',
                'display_name'=>'redevelopement_pending_reports',
                'description'=>'redevelopement_pending_reports'
            ],
        ];

        $role_id = Role::where('name', '=', 'la_engineer')->first();

        if ($role_id) {
            $role_id=$role_id->id; 
        }else   
        {
            $role_id = Role::insertGetId([
                'name'         => 'la_engineer',
                'redirect_to'  => '/la',
                'dashboard'  => '/sc_dashboard',
                'parent_id'    => NULL,
                'display_name' => 'la engineer',
                'description'  => 'Login as la Engineer'
            ]);
        }

        $user_id = User::where('email', '=', 'la@gmail.com')->first();

        if ($user_id){
            $user_id=$user_id->id;
        }else{

            $user_id = User::insertGetId([
                'name'      => 'LA user',
                'email'     => 'la@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);
        }
        if(RoleUser::where(['user_id'=> $user_id,'role_id' => $role_id])->first())
        {
        }else
        {
            $role_user = RoleUser::insert([
                'user_id'    => $user_id,
                'role_id'    => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }
        
        $permission_role = [];

        foreach ($permissions as $per) {
            $permission_id = Permission::where('name', '=', $per['name'])->first();
            if ($permission_id){
                $permission_id=$permission_id->id;
            }else{
                $permission_id = Permission::insertGetId($per);
            }

            $permission_roles = PermissionRole::where('permission_id',$permission_id)->where('role_id',$role_id)->first();
            
            if($permission_roles) {

            }else{
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id'       => $role_id,
                ];
            }
        }
        if(count($permission_role) > 0) {

            PermissionRole::insert($permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user =  \App\LayoutUser::where('user_id',$user_id)->where('layout_id',$layout_id->id)->first();
        if($layout_user){}
        else {
            \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
        }

        //change LA redirection
        if ($role_id){

            Role::where('id',$role_id)->update(['redirect_to' => '/conveyance','dashboard' => '/sc_dashboard']);
        }
    }
}
