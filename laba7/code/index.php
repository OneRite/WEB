<?php
$mysqli = new mysqli('db', 'root', 'helloworld', 'web');

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Добавление объявления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $stmt = $mysqli->prepare("INSERT INTO ad (email, title, description, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $title, $description, $category);
    $stmt->execute();
    $stmt->close();
}

// Чтение объявлений
$result = $mysqli->query('SELECT * FROM ad ORDER BY created DESC');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Объявления</title>
</head>
<body>
    <h2>Добавить объявление</h2>
    <form method="POST">
        Email: <input type="email" name="email" required><br>
        Заголовок: <input type="text" name="title" required><br>
        Описание: <textarea name="description" required></textarea><br>
        Категория: <input type="text" name="category" required><br>
        <button type="submit">Отправить</button>
    </form>

    <h2>Список объявлений</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<small>Категория: " . htmlspecialchars($row['category']) . "</small><br>";
            echo "<small>Дата: " . $row['created'] . "</small>";
            echo "</div><hr>";
        }
    } else {
        echo "Объявлений нет.";
    }
    $mysqli->close();
    ?>
</body>
</html>