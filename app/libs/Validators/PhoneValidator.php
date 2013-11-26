<?php
namespace Libs\Validators;

class PhoneValidator extends ValidatorService{
    public static $rules = array(
       'phone' => 'required|unique:users|integer',
       );
}