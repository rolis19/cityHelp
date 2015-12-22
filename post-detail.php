<?php
include_once 'connection.php';
session_start();
if(!isset($_GET['post_id'])) {
	header("location:../");
}
$id = $_GET['post_id'];
$sql = mysql_query("SELECT * FROM post WHERE post_id='$id'");
$post = mysql_fetch_object($sql);
$sql = mysql_query("SELECT COUNT(*) jumlah FROM comment WHERE post_id='$id'");
$jumlah = mysql_fetch_object($sql)->jumlah;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $post->post_title; ?> - Smart City</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/post-detail.css">
	<link rel="stylesheet"  href="css/lightslider.css"/>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Quicksand:400,300,700' rel='stylesheet' type='text/css'>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/lightslider.js"></script>

	<script>
		function insert() {
			var valid = false;
			var content = "";
			var post_id = "";

			if($('.comment')[0].checkValidity()) {
				content = $('#comment').val();
				post_id = $('#post-id').val().split("&");
				valid = true;
			} else {
				valid = false;
			};

			if(valid) {
				$.ajax({
					type: "POST",
					url: "comment.php",
					data: "id=" + post_id['0'] + "&content=" + content + "&username=" + post_id['1'],
					cache: false,
					success: function(response) {
						if(response == 0) {

						} else {

							$('#modal-solusi').modal("hide");
							$('#comment').val("");
							$('.comment-section').empty();
							$('.comment-section').fadeIn(500, function() {
								$('.comment-section').html(response);
							})
						}
					}
				})
			}
		};

		$(document).ready(function() {
			$('#vertical').lightSlider({
				gallery:true,
				item:1,
				vertical:true,
				verticalHeight:500,
				vThumbWidth:70,
				thumbItem:8,
				thumbMargin:4,
				slideMargin:0,
				adaptiveHeight: true
			});

			$('.collapse li').each(function() {
				var category = <?php echo "\"" . $post->post_category . "\";"; ?>
				var text = $(this).text();
				if(text == category) {
					$(this).addClass("active");
				}
			});

			$(document).on('click', '#like', function() {
				var id = $(this).parents(".solusi-body").find("#comment-id").val();
				$.ajax({
					type: "POST",
					url: "rating.php",
					data: "id=" + id + "&type=like",
					cache: false,
					success: function(response) {
						if(response != "0") {
							$('#likes-'+id).html(response);
						} else {
							alert("Gagal like");
						}
					}
				})
			});

			$(document).on('click', '#dislike', function() {
				var id = $(this).parents(".solusi-body").find("#comment-id").val();
				$.ajax({
					type: "POST",
					url: "rating.php",
					data: "id=" + id + "&type=dislike",
					cache: false,
					success: function(response) {
						if(response != "0") {
							$('#dislikes-'+id).html(response);
						} else {
							alert("Gagal dislike");
						}
					}
				})
			});

		});
	</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "9e32029d-2a34-459d-a265-41b9a3f24b00", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>
<body>
<section class="infrastructure">
	<div class="container-fluid">
		<div class="row main-header">
			<div class="hero text-center">
				<h1>INFRASTRUCTURE</h1>
				<div class="categ-menu">
					<a href="#">Building</a>
					<div class="bullet"></div>
					<a href="#">Road</a>
					<div class="bullet"></div>
					<a href="#">Highway</a>
					<div class="bullet"></div>
					<a href="#">Bridge</a>
				</div>
				<a href="#" class="btn btn-success btn-lg">INFRASTRUCTURE DATA</a>
			</div>
			<div class="user">
				<a href="#modal-sign" role="button" data-toggle="modal">SIGN UP</a>
				<a href="#modal-login" role="button" data-toggle="modal">LOGIN</a>
				<img src="img/user.png" alt="" width="50px">
			</div>
		</div>
	</div>
</section>
<div class="border-green"> </div>

<nav class="navbar navbar-default" role = "navigation">
	<div class="container-fluid">
		<div class="row fix-menu">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Your Logo -->
				<div class="logo"><a href="index.php"><img src="img/logo.png" width="200px"></a></div>
			</div>
			<!-- Start Navigation -->
			<div class="collapse navbar-collapse" id="collapse" role="navigation">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../social.php">Social</a></li>
					<li><a href="../infrastructure.php">Infrastructure</a></li>
					<li><a href="../economy.php">Economy</a></li>
					<li><a href="../tourism.php">Tourism</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<div class="container main-post	">
	<div class="row">
		<div class="col-md-8 img-main">
			<div class="item">
				<div class="clearfix">
					<ul id="vertical">
					<?php
					$picture = mysql_fetch_object(mysql_query("SELECT pictures FROM post WHERE post_id='$id'"))->pictures;
					$decode = json_decode($picture);
					$num = count($decode);
					if($num) {
						foreach($decode as $img) {
							echo "<li data-thumb='member/gallery/" . $img . "'>";
							echo "<img src='member/gallery/" . $img . "'>";
							echo "</li>";
						}
					} else {
						echo "<li data-thumb='img/post-img-default.jpg' class='img-thumbnail'>";
						echo "<img src='img/post-img-default.jpg'>";
						echo "</li>";
					}
					?>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<h3><?php echo $post->post_title; ?></h3>
			<div class="date-post"><?php echo $post->date; ?></div>
			<hr>
			<table>
				<tr>
					<td> Category : </td>
					<td> <?php echo $post->post_category; ?> </td>
				</tr>
				<tr>
					<td> Type : </td>
					<td> <?php echo $post->post_type; ?> </td>
				</tr>
				<tr>
					<td> Posted by : </td>
					<td> <?php echo $post->post_author; ?> </td>
				</tr>
				<tr>
					<td> In Charge : </td>
					<td> <?php echo $post->post_inCharge; ?> </td>
				</tr>

			</table>
			<div class="brief-button">
				<div class="bold">Hastag : <?php echo $post->post_tag;?></div>
				<div class="respponder">250 Responder</div>
				<div class="best-solusion"><?php echo $jumlah . " " . ($post->post_type == "Complaint" ? "Solution" : "Comment") ?></div>
				<div class="sosmed">
					<div class="sosmed-head">Share</div>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st__large' displayText=''></span>
				</div>
			</div>
			<?php
			if($_SESSION['login']) {
				echo "<a href='#modal-solusi' role='button' data-toggle='modal' class='btn btn-success btn-lg'>Give " . ($post->post_type == "Complaint" ? "Solution" : "Comment") . "</a>";
			} else {
				echo "<a href='#modal-login' role='button' data-toggle='modal' class='btn btn-success btn-lg'>Login untuk memberi " . ($post->post_type == "Complaint" ? "Solusi" : "Komentar") . "</a>";
			}
			?>
		</div>
		<div class="col-md-12 post-detail">
			<div class="prob">
				<p><?php echo $post->post_content; ?></p>
			</div>
		</div>
		<div class="col-md-12">
			<h2><?php echo ($post->post_type == "Complaint" ? "Solution" : "Comment"); ?></h2>
			<div class="comment-section">
				<?php
				$sql = mysql_query("SELECT * FROM comment WHERE post_id='$id'");
				while($row = mysql_fetch_object($sql)) {
					$query = mysql_query("SELECT post_type FROM post WHERE post_id='$id'");
					$type = mysql_fetch_object($query)->post_type;
					echo "<div class='solusi-body'>";
					echo "<input type='hidden' id='comment-id' value='$row->comment_id'/>";
					echo "<div>" . $row->user . "</div>";
					echo "<p>";
					echo "<div class='date'>" . $row->comment_date . "</div>";
					echo $row->comment_content;
					echo "</p>";
					echo "<p>";
					echo "Setuju : <span id='likes-" . $row->comment_id . "'>" . $row->comment_likes . "</span> orang" . ($type == "Complaint" ? " | Tidak Setuju : <span id='dislikes-" . $row->comment_id . "'>" . $row->comment_dislikes . "</span> orang" : "");
					echo "</p>";
					echo "<div class='pool pull-right'>";
					echo "<p>";
					echo ($_SESSION['login'] ? ($type == "Complaint" ? "<button type='button' id='like'>Setuju</button> | <button type='button' id='dislike'>Tidak Setuju</button>" : "<button type='button' id='like'>Like</button>") : "");
					echo "</p>";
					echo "</div>";
					echo "</div>";
				}
				?>
			</div>
		</div>
	</div>
</div>
<!-- All Modal Placed in here -->
<div id="modal-sign" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close modal1" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<form role="form" id="validation" autocomplete="off">
					<div class="form-group">
						<input type="email" id="valid-email" class="form-control" placeholder="VALID EMAIL">
					</div>
					<button type="submit" id="submit-email" class="btn btn-success btn-lg">SIGN UP</button>
				</form>
				<hr width="60%">
				<p>USE SIGN UP ALTERNATIVE</p>
				<div class="sosmed">
					<img src="img/fb.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-login" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<form action="login-core.php" role="form" method="POST">
					<div class="form-group">
						<input type="text" id="form-elem-1" class="form-control" placeholder="USERNAME" name="username">
						<input type="password" id="form-elem-1" class="form-control" placeholder="PASSWORD" name="password">
					</div>
					<button type="submit" class="btn btn-success btn-lg">SIGN IN</button>
				</form>
				<hr width="60%">
				<p>USE LOGIN ALTERNATIVE</p>
				<div class="sosmed">
					<img src="img/fb.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-signup" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close modal2" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<form action="register-core.php" role="form" method="POST">
					<div class="form-group">
						<input type="text" name="full_name" id="name" class="form-control" placeholder="Full Name">
						<input type="text" name="username" id="username" class="form-control" placeholder="Username">
						<input type="email" name="email" id="email" class="form-control" placeholder="Email" readonly>
						<input type="password" name="pass" id="pass" onkeyup="validate()" class="form-control" placeholder="Password">
						<input type="password" name="confirm_pass" id="confirm_pass" onkeyup="validate()" class="form-control" placeholder="Confirm Password">
					</div>
					<button type="submit" class="btn btn-success btn-lg">SIGN UP</button>
				</form>
				<hr width="60%">
			</div>
		</div>
	</div>
</div>
<footer>
	<div class="abfooter">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<ul>
						<li> Kelud Utara 4 no 3A </li>
						<li> SEMARANG </li>
						<li> Central Java </li>
						<li> 02462832 </li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul>
						<li><a href="about.html"> About </a> </li>
						<li><a href="help.html"> Help </a> </li>
						<li><a href="terms.html"> Terms </a> </li>
						<li><a href="privacy.html"> Privacy </a> </li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul>
						<li><a href="teams.html"> Teams </a> </li>
						<li><a href="advertise.html"> Advertise</a> </li>
						<li><a href="terms.html"> Terms</a> </li>
						<li><a href="privacy.html"> Privacy </a> </li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul>
						<li>Follow us </li>
						<li><a href="#"> Facebook</a> </li>
						<li><a href="#"> Twitter</a> </li>
						<li><a href="#"> Instagram </a> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<p> Copyright @ SmartCity 2016-2017 </p>
	</div>
</footer>
<!-- Modall Solusion Here -->
<div id="modal-solusi" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form class="comment">
				<div class="modal-body text-center">
					<div class="form-group">
						<label for="comment"><?php echo ($post->post_type == "Complaint" ? "Solusi" : "Komentar"); ?>:</label>
						<input type="hidden" id="post-id" value="<?php echo $id . "&" . $_SESSION['username']; ?>" />
						<textarea class="form-control" rows="5" id="comment" style="width: 100%" placeholder="Tuliskan solusimu" required></textarea>
						<p>Berikan solusi yang relevant, dengan topic gunakan bahasa yang baik. lihat peraturan selengkapnya</p>
						<hr>
						<button type="button" class="btn btn-success btn-lg" onclick="insert()">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="js/jquery.waypoints.js"></script>
<!-- <script src="js/init.js"></script> -->
</body>
</html>