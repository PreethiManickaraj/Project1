<html>
    <head>
        <title>File System in PHP</title>
    </head>
    <body>
        <h1>File systems</h1>
        <?php
        $dir = scandir(__DIR__);
        var_dump($dir);
        echo "<br>";
        var_dump(is_file($dir[2]));
        echo "<br>";
        var_dump(is_dir($dir[2]));
        echo "<br>";
        if(file_exists('foo1.txt')){
            echo filesize('foo1.txt');
        } else {
            echo " File Not Found";
        }
        echo "<br>";
        @mkdir('tempFiles'); // create directory
        rmdir('tempFiles'); // delete directory
        $file = fopen('foo.txt','r');
        var_dump($file);
        echo "<br>";
        echo file_get_contents('foo.txt');
        echo "<br>";
        $content = file_get_contents('foo.txt',length:5,offset:3);
        echo $content;
        echo "<br>";
        file_put_contents('bar.txt','hello');
        //file_put_contents('bar.txt','world',FILE_APPEND);
        file_put_contents('foo.txt',"Hello World");
        clearstatcache();
        //unlink('bar.txt'); to delete file
        echo filesize('foo.txt')."<br>";
        print_r(pathinfo('FileSystem.php'));
        ?>
    </body>
</html>