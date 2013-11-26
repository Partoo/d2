<?php
namespace Istar\Service\Validation;


/**
 * IValidation
 */

interface IValidation {

    public function with(array $input);

    public function passed();

    public function errors();

}