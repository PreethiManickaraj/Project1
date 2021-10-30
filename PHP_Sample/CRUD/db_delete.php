<?php 

include_once './db_connect.php';

$delete_query = "DELETE FROM customer WHERE cust_id = '102'";

mysqli_query($link,$delete_query);

printf("Records deleted Successfully");