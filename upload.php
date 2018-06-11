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
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload status</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--Style-->
    <style>
    .navbar{
        margin-bottom:0;
        border-radius:0;
    }
    .footer {
        bottom: 0;
        margin: 0 auto !important;
        text-align: center !important;
        width: 100% !important;
        height: 30px;
        position: relative; 
        padding-bottom: : 10px;
        color: black;
      }
	</style>
</head>

<body>
	<nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php">Text and File Dumping App</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li>
            	<a href="main.php">Home</a>
            </li>
            <li>
            	<a href="data.php">Dumped Text</a>
            </li>
            <li>
            	<a href="datafile.php">Dumped Files</a>
            </li>
            <li>
            	<a href="logout.php">Logout</a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>

	<div class='container'>
		<h1 class="page-header">Upload status:</h1>
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
	<hr>
	<footer class="footer">Copyright Abdul Inc. 2018</footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
