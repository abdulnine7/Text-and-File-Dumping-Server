
<?php

$target_dir = "uploads/";
$name_array = $_FILES['fileToUpload']['name'];
$tmp_name_array = $_FILES['fileToUpload']['tmp_name'];
$type_array = $_FILES['fileToUpload']['type'];
$size_array = $_FILES['fileToUpload']['size'];

$successCount = 0;

if (!isset($_FILES['fileToUpload'])){
	echo "<script type='text/javascript'>alert('Please select atleast one file.'); window.open('/copy/','_top')</script>";
	die();
}

echo "<b>Status:</b>";

for ($i=0; $i < count($tmp_name_array); $i++) { 

	$msg ="";
	$status = true;

	// Check if file already exists
	if (file_exists($target_dir.$name_array[$i])) {
	    $msg = "File " . $name_array[$i] ." already exists.<br>";
	    $status = false;
	}
	// Check file size
	if ($size_array[$i] > 512000000 ) {
	    $msg = "File " . $name_array[$i]. " is larger than 512MB.<br>";
	    $status = false;
	}
	// if everything is ok, try to upload file
	if ($status){
		if (move_uploaded_file($tmp_name_array[$i], $target_dir.$name_array[$i])) {
			$msg = "The file ". $name_array[$i] . " has been uploaded.<br>";
			$successCount++;
		}else {
	    $msg = "Failed to upload file " . $name_array[$i] . ".<br>";
		}
	}

	echo "<p><i>File #" . ($i+1) . ":</i>";
	echo "<br><i>Name: </i>" .  $name_array[$i];
	echo "<br><i>Type: </i>" . $type_array[$i];
	echo "<br><i>Size: </i>" . $size_array[$i] . " bytes.";
	echo "<br><i>Message: </i>" . $msg . "</p>";
}

echo "<b><i>" . $successCount . " success and " . (count($tmp_name_array) - $successCount) . " failures.</i></b>";