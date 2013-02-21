<?php
// this file contains the database connection info

// set the database access info as constants
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'root');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tenbuyers');

// make the connection
$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// verify the connection
if ($mysqli->connect_error) {
	echo $mysqli->connect_error;
	unset($mysqli);

} else { // establish the encoding
	$mysqli->set_charset('utf8');
	}