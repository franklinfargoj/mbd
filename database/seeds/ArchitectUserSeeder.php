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
                    'name' => 'forward_application',
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
                    'name' => 'finalCertificateGenerate',
                    'display_name' => 'finalCertificateGenerate',
                    'description' => 'finalCertificateGenerate'
                ]
            ];
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
               
                if(!PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$architect_id])->first())
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $architect_id,
                    ];
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
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
                if(!PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$senior_architect_id])->first())
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $senior_architect_id,
                    ];
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
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
                if(!PermissionRole::where(['permission_id'=>$ee_permission_id,'role_id'=>$junior_architect_id])->first())
                {
                    $architect_permission_role[] = [
                        'permission_id' => $ee_permission_id,
                        'role_id' => $junior_architect_id,
                    ];
                }
            }
            if(count($architect_permission_role)>0)
            {
                PermissionRole::insert($architect_permission_role);
            }

            //dd('ok');
        //}
    }
}
