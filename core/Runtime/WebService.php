<?php
namespace Core\Runtime;

class WebService
{
    public function process()
    {
        $request = Request::getInstance();
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
