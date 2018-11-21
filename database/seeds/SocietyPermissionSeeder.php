<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class SocietyPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $society = Role::where('name', '=', 'society')->select('id')->get();

        $permissions = [
                [
                    'name'         => 'society_offer_letter.index',
                    'display_name' => 'index',
                    'description'  => 'index'
                ],            
                [
                    'name'         => 'society_offer_letter.store',
                    'display_name' => 'society_offer_letter_registration',
                    'description'  => 'store society registration details for offer letter'
                ],            
                [
                    'name'         => 'society_offer_letter.create',
                    'display_name' => 'display_society_offer_letter_registration',
                    'description'  => 'displays society registration form for offer letter'
                ],            
                [
                    'name'         => 'society_offer_letter_forgot_password',
                    'display_name' => 'society_forgot_password',
                    'description'  => 'society forgot password functionality'
                ],
                [
                    'name'         => 'society_offer_letter_dashboard',
                    'display_name' => 'society_offer_letter_application_listing',
                    'description'  => 'society offer letter application listing'
                ],            
                [
                    'name'         => 'offer_letter_application_self',
                    'display_name' => 'offer_letter_application_self',
                    'description'  => 'displays offer letter application form for self redevelopment'
                ],            
                [
                    'name'         => 'save_offer_letter_application_self',
                    'display_name' => 'save_offer_letter_application_self',
                    'description'  => 'saves offer letter application form for self redevelopment'
                ],
                [
                    'name'         => 'offer_letter_application_dev',
                    'display_name' => 'offer_letter_application_dev',
                    'description'  => 'displays offer letter application form for redevelopment through developer'
                ],
                [
                    'name'         => 'save_offer_letter_application_dev',
                    'display_name' => 'save_offer_letter_application_dev',
                    'description'  => 'saves offer letter application form for redevelopment through developer'
                ],
                [
                    'name'         => 'documents_upload',
                    'display_name' => 'documents_upload',
                    'description'  => 'displays document names listings & upload documents form'
                ],
                [
                    'name'         => 'uploaded_documents',
                    'display_name' => 'uploaded_documents',
                    'description'  => 'displays download and upload option for submitted offer letter application form'
                ],
                [
                    'name'         => 'delete_uploaded_documents',
                    'display_name' => 'delete_uploaded_documents',
                    'description'  => 'deletes documents for submitted offer letter application form'
                ],
                [
                    'name'         => 'add_documents_comment',
                    'display_name' => 'add_documents_comment',
                    'description'  => 'add comments for uploaded documents for submitted offer letter application form'
                ],
                [
                    'name'         => 'society_offer_letter_download',
                    'display_name' => 'society_offer_letter_download',
                    'description'  => 'displays submitted society offer letter application'
                ],
                [
                    'name'         => 'upload_society_offer_letter',
                    'display_name' => 'upload_society_offer_letter',
                    'description'  => 'upload submitted society offer letter application after signature'
                ],
                [
                    'name'         => 'society_detail.UserAuthentication',
                    'display_name' => 'society_detail.UserAuthentication',
                    'description'  => 'authenticates society offer letter users'
                ],
                [
                    'name'         => 'documents_uploaded',
                    'display_name' => 'documents_uploaded',
                    'description'  => 'view uploaded society documents'
                ],                
                [
                    'name'         => 'add_documents_comment',
                    'display_name' => 'add_documents_comment',
                    'description'  => 'add documents comment'
                ],                
                [
                    'name'         => 'add_uploaded_documents_remark',
                    'display_name' => 'add_uploaded_documents_remark',
                    'description'  => 'add uploaded documents remark'
                ],
                [
                    'name'         => 'society_offer_letter_application_download',
                    'display_name' => 'society_offer_letter_application_download',
                    'description'  => 'downloads society offer letter application'
                ],
                [
                    'name'         => 'upload_society_offer_letter_application',
                    'display_name' => 'upload_society_offer_letter_application',
                    'description'  => 'uploads society offer letter application'
                ],
                [
                    'name'         => 'society_conveyance.index',
                    'display_name' => 'Society conveyance application listing',
                    'description'  => 'Society conveyance application listing'
                ],
                [
                    'name'         => 'society_conveyance.store',
                    'display_name' => 'Stores society conveyance application data',
                    'description'  => 'Stores society conveyance application data'
                ],
                [
                    'name'         => 'society_conveyance.create',
                    'display_name' => 'Shows society conveyance application form',
                    'description'  => 'Shows society conveyance application form'
                ],
                [
                    'name'         => 'society_conveyance.show',
                    'display_name' => 'Shows society conveyance application form',
                    'description'  => 'Shows society conveyance application form'
                ],
                [
                    'name'         => 'society_conveyance.destroy',
                    'display_name' => 'Deletes society conveyance application',
                    'description'  => 'Deletes society conveyance application'
                ],
                [
                    'name'         => 'society_conveyance.update',
                    'display_name' => 'Updates society conveyance application form data',
                    'description'  => 'Updates society conveyance application form data'
                ],
                [
                    'name'         => 'society_conveyance.edit',
                    'display_name' => 'Shows edit form for society conveyance application',
                    'description'  => 'Shows edit form for society conveyance application'
                ],
                [
                    'name'         => 'show_form_self',
                    'display_name' => 'Shows self redevelopment form',
                    'description'  => 'Shows self redevelopment form'
                ],
                [
                    'name'         => 'show_form_dev',
                    'display_name' => 'Shows redevelopment through developer form',
                    'description'  => 'Shows redevelopment through developer form'
                ],
                [
                    'name'         => 'society_offer_letter_preview',
                    'display_name' => 'Shows preview for society offer letter application form',
                    'description'  => 'Shows preview for society offer letter application form'
                ],
                [
                    'name'         => 'society_offer_letter_edit',
                    'display_name' => 'Shows edit form for society offer letter application',
                    'description'  => 'Shows edit form for society offer letter application'
                ],
                [
                    'name'         => 'society_offer_letter_update',
                    'display_name' => 'Updates society offer letter application form',
                    'description'  => 'Updates society offer letter application form'
                ],
                [
                    'name'         => 'sc_download',
                    'display_name' => 'Downloads template in excel format',
                    'description'  => 'Downloads template in excel format'
                ],
                [
                    'name'         => 'sc_upload_docs',
                    'display_name' => 'Upload Documents',
                    'description'  => 'Shows society conveyance docuemnts list'
                ],
                [
                    'name'         => 'delete_sc_upload_docs',
                    'display_name' => 'Deletes Uploaded Documents',
                    'description'  => 'Deletes Uploaded Documents'
                ],
                [
                    'name'         => 'upload_sc_docs',
                    'display_name' => 'Uploads Documents',
                    'description'  => 'Uploads Documents'
                ],
                [
                    'name'         => 'society_bank_details',
                    'display_name' => 'Submit society bank details',
                    'description'  => 'Submit society bank details'
                ],
                [
                    'name'         => 'sc_form_upload_show',
                    'display_name' => 'Shows Upload Stamped Application Form',
                    'description'  => 'Shows Upload Stamped Application Form'
                ],
                [
                    'name'         => 'sc_form_upload',
                    'display_name' => 'Uploads Stamped Application Form',
                    'description'  => 'Uploads Stamped Application Form'
                ],
                [
                    'name'         => 'sc_form_download',
                    'display_name' => 'Download Application Form',
                    'description'  => 'Download Application Form'
                ],
                [
                    'name' => 'show_sale_lease',
                    'display_name' => 'Sale & Lease deed Agreement',
                    'description' => 'Shows Sale & Lease deed Agreement form'
                ],
                [
                    'name' => 'show_signed_sale_lease',
                    'display_name' => 'Signed Sale & Lease deed Agreement',
                    'description' => 'Shows Signed Sale & Lease deed Agreement form'
                ],
                [
                    'name' => 'upload_sale_lease',
                    'display_name' => 'Saves Sale & Lease deed Agreement',
                    'description' => 'Uploads Shows Sale & Lease deed Agreement form'
                ],
                [
                    'name' => 'upload_signed_sale_lease',
                    'display_name' => 'Saves Signed Sale & Lease deed Agreement',
                    'description' => 'Uploads Signed Sale & Lease deed Agreement'
                ],
                [
                    'name'=>'society_formation.index',
                    'display_name'=>'Display list of society formation',
                    'description' => 'Display list of society formation'
                ],
                [
                    'name'=>'society_formation.create',
                    'display_name'=>'Display form for society formation',
                    'description' => 'Display form for society formation'
                ],
                [
                    'name'         => 'society_renewal.index',
                    'display_name' => 'Applications for Renewal of lease',
                    'description'  => 'Society renewal application listing'
                ],
                [
                    'name'         => 'society_renewal.store',
                    'display_name' => 'Stores society renewal application data',
                    'description'  => 'Stores society renewal application data'
                ],
                [
                    'name'         => 'society_renewal.create',
                    'display_name' => 'Apply for Renewal of Lease',
                    'description'  => 'Shows society renewal application form'
                ],
                [
                    'name'         => 'society_renewal.show',
                    'display_name' => 'View Application',
                    'description'  => 'Shows society renewal application form'
                ],
                [
                    'name'         => 'society_renewal.destroy',
                    'display_name' => 'Deletes society renewal application',
                    'description'  => 'Deletes society renewal application'
                ],
                [
                    'name'         => 'society_renewal.update',
                    'display_name' => 'Updates society renewal application form data',
                    'description'  => 'Updates society renewal application form data'
                ],
                [
                    'name'         => 'society_renewal.edit',
                    'display_name' => 'Edit Application',
                    'description'  => 'Shows edit form for society renewal application'
                ],
                [
                    'name'         => 'sr_download',
                    'display_name' => 'Downloads template in excel format',
                    'description'  => 'Downloads template in excel format'
                ],
                [
                    'name'         => 'sr_upload_docs',
                    'display_name' => 'Upload Documents',
                    'description'  => 'Shows society renewal docuemnts list'
                ],
                [
                    'name'         => 'delete_sr_upload_docs',
                    'display_name' => 'Deletes Uploaded Documents',
                    'description'  => 'Deletes Uploaded Documents'
                ],
                [
                    'name'         => 'upload_sr_docs',
                    'display_name' => 'Uploads Documents',
                    'description'  => 'Uploads Documents'
                ],
                [
                    'name'         => 'sr_form_upload_show',
                    'display_name' => 'Stamped Application Form',
                    'description'  => 'Shows Upload Stamped Application Form'
                ],
                [
                    'name'         => 'sr_form_upload',
                    'display_name' => 'Uploads Stamped Application Form',
                    'description'  => 'Uploads Stamped Application Form'
                ],
                [
                    'name'         => 'sr_form_download',
                    'display_name' => 'Download Application Form',
                    'description'  => 'Download Application Form'
                ],
                [
                    'name'=>'society_formation.store',
                    'display_name'=>'store society formation',
                    'description' => 'store society formation'
                ],
                [
                    'name'=>'society_formation.view_application',
                    'display_name'=>'view_application',
                    'description'=>'view_application'
                ],
                [
                    'name'=>'upload_sf_application_attachment',
                    'display_name'=>'upload document one by one',
                    'description'=>'upload document one by one'
                ],
                [
                    'name'=>'sf_submit_application',
                    'display_name'=>'application submit by society for SF',
                    'description'=>'application submit by society for SF'
                ]
        ];
        
        if(count($society)==0){
            // Society Login
            //dd('if');
            $role_id = Role::insertGetId([
                'name'         => 'society',
                'redirect_to'  => '/society_offer_letter_dashboard',
                'parent_id'    => NULL,
                'display_name' => 'Society Offer Letter',
                'description'  => 'Login as Society'
            ]);

            $permission_role = [];

            foreach($permissions as $per)
            {
                $permission_id = Permission::insertGetId($per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }

            PermissionRole::insert($permission_role); 
        }else
        {

            $permission_role = [];

            foreach($permissions as $per)
            {
                $permission = Permission::where('name', '=', $per['name'])->first();
                if($permission)
                {
                   continue;
                }else
                {
                    //dd($society[0]->id);
                    $permission_id = Permission::insertGetId($per);

                    $permission_role[] = [
                        'permission_id' => $permission_id,
                        'role_id' => $society[0]->id,
                    ];
                }                
            }
            if(count($permission_role)>0)
            {
                PermissionRole::insert($permission_role);
            }
        }        
    }
}
