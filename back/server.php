<?php
require_once 'helpers.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = file_get_contents('php://input');
    if (!$text) {
        http_response_code(400);
        echo json_encode('Не удалось получить данные');
        exit;
    }

    $countWords = countWords($text);
    if(!count($countWords)){
        http_response_code(400);
        echo json_encode('Нет "НЕ" уникальных слов');
        exit;
    }
    echo json_encode($countWords);
} else {
    http_response_code(405);
    echo json_encode('Недопустимый метод запроса');
    exit;
}




