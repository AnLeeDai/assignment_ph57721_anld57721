<?php

// Debugging function
use JetBrains\PhpStorm\NoReturn;

if (!function_exists('debug')) {
    #[NoReturn] function debug($data): void
    {
        echo '<pre>';
        print_r($data);
        die();
    }
}

// Auto-import function
if (!function_exists('autoImport')) {
    function autoImport($class): void
    {
        $class = str_replace('\\', '/', $class);

        $pathController = PATH_CONTROLLERS . basename($class) . '.php';
        $pathModels = PATH_MODELS . basename($class) . '.php';


        if (file_exists($pathController)) {
            require_once $pathController;
        } elseif (file_exists($pathModels)) {
            require_once $pathModels;
        } else {
            echo "File không tồn tại: $pathController or $pathModels";
        }
    }
}

