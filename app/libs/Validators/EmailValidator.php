<?php namespace Libs\Validators;

class EmailValidator extends ValidatorService{
    public static $rules = array(
       'email' => 'required|unique:users|email',
       );
}