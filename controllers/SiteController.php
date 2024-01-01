<?php

namespace App\controllers;

use Fckin\core\Controller;
use App\models\Contact;
use App\models\User;

class SiteController extends Controller
{
    protected $user;

    public function __construct()
    {
        if (isAuthenticate()) {
            $this->user = new User();
        }
    }

    public function home() {
        $params = [
            'user' => $this->user?->detail()
        ];
        return $this->render('home', $params);
    }
}
