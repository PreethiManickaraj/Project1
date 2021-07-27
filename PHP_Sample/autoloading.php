<?php
// autoloading
//require_once '../PHP_Sample/ExamClass.php';
//require_once '../PHP_Sample/ExamObject.php';
spl_autoload_register(function ($class1) {
    //$path = __DIR__ .'/../'.'.php';
    $path = '../'.str_replace('\\','/',$class1).'.php';
    require $path;
    //var_dump($path);
});
use PHP_Sample\ExamClass;

$app = new ExamClass();
var_dump($app);
