<?php

function fetch_users($count) {
    $resultsRaw = file_get_contents("https://randomuser.me/api/?results={$count}");
    $results = json_decode($resultsRaw, true);
    $users = [];
    foreach ($results['results'] as $user) {
        $users[] = new User(
            $user['name']['first'],
            $user['name']['last'],
            $user['picture']['thumbnail']
        );
    }
    return $users;
}
