<?php 

class Cat {

    public $name;
    public $age;

    public function __construct($name,$age){
        $this->name = $name;
        $this->age = $age;
    }
    public function getCat(){
        echo $this->name ." is ".$this->age." years old"."<br>";
    }
    
}