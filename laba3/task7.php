<?php
// Функция, которая печатает строку и возвращает число
function printStringReturnNumber() {
    echo "Это строка из функции.\n";
    return 42; // Любое числовое значение
}

// Записываем возвращаемое значение в переменную
$my_num = printStringReturnNumber();

// Выводим значение переменной
echo "Возвращенное число: $my_num\n";
