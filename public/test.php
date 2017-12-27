<?php

include_once "../classes/Model.php";
include_once "../classes/models/User.php";
include_once "../classes/models/Schedule.php";

var_dump($_SERVER);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=connect', 'root', '');
} catch (PDOException $error) {
    print "DB error: " . $error->getMessage() . "<br/>";
    die();
}

Model::init($dbh);

if (isset($_POST['firstName'])) {
    $user = new User();
    $user->firstName = $_POST['firstName'];
    $user->save();
    echo "<h2>Created user:</h2>";
    var_dump($user);
}
?>

<form action="?" method="post">
    <input type="text" name="firstName" placeholder="name here"/>
    <button>create</button>
</form>

<h2>Users:</h2>

<?php

var_dump(User::find());