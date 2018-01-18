<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">if (confirm("' . $msg . '")){document.location="index.html"}else{document.location="index.html"}</script>';
}

session_start();

if(isset($_SESSION['user']) && isset($_SESSION['pass'])){
	$user = $_SESSION['user'];
	$pass= $_SESSION['pass'];
}
else{
	phpAlert("Log-in to continue");
    die(true);
}

// $myfile = fopen("copied_text.txt", "r+") or die("Can't Open file! copied_text.txt");
// show_source("copied_text.txt");
// fclose($myfile);
?>
<!doctype html>
<html lang="en">

<head>
	<title>Dumped Text Data</title>
	<link rel="stylesheet" type="text/css" href="css/data_style.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
</head>

<body>
	<div id='data'>
		<?php show_source("copied_text.txt"); ?>
	</div>
</body>
</html>