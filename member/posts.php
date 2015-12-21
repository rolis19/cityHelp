<?php
include_once '../connection.php';
session_start();
date_default_timezone_set("Asia/Jakarta");
$user = $_SESSION['username'];
$date = date("d F Y");
$category = mysql_real_escape_string($_POST['postCategory']);
$type = mysql_real_escape_string($_POST['postType']);
$charge = mysql_real_escape_string($_POST['inCharge']);
$title = mysql_real_escape_string($_POST['postTitle']);
$content = mysql_real_escape_string($_POST['content']);
$tag = mysql_real_escape_string($_POST['postTag']);
$subs = substr($category, 0,1) . substr($type, 0,1);
$num = mysql_num_rows(mysql_query("SELECT * FROM post WHERE (post_id REGEXP '^$subs')"));
$post_id = $subs . "-" . ($num+1);

//PICTURE START HERE
include 'function.php';
$dir = "gallery/";
$allowedExt = array("jpg", "jpeg", "png");
$file = diverse_array($_FILES['picture']);
$img = array();
$idx = 1;

foreach($file as $array) {
	$ext = explode(".", $array['name']);
	$ext = strtolower(end($ext));
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mime = finfo_file($finfo, $array['tmp_name']);

	if(($mime == $array['type']) && in_array($ext, $allowedExt)) {
		$filename = basename($array['name']);

		if(move_uploaded_file($array['tmp_name'], $dir.$filename)) {
			array_push($img, $post_id . "-" . $idx . "." . $ext);
			echo "Sukses";
		} else {
			echo "Gagal";
		}

		rename($dir.$filename, $dir.$post_id."-".$idx.".".$ext);
		$idx += 1;
	} else {
		echo "Invalid file";
	}
}
//PICTURE END HERE
$picture = json_encode($img, JSON_UNESCAPED_UNICODE);
$sql = mysql_query("INSERT INTO post VALUES('$post_id', '$date', '$user', '$title', '$content', '$category', '$type', '$tag', '$charge', '$picture')");

if($sql) {
	header('location:index.php?status=success');
} else {
	header('location:index.php?status=failed');
}