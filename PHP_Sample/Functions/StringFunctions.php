<?php 

$str = 'Hello World';
$CSlashes = addcslashes($str,'W');
$addSlashes = addslashes('name is "Preethi"');
$binaryToHexa = bin2hex("Hello");
echo $CSlashes."<br>";
echo $addSlashes."<br>";
echo $binaryToHexa."<br>";
$chop = 'Hi Hello';
echo chop($chop,"Hello")."<br>";
echo chr(52)."<br>";
echo chr(052)."<br>";
echo chr(0x52)."<br>";
echo chr(99)."<br>";
$chunkSpilt = "Hello World";
echo chunk_split($chunkSpilt,1,".")."<br>";
$count_char = "Hello World!";
echo count_chars($count_char,3)."<br>";
$explode = "Hi Hello Welcome";
print_r(explode(" ",$explode));
echo "<br>";
$implode = array("1","2","3");
echo implode(",",$implode)."<br>";
$join = array("Hello","world");
echo join(" ",$join)."<br>";
echo lcfirst("Example")."<br>";
$ltrim = "Hello World";
echo ltrim($ltrim,"Hello")."<br>";
echo nl2br("Preethi\nManickaraj")."<br>";
echo number_format(1000000)."<br>";
echo ord("j")."<br>";
$rtrim = "Hello World";
echo rtrim($rtrim,"World")."<br>";
echo str_ireplace("World","Preethi","Hello Hi World")."<br>";
$str_pad = "Hello";
echo str_pad($str_pad,20,",")."<br>";
echo str_repeat("Hi ",3)."<br>";
echo str_shuffle("Hello World")."<br>";
echo str_word_count("Hello Hi Str")."<br>";
echo strcasecmp("Hi","Hi")."<br>";
echo strchr("Hello world","world")."<br>";
echo strcmp("Hi","hi")."<br>";
echo strcspn("Hello world!","w")."<br>";
echo strpos("Hello PHP","PHP")."<br>";
echo strlen("HTML")."<br>";
echo strripos("I love php, I love php too!","PHP")."<br>";
$string = "PHP,HTML,CSS";
 $token = strtok($string, ",");
 
while ($token !== false)
   {
   echo "$token<br>";
   $token = strtok(",");
   }