<?php

$contents = file_get_contents("./input.txt");
$items = array_flip(explode("\n", $contents));

foreach ($items as $key => $value) {
    $a = (int) $key;
    $find = 2020 - $a;

    if (array_key_exists($find, $items)) {
        $total = (int) $find * $a;
        print $total . PHP_EOL;
        exit();
    }
}
