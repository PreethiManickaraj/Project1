<?php

class AnotherCollector implements DebtCollector {

    public function collect(float $Owedamount):float{
        
        return $Owedamount*0.65;
    }
}