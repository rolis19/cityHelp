<?php
include_once '../connection.php';
session_start();

function diverse_array($vector) {
    $result = array();
    foreach($vector as $key1 => $value1)
        foreach($value1 as $key2 => $value2)
            $result[$key2][$key1] = $value2;
    return $result;
}

$user = $_SESSION['username'];
$aboutme = mysql_real_escape_string($_POST['aboutme']);

if(empty($_FILES['profilePic']['name'])) {
	$sql = mysql_query("UPDATE member SET description='$aboutme' WHERE username='$username'");
	if($sql) {
		header('location:index.php?status=success');
	} else {
		header('location:index.php?status=failed');
	}
} else {
	$dir = "profile/";
	$allowedExt = array("jpg", "jpeg", "png");
	$ext = explode(".", $_FILES['profilePic']['name']);
	$ext = strtolower(end($ext));
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mime = finfo_file($finfo, $_FILES['profilePic']['tmp_name']);
	$pathname = $dir . $user;

	if(($mime == $_FILES['profilePic']['type']) && in_array($ext, $allowedExt)) {
		if(move_uploaded_file($_FILES['profilePic']['tmp_name'], $pathname)) {
			header('location:index.php?status=success');
		} else {
			header('location:index.php?status=failed');
		}

		mysql_query("UPDATE member SET description='$aboutme', picture='$user' WHERE username='$user'");
	}
}