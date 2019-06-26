<?php

use Illuminate\Database\Seeder;
use App\Role;

class AddChildParentToConveyanceModule extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get role id of all Roles
        
        $society_role_id   = Role::where('name', '=', config('commanConfig.society_offer_letter'))->value('id');
        $dycdo_role_id 	   = Role::where('name', '=', config('commanConfig.dycdo_engineer'))->value('id');
        $cdo_role_id     = Role::where('name', '=', config('commanConfig.cdo_engineer'))->value('id');
        $dyco_role_id 	   = Role::where('name', '=', config('commanConfig.dyco_engineer'))->value('id');
        $ee_head_id 	   = Role::where('name', '=', config('commanConfig.ee_branch_head'))->value('id');
        $ee_deputy_id 	   = Role::where('name', '=', config('commanConfig.ee_deputy_engineer'))->value('id');
        $ee_jr_id 		   = Role::where('name', '=', config('commanConfig.ee_junior_engineer'))->value('id');
        $em_role_id 	   = Role::where('name', '=', config('commanConfig.estate_manager'))->value('id');
        $architect_jr_id   = Role::where('name', '=', config('commanConfig.junior_architect'))->value('id');
        $architect_as_id   = Role::where('name', '=', config('commanConfig.senior_architect'))->value('id');
        $architect_head_id = Role::where('name', '=', config('commanConfig.architect'))->value('id');
        $Jtco_role_id 	   = Role::where('name', '=', config('commanConfig.joint_co'))->value('id');
        $co_role_id 	   = Role::where('name', '=', config('commanConfig.co_engineer'))->value('id');        
        $LA_role_id 	   = Role::where('name', '=', config('commanConfig.legal_advisor'))->value('id');

        //update conveyance parent Id(Forward)

        $society_parent = json_encode([$dycdo_role_id]);    
        Role::where('id', $society_role_id)->update(['conveyance_parent_id' => $society_parent]);        

        $dycdo_parent = json_encode([$cdo_role_id]);    
        Role::where('id', $dycdo_role_id)->update(['conveyance_parent_id' => $dycdo_parent]);

        $cdo_parent = json_encode([$dyco_role_id]);    
        Role::where('id', $cdo_role_id)->update(['conveyance_parent_id' => $cdo_parent]);        

        $dyco_parent = json_encode([$ee_jr_id,$em_role_id,$architect_jr_id,$Jtco_role_id,$society_role_id]);    
        Role::where('id', $dyco_role_id)->update(['conveyance_parent_id' => $dyco_parent]);        

        $ee_jr_parent = json_encode([$ee_deputy_id]);    
        Role::where('id', $ee_jr_id)->update(['conveyance_parent_id' => $ee_jr_parent]);        

        $ee_deputy_parent = json_encode([$ee_head_id]);    
        Role::where('id', $ee_deputy_id)->update(['conveyance_parent_id' => $ee_deputy_parent]);

        $ee_head_parent = json_encode([$dycdo_role_id, $architect_jr_id]);    
        Role::where('id', $ee_head_id)->update(['conveyance_parent_id' => $ee_head_parent]);        

        $em_parent = json_encode([$dycdo_role_id]);    
        Role::where('id', $em_role_id)->update(['conveyance_parent_id' => $em_parent]);        

        $architect_jr_parent = json_encode([$architect_as_id]);    
        Role::where('id', $architect_jr_id)->update(['conveyance_parent_id' => $architect_jr_parent]);        

        $architect_as_parent = json_encode([$architect_head_id]);    
        Role::where('id', $architect_as_id)->update(['conveyance_parent_id' => $architect_as_parent]);       
        
        $architect_head_parent = json_encode([$ee_jr_id]);    
        Role::where('id', $architect_head_id)->update(['conveyance_parent_id' => $architect_head_parent]);        

        $Jtco_parent = json_encode([$co_role_id,$dycdo_role_id]);    
        Role::where('id', $Jtco_role_id)->update(['conveyance_parent_id' => $Jtco_parent]);        

        $co_parent = json_encode([$Jtco_role_id,$LA_role_id]);    
        Role::where('id', $co_role_id)->update(['conveyance_parent_id' => $co_parent]);        

        $LA_parent = json_encode([$co_role_id]);    
        Role::where('id', $LA_role_id)->update(['conveyance_parent_id' => $LA_parent]);

        //update conveyance child Id(Revert)

        $cdo_child = json_encode([$dycdo_role_id]);    
        Role::where('id', $cdo_role_id)->update(['conveyance_child_id' => $cdo_child]);

        $dyco_child = json_encode([$cdo_role_id,$society_role_id,$ee_jr_id,$em_role_id,$architect_jr_id]);    
        Role::where('id', $dyco_role_id)->update(['conveyance_child_id' => $dyco_child]); 

        // $architect_jr_child = json_encode([$architect_as_id]);    
        // Role::where('id', $architect_jr_id)->update(['conveyance_child_id' => $architect_jr_child]);        

        $architect_as_child = json_encode([$architect_jr_id]);    
        Role::where('id', $architect_as_id)->update(['conveyance_child_id' => $architect_as_child]);                  

        $architect_head_child = json_encode([$architect_as_id,$dyco_role_id,$ee_head_id]);    
        Role::where('id', $architect_head_id)->update(['conveyance_child_id' => $architect_head_child]); 
        
        // $ee_jr_child = json_encode([$ee_deputy_id]);    
        // Role::where('id', $ee_jr_id)->update(['conveyance_child_id' => $ee_jr_child]);        

        $ee_deputy_child = json_encode([$ee_jr_id]);    
        Role::where('id', $ee_deputy_id)->update(['conveyance_child_id' => $ee_deputy_child]);

        $ee_head_child = json_encode([$ee_deputy_id,$dyco_role_id, $architect_head_id]);    
        Role::where('id', $ee_head_id)->update(['conveyance_child_id' => $ee_head_child]);         

        $co_child = json_encode([$ee_head_id,$em_role_id, $architect_head_id,$dyco_role_id,$Jtco_role_id]);    
        Role::where('id', $co_role_id)->update(['conveyance_child_id' => $co_child]);         

        $Jtco_child = json_encode([$ee_head_id,$em_role_id, $architect_head_id,$dyco_role_id,$co_role_id]);    
        Role::where('id', $Jtco_role_id)->update(['conveyance_child_id' => $Jtco_child]); 

    }
}
