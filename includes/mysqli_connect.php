<?php # mysqli_connect.php

// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the databse, and sets the encoding.
	
	// Set the databse access info as constants
	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', 'root');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'tenbuyers');
	
	// Make the connection
	$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		   OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
		
	// Set the encoding
	mysqli_set_charset($dbc, 'utf8');