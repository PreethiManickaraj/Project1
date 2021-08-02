<?php

require_once './Toaster.php';
require_once './Toasterpro.php';

$toaster = new Toaster();
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster -> toast();
$toaster1 =  new Toasterpro();
$toaster1->addSlice('bread1');
$toaster1->addSlice('bread1');
$toaster1->addSlice('bread1');
$toaster1->addSlice('bread1');
$toaster1->toast();
$toaster1->toastfast();