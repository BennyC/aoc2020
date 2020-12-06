<?php

$handle = fopen("php://stdin", "r");
$file = isset($argv[1]) ? $argv[1] : "input.txt";
$passes = explode("\n", file_get_contents($file));
$seats = [];

foreach ($passes as $pass) {

    for ($i = 0; $i < strlen($pass); $i += 1) {
        $rowRange = $rowBounds[1] - $rowBounds[0];
        $colRange = $colBounds[1] - $colBounds[0];

        switch ($pass[$i]) {
            case "F":
                $rowBounds = [$rowBounds[0], $rowBounds[0] + ceil($rowRange / 2) - 1];
                break;
            case "B":
                $rowBounds = [ceil($rowRange / 2) + $rowBounds[0], $rowBounds[1]];
                break;
            case "L":
                $colBounds = [$colBounds[0], $colBounds[0] + ceil($colRange / 2) - 1];
                break;
            case "R":
                $colBounds = [ceil($colRange / 2) + $colBounds[0], $colBounds[1]];
                break;
        }
    }

    $seatId = $rowBounds[0] * 8 + $colBounds[0];
    array_push($seats, $seatId);
}

sort($seats);
$seatRange = range($seats[0], $seats[count($seats) - 1]);
$diff = array_diff($seatRange, $seats);

echo "Missing: " . reset($diff) . PHP_EOL;
echo "Max:" . max(...$seats) . PHP_EOL;
