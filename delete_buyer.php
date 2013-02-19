<?php
// this script is for deleting a buyer. 
$page_title = 'Delete a Buyer';
include ('includes/header.php');
echo '<h1>Delete Buyer</h1>';


// check for a valid buyer through GET or POST
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
			$q = "DELETE FROM buyers WHERE buyer_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);

	if (mysqli_affected_rows($dbc) == 1) { // if it ran correctly
		echo '<p>The buyer has been deleted.</p>';
	} else { // if the query did not run correctly
		echo '<p class="error">The buyer could not be deleted due to a system error.</p>';
		echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // debug message
	}
	
} else { // no delete confirmation
	echo '<p>The buyer has NOT been deleted.</p>';
	}
	
} else { // display form
	// get buyer's info
	$q = "SELECT CONCAT(buyer_last_name, ', ', buyer_first_name) FROM buyers WHERE buyer_id=$id";
	$r = @mysqli_query ($dbc, $q);
	
	if (mysqli_num_rows($r) == 1) {
		
		// get buyer info
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// display record being deleted
		echo "<h3>Name: $row[0]</h3>
		Are you sure you want to delete this buyer?";
		
		// create the form
		echo '<form action ="delete_buyer.php" method="post">
		<input type="radio" name="sure"
		value="Yes" /> Yes
		<input type="radio" name="sure"
		value="No" checked="checked" /> No
		<input type="submit" name="submit" value="Submit" />
		<input type="hidden" name="id"
		value="' . $id . '" />
		</form>';
		
		} else { // not valid buyer id
			echo 
			'<p class="error">This page has been accessed in error.</p>';
			}
			
	
	} // end of main submission conditional
	
	mysqli_close($dbc);
	
	include ('includes/footer.php');
?>