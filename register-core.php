<?php
	require_once 'connection.php';
	session_start();

	$name = mysql_real_escape_string($_POST['full_name']);
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
	$secretkey = "smartcity";
	$key = md5($password+$secretkey);
	$query = mysql_query("INSERT INTO member VALUES(NULL, '$name', '$username', '$key', '$email') ");

	if($query) {
		$_SESSION['login'] = true;
		$_SESSION['type'] = "user";
		$_SESSION['username'] = $username;
		header('location:member/');
	} else {
		header('location:index.html?status=Register Fail');
	}
?>
