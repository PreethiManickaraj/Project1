<?php 

include_once './dbConnect.php';
include_once './Test.php';

?>
<html>
    <head>
        <title>OOPs</title>
    </head>
    <body>
        <?php 
            //show users
            $testobj = new Test();
            $testobj->setUser('Priya','prya','priya@gmail.com');
        ?>
    </body>
</html>