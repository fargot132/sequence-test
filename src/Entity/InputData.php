<?php

namespace App\Entity;

use App\Validator\Constraints;
use App\Validator\Constraints\NoOfSamples;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class InputData
{
    private $text;
    private $data;
    
    public function __construct()
    {
        $this->text = '';
        $this->data = [];
    }

    public function setText($param)
    {
        if (is_string($param)) {
            $this->text = $param;
            $this->data = $this->processText($param);
        }
    }
    
    public function getText(): string
    {
        return $this->text;
    }

    public function getData(): array
    {
        return $this->data;
    }
    
    private function processText(string $text)
    {
        $exploded = \explode("\n", $text);
        
        
        foreach ($exploded as $key => $value) {
            $value = str_replace(["\n","\r"," "], '', $value);
            if (empty($value)) {
                unset($exploded[$key]);
            } else {
                $exploded[$key] = $value;
            }
        }
        
        return $exploded;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('data', new NoOfSamples());
    }
}
