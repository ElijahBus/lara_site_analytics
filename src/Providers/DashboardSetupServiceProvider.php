<?php

namespace Dashboard\Providers;

use Dashboard\Console\SetupDashboard;
use Dashboard\Facades\Model;
use Dashboard\Services\ModelsService;
use Illuminate\Support\ServiceProvider;

class DashboardSetupServiceProvider extends ServiceProvider
{
    /**
     * Register any dashboard service
     *
     * @return void
     */
    public function register()
    {
        $basePath = dirname(__DIR__);

        if ($this->app->runningInConsole()) {

            /**
             * publish the migration file as the initial setup of the dashboard pacakage.
             * this migration create then a dashboard_logs table where the logs will be
             * saved:
             *
             * - Log if the package is installed: this include publishing controllers, views, and assets.
             * - Log if the routes are published, to avoid the publishing of routes multiple times.
             */
            $this->publishes([
                "$basePath/../database/migrations/dashboard_setup_table.php.stub"
                    => database_path('migrations/' . date('Y_m_d_His', time()) . '_dashboard_setup_table.php')
            ]);
        }
    }

    /**
     * Boot any dashboard service
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupDashboard::class
            ]);
        }

    }

}
