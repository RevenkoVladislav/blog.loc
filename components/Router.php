<?php

class Router
{
private $routes;

public function __construct()
{
    $routesPath = ROOT . '/config/routes.php';
    $this->routes = require_once($routesPath);
}

private function getUri()
{
    if(!empty($_SERVER['REQUEST_URI'])){
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}

public function run()
{
    $uri = $this->getUri();

    foreach($this->routes as $pattern => $path) {
        if (preg_match("#$pattern#", $uri)) {
            $innerPath = preg_replace("#$pattern#", $path, $uri);

            $segments = explode('/', $innerPath);

            $controllerName = ucfirst(array_shift($segments)) . 'Controller';
            $actionName = 'action' . ucfirst(array_shift($segments));

            $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                include_once $controllerFile;
            }

            $controllerObject = new $controllerName;
            $run = call_user_func_array([$controllerObject, $actionName], $segments);

            if ($run != null) {
                break;
            } else {
                $controllerObject = new NotFound();
                $actionName = 'actionIndex';
                call_user_func([$controllerObject, $actionName]);
                die();
            }
        }
    }
    /*

*/
    }

}