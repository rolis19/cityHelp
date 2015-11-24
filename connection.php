<?php
	$user = "root";
	$pass = "";
	$host = "localhost";
	$db = "smartcity";

	mysql_connect($host, $user, $pass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
?>