<?php

namespace App\Entity;

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
    
    public function getText() : string
    {
        return $this->text;
    }

    public function getData() : array
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
    
}
