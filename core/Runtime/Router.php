<?php
namespace Core\Runtime;

use Core\Lib\View;
use Core\Lib\Controller;
use Core\Runtime\Request;

class Router
{
    private $url;
    private $web;
    private $controller;
    private $function;
    private $args = array();

    public function __construct()
    {
        $this->web = require __DIR__.'/../router.php';
    }

    public static function getUrl($name)
    {
        //return $this->url;
    }

    private function setController(Request $request)
    {
        $method = $request->getMethod();
        $path = $request->getPath();
        $isHome = $request->isHome();
        if (!$isHome) {
            foreach ($this->web[$method] as $key => $res) {
                $args = array();
                $hasRouter = $this->checkRouter($key, $path, $args);
                if ($hasRouter) {
                    array_shift($args);
                    $args = filterKey($args);
                    $this->args = $args;
                    $this->controller = $res['con'];
                    $this->function = $res['func'];
                    return true;
                }
            }
        } elseif ($path == '/') {
            $this->controller = $this->web[$method]['/']['con'];
            $this->function = $this->web[$method]['/']['func'];
            return true;
        }
        return false;
    }

    private function checkRouter($router, $path, &$tmp)
    {
        $regex = preg_replace('/{(.+?)}/', '(?\'${1}\'.+?)', $router);
        $regex = '/'.str_replace('/', '\\/', $regex).'$/';
        $hasRouter = preg_match($regex, $path, $tmp);
        return $hasRouter;
    }

    public function run(Request $request)
    {
        $hasRouter = $this->setController($request);
        if ($hasRouter) {
            $controller = $this->initController();
            $function = $this->function;
            $args = $this->args;
            array_push($args, $request);
            $controller->$function(...$args);
        } else {
            $this->error();
        }
    }

    private function error()
    {
        header('HTTP/1.0 403 Forbidden');
        echo "Permision denied!";
        die;
    }

    private function initController()
    {
        $controllerClass = "Core\\Controller\\".$this->controller;
        $controller = new $controllerClass;
        return $controller;
    }
}
