<?php
 session_start();
	if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
		header("Location:http://adressboek.000webhostapp.com");
		exit;
	}
	if ($_SESSION["isAdmin"] == 0) {
		header("location:javascript://history.go(-1)");
	}
  $user = $_SESSION["usrname"];
 ?>

<!doctype html>

<html>
	<head>
		<base href="/">
		<meta charset="utf-8">
		<title>Admin Pagina</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="Adminpagina.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li><a href="#">About</a></li>
			<li><a href="#">Administratief</a></li>
			<li><a href="#" id="Login"><?php print($user); ?></a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label class="foldMenu">Hello, <?php print($user); ?>!</label>
				<hr />
			</div>
			<div>
				<label class="foldMenu"><a href="UserSettings.php">Settings</a></label>
			</div>
			<div>
				<label class="foldMenu"><a href="uitlog.php">Log off</a></label>
			</div>

	</div>


	<div id="content">

		<!-- Search menu -->
			<nav id="searchMenu">
				<a class="toggleBtn"><img class="buttonImg" src="Images/arrow-right.png"/></a>

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

		<table>

			<tr>
				<th>Voornaam</th>
				<th>Tussenvoegsel</th>
				<th>Achternaam</th>
				<th>Telefoon Nummer</th>
				<th>Adress</th>
			</tr>
			<tr>
				<td>Rik</td>
				<td></td>
				<td>Bosman</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Joshua</td>
				<td></td>
				<td>Goudsblom</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Ka Chung</td>
				<td></td>
				<td>Li</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Darwin</td>
				<td>de</td>
				<td>Wilde</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Egbert-Jan</td>
				<td></td>
				<td>Terpstra</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
		</table>


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
			$(".buttonImg").attr('src', "Images/arrow-left.png");
			searchStatus = true;
		}else {
			$(".buttonImg").attr('src', "Images/arrow-right.png");
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