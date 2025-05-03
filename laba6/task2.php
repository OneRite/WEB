<?php
// task2.php - Часть 2: Заголовки и параметры

// GET-запрос с кастомными заголовками
$ch = curl_init("https://jsonplaceholder.typicode.com/posts/1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Custom-Header: TestValue",
    "Accept: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);
echo "GET с кастомными заголовками:\n$response\n\n";

// POST JSON
$data = json_encode([
    "name" => "Alice",
    "email" => "alice@example.com"
]);
$ch = curl_init("https://jsonplaceholder.typicode.com/posts");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => $data
]);
$response = curl_exec($ch);
curl_close($ch);
echo "POST с JSON-данными:\n$response\n\n";

// GET с параметрами URL
$params = http_build_query(["userId" => 1]);
$ch = curl_init("https://jsonplaceholder.typicode.com/posts?" . $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo "GET с параметрами URL:\n" . substr($response, 0, 300) . "\n\n"; // обрезка
?>
