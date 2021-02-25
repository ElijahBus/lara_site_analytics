<?php

namespace Dashboard\Services;

use Dashboard\Traits\ModelsDefinition;

class ModelsService
{
    use ModelsDefinition;

    /**
     * Refer to the application's User Model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Refer to the application's Role Model that Laratrust uses
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * Refer to the application's Permission model that Laratrust uses
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function permission()
    {
        return $this->permission;
    }

    /**
     * Refer to the application's Permission model that Laratrust uses
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function tos()
    {
        return $this->tos;
    }
}
