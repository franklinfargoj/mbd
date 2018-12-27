<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\Dashboard\ArchitectLayoutDashboardController;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $architect_dashboard;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(ArchitectLayoutDashboardController $architect_dashboard)
    {
        // Dependencies automatically resolved by service container...
        $this->architect_dashboard = $architect_dashboard;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (in_array(session()->get('role_name'),array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect')))) {
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['pending_at_current_user'] = $this->architect_dashboard->pending_at_current_user();
            $data['sent_to_ee'] = $this->architect_dashboard->sent_to_ee();
            $data['sent_to_ree'] = $this->architect_dashboard->sent_to_ree();
            $data['sent_to_lm'] = $this->architect_dashboard->sent_to_lm();
            $data['sent_to_em'] = $this->architect_dashboard->sent_to_em();
            $data['approved_layouts'] = $this->architect_dashboard->approved_layouts();
            $data['appln_sent_for_arroval'] = $this->architect_dashboard->appln_sent_for_arroval();
            $data['pending_at_ree'] = $this->architect_dashboard->pending_at_ree();
            $data['pending_at_co'] = $this->architect_dashboard->pending_at_co();
            $data['pending_at_cap'] = $this->architect_dashboard->pending_at_cap();
            $data['pending_at_sap'] = $this->architect_dashboard->pending_at_sap();
            $data['pending_at_la'] = $this->architect_dashboard->pending_at_la();
            $data['pending_at_vp'] = $this->architect_dashboard->pending_at_vp();
            $data['pending_at_jr_architect'] = $this->architect_dashboard->pending_at_jr_architect();
            $data['pending_at_sr_architect'] = $this->architect_dashboard->pending_at_sr_architect();
        }

        if (session()->get('role_name') == config('commanConfig.land_manager')) {
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['application_pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
            $data['lm_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
        }

        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['application_pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
            $data['em_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
        }

        if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head')))) {
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['application_pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
            $data['ee_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
            if(session()->get('role_name')==config('commanConfig.ee_branch_head'))
            {
                $data['jr_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_junior_engineer'));
                $data['dy_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_deputy_engineer'));
                $data['head_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_branch_head'));
            }
        }

        if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['application_pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
            $data['ree_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
            $data['appln_sent_for_arroval'] = $this->architect_dashboard->appln_sent_for_arroval();
            $data['application_pending_after_layout_and_excel'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
            $data['application_forwarded_after_layout_and_excel'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);
            
            
            if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
            {
                $data['jr_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_junior'));
                $data['dy_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_deputy_engineer'));
                $data['assistant_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_assistant_engineer'));
                $data['head_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_branch_head'));
            }
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))
        {
            $data['total_no_of_layout']=$this->architect_dashboard->total_number_of_layouts();
            $data['layout_in_process']=$this->architect_dashboard->total_no_of_appln_for_revision_and_approval();
            $data['approved_by_vp']=$this->architect_dashboard->approved_layouts();
            $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
            $data['pending_at_current_user'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
            $data['sent_to_ee'] = $this->architect_dashboard->sent_to_ee();
            $data['sent_to_ree'] = $this->architect_dashboard->sent_to_ree();
            $data['sent_to_lm'] = $this->architect_dashboard->sent_to_lm();
            $data['sent_to_em'] = $this->architect_dashboard->sent_to_em();
            $data['approved_layouts'] = $this->architect_dashboard->approved_layouts();
            $data['appln_sent_for_arroval'] = $this->architect_dashboard->appln_sent_for_arroval();
            $data['pending_at_ree'] = $this->architect_dashboard->pending_at_ree();
            $data['pending_at_co'] = $this->architect_dashboard->pending_at_co();
            $data['pending_at_cap'] = $this->architect_dashboard->pending_at_cap();
            $data['pending_at_sap'] = $this->architect_dashboard->pending_at_sap();
            $data['pending_at_la'] = $this->architect_dashboard->pending_at_la();
            $data['pending_at_vp'] = $this->architect_dashboard->pending_at_vp();
        }
        
        if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
        {
            $data['total_no_of_appln_for_approval'] = $this->architect_dashboard->appln_sent_for_arroval();;
            $data['layouts_pending_at_sap'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
            $data['sap_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);
            $data['sap_reverted_layouts'] =$this->architect_dashboard->reverted_layout_before_layout_and_excel(1);
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
        {
            $data['total_no_of_appln_for_approval'] = $this->architect_dashboard->appln_sent_for_arroval();;
            $data['layouts_pending_at_cap'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
            $data['cap_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);
            $data['cap_reverted_layouts'] =$this->architect_dashboard->reverted_layout_before_layout_and_excel(1);
        }

        if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
        {
            $data['total_no_of_layout']=$this->architect_dashboard->total_number_of_layouts();
            $data['layout_in_process']=$this->architect_dashboard->total_no_of_appln_for_revision_and_approval();
            $data['approved_by_vp']=$this->architect_dashboard->approved_layouts();

            $data['total_no_of_appln_for_approval'] = $this->architect_dashboard->appln_sent_for_arroval();;
            $data['layouts_pending_at_vp'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
            $data['vp_forwarded_and_approved_layouts'] = $this->architect_dashboard->vp_approved_and_forwarded_layout();
            $data['vp_reverted_layouts'] =$this->architect_dashboard->reverted_layout_before_layout_and_excel(1);
        }
        $view->with('architect_data', $data);
    }
}