<?php
$resopnse = array();

function phpAlert($msg) {
    echo "<script type='text/javascript'>alert(\"" . $msg . "\"); window.open('index.html','_top')</script>";
}

$password = $_POST['password'];


if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['error']=true;
	$response['message']='Invalid request!';

	$msg = $response['message'];
	phpAlert($msg);
	die();
}


// SET YOUR PASSWORD HERE
if($password == '12345678'){

	session_start();
	$_SESSION['user'] = 'khalesi';
	$_SESSION['pass'] = $password;
	header("Location:main.php");
	die();
}

$response['error']=true;
$response['message']='Invalid credentials!';
$msg = $response['message'];
phpAlert($msg);
