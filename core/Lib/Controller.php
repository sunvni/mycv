<?php
namespace Core\Lib;

class Controller
{
    public function index()
    {
        $class = strtolower(preg_replace('/(Core\\\Controller\\\)(.*)(Controller)/', "$2", get_class($this)));
        return view($class.".index");
    }
}
