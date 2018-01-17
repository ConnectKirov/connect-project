<?php

$config = include_once "../example-config.php";

date_default_timezone_set('Europe/Moscow');
define('SCHEDULE_HOURS', 16);
define('COOKIE_TOKEN', 'COOKIE_TOKEN');
error_reporting(E_ALL);

try {
    $dbh = new PDO("mysql:host={$config['database']['host']};dbname={$config['database']['dbname']}",
        $config['database']['user'], $config['database']['password']);
} catch (PDOException $error) {
    print "DB error: " . $error->getMessage() . "<br/>";
    die();
}

include '../functions.php';
include '../classes/Model.php';
include '../classes/models/User.php';
include '../classes/models/AuthToken.php';
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
$router->post('/sign-in', function (Request $req, Response $res) use ($app) {
    $user = User::find([
        'email' => $req->body['email']
    ])[0];
    if ($user->comparePassword($req->body['password'])) {
        return $res->redirect("/user/?id={$user->id}");
    } else {
        echo '666';
    }
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


$router->get('/api/schedule', function (Request $req, Response $res) use ($app) {
    $start = (new DateTime())->setTime(10, 0);
    $end = (new DateTime())->setTime(10, 0)->modify("+" . SCHEDULE_HOURS - 1 . " hours");

    return $res->json([
        'records' => Schedule::find(),
        'schedule' => [
            'dateFrom' => $start->format(DATE_ISO8601),
            'dateTo' => $end->format(DATE_ISO8601),
            'hours' => SCHEDULE_HOURS,
            'currentDate' => (new DateTime())->setTime(0, 0)->format(DATE_ISO8601)
        ]
    ]);
});

$router->put('/api/schedule/add_person', function (Request $req, Response $res) use ($app) {
    $arr = [
        'status' => 'ok'
    ];
    return $res->json($arr);
});

$router->get('/schedule', function () use ($app) {
    $date = date('Y-m-d');
    $timefrom = strtotime($date . ' 10:00:00');
    $timeto = strtotime($date . ' 01:00:00') + 24 * 3600;
    $counthours = ($timeto - $timefrom) / 3600 + 1;
    return $app->templating->renderWithLayout('schedule', [
        'timefrom' => $timefrom,
        'timeto' => $timeto,
        'counthours' => $counthours,
        'date' => $date
    ]);
});
