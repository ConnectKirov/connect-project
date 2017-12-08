<?php

include 'functions.php';
$user = ['name' => 'IVAN'];
echo render('main',['name' => $user['name']]);