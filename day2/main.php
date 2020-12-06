<?php

$contents = file_get_contents("./input.txt");
$items = explode("\n", $contents);

$valid = 0;

$handle = fopen("php://stdin", "r");

foreach ($items as $item) {
    preg_match("/([0-9+]+)-([0-9]+) ([a-zA-Z]): ([a-zA-Z]+)/", $item, $matches);
    list(, $min, $max, $char, $pass) = $matches;

    $charA = $pass[$min - 1];
    $charB = $pass[$max - 1];

    if (($charA === $char || $charB === $char) && $charA !== $charB) {
        echo "VALID" . PHP_EOL;
        echo $item . " " . $charA . " " . $charB . PHP_EOL;
        $line = fgets($handle);
        if (trim($line) === "exit") {
            exit;
        }
    }
}

fclose($handle);

echo $valid . PHP_EOL;
