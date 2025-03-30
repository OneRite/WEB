<?php
$str = 'ahb acb aeb aeeb adcb axeb';

// Регулярное выражение для поиска 'a' + два любых символа + 'b'
preg_match_all('/a.b/', $str, $matches1);

// Регулярное выражение для поиска 'x' + один любой символ + 'x'
preg_match_all('/x.x/', $str, $matches2);

// Вывод результатов
echo "Найденные совпадения (a.b): " . implode(', ', $matches1[0]) . "\n";
echo "Найденные совпадения (x.x): " . implode(', ', $matches2[0]) . "\n";
?>
