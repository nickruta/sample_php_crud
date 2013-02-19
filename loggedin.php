<?php

session_start(); //start the session

# page for logged in agents


// validate the HTTP_USER_AGENT
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
	
	// include functions and redirect agent
	require ('includes/login_functions.php');
	redirect_agent();
}

//set the page title
$page_title = 'Logged in!';

//include the HTML header
include ('includes/header.php');

// print success message
echo "<h1>Logged in!</h1>
<p> You are now logged in, {$_SESSION['agent_first_name']}.</p>
<p><a href=\"logout.php\">Logout</a></p>";

include ('includes/footer.php');

?>