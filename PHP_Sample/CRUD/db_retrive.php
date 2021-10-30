<?php 

include_once './db_connect.php';

$select_query = "SELECT * FROM customer";

$result = mysqli_query($link, $select_query);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "Cust ID:" . $row['cust_id'] . "<br/>";
    echo "Name:" . $row['cus_name'] . "<br/>";
    echo "Email:" . $row['email'] . "<br/>";
    echo "<br/>";
}