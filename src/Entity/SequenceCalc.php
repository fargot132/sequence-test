<?php

namespace App\Entity;

use App\Entity\InputData;

class SequenceCalc
{
    // sequence array
    protected $sequence;    
    // output table
    protected $table;
    // max n of sequence
    protected $nmax;
    protected $input;
    
    
    public function __construct(InputData $data)
    {
        $this->sequence = array();
        $this->numbers = array();
        $this->table = array();
        $this->nmax = 99999;
        $this->input = $data;
    }
    
    public function initSequence()
    {
        // sequence array init
        $this->sequence = array(0, 1);
        
        // loop to fill sequence array
        for ($n = 2; $n <= $this->nmax; $n++) {
             $isOdd = $n % 2;
             $i = ($n - $isOdd) / 2;
             
            if ($isOdd) {
                // odd sequence
                $w = $this->sequence[$i] + $this->sequence[$i + 1];
            } else {
                // even sequence
                $w = $this->sequence[$i];
            }
            // append to sequence
            $this->sequence[] = $w;
        }
    }
    
    // get max from sequence
    protected function getMax($input)
    {
        $max_val = 0;
        for ($m = 0; $m <= $input; $m++) {
            if ($max_val < $this->sequence[$m]) {
                $max_val = $this->sequence[$m];
            }
        }
        return $max_val;
    }
    
    public function processData()
    {
        $this->initSequence();
        foreach ($this->input->getData() as $txt) {
            $testOK = true;
            $result = '';
            
            // is text digit
            if (ctype_digit($txt)) {
                $number = intval($txt);
            } else {
                $testOK = false;
                $result = "Nie jest liczbą całkowitą";
            }
            
            // is number in range
            if ($testOK) {
                if ($number > 0 && $number <= $this->nmax) {
                    $result = $this->getMax($number);
                } else {
                    $result = "Liczba poza zakresem";
                }
            }
            
            $this->table[] = [$txt,$result];
        }
    }
    
    public function getResult()
    {
        return $this->table;
    }
}
