<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="Homepage.css">

	</head>

<?php
 session_start();
	if (!isset($_SESSION["loggedin"])) {
		header("Location:http://adressboek.000webhostapp.com/");
		exit;
	}

 ?>
<body>

<div id="container"><h1>Het adressboek</h1>

	<div id="loginvak">


		<form>
			<p>Voornaam:</p><input class="textvak" type="text" name="gebruikersnaam">
			<p>Tussenvoegsel:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Achternaam:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Telefoon Nummer:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Adress:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <input class="button" type="submit" value="Zoeken" style="height: 40px">
		</form>
		<button id="loguit">uitloggen</button>
		<button id="toevoegen">toevoegen</button>
		<script type="text/javascript">
    	document.getElementById("loguit").onclick = function() {
        	location.href = "http://adressboek.000webhostapp.com/uitlog.php/";
    	};
			document.getElementById("toevoegen").onclick = function() {
        	location.href = "http://adressboek.000webhostapp.com/addContact.php/";
    	};
		</script>






	</div>

	<div id="tabel">

		<table>

			<tr>
				<th>Voornaam</th>
				<th class="klein">Tussenvoegsel</th>
				<th>Achternaam</th>
				<th>Telefoon Nummer</th>
				<th>Adress</th>
			</tr>
			<tr>
				<td>Rik</td>
				<td class="klein"></td>
				<td>Bosman</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Johua</td>
				<td class="klein"></td>
				<td>Goudsblom</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Ka Chung</td>
				<td class="klein"></td>
				<td>Li</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Darwin</td>
				<td class="klein">de</td>
				<td>Wilde</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
			<tr>
				<td>Egbert-Jan</td>
				<td class="klein"></td>
				<td>Terpstra</td>
				<td>06123456789</td>
				<td>AB 8338</td>
			</tr>
		</table>
	</div>
</div>




</body>
</html>
