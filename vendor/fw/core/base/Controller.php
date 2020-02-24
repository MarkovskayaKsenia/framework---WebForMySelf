<?php


namespace fw\core\base;


abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;
    public $vars = [];

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $obj = new View($this->route, $this->layout, $this->view);
        $obj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->route['controller']}/{$view}.php";
    }
}