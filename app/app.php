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

$router->get('/contacts', function() use ($app) {
    return $app->templating->renderWithLayout('contacts');
});

$router->get('/', function() use ($app) {
    return $app->templating->renderWithLayout('index');
});




$router->get('/schedule', function() use ($app) {
    $users = [[
        'name' => 'Иван',
        'lastName' =>'Ургант',
        'avatar' => 'https://randomuser.me/api/portraits/thumb/men/15.jpg',
        'from' => strtotime('12.11.2017 12:00:00'),
        'to' => strtotime('12.11.2017 14:00:00')
        ]];
    $timefrom = strtotime('12.11.2017 10:00:00');
    $timeto = strtotime('13.11.2017 01:00:00');
    $counthours=($timeto-$timefrom)/3600;
    return $app->templating->renderWithLayout('schedule',[
        'users' => $users,
        'timefrom' =>$timefrom,
        'timeto' => $timeto,
        'counthours' => $counthours
        ]);
});

