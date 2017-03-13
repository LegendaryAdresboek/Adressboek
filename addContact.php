<?php
//eerst connectie
//now grabs passwords from external file so no one can see.
$lines = file('configgebruikers.txt', FILE_IGNORE_NEW_LINES);
$connection = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);

//doet ie het
if (!$connection) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers invoeren
	if (!empty($_POST)) {

	$query = "INSERT INTO Gebruikers (Voornaam, Tussenvoegsel, Achternaam, Adres, Postcode, Plaats, Telefoonnummer)
    VALUES ('{$_POST['Voornaam']}', '{$_POST['Tussenvoegsel']}', '{$_POST['Achternaam']}', '{$_POST['Adres']}', '{$_POST['Postcode']}', '{$_POST['Plaats']}', '{$_POST['Telefoonnummer']}')";


	$resultaat = mysqli_query($connection, $query);

	if (!$resultaat) {
		die ("Het is niet gelukt: ".mysqli_error($resultaat));
	} else {
		echo "U heeft een gebruiker toegevoegd";
	}
	mysqli_close($connection);
	}




?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Database invoer</title>
<base href="/">
<link rel="stylesheet" type="text/css" href="Homepage.css">
</head>

<body>
<h1>Nieuw gebruiker invoeren </h1><br><br>
<div id="loginvak">
<form action="addGebruiker.php" method="post" >


Voornaam:<br>
<input type="text" name="Voornaam" required>
<br>
Tussenvoegsel*: <br>
<input type="text" name="Tussenvoegsel">
<br>
Achternaam: <br>
<input type="text" name="Achternaam" required>
<br>
Adres: <br>
<input type="text" name="Adres" required>
<br>
Postcode: <br>
<input type="text" name="Postcode" required>
<br>
Plaats: <br>
<input type="text" name="Plaats" required>
<br>
Telefoonnummer: <br>
<input type="tel" name="Telefoonnummer" required>
<br>

<input type="submit" value="Verzenden">
</form>
<div/>
</body>
</html>
