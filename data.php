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
    <title>Dumped Text</title>
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
    .mycode{
    	overflow-wrap: normal;
			overflow-wrap: break-word;
			background-color: #f9f2f4;
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
            <li class="active">
            	<a href="#">Dumped Text<span class="sr-only">(current)</span></a>
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
	<h1 class="page-header">Dumped Text</h1>

	<div class="panel panel-default" >
		<div class="panel-heading">
        <h2 class="panel-title">Text data:</h2>
    </div>
		<div class="panel-body mycode">
			<?php show_source("copied_text.txt"); ?>
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
