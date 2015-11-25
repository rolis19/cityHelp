<?php
	session_start();

	include "conn.php";

	$Name = mysql_real_escape_string($_POST['Name']);
	$Username = mysql_real_escape_string($_POST['Username']);
	$Email = mysql_real_escape_string($_POST['Email']);
	$_SESSION["Email"] = $Email;
	$Password = mysql_real_escape_string($_POST['Password']);
	$ConfirmPassword = mysql_real_escape_string($_POST['ConfirmPassword'])
	$query = "INSERT INTO 'User' (Name,Username,Email,Password,ConfirmPassword) VALUES ('$Name','$Username','$Email','$Password','$ConfirmPassword')";
	
echo"<script language = 'Javascript'>
      alert('Registration success!')
      location.href = 'index.html'</script>";

?>
