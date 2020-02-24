<?php


namespace fw\core;

class App
{
    public static $app;

    public function __construct()
    {
        session_start();
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}