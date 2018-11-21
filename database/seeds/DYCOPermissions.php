<?php

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Database\Seeder;

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
                'name' => 'conveyance.index',
                'display_name' => 'conveyance',
                'description' => 'conveyance',
            ],
            [
                'name' => 'conveyance.checklist',
                'display_name' => 'checklist',
                'description' => 'checklist',
            ],
            [
                'name' => 'conveyance.view_application',
                'display_name' => 'conveyance application',
                'description' => 'conveyance application',
            ],
            [
                'name' => 'dyco.storeChecklistData',
                'display_name' => 'store Checklist Data',
                'description' => 'store Checklist Data',
            ],
            [
                'name' => 'dyco.uploadDycoNote',
                'display_name' => 'upload Dyco Note',
                'description' => 'upload Dyco Note',
            ],
            [
                'name' => 'dyco.forward_application',
                'display_name' => 'forward application',
                'description' => 'forward application',
            ],
            [
                'name' => 'conveyance.sale_lease_agreement',
                'display_name' => 'sale lease agreement',
                'description' => 'sale lease agreement',
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
                'name' => 'dyco.conveyance_noc',
                'display_name' => 'conveyance noc',
                'description' => 'conveyance noc',
            ],
            [
                'name' => 'dyco.save_agreement',
                'display_name' => 'save Agreement',
                'description' => 'save Agreement',
            ],
            [
                'name' => 'conveyance.forward_application_sc',
                'display_name' => 'forward application data',
                'description' => 'forward application data',
            ],
            [
                'name' => 'conveyance.view_ee_documents',
                'display_name' => 'view ee documents',
                'description' => 'view ee documents',
            ],
            [
                'name' => 'dyco.save_stamp_sign_agreement',
                'display_name' => 'save stamp sign agreement',
                'description' => 'save stamp sign agreement',
            ],
            [
                'name' => 'dyco.conveyance_noc',
                'display_name' => 'conveyance noc',
                'description' => 'conveyance noc',
            ],
            [
                'name' => 'conveyance.save_agreement_comments',
                'display_name' => 'save agreement comments',
                'description' => 'save agreement comments',
            ],            
            [
                'name' => 'dyco.send_to_society',
                'display_name' => 'send to society',
                'description' => 'send to society',
            ],            
            [
                'name' => 'dyco.save_approved_agreement',
                'display_name' => 'save approved agreement',
                'description' => 'save approved agreement',
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
                'name' => 'renewal.prepare_renewal_agreement',
                'display_name' => 'prepare renewal agreement',
                'description' => 'prepare renewal agreement',
            ],            
            [
                'name' => 'dyco.save_renewal_agreement',
                'display_name' => 'save renewal agreement',
                'description' => 'save renewal agreement',
            ],            
            [
                'name' => 'renewal.approve_renewal_agreement',
                'display_name' => 'approve renewal agreement',
                'description' => 'approve renewal agreement',
            ],
            [
                'name' => 'dyco.save_approve_renewal_agreement',
                'display_name' => 'save approve renewal agreement',
                'description' => 'save approve renewal agreement',
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
                'name'=>'get_sf_applications.index',
                'display_name'=>'Display list of society formation application',
                'description'=>'Display list of society formation application'
            ]           

            ],            
            [
                'name' => 'renewal.ee_scrutiny',
                'display_name' => 'renewal ee scrutiny',
                'description' => 'renewal ee scrutiny',
            ],            
            [
                'name' => 'renewal.architect_scrutiny',
                'display_name' => 'renewal architect scrutiny',
                'description' => 'renewal architect scrutiny',
            ],             
        ];

        //dycdo

        $role = Role::where('name', '=', 'dycdo_engineer')->first();

        if ($role) {
            $role_id=$role->id;
        }else
        {
            $role_id = Role::insertGetId([
                'name' => 'dycdo_engineer',
                'redirect_to' => '/conveyance',
                'parent_id' => null,
                'display_name' => 'dycdo engineer',
                'description' => 'Login as dycdo Engineer',
            ]);
        }

        $user = User::where('email', '=', 'dycdo@gmail.com')->first();

        if ($user) {
            $user_id=$user->id;
        }else
        {
            $user_id = User::insertGetId([
                'name' => 'dycdo user',
                'email' => 'dycdo@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address' => 'Mumbai',
            ]);
        }
        if(RoleUser::where(['user_id' => $user_id,'role_id' => $role_id])->first())
        {

        }else
        {
            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }
        
        

        foreach ($permissions as $per) {
            $permission_role = [];
            $dyco_permission = Permission::where('name', '=', $per['name'])->first();

            if ($dyco_permission) {
                $permission_id = $dyco_permission->id;
            } else {
                $permission_id = Permission::insertGetId($per);
            }

            $permission_roles1 = PermissionRole::where(['permission_id'=> $permission_id,'role_id'=> $role_id])->first();
            
            if ($permission_roles1) {
                
            }else
            {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
                PermissionRole::insert($permission_role);
            }
            
            
        }
        //dd($permission_role);
        // if ($permission_role > 0) {

            
        // }
        //dd('ok');
        
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user = \App\LayoutUser::where('user_id', $user_id)->where('layout_id', $layout_id->id)->first();

        if ($layout_user) {
            
        }else
        {
            \App\LayoutUser::insert(['user_id' => $user_id, 'layout_id' => $layout_id->id]);
        }

        //dyco

        $role = Role::where('name', '=', 'dyco_engineer')->first();

        if ($role) {
            $role_id1=$role->id;
        }else
        {
            $role_id1 = Role::insertGetId([
                'name' => 'dyco_engineer',
                'redirect_to' => '/conveyance',
                'parent_id' => null,
                'display_name' => 'dyco engineer',
                'description' => 'Login as dyco Engineer',
            ]);
        }

        $user = User::where('email', '=', 'dyco@gmail.com')->first();

        if ($user) {

            $user_id1=$user->id;
        }else
        {

            $user_id1 = User::insertGetId([
                'name' => 'dyco user',
                'email' => 'dyco@gmail.com',
                'password' => bcrypt('1234'),
                'role_id' => $role_id1,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '9765238678',
                'address' => 'Mumbai',
            ]);
            $role_user = RoleUser::insert([
                'user_id' => $user_id1,
                'role_id' => $role_id1,
                'start_date' => \Carbon\Carbon::now(),
            ]);
        }
        
        
        foreach ($permissions as $per) {
            $permission_role = [];
            $dyco_permission = Permission::where('name', '=', $per['name'])->first();
            if ($dyco_permission) {
                $permission_id = $dyco_permission->id;
                
            } else {
                $permission_id = Permission::insertGetId($per);
            }

            $permission_roles = PermissionRole::where('permission_id', $permission_id)->where('role_id', $role_id1)->first();

            if ($permission_roles) {
                
            }else
            {
                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id1,
                ];
                PermissionRole::insert($permission_role);
            }
        }
        
        // if ($permission_role > 0) {
            
            
            
        // }
       
        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user = \App\LayoutUser::where('user_id', $user_id1)->where('layout_id', $layout_id->id)->first();

        if ($layout_user) {
            
        }else
        {
            \App\LayoutUser::insert(['user_id' => $user_id1, 'layout_id' => $layout_id->id]);
        }
    }
}
