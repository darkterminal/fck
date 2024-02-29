<?php

namespace App\controllers;

use App\models\Contact;
use Fckin\core\Controller;
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

    public function component() {
        $this->setLayout('demo');
        $contact = new Contact();
        return $this->render('component', [
            'model' => $contact
        ]);
    }
}
