<?php
namespace Istar\Service\Validation;
use Illuminate\Validation\Factory;


/**
 * AbstractValidator
 */

abstract class AbstractValidator implements IValidation {
    protected $validator;

    protected $data = array();

    protected $errors = array();

    protected $rules = array();

    function __construct(Factory $validator) {
        $this->validator = $validator;
    }

    public function with(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function passed()
    {
        $validator = $this->validator->make($this->data,$this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}
