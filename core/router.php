<?php
$web = array(
    'GET' => array(
        '/' => array('con' => 'HomeController', 'func' => 'index'),
        'timelife' => array('con' => 'TimeLifeController', 'func' => 'index'),
        'about' => array('con' => 'AboutController', 'func' => 'index'),
        'project' => array('con' => 'ProjectController', 'func' => 'index'),
        'road' => array('con' => 'HomeController', 'func' => 'roadMap'),
        'post/{id}' => array('con' => 'BlogController', 'func' => 'show', 'name'=> 'blog'),

        //Admin
        'admin' => array('con' => 'AdminController', 'func' => 'index', 'name'=> 'admin_index')
    ),
    'POST' => array(
        '/' => array('con' => 'HomeController', 'func' => 'login'),
        //Admin
        'admin' => array('con' => 'AdminController', 'func' => 'login', 'name'=> 'admin')
    )
);
return $web;
