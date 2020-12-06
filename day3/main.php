<?php

$handle = fopen("php://stdin", "r");

$contents = file_get_contents("./input.txt");
$rows = explode("\n", $contents);

$increments = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];

$width = strlen($rows[0]);
$results = [];

foreach ($increments as $inc) {
    $treeCount = 0;
    $curr = [0, 0];

    while ($curr[1] < count($rows)) {
        $row = $rows[$curr[1]];
        if ($row[$curr[0] % $width] === "#") {
            $treeCount += 1;
        }

        $curr = [$curr[0] + $inc[0], $curr[1] + $inc[1]];
    }

    array_push($results, $treeCount);
}

fclose($handle);

$first = array_shift($results);
echo array_reduce($results, function ($carry, $next) {
    return $carry * $next;
}, $first) . PHP_EOL;
