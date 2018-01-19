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
	<title>Insert data</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
</head>



<body>
	<header class="main-header">
		<h1>Text & File Dumping Server</h1>
		<p>Follow On GitHub: <strong><a href="http://www.github.com/abdulnine7"> abdulnine7</a></strong></p>
	</header>
	​
	<div class="content">
	<div class="box">
		<h2>Paste the text here: </h2>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<form action="copy.php" method=post>
			<textarea name="text" placeholder="Paste text here to dump." required></textarea>
			<input type="submit" class="mybutton paste" value="Paste">
		</form>
	</div>

	<div class="box">
		<h2>Upload Files:</h2>
		<form action="upload.php" method="post" enctype="multipart/form-data">

			<p><input type="file" class="upload" name="fileToUpload[]" id="fileToUpload" data-multiple-caption="{count} files selected" multiple required></p>
			<p><input type="submit" class="mybutton upload" value="Upload" name="submit"></p>
		</form>

	</div>

	<div  class="box">
		<div class="my_wrapper">
		<form action="data.php" method="post" enctype="multipart/form-data">
			<p><input type="submit" class="mybutton getdata" value="Dumped Text" name="submit"></p>
		</form>
		<form action="datafile.php" method="post" enctype="multipart/form-data">
			<p><input type="submit" class="mybutton getdata" value="Dumped Files" name="submit"></p>
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
