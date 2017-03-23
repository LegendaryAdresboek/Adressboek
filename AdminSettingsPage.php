<?php
session_start();
//Now grabs passwords from external file so no one can see.
	$lines = file('configinlog.txt', FILE_IGNORE_NEW_LINES);
	$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_errno());
	};
	$user = $_SESSION["usrname"];
?>

<!doctype html>

<html>
	<head>
		<base href="/" />
		<meta charset="utf-8">
		<title>HomePage</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="AdminSettingPage.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="logoboven.png" class="logoplaatje"/>
		<ul>
			<li>About</li>
			<li>Sign up</li>
			<li><a href="#" id="Login"><?php print($user); ?></a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label>Hello, <?php print($user); ?>!</label>
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
				<label>Acternaam:</label>
				<div>
					<input type="text" />
				</div>
				<label>Telefoon Nummer:</label>
				<div>
					<input type="text" />
				</div>
				<label>Adres:</label>
				<div>
					<input type="text" />
				</div>

			</nav>

			<table>

				<tr>
	        <th>X</th>
					<th>Voornaam</th>
					<th>Tussenvoegsel</th>
					<th>Achternaam</th>
					<th>Telefoon Nummer</th>
					<th>Adress</th>
	        <th>X</th>
				</tr>
				<tr>
	    <?php

	    $query = "SELECT * FROM gebruikers";
	    $result = mysqli_query($conn, $query);

	// $x = 0;
	    while($row = mysqli_fetch_assoc($result))
	    {
	      // $x++;
	    ?>


	    			<tr>
	    				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
	    				<td><?php print($row["voornaam"]); ?></td>
	    				<td><?php print($row['prefix']); ?></td>
	    				<td><?php print($row['achternaam']); ?></td>
	            <td>Telefoon Nummer</td>
	    				<td><?php print($row['gebruikersnaam']); ?></td>

	    				<td class="icon"><button class="wijzigButton"><img class="potlood" src="icon.ico"></button></td>
							<td><button type="button" name="delete">Verwijder gebruiker</button></td>
	    			</tr>

	    <?php
	    }
	    ?>
				</tr>

			</table>


	</div>



</div>

<!--DO NOT TOUCH THIS UNLESS UR ME-->
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
