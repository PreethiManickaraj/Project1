<?php 

include_once './db_connect.php';

$update_query = "UPDATE customer SET cust_id = '102'";

mysqli_query($link,$update_query);

printf("New record has updated");