<html>
    <head>
        <title>Basics</title>
    </head>
    <body>
        <h1><center>PHP Basics</center></h1>
        <p>This is example</p>
        <?php
            echo("Hello world!");// syntax
            /*Multi line comment */
        ?>
        <?php echo("Hello");?>
        <?= "Hi" // Short hand echo?>
        <h1>Data types</h1>
        <h2>Boolean</h2>
        <?php 
            $var = true;
            echo gettype($var);//return data type
            echo "<br>";
            var_dump((bool) "");// return false
            echo "<br>";
            var_dump((bool)(NULL));// return false
            echo "<br>";
            var_dump((bool)(0));//return false
            echo "<br>";
            if($var == true){
                echo("Yes");
            }
            else {
                echo("No");
            }
        ?>
        <h2>Integers</h2>
        <?php
        $a = 5; // return 5 (decimal)
        $b = 0b110; // return 6 (binary) 
        $c = 042; // return  (octal)
        $d = 0x2A; // return  (hexadecimal)
        $e = 2_00_000; //(readable integer)
        $f =(int) 3.9; // returns int - 5( type casting)
        echo $f;
        $g= PHP_INT_MAX; // determine max value 
        var_dump($f);
        ?>
        <h2>Float</h2>
        <?php
            $a = 8; // float
            $b = (float) $a; // type casting
            echo $b;
            /*if(is_nan($b)){    //nan function
                echo "yes";
            } else {
                echo "no";
            }
            if(is_infinite($b)){   // INF function
                echo "yes";
            } else {
                echo "no";
            }*/
        ?>
        <h2>Strings</h2>
        <?php
            $firstname = 'Preethi'; //single quote
            $lastname = 'Manickaraj'; 
            $dquote = "{$firstname} Manickaraj"; //double quotes(can use variables)
            $name = $firstname. " ".$lastname;
            echo $name[1]; //index
            echo $name[-1]; // from last
            $name[1] = 'p'; // changes to 'p'
            // heredoc
            $x=9;
            $y=8; // can include variables
            $text = <<<NAME
            Hi $x
            Hi $y
            Hiii
            NAME;
            echo nl2br($text);
            // nowdoc (cannot include variables)
            $text1 = <<<'NAME1'
            Hi 
            Hii
            Hiii
            NAME1;
            echo nl2br($text1);
        ?>
        <h2>Arrays</h2>
        <?php
            // ways of declaring array
            $arr = array(1,2,3); // old method
            $arr = [1,2,3];
            $arr = [
                'php' => 1,
                'python' => 2
            ];
            //to check datatype
            var_dump($arr);
            //to print in another way
            print_r($arr);
            echo "<pre>";
            print_r($arr);
            echo "<pre>";
            //changing values
            $array = [1,2,3];
            $array[1] = 'java';
            print_r($array);
            //to check the key is present or not
            var_dump(isset($array[1]));
            var_dump(array_key_exists('php',$arr));
            // to find length of array
            echo count($arr);
            //pushing elements to array
            $array[] = "python"; // add to last of array
            array_push($array,'Ruby','go'); // add to last 
            print_r($array);
            // using keys and values pair
            //adding elements
            $arr['go'] ='1.15';
            print_r($arr);
            //accessing using keys name
            echo $arr['go'];
            // adding variables inside array
            $newlang = 'C';
            $arr[$newlang]= '0';
            print_r($arr);
            //overwritten concept
            $array1 = [0 => 'zero', 1 => 'one','1' => 'first'];//overwrite 1 -first
            print_r($array1);
            $array2 = [true => 'bool', 1 => 'one',1.1 =>'first']; //keys accepts only int and strings (true=1) 1.1->1
            print_r($array2);
            // multi dimensional array (values is of any datatype)
            $pl = [
                'PHP' => [
                    'creator' => 'Rasaus Lerdorf',
                    'extension'=>'.php',
                    'versions' => [
                        ['version'=>8,'release' => 'Nov 26,2020'],
                        ['version'=>7.4,'release'=>'Nov 28,2019'],
                    ],
                ],
                'Python' => [
                    'creator' => 'Guido Van Rossum',
                    'extension'=>'.py',
                    'versions' => [
                        ['version'=>3.9,'release' =>'Oct 5,2020'],
                        ['version'=>3.8,'release' =>'Oct 14,2019'],
                    ],
                ],
            ];
            //accessing multi-dimensional arrays
            echo $pl['PHP']['extension'];
            echo "<br>";
            //subarrays
            echo $pl['PHP']['versions'][0]['release'];
            echo "<br>";
            //casting to array
            $x = 5;
            var_dump((array)$x);
        ?> 
        <h2>Objects</h2>
        <?php
            class fruit {
                public $name;
                function set_name($n){
                    $this->name = $n;
                }
                function get_name(){
                    return $this->name;
                }
            }
            $apple = new fruit();
            $apple->set_name('apple');
            echo "Fruit name is ".$apple->get_name()."<br>";
            //we can create multiple objects
            $grapes = new fruit();
            $grapes->set_name('grapes');
            echo "Fruit name is ".$grapes->get_name()."<br>"; 
        ?>
        <h2>Constants</h2>
        <?php
            //define function
            define('STATUS','PAID');
            echo STATUS;
            //const keyword
            echo "<br>";
            const value = 'assigned';
            echo value;
            //another way in define
            echo "<br>";
            $paid = "PAID";
            define('STATUS_'.$paid,$paid);
            echo STATUS_PAID;
            echo "<br>";
            echo defined('value');
            echo"<br>";
            //predefined and magical constants
            echo PHP_VERSION;
            echo "<br>";
            echo __LINE__;
            echo "<br>";
            echo __FILE__;
            //variable variables
            $foo = 'bar';
            $$foo = 'box';
            echo "<br>";
            echo $bar;
        ?>
        <h1>Operators</h1>
        <h2>Arithmetic operators</h2>
        <?php
            // (+ , - , /, % , **, Identity(prefix (+)),Negation(prefix (-)))
            $a = 1;
            $b = 8;
            var_dump($a+$b); // return int(9)
            var_dump($a - $b); // return int(7)
            var_dump($a / $b); // return float(0.125)
            var_dump($a % $b); // return int(1)
            var_dump(-$a % $b); // return int(-1)
            var_dump($b / 4); // return int(2)
            var_dump($a ** $b); // return int(1)
            var_dump(-$a + -$b); // return int(-9)
            //var_dump(fdiv($a,$b)); // supports in php8
            var_dump($a !== $b);
        ?>
        <h2>Assignment operators</h2>
        <?php
            // == , ===, +=, -=, %=,/=, **=
            $x = 1;
            $y = 2;
            $a = $b = 4;
            $c = 5;
            $c = '5';
            var_dump($c==$c);
        ?>
    </body>
</html>