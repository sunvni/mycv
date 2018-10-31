<?php
namespace Core\Runtime;

use Core\Runtime\Session;

class WebService
{
    public function process()
    {
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
