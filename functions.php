<?php

function sum(float ...$arg): float
{
    return array_sum($arg);
}

//echo sum(78, 2676.78, 78);

function power($number1, $number2 = 1)
{
    return $number1 ** $number2;
}

echo power(2, 8);

