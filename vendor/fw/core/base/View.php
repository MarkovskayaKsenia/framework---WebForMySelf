<?php


namespace fw\core\base;


use fw\core\App;

class View
{
    public $route = [];
    public $view;
    public $layout;
    public $scripts = [];
    public static $meta = ['title' => '', 'description' => '', 'keywords' => ''];

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;

        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?? LAYOUT;
        }

        $this->view = $view;
    }

    protected function compressPage($buffer)
    {
        $search = [
            "~(\n)+~",
            "~\r\n+~",
            "~\n(\t)+~",
            "~\n(\ )+~",
            "~\>(\n)+<~",
            "~\>\r\n<~",
        ];
        $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            '><',
            '><',
        ];
        return preg_replace($search, $replace, $buffer);
    }

    public function getPart($file)
    {
        $file = APP . "/views/{$file}.php";

        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "File $file not found";
        }
    }

    public function render(array $vars)
    {
        Lang::load(App::$app->getProperty('lang'), $this->route);
        $this->route['prefix'] = str_replace('\\', '/', $this->route['prefix']);
        extract($vars);
        $file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";
        //ob_start([$this, 'compressPage']);
        ob_start();
        {

            if (file_exists($file_view)) {
                require $file_view;
            } else {
                throw new \Exception("<p>Файл $file_view не существует</p>", 404);
            }

            //$content = ob_get_clean();
            $content = ob_get_contents();
        }
        ob_clean();

        if ($this->layout !== false) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";

            if (file_exists($file_layout)) {
                $content = $this->getScript($content);
                $scripts = [];
                if (!empty ($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require $file_layout;
            } else {
                throw new \Exception("<p> Шаблон $file_layout не существует</p>", 404);
            }
        }
    }

    protected function getScript($content)
    {
        $pattern = '~<script.*?>.*?</script>~si';
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty ($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title'] . '</title>
        <meta name = "description" content="'. self::$meta['description'] . '">
        <meta name = "keywords" content="'. self::$meta['keywords'] . '"> ';
        
    }

    public static function setMeta($title ='', $description ='', $keywords ='')
    {
        self::$meta['title'] = $title;
        self::$meta['description'] = $description;
        self::$meta['keywords'] = $keywords;
    }
}