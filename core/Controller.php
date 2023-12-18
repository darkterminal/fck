<?php

namespace App\core;

class Controller {

    public string $layout = 'default';

    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }
}
