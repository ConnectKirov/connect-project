<?php

$router->get('/users', function ($params) use ($app) {
    $users = fetch_users(15);
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});