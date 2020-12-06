<?php

$handle = fopen("php://stdin", "r");
$contents = file_get_contents("./input.txt");

$rows = explode("\n\n", $contents);
$valid = 0;
$validRows = [];

$required = [
    "byr" => function ($val) {
        $val = (int) $val;
        return $val >= 1920 && $val <= 2002;
    },
    "iyr" => function ($val) {
        $val = (int) $val;
        return $val >= 2010 && $val <= 2020;
    },
    "eyr" => function ($val) {
        $val = (int) $val;
        return $val >= 2020 && $val <= 2030;
    },
    "hgt" => function ($val) {
        $unit = substr($val, -2);
        switch ($unit) {
            case "cm":
                $newVal = (int)rtrim($val, "cm");
                return $newVal >= 150 && $newVal <= 193;
                break;
            case "in":
                $newVal = (int)rtrim($val, "in");
                return $newVal >= 59 && $newVal <= 76;
                break;
        }

        return false;
    },
    "hcl" => function ($val) {
        return preg_match("/#[0-9a-fA-F]{6}/", $val);
    },
    "ecl" => function ($val) {
        return in_array($val, ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"]);
    },
    "pid" => function ($val) {
        return preg_match("/^[0-9]{9}$/", $val);
    },
];

foreach ($rows as $rowKey => $row) {
    preg_match_all('/([a-z]+):([^\s]+)/', $row, $matches);
    $fields = array_combine($matches[1], $matches[2]);

    if (count(array_intersect_key($required, $fields)) !== 7) {
        continue;
    }

    $v = array_filter($fields, function ($val, $key) use ($required, $rowKey) {
        if ($key === "cid") {
            return false;
        }

        return !!$required[$key](trim($val));
    }, ARRAY_FILTER_USE_BOTH);

    if (count($v) === 7) {
        array_push($validRows, $row);
        $valid++;
    }
}

echo $valid;
