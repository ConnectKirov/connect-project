<?php

include_once "../classes/Model.php";
include_once "../classes/models/User.php";
include_once "../classes/models/Schedule.php";


try {
    $dbh = new PDO('mysql:host=localhost;dbname=connect', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

Model::$PDO = $dbh;

var_dump(Schedule::find());