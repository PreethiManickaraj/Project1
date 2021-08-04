<?php 

spl_autoload_register('autoloader');

function autoloader($className){
     $path = "classes/";
     $extension = ".php";
     $FullPath = $path.$className.$extension;

     include_once $FullPath;
}