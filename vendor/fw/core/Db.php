<?php

namespace fw\core;

class Db
{
    use TSingleton;

    protected $pdo;
    public static $countSql = 0;
    public static $queries = [];

    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        require LIBS . '/rb-mysql.php';

        \R::setup($db['dsn'], $db['user'], $db['password']);
        \R::freeze(true);

    }
}
