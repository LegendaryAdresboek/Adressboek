<?php
 session_start();
	if (!isset($_SESSION["loggedin"]) && !isset($_SESSION["IsAdmin"])) {
		header("Location:http://adressboek.000webhostapp.com/");
		exit;
	}elseif (isset($_SESSION["loggedin"]) && !isset($_SESSION["IsAdmin"])) {
	  header("Location:http://adressboek.000webhostapp.com/");
    exit;
	}

 ?>

<?php
//eerst connectie
//now grabs passwords from external file so no one can see.
$lines = file('configinlog.txt', FILE_IGNORE_NEW_LINES);
$connection = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);

//doet ie het
if (!$connection) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers invoeren
	if (!empty($_POST)) {

	$query = "INSERT INTO gebruikers (gebruiker_ID, voornaam, prefix, achternaam, gebruikersnaam, wachtwoord, beheerder)
    VALUES (null, '{$_POST['voornaam']}', '{$_POST['prefix']}', '{$_POST['achternaam']}', '{$_POST['gebruikersnaam']}', '{$_POST['wachtwoord']}', '{$_POST['beheerder']}')";


	$resultaat = mysqli_query($connection, $query);

	if (!$resultaat) {
		die ("Het is niet gelukt: ".mysqli_error($resultaat));
	} else {
		echo "U heeft een gebruiker toegevoegd";
	}
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
<form action="AddUser.php" method="post" >


Voornaam:<br>
<input type="text" name="voornaam" required>
<br>
Tussenvoegsel*: <br>
<input type="text" name="prefix">
<br>
Achternaam: <br>
<input type="text" name="achternaam" required>
<br>
Gebruikersnaam: <br>
<input type="text" name="gebruikersnaam" required>
<br>
Wachtwoord: <br>
<input type="text" name="wachtwoord" required>
<br>
Is beheerder?: <br>
<input type="text" name="beheerder" required>
<br>

<input type="submit" value="Verzenden">
</form>
<div/>
</body>
</html>
