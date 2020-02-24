<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;

class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main();
        $lang = App::$app->getProperty('lang')['code'];
        $total = \R::count('posts', 'lang_code = ?', [$lang]);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 2;

        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $posts = \R::findAll('posts' , "lang_code = ? LIMIT $start, $perPage", [$lang]);
;
        View::setMeta('Blog Главная страница', 'Описания страницы', 'Ключевые слова');
        $this->set(compact('posts', 'pagination', 'total'));
    }

    public function testAction()
    {
        if ($this->isAjax()) {
            $model = new Main();
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            $this->loadView('test', compact('post'));
            die();
        }
    }
}