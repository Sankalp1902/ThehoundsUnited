<?php
    session_start();
?>
<!DOCTYPE html>
<html class='no-js' lang='en'>

	<head>
		<meta charset='utf-8' />
		<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
		<title>The Hounds</title>

		<link rel="shortcut icon" href="favicon.ico" />

		<link rel="stylesheet" href="css/maximage.css" type="text/css" media="screen" charset="utf-8" />

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<?php
				if (!isset($_SESSION["status"])) {
					echo "<nav class='navtop'>";
					echo "<ul>";
					echo "<button id='log' type='button' class='btn btn-outline-secondary btn-lg' data-toggle='modal' data-target='#signup'><li><img src='' /><br>S<br>I<br>G<br>N<br>U<br>P</li></button>";
					echo "<button id='log' type='button' class='btn btn-outline-secondary btn-lg' data-toggle='modal' data-target='#login'><li><img src='' /><br>L<br>O<br>G<br>I<br>N<br> </li></button>";
					echo "</ul>";
					echo "</nav>";
				}
				else {
					echo "<nav class='navtop'>";
					echo "<ul>";
					echo "<a type='button' class='btn btn-outline-secondary btn-lg' href='logout.php'><li><img src='' /><br>L<br>O<br>G<br>O<br>U<br>T</li></a>";
					echo "</ul>";
					echo "</nav>";
				}
		?>


		<!-- Main Navigation -->
		<nav class="low-nav">
			<ul>
				<li><a href="destination.php" name="create">Create Pool</a></li>
				<li><a href="drag.php" name="join">Join Pool</a></li>
			</ul>
		</nav>

		<!-- Home Page -->
		<section class="content show" id="home">
			<h1>Welcome to the Hounds' car pooling <br><?php
			if (isset($_SESSION["status"])) {
				if($_SESSION["status"]=="Active"){
					echo $_SESSION["nm"];
				}
			}
			 ?></h1><br><br>
			<h5>Why to prefer car pooling?</h5><br>
			<p>☻Free from Registration of the car, Maintenance of the car, Insurance of the car and so on!<br/>☻Save on FUEL!<br/>☻Reach your destination, FREE from SWEAT & TENSION!<br/>☻As if you own the car but at less than HALF the COST of travel!!</p>
		</section>



		<!-- Background Slides -->
		<div id="maximage">
			<div>
				<img src="images/backgrounds/bg-img-1.jpg" alt="" />
				<img class="gradient" src="images/backgrounds/gradient.png" alt="" />
			</div>
			<div>
				<img src="images/backgrounds/bg-img-2.jpg" alt="" />
				<img class="gradient" src="images/backgrounds/gradient.png" alt="" />
			</div>
			<div>
				<img src="images/backgrounds/bg-img-3.jpg" alt="" />
				<img class="gradient" src="images/backgrounds/gradient.png" alt="" />
			</div>
			<div>
				<img src="images/backgrounds/bg-img-4.jpg" alt="" />
				<img class="gradient" src="images/backgrounds/gradient.png" alt="" />
			</div>
			<div>
				<img src="images/backgrounds/bg-img-5.jpg" alt="" />
				<img class="gradient" src="images/backgrounds/gradient.png" alt="" />
			</div>
		</div>


		<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div style="max-width: 700px;" class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 style="color: #666; " class="modal-title" id="exampleModalLongTitle">Login:</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal" method="POST" action="loginb.php">
		            <div class="form-group">
		            <label class="col-sm-10" for="id">User Id</label>
		            <div class="col-sm-10">
		                <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your ID">
		                <span id="isE"></span>
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="password" >Password</label>
		            <div class="col-sm-10">
		                <input type="password" class="form-control" id="password" name="password" required placeholder="Hope you didn't forgot :)">
		            </div>
		            </div>
		        <hr noshade style="color:#000000" align="center">
		            <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <button type="submit" class="btn btn-success" name="b2">LOGIN</button>
		              <a class="btn btn-outline-secondary" style="margin-left: 20px; cursor: pointer;" href="signup.php" >Not registered yet?</a>
		            </div>
		            </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div style="max-width: 700px;" class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 style="color: #666; " class="modal-title" id="exampleModalLongTitle">Signup:</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		            <form class="form-horizontal" method="POST" role="form" name="regF" action="register.php">
		            <div class="form-group">
		            <label class="col-sm-10" for="name">Name</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" pattern="[A-Za-z].{2,}" id="name" name="name" required placeholder="Name">
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="id">User Id</label>
		            <div class="col-sm-10">
		                <input type="text" class="form-control" id="username" name="username" required placeholder="Must be unique!">
		                
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="email">Email</label>
		            <div class="col-sm-10">
		                <input type="email" class="form-control" id="email" name="email" required placeholder="Must be unique!">
		                
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="phone" >Phone</label>
		            <div class="col-sm-10">
		                <input type="tel" class="form-control" id="phone"  name="phone" required>
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="password" >Password</label>
		            <div class="col-sm-10">
		                <input type="password" class="form-control" id="password" minlength="8" name="password" required placeholder="At least 8 character">
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="confirm_Password">Confirm Password</label>
		            <div class="col-sm-10">
		                <input type="password" class="form-control" id="confirm_Password" minlength="8" name="confirm_Password" required placeholder="Retype-Password">
		              <span id="message"></span>
		            </div>
		            </div>
	
		<hr noshade style="color:#000000" align="center">
		            <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <input type="submit" class="btn btn-success" value='SIGN-UP' >
		            </div>
		            </div>
		            </form>
		     </div>
		    </div>
		  </div>
		</div>



		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="js/jquery.easing.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.ba-hashchange.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>

<script>
            var password = document.getElementById("password");
            var confirm_Password = document.getElementById("confirm_Password");
            document.getElementById("message").style.display = "none";
            confirm_Password.onkeyup = function () {
                // Validate lowercase letters
                if (password.value === confirm_Password.value) {
                    document.getElementById("message").style.display = "none";
                } else {
                    document.getElementById("message").style.display = "block";
                }
            }
            password.onkeyup = function () {
                // Validate lowercase letters
                if (password.value === confirm_Password.value) {
                    document.getElementById("message").style.display = "none";
                } else {
                    document.getElementById("message").style.display = "block";
                }
            }
        </script>
		<script type="text/javascript" charset="utf-8">
			$(function(){
				$('#maximage').maximage({
					cycleOptions: {
						fx: 'fade',
						speed: 1000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
						timeout: 5000,
						prev: '#arrow_left',
						next: '#arrow_right',
						pause: 0,
						before: function(last,current){
							if(!$.browser.msie){
								// Start HTML5 video when you arrive
								if($(current).find('video').length > 0) $(current).find('video')[0].play();
							}
						},
						after: function(last,current){
							if(!$.browser.msie){
								// Pauses HTML5 video when you leave it
								if($(last).find('video').length > 0) $(last).find('video')[0].pause();
							}
						}
					},
					onFirstImageLoaded: function(){
						jQuery('#cycle-loader').hide();
						jQuery('#maximage').fadeIn('fast');
					}
				});

				// Helper function to Fill and Center the HTML5 Video
				jQuery('video,object').maximage('maxcover');

			});
		</script>
		<script>
		$(window).scroll(function () {
		if (($(document).height() - $(window).height() - $(window).scrollTop()) >= 15) {
		$('.low-nav').css('display','none');
		$('.logo').css('display','none');
		} else {
		$('.low-nav').css('display','block');
		$('.logo').css('display','block');
		}
		});
	</script>

  </body>
</html>
