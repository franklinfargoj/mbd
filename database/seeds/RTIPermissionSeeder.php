<?php

use App\Department;
use App\Permission;
use App\PermissionRole;
use App\Role;
use App\RoleUser;
use App\RtiDepartmentUser;
use App\User;
use Illuminate\Database\Seeder;

class RTIPermissionSeeder extends Seeder
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
                'name' => 'rti_form',
                'display_name' => 'Show front end form',
                'description' => 'Show front end form',
            ],
            [
                'name' => 'rti_form_success',
                'display_name' => 'Save RTI form data',
                'description' => 'Save RTI form data',
            ],
            [
                'name' => 'rti_form_success_close',
                'display_name' => 'Save RTI form data',
                'description' => 'Save RTI form data',
            ],
            [
                'name' => 'rti_form_search',
                'display_name' => 'RTI Form success',
                'description' => 'RTI Form success',
            ],
            [
                'name' => 'rti_applicants',
                'display_name' => 'List of RTI Applicants',
                'description' => 'List of RTI Applicants',
            ],
            [
                'name' => 'schedule_meeting',
                'display_name' => 'Schedule meeting',
                'description' => 'Schedule meeting',
            ],
            [
                'name' => 'rti_schedule_meeting',
                'display_name' => 'Save Schedule meeting data',
                'description' => 'Save Schedule meeting data',
            ],
            [
                'name' => 'view_applicant',
                'display_name' => 'View Applicant',
                'description' => 'View Applicant',
            ],
            [
                'name' => 'update_status',
                'display_name' => 'Get Update Status form',
                'description' => 'Get Update Status form',
            ],
            [
                'name' => 'rti_update_status',
                'display_name' => 'Save update status data',
                'description' => 'Save update status data',
            ],
            [
                'name' => 'rti_send_info',
                'display_name' => 'Get RTI info form',
                'description' => 'Get RTI info form',
            ],
            [
                'name' => 'rti_sent_info_data',
                'display_name' => 'Save RTI info data',
                'description' => 'Save RTI info data',
            ],
            [
                'name' => 'rti_forwarded_application',
                'display_name' => 'Get Forward application form',
                'description' => 'Get Forward application form',
            ],
            [
                'name' => 'rti_forwarded_application_data',
                'display_name' => 'Save Forward application form',
                'description' => 'Save Forward application form',
            ],
            [
                'name' => 'rti_frontend_application',
                'display_name' => 'RTI Frontend Application',
                'description' => 'RTI Frontend Application',
            ],
            [
                'name' => 'rti_frontend_application_status',
                'display_name' => 'RTI Frontend Application status',
                'description' => 'RTI Frontend Application status',
            ],
            [
                'name'=>'rti_statstics_reports',
                'display_name'=>'rti_statstics_reports',
                'description'=>'rti_statstics_reports'
            ],
            [
                'name'=>'rti_submitted_reports_by_users',
                'display_name'=>'rti_submitted_reports_by_users',
                'description'=>'rti_submitted_reports_by_users'
            ],
            [
                'name'=>'rti_reports_department',
                'display_name'=>'rti_reports_department',
                'description'=>'rti_reports_department'
            ],
            [
                'name'=>'rti_reports_status',
                'display_name'=>'rti_reports_status',
                'description'=>'rti_reports_status'
            ],
            [
                'name'=>'pending_rti',
                'display_name'=>'pending_rti',
                'description'=>'pending_rti'
            ]
        ];

        $departments=Department::all();

        foreach($departments as $department)
        {
            $dep=str_replace(' ', '_', strtolower($department['department_name']));
            $rti_manager = Role::where('name', '=', 'RTI')->first();
            if ($rti_manager) {
                $role_id = $rti_manager->id;
            } else {
                $role_id = Role::insertGetId([
                    'name' => 'RTI',
                    'redirect_to' => '/rti_applicants',
                    'dashboard' => '/rti_applicants',
                    'display_name' => 'rti_manager',
                    'description' => 'Login as RTI Manager',
                ]);
            }

            $rti_user = User::where(['email' => $dep.'_rti@gmail.com'])->first();
            if ($rti_user) {
                $user_id = $rti_user->id;
            } else {
                $user_id = User::insertGetId([
                    'name' => 'RTI Manager',
                    'email' => $dep.'_rti@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $role_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '7412589635',
                    'address' => 'Mumbai',
                ]);
            }

            $rti_role_user = RoleUser::where(['user_id' => $user_id, 'role_id' => $role_id])->first();
            if ($rti_role_user) {

            } else {
                $role_user = RoleUser::insert([
                    'user_id' => $user_id,
                    'role_id' => $role_id,
                    'start_date' => \Carbon\Carbon::now(),
                ]);
            }

            //$department = Department::where(['id' => 1])->first();
            $department_user = RtiDepartmentUser::where(['user_id' => $user_id, 'department_id' => $department->id])->first();
            if ($department_user) {

            } else {
                $RtiDepartmentUser = new RtiDepartmentUser;
                $RtiDepartmentUser->department_id = $department->id;
                $RtiDepartmentUser->user_id = $user_id;
                $RtiDepartmentUser->save();
            }

            $permission_role = [];

            foreach ($permissions as $lm_per) {
                $get_permission = Permission::where($lm_per)->first();
                if ($get_permission) {
                    $permission_id = $get_permission->id;
                } else {
                    $permission_id = Permission::insertGetId($lm_per);
                    $permission_role = [
                        'permission_id' => $permission_id,
                        'role_id' => $role_id,
                    ];

                    PermissionRole::insert([$permission_role]);
                }
            }

            //Appellate appellate

            $appellate_manager = Role::where('name', '=', 'Rti_Appellate')->first();
            if ($appellate_manager) {
                $appellate_role_id = $appellate_manager->id;
            } else {
                $appellate_role_id = Role::insertGetId([
                    'name' => 'RTI_Appellate',
                    'redirect_to' => '/rti_applicants',
                    'dashboard' => '/rti_applicants',
                    'display_name' => 'Appellate',
                    'description' => 'Login as appellate',
                ]);
            }

            $appellate_user = User::where(['email' => $dep.'_rti_appellate@gmail.com'])->first();
            if ($appellate_user) {
                $appellate_user_id = $appellate_user->id;
            } else {
                $appellate_user_id = User::insertGetId([
                    'name' => 'Appellate',
                    'email' => $dep.'_rti_appellate@gmail.com',
                    'password' => bcrypt('1234'),
                    'role_id' => $appellate_role_id,
                    'uploaded_note_path' => 'Test',
                    'mobile_no' => '7412589635',
                    'address' => 'Mumbai',
                ]);
            }

            $appellate_role_user = RoleUser::where(['user_id' => $appellate_user_id, 'role_id' => $appellate_role_id])->first();
            if ($appellate_role_user) {

            } else {
                $appellate_role_user = RoleUser::insert([
                    'user_id' => $appellate_user_id,
                    'role_id' => $appellate_role_id,
                    'start_date' => \Carbon\Carbon::now(),
                ]);
            }

           // $department = Department::where(['id' => 1])->first();
            $department_user = RtiDepartmentUser::where(['user_id' => $appellate_user_id, 'department_id' => $department->id])->first();
            if ($department_user) {

            } else {
                $RtiDepartmentUser = new RtiDepartmentUser;
                $RtiDepartmentUser->department_id = $department->id;
                $RtiDepartmentUser->user_id = $appellate_user_id;
                $RtiDepartmentUser->save();
            }

            $permission_role = [];

            foreach ($permissions as $lm_per) {
                $get_permission = Permission::where($lm_per)->first();
                if ($get_permission) {
                    $permission_id = $get_permission->id;
                } else {
                    $permission_id = Permission::insertGetId($lm_per);
                }

                $PermissionRole = PermissionRole::where(['permission_id' => $permission_id, 'role_id' => $appellate_role_id])->first();
                if ($PermissionRole) {

                } else {
                    $permission_role = [
                        'permission_id' => $permission_id,
                        'role_id' => $appellate_role_id,
                    ];
                    PermissionRole::insert([$permission_role]);
                }
            }
        }
        

        //if (count($rti_manager) == 0) {
        // $role_id = Role::insertGetId([
        //     'name' => 'RTI',
        //     'redirect_to' => '/rti_applicants',
        //     'dashboard' => '/rti_applicants',
        //     'display_name' => 'rti_manager',
        //     'description' => 'Login as RTI Manager'
        // ]);

        // $user_id = User::insertGetId([
        //     'name' => 'RTI Manager',
        //     'email' => 'rti@gmail.com',
        //     'password' => bcrypt('rti123'),
        //     'role_id' => $role_id,
        //     'uploaded_note_path' => 'Test',
        //     'mobile_no' => '7412589635',
        //     'address' => 'Mumbai'
        // ]);

        // $role_user = RoleUser::insert([
        //     'user_id' => $user_id,
        //     'role_id' => $role_id,
        //     'start_date' => \Carbon\Carbon::now()
        // ]);

        // $permission_role = [];

        // foreach ($permissions as $lm_per) {
        //     $permission_id = Permission::insertGetId($lm_per);

        //     $permission_role[] = [
        //         'permission_id' => $permission_id,
        //         'role_id' => $role_id,
        //     ];
        // }

        // PermissionRole::insert($permission_role);
        //}
    }
}
