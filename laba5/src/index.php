<?php
// Массив допустимых категорий
$categories = ["Канцтовары", "Книги", "Учебники"];

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем и очищаем входные данные
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $headline = trim($_POST["headline"]);
    $text = trim($_POST["text"]);
    $category = $_POST["category"] ?? "";

    // Проверяем, что выбрана допустимая категория
    if (!in_array($category, $categories)) {
        $error = "Выбрана неверная категория.";
    }
    
    if (empty($error)) {
        // Создаем папку категории, если она не существует
        if (!file_exists($category)) {
            mkdir($category, 0777, true);
        }
        
        // Очищаем заголовок объявления для формирования имени файла
        $safe_headline = preg_replace("/[^a-zA-Z0-9а-яА-ЯёЁ_\- ]/", "", $headline);
        $safe_headline = trim($safe_headline);
        
        // Формируем имя файла
        $filename = $category . "/" . $safe_headline . ".txt";
        // Если файл существует, добавляем метку времени
        if (file_exists($filename)) {
            $filename = $category . "/" . $safe_headline . "_" . time() . ".txt";
        }
        
        // Сохраняем содержимое файла (текст объявления)
        file_put_contents($filename, $text);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доска объявлений</title>
</head>
<body>
    <h1>Доска объявлений</h1>
    
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <!-- Форма добавления объявления -->
    <form method="POST">
        <label>
            Email: 
            <input type="email" name="email" required>
        </label>
        <br>
        <label>
            Категория: 
            <select name="category" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>">
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br>
        <label>
            Заголовок объявления: 
            <input type="text" name="headline" required>
        </label>
        <br>
        <label>
            Текст объявления: 
            <textarea name="text" rows="5" cols="40" required></textarea>
        </label>
        <br>
        <button type="submit">Добавить</button>
    </form>
    
    <h2>Список объявлений</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Категория</th>
            <th>Заголовок</th>
            <th>Текст объявления</th>
        </tr>
        <?php
        // Перебираем все категории и выводим файлы (объявления)
        foreach ($categories as $cat) {
            if (file_exists($cat) && is_dir($cat)) {
                $files = scandir($cat);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }
                    $filepath = $cat . "/" . $file;
                    if (is_file($filepath)) {
                        // Из имени файла получаем заголовок (без расширения)
                        $headline_display = pathinfo($file, PATHINFO_FILENAME);
                        $text_content = file_get_contents($filepath);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cat) . "</td>";
                        echo "<td>" . htmlspecialchars($headline_display) . "</td>";
                        echo "<td>" . nl2br(htmlspecialchars($text_content)) . "</td>";
                        echo "</tr>";
                    }
                }
            }
        }
        ?>
    </table>
</body>
</html>
