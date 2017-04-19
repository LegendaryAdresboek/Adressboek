<?php
	session_start();
	if (isset($_SESSION["error"])) {
		if ($_SESSION["error"] == "usrPwdEr") {
			echo '<script type="text/javascript">alert("Wrong username/password, please try again.");</script>';
			unset($_SESSION["error"]);
		}
	}

 ?>

<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title>loginpagina</title>
		<link rel="stylesheet" href="magnific-popup/magnific-popup.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="magnific-popup/jquery.magnific-popup.js"></script>
		<link rel="stylesheet" type="text/css" href="loginpagina.css">

	</head>


<body>

<div id="container">
	<div id="header">
		<a href="#test-popup" class="open-popup-link"><img src="Images/logoboven.png" class="logoplaatje"/></a>
		<ul>
			<li><a href="#" id="Login">Sign in</a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm" style="z-index:100;">
			<form method="post" action="php.php">
					<label>Username: </label>
				<div>
					<input type="text" placeholder="Username"  name="username" required/>
				</div>
					<label>Password: </label>
				<div>
					<input type="password" placeholder="Password" name="password" required/>
				</div>
				<div>
					<input type="submit" value="Log in" required/>
				</div>

			</form>
		</div>
	</div>

	<div id="content">
		<!-- <img class="logo" src="Images/logoonder.png" /> -->
		<img class="icon" src="Images/Privacy.png"/>
		<p>
			We store your contacts safe and secure!
		</p>
		<div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="https://www.youtube.com/embed/afP71xwLI8Y?start=5&autoplay=1&iv_load_policy=3&controls=0&showinfo=0" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>

		</div>
	</div>

<div id="test-popup" class="white-popup mfp-hide">
	<img class="modal-image" src="Images/logoboven.png" />
	<h3>Legendary AdresBook</h3>
	<p>Version 1.1<br />
		By: Darwin, Egbert-Jan, KaChung, Joshua and Rik. <br /><br />
		Copyright &copy; 2017 Legendary Inc. <br />
		All Rights Reserved.
	</p>
</div>


</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.image-link').magnificPopup({type:'image'});
	var form = $(".loginForm");
	var arrow = $(".upArrow");
	var status = false;

	$("#Login").click(function(event){
		event.preventDefault();
		if(status == false){
			form.fadeIn();
			arrow.fadeIn();
			status = true;
		}else {
			form.fadeOut();
			arrow.fadeOut();
			status = false;
		}
	});

});

$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true,
	closeBtnInside:true,
	alignTop:false
});

</script>

</body>
</html>
