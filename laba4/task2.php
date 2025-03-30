<?php
$str = 'a1b2c3';

// Функция для замены чисел на их значение минус 100
$str = preg_replace_callback('/\d+/', function($matches) {
    return $matches[0] - 100;
}, $str);

echo "Строка после преобразования: $str\n";
?>

