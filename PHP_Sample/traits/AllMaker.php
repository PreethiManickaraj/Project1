<?php 

require_once './CoffeeMaker.php';

class AllMaker extends CoffeeMaker {

    use TeaTrait;
    use CapuccinoTrait;
}