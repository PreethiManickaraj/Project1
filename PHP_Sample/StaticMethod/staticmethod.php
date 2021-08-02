<?php 

class StaticMethod {

    public static function run(){
        echo "Success"."<br>";
    }
}

// calling static method without instantiate object
StaticMethod::run();
$classname = 'StaticMethod';
$classname::run();
