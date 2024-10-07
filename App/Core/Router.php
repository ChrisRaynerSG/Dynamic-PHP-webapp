<?php

namespace App\Core;

class Router{
    private $routes = [];

    public function get($uri, $callback){
        $this->addRoute('GET', $uri, $callback);
    }

    public function post($uri, $callback){
        $this->addRoute('POST', $uri, $callback);
    }

    private function addRoute($method, $uri, $callback){
        $this->routes[]=[
            'method' => $method,
            'uri' => $this->formatUri($uri),
            'callback' => $callback
        ];
    }

    public function dispatch(){
        $requestedUri = $this->formatUri($_SERVER['REQUEST_URI']);
        $requestedMethod = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as $route){
            if($requestedMethod === $route['method'] && $requestedUri === $route['uri']){

                if(is_callable($route['callback'])){
                    call_user_func($route['callback']);
                    return;
                }
                elseif(is_string($route['callback'])){
                    $this->callController($route['callback']);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }

    private function formatUri($uri){
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    private function callController($controllerAction){
        list($controller, $action) = explode("@", $controllerAction);
        $controller = "App\\Controllers\\{$controller}";

        if(class_exists("$controller")){
            $controllerInstance = new $controller;
            if(method_exists($controllerInstance, $action)){
                call_user_func([$controllerInstance, $action]);
            }
            else{
                echo "Action: {$action} not found in controller: {$controller}";
            }
        }
        else{
            echo "Controller: {$controller} not found.";
        }
    }
}