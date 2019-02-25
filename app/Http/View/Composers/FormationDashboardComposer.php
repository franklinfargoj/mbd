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
        $data['Total Number of Applications']=$this->formation_dashboard->total_number_of_application();
        $data['Application Pending at Current User']=$this->formation_dashboard->pending_at_current_user();
        $data['Sent to EM']=$this->formation_dashboard->pending_at_EM();
        $data['Pending at DYCO']=$this->formation_dashboard->pending_at_Dyco();
        $data['Sent to DDR']=$this->formation_dashboard->send_to_ddr();
        //dd($data);
        $view->with('formation_data', $data);
    }
}