<?php
namespace App\core;

class Response {
    public function setStatusCode(int $code) {
        http_response_code($code);
    }
}
