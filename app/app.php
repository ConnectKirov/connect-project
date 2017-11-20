<?php

include '../functions.php';
include '../classes/User.php';
include '../classes/Template.php';
include '../classes/Router.php';
include '../classes/App.php';
include '../services/fetch_users.php';

$app = new App();

$template = new Template();
$template->setLayout('main'); // layout = ../templates/layouts/main.php
$app->setTemplating($template);

$router = new Router();

// все роуты, связанные с пользователями, кладем сюда
include '../routes/users.php';

$router->get('/contacts', function($params) use ($app) {
    return $app->templating->renderWithLayout('contacts');
});

$router->get('/', function($params) use ($app) {
    return $app->templating->renderWithLayout('index');
});

