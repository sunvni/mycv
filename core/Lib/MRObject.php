<?php
namespace Core\Lib;

class MRObject
{
    private $mro_data;

    public function __construct($mro_data = null)
    {
        $this->mro_data = $mro_data;
    }

    public function __get($name)
    {
        return $this->mro_data[$name];
    }

    public function __set($name, $value)
    {
        $this->mro_data[$name] = $value;
    }

    public function get($name)
    {
        $value = $this->mro_data[$name];
        if (is_array($value)) {
            $value = new Config($value);
        }
        return $value;
    }

    public function getAll()
    {
        return $this->mro_data;
    }

    public function set($name, $value)
    {
        $this->mro_data[$name] = $value;
    }

    public function __toString()
    {
        $class_name = get_class($this);
        return "myResume class: {$class_name}";
    }

    public function log(string $msg)
    {
        global $log;
        $log->debug("$class_name: $msg");
    }
}
