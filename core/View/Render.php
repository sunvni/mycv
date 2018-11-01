<?php
namespace Core\View;

use Twig_Loader_Filesystem as Loader;
use Twig_Environment as Twig;
use Core\Lib\MRObject;

class Render extends MRObject
{
    private $data;
    private $engine;
    private $view_path;

    public function __construct()
    {
        $template_path = dirname(dirname(__DIR__))."/templates";
        $cache_path = dirname(dirname(__DIR__))."/cache/views";
        $loader = new Loader($template_path);
        $this->engine = new Twig($loader, array(
            'cache' => $cache_path,
            'debug' => true,
        ));
        $this->engine->addExtension(new \Twig_Extension_Debug());
        $path = new \Twig_Function('path', 'path');
        $request = new \Twig_Function('request', 'request');
        $addkey = new \Twig_Function('addkey', 'addkey');
        $this->engine->addFunction($path);
        $this->engine->addFunction($request);
        $this->engine->addFunction($addkey);
    }
    public function display($view, $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        try {
            $this->engine->display("views/".$view.".html.twig", ...$data);
        } catch (\Twig_Error $e) {
            $msg = $e->getMessage();
            $this->engine->display("views/errors/msg.html.twig", compact("msg"));
        }
    }
}
