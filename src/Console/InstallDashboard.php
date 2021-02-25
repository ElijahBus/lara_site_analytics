<?php

namespace Dashboard\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InstallDashboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Dashboard package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->logsTableExists())
            return $this->warn("Run first 'php artisan dashboard:setup' then 'php artisan migrate' commands before publishing resources");

        if ($this->resourcesPublished())
        {
            $confirmPublish = $this->confirm("Resources are already published. Do you want to proceed ?");
            if (! $confirmPublish) return;

            // DB::table('dashboard_logs')->truncate();
        }

        $this->info('Installing  the package');

        $this->info('Publishing controllers, views and assets');

        // Publish Dashboard resources
        $publishedResourcesResponse = $this->call('vendor:publish', [
            '--provider' => 'Dashboard\Providers\DashboardServiceProvider'
        ]);

        $this->info('Publishing Dashboard routes');

        // Check if routes are already published. this helps avoid duplication of routes in the destination file.
        $publishRoutesResponse = ($this->resourcesPublished()) ? true : $this->publishDashboardRoutes();

        $this->logPublishablesResponses($publishedResourcesResponse, $publishRoutesResponse);

    }

    /**
     * Copy Dashboard routes from the packages to the application, inside routes/web.php
     *
     * @return boolean
     */
    public function publishDashboardRoutes()
    {
        $basePath = __DIR__;

        try {
            // publish web routes
            $webRoutesFromPath = "$basePath/../routes/stubs/web.php.stub";
            $webRoutesToPath = app_path('../routes/web.php');
            $this->copyContent($webRoutesFromPath, $webRoutesToPath);

            // publish api routes
            $apiRoutesFromPath = "$basePath/../routes/stubs/api.php.stub";
            $apiRoutesToPath = app_path('../routes/api.php');
            $this->copyContent($apiRoutesFromPath, $apiRoutesToPath);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function copyContent(string $from, string $to)
    {
        try {
            $fileToPublish = file_get_contents($from);

            $fileResource = fopen($to, 'a');
            fwrite($fileResource, $fileToPublish);

            return fclose($fileResource);
        } catch (\Throwable $th) {
            return false;
        }
    }


    /**
     * Log into the database whether the reources has been published or not
     *
     * @param integer $resourcesResponse
     * @param boolean $routesResponse
     * @return Illuminate\Console\Command::info
     */
    private function logPublishablesResponses($resourcesResponse, $routesResponse)
    {
        // check if resources has been successfully published before saving the logs
        if (gettype($resourcesResponse) == 'integer' && $routesResponse != false) {
            DB::table('dashboard_logs')->updateOrInsert([
                "is_dashboard_setup" => true,
                "are_routes_published" => true
            ]);

            return $this->info("Done.");
        }

        return $this->error("All resources have not been successfully published");
    }

    /**
     * Check if the resources has been published
     *
     * @return boolean
     */
    private function resourcesPublished()
    {
        $log = DB::table('dashboard_logs')->first();
        if ($log != null) return true;

        return false;
    }

    /**
     * Check if logs table exists
     *
     * @return boolean
     */
    private function logsTableExists()
    {
        if (! Schema::hasTable('dashboard_logs')) return false;

        return true;
    }
}
