<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\Dashboard\AppointingArchitectController;

class AppointingArchitectComposer
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
    public function __construct(AppointingArchitectController $architect_dashboard)
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
        $data = array();
        if (in_array(session()->get('role_name'),array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'),config('commanConfig.selection_commitee')))) {
            $data['total_no_of_application']=$this->architect_dashboard->total_number_of_application();
            $data['total_shortlisted_application'] = $this->architect_dashboard->total_shortlisted_application();
            $data['total_final_application'] = $this->architect_dashboard->total_final_application();
            $data['pending_at_current_user'] = $this->architect_dashboard->pending_at_current_user();
            $data['pending_at_jr_architect'] = $this->architect_dashboard->pending_at_user(array(config('commanConfig.junior_architect')));
            $data['pending_at_sr_architect'] = $this->architect_dashboard->pending_at_user(array(config('commanConfig.senior_architect')));
            $data['pending_at_architect'] = $this->architect_dashboard->pending_at_user(array(config('commanConfig.architect')));
            $data['pending_at_selection_committee']= $this->architect_dashboard->pending_at_user(array(config('commanConfig.selection_commitee')));
        }
        //dd($data);
        $view->with('appointing_architect_data', $data);
    }

}