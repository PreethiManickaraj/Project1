<?php 

$arr = array("First"=>1,"Second"=>2);
print_r(array_change_key_case($arr,CASE_UPPER));

$arr1 = array('a','b','c');
echo "<br>";
print_r(array_chunk($arr1,2));
echo "<br>";
print_r(array_chunk($arr1,2,true));
echo"<br>";

$arr2 = array(
    array(
        "id"=>233,
        "name"=>"Priya",
    ),
    array(
        "id"=>344,
        "name"=>"Kavi",
    )
);
$names=array_column($arr2,'name');
print_r($names);
echo "<br>";

$id = array(1,2,3);
$name = array("apple","orange","Banana");
$combine = array_combine($id,$name);
print_r($combine);
echo "<br>";

$count = array(1,1,'hello','hello','Hi');
print_r(array_count_values($count));
echo "<br>";

$a = array_fill(5, 6, 'banana');
$b = array_fill(-2, 4, 'pear');
print_r($a);
echo "<br>";
print_r($b);
echo "<br>";

$input = array('a','b','c');
print_r(array_flip($input));

