<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use App\Entity\InputData;

// validate row count
class SequenceTextareaValidator extends ConstraintValidator
{
    
    public function validate($value, Constraint $constraint)
    {
        
        if (!$constraint instanceof SequenceTextarea) {
            throw new UnexpectedTypeException($constraint, SequenceTextarea::class);
        }

        if (null === $value || '' === $value) {
            return;
        }
        
        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }
        
        $input = new InputData();
        $input->setText($value);
        
        if (\count($input->getData()) > 10) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
