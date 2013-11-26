<?php namespace Libs\Validators;

class UsernameValidator extends ValidatorService{
    public static $rules = array(
       'username' => 'required|unique:users',
       );
}