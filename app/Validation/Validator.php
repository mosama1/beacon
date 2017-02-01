<?php

namespace Beacon\Validation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator {

	/**
     * Overrides parent function to append custom validation.
     *
     * @return Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function () use ($validator)
        {
            if ( ! $this->validateCurrentPassword())
            {
                $validator->errors()->add('current_password', trans('messages.validation.password'));
            }
        });
        return $validator;
    }
	static function validateCurrentPassword($attribute, $value, $parameters)
	{
		return Hash::check($value, Auth::user()->password);
	}
}
