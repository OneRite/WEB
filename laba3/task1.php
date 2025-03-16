<?php
/* Imagine a lot of code here */
$very_bad_unclear_name = "15 chicken wings";

// Создаем ссылку
$order = &$very_bad_unclear_name;

// Добавляем строку с помощью конкатенации
$order .= " with extra sauce";

// Выводим значение оригинальной переменной
echo "\nYour order is: $very_bad_unclear_name.";
