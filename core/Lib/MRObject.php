<?php
namespace Core\Lib;

class MRObject
{
    public function log(string $msg)
    {
        $class_name = get_class($this);
        error_log("$class_name: $msg");
    }
    public function __toString()
    {
        $class_name = get_class($this);
        return "myResume class: {$class_name}";
    }
}
