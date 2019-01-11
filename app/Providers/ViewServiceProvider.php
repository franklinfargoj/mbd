<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            ['admin.common.land_dashboard','admin.common.ol_dashboard','admin.REE_department.dashboard','admin.co_department.dashboard','admin.conveyance.common.dashboard'], 'App\Http\View\Composers\DashboardComposer'
        );
        View::composer(
            ['admin.conveyance.common.dashboard'], 'App\Http\View\Composers\FormationDashboardComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}