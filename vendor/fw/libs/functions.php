<?php

function debug($val, $die = false) {
    echo "<pre>" . print_r($val, true) . "</pre>";
    if ($die) {
        die();
    }
}

function redirect($http = false) {

    if ($http) {
        $redirect = $http;
    } else {
        $redirect = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit();
}

function checkData($string) {
    return htmlspecialchars($string, ENT_QUOTES);
}

function __($key) {
    echo \fw\core\base\Lang::get($key);
}