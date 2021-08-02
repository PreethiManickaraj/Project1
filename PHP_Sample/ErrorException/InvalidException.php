<?php 

class InvalidException extends \Exception{

    public static function invalidAmount(){
        return new static("Invalid Invoice Amount");
    }
    
    public static function missingBillingInfo(){
        return new static("Missing Billing Information");
    }
}