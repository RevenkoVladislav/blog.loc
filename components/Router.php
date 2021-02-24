<?php

class Router
{
private $routes;

public function __construct()
{
    $routesPath = ROOT . '/config/routes.php';
    $this->routes = require_once($routesPath);
}

public function run()
{
    echo "Hello, test run";
}

}