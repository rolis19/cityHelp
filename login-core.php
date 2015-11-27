<?php
	require_once 'connection.php';
	session_start();
	$user = mysql_real_escape_string($_POST['username']);
	$pass = mysql_real_escape_string($_POST['password']);
	$secretkey = "smartcity";
	$key = md5($password+$secretkey);
	$sql = mysql_query("SELECT COUNT(*) AS login FROM member WHERE username='$user' AND password='$key'");
	$status = mysql_fetch_object($sql)->login;

	if($status) {
		$_SESSION['login'] = true;
		$_SESSION['type'] = "user";
		$_SESSION['username'] = $user;
		header('location:member/');
	} else {
		header('location:index.html');
	}
?>