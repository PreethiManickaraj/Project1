<?php

require_once './Example1/Transaction.php';
require_once './Example2/Transaction.php';
require_once './Example1/Profile.php';

use PHP_Sample\Example1/*\{Transaction, Profile}*/; 
use PHP_Sample\Example2\Transaction as Example2Transaction;
use PHP_Sample\Example1\Profile;

$Example1Transaction = new Example1\Transaction();
$Example2Transaction = new Example2Transaction(20);
$profile = new Profile();

//var_dump(new PHP_Sample\Example1\Transaction());
//var_dump(new PHP_Sample\Example2\Transaction());

var_dump($Example1Transaction,$Example2Transaction,$profile);