<?php
if(count($_POST)>0) {
	require_once '../CRUD/db_connect.php';
    $cname = $_POST['custname'];

    $cpwd = $_POST['custpass'];


    $cmailid = $_POST['email'];


	$query = "INSERT INTO customers(cname,cpass,cemail) VALUES('$cname','$cpwd','$cmailid')";
    mysqli_query($link,$query);

}
?>
<html>
    <head>
        <title>Update</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <header>Update details</header>
        <h1>Update</h1>
        <form name="update" method="POST" action="updateForm.php">
            <p>
                <label for = "updatename">Enter name</label>
                <input type="text" id="updatename" name="updatename">
            </p>
            <p>
                <label for = "updatepass">Enter Password</label>
                <input type = "password" id = "updatepass" name="updatepass">
            </p>
            <button>Update</button>
        </form>
    </body>
</html>