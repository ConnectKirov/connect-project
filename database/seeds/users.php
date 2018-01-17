<?php

$config = include_once "../../config.php";
include_once "../models/User.php";

$user = new User();
$user->firstName = "ADMIN";
$user->role = "ADMIN";
$user->setPassword($config['admin_password']);
$user->save();