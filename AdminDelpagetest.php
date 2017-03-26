<?php
//eerst connectie
//$connection = mysqli_connect("localhost", "id824985_gegevens", "adresboek", "id824985_contacten");
$lines = file('../configinlog.txt', FILE_IGNORE_NEW_LINES);
$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_errno());
};
//doet ie het
if (!$conn) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers selecteren

	$query = "SELECT * FROM gebruikers";

	$resultaat = mysqli_query($conn, $query) or die ("Lukt niet");

	$tellen = mysqli_num_rows($resultaat);

?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gebruiker verwijderen</title>
<style type="text/css">
body
{
    background-image:url(../Thema.jpg);
}
.tabel {
	margin:0 auto;
}
.deleteknopje {

}
</style>
</head>

<body>
<h2>Gebruiker verwijderen</h2>
<form action="AdminDelpagetest.php" method="post" onSubmit="return confirm('Weet u zeker dat de gebruiker(s) verwijderd moeten worden?')">
<table border="1">
<tr>
	<th><input type="checkbox" id="select_all"/> Selecct All</th>
    <th>Gebruikers_ID</th>
	<th>Voornaam</th>
    <th>Tussenvoegsel</th>
    <th>Achternaam</th>
    <th>Adres</th>
    <th>Postcode</th>

</tr>
	<?php
	while($rijen=mysqli_fetch_array($resultaat)) {
	?>

	<tr>
    	<td><input type="checkbox" name="check[]" value="<?php echo $rijen['gebruiker_ID'];?>"></td>
		<td><?php echo $rijen['gebruiker_ID'] ?></td>
		<td><?php echo $rijen['voornaam'] ?></td>
		<td><?php echo $rijen['prefix'] ?></td>
		<td><?php echo $rijen['achternaam'] ?></td>
		<td><?php echo $rijen['gebruikersnaam'] ?></td>
		<td><?php echo $rijen['beheerder'] ?></td>

    	<?php
	}
	?>
	</tr>

    </table>
    <br>
    <input type="submit" value="verwijderen" name="verwijderen" class="deleteknopje">
    </form>
    </div>
    <?php
	// hiermee kijken of het gecheckt is. Zo wel, dan verwijder command uitvoeren
	if (!empty($_POST)) {
	if(isset($_POST['verwijderen'])) {
		$check = $_POST['check'];

	for ($x=0; $x<count($check);$x++){

		$verwijderen = $check[$x];
		$query = "DELETE FROM gebruikers WHERE gebruiker_ID = '$verwijderen'";
		$resultaat = mysqli_query($conn, $query);
		}
	}

	if ($resultaat) {
		echo '<meta http-equiv="refresh"; content="0">';
	} else {
		echo "Het is niet gelukt!";
		}
	}

	?>

</table>
</body>
</html>
