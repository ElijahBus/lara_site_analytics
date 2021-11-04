<?php

namespace Dashboard\Providers;

use Dashboard\Facades\Model;
use Dashboard\Services\ModelsService;
use Dashboard\Console\InstallDashboard;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register any dashboard service
     *
     * @return void
     */
    public function register()
    {
        $this->publish();
    }

    /**
     * Boot any dashboard service
     *
     * @return void
     */
    public function boot()
    {
        $this->loadResources();
        new Model();

        $this->app->singleton('Model', function($app) {
            return new ModelsService();
        });

        // Register the commands if the applicaton is run via CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallDashboard::class
            ]);
        }
    }

    /**
     * Register files which will be published in the app that will
     * integrate the package.
     *
     * @return void
     */
    private function publish()
    {
        // get the current directory path
        $basePath = dirname(__DIR__);

        // array contaning all publishables,
        // including but not limitted to configs, migrations, etc ...
        $publishablesArray = [

            // publish the configuration files
            "config" => [
                "$basePath/../config/dashboardmodels.php" => config_path('dashboardmodels.php')
            ],

            // publish models
            "models" => [
                "$basePath/./models" => app_path()
            ],

            // publish controllers
            "controllers" => [
                "$basePath/./Http/Controllers/Publishables" => app_path('Http/Controllers/Dashboard/')
            ],

            // publish helpers
            "helpers" => [
                "$basePath/./Helpers/DashboardHelpers.php" => app_path('Helpers/DashboardHelpers.php')
            ],

            // publish view composer
            "view-composers" => [
                "$basePath/./Http/View/Composers" => app_path('Http/View/Composers/Dashboard')
            ],

            // publish contracts
            "contracts" => [
                "$basePath/./Contracts/" => app_path('Contracts/')
            ],

            "traits" => [
                "$basePath/./Traits/ValidateRequest.php" => app_path('Traits/Dashboard/ValidateRequest.php')
            ],

            // publish migrations
            "migrations" => [
                "$basePath/../database/migrations/visitor_tracking_tables.php.stub"
                    => database_path('migrations/' . date('Y_m_d_His', time()) . '_visitor_tracking_tables.php'),
                "$basePath/../database/migrations/visitor_hit_tracking_tables.php.stub"
                    => database_path('migrations/' . date('Y_m_d_His', time()) . '_visitor_hit_tracking_tables.php'),
                "$basePath/../database/migrations/tos_table.php.stub"
                    => database_path('migrations/' . date('Y_m_d_His', time()) . '_tos_table.php')
            ],

            // publish views
            "views" => [
                "$basePath/../resources/views/" => resource_path('views/dashboard')
            ],

            // publish assets
            "assets" => [
                "$basePath/../resources/assets/js" => public_path('js'),
                "$basePath/../resources/assets/css" => public_path('css')
            ],
        ];

        foreach ($publishablesArray as $group => $path) {
            $this->publishes($path, $group);
        }
    }

    /**
     * Load the package resources to boot with the application
     *
     * @return void
     */
    private function loadResources()
    {
        $this->loadViewsFrom(resource_path('views/dashboard'), 'dashboard');
    }

}
