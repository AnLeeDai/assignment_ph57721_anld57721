<?php

spl_autoload_register('autoImport');

$action = $_GET['route'] ?? '/';

match ($action) {
    'logout' => (new controllers\AuthController())->logout(),

    'news' => (new controllers\NewsController())->news(),
    'add-news' => (new controllers\NewsController())->add(),
    'manage-news' => (new controllers\NewsController())->manageNews(),
    'edit-news' => (new controllers\NewsController())->edit(),

    'manage-category' => (new controllers\CategoryController())->manage(),
    'add-category' => (new controllers\CategoryController())->add(),
    'edit-category' => (new controllers\CategoryController())->edit(),

    default => (new controllers\AuthController())->login(),
};