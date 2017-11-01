<?php
include '../functions.php';
include '../classes/User.php';
include '../classes/Template.php';
include '../services/fetch_users.php';

$template = new Template();
$template->setLayout('main'); // layout = ../templates/layouts/main.php
$users = fetch_users(10); //  получаем 10 юзеров
// Добавляем своего юзера
$users[] = new User('Donald','Trump', 'http://static6.businessinsider.com/image/55918b77ecad04a3465a0a63/nbc-fires-donald-trump-after-he-calls-mexicans-rapists-and-drug-runners.jpg');
// выводим их всех в templates/users.php
echo $template->renderWithLayout('users', [
    'users' => $users
]);