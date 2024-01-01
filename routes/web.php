<?php

$app->router->get('/', 'SiteController@home');

$app->router->get('/login', 'AuthController@login');
$app->router->post('/login', 'AuthController@login');

$app->router->get('/register', 'AuthController@register');
$app->router->post('/register', 'AuthController@register');

$app->router->get('/profile', 'AuthController@profile');

$app->router->get('/logout', 'AuthController@logout');
