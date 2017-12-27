<?php

$router->get('/users', function () use ($app) {
    return $app->templating->renderWithLayout('users', [
        'users' => User::find()
    ]);
});

$router->get('/user', function (Request $req) use ($app) {
    return $app->templating->renderWithLayout('user', [
        'users' => User::findOne($req->params['id'])
    ]);
});