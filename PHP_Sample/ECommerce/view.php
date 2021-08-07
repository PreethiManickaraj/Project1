<?php
require_once '../CRUD/db_connect.php';
$select_query = "SELECT * FROM customer";
$result = mysqli_query($link,$select_query);
?>
<html>
    <head>
        <title>Customer Records</title>
        <link rel="stylesheet" href="view.css">
    </head>
    <body>
        <header>Customer Details</header>
        <form name="login" method="POST" action = "login.php">
            <div>
                <table style="width:100%">
                    <tr>
                        <th>Customer_Name</th>
                        <th>Customer_Password</th>
                        <th>Email</th>
                    </tr>
                    <?php
		            $i=0;
		            while($row = mysqli_fetch_array($result)) {
		            if($i%2==0)
		            $classname="evenRow";
		            else
		            $classname="oddRow";
		            ?>
			        <tr class="<?php if(isset($classname)) echo $classname;?>">
				        <td><?php echo $row["custname"]; ?></td>
				        <td><?php echo $row["custpass"]; ?></td>
				        <td><?php echo $row["email"]; ?></td>
			        </tr>
		            <?php
		            $i++;
		            }
		            ?>
                </table>
            </div>
        </form>
    </body>
</html>