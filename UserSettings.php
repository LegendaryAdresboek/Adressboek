<?php
	if (isset($_POST["newpas"])) {
		if ($_POST["newpas"] == $_POST["newpasrep"]) {
			
		}else if ($_POST["newpas"] != $_POST["newpasrep"]) {

		}
	}
 ?>

<!doctype html>

<html>
	<head>
		<base href="/" />
		<meta charset="utf-8">
		<title>Admin Pagina</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="AdminSettingPage.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="logoboven.png" class="logoplaatje"/>
		<ul>
			<li><a href="#">About</a></li>
			<li><a href="#">Administratief</a></li>
			<li><a href="#" id="Login">Username</a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label>Hello, Username!</label>
			</div>
			<div>
				<label><a href="#">Settings</a></label>
			</div>
			<div>
				<button>Log off</button>
			</div>

	</div>


	<div id="content">

		<!-- Search menu -->
			<nav id="searchMenu">
				<a class="toggleBtn"><img class="buttonImg" src="images\arrow-right.png"/></a>

				<h1>Zoeken:</h1>
				<label>Voornaam:</label>
				<div>
					<input type="text" />
				</div>
				<label>Tussenvoegel:</label>
				<div>
					<input type="text" />
				</div>
				<label>Achternaam:</label>
				<div>
					<input type="text" />
				</div>

			</nav>

			<form method="post" action="php.php">
				Change password:<input type="password" name="newpas" /><br />
				Repeat password:<input type="password" name="newpasrep"/>
				<input type="submit" />

			</form>



	</div>



</div>

<script type="text/javascript">
$(document).ready(function(){
	var form = $(".loginForm");
	var arrow = $(".upArrow");
	var status = false;
	var searchStatus = false;

	var navToggleBtn = $(".toggleBtn");

	navToggleBtn.click(function(event){
		$("#searchMenu").toggleClass("activeNav");
		event.preventDefault();
	});

	navToggleBtn.click(function(event){
		event.preventDefault();
		if(searchStatus == false){
			$(".buttonImg").attr('src', "images/arrow-left.png");
			searchStatus = true;
		}else {
			$(".buttonImg").attr('src', "images/arrow-right.png");
			searchStatus = false;
		}


	});


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
