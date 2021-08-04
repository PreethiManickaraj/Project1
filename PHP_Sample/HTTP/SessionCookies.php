<html>
    <head>
        <title>Example</title>
    </head>
    <body>
        <h1>Cookies</h1>
        <?php 
        setcookie("name","Preethi",time() + 20);
        session_start();
        $_SESSION['count'] = ($_SESSION['count']?? 0)+1;
        var_dump($_SESSION);
        unset($_SESSION['count']);
        var_dump($_COOKIE);
        ?>
    </body>
</html>