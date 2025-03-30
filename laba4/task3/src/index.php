<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    
    // Поиск дат в формате дд.мм.гггг
    preg_match_all('/\b\d{2}\.\d{2}\.\d{4}\b/', $text, $matches);
    $dateCount = count($matches[0]);
    
    // Сохранение результата в сессию
    $_SESSION['dateCount'] = $dateCount;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подсчет дат в тексте</title>
</head>
<body>
    <form method="POST">
        <textarea name="text" rows="5" cols="40"><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea><br>
        <button type="submit">Подсчитать даты</button>
    </form>
    
    <?php if (isset($_SESSION['dateCount'])): ?>
        <p>Количество дат в тексте: <?php echo $_SESSION['dateCount']; ?></p>
    <?php endif; ?>
</body>
</html>
