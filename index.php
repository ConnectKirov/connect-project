<?php

include 'functions.php';
$user = ['name' => 'BOB'];
echo render('main',['name' => $user['name']]);