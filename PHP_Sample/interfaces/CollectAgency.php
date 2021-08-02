<?php 

//namespace interfaces;
require_once './DebtCollector.php';

class CollectAgency implements DebtCollector {

    public function collect(float $Owedamount):float {

        $guaranteed = $Owedamount * 0.5;
        return mt_rand($guaranteed,$Owedamount);

    }
}