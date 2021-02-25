<?php

namespace Dashboard\Traits;

use Illuminate\Support\Facades\Config;

trait ModelsDefinition
{
    /**
     * The application models , we get this value from the config/dashboardmodels.php file
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    private $user;
    private $tos;

    /**
     * Role and Permission models that latrust uses in the application
     *
     * @var Illuminate\Database\Eloquent\Model;
     */
        private $role;
        private $permission;

    public function __construct() {
        $this->user = Config::get('dashboardmodels.user', 'App\\User', false);
        $this->tos = Config::get('dashboardmodels.pos', 'App\\Tos', false);
        $this->role = Config::get('dashboardmodels.laratrust.role', 'App\\Role', false);
        $this->permission = Config::get('dashboardmodels.laratrust.permission', 'App\\Permission', false);
    }
}
