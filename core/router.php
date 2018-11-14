<?php
$web = array(
    'GET' => array(
        '/' => array('con' => 'HomeController', 'func' => 'index'),
        'timelife' => array('con' => 'TimeLifeController', 'func' => 'index'),
        'contact' => array('con' => 'HomeController', 'func' => 'contact'),
        'road' => array('con' => 'HomeController', 'func' => 'roadMap'),
        'project' => array('con' => 'ProjectController', 'func' => 'index'),
        'post/{id}' => array('con' => 'BlogController', 'func' => 'show', 'name'=> 'blog'),
        'webhook' => array('con' => 'HomeController', 'func' => 'webhook', 'type' => 'api'),
        //Admin
        'admin' => array('con' => 'AdminController', 'func' => 'index', 'name'=> 'admin_index')
    ),
    'POST' => array(
        '/' => array('con' => 'HomeController', 'func' => 'login'),
        'webhook' => array('con' => 'HomeController', 'func' => 'webhook'),
        //Admin
        'admin' => array('con' => 'AdminController', 'func' => 'login', 'name'=> 'admin')
    )
);
return $web;
