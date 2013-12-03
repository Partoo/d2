<?php
namespace Istar\Service\Form\Document;

use Istar\Service\Validation\AbstractValidator;


/**
 * DocumentFormValidator
 */

class DocumentFormValidator extends AbstractValidator {
        protected $rules = array(
                'subject' => 'required',
                'tags' => 'required',
                // 'docnumber' => 'required|unique:documents',
                'recievers'=>'required',
            );
}