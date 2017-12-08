<?php

include 'functions.php';
$user = ['name' => 'donald'];
echo render('main',['name' => $user['name']]);