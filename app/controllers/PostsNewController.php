<?php

namespace app\controllers;

class PostsNewController extends AppController
{
    public function __construct()
    {
        echo 'контроллер Постс Нью';
    }

    public function testWebAction()
    {
        echo "это экшен testWeb";
    }

    public function web()
    {
        echo 'web';
    }
}