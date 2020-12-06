<?php

$file = isset($argv[1]) ? $argv[1] : "input.txt";
$groups = explode("\n\n", file_get_contents($file));

$answers = array_map(function ($g) {
    $people = substr_count($g, "\n") + 1;
    $answerCounts = count_chars($g, 1);

    $k = array_map(function ($a) use ($people) {
        return $people === $a ? 1 : 0;
    }, $answerCounts);

    return array_sum($k);
}, $groups);

function solutionOne(array $groups)
{
}

function solutionTwo(array $groups)
{
}

echo "Part One: " . solutionOne($groups) . PHP_EOL;
echo "Part Two: " . solutionTwo($groups) . PHP_EOL;

echo array_sum($answers) . PHP_EOL;
exit;
