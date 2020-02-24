<?php


namespace app\controllers\admin;

use app\models\Main;
use app\models\User;
use fw\core\base\Controller;

class AppController extends Controller
{
    public $layout = 'admin';

    public function __construct(array $route)
    {
        parent::__construct($route);

        if(!User::isAdmin() && $route['action'] !== 'login') {
            redirect(ADMIN . '/user/login');
        }
        new Main();
    }
}