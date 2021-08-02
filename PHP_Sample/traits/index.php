<?php 

require_once './CoffeeMaker.php';
require_once './CapuccinoMaker.php';
require_once './TeaMaker.php';
require_once './AllMaker.php';

$CoffeeMaker = new CoffeeMaker();
$CoffeeMaker->makeCoffee();

$TeaMaker = new TeaMaker();
$TeaMaker->makeCoffee();
$TeaMaker->makeTea();

$CapuccinoMaker = new CapuccinoMaker();
$CapuccinoMaker->makeCoffee();
$CapuccinoMaker->makeCapuccino();

$AllMaker = new AllMaker();
$AllMaker->makeCoffee();
$AllMaker->makeTea();
$AllMaker->makeCapuccino();
