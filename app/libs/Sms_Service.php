<?php
namespace App\Libs;

abstract class Sms_Service{
    protected $mobile_number;
    protected $errors;

    public function __construct($mobile_number=null)
    {
        $this->$mobile_number = $mobile_number ?: \Input::get('phone');
    }

    public function sendSms($mobile_number)
    {

             $mobile_number = $this->mobile_number;
             return $msg->sendSms($mobile_number);

     }

}