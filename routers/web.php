<?php

$app->router->get('/', 'SiteController@home');
$app->router->get('/contact', 'SiteController@contact');
$app->router->post('/contact', 'SiteController@handleContact');

$app->router->get('/login', 'AuthController@login');
$app->router->post('/login', 'AuthController@login');

$app->router->get('/register', 'AuthController@register');
$app->router->post('/register', 'AuthController@register');
