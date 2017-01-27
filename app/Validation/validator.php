<?php

namespace Beacon\Validation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator {

    static function validateCurrentPassword($attribute, $value, $parameters)
    {
        return Hash::check($value, Auth::user()->password);
    }

}
