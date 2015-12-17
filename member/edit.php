<?php
include_once '../connection.php';

$id = mysql_real_escape_string($_POST['post-id']);
$category = mysql_real_escape_string($_POST['postCategory']);
$type = mysql_real_escape_string($_POST['postType']);
$charge = mysql_real_escape_string($_POST['inCharge']);
$title = mysql_real_escape_string($_POST['postTitle']);
$content = mysql_real_escape_string($_POST['content']);
$tag = mysql_real_escape_string($_POST['postTag']);

$query = mysql_query("UPDATE post SET post_title='$title', post_content='$content', post_category='$category', post_type='$type', post_tag='$tag', post_inCharge='$charge' WHERE post_id='$id'");

if($query) {
	header('location:index.php?status=Edit Success');
} else {
	header('location:index.php?status=Edit Failed');
}
