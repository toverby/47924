<?php
require_once ('config_inc.php'); 
require (CONNECTOR);
include ('view_students.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Check for an uploaded file:
	if (isset($_FILES['upload'])) {
		
		// Validate the type. Should be JPEG or PNG.
		$allowed = array ('image/pjpeg', 'image/bmp', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
		if (in_array($_FILES['img']['type'], $allowed)) {
		
			// Move the file over.
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], "../uploads/{$_FILES['upload']['name']}")) {
				echo '<p><em>The file has been uploaded!</em></p>';
			} // End of move... IF.
			
		} else { // Invalid type.
			echo '<p class="error">Please upload a JPEG, BMP or PNG image.</p>';
		}

	} // End of isset($_FILES['upload']) IF.
	
	// Check for an error:
	if ($_FILES['upload']['error'] > 0) {
		echo '<p class="error">The file could not be uploaded because: <strong>';
	
		// Print a message based upon the error.
		switch ($_FILES['upload']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini.';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
				break;
			case 3:
				print 'The file was only partially uploaded.';
				break;
			case 4:
				print 'No file was uploaded.';
				break;
			case 6:
				print 'No temporary folder was available.';
				break;
			case 7:
				print 'Unable to write to the disk.';
				break;
			case 8:
				print 'File upload stopped.';
				break;
			default:
				print 'A system error occurred.';
				break;
		} // End of switch.
		
		print '</strong></p>';
	
	} // End of error IF.
	
	// Delete the file if it still exists:
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		unlink ($_FILES['upload']['tmp_name']);
	}
			
} // End of the submitted conditional.
?>
<DIV id="wrapper">

	<form enctype="multipart/form-data" action="upload_image.php" method="post">
		
		<input type="hidden" name="MAX_FILE_SIZE" value="3100000" />
			
		<fieldset><legend>Select a JPEG or PNG image of 2 megabytes or smaller to be uploaded:</legend>
			
		<p><b>File:</b> <input type="file" name="upload" /></p>
			
		</fieldset>
			
		<div align="center"><input type="submit" name="submit" value="Submit" /></div>

		</form>
	</div>	
</body>

</html>