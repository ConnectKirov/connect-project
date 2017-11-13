<?php
/**
 * @param $count int Количество пользователей
 *
 * @return User[]
 */
function fetch_users($count = 10) {
    $mysqli = mysqli_connect("localhost", "root", "", "connect")
        or die('Connection failure');

    $query = mysqli_query($mysqli, 'SELECT * FROM `users`');
    $users = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $users = array_map(function ($user) {
        return new User(
            $user['firstName'],
            $user['lastName'],
            $user['avatar']
        );
    }, $users);

    return $users;
}
