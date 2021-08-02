<?php 

require_once './Customer.php';
require_once './Invoice.php';
require_once './MissingBillingInfoException.php';
require_once './InvalidException.php';

//$invoice = new Invoice(new Customer());
/*try{
    $invoice->process(5);
} catch (MissingBillingInfoException | InvalidArgumentException $e){
    echo $e->getMessage()."<br>";
} */
set_exception_handler(function (\Throwable $e){
    var_dump($e->getMessage());
});
echo array_rand([1],1);

$invoice = new Invoice(new Customer());
$invoice->process(-25);