<?php namespace Libs\Validators;

class ProfileValidator extends ValidatorService{
    public static $rules = array(
       'phone' => 'required_without:email|integer|unique:users',
       'email' => 'required_without:phone|unique:users',
       );
}