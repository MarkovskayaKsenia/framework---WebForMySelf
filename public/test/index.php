<?php


class Registry
{
    public static $objects = [];
    protected static $instance;

    protected function __construct()
    {
        $config = require ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component();
        }
    }

    public static function instance(): ?self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name)
    {
       if (is_object(self::$objects[$name])) {
           return self::$objects[$name];
       }
    }

    public function __set($name, $object)
    {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }

    public function getList()
    {
        echo "<pre>";
        var_dump(self::$objects);
        echo "</pre>";
    }
}

$app = Registry::instance();
$app->getList();
$app->test->go();
$app->test2 = 'classes\Test2';
$app->getList();
$app->test2->hello();