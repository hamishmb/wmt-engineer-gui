<?php

$db_user = "localhost";

$db['db_host'] = "localhost";
$db['db_user'] = "admin";
$db['db_pass'] = "admin";
$db['db_name'] = "rivercontrolsystem";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
           
}

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>
