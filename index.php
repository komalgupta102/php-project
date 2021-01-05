<?php

include 'classes/Router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get($request,'landing');
//echo "<pre>"; print_r($router); exit;
// $router->get('/', 'landing');
// $router->get('/php-project/', 'landing');
// $router->get('/php-project/login', 'login');