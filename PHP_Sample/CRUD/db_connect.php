<?php 
$link = mysqli_connect('localhost','root',"H@rsha07",'ecommerce');

if(!($link)) {
    die ('Could not connect : '. mysqli_error());
}
//echo "Connected Successfully"."<br>";
