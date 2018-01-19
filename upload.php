<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">if (confirm("' . $msg . '")){document.location="index.html"}else{document.location="index.html"}</script>';
}

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['pass'])){
	$user = $_SESSION['user'];
	$pass= $_SESSION['pass'];
}
else{
	phpAlert("Log-in to continue");
    die(true);
}

$target_dir = "uploads/";
$name_array = $_FILES['fileToUpload']['name'];
$tmp_name_array = $_FILES['fileToUpload']['tmp_name'];
$type_array = $_FILES['fileToUpload']['type'];
$size_array = $_FILES['fileToUpload']['size'];

$successCount = 0;

if (!isset($_FILES['fileToUpload'])){
	phpAlert("Please select atleast one file");
	die();
}

?>

<!doctype html>
<html lang="en">

<head>
	<title>Upload Status</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
</head>

<body>
	<header class="main-header">
		<h1>Upload Status</h1>
		<p>Follow On GitHub: <strong><a href="http://www.github.com/abdulnine7"> abdulnine7</a></strong></p>
	</header>
	<div class='content'>
		<div class="box" >
			<?php

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
			?>
		</div>

		<div  class="box">
			<div class="my_wrapper">
			<form action="main.php" method="post" enctype="multipart/form-data">
				<p><input type="submit" class="mybutton getdata" value="⬅️  Back To Main" name="submit"></p>
			</form>
			<form action="logout.php" method="post" enctype="multipart/form-data">
				<p><input type="submit" class="mybutton logout" value="Logout" name="submit"></p>
			</form>
			</div>
		</div>

	</div>
	<footer>Copyright Abdul Inc. 2018</footer>

</body>
</html>