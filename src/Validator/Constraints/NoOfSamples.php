<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoOfSamples extends Constraint
{
    public $message = 'Wprowadzono więcej niż 10 próbek';
}
