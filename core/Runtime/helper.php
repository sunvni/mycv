<?php
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
    $request = Core\Runtime\Request::getInstance();
    return $request;
}

function router($name)
{
    $router = new Core\Runtime\Router;
    return $router;
}
function session()
{
    $ses = Core\Runtime\Session::getInstance();
    return $ses;
}

function view()
{
    $data = func_get_args();
    
    $view_name = array_shift($data);
    $view_name = str_replace('.', '/', $view_name);
    $render = new Core\View\Render;
    $render->display($view_name, $data);
}

function path()
{
    $where = func_get_args();
    $site_url = config()->site_url;
    return $site_url."/".join('/', $where);
}

function cskey()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $uniqid = uniqid(mt_rand(), true);
    return md5($ip . $uniqid);
}
function addkey()
{
    $key = cskey();
    session()->set('cskey', $key);
    return "<input type='hidden' value='{$key}' name='cskey'/>";
}

function redirect($where)
{
    if ($where == 'home') {
        header('location: '.path(''));
    } else {
        header('location: '.path($where));
    }
}
