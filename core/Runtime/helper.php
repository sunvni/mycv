<?php
function dd(...$args)
{
    ob_end_clean();
    header('Content-Type: application/json');
    print(json_encode($args));
    die;
}

function filterAssoc(array $array)
{
    $result = array();
    foreach ($array as $key => $value) {
        if (!is_numeric($key)) {
            $result[$key] = $value;
        }
    }
    return $result;
}

function filterKey(array $array)
{
    $result = array();
    foreach ($array as $key => $value) {
        if (is_numeric($key)) {
            $result[$key] = $value;
        }
    }
    return $result;
}

function config()
{
    $data = require "../config.php";
    $config = new Core\Lib\Config($data);
    return $config;
}

function request()
{
    $request = new Core\Lib\Request;
    return $request;
}

function router($name)
{
    $router = new Core\Lib\Router;
    return $router;
}
function session()
{
    $ses = new Core\Lib\Session;
    return $ses;
}

function view()
{
    $data = func_get_args();
    
    $view_name = array_shift($data);
    $view_name = str_replace('.', '/', $view_name);
    $view = new Core\Lib\View();
    $view->display($view_name, $data);
}

function path()
{
    $where = func_get_args();
    $site_url = config()->site_url;    
    return $site_url."/".join('/', $where);
}
