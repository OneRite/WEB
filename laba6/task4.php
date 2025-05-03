<?php
// task4.php - Часть 4: ApiClient и практическое приложение

/**
 * Class ApiClient — универсальный клиент для HTTP-запросов с использованием cURL.
 */
class ApiClient {
    private string $baseUrl;
    private array $headers = [];

    public function __construct(string $baseUrl, string $token = '', string $basicAuth = '') {
        $this->baseUrl = rtrim($baseUrl, '/');

        if ($token) {
            $this->headers[] = "Authorization: Bearer $token";
        } elseif ($basicAuth) {
            $encoded = base64_encode($basicAuth);
            $this->headers[] = "Authorization: Basic $encoded";
        }

        $this->headers[] = "Content-Type: application/json";
        $this->headers[] = "Accept: application/json";
    }

    private function request(string $method, string $endpoint, array $data = [], array $query = []): array {
        $url = $this->baseUrl . $endpoint;
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new Exception("cURL ошибка: $error");
        }

        return [
            'status' => $httpCode,
            'body' => json_decode($response, true)
        ];
    }

    public function get(string $endpoint, array $query = []): array {
        return $this->request('GET', $endpoint, [], $query);
    }

    public function post(string $endpoint, array $data): array {
        return $this->request('POST', $endpoint, $data);
    }

    public function put(string $endpoint, array $data): array {
        return $this->request('PUT', $endpoint, $data);
    }

    public function delete(string $endpoint): array {
        return $this->request('DELETE', $endpoint);
    }
}

// ==================== ПРАКТИЧЕСКОЕ ПРИМЕНЕНИЕ ====================

try {
    $client = new ApiClient("https://jsonplaceholder.typicode.com");

    echo "--- GET /posts ---\n";
    $response = $client->get("/posts", ['userId' => 1]);
    print_r(array_slice($response['body'], 0, 2));

    echo "--- POST /posts ---\n";
    $newPost = [
        'title' => 'Lab test',
        'body' => 'This is a test post from ApiClient',
        'userId' => 1
    ];
    $response = $client->post("/posts", $newPost);
    print_r($response);

    echo "--- PUT /posts/1 ---\n";
    $updatedPost = [
        'id' => 1,
        'title' => 'Updated title',
        'body' => 'Updated body',
        'userId' => 1
    ];
    $response = $client->put("/posts/1", $updatedPost);
    print_r($response);

    echo "--- DELETE /posts/1 ---\n";
    $response = $client->delete("/posts/1");
    print_r($response);

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
