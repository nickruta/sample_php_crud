<?php
	session_start();
	$page_title = 'Welcome to TenBuyers';
	include ('includes/header.php');
?>
		
	<?php
		require ('includes/mysqli_connect.php'); 
		$q = "SELECT agent_last_name, agent_first_name, DATE_FORMAT(registration_date, '%M %d, %Y')
		AS dr, agent_id FROM agents ORDER BY registration_date ASC";
							
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows ($r);
		
		if ($num > 0) {
			
			echo "<p>There are currently $num agents using TenBuyers.</p>";
			
			// Table Header for Agents
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
				<td align="left"><a href="edit_agent.php?id=' . $row['agent_id'] . '">Edit</a></td>
				<td align="left"><a href="delete_agent.php?id=' . $row['agent_id'] . '">Delete</a></td>
				<td align="left">' . $row['agent_last_name'] . '</td>
				<td align="left">' . $row['agent_first_name'] . '</td>
				<td align="left">' . $row['dr'] . '</td>
				</tr>';
			}
				
		echo '</table>';
		mysqli_free_result ($r);
		
		} else {
			echo '<p class="error"> There are currently no registered users.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
			
		} // End of if ($r) if.
		// 
		// mysqli_close($dbc); 		
		?>
		
		
		
<?php
	include ('includes/footer.php');
?>
