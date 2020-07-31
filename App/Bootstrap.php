<?php
declare(strict_types=1);

$rootPath = dirname(__DIR__);

require_once $rootPath. "/vendor/autoload.php";

define('BASE_PATH', $rootPath);
define('APP_PATH', BASE_PATH . '/App');

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();