<?php

use App\Application;

define('ROOT', __DIR__);

require_once ROOT . '/autoload.php';

$app = new Application();

// map json data to $_POST
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $_POST = array_merge($_POST, $data);
}

set_error_handler(function (int $errno, string $errstr) use ($app) {
    file_put_contents(__DIR__ . '/errors.txt', $errstr, FILE_APPEND);
    $app->response->error($errstr);
});
set_exception_handler(function (Throwable $exception) use ($app) {
    file_put_contents(__DIR__ . '/errors.txt', $exception->getMessage(), FILE_APPEND);
    $app->response->error($exception->getMessage());
});
