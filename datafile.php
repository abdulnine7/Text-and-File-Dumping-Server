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
	$filenames;
	$dir = "uploads";

	// Open a directory, and read its contents
	if (is_dir($dir)){
	  if ($dh = opendir($dir)){
	  	$i = 0;
	    while (($file = readdir($dh)) !== false){
	    	if(!is_dir($file)){
	    		$filenames[$i] = $file;
	      		$i++;
	      	}
	      //echo "filename:" . $file . "<br>";
	    }
	    closedir($dh);
	  }
	}
	sort($filenames);
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
	<title>Dumped Files</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
</head>

<body>
	<header class="main-header">
		<h1>Dumped Files</h1>
		<p>Follow On GitHub: <strong><a href="http://www.github.com/abdulnine7"> abdulnine7</a></strong></p>
	</header>
	<div class='content'>
		<div class="box" >
			<table>
			  <tr>
			    <th>Sr No. </th>
			    <th width="60%">File Name</th>
			    <th>Date Modified</th>
			    <th>Size</th>
			  </tr>
			  
			<?php $i = 1;
			$fnames = getFileNames();
				foreach ($fnames as $name) {
					echo "<tr>";
					echo "<td>" . $i . "</td>";
					echo "<td title=". $name .">" . "<a href=\"uploads/". $name . "\">" . $name . "</a></td>";
					echo "<td>" . date("d F Y",filemtime("uploads/". $name)) . "</td>";
					echo "<td>" . formatSizeUnits(filesize("uploads/". $name)) . "</td>";
					echo "</tr>";
					$i++;
				}
			?>
			</table>
		</div>

		<div  class="box">
			<div class="my_wrapper">
			<form action="data.php" method="post" enctype="multipart/form-data">
				<p><input type="submit" class="mybutton getdata" value="Dumped Text" name="submit"></p>
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
?>