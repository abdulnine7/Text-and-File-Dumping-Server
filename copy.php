<?php
$resopnse = array();
date_default_timezone_set('Asia/Kolkata');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['text'])) {

		$text = $_POST['text'];
		$text_to_write = "\n--------------------------".date("d/m/Y h:i:s a")."--------------------------\n".$text."\n";

		//creating a file with mac address name
		$myfile = fopen("copied_text.txt", "a+") or die("Can't Open file! copied_text.txt");
		fwrite($myfile,$text_to_write);
		fclose($myfile);

		$response['error']=false;
		$response['message']='Text Pasted!';

		echo "";
		
	} else {
		$response['error']=true;
		$response['message']='Parameters missing!';
	}
} else {
	$response['error']=true;
	$response['message']='Invalid request!';
}

$msg = $response['message'];
$time_stamp = date("d/m/Y h:i:s a");

echo "<script type='text/javascript'>alert(\"Status: $msg\\nTimestamp: $time_stamp\"); window.open('main.php','_top')</script>";
?>
