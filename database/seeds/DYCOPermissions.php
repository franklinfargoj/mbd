<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;


class DYCOPermissions extends Seeder
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
                'name'         => 'conveyance.index',
                'display_name' => 'conveyance',
                'description'  => 'conveyance'
            ],
            [
                'name'         => 'dyco.checklist',
                'display_name' => 'checklist',
                'description'  => 'checklist'
            ],            
            [
                'name'         => 'conveyance.view_application',
                'display_name' => 'conveyance application',
                'description'  => 'conveyance application'
            ],             
            [
                'name'         => 'dyco.storeChecklistData',
                'display_name' => 'store Checklist Data',
                'description'  => 'store Checklist Data'
            ],            
            [
                'name'         => 'dyco.uploadDycoNote',
                'display_name' => 'upload Dyco Note',
                'description'  => 'upload Dyco Note'
            ],            
            [
                'name'         => 'dyco.forward_application',
                'display_name' => 'forward application',
                'description'  => 'forward application'
            ],             
            [
                'name'         => 'dyco.sale_lease_agreement',
                'display_name' => 'sale lease agreement',
                'description'  => 'sale lease agreement'
            ],            
            [
                'name'         => 'dyco.approved_sale_lease_agreement',
                'display_name' => 'approved sale lease agreement',
                'description'  => 'approved sale lease agreement'
            ],            
            [
                'name'         => 'dyco.stamp_duty_agreement',
                'display_name' => 'stamp duty agreement',
                'description'  => 'stamp duty agreement'
            ],            
            [
                'name'         => 'dyco.stamp_signed_duty_agreement',
                'display_name' => 'stamp signed duty agreement',
                'description'  => 'stamp signed duty agreement'
            ],            
            [
                'name'         => 'dyco.register_sale_lease_agreement',
                'display_name' => 'register sale lease agreement',
                'description'  => 'register sale lease agreement'
            ],            
            [
                'name'         => 'dyco.conveyance_noc',
                'display_name' => 'conveyance noc',
                'description'  => 'conveyance noc'
            ],            
            [
                'name'         => 'dyco.save_agreement',
                'display_name' => 'save Agreement',
                'description'  => 'save Agreement'
            ],             
            [
                'name'         => 'dyco.forward_application_data',
                'display_name' => 'forward application data',
                'description'  => 'forward application data'
            ],            
            [
                'name'         => 'conveyance.view_ee_documents',
                'display_name' => 'view ee documents',
                'description'  => 'view ee documents'
            ],            
            [
                'name'         => 'dyco.save_stamp_sign_agreement',
                'display_name' => 'save stamp sign agreement',
                'description'  => 'save stamp sign agreement'
            ],            
            [
                'name'         => 'dyco.conveyance_noc',
                'display_name' => 'conveyance noc',
                'description'  => 'conveyance noc'
            ],            
            [
                'name'         => 'conveyance.save_agreement_comments',
                'display_name' => 'save agreement comments',
                'description'  => 'save agreement comments'
            ],                                                                  
        ];

        //dycdo 
        
        $role_id = Role::where('name', '=', 'dycdo_engineer')->value('id');

        if (!$role_id) {
            $role_id = Role::insertGetId([
                'name'         => 'dycdo_engineer',
                'redirect_to'  => '/conveyance',
                'parent_id'    => NULL,
                'display_name' => 'dycdo engineer',
                'description'  => 'Login as dycdo Engineer'
            ]);
        } 

        $user_id = User::where('email', '=', 'dycdo@gmail.com')->value('id'); 

        if (!$user_id){

            $user_id = User::insertGetId([
                'name'      => 'dycdo user',
                'email'     => 'dycdo@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);
            $role_user = RoleUser::insert([
                'user_id'    => $user_id,
                'role_id'    => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);            
        }
        $permission_role = [];    

        foreach ($permissions as $per) {
            $permission_id = Permission::where('name', '=', $per['name'])->value('id');

            if (!$permission_id){

                $permission_id = Permission::insertGetId($per);

            }    

                $permission_roles1 = PermissionRole::where('permission_id',$permission_id)->where('role_id',$role_id)->first();

                if(count($permission_roles1) == 0){
	                $permission_role[] = [
	                    'permission_id' => $permission_id,
	                    'role_id'       => $role_id,
	                ];                	
                }
        }    
        if($permission_role > 0) {

            PermissionRole::insert($permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user =  \App\LayoutUser::where('user_id',$user_id)->where('layout_id',$layout_id->id)->first();
        
        if(!$layout_user){
        	\App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);          
        }          

        //dyco 

        $role_id1 = Role::where('name', '=', 'dyco_engineer')->value('id');

        if (!$role_id1) {
            $role_id1 = Role::insertGetId([
                'name'         => 'dyco_engineer',
                'redirect_to'  => '/conveyance',
                'parent_id'    => NULL,
                'display_name' => 'dyco engineer',
                'description'  => 'Login as dyco Engineer'
            ]);
        } 

        $user_id1 = User::where('email', '=', 'dyco@gmail.com')->value('id'); 

        if (!$user_id1){

            $user_id1 = User::insertGetId([
                'name'      => 'dyco user',
                'email'     => 'dyco@gmail.com',
                'password'  => bcrypt('1234'),
                'role_id'   => $role_id1,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address'   => 'Mumbai'
            ]);
            $role_user = RoleUser::insert([
                'user_id'    => $user_id1,
                'role_id'    => $role_id1,
                'start_date' => \Carbon\Carbon::now()
            ]);            
        }
        $permission_role = [];    

        foreach ($permissions as $per) {
            $permission_id = Permission::where('name', '=', $per['name'])->value('id');
            if (!$permission_id){

                $permission_id = Permission::insertGetId($per);
            }    

                $permission_roles = PermissionRole::where('permission_id',$permission_id)->where('role_id',$role_id1)->first();
                
                
                if(count($permission_roles) == 0) {
	                $permission_role[] = [
	                    'permission_id' => $permission_id,
	                    'role_id'       => $role_id1,
	                ];
                }
        }    
        if($permission_role > 0) {

            PermissionRole::insert($permission_role);
        }
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user =  \App\LayoutUser::where('user_id',$user_id1)->where('layout_id',$layout_id->id)->first();
        
        if(!$layout_user){
        	\App\LayoutUser::insert(['user_id' => $user_id1, 'layout_id' => $layout_id->id]);          
        }                  
    }
}
