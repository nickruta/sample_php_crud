<?php # agent_register.php
	
	// this is the registration page for the agents
	
	$page_title = 'Buyer Registration';
	include ('includes/header.php');
	
	// Check for form sub
	// mission
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		//make connection to database
		require ('includes/mysqli_oop_connect.php');
		
		$errors = array();
	
	
	// validate the first name
	if (empty($_POST['buyer_first_name'])) {
		$error[] = 'You forgot to enter your first name.';
	} else {
		$bfn = $mysqli->real_escape_string(trim($_POST['buyer_first_name']));
	}
	
	// validate the last name
	if (empty($_POST['buyer_last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$bln = $mysqli->real_escape_string(trim($_POST['buyer_last_name']));
	}
	
	
	// // validate the email address
	// 			if (empty($_POST['email'])) {
	// 				$errors[] = 'You forgot to enter your emails address.';
	// 			} else {
	// 				$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	// 			}
	// 			
	// 			// validate state licensed in 
	// 			if (empty($_POST['license_state'])) {
	// 				$errors[] = 'You forgot to enter the state in which you are licensed.';
	// 			} else {
	// 				$ls = mysqli_real_escape_string($dbc, trim($_POST['license_state']));
	// 			}
	// 			
	// 			// validate dre number
	// 			if (empty($_POST['dre_number'])) {
	// 				$errors[] = 'You forgot to enter your DRE number.';
	// 			} else {
	// 				$dn = mysqli_real_escape_string($dbc, trim($_POST['dre_number']));
	// 			}
	// 			
	// 			// validate contact phone number
	// 			if (empty($_POST['contact_number'])) {
	// 				$errors[] = 'You forgot to enter your phone number.';
	// 			} else {
	// 				$cn = mysqli_real_escape_string($dbc, trim($_POST['contact_number']));
	// 			}
	// 			
	// 			// validate broker name
	// 			if (empty($_POST['broker_name'])) {
	// 				$errors[] = 'You forgot to enter your Broker name.';
	// 			} else {
	// 				$bn = mysqli_real_escape_string($dbc,trim($_POST['broker_name']));
	// 			}
	// 			
	// 			//validate password
	// 			if (!empty($_POST['pass1'])) {
	// 				if ($_POST['pass1'] != $_POST ['pass2']) {
	// 					$errors[] = 'Your password did not match the confirmed password.';
	// 				} else {
	// 					$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
	// 				}
	// 			} else {
	// 				$errors[] = 'You forgot to enter your password.';
	// 			}
	
	// check if it is OK to register the agent
	if (empty($errors)) {
		
		
	
	
	
	// insert agent info into database
	$q = "INSERT INTO buyers (buyer_first_name, buyer_last_name, add_buyer_date) VALUES ('$bfn', '$bln', NOW() )";
	
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
		// the procedural way echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q .
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

<h1>Buyer Registration</h1>
	<form action="buyer_register.php" method="post">
		<p>First Name: <input type="text" name="buyer_first_name" size="15" maxlength="20" value="<?php if (isset($_POST['buyer_first_name'])) echo $_POST['buyer_first_name']; ?>" /></p>
		<p>Last Name: <input type="text" name="buyer_last_name" size="15" maxlength="40" value="<?php if (isset($_POST['buyer_last_name'])) echo $_POST['buyer_last_name']; ?>" /></p>
		<p><input type="submit" name="submit" value="Register" /></p>
	</form>
	
<?php include ('includes/footer.php'); ?>
		
			


