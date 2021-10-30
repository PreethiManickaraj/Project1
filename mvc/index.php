<?php

// Setting encoding for string functions
mb_internal_encoding("UTF-8");

session_start();

// Callback for autoloading controllers and models
spl_autoload_register("autoloadFunction");

function autoloadFunction($class)
{
    // if ends with "Controller" takes from controllers folder otherwise models folder
    if (preg_match('/Controller$/', $class))
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}

// instance for router
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();