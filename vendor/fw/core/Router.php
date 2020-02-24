<?php
namespace fw\core;


class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("~$pattern~i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                $route['action'] = $route['action'] ?? 'index';
                // prefix for admin controllers
                $route['prefix'] = (!isset($route['prefix'])) ? '' : $route['prefix'] . '\\';
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch(string $url): void
    {
        $url = self::removeQueryString($url);
        if (!self::matchRoute($url)) {
            throw new \Exception("Страница не найдена", 404);
        }

        $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

        if (!class_exists($controller)) {
            throw new \Exception("Контроллер $controller не найден", 404);
        }

        $obj = new $controller(self::$route);

        $action = self::$route['action'];
        $action = self::lowerCamelCase($action) . 'Action';

        if (!method_exists($obj, $action)) {
            throw new \Exception("Метод $action не существует в контроллере", 404);
        }

        $obj->$action();
        $obj->getView();
    }

    protected static function upperCamelCase(string $url): string
    {
        $name = str_replace('-', '', ucwords($url, '-'));
        return $name;
    }

    protected static function lowerCamelCase(string $url): string
    {
        $name = lcfirst(self::upperCamelCase($url));
        return $name;
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (strpos($params[0], '=') === false) {
                return  rtrim($params[0], '/');
            } else {
                return '';
            }
        }
        return $url;
    }
}