<?php

$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$connection = new PDO( $dsn, $user, $password );

?>
