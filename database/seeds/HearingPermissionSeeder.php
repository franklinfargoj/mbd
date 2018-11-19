<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\RoleUser;
use App\User;
use App\Permission;
use App\PermissionRole;

class HearingPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Role
        // Joint CO
        $joint_co_role_id = Role::where('name', '=', 'Joint CO')->value('id');
        if($joint_co_role_id == NULL)
            $joint_co_role_id = Role::insertGetId([
                'name' => 'Joint CO',
                'parent_id' => NULL,
                'redirect_to' => '/hearing.dashboard',
                'display_name' => 'joint_co',
                'description' => 'Login as Joint CO'
            ]);

        // Joint CO PA
        $joint_co_pa_role_id = Role::where('name','Joint Co PA')->value('id');

        if($joint_co_pa_role_id  == NULL)
            $joint_co_pa_role_id = Role::insertGetId([
                'name' => 'Joint Co PA',
                'parent_id' => $joint_co_role_id,
                'redirect_to' => '/hearing-dashboard',
                'display_name' => 'joint_co_pa',
                'description' => 'Login as Joint CO PA'
            ]);

        // CO
        $co_role_id = Role::where('name','Co')->value('id');

        if($co_role_id == NULL)
            $co_role_id = Role::insertGetId([
                'name' => 'Co',
                'parent_id' => NULL,
                'redirect_to' => '/hearing-dashboard',
                'display_name' => 'co',
                'description' => 'Login as CO'
            ]);

        //CO PA
        $co_pa_role_id =Role::where('name','Co PA')->value('id');

        if($co_pa_role_id == NULL)
            $co_pa_role_id = Role::insertGetId([
                'name' => 'Co PA',
                'parent_id' => $co_role_id,
                'redirect_to' => '/hearing-dashboard',
                'display_name' => 'joint_co_pa',
                'description' => 'Login as Joint CO PA'
            ]);


        // User and Role Mapping
        // Joint CO
        $joint_co_user_id = User::where('email','jointco@gmail.com')->value('id');

        if($joint_co_user_id == NULL){
            $joint_co_user_id = User::insertGetId([
                'name' => 'Joint CO',
                'email' => 'jointco@gmail.com',
                'password' => bcrypt('jointco123'),
                'role_id' => $joint_co_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $joint_co_user_id,
                'role_id' => $joint_co_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }


        // Joint CO Pa
        $joint_co_pa_user_id = User::where('email','jointcopa@gmail.com')->value('id');

        if($joint_co_pa_user_id == NULL){
            $joint_co_pa_user_id = User::insertGetId([
                'name' => 'Joint CO PA',
                'email' => 'jointcopa@gmail.com',
                'password' => bcrypt('jointcopa123'),
                'role_id' => $joint_co_pa_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $joint_co_pa_user_id,
                'role_id' => $joint_co_pa_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        }


        // CO
        $co_user_id = User::where('email','hearingco@gmail.com')->value('id');
        if($co_user_id == NULL){
            $co_user_id = User::insertGetId([
                'name' => 'CO',
                'email' => 'hearingco@gmail.com',
                'password' => bcrypt('co123'),
                'role_id' => $co_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $co_user_id,
                'role_id' => $co_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);
        }

        // CO PA
        $co_pa_user_id = User::where('email','copa@gmail.com')->value('id');
        if($co_pa_user_id == NULL){
            $co_pa_user_id = User::insertGetId([
                'name' => 'CO PA',
                'email' => 'copa@gmail.com',
                'password' => bcrypt('jointcopa123'),
                'role_id' => $co_pa_role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            RoleUser::insert([
                'user_id' => $co_pa_user_id,
                'role_id' => $co_pa_role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

        }

        // Permissions

        // CO_PA & Joint_CO_PA
        $permissions_for_pa = [
            [
                'name' => 'hearing.index',
                'display_name' => 'List Hearing',
                'description' => 'Listing of Hearing'
            ],
            [
                'name' => 'hearing.create',
                'display_name' => 'Create a hearing',
                'description' => 'Creating a new hearing'
            ],
            [
                'name' => 'hearing.edit',
                'display_name' => 'Edit a hearing',
                'description' => 'Edit a hearing'
            ],
            [
                'name' => 'hearing.update',
                'display_name' => 'Update a hearing',
                'description' => 'Updating data of a particular hearing'
            ],
            [
                'name' => 'hearing.destroy',
                'display_name' => 'Delete a hearing',
                'description' => 'Delete a particular hearing'
            ],
            [
                'name' => 'loadDeleteReasonOfHearingUsingAjax',
                'display_name' => 'Delete route from pop up',
                'description' => 'Delete route from pop up'
            ],
            [
                'name' => 'hearing.store',
                'display_name' => 'Store a hearing a data',
                'description' => 'Creating a new hearing'
            ],
            [
                'name' => 'schedule_hearing.add',
                'display_name' => 'Schedule Add',
                'description' => 'Add Schedule'
            ],
            [
                'name' => 'hearing.show',
                'display_name' => 'Show Hearing',
                'description' => 'Display a particular hearing'
            ],
            [
                'name' => 'schedule_hearing.store',
                'display_name' => 'Schedule Hearing Store',
                'description' => 'Store Schedule Hearing data'
            ],
            [
                'name' => 'fix_schedule.add',
                'display_name' => 'Add Pre/Post Schedule data',
                'description' => 'Add Pre/Post Schedule data'
            ],
            [
                'name' => 'fix_schedule.store',
                'display_name' => 'Store Pre/Post Schedule data',
                'description' => 'Store Pre/Post Schedule data'
            ],
            [
                'name' => 'fix_schedule.edit',
                'display_name' => 'Edit Pre/Post Schedule data',
                'description' => 'Edit Pre/Post Schedule data'
            ],
            [
                'name' => 'fix_schedule.update',
                'display_name' => 'Update Pre/Post Schedule data',
                'description' => 'Update Pre/Post Schedule data'
            ],
            [
                'name' => 'upload_case_judgement.add',
                'display_name' => 'Upload Case Judgement data',
                'description' => 'Upload Case Judgement Pre/Post Schedule data'
            ],
            [
                'name' => 'upload_case_judgement.store',
                'display_name' => 'Store Upload Case Judgement data',
                'description' => 'Store Upload Case Judgement data'
            ],
            [
                'name' => 'upload_case_judgement.edit',
                'display_name' => 'Edit Upload Case Judgement data',
                'description' => 'Edit Upload Case Judgement data'
            ],
            [
                'name' => 'upload_case_judgement.update',
                'display_name' => 'Update Upload Case Judgement data',
                'description' => 'Update Upload Case Judgement data'
            ],
            [
                'name' => 'forward_case.create',
                'display_name' => 'Forward Case data',
                'description' => 'Forward Case Pre/Post Schedule data'
            ],
            [
                'name' => 'forward_case.store',
                'display_name' => 'Store Forward Case data',
                'description' => 'Store Forward Case data'
            ],
            [
                'name' => 'forward_case.edit',
                'display_name' => 'Edit Forward Case data',
                'description' => 'Edit Forward Case data'
            ],
            [
                'name' => 'forward_case.update',
                'display_name' => 'Update Forward Case data',
                'description' => 'Update Forward Case data'
            ],
            [
                'name' => 'send_notice_to_appellant.create',
                'display_name' => 'Send Notice data',
                'description' => 'Send Notice data'
            ],
            [
                'name' => 'send_notice_to_appellant.store',
                'display_name' => 'Store Send Notice data',
                'description' => 'Store Send Notice data'
            ],
            [
                'name' => 'send_notice_to_appellant.edit',
                'display_name' => 'Edit Send Notice data',
                'description' => 'Edit Send Notice data'
            ],
            [
                'name' => 'send_notice_to_appellant.update',
                'display_name' => 'Update Send Notice data',
                'description' => 'Update Send Notice data'
            ],
            [
                'name' => 'schedule_hearing.show',
                'display_name' => 'Shows scheduled hearing data',
                'description' => 'Shows scheduled hearing data'
            ],
            [
                'name' => 'hearing.dashboard',
                'display_name' => 'Shows hearing dashboard',
                'description' => 'Shows hearing dashboard'
            ],
        ];

        $permission_role_joint_pa = [];
        $permission_role_co_pa = [];

        foreach ($permissions_for_pa as $hearing) {

            $permission_id = Permission::where('name',$hearing['name'])->value('id');

            if(!$permission_id )
                $permission_id = Permission::insertGetId($hearing);

            $permission_role_joint_pa_data = PermissionRole::where('permission_id',$permission_id)
                ->where('role_id',$joint_co_pa_role_id)->first();

            if(!$permission_role_joint_pa_data)
                $permission_role_joint_pa[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $joint_co_pa_role_id,
                ];

            $permission_role_co_pa_data = PermissionRole::where('permission_id',$permission_id)
                ->where('role_id',$co_pa_role_id)->first();

            if(!$permission_role_co_pa_data)
                $permission_role_co_pa[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $co_pa_role_id,
                ];
        }

        if (count($permission_role_joint_pa) > 0)
            PermissionRole::insert($permission_role_joint_pa);

        if (count($permission_role_co_pa) > 0)
            PermissionRole::insert($permission_role_co_pa);



        // CO & Joint_CO
        $permissions_for_head = [
            [
                'name' => 'hearing.index',
                'display_name' => 'List Hearing',
                'description' => 'Listing of Hearing'
            ],
            [
                'name' => 'hearing.show',
                'display_name' => 'Show Hearing',
                'description' => 'Display a particular hearing'
            ],
            [
                'name' => 'forward_case.create',
                'display_name' => 'Forward Case data',
                'description' => 'Forward Case Pre/Post Schedule data'
            ],
            [
                'name' => 'forward_case.store',
                'display_name' => 'Store Forward Case data',
                'description' => 'Store Forward Case data'
            ],
            [
                'name' => 'forward_case.edit',
                'display_name' => 'Edit Forward Case data',
                'description' => 'Edit Forward Case data'
            ],
            [
                'name' => 'forward_case.update',
                'display_name' => 'Update Forward Case data',
                'description' => 'Update Forward Case data'
            ],
            [
                'name' => 'forward_case.show',
                'display_name' => 'Shows Forwarded Case data',
                'description' => 'Shows Forwarded Case data'
            ],
            [
                'name' => 'hearing.dashboard',
                'display_name' => 'Shows hearing dashboard',
                'description' => 'Shows hearing dashboard'
            ],

        ];
        $permission_role_joint_co = [];
        $permission_role_co = [];


        foreach ($permissions_for_head as $hearings) {

            $permission_ids = Permission::where('name', $hearings['name'])->value('id');

            if (!$permission_ids){
                $permission_ids = Permission::insertGetId($hearings);
            }

            $permission_role_joint_co_data = PermissionRole::where('permission_id', $permission_ids)
                ->where('role_id', $joint_co_role_id)->first();

            if (!$permission_role_joint_co_data)
                $permission_role_joint_co[] = [
                    'permission_id' => $permission_ids,
                    'role_id' => $joint_co_role_id,
                ];

            $permission_role_co_data = PermissionRole::where('permission_id', $permission_ids)
                ->where('role_id', $co_role_id)->first();

            if (!$permission_role_co_data)
                $permission_role_co[] = [
                    'permission_id' => $permission_ids,
                    'role_id' => $co_role_id,
                ];
        }

        if (count($permission_role_joint_co) > 0)
            PermissionRole::insert($permission_role_joint_co);

        if (count($permission_role_co) > 0)
            PermissionRole::insert($permission_role_co);


        // Board

        $board_id = \App\Board::where('board_name', '=', "Mumbai Board")->get(['id'])->first();

        $department1 = \App\Department::create([
            'department_name' => "Joint CO",
            'status' => 1
        ])->id;

        $department2 = \App\Department::create([
            'department_name' => "Co",
            'status' => 1
        ])->id;

        $board_department1 = \App\BoardDepartment::create([
            'board_id' => $board_id->id,
            'department_id' => $department1,
        ]);

        $board_department2 = \App\BoardDepartment::create([
            'board_id' => $board_id->id,
            'department_id' => $department2,
        ]);

        $board_user1 = \App\BoardUser::create([
            'board_id' => $board_id->id,
            'user_id' => $joint_co_user_id
        ]);

        $board_user1 = \App\BoardUser::create([
            'board_id' => $board_id->id,
            'user_id' => $joint_co_pa_user_id
        ]);

        $board_user1 = \App\BoardUser::create([
            'board_id' => $board_id->id,
            'user_id' => $co_user_id
        ]);

        $board_user1 = \App\BoardUser::create([
            'board_id' => $board_id->id,
            'user_id' => $co_pa_user_id
        ]);

        //Joint CO permissions for society conveyance Application
        $Jtco_permission = [
            [
                'name'         =>'conveyance.index',
                'display_name' =>'conveyance',
                'description'  =>'conveyance'
            ],
            [
                'name'         =>'conveyance.view_application',
                'display_name' =>'view application',
                'description'  =>'view application'
            ],
            [
                'name'        =>'conveyance.sale_lease_agreement',
                'display_name'=>'sale lease agreement',
                'description' =>'sale lease agreement'
            ],
            [
                'name'         => 'conveyance.save_agreement_comments',
                'display_name' => 'save agreement comments',
                'description'  => 'save agreement comments',
            ],
            [
                'name'         => 'conveyance.approved_sale_lease_agreement',
                'display_name' => 'approved sale lease agreement',
                'description'  => 'approved sale lease agreement',
            ],
            [
                'name'         => 'conveyance.stamp_duty_agreement',
                'display_name' => 'stamp duty agreement',
                'description'  => 'stamp duty agreement',
            ],
            [
                'name'         => 'conveyance.stamp_signed_duty_agreement',
                'display_name' => 'stamp signed duty agreement',
                'description'  => 'stamp signed duty agreement',
            ],
            [
                'name'         => 'conveyance.register_sale_lease_agreement',
                'display_name' => 'register sale lease agreement',
                'description'  => 'register sale lease agreement',
            ],
            [
                'name'         => 'conveyance.checklist',
                'display_name' => 'checklist',
                'description'  => 'checklist',
            ],
            [
                'name'         => 'conveyance.forward_application_sc',
                'display_name' => 'forward application data',
                'description'  => 'forward application data',
            ],
            [
                'name'         => 'conveyance.save_forward_application',
                'display_name' => 'forward application data',
                'description'  => 'forward application data',
            ],
            [
                'name' => 'conveyance.view_ee_documents',
                'display_name' => 'view ee documents',
                'description' => 'view ee documents',
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
        ];

        foreach ($Jtco_permission as $permission) {
            $permission_role = [];
            $permission_ids = Permission::where('name', $permission['name'])->value('id');

            if (!$permission_ids){
                $permission_ids = Permission::insertGetId($permission);
            }

            $permissionData = PermissionRole::where('permission_id', $permission_ids)
                ->where('role_id', $joint_co_role_id)->first();

            if ($permissionData){
            }else{
                $permission_role[] = [
                    'permission_id' => $permission_ids,
                    'role_id' => $joint_co_role_id,
                ];
                PermissionRole::insert($permission_role);
            }
        }
        //add joint CO as per layout

        $layout_id = \App\MasterLayout::where("layout_name", '=', "Samata Nagar, Kandivali(E)")->first();
        $layout_user = \App\LayoutUser::where('user_id', $joint_co_user_id)->where('layout_id', $layout_id->id)->first();

        if ($layout_user) {

        }else
        {
            \App\LayoutUser::insert(['user_id' => $joint_co_user_id, 'layout_id' => $layout_id->id]);
        }
    }
}