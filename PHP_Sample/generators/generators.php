<?php 

//yield keyword

function generator(){
    for($i=1;$i<=3;$i++){
        yield $i;
    }
}

$generator = generator();
foreach($generator as $value){
    echo $value."<br>";
}

//yielding values with keys 

$input = <<<heredoc
1;PHP;Likes dollar signs
2;Python;Likes whitespace
3;Ruby;Likes blocks
heredoc;

function Generator1($input) {
    foreach (explode("\n", $input) as $line) {
        $fields = explode(';', $line);
        $id = array_shift($fields);

        yield $id => $fields;
    }
}

foreach (Generator1($input) as $id => $fields) {
    echo $id.':' ."<br>";
    echo $fields[0]."<br>";
    echo $fields[1]."<br>";
}

// yield from

function count_to_ten() {
    yield 1;
    yield 2;
    yield from [3, 4];
    yield from new ArrayIterator([5, 6]);
    yield from seven_eight();
    return yield from nine_ten();
}

function seven_eight() {
    yield 7;
    yield from eight();
}

function eight() {
    yield 8;
}

function nine_ten() {
    yield 9;
    return 10;
}

$gen = count_to_ten();
foreach ($gen as $num) {
    echo "$num ";
}
echo $gen->getReturn();
