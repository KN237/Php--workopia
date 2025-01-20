<?php

// $routes = require basePath('routes.php');

// if (array_key_exists($uri, $routes)) {
//     require(basePath($routes[$uri]));
// } else {
//     http_response_code(404);
//     require(basePath($routes['404']));
// }

class Router
{
    protected $routes = [];

    /**
     * Register a route
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function registerRoute($method, $uri, $controller)
    {

        $this->routes[] = ['method' => $method, 'uri' => $uri, 'controller' => $controller];
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
     * Error method
     *
     * @param integer $httpCode
     * @return void
     */
    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/$httpCode");
        exit;
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
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath($route['controller']);
                return;
            }
        }

        $this->error();
    }
}
