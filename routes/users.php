<?php

$router->get('/users', function ($params) use ($app) {
    $users = fetch_users(15);
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});

$router->get('/user', function ($params) use ($app) {
    $users = fetch_users(15);
    $users = array_filter($users, function (User $user) use ($params) {
        return $user->fistName == $params['name'];
    });

    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});