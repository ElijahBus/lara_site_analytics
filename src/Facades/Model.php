<?php

namespace Dashboard\Facades;

class Model extends Facade
{

    /**
     * Set the name of the facade instance
     */
    public function __construct()
    {
        parent::$resolvedInstanceName = 'Model';
    }
}
