<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SequenceTextarea extends Constraint
{
    public $message = 'Wprowadzono więcej niż 10 wierszy';
}
