<?php
$web = array(
    'GET' => array(
        '/' => array('con' => 'HomeController', 'func' => 'index'),
        'timelife' => array('con' => 'TimeLifeController', 'func' => 'index'),
        'about' => array('con' => 'AboutController', 'func' => 'index'),
        'project' => array('con' => 'ProjectController', 'func' => 'index'),
        'road' => array('con' => 'HomeController', 'func' => 'roadMap'),
        'post/{id}' => array('con' => 'BlogController', 'func' => 'show', 'name'=> 'blog')
    ),
    'POST' => array(
        '/' => array('con' => 'HomeController', 'func' => 'login')
    )
);
return $web;
