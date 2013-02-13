<?php #edit an existing agent

$page_title = 'Edit an Agent';
include ('includes/header.php');
echo '<h1>Edit an Agent</h1>';

// Check for a valid agent id via GET or POST
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // from view_agents.php
	$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
		$id = $_POST['id'];
	} else { // no valid id, kill
		echo '<p class="error">This page has been accessed in error.</p>';
		include ('includes/footer.php');
		exit();
		}
		
		require_once ('includes/mysqli_connect.php');
		
		// check if form has been submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$errors = array();
			
			// check for first name:
			if (empty($_POST['agent_first_name'])) {
				$errors[] = 'You forgot to enter your first name.';
			} else {
				$afn = mysqli_real_escape_string($dbc, trim($_POST['agent_first_name']));
			}
			
			// check for last name:
			if (empty($_POST['agent_last_name'])) {
				$errors[] = 'You forgot to enter your last name.';
			} else {
				$aln = mysqli_real_escape_string($dbc, trim($_POST['agent_last_name']));
			}
			
			// check for state licensed:
			if (empty($_POST['license_state'])) {
				$errors[] = 'You forgot to enter your State licensed in.';
			} else {
				$ls = mysqli_real_escape_string($dbc, trim($_POST['license_state']));
			}
			
			// check for DRE:
			if (empty($_POST['dre_number'])) {
				$errors[] = 'You forgot to enter your DRE number.';
			} else {
				$dn = mysqli_real_escape_string($dbc, trim($_POST['dre_number']));
			}
			
			// check for contact number:
			if (empty($_POST['contact_number'])) {
				$errors[] = 'You forgot to enter your Contact phone number.';
			} else {
				$cn = mysqli_real_escape_string($dbc, trim($_POST['contact_number']));
			}
			
			// check for broker name:
			if (empty($_POST['broker_name'])) {
				$errors[] = 'You forgot to enter your Broker name.';
			} else {
				$bn = mysqli_real_escape_string($dbc, trim($_POST['broker_name']));
			}
			
			// check for email address:
			if (empty($_POST['email'])) {
				$errors[] = 'You forgot to enter your email address.';
			} else {
				$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
			}
			
			if (empty($errors)) { // if everything is entered correclty
				// test for unique email address:
				$q = "SELECT agent_id FROM agents WHERE email='$e' AND agent_id != $id";
				$r = @mysqli_query($dbc, $q);
				if (mysqli_num_rows($r) == 0) {
					
					//make the query
					$q = "UPDATE agents SET agent_first_name='$afn', agent_last_name='$aln', license_state='$ls', dre_number='$dn', contact_number='$cn', broker_name='$bn', email='$e' WHERE agent_id=$id LIMIT 1";
					$r = @mysqli_query ($dbc, $q);
					if (mysqli_affected_rows($dbc) ==1) { //it ran ok
						
						//print message
						echo '<p>The user has been edited.</p>';
						
						} else { // if it did not run ok
							echo '<p class="error">The user could not be edited due to system error. We are sorry for the inconvenience.</p>';
							//public message on error
							echo '<p>' . mysqli_error($dbc)
							. '<br />Query: ' . $q . '</p>'; //debug message
							}
							
				} else { // already registered. 
					echo '<p class="error">The email address has already been registered.</p>';
				}
				
				} else { // report errors
				echo '<p class="error">The following error(s) occurred:<br />';
				foreach ($errors as $msg) {
				
				// Print each error.
				echo " - $msg<br />\n";
				}
				echo '</p><p>Please try again.</p>';
					
				} // end of if (empty($errors)) if.
			
		} // end of submit conditional
		
		// show form
		
		// retreive agent info
		$q = "SELECT agent_first_name, agent_last_name, license_state, dre_number, contact_number, broker_name, email FROM agents WHERE agent_id=$id";
		$r = @mysqli_query ($dbc, $q);
		
		if (mysqli_num_rows($r) == 1) { //valid agent id, show form
			// get agent info
			$row = mysqli_fetch_array ($r, MYSQLI_NUM);
			
			// create the form
			echo '<form action="edit_agent.php" method ="post">
			<p>First Name: <input type="text" name="agent_first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
			<p>Last Name: <input type="text" name="agent_last_name" size="15" maxlength="15" value="' . $row[1] . '" /></p>
			<p>License State: <input type="text" name="license_state" size="2" maxlength="2" value="' . $row[2] . '" /></p>
			<p>DRE Number: <input type="text" name="dre_number" size="8" maxlength="8" value="' . $row[3] . '" /></p>
			<p>Contact Phone Number: <input type="text" name="contact_number" size="10" maxlength="10" value="' . $row[4] . '" /></p>
			<p>Broker Name: <input type="text" name="broker_name" size="15" maxlength="40" value="' . $row[5] . '" /></p>
			<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="' . $row[6] . '" /></p>
			<p><input type="submit" name="submit" value="Submit" /></p>
			<input type="hidden" name="id" value="' . $id . '" />
			</form>';
			
			} else { // not valid
				echo '<p class="error">This page has been accessed in error.</p>';
				}
				
			mysqli_close($dbc);
			include ('includes/footer.php');
?>