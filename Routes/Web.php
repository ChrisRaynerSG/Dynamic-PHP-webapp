<?php

use App\Core\Router;

$router = new Router();

$router->get('','HomeController@index');
$router->get('about','HomeController@about');

$router->dispatch();