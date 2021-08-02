<?php 


class Invoice {

    public function __construct(public Customer $customer){

    }

    public function process(float $amount):void {
        //generic exception

        /*if($amount <= 0){
            throw new \Exception('Invalid Invoice amount');
        }
        */
        if($amount<=0){
            throw InvalidException::invalidAmount();
        }

        //InvalidArgumentException
        /*if($amount <= 0){
            throw new \InvalidArgumentException('Invalid Invoice Amount');
        }*/

        //CustomExceptions
        /*if (empty($this->customer->getBillingInfo())) {
            throw new \MissingBillingInfoException("Missing Billing Info");
        }*/

        if(empty($this->customer->getBillingInfo())){
            throw InvalidException::missingBillingInfo();
        }

        echo "Processing amount ".$amount." invoice - OK"."<br>";
    }
}