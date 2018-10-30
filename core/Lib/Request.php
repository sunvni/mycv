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

    public function get($name = false)
    {
        if ($name === false) {
            return $this->data;
        }
        if ($name == 'method') {
            return $this->method;
        } elseif (isset($this->data[$name])) {
            return $this->data[$name];
        } elseif ($this->isHome()) {
            return "/";
        }
    }

    public function delete($key)
    {
        unset($this->data[$key]);
        unset($_REQUEST[$key]);
    }
    public function is($path)
    {
        if ($this->isHome()) {
            return $path == "home";
        }
        return explode("/", $this->data['path'])[0] == $path;
    }
}
