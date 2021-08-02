<?php

class DebtService {

    public function collectDebt(DebtCollector $collector) {

        $Owedamount = mt_rand(100,1000);
        $collectedAmount = $collector->collect($Owedamount);

        echo "Collected ".$collectedAmount." out of ".$Owedamount;
    }
}