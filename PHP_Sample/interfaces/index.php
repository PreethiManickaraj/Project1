<?php

require_once './CollectAgency.php';
require_once './DebtCollector.php';
require_once './DebtService.php';
require_once './Rocky.php';

$service = new DebtService();

echo $service -> collectDebt(new CollectAgency());