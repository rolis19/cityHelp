<?php
include_once 'connection.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ekonomi - Smart City</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/tourism.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Quicksand:400,300,700' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#validation').submit(function(event) {
				event.preventDefault();
			});

			$('#submit-email').click(function() {
				var valid = $('#valid-email')[0].checkValidity();
				var value = $('#valid-email').val();
				if(valid && value != "") {
					$('#email').val(value);
					$('#valid-email').val("");
					$('#modal-sign').modal("hide");
					$('#modal-signup').modal("show");
				}
			});

			$('.modal1').click(function() {
				$('#valid-email').val("");
			});

			$('.modal2').click(function() {
				$('#name').val("");
				$('#username').val("");
				$('#pass').val("");
				$('#confirm_pass').val("");
			})

		});

		function validate() {
			var pass = document.getElementById("pass");
			var confirm = document.getElementById("confirm_pass");

			if(pass.value != confirm.value) {
				confirm.setCustomValidity("Password don't match");
			} else {
				confirm.setCustomValidity("");
			}
		}
	</script>
</head>
<body>
<section class="infrastructure" data-parallax="scroll">
	<div class="container-fluid">
		<div class="row main-header">
			<div class="hero text-center">
				<h1>ECONOMY</h1>
				<div class="categ-menu">
					<a href="tourism-event.html">Pekerjaan</a>
					<div class="bullet"></div>
					<a href="tourism-food.html">Pendapatan</a>
					<div class="bullet"></div>
					<a href="tourism-places.html">All</a>
				</div>
				<a href="#" class="btn btn-success btn-lg">ECONOMY DATA</a>
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
					<li><a href="social.php">Social</a></li>
					<li><a href="infrastructure.php">Infrastructure</a></li>
					<li class="active"><a href="economy.php">Economy</a></li>
					<li><a href="tourism.php">Tourism</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<div class="container main-post	">
	<div class="row">
		<div class="col-md-8">
			<?php
				$query = mysql_query("SELECT * FROM post WHERE post_category='Economy'");
				while($row = mysql_fetch_object($query)) {
					$jumlah = mysql_fetch_object(mysql_query("SELECT COUNT(*) num FROM comment WHERE post_id='$row->post_id'"))->num;
					$pic = json_decode($row->pictures);
					$img = $pic['0'];
					echo "<div class='col-md-6'>";
					echo "<h4>" . $row->post_title . "</h4>";
					echo "<small>" . $row->post_category . " // " . $row->post_type . "</small>";
					echo "<div class='panel-body'>";
					echo "<img src='member/gallery/" . $img . "' alt='' class='img-responsive img-thumbnail'>";
					echo "<table>";
					echo "<tr>";
					echo "<td class='headli'>Posted by : </td>";
					echo "<td>" . $row->post_author . "</td>";
					echo "<tr>";
					echo "</table>";
					echo "</div>";
					echo "<div class='panel-footer text-center'>";
					echo "<small class='solution'>$jumlah <br>". ($row->post_type == "Complaint" ? "Solution" : "Comment") . "</small>";
					echo "<a href='post/$row->post_id' class='readmore'>Read More</a>";
					echo "<small class='respond'>2000<br>responder</small>";
					echo "</div>";
					echo "</div>";
				}
			?>
		</div>

		<div class="col-md-3 col-md-offset-1 sidebar">
			<div class="populer">
				<h2>Populer</h2>
				<ul>
					<li><a href="#">Pasar tradisional Johar</a></li>
					<li><a href="#">Jalan Baru Banyumanik</a></li>
					<li><a href="#">Taman tugu muda</a></li>
					<li><a href="#">Pembenahan Kota lama</a></li>
				</ul>
			</div>
			<div class="tags">
				<h2>Tags</h2>
				<ul>
					<li><a href="#" id="tag1"><small>#mranggenMacet</small></a></li>
					<li><a href="#" id="tag2"><small>#premanPengamen</small></a></li>
					<li><a href="#" id="tag3"><small>#gojekSemarang</small></a></li>
					<li><a href="#" id="tag1"><small>#anakJalananSmg</small></a></li>
					<li><a href="#" id="tag3"><small>#lawangsewuSmg</small></a></li>
				</ul>
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
	<div class="col-md-6">
		<ul>
			<li> Jl.Imam Bonjol No. 207 </li>
			<li> SEMARANG </li>
			<li> Central Java </li>
			<li> (024)3517261 </li>
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
<script src="js/jquery.waypoints.js"></script>
<script src="js/parallax.js"></script>
<script src="js/init.js"></script>
</body>
</html>