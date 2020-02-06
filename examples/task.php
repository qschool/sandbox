<?php

function example_task($n)
{
    $sum = 0;

    for ($i = 0; $i <= $n; $i++) {
        $sum += $i;
        echo $i . PHP_EOL;
    }

    return $sum + 100;
}
