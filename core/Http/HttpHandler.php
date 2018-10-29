<?php

namespace Core\Http;

use Core\Lib\Router;

class HttpHandler
{
    public function start()
    {
        $router = new Router();
        $router->run();
    }
}
