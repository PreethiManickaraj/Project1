<?php

namespace PHP_Sample\Example2;

class Transaction {

    public int $amount;

    public function __construct($amount){
        $this->amount = $amount;
    }
    public function getAmount(){
        echo $this->amount;
    }

}