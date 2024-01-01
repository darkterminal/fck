<?php

namespace Fckin\controllers;

use Fckin\core\Controller;
use Fckin\core\Request;
use Fckin\models\Contact;
use Fckin\models\User;

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

    public function contact() {
        $contact = new Contact();
        $params = [
            'model' => $contact,
            'user' => $this->user?->detail()
        ];
        return $this->render('contact', $params);
    }
}
