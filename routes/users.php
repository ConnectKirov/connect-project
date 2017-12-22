<?php

$router->get('/users', function () use ($app) {
    $users = fetch_users();
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});

$router->get('/user', function (Request $req) use ($app) {
    $users = fetch_users($req->params['name']);

    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});