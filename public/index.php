<?php

include '../functions.php';

$resultsRaw = file_get_contents('https://randomuser.me/api/?results=10');
$results = json_decode($resultsRaw, true);

echo render_with_layout('main', ['users' => $results['results']]);
