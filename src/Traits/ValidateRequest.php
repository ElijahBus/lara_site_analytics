<?php

namespace App\Traits\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

trait ValidateRequest
{
    private static $VALIDATION_RULES = [
        'role' => [
            'name' => ['required', 'alpha', 'unique:roles'],
            'display_name' => ['required', 'string'],
            'description' => ['nullable', 'max:200']
        ],
        'permission' => [
            'name' => ['required', 'alpha', 'unique:permissions'],
            'display_name' => ['required', 'string'],
            'description' => ['nullable', 'max:200']
        ],
        'tos' => [
            'version' => ['required', 'string', 'tos'],
            'type' => ['nullable'],
            'content' => ['required']
        ]
    ];

    /**
     * @param array $data , the incoming request
     * @return object
     */
    private function validateRole(array $data)
    {
        return Validator::make($data, self::$VALIDATION_RULES['role']);
    }

    /**
     * @param array $data , the incoming request
     * @return object
     */
    private function validatePermission(array $data)
    {
        return Validator::make($data,self::$VALIDATION_RULES['permission']);
    }

    /**
     * @param array $data , the incoming request
     * @return object
     */
    private function validateTos(array $data)
    {
        return Validator::make($data, self::$VALIDATION_RULES['tos']);
    }
}
