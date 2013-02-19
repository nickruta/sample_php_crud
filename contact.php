<?php
	$page_title ='Contact TenBuyers';
	include ('includes/header.php');
?>
<?php #contact tenbuyers 

// check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// this function takes one argument, a string. 
	// It returns a clean version of that string
	// Clean version can be empty or just remove all newline characters
	function spam_scrubber($value) {
		
		// list of very bad values
		$very_bad = array('to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:');
		
		//if any of the very bad strings are in submitted value, return empty string
		foreach ($very_bad as $v) {
			if (stripos($value, $v) !== false) return '';
		}
		
		// replace any newline characters with spaces:
		$value = str_replace(array( "\r", "\n", "%0a", "%0d"), ' ', $value);
		
		//return the value
		return trim($value);
	} // end of spam_scrubber() function
	
	// clean the form data
	$scrubbed = array_map('spam_scrubber', $_POST);
	
	// form validation to remove basic spam techniques
	if (!empty($scrubbed['name']) && !empty($scrubbed['email']) && !empty($scrubbed['comments']) ) {
		
		//create the body:
		$body = "Name: {$scrubbed['name']}\n\nComments: {$scrubbed['comments']}";
		
		// make it no longer than 70 characters
		$body = wordwrap($body, 70);
		
		// send the email:
		mail('nickruta@gmail.com', 'Contact Form Submission', $body, "From: {$scrubbed['email']}");
	
			
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
		name="name" size="30" maxlength="60" value="<?php if 	(isset($scrubbed['name']))
		echo $scrubbed['name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($scrubbed['email']))
		echo $scrubbed['email']; ?>" /></p>
		<p>Comments: <textarea name="comments" rows="5" cols="30"><?php if (isset ($scrubbed['comments'])) echo $scrubbed['comments']; ?></textarea></p>
		<p><input type="submit" name="submit" value="Send!" /></p>
</form>



<?php
	include ('includes/footer.php');
?>