<?php


namespace app\controllers;

class PageController extends AppController
{
    public function viewAction() {
        $menu = $this->menu;
        $title = 'PAGE title';
        $this->set(compact('title', 'menu'));
    }
}