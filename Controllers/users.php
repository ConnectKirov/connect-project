<?php

use App\Lib\Http\Request;
use App\Lib\Http\Response;

$router->get('/users', function () use ($app) {
    return $app->templating->renderWithLayout('users', [
        'users' => User::find()
    ]);
});

$router->get('/user', function (Request $req, Response $res) use ($app) {
    $user = User::findOne($req->params);

    if ($user) {
        return $app->templating->renderWithLayout('user', [
            'user' => $user
        ]);
    } else {
        $res->status(404);
        return $app->templating->renderWithLayout('errors/404', [
            'message' => 'Пользователь не найден'
        ]);
    }
});

$router->get('/sign-in', function ($req) use ($app) {
    return $app->templating->renderWithLayout('sign_in');
});

$router->get('/sign-up', function () use ($app) {
    return $app->templating->renderWithLayout('sign_up');
});

$router->post('/sign-up', function (Request $req, Response $res) use ($app) {
    $user = new User();
    $user->email = $req->body['email'];
    $user->setPassword($req->body['password']);
    $user->firstName = $req->body['firstName'];
    $user->save();

    return $res->redirect("/user/?id={$user->id}");
});

$router->post('/sign-in', function (Request $req, Response $res) use ($app) {
    $user = User::findOne(['email' => $req->body['email']]);
    $errors = [];
    if (!$user) {
        $errors[] = 'Пользователь не найден';
    }
    if ($user && !$user->comparePassword($req->body['password'])) {
        $errors[] = 'Пароль не совпадает';
    }
    if (count($errors)) {
        return $app->templating->renderWithLayout('sign_in', [
            'errors' => $errors
        ]);
    }
    $token = new AuthToken();
    $token->generate();
    $token->user = $user->id;
    $token->dateUntil = (new DateTime())->modify("+ 1 month");
    $token->save();

    $res->setCookie(COOKIE_TOKEN, $token->token);

    return $res->redirect("/user/?id={$user->id}");
});
