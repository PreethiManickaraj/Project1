<html>
    <head>
        <title>Functions</title>
    </head>
    <body>
        <h1>Functions</h1>
        <?php
            //declaring and calling functions
            function name(){
                return "Preethi";
            }
            //name();
            $x = name();
            echo $x;
            echo "<br>";
            //another way
            //echo name();
            //functions inside function
            function foo() {
                echo 'Foo';
                function bar() {
                    echo 'Bar';
                }
            }
            foo();
            bar();// we can't call bar function without calling foo function.
            //declaring return type
            function number(): int {
                return 1;
            }
            $y=number();
            echo "<br>";
            var_dump($y);
            /*function num(): int | float {   // accepts both int and float
                return 1.5;
            }
            echo "<br>";
            var_dump(num());
            function num(): mixed {   // accepts any data types
                return 1.5;
            }
            echo "<br>";
            var_dump(num());  */ 
        ?>
        <h2>Function Parameters and named arguments</h2>
        <?php  
            function score($x,$y){   //parameters
                return $x * $y;
            }
            echo score(3,4);//arguments
            echo "<br>";
            //optional arguments 
            function exam($s,$t=10){
                return $s * $t;
            }
            echo exam(3);
            echo "<br>";
            //passing by reference
            function example(&$x,$y){
                if($x%2 === 0){
                    $x /=2;
                }
                return $x*$y;
            }
            $a = 6;
            $b = 3;
            echo example($a,$b);
            echo "<br>";
            //variadic functions and splat operator
            function sum($x,$y,...$numbers){
                $sum = 0;
                foreach($numbers as $num){
                    $sum += $num;
                }
                return $sum;
            }
            $a = 6;
            $b = 4;
            echo sum($a,$b,4,5,6,20);
            echo "<br>";
            //unpack arrays
            function sums($x,$y,...$number){
                $sum = 0;
                foreach($number as $num){
                    $sum += $num;
                }
                return $sum;
            }
            $a = 6;
            $b = 4;
            $number = [4,20,3,4];
            echo sums($a,$b,...$number);
            echo "<br>";
            //named arguments (PHP -8)
            /*function run($a,$b){
                return $a + $b;
            }
            echo run(a:3,b:5);*/
        ?>
        <h2>Variable functions</h2>
        <?php 
            function sum1($x,$y){
                return $x + $y;
            }
            $n = 'sum1';
            //echo $n(4,5);*/
            if(is_callable($n)){
                echo $n(4,5);
            } else {
                echo "Not callable";
            }
        ?>
        <h2>Anonymous function(lamda function)</h2>
        <?php
            $k = 1;
            $sum2 = function($x,$y) use(&$k){ // using use keyword to use variables as local variables inside anonymous(closure)
                echo $k +2; 
                $k = 4;  // it is copied (also use reference to change the value outside also)
                echo "<br>";
                return $x+$y;
            };
            echo $k;
            echo "<br>";
            echo $sum2(1,2);
            echo "<br>";
            //callback function
            $call = function(callable $callback,...$number1) {
                return $callback(array_sum($number1));
            };
            echo $call (function($element){
                return $element * 2;
            },1,2,3,4);
            //arrow functions
            $arr = [1,2,3,4];
            $arr1 = array_map(fn($num2)=> $num2 * $num2,$arr);
            echo "<br>";
            echo '<pre>';
            print_r($arr1);
            echo '<pre>';
        ?>
    </body>
</html>