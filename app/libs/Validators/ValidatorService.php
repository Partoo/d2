<?php namespace Libs\Validators;

abstract class ValidatorService {
    protected $input;
    protected $errors;

    public function __construct($input = null)
    {
        $this->input = $input ?: \Input::all();
    }

    public function passes()
    {
        $validation = \Validator::make($this->input,static::$rules);

        if ($validation->passes())   return true;
        $this->errors = $validation->messages();
        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}