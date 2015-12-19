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
$query = mysql_query("SELECT post_category category, COUNT(*) num FROM post WHERE post_author='$username' GROUP BY post_category");
$array = array();
while($row = mysql_fetch_object($query)) {
	$category = $row->category;
	$num = $row->num;
	$array[$category] = $num;
}

$social = (@$array['Social'] == NULL ? 0 : $array['Social']);
$economy = (@$array['Economy'] == NULL ? 0 : $array['Economy']);
$tourism = (@$array['Tourism'] == NULL ? 0 : $array['Tourism']);
$infra = (@$array['Infrastructure'] == NULL ? 0 : $array['Infrastructure']);
$jumlah = $social+$economy+$infra+$tourism;


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
				<div class="logo"><a href="../index.html"><img src="../img/logo.png" width="200px"></a></div>
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
					<li class="active"><a href="#about" data-toggle="pill">About me</a></li>
					<li><a href="#editprof" data-toggle="pill">Edit Profile</a></li>
					<li><a href="#posted" data-toggle="pill">Post List</a></li>
					<li><a href="#post" data-toggle="pill">Buat Post <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
					<li><a href="#solution" data-toggle="pill">Solution & comments</a></li>
				</ul>
			</div>
			<div class="col-md-8 profile-area2">
				<div class="tab-content">
					<div class="tab-pane active" id="about">

						<?php
						echo "<h2>$profile->name</h2>";
						echo "<p class='aboutme'>$profile->description</p>";
						?>

						<div class="col-sm-12">
							<h4>Kontribusi</h4>
						</div>
						<div class="col-sm-6">
							<ul>
								<li>Total <?php echo $jumlah; ?> Postingan</li>
								<li>20 Solution</li>
								<li>30 komentar</li>
								<li>3 Report</li>
							</ul>
						</div>
						<div class="col-sm-6">
							<ul>
								<li>Total</li>
								<li>20 Solution</li>
								<li>30 komentar</li>
								<li>3 Report</li>
							</ul>
						</div>

						<div class="col-sm-12 prog-bar">
							<hr>
							<h4>Kontribusi Bar</h4>
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo (!$jumlah ? 0 : $social/$jumlah*100); ?>%">
									Social
								</div>
								<div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo (!$jumlah ? 0 : $infra/$jumlah*100); ?>%">
									Infrastructure
								</div>
								<div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo (!$jumlah ? 0 : $economy/$jumlah*100); ?>%">
									Economy
								</div>
								<div class="progress-bar progress-bar-info" role="progressbar" style="width:<?php echo (!$jumlah ? 0 : $tourism/$jumlah*100); ?>%">
									Tourism
								</div>
							</div>
							<table>
								<tr>
									<td> Social : </td>
									<td> <?php echo (!$jumlah ? "0" : $social/$jumlah*100); ?>% </td>
								</tr>
								<tr>
									<td> Infrastructure : </td>
									<td> <?php echo (!$jumlah ? "0" : $infra/$jumlah*100); ?>% </td>
								</tr>
								<tr>
									<td> Economy : </td>
									<td> <?php echo (!$jumlah ? "0" : $economy/$jumlah*100); ?>% </td>
								</tr>
								<tr>
									<td> Tourism : </td>
									<td> <?php echo (!$jumlah ? "0" : $tourism/$jumlah*100); ?>% </td>
								</tr>

							</table>
						</div>
					</div>
					<div class="tab-pane editprof" id="editprof">
						<form class="form-horizontal" action="edit-profile.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="inputaboutme" class="col-sm-4 control-label">About me</label>
								<div class="col-sm-8">
									<textarea class="form-control" rows="5" id="inputaboutme" name="aboutme" placeholder="Tuliskan singkat mengenai anda"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="inputuserimg" class="col-sm-4 control-label">Gambar</label>
								<div class="col-sm-8">
									<input type="file" id="inputuserimg" name="profilePic">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-success btn-lg">Update</button>
								</div>
							</div>
						</form>
						<hr>
						<form class="form-horizontal" method="POST" action="changePass.php">
							<p style="margin-bottom: 20px">
								<a type="button" data-toggle="collapse" data-target="#collapsepass" aria-expanded="false" aria-controls="collapsepost">Ganti Password</a>
							</p>
							<div class="collapse" id="collapsepass">
								<div class="form-group">
									<label for="inputcurpass" class="col-sm-4 control-label">Pasword sekarang</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="inputcurpass" required>
									</div>
								</div>
								<div class="form-group">
									<label for="inputnewpass" class="col-sm-4 control-label">Pasword baru</label>
									<div class="col-sm-8">
										<input type="password" onkeyup="validate()" required class="form-control" id="inputnewpass" name="newpass">
									</div>
								</div>
								<div class="form-group">
									<label for="inputrepass" class="col-sm-4 control-label">Retype pasword</label>
									<div class="col-sm-8">
										<input type="password" onkeyup="validate()" class="form-control" id="inputrepass">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-success btn-lg">Update</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="posted">
						<?php
						$idx = 1;
						$query =  mysql_query("SELECT * FROM post WHERE post_author='$username'");
						$num = mysql_num_rows(mysql_query("SELECT * FROM post WHERE post_author='$username'"));

						if($num) {
							$first = true;
							while($row = mysql_fetch_object($query)) {
								$mod = $idx%2;
								if($first) {
									echo "<div class='postodd posttop'>";
									echo "<h4><a href='../post-detail.html'>" . $row->post_title . "</a></h4>";
									echo "<small>" . $row->date . " || " . $row->post_type . " || " . $row->post_category . "</small>";
									echo "<p>" . substr($row->post_content, 0, 160) . "...</p>";
									echo "<div class='pull-right'>";
									// echo "<a href='edit-post.php?edit=" . md5($row->post_id) . "'class='btn btn-info'>Edit</a>";
									echo "<form action='edit-post.php' method='POST'>";
									echo "<input type='hidden' name='post-id' value='$row->post_id' />";
									echo "<button type='submit' class='btn btn-info'>Edit</button>";
									echo "</form>";
									echo "<form action='delete-post.php' method='POST'>";
									echo "<input type='hidden' name='post-id' value='$row->post_id' />";
									echo "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash'></span> Delete</button>";
									echo "</form>";
									echo "</div>";
									echo "</div>";
									$first = false;
									$idx++;
								} else {
									if($mod) {
										echo "<div class='postodd'>";
										echo "<h4><a href='../post-detail.html'>" . $row->post_title . "</a></h4>";
										echo "<small>" . $row->date . " || " . $row->post_type . " || " . $row->post_category . "</small>";
										echo "<p>" . substr($row->post_content, 0, 160) . "...</p>";
										echo "<div class='pull-right'>";
										echo "<form action='edit-post.php' method='POST'>";
										echo "<input type='hidden' name='post-id' value='$row->post_id' />";
										echo "<button type='submit' class='btn btn-info'>Edit</button>";
										echo "</form>";
										echo "<form action='delete-post.php' method='POST'>";
										echo "<input type='hidden' name='post-id' value='$row->post_id' />";
										echo "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash'></span> Delete</button>";
										echo "</form>";
										echo "</div>";
										echo "</div>";
										$idx++;
									} else {
										echo "<div class='posteven'>";
										echo "<h4><a href='../post-detail.html'>" . $row->post_title . "</a></h4>";
										echo "<small>" . $row->date . " || " . $row->post_type . " || " . $row->post_category . "</small>";
										echo "<p>" . substr($row->post_content, 0, 160) . "...</p>";
										echo "<div class='pull-right'>";
										echo "<form action='edit-post.php' method='POST'>";
										echo "<input type='hidden' name='post-id' value='$row->post_id' />";
										echo "<button type='submit' class='btn btn-info'>Edit</button>";
										echo "</form>";
										echo "<form action='delete-post.php' method='POST'>";
										echo "<input type='hidden' name='post-id' value='$row->post_id' />";
										echo "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash'></span> Delete</button>";
										echo "</form>";
										echo "</div>";
										echo "</div>";
										$idx++;
									}
								}
							}
						} else {
							echo "<p>You haven't posted anything</p>";
						}
						?>
					</div>
					<div class="tab-pane solution" id="solution">
						<div class="postodd posttop">
							<h4><a href="#">Stasiun Tawang rapi dan bersih</a></h4>
							<h5>comment</h5>
							<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
								ac turpis egestas.</p>
							<small>20 mei 2015 || Update >> Infrastrktur</small>
						</div>
						<div class="posteven">
							<h4><a href="#">Trip ke Goa Kreo</a></h4>
							<h5>Solution</h5>
							<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
								ac turpis egestas.</p>
							<small>24 mei 2015 || Review >> Tourism</small>
						</div>
					</div>
					<div class="tab-pane solution post-form" id="post">
						<div class="well">
							<form class="form-horizontal" action="posts.php" method="POST" enctype="multipart/form-data">
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
								<div class="form-group">
									<label for="inputcharge" class="col-sm-2 control-label">Charge <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Yang bertanggung jawab, Kosongkan jika tidak ada"></span></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputcharge" name="inCharge">
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label for="inputjudul" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputjudul" name="postTitle">
									</div>
								</div>
								<div class="form-group">
									<label for="inputdeskrip" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="5" id="inputdeskrip" name="content"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="inputtag" class="col-sm-2 control-label">Tag</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputtag" id="inputtag" name="postTag">
									</div>
								</div>
								<div class="form-group">
									<label for="inputgambar" class="col-sm-2 control-label">Picture</label>
									<div class="col-sm-10">
										<input type="file" id="inputgambar" name="picture[]" multiple>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<hr>
										<button type="submit" class="btn btn-default btn-lg">Terbitkan</button>
									</div>
								</div>
							</form>
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
<script src="../js/jquery.min.js"></script>
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


