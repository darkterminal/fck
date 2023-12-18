<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;

class SiteController extends Controller
{
    public function home() {
        $params = [
            'name' => 'darkterminal'
        ];
        return $this->render('home', $params);
    }

    public function contact() {
        $params = [
            'name' => 'darkterminal'
        ];
        return $this->render('contact', $params);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        \dump($body);
        return 'handling submitted data!';
    }
}
