<?php

require_once '../CRUD/db_connect.php';

$deletename = $_POST['deleterecord'];
echo $deletename;

$delete_query = "DELETE FROM customers WHERE cname='$deletename'";
mysqli_query($link,$delete_query);
