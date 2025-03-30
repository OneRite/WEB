<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['insurance_name'] = $_POST['insurance_name'] ?? '';
    $_SESSION['insurance_type'] = $_POST['insurance_type'] ?? '';
    $_SESSION['insurance_cost'] = $_POST['insurance_cost'] ?? '';

    // Перенаправляем на страницу отображения
    header('Location: display_insurance.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ввод данных страховки</title>
</head>
<body>
    <form method="POST">
        <label>Название страховки: 
            <input type="text" name="insurance_name" required>
        </label><br>
        <label>Тип страховки: 
            <input type="text" name="insurance_type" required>
        </label><br>
        <label>Стоимость: 
            <input type="number" name="insurance_cost" required>
        </label><br>
        <button type="submit">Сохранить</button>
    </form>
</body>
</html>
