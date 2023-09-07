<?php

function my_str_reverse(string $string) : string {

$count = 0;
$stringLenght = 0;
while(isset($string[$count])) {
    $stringLenght++;
    $count++;
}

$reverseString = "";

    for($i = $stringLenght; $i > 0; $i--) {
        // echo $string[$i - 1];
        $reverseString .= $string[$i - 1];
    }
    return $reverseString;
}

echo my_str_reverse("Hello LaPlateforme!");
