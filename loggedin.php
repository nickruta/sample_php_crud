<?php

session_start(); //start the session

# page for logged in agents
if (!isset($_SESSION['agent_id'])) {
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