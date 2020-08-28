<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NoOfSamplesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        
        if (!$constraint instanceof NoOfSamples) {
            throw new UnexpectedTypeException($constraint, NoOfSamples::class);
        }

        if (null === $value || '' === $value) {
            return;
        }
        
        if (!is_array($value)) {
            throw new UnexpectedValueException($value, 'array');
        }
        
        if (\count($value) > 10) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
