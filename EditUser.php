
<?php
 session_start();
if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
	header("Location:http://adressboek.000webhostapp.com");
	exit;
}
if ($_SESSION["isAdmin"] == 0) {
	header("location:javascript://history.go(-1)");
}

$lines = file('../configinlog.txt', FILE_IGNORE_NEW_LINES);
$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_errno());
};

	if (!isset($_SESSION["login"])) {
		header("Location:http://adressboek.000webhostapp.com");
		exit;
	}
  $user = $_SESSION["usrname"];




  $gid = $_SESSION['UID'];


  $selectUser = "SELECT * FROM gebruikers WHERE gebruiker_ID LIKE '$gid'";
  $resultaat = mysqli_query($conn, $selectUser);

 ?>

<!doctype html>
<html>
	<head>
    <base href="/">
		<meta charset="utf-8">
		<title>Edit a user</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="EditUser.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li>About</li>
			<li><a href="AdminSettingsPage.php">Terug</a></li>
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

<form action="EditUser.php" method="post">

		<table>

			<tr>
				<th>Voornaam</th>
				<th>Tussenvoegsel</th>
				<th>Achternaam</th>
        <th>email</th>
				<th>Gebruikersnaam</th>
				<th>Wachtwoord</th>
        <th>Beheerder</th>
			</tr>
      <?php
      while($rijen=mysqli_fetch_array($resultaat)) {
      ?>

      <tr>

        <!-- <td><?php echo $rijen['gebruiker_ID'] ?></td> -->
        <td><input type="textbox" value="<?php echo $rijen['voornaam'] ?>" name="voornaam"/></td>
        <td><input type="textbox" value="<?php echo $rijen['prefix'] ?>" name="prefix"/></td>
        <td><input type="textbox" value="<?php echo $rijen['achternaam'] ?>" name="achternaam" /></td>
        <td><input type="textbox" value="<?php echo $rijen['email'] ?>" name="email" /></td>
        <td><input type="textbox" value="<?php echo $rijen['gebruikersnaam'] ?>" name="gebruikersnaam"/></td>
        <td><input type="textbox" value="<?php echo $rijen['wachtwoord'] ?>" name="wachtwoord"/></td>
        <td><input type="textbox" value="<?php echo $rijen['beheerder'] ?>" name="beheerder"/></td>

          <?php
      }
      ?>
		</table>
    <label class="info">Klik op een veld om het te wijzigen</label>

    <input type="submit" name="update" class="knop updateknopje"/>
    </form>

    <!-- PHP voor Updaten records database -->
    <?php
      if (isset($_POST['update'])) {
        $vnaam = $_POST['voornaam'];
        $prefix = $_POST['prefix'];
        $anaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $gnaam = $_POST['gebruikersnaam'];
        $wwoord = $_POST['wachtwoord'];
        $beheer = $_POST['beheerder'];
        $gebruikerID = $_SESSION['UID'];
        $query = "UPDATE gebruikers SET voornaam='$vnaam',prefix='$prefix',achternaam='$anaam',email='$email',gebruikersnaam='$gnaam',wachtwoord='$wwoord',beheerder='$beheer' WHERE gebruiker_ID= '$gebruikerID'";

        $resultaat = mysqli_query($conn, $query);
        if ($resultaat) {
					header("Location: AdminSettingsPage.php");
          unset($_SESSION['editID']);
				} else {
					echo "Het is niet gelukt!";
				}

      }

     ?>


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
