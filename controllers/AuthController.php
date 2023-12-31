<?php

namespace Fckin\controllers;

use Fckin\core\Controller;
use Fckin\core\middlewares\AuthMiddleware;
use Fckin\core\Request;
use Fckin\core\Response;
use Fckin\models\Login;
use Fckin\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function login(Request $request, Response $response)
    {
        $login = new Login();
        if ($request->isPost()) {
            $login->loadData($request->getBody());
            if ($login->validate() && $login->login()) {
                $response->redirect('/');
            }
            addToast('error', 'Username or password is invalid');
            return $this->render('login', [
                'model' => $login
            ]);
        }
        return $this->render('login', [
            'model' => $login
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->register()) {
                addToast('success', 'Thanks for registering');
                $response->redirect('/');
                return;
            }
            addToast('error', 'Some input is not valid!');
            return $this->render('register', [
                'model' => $user
            ]);
        }

        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        unAuthorized();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }
}
