<!-- This file is not Complete. It will be implemented in the buyer registration process-->

<?php
	$page_title ='About';
	include ('includes/header.php');
?>

<?php



// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// check for an uploaded file
	if (isset($_FILES['upload']) && file_exists($_FILES['upload']['tmp_name'])) {
		
		// validate the type, should be pdf
		
		// create the resource
		$fileinfo = $finfo_open
		(FILEINFO_MIME_TYPE);
		
		// check file
		if (finfo_file($fileinfo, $_FILES['upload']['tmp_name']) == 'text/pdf') {
			
			// indicate it passes
			echo '<p><em>OK, the file is ready!</em></p>';
			
			// move the file over to permanenet location (for now it just deletes it)
			unlink($_FILES['upload']['tmp_name']);
			
		} else { // invalid type
			echo '<p style="font-weight: bold; color: #c00">Please upload a PDF document.</p>';
			}
			
			// close the resource
			finfo_close($fileinfo); 
		
	} // end of isset($_FILES['upload'])
} // end of the submitted conditional


?>

<form enctype="multipart/form-data" action="upload_pdf.php" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	<fieldset><legend>Select a PDF document of 512kb or smaller to be uploaded:</legend>
		<p><b>File:</b> <input type="file" name="upload" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
</form>

<?php
	include ('includes/footer.php');
?>