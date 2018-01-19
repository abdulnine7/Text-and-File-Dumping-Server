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

?>
<!doctype html>
<html lang="en">

<head>
	<title>Dumped Text Data</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
</head>

<body>
	<header class="main-header">
		<h1>Dumped Text</h1>
		<p>Follow On GitHub: <strong><a href="http://www.github.com/abdulnine7"> abdulnine7</a></strong></p>
	</header>
	<div class='content'>
		<div class="box" >
			<?php show_source("copied_text.txt"); ?>
		</div>

		<div  class="box">
			<div class="my_wrapper">
			<form action="datafile.php" method="post" enctype="multipart/form-data">
				<p><input type="submit" class="mybutton getdata" value="Dumped Files" name="submit"></p>
			</form>
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