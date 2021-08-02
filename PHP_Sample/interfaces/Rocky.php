<?php

class Rocky implements DebtCollector {

    public function collect(float $Owedamount):float{
        
        return $Owedamount*0.65;
    }
}