<?php
// task1.php - Часть 1: Базовые HTTP-запросы

// GET
$ch = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo "GET-запрос:\n" . substr($response, 0, 300) . "\n\n"; // Вывод первых 300 символов

// POST
$data = json_encode([
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1
]);
$ch = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $data
]);
$response = curl_exec($ch);
curl_close($ch);
echo "POST-запрос:\n" . $response . "\n\n";

// PUT
$data = json_encode([
    'id' => 1,
    'title' => 'updated title',
    'body' => 'updated body',
    'userId' => 1
]);
$ch = curl_init('https://jsonplaceholder.typicode.com/posts/1');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $data
]);
$response = curl_exec($ch);
curl_close($ch);
echo "PUT-запрос:\n" . $response . "\n\n";

// DELETE
$ch = curl_init('https://jsonplaceholder.typicode.com/posts/1');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'DELETE'
]);
$response = curl_exec($ch);
curl_close($ch);
echo "DELETE-запрос:\n" . $response . "\n\n";
?>
