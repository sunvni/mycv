<?php
namespace Core\Lib;

class Config
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function get()
    {
        return $this->data;
    }
}