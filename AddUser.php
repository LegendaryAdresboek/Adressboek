<?php
session_start();
 if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
   header("Location:http://adressboek.000webhostapp.com");
   exit;
 }
 if ($_SESSION["isAdmin"] == 0) {
   header("location:javascript://history.go(-1)");
 }

 ?>

<?php
//eerst connectie
//now grabs passwords from external file so no one can see.
$lines = file('../configinlog.txt', FILE_IGNORE_NEW_LINES);
$connection = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);

//doet ie het
if (!$connection) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers invoeren
	if (!empty($_POST)) {

	$query = "INSERT INTO gebruikers (gebruiker_ID, voornaam, prefix, achternaam, gebruikersnaam, wachtwoord, beheerder)
    VALUES (null, '{$_POST['voornaam']}', '{$_POST['tussenvoegsel']}', '{$_POST['achternaam']}', '{$_POST['gebruikersnaam']}', '{$_POST['wachtwoord']}', '{$_POST['beheerder']}')";


	$resultaat = mysqli_query($connection, $query);



	if (!$resultaat) {
		die ("Het is niet gelukt: ".mysqli_error($resultaat));
	} else {
		Header("Location: AdminSettingsPage.php");
    exit;
	}
}




?>
