<?php

namespace Fckin\core;

use Fckin\core\exceptions\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];
    protected string $routePrefix = '';

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = strtolower($this->request->getPath());
        $method = strtolower($this->request->method());
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return $this->notFoundResponse();
        }

        if (is_string($callback)) {
            return $this->handleStringCallback($callback);
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    protected function notFoundResponse()
    {
        $this->response->setStatusCode(404);
        throw new NotFoundException();
    }

    protected function handleStringCallback($callback)
    {
        if (str_contains($callback, '@')) {
            return $this->callControllerMethod($callback);
        }
    }

    protected function callControllerMethod($callback)
    {
        [$controllerName, $method] = explode('@', $callback);

        $controller = $this->instantiateController($controllerName);
        Application::$app->controller = $controller;
        Application::$app->controller->action = $method;
        
        foreach (Application::$app->controller->getMiddleware() as $middleware)
        {
            $middleware->execute();
        }

        return call_user_func([$controller, $method], $this->request, $this->response);
    }

    protected function instantiateController($controllerName)
    {
        $controllerClass = '\Fckin\controllers\\' . $controllerName;
        return new $controllerClass();
    }
}
