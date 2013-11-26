<?php namespace Libs\Validators;

class PasswordValidator extends ValidatorService{
    public static $rules = array(
       'password' => 'required',
       'password_confirm' =>'required|same:password',
       );
}