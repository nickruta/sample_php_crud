<?php
// this script is for deleting an agent. it is accessed via admin.php
$page_title = 'Delete an Agent';
include ('includes/header.php');
echo '<h1>Delete an Agent</h1>';


// check for a valid agent through GET or POST
if ( (isset($_GET['id'])) &&
	(is_numeric($_GET['id'])) ) {
		$id = $_GET['id'];
		
	} elseif ( (isset($_POST['id'])) &&
		(is_numeric($_POST['id'])) ) {
			$id = $_POST['id'];
		} else {
			echo '<p class="error">This page has been accessed in error.</p>';
			include ('includes/footer.php');
			exit();
		}
		
	require_once ('includes/mysqli_connect.php');
	
	// check if form was submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($_POST['sure'] == 'Yes') { //delete the record
		
			// make the query
			$q = "DELETE FROM agents WHERE agent_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);

	if (mysqli_affected_rows($dbc) == 1) { // if it ran correctly
		echo '<p>The agent has been deleted.</p>';
	} else { // if the query did not run correctly
		echo '<p class="error">The user could not be deleted due to a system error.</p>';
		echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // debug message
	}
	
} else { // no delete confirmation
	echo '<p>The agent has NOT been deleted.</p>';
	}
	
} else { // display form
	// get agent's info
	$q = "SELECT CONCAT(agent_last_name, ', ', agent_first_name) FROM agents WHERE agent_id=$id";
	$r = @mysqli_query ($dbc, $q);
	
	if (mysqli_num_rows($r) == 1) {
		
		// get agent info
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// display record being deleted
		echo "<h3>Name: $row[0]</h3>
		Are you sure you want to delete this agent?";
		
		// create the form
		echo '<form action ="delete_agent.php" method="post">
		<input type="radio" name="sure"
		value="Yes" /> Yes
		<input type="radio" name="sure"
		value="No" checked="checked" /> No
		<input type="submit" name="submit" value="Submit" />
		<input type="hidden" name="id"
		value="' . $id . '" />
		</form>';
		
		} else { // not valid agent id
			echo 
			'<p class="error">This page has been accessed in error.</p>';
			}
			
	
	} // end of main submission conditional
	
	mysqli_close($dbc);
	
	include ('includes/footer.php');
?>