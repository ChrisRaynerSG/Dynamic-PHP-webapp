<?php

use App\Core\Router;

$router = new Router();

$router->get('','HomeController@index');
$router->get('about','HomeController@about');
$router->get('reviews','ReviewController@index');
$router->get('booking', 'BookingController@index');
$router->post('reviews/submit','ReviewController@submit');

$router->dispatch();