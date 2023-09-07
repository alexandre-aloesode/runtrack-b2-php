<?php

function my_fizz_buzz(int $length) : array {
$table = [];
    for($x = 1; $x <= $length; $x++) {
        
        $x % 3 == 0 && $x % 5 == 0 ? $table[] = "FizzBuzz"
        : 
        ($x % 3 == 0 ? $table[] = "Fizz"
        : 
        ($x % 5 == 0 ? $table[] = "Buzz"
        : 
        $table[] = $x));

    }
    return $table;
}

$array = my_fizz_buzz(100);

for($x = 0; isset($array[$x]); $x++) {
    echo $array[$x] . "<br>";
}

var_dump(fn($x) => $x * 2);
?>