<?php
	require_once 'connection.php';
	session_start();
	$referrer = mysql_real_escape_string($_SERVER['HTTP_REFERER']);
	$user = mysql_real_escape_string($_POST['username']);
	$pass = mysql_real_escape_string($_POST['password']);
	$secretkey = "smartcity";
	$key = md5($pass.$secretkey);
	$sql = mysql_query("SELECT COUNT(*) AS login FROM member WHERE username='$user' AND password='$key'");
	$status = mysql_fetch_object($sql)->login;

	if($status) {
		$_SESSION['login'] = true;
		$_SESSION['type'] = "user";
		$_SESSION['username'] = $user;
		header('location:' . $referrer);
	} else {
		header('location:index.php');
	}
?>