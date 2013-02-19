<?php
	$page_title = 'Welcome to TenBuyers';
	include ('includes/header.php');
?>
	
	<p><a href="buyer_register.php">Create a new Buyer</a>
		<br><br>
		
	<?php
		require ('includes/mysqli_connect.php'); 
		$q = "SELECT buyer_last_name, buyer_first_name, DATE_FORMAT(add_buyer_date, '%M %d, %Y')
		AS abd, buyer_id FROM buyers ORDER BY add_buyer_date ASC";
							
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows ($r);
		
		if ($num > 0) {
			
			echo "<p>There are currently $num buyers in the TenBuyers Databse.</p>";
			
			// Table Header for Buyers
			echo '<table align="center" cellspacing="3" cellpadding="3"	width="75%">
					<tr>
					<td align="left"><b>Edit</b></td>
					<td align="left"><b>Delete</b></td>
					<td align="left"><b>Last Name</b></td>
					<td align="left"><b>First Name</b></td>
					<td align="left"><b>Date Registered</b></td>
					</tr>';
		
		// Fetch and print all records:			
		while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr>
				<td align="left"><a href="edit_buyer.php?id=' . $row['agent_id'] . '">Edit</a></td>
				<td align="left"><a href="delete_buyer.php?id=' . $row['buyer_id'] . '">Delete</a></td>
				<td align="left">' . $row['buyer_last_name'] . '</td>
				<td align="left">' . $row['buyer_first_name'] . '</td>
				<td align="left">' . $row['abd'] . '</td>
				</tr>';
			}
				
		echo '</table>';
		mysqli_free_result ($r);
		
		} else {
			echo '<p class="error"> There are currently no registered buyers.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
			
		} // End of if ($r) if.
		// 
		// mysqli_close($dbc); 		
		?>
		
		
		
<?php
	include ('includes/footer.php');
?>
