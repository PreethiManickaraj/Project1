<?php
if(count($_POST)>0) {
	require_once '../CRUD/db_connect.php';

    $updatepass = $_POST['updatepass'];

    $updatename = $_POST['updatename'];


    $update = "UPDATE customers SET cpass='$updatepass' where cname='$updatename' ";
    mysqli_query($link,$update);
}
?>