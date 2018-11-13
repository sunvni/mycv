<?php
namespace Core\Runtime;

use Core\Runtime\Session;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class WebService
{
    public function process()
    {
        $request = Request::getInstance();
        global $log;
        $whoop = new \Whoops\Run;
        $whoop->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoop->register();

        $log = new Logger('My-resume');
        $formatter = new LineFormatter(null, null, true, true);
        
        $debugHandler = new StreamHandler(dirname(dirname(__DIR__)) .'/logs/debug.log', Logger::DEBUG);
        $debugHandler->setFormatter($formatter);
        $errorHandler = new StreamHandler(dirname(dirname(__DIR__)) . '/logs/error.log', Logger::ERROR);
        $errorHandler->setFormatter($formatter);
        $log->pushHandler($debugHandler);
        $log->pushHandler($errorHandler);
        
        $request = request();
        if (!$request->validateRequest()) {
            $this->close();
        }
        $request->clean();
        Session::getInstance();
        $router = new Router;
        $router->run($request);
    }

    private function close()
    {
        redirect("error");
        die;
    }

    private function oauth()
    {
        if ($this->session->get("login") != 1) {
            redirect('login');
        }
    }
}
