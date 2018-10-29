<?php
namespace Core\Lib;

class Session
{
    private $data;
    private $id;
    public function __construct()
    {
        if ($this->id == session_id()) {
            session_start();
            $this->data = $_SESSION;
        }
    }
    
    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        throw new Exception("Error Processing Request", 1);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
}
