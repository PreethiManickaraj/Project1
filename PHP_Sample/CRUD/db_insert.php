<?php 

include_once './db_connect.php';

$query = "INSERT INTO customer VALUES('101','Pree','preethi@gmail.com')";
mysqli_query($link,$query);

printf("New record has ID %d.\n", mysqli_insert_id($link));