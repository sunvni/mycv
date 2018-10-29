<?php
namespace Core\Lib;

class Session
{
    private $data;
    private $id;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->data = $_SESSION;
    }
    
    public function get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    public function set($name, $value)
    {
        $this->data[$name] = $value;
        $_SESSION[$name] = $value;
    }
    
    public function delete($key)
    {
        unset($this->data[$key]);
        unset($_SESSION[$key]);
    }
}
