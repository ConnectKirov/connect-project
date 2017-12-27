<?php

date_default_timezone_set('Europe/Moscow');
define('SCHEDULE_HOURS', 16);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=connect', 'root', '');
} catch (PDOException $error) {
    print "DB error: " . $error->getMessage() . "<br/>";
    die();
}

include '../functions.php';
include '../classes/Model.php';
include '../classes/models/User.php';
include '../classes/Template.php';
include '../classes/Router.php';
include '../classes/App.php';
include '../classes/models/Schedule.php';
include_once '../classes/Request.php';
include_once '../classes/Response.php';
include '../services/fetch_users.php';
include '../services/fetch_schedule.php';

$app = new App();
Model::init($dbh);

$template = new Template();
$template->setLayout('main'); // layout = ../templates/layouts/main.php
$app->setTemplating($template);

$router = new Router();

// все роуты, связанные с пользователями, кладем сюда
include '../routes/users.php';

$router->get('/contacts', function () use ($app) {
    return $app->templating->renderWithLayout('contacts');
});

$router->get('/sign-in', function ($req) use ($app) {
    return $app->templating->renderWithLayout('sign_up');
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

$router->get('/', function () use ($app) {
    return $app->templating->renderWithLayout('index');
});


$router->get('/schedule', function () use ($app) {
    return $app->templating->renderWithLayout('schedule');
});


$router->get('/api/schedule', function (Request $req, Response $res) use ($app){
    $start = (new DateTime())->setTime(10, 0);
    $end = (new DateTime())->setTime(10, 0)->modify("+" . SCHEDULE_HOURS - 1 ." hours");

    return $res->json([
        'records' => Schedule::find(),
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
