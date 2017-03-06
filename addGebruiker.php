<?php
//eerst connectie
$connection = mysqli_connect("localhost", "id824985_gegevens", "adresboek", "id824985_contacten");

//doet ie het
if (!$connection) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers invoeren
	if (!empty($_POST)) {
		
	$query = "INSERT INTO gebruikers (Voornaam, Tussenvoegsel, Achternaam, Adres, Postcode, Plaats, Telefoonnummer)
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
<style type="text/css">
body
{
    /*background-image: url("achtergrond2.png");*/
    background-color: cornflowerblue;
    background-image: url("City.jpg");
}
</style>
</head>

<body>
<h1>Nieuw gebruiker invoeren </h1><br><br>
<form action="addGebruiker.php" method="post" >

Voornaam: <br>
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
</body>
</html>