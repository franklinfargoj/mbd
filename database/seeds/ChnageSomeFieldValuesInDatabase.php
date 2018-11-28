<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Role;

class ChnageSomeFieldValuesInDatabase extends Seeder
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

        // Changing  redirect to path of all REE offer letter users
        $ee_role_id = Role::where('name', '=', 'ee_engineer')->value('id');
        if($ee_role_id){
            $data = Role::findOrFail($ee_role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }


        $ee_dy_role_id = Role::where('name','ee_dy_engineer')->value('id');
        if($ee_dy_role_id){
            $data = Role::findOrFail($ee_dy_role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }


        $ee_jr_role_id = Role::where('name','ee_junior_engineer')->value('id');
        if($ee_jr_role_id){
            $data = Role::findOrFail($ee_jr_role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }

        $role_id = Role::where('name', '=', 'dyce_engineer')->value('id');
        if($role_id){
            $data = Role::findOrFail($role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }


        $dyce_deputy_role_id = Role::where('name', '=', 'dyce_deputy_engineer')->value('id');
        if($dyce_deputy_role_id){
            $data = Role::findOrFail($dyce_deputy_role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }

        $dyce_Jr_role_id = Role::where('name', '=', 'dyce_junior_engineer')->value('id');
        if($dyce_Jr_role_id){
            $data = Role::findOrFail($dyce_Jr_role_id);
            $data->redirect_to ='/dashboard';
            $data->save();
        }

        $joint_co_role_id = Role::where('name', '=', 'Joint CO')->value('id');
        if($joint_co_role_id ){
            $data = Role::findOrFail($joint_co_role_id);
            $data->redirect_to ='/hearing-dashboard';
            $data->save();
        }

        $joint_co_pa_role_id = Role::where('name','Joint Co PA')->value('id');
        if($joint_co_pa_role_id){
            $data = Role::findOrFail($joint_co_pa_role_id);
            $data->redirect_to ='/hearing-dashboard';
            $data->save();
        }

        $co_role_id = Role::where('name','Co')->value('id');
        if($co_role_id){
            $data = Role::findOrFail($co_role_id);
            $data->redirect_to ='/hearing-dashboard';
            $data->save();
        }

        $co_pa_role_id =Role::where('name','Co PA')->value('id');
        if($co_pa_role_id){
            $data = Role::findOrFail($co_pa_role_id);
            $data->redirect_to ='/hearing-dashboard';
            $data->save();
        }
    }
}
