<?php
namespace Core\Lib;

use Twig_Loader_Filesystem as Loader;
use Twig_Environment as Twig;

class View
{
    private $data;
    private $view_path;

    public function __construct()
    {
        $template_path = dirname(__DIR__)."/View/templates";
        $cache_path = dirname(dirname(__DIR__))."/cache/views";
        $loader = new Loader($template_path);
        $this->engine = new Twig($loader, array(
            'cache' => $cache_path,
            'debug' => true,
        ));
        $this->engine->addExtension(new \Twig_Extension_Debug());
        $path = new \Twig_Function('path', 'path');
        $request = new \Twig_Function('request', 'request');
        $this->engine->addFunction($path);
        $this->engine->addFunction($request);
    }
    public function display($view, $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        try {
            $this->engine->display($view.".twig", ...$data);
        } catch (\Twig_Error $e) {
            $msg = $e->getMessage();
            $this->engine->display("errors/msg.twig", compact("msg"));
        }
    }
}
