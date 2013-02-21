<?php # agent_register.php
	
	// this is the registration page for the agents
	
	$page_title = 'Agent Registration';
	include ('includes/header.php');
	
	// Check for form submission
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		//make connection to database
		require ('includes/mysqli_oop_connect.php');
		
		$errors = array();
	
	
	// validate the first name
	if (empty($_POST['agent_first_name'])) {
		$error[] = 'You forgot to enter your first name.';
	} else {
		$afn = $mysqli->real_escape_string(trim($_POST['agent_first_name']));
	}
	
	// validate the last name
	if (empty($_POST['agent_last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$aln = $mysqli->real_escape_string(trim($_POST['agent_last_name']));
	}
	
	// validate the email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your emails address.';
	} else {
		$e = $mysqli->real_escape_string(trim($_POST['email']));
	}
	
	// validate state licensed in 
	if (empty($_POST['license_state'])) {
		$errors[] = 'You forgot to enter the state in which you are licensed.';
	} else {
		$ls = $mysqli->real_escape_string(trim($_POST['license_state']));
	}
	
	// validate dre number
	if (empty($_POST['dre_number'])) {
		$errors[] = 'You forgot to enter your DRE number.';
	} else {
		$dn = $mysqli->real_escape_string(trim($_POST['dre_number']));
	}
	
	// validate contact phone number
	if (empty($_POST['contact_number'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$cn = $mysqli->real_escape_string(trim($_POST['contact_number']));
	}
	
	// validate broker name
	if (empty($_POST['broker_name'])) {
		$errors[] = 'You forgot to enter your Broker name.';
	} else {
		$bn = $mysqli->real_escape_string(trim($_POST['broker_name']));
	}
	
	//validate password
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST ['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = $mysqli->real_escape_string(trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	// check if it is OK to register the agent
	if (empty($errors)) {
		
		
	
	
	
	// insert agent info into database
	$q = "INSERT INTO agents (agent_first_name, agent_last_name, email, license_state,
							  dre_number, contact_number, broker_name, pass, registration_date) VALUES ('$afn', '$aln', '$e', '$ls', '$dn',
						   '$cn', '$bn', SHA1('$p'), NOW() )";
	
	// execute the query
	$mysqli->query($q);
	// this is the procedural way$r = @mysqli_query ($dbc, $q);
	
	// report success of the registration
	// this is the procedural way if ($r) {
	if ($mysqli->affected_rows == 1) { // if it ran ok
	echo '<h1>Thank you!</h1>
	<p>You are now registered.</p>';
	} else {
		echo '<h1>System Error</h1>
		<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
		
		// debugging message:
		echo '<p>' . $mysqli->error . '<br /><br />Query: ' . $q . '</p>';
		// the procedural way echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	} // End of if ($r) IF
	
	
	// close database connection
	$mysqli->close();
	unset($mysqli);
	
	// include the footer.php
	include ('includes/footer.php');
	
	// terminate the script
	exit();
	
	} else { // Report the errors.
		
	 echo '<h1>Error!</h1>
     <p class="error">The following error(s) occurred:<br />';
	 foreach ($errors as $msg) { // Print each error.
	 echo " - $msg<br />\n";
	 }
	 echo '</p><p>Please try again.</p><p><br /></p>';
	
	 } // End of if (empty($errors)) IF.
	 
	 $mysqli->close(); // Close the database connection.
	 unset($mysqli); // remove the variable from exisitence to free up memory
	
} // End of the main Submit conditional.
?>

<h1>Agent Registration</h1>
	<form action="agent_register.php" method="post">
		<p>First Name: <input type="text" name="agent_first_name" size="15" maxlength="20" value="<?php if (isset($_POST['agent_first_name'])) echo $_POST['first_name']; ?>" /></p>
		<p>Last Name: <input type="text" name="agent_last_name" size="15" maxlength="40" value="<?php if (isset($_POST['agent_last_name'])) echo $_POST['last_name']; ?>" /></p>
		<p>State Licensed In: <input type="text" name="license_state" size="2" maxlength="2" value="<?php if (isset($_POST['license_state'])) echo $_POST['license_state']; ?>" /> (example: CA)</p>
		<p>DRE Number: <input type="text" name="dre_number" size="8" maxlength="8" value="<?php if (isset($_POST['dre_number'])) echo $_POST['dre_number']; ?>" /></p>
		<p>Contact Phone Number: <input type="text" name="contact_number" size="10" maxlength="10" value="<?php if (isset($_POST['contact_number'])) echo $_POST['dre_number']; ?>" /></p>
		<p>Broker's Name: <input type="text" name="broker_name" size="15" maxlength="40" value="<?php if (isset($_POST['broker_name'])) echo $_POST['broker_name']; ?>" /></p>
		<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST ['email'])) echo $_POST ['email']; ?>" /> </p>
		<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" /></p>
		<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" /></p>
		<p><input type="submit" name="submit" value="Register" /></p>
	</form>
	
<?php include ('includes/footer.php'); ?>
		
			


