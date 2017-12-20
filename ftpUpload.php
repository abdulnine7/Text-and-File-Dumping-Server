<?php

// FTP access parameters
$host = 'localhost';
$usr = 'user';
$pwd = 'password';
 
// file to move:
$local_file = $_FILES['upload']['tmp_name'];
$ftp_path = "/copy/uploads/" . basename($_FILES['upload']['name']);
 
// connect to FTP server (port 21)
$conn_id = ftp_connect($host, 21) or die ("Cannot connect to host");
 
// send access parameters
ftp_login($conn_id, $usr, $pwd) or die("Cannot login");
 
// turn on passive mode transfers (some servers need this)
// ftp_pasv ($conn_id, true);
 
// perform file upload
$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII);
 
// check upload status:
print (!$upload) ? 'Cannot upload' : 'Upload complete';
print "\n";
 
// close the FTP stream
ftp_close($conn_id);