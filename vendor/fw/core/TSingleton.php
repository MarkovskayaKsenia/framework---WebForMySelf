<?php


namespace fw\core;


trait TSingleton
{
    protected static $instance;

    public static function instance(): ?self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}