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

// $fnames=glob("uploads/*.*");

function getFileNames(){
	$filenames = array();
	$dir = "uploads";

	// Open a directory, and read its contents
	if (is_dir($dir)){
	  if ($dh = opendir($dir)){
	  	$i = 0;
	    while (($file = readdir($dh)) !== false){
	    	if(!is_dir($file)){
	    		$filenames[$i]['name'] = $file;
	    		$filenames[$i]['date'] = date("d F Y",filemtime("uploads/". $file));
	      		$i++;
	      	}
	      //echo "filename:" . $file . "<br>";
	    }
	    closedir($dh);
	  }
	}
	usort($filenames, function($a, $b) {
  return new DateTime($b['date']) <=> new DateTime($a['date']);
});
	return $filenames;
}

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dumped Files</title>
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
            <li class="active">
            	<a href="#">Dumped Files<span class="sr-only">(current)</span></a>
            </li>
            <li>
            	<a href="logout.php">Logout</a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

	<div class='container'>
		<h1 class="page-header">Dumped Files</h1>
			<table class="table table-striped table-bordered table-hover table-condensed">
			  <tr>
			    <th>Sr No. </th>
			    <th width="60%">File Name</th>
			    <th>Date Modified</th>
			    <th>Size</th>
			  </tr>
			  
			<?php $i = 1;
			$files = getFileNames();
				foreach ($files as $file) {
					echo "<tr>";
					echo "<td>" . $i . "</td>";
					echo "<td title=". $file['name'] .">" . "<a download href=\"uploads/". $file['name'] . "\">" . $file['name'] . "</a></td>";
					echo "<td>" . date("d F Y",filemtime("uploads/". $file['name'])) . "</td>";
					echo "<td>" . formatSizeUnits(filesize("uploads/". $file['name'])) . "</td>";
					echo "</tr>";
					$i++;
				}
			?>
			</table>
	</div>
	<hr>
	<footer class="footer">Copyright Abdul Inc. 2018</footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
