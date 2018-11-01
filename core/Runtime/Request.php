<?php
namespace Core\Runtime;

class Request
{
    const POST_METHOD = "POST";
    const GET_METHOD = "GET";
    private $data;
    private $method;
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        self::$instance->setMethod($_SERVER['REQUEST_METHOD']);
        self::$instance->setRequest();
        return self::$instance;
    }

    private function setRequest()
    {
        $method = $this->getMethod();
        if ($method == self::GET_METHOD) {
            $this->data = $_GET;
        } elseif ($method == self::POST_METHOD) {
            $this->data = $_POST;
        }
    }

    public function validateRequest()
    {
        if ($this->isValid()) {
            return true;
        }
        return false;
    }

    public function isValid()
    {
        if ($this->getMethod() === self::POST_METHOD) {
            return $this->checkCSKey();
        }
        return true;
    }

    private function checkCSKey()
    {
        $cskey = session()->get('cskey');
        $reqcskey = $this->get('cskey');
        session()->delete("cskey");
        if ($cskey != $reqcskey) {
            return false;
        }
        return true;
    }

    public function clean()
    {
        if ($this->method == self::GET_METHOD) {
            return;
        }
        $non_effect = array("cskey", "PHPSESSID");
        foreach ($non_effect as $item) {
            $this->delete($item, $_POST);
        }
    }

    public function getMethod()
    {
        return $this->method;
    }
    
    private function setMethod($method)
    {
        return $this->method = $method;
    }

    public function isHome()
    {
        if (!isset($this->data['path'])) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        return $this->data;
    }
    
    public function getPath()
    {
        if (isset($this->data['path'])) {
            return $this->data['path'];
        } else {
            return "/";
        }
    }

    public function get($name = false)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        throw new \Exception("No value with name as: $name", 1);
    }

    public function delete($key, &$request)
    {
        if (!isset($this->data[$key])) {
            return;
        }
        unset($this->data[$key]);
        unset($request[$key]);
    }
    public function is($path)
    {
        if ($this->isHome()) {
            return $path == "home";
        }
        return explode("/", $this->data['path'])[0] == $path;
    }
}
