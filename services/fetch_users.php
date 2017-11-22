<?php
/**
 * @param $count int Количество пользователей
 *
 * @return User[]
 */
function fetch_users($name = null) {
    $mysqli = mysqli_connect("localhost", "root", "", "connect")
        or die('Connection failure');

    $query = $name
        ? "SELECT * FROM users WHERE firstName = '{$name}'"
        :  "SELECT * FROM users";
    $result = mysqli_query($mysqli, $query);

    // mysqli_query возвращает true если ничего не найдено
    if (is_bool($result)) {
        return [];
    }

    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $users = array_map(function ($user) {
        return new User(
            $user['firstName'],
            $user['lastName'],
            $user['avatar']
        );
    }, $users);

    return $users;
}
