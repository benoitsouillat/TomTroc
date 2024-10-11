<?php

spl_autoload_register(function ($className) {
    if (file_exists('classes/' . $className . '.php')) {
        require_once 'classes/' . $className . '.php';
    }

    if (file_exists('repository/' . $className . '.php')) {
        require_once 'repository/' . $className . '.php';
    }

    if (file_exists('controllers/' . $className . '.php')) {
        require_once 'controllers/' . $className . '.php';
    }

    if (file_exists('views/' . $className . '.php')) {
        require_once 'views/' . $className . '.php';
    }
});
