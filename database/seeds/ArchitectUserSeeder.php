<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class ArchitectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $architect_permissions = [
                [
                    'name' => 'architect_application',
                    'display_name' => 'List architect Application',
                    'description' => 'Listing EE Application'
                ],
                [
                    'name' => 'view_architect_application',
                    'display_name' => 'View Architect',
                    'description' => 'View Architect Application by id'
                ],
                [
                    'name' => 'evaluate_architect_application',
                    'display_name' => 'evaluate_architect_application',
                    'description' => 'evaluate_architect_application'
                ],
                [
                    'name' => 'shortlisted_architect_application',
                    'display_name' => 'shortlisted_architect_application',
                    'description' => 'shortlisted_architect_application'
                ],
                [
                    'name' => 'final_architect_application',
                    'display_name' => 'final_architect_application',
                    'description' => 'final_architect_application'
                ],
                [
                    'name' => 'save_evaluate_marks',
                    'display_name' => 'save_evaluate_marks',
                    'description' => 'save_evaluate_marks'
                ],
                [
                    'name' => 'generate_certificate',
                    'display_name' => 'generate_certificate',
                    'description' => 'generate_certificate'
                ],
                [
                    'name' => 'architect.forward_application',
                    'display_name' => 'forward_application',
                    'description' => 'forward_application'
                ],
                [
                    'name' => 'finalCertificateGenerate',
                    'display_name' => 'finalCertificateGenerate',
                    'description' => 'finalCertificateGenerate'
                ],
                [
                    'name' => 'tempCertificateGenerate',
                    'display_name' => 'tempCertificateGenerate',
                    'description' => 'tempCertificateGenerate'
                ],
                [
                    'name' => 'postfinalCertificateGenerate',
                    'display_name' => 'postfinalCertificateGenerate',
                    'description' => 'postfinalCertificateGenerate'
                ],
                [
                    'name' => 'architect.edit_certificate',
                    'display_name' => 'architect.edit_certificate',
                    'description' => 'architect.edit_certificate'
                ],
                [
                    'name' => 'architect.update_certificate',
                    'display_name' => 'architect.update_certificate',
                    'description' => 'architect.update_certificate'
                ],
                [
                    'name' => 'architect.post_final_signed_certificate',
                    'display_name' => 'architect.post_final_signed_certificate',
                    'description' => 'architect.post_final_signed_certificate'
                ],
                [
                    'name' => 'architect.post_forward_application',
                    'display_name' => 'post_forward_application.architect',
                    'description' => 'post_forward_application.architect'
                ],
                [
                    'name' => 'shortlist_architect_application',
                    'display_name' => 'shortlist_architect_application',
                    'description' => 'shortlist_architect_application'
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
                // [
                //     'name' => 'architect_layout_get_scrtiny',
                //     'display_name' => 'architect_layout_get_scrtiny',
                //     'description' => 'architect_layout_get_scrtiny',
                // ],
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
                    'name'=>'architect_Layout_scrutiny_of_ee_em_lm_ree',
                    'display_name'=>'architect_Layout_scrutiny_of_ee_em_lm_ree',
                    'description'=>'architect_Layout_scrutiny_of_ee_em_lm_ree'
                ],
                [
                    'name'=>'architect_layout_prepare_layout_excel',
                    'display_name'=>'architect_layout_prepare_layout_excel',
                    'description'=>'architect_layout_prepare_layout_excel'

                ],
                [
                    'name'=>'appointing_architect.send_to_candidate',
                    'display_name'=>'appointing_architect.send_to_candidate',
                    'description'=>'appointing_architect.send_to_candidate'

                ],                
                [
                    'name'=>'conveyance.index',
                    'display_name'=>'conveyance Application',
                    'description'=>'conveyance Application'
                ],               
                [
                    'name'=>'conveyance.view_application',
                    'display_name'=>'conveyance Application',
                    'description'=>'conveyance Application'
                ],                
                [
                    'name'=>'conveyance.architect_scrutiny_remark',
                    'display_name'=>'architect scrutiny remark',
                    'description'=>'architect scrutiny remark'
                ],                
                [
                    'name'=>'conveyance.save_architect_scrutiny_remark',
                    'display_name'=>'save architect scrutiny remark',
                    'description'=>'save architect scrutiny remark'
                ],                
                [
                    'name'=>'conveyance.forward_application_sc',
                    'display_name'=>'forward application',
                    'description'=>'forward application'
                ],                
                [
                    'name'=>'conveyance.save_forward_application',
                    'display_name'=>'save forward application',
                    'description'=>'save forward application'
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
                    'name' => 'renewal.architect_scrutiny',
                    'display_name' => 'renewal architect scrutiny',
                    'description' => 'renewal architect scrutiny',
                ],                
                [
                    'name' => 'renewal.upload_architect_documents',
                    'display_name' => 'renewal upload architect documents',
                    'description' => 'renewal upload architect documents',
                ],                 
                [
                    'name' => 'renewal.delete_architect_documents',
                    'display_name' => 'renewal delete architect documents',
                    'description' => 'renewal delete architect documents',
                ],                
                [
                    'name' => 'renewal.save_architect_scrutiny',
                    'display_name' => 'renewal save architect scrutiny',
                    'description' => 'renewal save architect scrutiny',
                ],                 
                [
                    'name' => 'conveyance.view_documents',
                    'display_name' => 'view society documents',
                    'description' => 'view society documents ',
                ],
                [
                    'name'=>'renewal.view_documents',
                    'display_name'=>'view renewal society documents',
                    'description'=>'view renewal society documents'
                ],
                [
                    'name'=>'architect_layout_dashboard',
                    'display_name'=>'view architect layout dashboard',
                    'description'=>'view architect layout dashboard'
                ]
                
            ];
 
            $delete_permission_id=Permission::where(['name'=>'architect_layout_get_scrtiny'])->first();
        // $architect=Role::where('name', '=', 'architect')->select('id')->first();
        // if(!$architect)
        // {
            //main architect
            if(Role::where(['name'=>'architect'])->first())
            {
                $architect_id=Role::where(['name'=>'architect'])->first();
                $architect_id=$architect_id->id;
            }else
            {
                $architect_id=Role::insertGetId([
                    'name' => 'architect',
                    'redirect_to' => '/architect_application',
                    'dashboard' => '/architect_layout_dashboard',
                    'parent_id' => NULL,
                    'display_name' => 'Head Architect',
                    'description' => 'Main Architect'
                ]);
            }
            if(User::where(['email'=>'sudesh@gmail.com'])->first())
            {
                $architect_user_id=User::where(['email'=>'sudesh@gmail.com'])->first();
                $architect_user_id=$architect_user_id->id;
            }else
            {
                $architect_user_id = User::insertGetId([
                    'name' => 'Sudesh Jadhav',
                    'email' => 'sudesh@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $architect_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '8585868585',
                    'address' => 'Mumbai'
                ]);
            }

            if(!RoleUser::where(['user_id'=>$architect_user_id,'role_id'=>$architect_id])->first())
            {
                $architect_role_user = RoleUser::insert([
                    'user_id' => $architect_user_id,
                    'role_id' => $architect_id,
                    'start_date' => \Carbon\Carbon::now()
                ]);
            }

            $architect_permission_role = [];
            $ee_permission_id="";
            foreach ($architect_permissions as $ee) {
                $permission=Permission::where(['name'=>$ee['name']])->first();
                if($permission)
                {
                    $ee_permission_id = $permission->id;
                }else
                {
                    $ee_permission_id = Permission::insertGetId($ee);
                }
               
                if(PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$architect_id])->first())
                {
                   
                }else
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $architect_id,
                    ];
                }
            }

            if($delete_permission_id)
            {
               // dd($delete_permission_id->id);
                $delete_permission_role=PermissionRole::where(['permission_id'=>$delete_permission_id->id,'role_id'=>$architect_id])->first();
                if($delete_permission_role)
                {
                    $delete_permission_role->where(['permission_id'=>$delete_permission_id->id,'role_id'=>$architect_id])->delete();
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
            }

            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
            $layout_user =  \App\LayoutUser::where('user_id',$architect_user_id)->where('layout_id',$layout_id->id)->first();

            if(!$layout_user){
                \App\LayoutUser::insert(['user_id' => $architect_user_id, 'layout_id' => $layout_id->id]);          
            }              
            //senior architect
            if(Role::where(['name'=>'senior_architect'])->first())
            {
                $senior_architect_id=Role::where(['name'=>'senior_architect'])->first();
                $senior_architect_id=$senior_architect_id->id;
            }else
            {
                $senior_architect_id=Role::insertGetId([
                    'name' => 'senior_architect',
                    'redirect_to' => '/architect_application',
                    'dashboard' => '/architect_layout_dashboard',
                    'parent_id' => $architect_id,
                    'display_name' => 'Senior Architect',
                    'description' => 'Senior Architect'
                ]);
            }
            if(User::where(['email'=>'senior_architect@gmail.com'])->first())
            {
                $senior_architect_user_id=User::where(['email'=>'senior_architect@gmail.com'])->first();
                $senior_architect_user_id=$senior_architect_user_id->id;
            }else
            {
                $senior_architect_user_id = User::insertGetId([
                    'name' => 'Senior Architect',
                    'email' => 'senior_architect@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $senior_architect_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '8787878785',
                    'address' => 'Mumbai'
                ]);
            }
            if(!RoleUser::where(['user_id'=>$senior_architect_user_id,'role_id'=>$senior_architect_id])->first())
            {
                $senior_architect_role_user = RoleUser::insert([
                    'user_id' => $senior_architect_user_id,
                    'role_id' => $senior_architect_id,
                    'start_date' => \Carbon\Carbon::now()
                ]);
            }

            $architect_permission_role = [];
            foreach ($architect_permissions as $ee) {
                $permission=Permission::where(['name'=>$ee['name']])->first();
                if($permission)
                {
                    $ee_permission_id = $permission->id;
                }else
                {
                    $ee_permission_id = Permission::insertGetId($ee);
                }
                if(PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$senior_architect_id])->first())
                {
                    
                }else
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $senior_architect_id,
                    ];
                }
            }

            if($delete_permission_id)
            {
               // dd($delete_permission_id->id);
                $delete_permission_role=PermissionRole::where(['permission_id'=>$delete_permission_id->id,'role_id'=>$senior_architect_id])->first();
                if($delete_permission_role)
                {
                    $delete_permission_role->where(['permission_id'=>$delete_permission_id->id,'role_id'=>$senior_architect_id])->delete();
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
            }

            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
            $layout_user =  \App\LayoutUser::where('user_id',$senior_architect_user_id)->where('layout_id',$layout_id->id)->first();

            if(!$layout_user){
                \App\LayoutUser::insert(['user_id' => $senior_architect_user_id, 'layout_id' => $layout_id->id]);          
            }            
            
            //junior architect
            if(Role::where(['name'=>'junior_architect'])->first())
            {
                $junior_architect_id=Role::where(['name'=>'junior_architect'])->first();
                $junior_architect_id=$junior_architect_id->id;
            }else
            {
                $junior_architect_id=Role::insertGetId([
                    'name' => 'junior_architect',
                    'redirect_to' => '/architect_application',
                    'dashboard' => '/architect_layout_dashboard',
                    'parent_id' => $senior_architect_id,
                    'display_name' => 'Junior Architect',
                    'description' => 'Junior Architect'
                ]);
            }

            if(User::where(['email'=>'junior_architect@gmail.com'])->first())
            {
                $junior_architect_user_id=User::where(['email'=>'junior_architect@gmail.com'])->first();
                $junior_architect_user_id=$junior_architect_user_id->id;
            }else
            {
                $junior_architect_user_id = User::insertGetId([
                    'name' => 'Junior Architect',
                    'email' => 'junior_architect@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $junior_architect_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '9696565856',
                    'address' => 'Mumbai'
                ]);
            }
            if(!RoleUser::where(['user_id'=>$junior_architect_user_id,'role_id'=>$junior_architect_id])->first())
            {
                $junior_architect_role_user = RoleUser::insert([
                    'user_id' => $junior_architect_user_id,
                    'role_id' => $junior_architect_id,
                    'start_date' => \Carbon\Carbon::now()
                ]);
            }
            
            $architect_permissions[]=[
                'name'=>'architect_layout_detail.add',
                'display_name'=>'architect_layout_detail.add',
                'description'=>'architect_layout_detail.add'
            ];
            $architect_permissions[]=[
                'name'=>'architect_layout.add',
                'display_name'=>'architect_layout.add',
                'description'=>'architect_layout.add'
            ];
            $architect_permissions[]=[
                'name'=>'uploadLatestLayoutAjax',
                'display_name'=>'uploadLatestLayoutAjax',
                'description'=>'uploadLatestLayoutAjax'
            ];
            $architect_permissions[]=[
                'name'=>'architect_layout.store',
                'display_name'=>'architect_layout.store',
                'description'=>'architect_layout.store'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail.edit',
                'display_name'=>'architect_layout_detail.edit',
                'description'=>'architect_layout_detail.edit'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail.edit',
                'display_name'=>'architect_layout_detail.edit',
                'description'=>'architect_layout_detail.edit'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.index',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.index',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.index'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.create',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.create',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.create'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.store',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.store',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.store'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.edit',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.edit',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.edit'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.view',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.view',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.view'
            ];
            $architect_permissions[]= [
                'name'=>'view_court_case_or_dispute_on_land',
                'display_name'=>'view_court_case_or_dispute_on_land',
                'description'=>'view_court_case_or_dispute_on_land'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.update',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.update',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.update'
            ];
            
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_court_case_or_dispute_on_land.destroy',
                'display_name'=>'architect_layout_detail_court_case_or_dispute_on_land.destroy',
                'description'=>'architect_layout_detail_court_case_or_dispute_on_land.destroy'
            ]; 
            $architect_permissions[]= [
                'name'=>'view_court_case_or_dispute_on_land',
                'display_name'=>'view_court_case_or_dispute_on_land',
                'description'=>'view_court_case_or_dispute_on_land'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_post_land_report',
                'display_name'=>'architect_layout_detail_post_land_report',
                'description'=>'architect_layout_detail_post_land_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_delete_ree_report',
                'display_name'=>'architect_layout_detail_delete_ree_report',
                'description'=>'architect_layout_detail_delete_ree_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_post_ree_report',
                'display_name'=>'architect_layout_detail_post_ree_report',
                'description'=>'architect_layout_detail_post_ree_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_delete_em_report',
                'display_name'=>'architect_layout_detail_delete_em_report',
                'description'=>'architect_layout_detail_delete_em_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_post_em_report',
                'display_name'=>'architect_layout_detail_post_em_report',
                'description'=>'architect_layout_detail_post_em_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_delete_ee_report',
                'display_name'=>'architect_layout_detail_delete_ee_report',
                'description'=>'architect_layout_detail_delete_ee_report'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_post_ee_report',
                'display_name'=>'architect_layout_detail_post_ee_report',
                'description'=>'architect_layout_detail_post_ee_report'
            ];
            $architect_permissions[]= [
                'name'=>'post_architect_detail_dp_crz_remark_add',
                'display_name'=>'post_architect_detail_dp_crz_remark_add',
                'description'=>'post_architect_detail_dp_crz_remark_add'
            ];
            $architect_permissions[]= [
                'name'=>'add_architect_detail_dp_crz_remark_add',
                'display_name'=>'add_architect_detail_dp_crz_remark_add',
                'description'=>'add_architect_detail_dp_crz_remark_add'
            ];
            $architect_permissions[]= [
                'name'=>'delete_prc_detail',
                'display_name'=>'delete_prc_detail',
                'description'=>'delete_prc_detail'
            ];
            $architect_permissions[]= [
                'name'=>'post_prc_detail',
                'display_name'=>'post_prc_detail',
                'description'=>'post_prc_detail'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_prc_detail',
                'display_name'=>'architect_layout_detail_prc_detail',
                'description'=>'architect_layout_detail_prc_detail'
            ];
            $architect_permissions[]= [
                'name'=>'delete_cts_detail',
                'display_name'=>'delete_cts_detail',
                'description'=>'delete_cts_detail'
            ];
            $architect_permissions[]= [
                'name'=>'post_cts_detail',
                'display_name'=>'post_cts_detail',
                'description'=>'post_cts_detail'
            ];
            $architect_permissions[]= [
                'name'=>'architect_layout_detail_cts_plan',
                'display_name'=>'architect_layout_detail_cts_plan',
                'description'=>'architect_layout_detail_cts_plan'
            ];        
            
            $architect_permissions[]=[
                'name'=>'uploadLayoutandExcelAjax',
                'display_name'=>'uploadLayoutandExcelAjax',
                'description'=>'uploadLayoutandExcelAjax'
            ];            

            $architect_permissions[]=[
                'name'=>'conveyance.index',
                'display_name'=>'conveyance Application',
                'description'=>'conveyance Application'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.view_application',
                'display_name'=>'conveyance Application',
                'description'=>'conveyance Application'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.architect_scrutiny_remark',
                'display_name'=>'architect scrutiny remark',
                'description'=>'architect scrutiny remark'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.save_architect_scrutiny_remark',
                'display_name'=>'save architect scrutiny remark',
                'description'=>'save architect scrutiny remark'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.forward_application_sc',
                'display_name'=>'forward application',
                'description'=>'forward application'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.save_forward_application',
                'display_name'=>'save forward application',
                'description'=>'save forward application'
            ];           
            $architect_permissions[]=[
                'name'=>'renewal.index',
                'display_name'=>'renewal index',
                'description'=>'renewal index'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.view_application',
                'display_name'=>'view application',
                'description'=>'view application'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.renewal_forward_application',
                'display_name'=>'renewal forward application',
                'description'=>'renewal forward application'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.save_forward_application_renewal',
                'display_name'=>'save forward application renewal',
                'description'=>'save forward application renewal'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.architect_scrutiny',
                'display_name'=>'renewal architect scrutiny',
                'description'=>'renewal architect scrutiny'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.upload_architect_documents',
                'display_name'=>'renewal upload architect documents',
                'description'=>'renewal upload architect documents'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.delete_architect_documents',
                'display_name'=>'renewal delete architect documents',
                'description'=>'renewal delete architect documents'
            ];            
            $architect_permissions[]=[
                'name'=>'renewal.save_architect_scrutiny',
                'display_name'=>'renewal save architect scrutiny',
                'description'=>'renewal save architect scrutiny'
            ];            
            $architect_permissions[]=[
                'name'=>'conveyance.view_documents',
                'display_name'=>'view society documents',
                'description'=>'view society documents'
            ];
            $architect_permissions[]= [
                'name'=>'renewal.view_documents',
                'display_name'=>'view renewal society documents',
                'description'=>'view renewal society documents'
            ];             
            
            //$architect_permission_role = [];
            foreach ($architect_permissions as $ee) {
                $permission=Permission::where(['name'=>$ee['name']])->first();
                if($permission)
                {
                    $ee_permission_id = $permission->id;
                }else
                {
                    $ee_permission_id = Permission::insertGetId($ee);
                }
                if(PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$junior_architect_id])->first())
                {
                    //dd('ok');
                }else
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $junior_architect_id,
                    ];
                    PermissionRole::insert([
                        'permission_id' => $ee_permission_id,
                        'role_id' => $junior_architect_id,
                    ]);
                }
            }

            if($delete_permission_id)
            {
               // dd($delete_permission_id->id);
                $delete_permission_role=PermissionRole::where(['permission_id'=>$delete_permission_id->id,'role_id'=>$junior_architect_id])->first();
                if($delete_permission_role)
                {
                    $delete_permission_role->where(['permission_id'=>$delete_permission_id->id,'role_id'=>$junior_architect_id])->delete();
                }
            }
            if(count($architect_permission_role)>0)
            {
               // dd($architect_permission_role);
                //PermissionRole::insert($architect_permission_role);
            }

            $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
            $layout_user =  \App\LayoutUser::where('user_id',$junior_architect_user_id)->where('layout_id',$layout_id->id)->first();

            if(!$layout_user){
                \App\LayoutUser::insert(['user_id' => $junior_architect_user_id, 'layout_id' => $layout_id->id]);          
            } 
            
            //set reverted roles
            $architect_head_role=Role::where(['name'=>config('commanConfig.architect')])->where('child_id', '=', NULL)->first();
            if($architect_head_role)
            {
                $sr_architect=Role::where(['name'=>config('commanConfig.senior_architect')])->first();
                if($sr_architect)
                {
                    $architect_head_role->child_id=json_encode(array($sr_architect->id));
                    $architect_head_role->save();
                }
            }

            $architect_sr_role=Role::where(['name'=>config('commanConfig.senior_architect')])->where('child_id', '=', NULL)->first();
            if($architect_sr_role)
            {
                $jr_architect=Role::where(['name'=>config('commanConfig.junior_architect')])->first();
                if($jr_architect)
                {
                    $architect_sr_role->child_id=json_encode(array($jr_architect->id));
                    $architect_sr_role->save();
                }
            }


            //dd('ok');
        //}
    }
}
