<?php

namespace Fckin\core;

use Fckin\core\middlewares\BaseMiddleware;

class Controller {

    public string $layout = 'default';
    /** @var BaseMiddleware */
    protected array $middlewares = [];
    public string $action = '';

    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddleware()
    {
        return $this->middlewares;
    }
}
