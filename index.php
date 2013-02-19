<?php
	$page_title = 'Welcome to TenBuyers';
	include ('includes/header.php');
?>
	
	<p><a href="agent_register.php">Agent Sign-up Here!</a>
		<br><br>
		
	<?php
		require ('includes/mysqli_connect.php'); 
		$q = "SELECT CONCAT(agent_last_name, ', ', agent_first_name) as name,
							DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM 					   agents 
							ORDER BY registration_date ASC";
		$r = @mysqli_query ($dbc, $q);	
		
		$num = mysqli_num_rows ($r);
		
		if ($num > 0) {
			
			echo "<p>There are currently $num agents using TenBuyers.</p>";
			
			// Table Header
			echo '<table align="center"
					cellspacing="3" cellpadding="3"
					width="75%">
					<tr><td align="left"><b>Name</b>
					</td><td align="left">
					<b>Date Registered</b></td></tr>';
					
		while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
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
