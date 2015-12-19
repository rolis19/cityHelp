<?php
include_once 'connection.php';

$id = $_POST['id'];
$type = $_POST['type'];

function like($id) {
	$sql = mysql_query("SELECT comment_likes FROM comment WHERE comment_id='$id'");
	$nums = mysql_fetch_object($sql)->comment_likes;
	$jumlah = $nums+1;

	$query = mysql_query("UPDATE comment SET comment_likes='$jumlah' WHERE comment_id='$id'");
	if($query) {
		return $jumlah;
	} else {
		return "0";
	}
}

function dislike($id) {
	$sql = mysql_query("SELECT comment_dislikes FROM comment WHERE comment_id='$id'");
	$nums = mysql_fetch_object($sql)->comment_dislikes;
	$jumlah = $nums+1;

	$query = mysql_query("UPDATE comment SET comment_dislikes='$jumlah' WHERE comment_id='$id'");
	if($query) {
		return $jumlah;
	} else {
		return "0";
	}
}

if($type == "like") {
	echo like($id);
} else if($type == "dislike") {
	echo dislike($id);
} else {
	echo "0";
}