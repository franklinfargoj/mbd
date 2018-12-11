<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Role;
use App\Permission;

class ChangeSomeFieldValuesInDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Chnaging Board Name 'Mumbai Board' To 'Mumbai'
        $board_id = Board::where('board_name', '=', "Mumbai Board")->value('id');
        if($board_id){
            $data = Board::findOrFail($board_id);
            $data->board_name ='Mumbai';
            $data->save();
        }

        // Changing  dashboard path of all REE offer letter users
        $ee_role_id = Role::where('name', '=', 'ee_engineer')->value('id');
        if($ee_role_id){
            $data = Role::findOrFail($ee_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }


        $ee_dy_role_id = Role::where('name','ee_dy_engineer')->value('id');
        if($ee_dy_role_id){
            $data = Role::findOrFail($ee_dy_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }


        $ee_jr_role_id = Role::where('name','ee_junior_engineer')->value('id');
        if($ee_jr_role_id){
            $data = Role::findOrFail($ee_jr_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }

        $role_id = Role::where('name', '=', 'dyce_engineer')->value('id');
        if($role_id){
            $data = Role::findOrFail($role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }


        $dyce_deputy_role_id = Role::where('name', '=', 'dyce_deputy_engineer')->value('id');
        if($dyce_deputy_role_id){
            $data = Role::findOrFail($dyce_deputy_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }

        $dyce_Jr_role_id = Role::where('name', '=', 'dyce_junior_engineer')->value('id');
        if($dyce_Jr_role_id){
            $data = Role::findOrFail($dyce_Jr_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }

        // Changing co and joint co dashboard path
        $joint_co_role_id = Role::where('name', '=', 'Joint CO')->value('id');
        if($joint_co_role_id ){
            $data = Role::findOrFail($joint_co_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->save();
        }

        $joint_co_pa_role_id = Role::where('name','Joint Co PA')->value('id');
        if($joint_co_pa_role_id){
            $data = Role::findOrFail($joint_co_pa_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->save();
        }

        $co_role_id = Role::where('name','Co')->value('id');
        if($co_role_id){
            $data = Role::findOrFail($co_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->save();
        }

        $co_pa_role_id =Role::where('name','Co PA')->value('id');
        if($co_pa_role_id){
            $data = Role::findOrFail($co_pa_role_id);
            $data->dashboard ='/hearing-dashboard';
            $data->save();
        }

        // Changing hearing dashboard route to 'hearing.dashboard' in permission

        $hearing_permission_id = Permission::where('name','hearing-dashboard')->value('id');
        if($hearing_permission_id){
            $data = Permission::findOrFail($hearing_permission_id);
            $data->name ='hearing.dashboard';
            $data->save();
        }

        // Changing dashboard route of ree role to '/ree_dashboard'

        $ree_head_role_id = Role::where('name', '=', 'ree_engineer')->value('id');
        if($joint_co_role_id ){
            $data = Role::findOrFail($ree_head_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->save();
        }

        $ree_ass_role_id = Role::where('name', '=', 'REE Assistant Engineer')->value('id');
        if($ree_ass_role_id ){
            $data = Role::findOrFail($ree_ass_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->save();
        }

        $ree_dy_role_id = Role::where('name', '=', 'REE deputy Engineer')->value('id');
        if($ree_dy_role_id ){
            $data = Role::findOrFail($ree_dy_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->save();
        }

        $ree_jr_role_id = Role::where('name', '=', 'REE Junior Engineer')->value('id');
        if($ree_jr_role_id ){
            $data = Role::findOrFail($ree_jr_role_id);
            $data->dashboard ='/ree_dashboard';
            $data->save();
        }

        // Changing dashboard route of CO role to '/co_dashboard'
        $co_role_id = Role::where('name', '=', 'co_engineer')->value('id');
        if($co_role_id ){
            $data = Role::findOrFail($co_role_id);
            $data->dashboard ='/co_dashboard';
            $data->save();
        }        

        // Changing redirect_to route of CO role to '/co'
        $co_role_id = Role::where('name', '=', 'co_engineer')->value('id');
        if($co_role_id ){
            $data = Role::findOrFail($co_role_id);
            $data->redirect_to ='/co';
            $data->save();
        }

        // Changing dashboard route of CAP to '/dashboard'
        $cap_role_id = Role::where('name', '=', 'cap_engineer')->value('id');
        if($cap_role_id ){
            $data = Role::findOrFail($cap_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }

        // Changing dashboard route of VP to '/dashboard'
        $vp_role_id = Role::where('name', '=', 'vp_engineer')->value('id');
        if($vp_role_id ){
            $data = Role::findOrFail($vp_role_id);
            $data->dashboard ='/dashboard';
            $data->save();
        }

        // Changing dashboard routes
        //Account Role
        $account_role_id = Role::where('name', 'Account')->value('id');
        if ($account_role_id)
            Role::where('id',$account_role_id)->update(['dashboard' => '/search_accounts']);

        // SuperAdmin
        $super_admin_role_id = Role::where('name', 'superadmin')->value('id');
        if($super_admin_role_id)
            Role::where('id',$super_admin_role_id)->update(['dashboard' => '/crudadmin/dashboard']);

        // Appointing Architect
        $appointing_architect = Role::where('name', 'appointing_architect')->value('id');
        if($appointing_architect)
            Role::where('id',$appointing_architect)->update(['dashboard' => '/appointing_architect/index']);

        // Main Architect
        $architect_id = Role::where('name' , 'architect')->value('id');
        if($architect_id)
            Role::where('id',$architect_id)->update(['dashboard' => '/dashboard']);

        // Senior Architect
        $senior_architect = Role::where('name' , 'senior_architect')->value('id');
        if($senior_architect)
            Role::where('id',$senior_architect)->update(['dashboard' => '/dashboard']);


        // Junior Architect
        $junior_architect = Role::where('name' , 'junior_architect')->value('id');
        if($junior_architect)
            Role::where('id',$junior_architect)->update(['dashboard' => '/dashboard']);

        // Dyco
        $dyco = Role::where('name', 'dyco_engineer')->value('id');
        if($dyco)
            Role::where('id',$dyco)->update(['dashboard' => '/dashboard']);

        // Dycdo
        $dycdo = Role::where('name' , 'dycdo_engineer')->value('id');
        if($dycdo)
            Role::where('id',$dycdo)->update(['dashboard' => '/dashboard']);

        // EM Clerk
        $em_cl_role_id = Role::where('name','em_clerk')->value('id');
        if($em_cl_role_id)
            Role::where('id',$em_cl_role_id)->update(['dashboard' => '/em_clerk']);

        // EM Manager
        $em_manager_id = Role::where('name', '=', 'EM')->value('id');
        if($em_manager_id)
            Role::where('id',$em_manager_id)->update(['dashboard' => '/dashboard']);

        // Land Manager
        $land_manager = Role::where('name', 'LM')->value('id');
        if($land_manager)
            Role::where('id',$land_manager)->update(['dashboard' => '/village_detail']);

        //RC
        $rc_collector = Role::where('name' , 'rc_collector')->value('id');
        if($rc_collector)
            Role::where('id',$rc_collector)->update(['dashboard' => '/rc']);


        // Resolution Manager
        $resolution_manager = Role::where('name', 'RM')->value('id');
        if($resolution_manager)
            Role::where('id',$resolution_manager)->update(['dashboard' => '/resolution']);

        // RTI Manager
        $rti_manager = Role::where('name', 'RTI')->value('id');
        if($rti_manager)
            Role::where('id',$rti_manager)->update(['dashboard' => '/rti_applicants']);

        // Sap
        $sap = Role::where('name' , 'senior_architect_planner')->value('id');
        if($sap)
            Role::where('id',$sap)->update(['dashboard' => '/architect_layouts']);

        // Selection Commitee
        $slection_commitee = Role::where('name' ,'selection_commitee')->value('id');
        if($slection_commitee)
            Role::where('id',$slection_commitee)->update(['dashboard' => '/architect_application']);

        // Society
        $society = Role::where('name', 'society')->value('id');
        if($society)
            Role::where('id',$society)->update(['dashboard' => '/society/society_offer_letter_dashboard']);

        // LA
        $la = Role::where('name', 'la_engineer')->value('id');
        if($la)
            Role::where('id',$la)->update(['dashboard' => '/dashboard']);        

    }
}
