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
		<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps.css'/>
		<style>
		#map {
			height: 100vh;
			width: 100vw;
			z-index:9;
			position: absolute;
		 }
	 </style>
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
		<div id="map" class="map"></div>

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
		            <form class="form-horizontal" method="POST" role="form" name="regF" onsubmit="return validate()">
		            <div class="form-group">
		            <label class="col-sm-10" for="name">Name</label>
		            <div class="col-sm-10">
		              <input type="text" class="form-control" pattern="[A-Za-z].{2,}" id="name" name="name" required placeholder="Name">
		            </div>
		            </div>
		            <div class="form-group">
		            <label class="col-sm-10" for="id">User Id</label>
		            <div class="col-sm-10">
		                <input type="text" class="form-control" id="username" name="username" required placeholder="Must be unique!" onblur="checkExist()">
		                <span id="isE"></span>
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
		<script>
		$('#password, #confirm_Password').on('keyup', function () {
		  if ($('#password').val()==$('#confirm_Password').val()) {
		    $('#message').html('Matching password').css('color', 'green');
		  } else
		    $('#message').html('Confirm password must be same as Password!').css('color', 'red');
		});
		</script>
		<hr noshade style="color:#000000" align="center">
		            <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <button type="submit" class="btn btn-success" name="b1">SIGN-UP</button>
		            </div>
		            </div>
		            </form>
		     </div>
		    </div>
		  </div>
		</div>


		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="js/jquery.easing.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.ba-hashchange.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>

		<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps-web.min.js'  type="text/javascript" charset="utf-8"></script>
	    <script>
	      tt.setProductInfo('com.thehoundsunited.carpool', '1.0');
				key: '57NbLt5SDV09G7Gw6gaOCw8VPNteWURM',
		    container: 'map',
		    style: 'https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0',
		    dragPan: !isMobileOrTablet()
	    </script>

		<script>
$('#password, #confirm_Password').on('keyup', function () {
  if ($('#password').val()==$('#confirm_Password').val()) {
    $('#message').html('Matching password').css('color', 'green');
  } else
    $('#message').html('Confirm password must be same as Password!').css('color', 'red');
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
