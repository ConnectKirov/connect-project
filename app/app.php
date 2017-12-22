<?php

date_default_timezone_set('Europe/Moscow');
define('SCHEDULE_HOURS', 16);

include '../functions.php';
include '../classes/User.php';
include '../classes/Template.php';
include '../classes/Router.php';
include '../classes/App.php';
include '../classes/Schedule.php';
include_once '../classes/Request.php';
include_once '../classes/Response.php';
include '../services/fetch_users.php';
include '../services/fetch_schedule.php';

$app = new App();

$template = new Template();
$template->setLayout('main'); // layout = ../templates/layouts/main.php
$app->setTemplating($template);

$router = new Router();

// все роуты, связанные с пользователями, кладем сюда
include '../routes/users.php';

$router->get('/contacts', function () use ($app) {
    return $app->templating->renderWithLayout('contacts');
});

$router->get('/', function () use ($app) {
    return $app->templating->renderWithLayout('index');
});


$router->get('/schedule', function () use ($app) {
    $schedule = fetch_schedule();

    $timefrom = strtotime('12.11.2017 10:00:00');
    $timeto = strtotime('13.11.2017 01:00:00');
    $counthours = ($timeto - $timefrom) / 3600 + 1;
    return $app->templating->renderWithLayout('schedule', [
        'records' => fetch_schedule(),
        'timefrom' => $timefrom,
        'timeto' => $timeto,
        'counthours' => $counthours
    ]);
});


$router->get('/ajax/schedule', function (Request $req, Response $res) use ($app){
    $start = (new DateTime())->setTime(10, 0);
    $end = (new DateTime())->setTime(10, 0)->modify("+" . SCHEDULE_HOURS - 1 ." hours");

    return $res->json([
        'records' => fetch_schedule($req->params),
        'schedule' => [
            'dateFrom' => $start->format(DATE_ISO8601),
            'dateTo' => $end->format(DATE_ISO8601),
            'hours' => SCHEDULE_HOURS,
            'currentDate'=> (new DateTime())->setTime(0, 0)->format(DATE_ISO8601)
        ]
    ]);
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
