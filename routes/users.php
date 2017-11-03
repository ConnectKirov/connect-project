<?php

$router->get(['/users', '/foo'], function ($params) use ($app) {
    $users = fetch_users(15);
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});


$router->get('/user/:name', function($params) use ($app) {
    return "Привет, {$params['name']}";
});
