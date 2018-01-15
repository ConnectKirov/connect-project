<?php


include_once "./create_table_users.php";
include_once "./users_add_phone.php";

(new CreateUsersTableMigration())->up();
(new CreateUsersTableMigration())->down();