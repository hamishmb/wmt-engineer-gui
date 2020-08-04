<?php

$db_user = "localhost";

$db['db_host'] = "localhost";
$db['db_user'] = "visitoriface";
$db['db_pass'] = "RiverSystemVisitoriface2020";
$db['db_name'] = "rivercontrolsystem";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
           
}

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASS);

mysql_select_db(DB_NAME);

?>
