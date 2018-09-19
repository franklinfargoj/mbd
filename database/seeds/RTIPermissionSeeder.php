<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class RTIPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rti_manager = Role::where('name', '=', 'RTI')->select('id')->get();

        if (count($rti_manager) == 0) {
            $role_id = Role::insertGetId([
                'name' => 'RTI',
                'redirect_to' => '/rti_applicants',
                'display_name' => 'rti_manager',
                'description' => 'Login as RTI Manager'
            ]);

            $user_id = User::insertGetId([
                'name' => 'RTI Manager',
                'email' => 'rti@gmail.com',
                'password' => bcrypt('rti123'),
                'role_id' => $role_id,
                'uploaded_note_path' => 'Test',
                'mobile_no' => '7412589635',
                'address' => 'Mumbai'
            ]);

            $role_user = RoleUser::insert([
                'user_id' => $user_id,
                'role_id' => $role_id,
                'start_date' => \Carbon\Carbon::now()
            ]);

            $permissions = [
                [
                    'name' => 'rti_form',
                    'display_name' => 'Show front end form',
                    'description' => 'Show front end form'
                ],
                [
                    'name' => 'rti_form_success',
                    'display_name' => 'Save RTI form data',
                    'description' => 'Save RTI form data'
                ],
                [
                    'name' => 'rti_form_success_close',
                    'display_name' => 'Save RTI form data',
                    'description' => 'Save RTI form data'
                ],
                [
                    'name' => 'rti_form_search',
                    'display_name' => 'RTI Form success',
                    'description' => 'RTI Form success'
                ],
                [
                    'name' => 'rti_applicants',
                    'display_name' => 'List of RTI Applicants',
                    'description' => 'List of RTI Applicants'
                ],
                [
                    'name' => 'schedule_meeting',
                    'display_name' => 'Schedule meeting',
                    'description' => 'Schedule meeting'
                ],
                [
                    'name' => 'rti_schedule_meeting',
                    'display_name' => 'Save Schedule meeting data',
                    'description' => 'Save Schedule meeting data'
                ],
                [
                    'name' => 'view_applicant',
                    'display_name' => 'View Applicant',
                    'description' => 'View Applicant'
                ],
                [
                    'name' => 'update_status',
                    'display_name' => 'Get Update Status form',
                    'description' => 'Get Update Status form'
                ],
                [
                    'name' => 'rti_update_status',
                    'display_name' => 'Save update status data',
                    'description' => 'Save update status data'
                ],
                [
                    'name' => 'rti_send_info',
                    'display_name' => 'Get RTI info form',
                    'description' => 'Get RTI info form'
                ],
                [
                    'name' => 'rti_sent_info_data',
                    'display_name' => 'Save RTI info data',
                    'description' => 'Save RTI info data'
                ],
                [
                    'name' => 'rti_forwarded_application',
                    'display_name' => 'Get Forward application form',
                    'description' => 'Get Forward application form'
                ],
                [
                    'name' => 'rti_forwarded_application_data',
                    'display_name' => 'Save Forward application form',
                    'description' => 'Save Forward application form'
                ],
                [
                    'name' => 'rti_frontend_application',
                    'display_name' => 'RTI Frontend Application',
                    'description' => 'RTI Frontend Application'
                ],
                [
                    'name' => 'rti_frontend_application_status',
                    'display_name' => 'RTI Frontend Application status',
                    'description' => 'RTI Frontend Application status'
                ],
            ];

            $permission_role = [];

            foreach ($permissions as $lm_per) {
                $permission_id = Permission::insertGetId($lm_per);

                $permission_role[] = [
                    'permission_id' => $permission_id,
                    'role_id' => $role_id,
                ];
            }

            PermissionRole::insert($permission_role);
        }
    }
}
