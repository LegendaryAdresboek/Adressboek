
<?php

session_start();

$lines = file('../configgebruikers.txt', FILE_IGNORE_NEW_LINES);
$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_errno());
};

	if (!isset($_SESSION["login"])) {
		header("Location:http://adressboek.000webhostapp.com");
		exit;
	}
  $user = $_SESSION["usrname"];

  $cid = $_POST['buttonid'];


  $selectUser = "SELECT * FROM Gebruikers WHERE ID LIKE '$cid'";
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
      <li><a href="#">About</a></li>
			<li><a href="AdminSettingsPage.php">Administratief</a></li>
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

<form action="editContactAdmin.php" method="post">

		<table>

			<tr>
				<th>Voornaam</th>
				<th>Tussenvoegsel</th>
				<th>Achternaam</th>
        <th>Adres</th>
				<th>Postcode</th>
				<th>Plaats</th>
        <th>Telefoonnummer</th>
			</tr>
      <?php
      while($rijen=mysqli_fetch_array($resultaat)) {
      ?>

      <tr>

        <?php $_SESSION['cid'] = $rijen['ID']; ?>
        <td><input type="textbox" value="<?php echo $rijen['Voornaam'] ?>" name="voornaam"/></td>
        <td><input type="textbox" value="<?php echo $rijen['Tussenvoegsel'] ?>" name="prefix"/></td>
        <td><input type="textbox" value="<?php echo $rijen['Achternaam'] ?>" name="achternaam" /></td>
        <td><input type="textbox" value="<?php echo $rijen['Adres'] ?>" name="adres" /></td>
        <td><input type="textbox" value="<?php echo $rijen['Postcode'] ?>" name="postcode"/></td>
        <td><input type="textbox" value="<?php echo $rijen['Plaats'] ?>" name="plaats"/></td>
        <td><input type="textbox" value="<?php echo $rijen['Telefoonnummer'] ?>" name="telnummer"/></td>

          <?php
      }
      ?>
		</table>
    <label class="info">Klik op een veld om het te wijzigen</label>

    <input id="sendSound" type="submit" name="update" class="knop updateknopje"/>
    </form>

    <!-- PHP voor Updaten records database -->
    <?php
      if (isset($_POST['update'])) {
        $vnaam = $_POST['voornaam'];
        $prefix = $_POST['prefix'];
        $anaam = $_POST['achternaam'];
        $adres = $_POST['adres'];
        $postcode = $_POST['postcode'];
        $plaats = $_POST['plaats'];
        $telnummer = $_POST['telnummer'];
        $conID = $_SESSION['cid'];

        $query = "UPDATE `Gebruikers` SET `Voornaam`='".$vnaam."',`Tussenvoegsel`='".$prefix."',`Achternaam`='".$anaam."',`Adres`='".$adres."',`Postcode`='".$postcode."',`Plaats`='".$plaats."',`Telefoonnummer`='".$telnummer."' WHERE `ID`='".$conID."'";


        $result = mysqli_query($conn, $query);

        if ($result) {
          unset($_SESSION['cid']);
          sleep(1);
					header("Location: adminpage.php");
          // echo $resultaat;

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
  var sendSound = new Audio("sendSound.mp3")
	var form = $(".loginForm");
	var arrow = $(".upArrow");
	var status = false;
	var searchStatus = false;

	var navToggleBtn = $(".toggleBtn");


  $('#sendSound').on("click", function(){
    sendSound.play();
    snd.currentTime=0;
  });
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
</html
