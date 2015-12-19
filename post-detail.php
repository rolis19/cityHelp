<?php
include_once 'connection.php';

$id = $_GET['post_id'];
$sql = mysql_query("SELECT * FROM post WHERE post_id='$id'");
$post = mysql_fetch_object($sql);

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $post->post_title; ?> - Smart City</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/post-detail.css">
		<link rel="stylesheet"  href="css/lightslider.css"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Quicksand:400,300,700' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/lightslider.js"></script> 
		
		 <script>
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

	      });
    	</script>
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
		  			<div class="logo"><a href="index.html"><img src="img/logo.png" width="200px"></a></div>
					</div>
					<!-- Start Navigation -->
		  			<div class="collapse navbar-collapse" id="collapse" role="navigation">
			  			<ul class="nav navbar-nav navbar-right">
			  				<li><a href="social.html">Social</a></li>
							<li><a href="infrastructure.html">Infrastructure</a></li>
							<li><a href="economy.html">Economy</a></li>
							<li><a href="tourism.html">Tourism</a></li>	
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
			                    <li data-thumb="img/prob1.png"> 
			                        <img src="img/prob1.png">
			                    </li>
			                    <li data-thumb="img/prob2.png"> 
			                        <img src="img/prob2.png" />
			                    </li>
			                    <li data-thumb="img/prob3.png"> 
			                        <img src="img/prob3.png" />
			                    </li>
			                    <li data-thumb="img/prob4.png"> 
			                        <img src="img/prob4.png" />
			                    </li>
		                    
		               		</ul>
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
								<div class="best-solusion">3 Solusi</div>
								<div class="sosmed">
								<div class="sosmed-head">Share</div>
								<img src="img/fb.png" alt="">
								<img src="img/twt.png" alt="">
								<img src="img/gog.png" alt="">
							</div>
						</div>
						<a href="#modal-solusi" role="button" data-toggle="modal" class="btn btn-success btn-lg">Give <?php echo ($post->post_type == "Complaint" ? "Solution" : "Comment"); ?></a>
					</div>
					<div class="col-md-12 post-detail">
						<div class="prob">
							<p><?php echo $post->post_content; ?></p>
						</div>
					</div>
					<div class="col-md-12">
					<h2><?php echo ($post->post_type == "Complaint" ? "Solution" : "Comment"); ?></h2>
						<div class="solusi-body">
							<p>
								<div class="date">12 februari 2015</div>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam enim nisi, placerat quis ornare eu, scelerisque ac risus. Phasellus dapibus dui a fermentum scelerisque. Pellentesque fringilla pretium elit, 
							</p>
							<p>
								Setuju : 20 orang
							</p>
							<div class="pool pull-right">
								<p>
									<a href="#">Setuju</a> | <a href="#">tidak setuju</a>
								</p>
							</div>
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
								<li><a href=#about.html> About </a> </li>
								<li><a href=#help.html> Help </a> </li>
								<li><a href=#terms.html> Terms </a> </li>
								<li><a href=#privacy.html> Privacy </a> </li>
							</ul>
						</div>
						<div class="col-md-2">
							<ul>
								<li><a href=#teams.html> Teams </a> </li>
								<li><a href=#advertise.html> Advertise</a> </li>
								<li><a href=#terms.html> Terms</a> </li>
								<li><a href=#privacy.html> Privacy </a> </li>
							</ul>
						</div>
						<div class="col-md-2">
							<ul>
								<li>Follow us </li>
								<li><a href=> Facebook</a> </li>
								<li><a href=> Twitter</a> </li>
								<li><a href=> Instagram </a> </li>
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
		        	<form>
		    	        <div class="modal-body text-center">
		                	 <div class="form-group">
							  <label for="comment">Solusi:</label>
							  <textarea class="form-control" rows="5" id="comment" style="width: 100%">Tuliskan solusimu</textarea>
							  <p>Berikan solusi yang relevant, dengan topic gunakan bahasa yang baik. lihat peraturan selengkapnya</p>
							  <hr>
							  <a href="#" class="btn btn-success btn-lg">Submit</a>
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


