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
