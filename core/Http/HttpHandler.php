<?php

namespace Core\Http;

use Core\Lib\Router;
use Core\Lib\Request;

class HttpHandler
{
    public function start(Request $request)
    {
        $router = new Router();
        $router->run($request);
    }
}
