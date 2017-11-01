<?php
    include '../function.php';
    $user = ['name' => 'Alex'];
    $json  = file_get_contents('http://randomuser.me/api/?results=10');
    $result = json_decode($json,JSON_OBJECT_AS_ARRAY);
    $users=$result['results'];
     echo render_with_layout('main', ['users'=>$users], 'Content');

