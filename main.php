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
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--Style-->
    <style>
    .navbar{
        margin-bottom:0;
        border-radius:0;
    }
    input[type="file"]{
    	padding-bottom: 40px;
    }
    textarea{
    	min-height: 150px;
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
          <a class="navbar-brand" href="#">Text and File Dumping App</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active">
            	<a href="#">Home<span class="sr-only">(current)</span></a>
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

	<div class="container">
	<h1 class="page-header">Home</h1>
	​
	<div class="panel panel-default">
		<div class="panel-heading">
          <h2 class="panel-title">Paste the text here:</h2>
        </div>
        <div class="panel-body">
          <form action="copy.php" method=post>
          	<div class="form-group">
			<textarea name="text" class="form-control" placeholder="Paste text here to dump." required></textarea>
			<br>
			<input type="submit" class="form-control btn btn-info" value="Paste">
			</div>
		</form>
        </div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
          <h2 class="panel-title">Upload Files:</h2>
    </div>
    <div class="panel-body">
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="file" class="form-control" name="fileToUpload[]" data-multiple-caption="{count} files selected" multiple required>
					<br>
					<input type="submit" class="form-control btn btn-info" value="Upload" name="submit">
				</div>
			</form>
		</div>
	</div>

	</div>
	<hr>
	<footer class="footer">Copyright Abdul Inc. 2018</footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
