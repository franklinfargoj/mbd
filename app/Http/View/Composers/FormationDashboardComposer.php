<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\Dashboard\formationDashboardController;

class FormationDashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $formation_dashboard;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(formationDashboardController $formation_dashboard)
    {
        // Dependencies automatically resolved by service container...
        $this->formation_dashboard = $formation_dashboard;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = array();
        $data['total_no_application']=$this->formation_dashboard->total_number_of_application();
        $data['application_pending_at_current_user']=$this->formation_dashboard->pending_at_current_user();
        $data['sent_to_em']=$this->formation_dashboard->pending_at_EM();
        $data['pending_at_dyco']=$this->formation_dashboard->pending_at_Dyco();
        $data['send_to_ddr']=$this->formation_dashboard->send_to_ddr();
        //dd($data);
        $view->with('formation_data', $data);
    }
}