<?php
include_once '../connection.php';
$pass = mysql_real_escape_string($_POST['pass']);
$secretkey = "smartcity";
$key = md5($pass.$secretkey);
$sql = mysql_query("SELECT COUNT(password) AS password FROM member WHERE password='$key'");
$num = mysql_fetch_object($sql)->password;

echo $num;