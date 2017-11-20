<?php

$router->get('/users', function ($params) use ($app) {
    $users = fetch_users(15);
    return $app->templating->renderWithLayout('users', [
        'users' => $users
    ]);
});

$router->get('/user', function ($params) use ($app) {
    $users = fetch_users(15);
    $user = array_filter($users,function ($a){
        return ($a->fistName==$_GET['name']);
    });
    return $app->templating->renderWithLayout('users', [
        'users' => $user
    ]);
});