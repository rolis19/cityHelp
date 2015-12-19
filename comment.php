<?php
include_once 'connection.php';
session_start();

date_default_timezone_set("Asia/Jakarta");
$date = date("d F Y");
$postID = $_POST['id'];
$content = $_POST['content'];
$user = $_POST['username'];

$sql = mysql_query("INSERT INTO comment(comment_date, post_id, user, comment_content) VALUES ('$date', '$postID', '$user', '$content') ");


//<div class="solusi-body">
///					<p>
//					<div class="date">12 februari 2015</div>
//					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam enim nisi, placerat quis ornare eu, scelerisque ac risus. Phasellus dapibus dui a fermentum scelerisque. Pellentesque fringilla pretium elit,
//					</p>
//					<p>
//						Setuju : 20 orang
//					</p>
//					<div class="pool pull-right">
//						<p>
//							<?php
//							if($_SESSION['login']) {
//								echo "<a href='#'>Setuju</a> | <a href='#'>Tidak Setuju</a>";
//							}
//							>
//						</p>
//					</div>
//				</div>

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
		echo ($_SESSION['login'] ? ($type == "Complaint" ? "<a href='#' id='like'>Setuju</a> | <a href='#' id='dislike'>Tidak Setuju</a>" : "<a href='#'>Setuju</a>") : "");
		echo "</p>";
		echo "</div>";
		echo "</div>";
	}
} else {
	echo 0;
}