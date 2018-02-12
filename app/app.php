<?php

include __DIR__ . "/../vendor/autoload.php";

use App\Lib\App;
use App\Lib\Database\Models\Schedule;
use App\Lib\Database\Models\User;
use App\Lib\Template;
use App\Lib\Database\Model;
use App\Lib\Http\{
    Request, Response, Router
};
use ATehnix\VkClient\Auth;

$config = include_once "../config.php";

date_default_timezone_set('Europe/Moscow');
define('SCHEDULE_HOURS', 16);
error_reporting(E_ALL);

try {
    $dbh = new PDO("mysql:host={$config['database']['host']};dbname={$config['database']['dbname']}",
        $config['database']['user'], $config['database']['password']);
} catch (PDOException $error) {
    print "DB error: " . $error->getMessage() . "<br/>";
    die();
}

include '../functions.php';

$app = new App();


Model::init($dbh);
$auth = new Auth(
    $config['services']['vk']['clientId'],
    $config['services']['vk']['clientSecret'],
    'http://localhost:8090/oauth/vk'
);
$template = new Template();
$template->setLayout('main'); // layout = ../templates/layouts/main.php
$app->setTemplating($template);
$app->setVkAuth($auth);

$router = new Router();

// все роуты, связанные с пользователями, кладем сюда
include '../Controllers/users.php';

$router->get('/contacts', function () use ($app) {
    return $app->templating->renderWithLayout('contacts');
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

$router->put('/api/schedule', function (Request $req, Response $res) use ($app) {
    $user = User::fromRequest($req);
    $input = $req->body;

    $schedule = new Schedule();
    $schedule->dateStart;
    $schedule->user = $user->id;
    $res->status(201);

    return $res->json();
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
