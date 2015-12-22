<?php
include_once 'connection.php';
session_start();

date_default_timezone_set("Asia/Jakarta");
$date = date("d F Y");
$postID = $_POST['id'];
$content = $_POST['content'];
$user = $_POST['username'];

$sql = mysql_query("INSERT INTO comment(comment_date, post_id, user, comment_content) VALUES ('$date', '$postID', '$user', '$content') ");

if($sql) {
	$sql = mysql_query("SELECT * FROM comment WHERE post_id='$postID'");
	while($row = mysql_fetch_object($sql)) {
		$query = mysql_query("SELECT post_type FROM post WHERE post_id='$postID'");
		$type = mysql_fetch_object($query)->post_type;
		echo "<div class='solusi-body'>";
		echo "<input type='hidden' id='comment-id' value='$row->comment_id'/>";
		echo "<div>" . $row->user . "</div>";
		echo "<p>";
		echo "<div class='date'>" . $row->comment_date . "</div>";
		echo $row->comment_content;
		echo "</p>";
		echo "<p>";
		echo "Setuju : <span id='likes'>" . $row->comment_likes . "</span> orang" . ($type == "Complaint" ? " | Tidak Setuju : <span id='dislikes'>" . $row->comment_dislikes . "</span> orang" : "");
		echo "</p>";
		echo "<div class='pool pull-right'>";
		echo "<p>";
		echo ($_SESSION['login'] ? ($type == "Complaint" ? "<button type='button' id='like'>Setuju</button> | <button type='button' id='dislike'>Tidak Setuju</button>" : "<button type='button' id='like'>Like</button>") : "");
		echo "</p>";
		echo "</div>";
		echo "</div>";
	}
} else {
	echo 0;
}