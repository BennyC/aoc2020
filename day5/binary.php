<?php

$handle = fopen("php://stdin", "r");
$file = isset($argv[1]) ? $argv[1] : "input.txt";
$passes = explode("\n", file_get_contents($file));
$seats = [];

foreach ($passes as $pass) {
    $row = str_replace(["F", "B"], [0, 1], substr($pass, 0, -3));
    $col = str_replace(["L", "R"], [0, 1], substr($pass, -3));

    $seatId = bindec($row) * 8 + bindec($col);
    array_push($seats, $seatId);
}

sort($seats);
$seatRange = range($seats[0], $seats[count($seats) - 1]);
$diff = array_diff($seatRange, $seats);


echo "Missing: " . reset($diff) . PHP_EOL;
echo "Max: " . $seats[count($seats) - 1] . PHP_EOL;
