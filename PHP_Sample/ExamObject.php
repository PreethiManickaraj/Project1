<?php
    // creating class and object
class Simple {
    public $var = 1;

    public function name(){
        echo $this->var;
    }
}
$object1 = new Simple();

// creating instance with variables
$className = 'Simple';
$object2 = new $className();

//property access and method call
echo $object1 -> var;
echo "<br>";
echo $object2 -> name();

// object assignment
$instance = new Simple();
$assigned = $instance;
$reference = &$instance;
$instance -> var = 'Value assigned';
$instance = null;
echo "<br>";
var_dump($instance);
echo "<br>";
var_dump($assigned);
echo "<br>";
var_dump($reference);

// ways of creating objects
class Test {
    static public function New() {
        return new static;
    }
}
class child extends Test
{ }
$obj1 = new Test();
$obj2 = new $obj1;
echo "<br>";
var_dump($obj2);
echo "<br>";
var_dump($obj1 !== $obj2);
$obj3 = Test::New();
echo "<br>";
var_dump($obj3 instanceof Test);
$obj4 = child::New();
echo "<br>";
var_dump($obj4 instanceof child);

// access in single expression
echo "<br>";
echo(new DateTime())-> format('Y');

// calling an anonymous function
class Foo{
    public $bar;
    public function __construct(){
        $this->bar = function(){
            return 20;
        };
    }
}
$obj5 = new Foo();
echo "<br>";
echo($obj5->bar)();

// extends keyword
class ExtendClass extends Simple {
    public function display(){
        echo "Extended class\n";
        parent::name();
    }
}
echo "<br>";
$extended = new ExtendClass();
$extended->display();

// class constants
class Name {
    const CONSTANT = "constant value";
    function DisplayConstant() {
        echo "<br>";
        echo self::CONSTANT;
    }
}
echo "<br>";
echo Name::CONSTANT;
//or
/*$Class = "Name";
echo "<br>";
echo $Class::CONSTANT;
$a = new Name();
$a -> DisplayConstant();
echo "<br>";
echo $a::CONSTANT;*/

// constructor
class BaseClass {
    function __construct(){
        echo "<br>";
        print "In BaseClass constructor";
    }
}
class ExtendClass1 extends BaseClass {
    function __construct(){
        parent::__construct();
        echo "<br>";
        print "In ExtendClass";
    }
}
class SubClass extends ExtendClass1{

}
$ob = new BaseClass();
$ob1 = new ExtendClass1();
$ob2 = new SubClass();

// using arguments 
class Sum {
    private int $x;
    private int $y;

    public function __construct(int $x, int $y = 2){
        $this->x = $x;
        $this->y = $y;
    }
    public function getValue(){
        echo $this->x;
        echo "<br>";
        echo $this->y;
    }
}
echo "<br>";
$S = new Sum(4,5);
//or 
echo "<br>";
$S1 = new Sum(4); // optional y
$S1->getValue();
// named parameter in 8.0
//$s2 = new Sum(x:5, y:6);

// constructor promotion
/* Class Point {
    public function __construct(int $x, int $y=2){

    }
} */    // short hand usecase

// Destructor
class MyClass {
    public function __construct(){
        echo "<br>";
        print "In construct Class";
        echo"<br>";
    }
    public function __destruct(){
        exit;
        print "Destructed";
    }
}
$desc = new MyClass();

// visibility

class MyClass1
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$objt = new MyClass1();
echo $objt->public; 
//echo $objt->protected; 
//echo $objt->private; 
//$objt->printHello(); 


class Test1
{
    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    private function bar()
    {
        echo 'Accessed the private method.';
    }

    public function baz(Test1 $other)
    {
        // We can change the private property:
        $other->foo = 'hello';
        var_dump($other->foo);

        // We can also call the private method:
        $other->bar();
    }
}
$test = new Test1('test');
echo"<br>";
$test->baz(new Test1('other'));