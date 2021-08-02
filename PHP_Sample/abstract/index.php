<?php 

require_once './field.php';
require_once './text.php';
require_once './boolean.php';
require_once './checkbox.php';
require_once './radio.php';

$fields = [
    //new Field('basefield'),
    new Text('textfield'),
    //new Boolean('booleanfield'),
    new Checkbox('checkboxfield'),
    new Radio('radiofield'),
];

foreach($fields as $i){
    echo $i->render()."<br />";
}