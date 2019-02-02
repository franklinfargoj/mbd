<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\EEDivision;


class EEDivisionComposer
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
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $ee_divisions=EEDivision::all();
        $view->with('ee_divisions', $ee_divisions);
    }
}