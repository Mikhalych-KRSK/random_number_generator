<?php

$file = dirname(dirname(__file__));

include_once($file . "/app/RandomNumberGenerator.php");
require_once($file . "/app/RandomNumberStorage.php");
require_once($file . "/config/db_connect.php");

// Метод для генерации случайного числа
function random() {
    $generator = new RandomNumberGenerator();
    return $generator->generateRandomNumber();
}

// Метод для получения сгенерированного числа по id
function get($id) {
    $number = RandomNumberStorage::getNumberById($id);
    if ($number != null) {
        return $number;
    } else {
        http_response_code(404);
        return json_encode(array('message' => 'Number not found'));
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['func'] === '/random' /*&& $_SERVER['REQUEST_URI'] === '/random'*/) {
    header('Content-Type: application/json');
    echo json_encode(random());
//} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && $_SERVER['REQUEST_URI'] === '/get') {
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    header('Content-Type: application/json');
    echo json_encode(get($_GET['id']));
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Not found'));
}

