<?php
session_start();
if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
	header("Location:http://adressboek.000webhostapp.com");
	exit;
}
if ($_SESSION["isAdmin"] == 0) {
	header("location:javascript://history.go(-1)");
}
	unset($_SESSION['UID']);
//Now grabs passwords from external file so no one can see.
	$lines = file('../configinlog.txt', FILE_IGNORE_NEW_LINES);
	$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_errno());
	};
	$user = $_SESSION["usrname"];

	$query = "SELECT * FROM gebruikers";

	$resultaat = mysqli_query($conn, $query) or die ("Something went wrong");

	$tellen = mysqli_num_rows($resultaat);

?>

<!doctype html>

<html>
	<head>
		<base href="/" />
		<meta charset="utf-8">
		<title>Admin settings</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="AdminSettingPage.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li>About</li>
			<li><a href="adminpage.php">Back</a></li>
			<li><a href="#" id="Login"><?php print($user); ?></a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label>Hello, <?php print($user); ?>!</label>
				<hr />
			</div>
			<div>
				<label><a href="UserSettings.php">Settings</a></label>
			</div>
			<div>
				<label><a href="uitlog.php">Log off</a></label>
			</div>

	</div>


	<div id="content">

		<!-- Search menu -->
			<nav id="searchMenu">
				<a class="toggleBtn"><img class="buttonImg" src="Images\arrow-right.png"/></a>

				<h1>Nieuwe gebruiker:</h1>
				<label>Voer in:</label>
				<div>
					<form action="AddUser.php" method="post">
						<input type="text" name="voornaam" placeholder="Voornaam" />
						<input type="text" name="prefix" placeholder="Tussenvoegsel" />
						<input type="text" name="achternaam" placeholder="Achternaam" />
						<input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" />
						<input type="text" name="wachtwoord" placeholder="Wachtwoord" />
						<input type="text" name="beheerder" placeholder="Beheerder 1=ja 0=nee" />
						<input type="submit" name="newUser" value="newUsers" />
					</form>
				</div>


			</nav>

			<form action="AdminSettingsPage.php" method="post">
			<table border="1">
			<tr>
				<th><input type="checkbox" id="select_all"/> Selecct All</th>
			    <!-- <th>Gebruikers_ID</th> -->
				<th>Voornaam</th>
			    <th>Tussenvoegsel</th>
			    <th>Achternaam</th>
			    <th>Gebruikersnaam</th>
			    <th>Beheerder?</th>

			</tr>
				<?php
				while($rijen=mysqli_fetch_array($resultaat)) {
				?>

				<tr>
			    <td><input type="checkbox" name="check[]" value="<?php echo $rijen['gebruiker_ID'];?>"></td>
					<!-- <td><?php echo $rijen['gebruiker_ID'] ?></td> -->
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
			    <input type="submit" value="verwijderen" name="verwijderen" class="knop deleteknopje">
					<input type="submit" value="update" name="update"  class="knop updateknopje"/>
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
				}elseif (isset($_POST['update'])) {
						$check = $_POST['check'];
					$update = $check[0];
					$_SESSION['UID'] = $update;
					Header("Location: EditUser.php");
					exit;
				}

				if ($resultaat) {
					echo '<meta http-equiv="refresh"; content="0">';
				} else {
					echo "Het is niet gelukt!";
				}
				}

				?>

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
