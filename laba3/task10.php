<?php
function isSumGreaterThanTen($num1, $num2): int|float
{
    return ($num1 + $num2) > 10;
}
echo isSumGreaterThanTen(3, 8);

function areNumbersEqual($num1, $num2)
{
    return $num1 === $num2;
}
echo areNumbersEqual(4, 4), "\n";

$test = 0;
echo ($test == 0) ? 'верно' : '', "\n";

$age = 52;
if ($age < 10 || $age > 99) {
    echo "число меньше 10 или больше 99\n";
} else {
    $sum = array_sum(str_split((string)$age));
    if ($sum <= 9) {
        echo "сумма однозначна\n";
    } else {
        echo "сумма двузначна\n";
    }
}

$arr = [1, 2, 3];
if (count($arr) == 3) {
    echo "сумма элементов массива: " . array_sum($arr) . "\n";
}