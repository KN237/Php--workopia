<?php

// $routes = require basePath('routes.php');

// if (array_key_exists($uri, $routes)) {
//     require(basePath($routes[$uri]));
// } else {
//     http_response_code(404);
//     require(basePath($routes['404']));
// }
namespace Framework;

use App\Controller;
use App\Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Register a route
     *
     * @param string $method
     * @param string $uri
     * @param string $actions
     * @return void
     */
    public function registerRoute($method, $uri, $actions)
    {
        list($controller, $controllerMethod) = explode('@', $actions);
        $this->routes[] = ['method' => $method, 'uri' => $uri, 'controller' => $controller, 'controllerMethod' => $controllerMethod];
    }

    /**
     * register a GET route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * register a POST route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * register a PUT route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * register a DELETE route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * routing method
     *
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri, $method)
    {
        $uriSegments = explode('/', trim($uri, '/'));
        $params = [];
        $j = 0;
        foreach ($this->routes as $route) {
            $routeSegments = explode('/', trim($route['uri'], '/'));
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $controller = 'App\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                return;
            } else if (count($uriSegments) == count($routeSegments)) {

                for ($i = 0; $i < count($routeSegments); $i++) {
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] =  $uriSegments[$i];
                    } else if ($uriSegments[$i] === $routeSegments[$i]) {
                        $j++;
                    }
                }

                if ($j > 0 && count($params) > 0) {
                    $controller = 'App\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        ErrorController::notFound();
    }
}
