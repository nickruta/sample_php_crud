<?php

session_start(); // access the existing session

// if no session exists, redirect user
if (!isset($_SESSION['agent_id'])) {
	
	// needed functions
	require ('includes/login_functions.php');
	redirect_agent();
} else { // cancel the session
	$_SESSION = array(); // clear variables
	session_destroy(); //destory the session
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // destroy cookie
	}


$page_title = 'Logged Out!';
include ('includes/header.php');
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";
include ('includes/footer.php');

?>