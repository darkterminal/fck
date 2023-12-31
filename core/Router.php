<?php

namespace Fckin\core;

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

    public function group($path, $callback)
    {
        $this->routes['group'][$path] = $callback;
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
        return $this->renderView('_404');
    }

    protected function handleStringCallback($callback)
    {
        if (str_contains($callback, '@')) {
            return $this->callControllerMethod($callback);
        }

        return $this->renderView($callback);
    }

    protected function callControllerMethod($callback)
    {
        [$controllerName, $method] = explode('@', $callback);
        $controller = $this->instantiateController($controllerName);
        Application::$app->controller = $controller;

        return call_user_func([$controller, $method], $this->request, $this->response);
    }

    protected function instantiateController($controllerName)
    {
        $controllerClass = '\Fckin\controllers\\' . $controllerName;
        return new $controllerClass();
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return \str_ireplace('{{content}}', $viewContent, $layoutContent);
        include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $val) {
            $$key = $val;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return \str_ireplace('{{content}}', $viewContent, $layoutContent);
    }
}
