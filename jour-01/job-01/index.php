<?php
$haystack = "C'est la rentrée à la Plateforme";
$needle = "a";
function my_str_search(string $haystack, string $needle)
{
    $count = 0;
    for ($x = 0; isset($haystack[$x]); $x++) {
        if ($haystack[$x] == $needle) {
            $count++;
        }
    }
    echo 'La lettre' . ' ' . $needle . ' ' . 'est présente' . ' ' . $count . ' ' . 'fois dans la phrase' . ' ' . $haystack;
}
my_str_search($haystack, $needle);
