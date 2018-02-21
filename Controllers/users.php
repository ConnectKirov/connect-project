<?php

use App\Lib\Database\Models\{
    AuthToken, User
};
use App\Lib\Http\{
    Request, Response
};

$router->get('/users', function () use ($app) {
    return $app->templating->renderWithLayout('users', [
        'users' => User::find()
    ]);
});

$router->get('/profile', function (Request $req, Response $res) use ($app) {
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
    return $app->templating->renderWithLayout('sign_in', ['vkUrl' => $app->auth->getUrl()]);
});

$router->get('/sign-up', function () use ($app) {
    return $app->templating->renderWithLayout('sign_up');
});
$router->get('/oauth/vk', function (Request $req, Response $res) use ($app) {
    try {
        $token = $app->auth->getToken($req->params['code']);
        $api = new \ATehnix\VkClient\Client();
        $api->setDefaultToken($token);
        $request = new \ATehnix\VkClient\Requests\Request('getProfiles', ['fields' => 'photo,nickname']);
        ['response' => [$vkUser]] = $api->send($request); // ['response' => [ [ 'first_name' => 'John' ] ]
        $user = User::findOne(['vkId' => $vkUser['id']]);
        if ($user) {
            $token = new AuthToken();
            $token->generate();
            $token->user = $user->id;
            $token->dateUntil = (new DateTime())->modify("+ 1 month");
            $token->save();

            $res->setCookie(User::AUTH_COOKIE, $token->token);

            return $res->redirect("/profile/?id={$user->id}");
        } else {
            $user = new User();
            $user->firstName = $vkUser['first_name'];
            $user->lastName = $vkUser['last_name'];
            $user->avatar = $vkUser['photo'];
            $user->vkId = $vkUser['id'];

            $user->save();

            $token = new AuthToken();
            $token->generate();
            $token->user = $user->id;
            $token->dateUntil = (new DateTime())->modify("+ 1 month");
            $token->save();

            $res->setCookie(User::AUTH_COOKIE, $token->token);

            return $res->redirect("/profile/?id={$user->id}");

        }
    } catch (\ATehnix\VkClient\Exceptions\VkException $error) {
        var_dump($error);
        return $app->templating->renderWithLayout('sign_in', ['errors' => ['Ошибка авторизации ВКонтакте']]);
    }
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

    $res->setCookie(User::AUTH_COOKIE, $token->token);

    return $res->redirect("/user/?id={$user->id}");
});
