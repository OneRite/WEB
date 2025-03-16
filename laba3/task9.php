<?php
// Заполнение массива 'x', 'xx', 'xxx' и так далее
$arr = [];
for ($i = 1; $i <= 5; $i++) {
    $arr[] = str_repeat('x', $i);
}
print_r($arr);

// Функция для заполнения массива заданным значением
function arrayFill($value, $count) {
    return array_fill(0, $count, $value);
}

// Пример вызова arrayFill
print_r(arrayFill('x', 5));

// Создание двумерного массива с помощью двух циклов
$matrix = [];
$num = 1;
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $matrix[$i][$j] = $num++;
    }
}
print_r($matrix);

// Умножение элементов массива
$arr = [2, 5, 3, 9];
$result = ($arr[0] * $arr[1]) + ($arr[2] * $arr[3]);
echo "Результат: $result\n";

// Ассоциативный массив пользователя
$user = [
    'name' => 'Иван',
    'surname' => 'Петров',
    'patronymic' => 'Сергеевич'
];
echo "{$user['surname']} {$user['name']} {$user['patronymic']}\n";

// Ассоциативный массив даты
$date = [
    'year' => date('Y'),
    'month' => date('m'),
    'day' => date('d')
];
echo "{$date['year']}-{$date['month']}-{$date['day']}\n";

// Количество элементов в массиве
$arr = ['a', 'b', 'c', 'd', 'e'];
echo "Количество элементов: " . count($arr) . "\n";

// Последний и предпоследний элементы массива
echo "Последний элемент: " . $arr[count($arr) - 1] . "\n";
echo "Предпоследний элемент: " . $arr[count($arr) - 2] . "\n";

// Сумма элементов двумерного массива
$nestedArr = [[1, 2, 3], [4, 5], [6]];
$sum = 0;
foreach ($nestedArr as $subArr) {
    $sum += array_sum($subArr);
}
echo "Сумма элементов двумерного массива: $sum\n";
