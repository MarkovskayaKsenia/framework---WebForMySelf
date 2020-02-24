<?php


namespace app\controllers\admin;


use app\models\User;
use fw\core\base\View;

class UserController extends AppController
{
    //public $layout = 'default';

    public function indexAction()
    {

        View::setMeta('Админка :: Главная станица', 'Описание Админки', 'Ключевые слова админки');
        $test = 'Тестовая переменная';
        $data = ['test', 2];
        $this->set(compact('test', 'data'));

    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            if (!$user->login(true)) {
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            if(User::isAdmin()) {
                redirect(ADMIN);
            } else {
                redirect();
            }
        }
        $this->layout ='login';
    }
}