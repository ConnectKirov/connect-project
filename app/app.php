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


$router->get('/ajax',function () use ($app){
    $users = [[
        'name' => 'Иван',
        'lastName' =>'Ургант',
        'avatar' => 'https://randomuser.me/api/portraits/thumb/men/15.jpg',
        'from' => strtotime($_POST['date']. ' 10:00:00'),
        'to' => strtotime($_POST['date']. ' 12:00:00')
    ],[
        'name' => 'Дмитрий',
        'lastName' =>'Ургант',
        'avatar' => 'https://randomuser.me/api/portraits/thumb/men/15.jpg',
        'from' => strtotime($_POST['date']. '12:00:00'),
        'to' => strtotime($_POST['date']. ' 14:00:00')
    ]];
    $timefrom = strtotime($_POST['date']. ' 10:00:00');
    $timeto = strtotime($_POST['date']. ' 01:00:00')+24*3600;
    $counthours=($timeto-$timefrom)/3600+1;
    return json_encode([
        'users' =>$users,
        'timefrom' =>$timefrom,
        'timeto' => $timeto,
        'counthours' => $counthours]);
});

$router->get('/schedule', function() use ($app) {
    $date =date('Y-m-d');
    $timefrom = strtotime($date.' 10:00:00');
    $timeto = strtotime($date.' 01:00:00')+24*3600;
    $counthours=($timeto-$timefrom)/3600+1;
    return $app->templating->renderWithLayout('schedule',[
        'timefrom' =>$timefrom,
        'timeto' => $timeto,
        'counthours' => $counthours,
        'date'=>$date
        ]);
});

