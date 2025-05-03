<?php
// task3.php - Часть 3: Обработка ответов, ошибок и исключений

function sendRequest(string $url): void {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    try {
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("cURL ошибка: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "HTTP статус: $httpCode\n";

        if ($httpCode >= 200 && $httpCode < 300) {
            $data = json_decode($response, true);
            echo "Успешный ответ:\n";
            print_r(array_slice($data, 0, 3)); // вывод первых 3 элементов
        } elseif ($httpCode >= 400 && $httpCode < 600) {
            echo "Ошибка HTTP ($httpCode):\n$response\n";
        } else {
            echo "Неизвестный статус ответа:\n$response\n";
        }
    } catch (Exception $e) {
        echo "Исключение: " . $e->getMessage() . "\n";
    } finally {
        curl_close($ch);
    }
}

// Тест: успешный запрос
echo "Успешный GET-запрос:\n";
sendRequest("https://jsonplaceholder.typicode.com/posts");

// Тест: ошибка 404
echo "\nGET-запрос с ошибкой (404):\n";
sendRequest("https://jsonplaceholder.typicode.com/nonexistent-endpoint");

// Тест: ошибка DNS (исключение)
echo "\nGET-запрос с ошибкой DNS:\n";
sendRequest("https://nonexistent.example");
?>
