<?php
$resopnse = array();

function phpAlert($msg) {
    echo "<script type='text/javascript'>alert(\"" . $msg . "\"); window.open('index.html','_top')</script>";
}

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['error']=true;
	$response['message']='Invalid request!';

	$msg = $response['message'];
	phpAlert($msg);
	die();
}

if(!(isset($_POST['user']) && isset($_POST['pass']))){
	$response['error']=true;
	$response['message']='Parameters missing!';

	$msg = $response['message'];
	phpAlert($msg);
	die();
}

$user = $_POST['user'];
$pass = $_POST['pass'];

if($user != "abdul" || $pass != "qwerty"){
	$response['error']=true;
	$response['message']='Wrong Credentials!';

	$msg = $response['message'];
	phpAlert($msg);
	die();
}

session_start();
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
header("Location:main.php");