<?php
namespace Core\Lib;

class Request
{
    private $data;
    public $method;

    public function __construct()
    {
        session();
        $this->method = str_replace('_', '', $_SERVER['REQUEST_METHOD']);
        $this->data = $_REQUEST;
    }

    public function isHome()
    {
        if (!isset($this->data['path'])) {
            return true;
        }
        return false;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } elseif ($this->isHome()) {
            return "/";
        }
        throw new \Exception("Error Processing Request", 1);
    }

    public function active($path)
    {
        $controller = explode('/', $this->data['path']);
        if ($this->isHome() && $path == "home" || $path == $controller[0]) {
            return 'active';
        }
        return '';
    }
}
