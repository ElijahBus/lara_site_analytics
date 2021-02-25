<?php

namespace Dashboard\Console;

use Illuminate\Console\Command;

class SetupDashboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the Dashboard package';

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
        $this->info('Setting up the package');

        if (! class_exists('DashboardSetupTable')) {
            $this->call('vendor:publish', [
                '--provider' => 'Dashboard\Providers\DashboardSetupServiceProvider'
            ]);
            $this->info('The migration file has been succesfully published');

        } else {
            $this->info('Migration file found');
        }
    }


}
