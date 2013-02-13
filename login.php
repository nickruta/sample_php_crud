<?php
# This script processes the login form
# 
# Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	#for processing login
	require ('includes/login_functions.php');
	#make the database connection
	require ('includes/mysqli_connect.php');
	
	#validate form data
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	#if info is correct, log agent in
	if ($check) {
		session_start();
		$_SESSION['agent_id'] = 
		$data['agent_id'];
		$_SESSION['agent_first_name'] =
		$data['agent_first_name'];
		
	
	#redirect the user to loggedin.php
	redirect_agent('loggedin.php');
} else {
	$errors = $data;
}
mysqli_close($dbc);
}
include ('login_page.php');

?>
