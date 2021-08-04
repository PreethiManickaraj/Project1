<?php 

include './auto/auto.php';

$Cat = new Cat('Cat',3);
$Cat->getCat();

$Dog = new Dog("Dog",4);
$Dog->getDog();

$Transaction = new Transaction(20);
$Transaction->getAmount();