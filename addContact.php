<html>
<body>
  <img src="Images/wait.gif" height="100%" width="100%"/>
</body>
</html>

<?php
session_start();
 if (!isset($_SESSION["login"])) {
   header("Location:http://adressboek.000webhostapp.com");
   exit;
 }

 ?>

<?php
//eerst connectie
//now grabs passwords from external file so no one can see.
$lines = file('../configgebruikers.txt', FILE_IGNORE_NEW_LINES);
$connection = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);

//doet ie het
if (!$connection) {
	die("Bronze 5 never lucky: ".mysqli_connect_errno()."<br>".mysqli_connect_error());
}
//gebruikers invoeren
	if (!empty($_POST)) {

    $image = addslashes($_FILES['foto']['tmp_name']);
    $name = addslashes($_FILES['foto']['name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);

	$query = $connection->prepare("INSERT INTO `Gebruikers`(`ID`, `image`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Adres`, `Postcode`, `Plaats`, `Telefoonnummer`, `opmerking`) VALUES (null,?,?,?,?,?,?,?,?,?)");
  $query->bind_param("sssssssss", $img, $vn, $tvg, $an, $ad, $pc, $pl, $tl, $op);

  $img = $image;
  $vn = $_POST['voornaam'];
  $tvg = $_POST['tvg'];
  $an = $_POST['achternaam'];
  $ad = $_POST['adres'];
  $pc = $_POST['postcode'];
  $pl = $_POST['plaats'];
  $tl = $_POST['telnr'];
  $op = $_POST['opmerking'];
  $query->execute();
  //$result->$query->get_result();
	// $resultaat = mysqli_query($connection, $query);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;


	// if (!$result) {
	// 	die ("Het is niet gelukt: ".mysqli_error($result));
	// } else {
	// 	Header("Location: Homepage.php");
  //   exit;
	// }
}




?>
