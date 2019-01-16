<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\Tripartite\TripartiteDashboardController;

class TripartiteDashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $tripartite_dashboard;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(TripartiteDashboardController $tripartite_dashboard)
    {
        // Dependencies automatically resolved by service container...
        $this->tripartite_dashboard = $tripartite_dashboard;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tripartite_data', $this->tripartite_dashboard->getDashboardHeaders()->getData());
    }
}