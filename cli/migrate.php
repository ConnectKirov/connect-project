<?php

include_once '../functions.php';
include_once '../classes/MigrationInterface.php';
include_once '../classes/Schema.php';
include_once '../classes/Model.php';
include_once '../database/models/Migration.php';
$config = include_once "../config.php";

$command = $argv[1] ?? 'up';
$dir = __DIR__ . "/../database/migrations/";
$template = file_get_contents(__DIR__ . '/migration_template.php');


try {
    $dbh = new PDO("mysql:host={$config['database']['host']};dbname={$config['database']['dbname']}",
        $config['database']['user'], $config['database']['password']);
} catch (PDOException $error) {
    print "DB error: " . $error->getMessage() . "<br/>";
    die();
}

Schema::setConnection($dbh);
Model::init($dbh);


switch ($command) {
    case "up":
        $dbh->query("CREATE TABLE IF NOT EXISTS migrations (
          id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
          filename VARCHAR(255) UNIQUE NOT NULL,
          migratedAt DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        $dbfiles = $dbh
            ->query("SELECT filename FROM migrations")
            ->fetchAll(PDO::FETCH_COLUMN, 1);
        $files = dirToArray($dir);
        $oldClasses = get_declared_classes();
        foreach ($files as $file) {
            if (!in_array($file, $dbfiles)) {
                include_once $dir . $file;
                $newClasses = get_declared_classes();
                $classes = array_values(array_filter(array_diff($newClasses, $oldClasses), function ($class) {
                    return array_search('MigrationInterface', class_implements($class));
                }));
                if (!isset($classes[0])) break;
                $class = $classes[0];
                $oldClasses = get_declared_classes();
                call_user_func("$class::up");
                $migration = new Migration();
                $migration->filename = $file;
                $migration->save();
                print "Migration {$class} {$file} done! \n";

            }
        }

        break;

    case "down":
        // TODO
        break;

    case "create":
        $migrationName = $argv[2] ?? 'migration';
        $filename = date("YmdHis_") . ($migrationName) . '.php';
        $classname = ucfirst(camelize($migrationName));
        $template = str_replace("{name}", $classname, $template);
        file_put_contents($dir . $filename, $template);
        print "Migration {$filename} created \n";
        break;
}