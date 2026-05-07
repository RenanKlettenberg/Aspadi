<?php
include_once('vendor/autoload.php');

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (\Throwable $th) {
    Core\Presenter::encerrar($th->getMessage(), Core\ResponseCode::FALHA_ENV);
}

if (isset($_REQUEST) && !empty($_REQUEST)) {
    echo Core\Router::carregar($_REQUEST);
}