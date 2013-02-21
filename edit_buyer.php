<?php #edit an existing buyer

$page_title = 'Edit an Buyer';
include ('includes/header.php');
echo '<h1>Edit an Buyer</h1>';

// Check for a valid buyer id via GET or POST
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // from view_buyers.php
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
			if (empty($_POST['buyer_first_name'])) {
				$errors[] = 'You forgot to enter your first name.';
			} else {
				$bfn = mysqli_real_escape_string($dbc, trim($_POST['buyer_first_name']));
			}
			
			// check for last name:
			if (empty($_POST['buyer_last_name'])) {
				$errors[] = 'You forgot to enter your last name.';
			} else {
				$bln = mysqli_real_escape_string($dbc, trim($_POST['buyer_last_name']));
			}
			
			
			if (empty($errors)) { // if everything is entered correclty
				// test for unique last name:
				$q = "SELECT buyer_id FROM buyers WHERE buyer_last_name='$bln' AND buyer_id != $id";
				$r = @mysqli_query($dbc, $q);
				if (mysqli_num_rows($r) == 0) {
					
					//make the query
					$q = "UPDATE buyers SET buyer_first_name='$bfn', buyer_last_name='$bln' WHERE buyer_id=$id LIMIT 1";
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
		
		// retreive buyer info
		$q = "SELECT buyer_first_name, buyer_last_name, license_state, dre_number, contact_number, broker_name, email FROM buyers WHERE buyer_id=$id";
		$r = @mysqli_query ($dbc, $q);
		
		if (mysqli_num_rows($r) == 1) { //valid buyer id, show form
			// get buyer info
			$row = mysqli_fetch_array ($r, MYSQLI_NUM);
			
			// create the form
			echo '<form action="edit_buyer.php" method ="post">
			<p>First Name: <input type="text" name="buyer_first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
			<p>Last Name: <input type="text" name="buyer_last_name" size="15" maxlength="15" value="' . $row[1] . '" /></p>
			<p><input type="submit" name="submit" value="Submit" /></p>
			<input type="hidden" name="id" value="' . $id . '" />
			</form>';
			
			} else { // not valid
				echo '<p class="error">This page has been accessed in error.</p>';
				}
				
			mysqli_close($dbc);
			include ('includes/footer.php');
?>