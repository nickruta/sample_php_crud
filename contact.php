<?php
	$page_title ='Contact TenBuyers';
	include ('includes/header.php');
?>
<?php #contact tenbuyers 

// check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Minimal form validation
	if (!empty($_POST['name']) && !empty ($_POST['email']) && !empty($_POST['comments']) ) {
		
		// create the body
		$body = "Name: {$_POST['name']}\n \nComments: {$_POST['comments']}";
		
		// make it no longer that 70 char long:
		$body = wordwrap($body, 70);
		
		// send the eamil:
		mail('nickruta@gmail.com', 
			'Contact Form Submission',
			$body, "From: {$_POST['email']}");
			
			// Print a message
			echo '<p><em>Thank you for contacting TenBuyers. We will reply as soon as possible.</em></p>';
			
			// Clear $_POST (so that the form is not sticky):
			$_POST = arrary();
	} else {
		echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
	}
} // end of main isset() IF

// Create the HTML form:
?>

<p>Please fill out this form to contact me.</p>
<form action="contact.php" method="post">
	<p>Name: <input type="text"
		name="name" size="30" maxlength="60" value="<?php if 	(isset($_POST['name']))
		echo $_POST['name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email']))
		echo $_POST['email']; ?>" /></p>
		<p>Comments: <textarea name="comments" rows="5" cols="30"><?php if (isset ($_POST['comments'])) echo $_POST ['comments']; ?></textarea></p>
		<p><input type="submit" name="submit" value="Send!" /></p>
</form>



<?php
	include ('includes/footer.php');
?>