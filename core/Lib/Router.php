<?php
namespace Core\Lib;

use Core\Lib\View;
use Core\Lib\Request;
use Core\Lib\Controller;

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

    private function setController()
    {
        $request = request();
        $method = $request->get('method');
        $path = $request->get('path');
        $isHome = $request->isHome();
        if (!$isHome) {
            foreach ($this->web[$method] as $key => $res) {
                $regex = preg_replace('/{(.+?)}/', '(?\'${1}\'.+?)', $key);
                $regex = '/'.str_replace('/', '\\/', $regex).'$/';
                $hasRouter = preg_match($regex, $path, $tmp);
                if ($hasRouter) {
                    array_shift($tmp);
                    $tmp = filterKey($tmp);
                    $this->args = $tmp;
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

    public function run()
    {
        $valid = $this->checkCSKey();
        if (!$valid) {
            redirect('home');
            die;
        }
        $hasRouter = $this->setController();
        if ($hasRouter) {
            $controller = $this->initController();
            $function = $this->function;
            $args = $this->args;
            $controller->$function(...$args);
        } else {
            $this->error();
        }
    }

    private function checkCSKey()
    {
        $request = request();
        if ($request->get('method') == "POST") {
            $cskey = session()->get('cskey');
            session()->delete("cskey");
            if ($cskey != $request->get('cskey')) {
                return false;
            }
        }
        return true;
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
