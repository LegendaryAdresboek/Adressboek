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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="loginpagina.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li>About</li>
			<li>Sign up</li>
			<li><a href="#" id="Login">Sign in</a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
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
		<img class="logo" src="Images/logoonder.png" />
		<img class="icon" src="Images/Privacy.png"/>
		<p>
			We store your contacts safe and secure!
		</p>

		</div>
	</div>



</div>

<script type="text/javascript">
$(document).ready(function(){
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

</script>

</body>
</html>
