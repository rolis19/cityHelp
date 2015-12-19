<?php
include_once '../connection.php';
session_start();
if((!isset($_SESSION['login'])) || $_SESSION['login'] == FALSE) {
	header('location:../index.php');
} else {
	if($_SESSION['type'] == "admin") {
		header('location:../admin/');
	}
}

$username = $_SESSION['username'];
$sql = mysql_query("SELECT * FROM member WHERE username='$username'");
$profile = mysql_fetch_object($sql);
$id = (isset($_POST['post-id']) ? $_POST['post-id'] : 0);
$query = mysql_query("SELECT * FROM post WHERE post_id='$id'");
@$post = mysql_fetch_object($query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Smart City - <?php echo $profile->name ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="css/member.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Quicksand:400,300,700' rel='stylesheet' type='text/css'>
<script src="../js/jquery.min.js"></script>
</head>
<body>
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
				<div class="logo"><a href="../index.php"><img src="../img/logo.png" width="200px"></a></div>
			</div>
			<!-- Start Navigation -->
			<div class="collapse navbar-collapse" id="collapse" role="navigation">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../loged.html">Social</a></li>
					<li><a href="../loged.html">Infrastructure</a></li>
					<li><a href="../loged.html">Economy</a></li>
					<li><a href="../loged.html">Tourism</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="part3">
	<div class="container">
		<div class="row">
			<div class="col-md-4 profile-area1">
				<img src="profile/<?php echo $profile->picture ?>" alt="">
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="#about" data-toggle="pill">Edit Post</a></li>
				</ul>
			</div>
			<div class="col-md-8 profile-area2">
				<div class="tab-content">
					<div class="tab-pane solution active post-form" id="post">
						<div class="well">
						<?php
						if($post) {
						?>
							<h2 style="margin-bottom: 40px">Edit Post</h2>
							<form class="form-horizontal" action="edit.php" method="POST">
								<input type="hidden" name="post-id" value='<?php echo $id; ?>' />
								<div class="form-group">
									<label for="inputcategory" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<select class="form-control inputctg" id="inputcategory" name="postCategory">
											<option value="Social">Social</option>
											<option value="Infrastructure">Infrastructure</option>
											<option value="Economy">Economy</option>
											<option value="Tourism">Tourism</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="inputtype" class="col-sm-2 control-label">Type</label>
									<div class="col-sm-10">
										<select class="form-control inputtype" id="inputtype" name="postType">
											<option value="Complaint">Complaint</option>
											<option value="Review">Review</option>
											<option value="Update">Update</option>
										</select>
									</div>
								</div>
								<script type="text/javascript">
									$('#inputcategory').val(<?php echo "\"" . $post->post_category . "\""; ?>);
									$('#inputtype').val(<?php echo "\"" . $post->post_type . "\""; ?>);
								</script>
								<div class="form-group">
									<label for="inputcharge" class="col-sm-2 control-label">Charge <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Yang bertanggung jawab, Kosongkan jika tidak ada"></span></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputcharge" name="inCharge" value='<?php echo $post->post_inCharge; ?>'>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label for="inputjudul" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputjudul" name="postTitle" value='<?php echo $post->post_title; ?>'>
									</div>
								</div>
								<div class="form-group">
									<label for="inputdeskrip" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="5" id="inputdeskrip" name="content"><?php echo $post->post_content; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="inputtag" class="col-sm-2 control-label">Tag</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputtag" id="inputtag" name="postTag" value='<?php echo $post->post_tag; ?>'>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<hr>
										<button type="submit" class="btn btn-default btn-lg">Update</button>
										<button type="" class="btn btn-default btn-lg">Cancel</button>
									</div>
								</div>
							</form>
						<?php
						} else {
							echo "<h1>Wrong Post</h1>";
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<footer>
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
			<li><a href="#about.html"> About </a> </li>
			<li><a href="#help.html"> Help </a> </li>
			<li><a href="#terms.html"> Terms </a> </li>
			<li><a href="#privacy.html"> Privacy </a> </li>
		</ul>
	</div>
	<div class="col-md-2">
		<ul>
			<li><a href="#teams.html"> Teams </a> </li>
			<li><a href="#advertise.html"> Advertise</a> </li>
			<li><a href="#terms.html"> Terms</a> </li>
			<li><a href="#privacy.html"> Privacy </a> </li>
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
	<div class="col-md-12 copyright">
		<p> Copyright @ SmartCity 2016-2017 </p>
	</div>
</footer>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.waypoints.js"></script>
<script src="../js/parallax.js"></script>
<script src="../js/init.js"></script>
<script src="../js/ajax.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#inputcurpass').keyup(checkPass);
	})

	function validate() {
		var pass = document.getElementById("inputnewpass");
		var confirm = document.getElementById("inputrepass");

		if(pass.value != confirm.value) {
			confirm.setCustomValidity("Password don't match");
		} else {
			confirm.setCustomValidity("");
		}
	}

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
</body>
</html>


