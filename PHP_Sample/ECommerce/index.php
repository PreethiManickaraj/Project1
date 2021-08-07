<html>
    <head>
        <title>ECommerce Login</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <header>Login</header>
        <h1>Fill the credentials</h1>
        <div>
            <form name = "login" method = "POST" action = "login.php">
                <p>
                    <label for = "custname">Enter your name</label>
                    <input type = "text" id="custname" name = "custname">
                </p>
                <p>
                    <label for = "custpass">Enter Password</label>
                    <input type = "password" id = "custpass" name="custpass">
                </p>
                <p>
                    <label for ="email">Enter Email id</label>
                    <input type="email" id = "email" name="email">
                </p>
                <button>Login</button>
            </form>
        </div>
    </body>
</html>