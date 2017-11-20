<?php

$router->get('/users', function () use ($app) {
    $users = fetch_users();
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});

$router->get('/user', function ($params) use ($app) {
    $users = fetch_users($params['name']);

    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});