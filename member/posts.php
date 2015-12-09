<?php
include_once '../connection.php';
session_start();
$user = $_SESSION['username'];
$category = mysql_real_escape_string($_POST['postCategory']);
$type = mysql_real_escape_string($_POST['postType']);
$charge = mysql_real_escape_string($_POST['inCharge']);
$title = mysql_real_escape_string($_POST['postTitle']);
$content = mysql_real_escape_string($_POST['content']);
$tag = mysql_real_escape_string($_POST['postTag']);

$sql = mysql_query("INSERT INTO post(post_author, post_title, post_content, post_category, post_type, post_tag, post_inCharge) VALUES('$user', '$title', '$content', '$category', '$type', '$tag', '$charge')");

if($sql) {
	header('location:index.php?status=success');
} else {
	header('location:index.php?status=failed');
}