<?php

spl_autoload_register(function ($class_name) {
    $control_path = __DIR__ . '/control/' . $class_name . '.php';
    $model_path = __DIR__ . '/model/' . $class_name . '.php';

    if (file_exists($control_path)) {
        require_once $control_path;
    } elseif (file_exists($model_path)) {
        require_once $model_path;
    } else {
        // Mensagem de erro para depuração
        exit("A classe {$class_name} não foi encontrada.");
    }
});