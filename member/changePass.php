<?php
include_once '../connection.php';
session_start();
$user = $_SESSION['username'];
$password = mysql_real_escape_string($_POST['newpass']);
$secretkey = "smartcity";
$key = md5($password.$secretkey);

$sql = mysql_query("UPDATE member SET password='$key' WHERE username='$user'");

if($sql) {
	header('location:index.php?status=success');
} else {
	header('location:index.php?status=failed');
}

mysql_close();
