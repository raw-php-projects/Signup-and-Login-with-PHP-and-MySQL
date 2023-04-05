<?php

$hostname = 'localhost';
$dbname   = 'login_db';
$username = 'root';
$password = '';

$mysqli = new mysqli( $hostname, $username, $password, $dbname );

if( $mysqli->connect_errno ){
  die( "Failed to connect to MySQL: " . $mysqli -> connect_error );
}

/* Deactivate reporting */
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_OFF;

return $mysqli;