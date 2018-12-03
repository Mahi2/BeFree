<?php

namespace Befree\Router;

/**
 * Class Router
 * @package Befree\Router
 */
class Router
{
    /**
     * the requested url
     * @var string
     */
    private $url;

    /**
     * saved routes
     * @var Route[]
     */
    private $routes = [];

    /**
     * saved named routes
     * @var array
     */
    private $namedRoute = [];


    /**
     * Router constructor
     */
    public function __construct()
    {
        $this->url = $_GET['url'] ?? $_SERVER['REQUEST_URI'] ?? '/';
    }


    /**
     * add a route to the router
     * @param string $path
     * @param mixed $controller
     * @param string $name
     * @param string $method
     * @return Route
     */
    private function add(string $path, $controller, string $name = null, string $method): Route
    {
        $route = new Route($path, $controller);
        $this->routes[$method][] = $route;

        if ($name) {
            $this->namedRoute[$name] = $route;
        }
        return $route;
    }


    /**
     * register a route in all RESTfull methods
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function any(string $path, $controller, string $name = null): Route
    {
        $route = new Route($path, $controller);
        $this->routes['GET'][] = $route;
        $this->routes['POST'][] = $route;
        $this->routes['PUT'][] = $route;
        $this->routes['PATCH'][] = $route;
        $this->routes['DELETE'][] = $route;

        if ($name) {
            $this->namedRoute[$name] = $route;
        }
        return $route;
    }


    /**
     * register routes in GET method
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function get(string $path, $controller, string $name = null): Route
    {
        return $this->add($path, $controller, $name, "GET");
    }


    /**
     * register routes in POST method
     * ajout aussi en post pour pouvoir switcher, vu que le navigateur
     * n'envoie pas de request en PUT, PATCH, DELETE, etc...
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function put(string $path, $controller, string $name = null): Route
    {
        $this->add($path, $controller, $name, 'POST');
        return $this->add($path, $controller, $name, "PUT");
    }


    /**
     * register routes in PATCH method
     * ajout aussi en post pour pouvoir switcher, vu que le navigateur
     * n'envoie pas de request en PUT, PATCH, DELETE, etc...
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function patch(string $path, $controller, string $name = null): Route
    {
        $this->add($path, $controller, $name, 'POST');
        return $this->add($path, $controller, $name, "PATCH");
    }


    /**
     * register routes in  DELETE methods
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function delete(string $path, $controller, string $name = null): Route
    {
        $this->add($path, $controller, $name, 'POST');
        return $this->add($path, $controller, $name, "DELETE");
    }


    /**
     * registration en POST
     * @param string $path
     * @param callable|string $controller
     * @param string $name
     * @return Route
     */
    public function post(string $path, $controller, string $name = null): Route
    {
        return $this->add($path, $controller, $name, "POST");
    }


    /**
     * run the router with a named route
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function url(string $name, array $params = [])
    {
        if (!isset($this->namedRoute[$name])) {
            throw new \Exception(sprintf("No matched routes for %s", $name), 404);
        }
        return $this->namedRoute[$name]->getUrl($params);
    }


    /**
     * @return bool|Route
     * @throws \Exception
     */
    public function run()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            if (isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
                foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                    if ($route->match($this->url)) {
                        return $route;
                    }
                }
            } else {
                throw new \Exception("undefined request method", 500);
            }
            return null;
        }
        throw new \Exception("undefined request method", 500);
    }
}
