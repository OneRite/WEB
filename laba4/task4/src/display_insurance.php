<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отображение данных страховки</title>
</head>
<body>
    <h1>Информация о страховке</h1>
    <?php if (isset($_SESSION['insurance_name'])): ?>
        <p>Название страховки: <?php echo htmlspecialchars($_SESSION['insurance_name']); ?></p>
        <p>Тип страховки: <?php echo htmlspecialchars($_SESSION['insurance_type']); ?></p>
        <p>Стоимость: <?php echo htmlspecialchars($_SESSION['insurance_cost']); ?></p>
    <?php else: ?>
        <p>Данные не сохранены. Вернитесь на страницу ввода.</p>
    <?php endif; ?>
</body>
</html>

