<?php
use Fckin\core\Application;

/** @var Application $app */

$app->router->get('/users/[{userId}]', function($params) {
    thefck(getParam('userId'));
    echo !empty($params['userId']) ? "Found userID: " . $params['userId'] : "All users";
});
$app->router->get('/user/{userId}/post/{postId}', function($params) {
    echo "UserID " . $params['userId'] . " PostID " . $params['postId'];
});

$app->router->get('/', 'SiteController@home');
$app->router->get('/component', 'SiteController@component');

$app->router->get('/login', 'AuthController@login');
$app->router->post('/login', 'AuthController@login');

$app->router->get('/register', 'AuthController@register');
$app->router->post('/register', 'AuthController@register');

$app->router->get('/profile', 'AuthController@profile');

$app->router->get('/logout', 'AuthController@logout');
