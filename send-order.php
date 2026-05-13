<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$body = json_decode(file_get_contents('php://input'), true);
$text = $body['text'] ?? '';

if (empty($text)) {
    echo json_encode(['ok' => false, 'error' => 'No text']);
    exit();
}

$token = '8707504990:AAGSDopsXvFq0BFLvxdEFrl0Ps0MDtuJkqE';
$chat_id = '8651437550';

$ch = curl_init("https://api.telegram.org/bot{$token}/sendMessage");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'chat_id' => $chat_id,
    'text' => $text,
    'parse_mode' => 'HTML'
]));

$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
