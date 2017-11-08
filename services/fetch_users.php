<?php
/**
 * @param $count int Количество пользователей
 *
 * @return User[]
 */
function fetch_users($count = 10) {
    $resultsRaw = file_get_contents(__DIR__ . "/../data/users.json");
    $results = json_decode($resultsRaw, true);
    $users = array_map(function ($user) {
        return new User(
            $user['name']['first'],
            $user['name']['last'],
            $user['picture']['thumbnail']
        );
    }, $results['results']);

    return $users;
}
