<!DOCTYPE html>
<html>
<head>
	<title>Smart - City</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
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
<section class="home" data-parallax="scroll">
	<div class="container-fluid">
		<div class="row main-header" style="padding-top: 100px">

			<div class="hero text-center">
				<h1>Step to Change your city </h1>
				<p>Langkah awal untuk menuju Semarang yang lebih baik, diawali dari diri kita sendiri, mari ikut berkontribusi untuk menuju Semarang yang
					lebih baik. Melalui sistem yang telah kami buat</br><strong><font size='5'> SEMARANG SETARA </font></strong> </p>
				<a href="#" class="btn btn-success btn-lg">Ketahui Cara Kerja</i></a>
			</div>
			<div class="user">
				<a href="#modal-sign" role="button" data-toggle="modal">DAFTAR</a>
				<a href="#modal-login" role="button" data-toggle="modal">MASUK</a>
				<img src="img/user.png" alt="" width="50px">
			</div>
		</div>
	</div>
</section>
<div class="border-green"> </div>

<nav class="navbar">
	<div class="container-fluid">
		<div class="logo"><a href="index.html"><img src="img/logo.png" width="200px" style="float: left"></a></div>
		<ul class="nav navbar-nav navbar-right">
			<li role="presentation"><a href="social.php">Sosial</a></li>
			<li role="presentation"><a href="infrastructure.php">Infrastruktur</a></li>
			<li role="presentation"><a href="economy.php">Ekonomi</a></li>
			<li role="presentation"><a href="tourism.php">Wisata</a></li>
		</ul>
	</div>
</nav>
<div class="part1">
	<div class="container quotes">
		<?php
			include_once 'connection.php';
			$sql = mysql_query("SELECT COUNT(*) num FROM quotes");
			$length = mysql_fetch_object($sql)->num;
			$id = rand(1, $length);
			$query = mysql_query("SELECT * FROM quotes WHERE id='$id'");
			$quotes = mysql_fetch_object($query);
			$idiom = $quotes->idioms;
			$author = $quotes->author;
			echo "<p class='words'>" .$idiom. "</p>";
			echo "<p>" .$author. "</p>";
		?>
	</div>
</div>
<div class="part3">
	<?php
		$categoryNum = mysql_num_rows(mysql_query("SELECT DISTINCT post_category FROM post"));
		$category = array();
		$query = mysql_query("SELECT DISTINCT post_category FROM post");
		while($row = mysql_fetch_object($query)) {
			array_push($category, $row->post_category);
		}

		$key = rand(0, $categoryNum-1);
		$query = mysql_query("SELECT * FROM post WHERE post_category='$category[$key]'");
		unset($category[$key]);
		$temp = $category;
		$category = array();
		foreach($temp as $tmp) {
			array_push($category, $tmp);
		}
		$count = -1;
		$p_id = "";
		while($row = mysql_fetch_object($query)) {
			$sql = mysql_query("SELECT COUNT(*) FROM comment WHERE post_id='$row->post_id'");
			$num = mysql_num_rows($sql);
			if($count < $num) {
				$count = $num;
				$p_id = $row->post_id;
			}
		}

		$post = mysql_fetch_object(mysql_query("SELECT * FROM post WHERE post_id='$p_id'"));
		$img = json_decode($post->pictures);

		echo "<div class='container'>";
		echo "<div class='row'>";		
		echo "<div class='col-md-6'>";
		echo "<img src='" . (count($img) ? "member/gallery/" . $img[0] : "img/post-img-default.jpg") . "' alt='' class='img-responsive img-thumbnail'>";
		echo "</div>";		
		echo "<div class='col-md-6'>";
		echo "<div class='ctpi'>";
		echo "<p> Kategori </p>";
		echo "<p> Jenis </p>";
		echo "<p> Di Unggah oleh </p>";
		echo "<p> Ditujukan </p>";
		echo "</div>";		
		echo "<div class='pcag'>";
		echo "<p> $post->post_category </p>";
		echo "<p> $post->post_type </p>";
		echo "<p> $post->post_author </p>";
		echo "<p> $post->post_inCharge </p>";
		echo "</div>";
		echo "<div class='clearfix'></div>";
		echo "<div class='prob'>";
		echo "<h3>" . $post->post_title . "</h3>";
		echo "<p>" . substr($post->post_content, 0, 160) . "...</p>";
		echo "</div>";
		echo "<p><small>*lihat semua detil responden dan keputusan</small></p>";
		echo "<a href='post/$post->post_id' class='btn btn-success btn-lg'>Selengkapnya</a>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	?>
	<!-- <div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="img/Broken-Road.jpg" alt="" class="img-responsive img-thumbnail">
			</div>
			<div class="col-md-6">
				<div class="ctpi">
					<p> Kategori </p>
					<p> Jenis </p>
					<p> Di Unggah oleh </p>
					<p> Ditujukan </p>
				</div>
				<div class="pcag">
					<p> Pariwisata </p>
					<p> Keluhan </p>
					<p> Bima Yudi Prasetya </p>
					<p> Sosial </p>
				</div>
				<div class="clearfix"></div>
				<div class="prob">
					<h3> Judul Permasalahan </h3>
					<p>Jalan menuju Ngrembel Asri, Gunung Pati banyak yang rusak, waktu itu saya melihat ada pengendara motor yang terjatuh karena jalan tersebut. Untung saja korban hanya mengalami luka ringan dan segera diberi P3K oleh warga sekitar. </p>
				</div>
				<p><small>*lihat semua detil responden dan keputusan</small></p>

				<a href="post-detail.html" class="btn btn-success btn-lg">Selengkapnya</a>
			</div>
		</div>
	</div> -->
	<div class="container">
		<div class="row feature-child">
			<?php
				foreach($category as $postCat) {
					$query = mysql_query("SELECT * FROM post WHERE post_category='$postCat'");
					$count = -1;
					$p_id = "";
					while($row = mysql_fetch_object($query)) {
						$sql = mysql_query("SELECT COUNT(*) FROM comment WHERE post_id='$row->post_id'");
						$num = mysql_num_rows($sql);
						if($count < $num) {
							$count = $num;
							$p_id = $row->post_id;
						}
					}

					$post = mysql_fetch_object(mysql_query("SELECT * FROM post WHERE post_id='$p_id'"));

					echo "<div class='col-md-4'>";
					echo "<h4>". $post->post_title . "</h4>";
					echo "<small>Kategori : " . $post->post_category . "</small>";
					echo "<hr>";
					echo "<p>" . substr($post->post_content, 0, 160) . "...</p>";
					echo "<p><a href='post/$post->post_id' class='btn btn-success'>Selengkapnya</a></p>";
					echo "</div>";
				}
			?>
			<!-- <div class="col-md-4">
				<h4>Judul 2</h4>
				<small>Kategori : Social</small>
				<hr>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation</p>
				<p><a href="" class="btn btn-success">Selengkapnya</a></p>
			</div>
			<div class="col-md-4">
				<h4>Judul 3</h4>
				<small>Kategori : Infrastruktur</small>
				<hr>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation</p>
				<p><a href="" class="btn btn-success">Selengkapnya</a></p>
			</div>
			<div class="col-md-4">
				<h4>Judul 4</h4>
				<small>Kategori : Economy</small>
				<hr>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation</p>
				<p><a href="" class="btn btn-success">Selengkapnya</a></p>
			</div> -->
		</div>
	</div>
</div>

<div class="part2">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2> Semarang </h2>
				<p> "Semarang Setara" merupakan  slogan Kota Semarang  untuk mempermudah seluruh pemangku kepentingan pembangunan mengimplementasikan perwujudan visi dan misi Kota Semarang 2010 - 2015. Makna yang terkandung dalam slogan tersebut bahwa Kota Semarang sudah waktunya memiliki kedudukan yang setara dengan kota metropolitan lainnya.</p>
				<a href="profil-semarang.html" type="button" class="btn btn-success"> Baca profil kota </a>
			</div>
			<div class="cuaca col-md-6 text-center" style="margin-top: 50px">
				<iframe id="forecast_embed" type="text/html" frameborder="0" height="225" width="100%"
						src="http://forecast.io/embed/#lat=-6.973098&lon=110.415744&name=SEMARANG&color=#69B24F&font=Georgia&units=uk">
				</iframe>

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
				<p>GUNAKAN MENDAFTAR ALTERNATIF</p>
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
					<button type="submit" class="btn btn-success btn-lg">MASUK</button>
				</form>
				<hr width="60%">
				<p>GUNAKAN MASUK ALTERNATIF</p>
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
					<button type="submit" class="btn btn-success btn-lg">DAFTAR</button>
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
			<li> Jawa Tengah </li>
			<li> (024)3517261 </li>
		</ul>
	</div>
	<div class="col-md-2">
		<ul>
			<li><a href="#about.html"> Tentang </a> </li>
			<li><a href="#help.html"> Bantuan </a> </li>
			<li><a href="#terms.html"> Istilah </a> </li>
			<li><a href="#privacy.html"> Privasi </a> </li>
		</ul>
	</div>
	<div class="col-md-2">
		<ul>
			<li><a href="#teams.html"> Teams </a> </li>
			<li><a href="#advertise.html"> Periklanan </a> </li>
			<li><a href="#terms.html"> Istilah </a> </li>
			<li><a href="#privacy.html"> Privasi </a> </li>
		</ul>
	</div>
	<div class="col-md-2">
		<ul>
			<li>Ikuti kami </li>
			<li><a href="#"> Facebook</a> </li>
			<li><a href="#"> Twitter</a> </li>
			<li><a href="#"> Instagram </a> </li>
		</ul>
	</div>
	<div class="col-md-12 copyright">
		<p> Hak Cipta @ SmartCity 2016-2017 </p>
	</div>
</footer>
<script src="js/jquery.waypoints.js"></script>
<script src="js/parallax.js"></script>
<script src="js/init.js"></script>
</body>
</html>