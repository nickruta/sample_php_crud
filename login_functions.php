<?php
#the login functions for login_page.php

function redirect_agent ($page = 'index.php') {
	# Start defining the URL
	$url = 'http://' . $_SERVER ['HTTP_HOST'] . ($_SERVER ['PHP_SELF']);
	
	#Remove trailing slashes
	$url = rtrim($url, '/\\');
	
	# Add the page
	$url .= '/' . $page;
	
	#redirect the user
	header("Location: $url");
	exit(); //quit the script
}

# validate the login form data
function check_login($dbc, $email = '', $pass = '') {
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($email));
	}
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($pass));
	}
	if (empty($errors)) { #if everything is ok
	    #retreive agent_id and agent_first_name for that email/pass combo
		$q = "SELECT agent_id, agent_first_name FROM agents WHERE email='$e' AND pass=SHA1('$p')";
		$r = @mysqli_query ($dbc, $q);
	}
	# check the result
	if (mysqli_num_rows($r) == 1) {
		#fetch the record
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		#return true and the record
		return array(true, $row);
	} else { //not a match
		$errors [] = 'The email address and password entered do not match those on file.';
	} 
} // end of empty($errors) if.

//return false and the errors:
return array(false, $errors);
} # end of check_login() function
