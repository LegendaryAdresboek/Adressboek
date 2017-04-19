
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
<form action="editContactAdmin.php" method="post" enctype="multipart/form-data">
<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
    <ul>
      <li><input id="sendSound" type="submit" name="update" class="knop updateknopje"/></li>
      <li><a href="javascript:history.go(-1)">Terug</a></li>
    </ul>
		<ul class="ulrechts">

			<li><a href="#" id="Login"><?php print($user); ?></a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label>Hello, <?php print($user); ?>!</label>
        <hr />
			</div>
			<div>
				<label><a href="UserSettings.php">Change Password?</a></label>
			</div>
			<div>
				<label><a href="uitlog.php">Log Out</a></label>
			</div>

	</div>


	<div id="content">



    		<table class="admintable">

    			<tr>
            <th style="width:10%;">Pasfoto</th>
    				<th>Voornaam</th>
    				<th>Tussenvoegsel</th>
    				<th>Achternaam</th>
            <th style="width:18%;">Adres</th>
    				<th>Postcode</th>
    				<th>Plaats</th>
            <th>Telefoonnummer</th>
            <th style="width:25%">Opmerking</th>
    			</tr>
          <?php
          while($rijen=mysqli_fetch_array($resultaat)) {
            $img=$rijen["image"]; //orginal image url from  db
            if($img == null)
              {
                $img="iVBORw0KGgoAAAANSUhEUgAAAgAAAAIAAgMAAACJFjxpAAAADFBMVEXFxcX////p6enW1tbAmiBwAAAFiElEQVR4AezAgQAAAACAoP2pF6kAAAAAAAAAAAAAAIDbu2MkvY0jiuMWWQoUmI50BB+BgRTpCAz4G6C8CJDrC3AEXGKPoMTlYA/gAJfwETawI8cuBs5Nk2KtvfiLW+gLfK9m+r3X82G653+JP/zjF8afP1S//y+An4/i51//AsB4aH+/QPD6EQAY/zwZwN8BAP50bh786KP4+VT+3fs4/noigEc+jnHeJrzxX+NWMDDh4g8+EXcnLcC9T8U5S/CdT8bcUeBEIrwBOiI8ki7Ba5+NrePgWUy89/nYyxQ8Iw3f+pWY4h1gb3eAW7sDTPEOsLc7wK1TIeDuDB+I/OA1QOUHv/dFsZQkhKkh4QlEfOULYz2nGj2/Nn1LmwR/86VxlCoAW6kCsHRGANx1RgCMo5Qh2EsZgrXNQZZShp5Liv7Il8eIc5C91EHY2hxk6bwYmNscZIReDBwtCdhbErC1JGBpScBcOgFMLQsZMQs5Whayd+UQsLYsZGlZyNyykKllISNmIUfAwifw8NXvTojAjGFrdYi11SGWVoeYWx1i6lmQCiEjFkKOVgjZ+xxIhZCtFULWHkCqxCw9gNQKmP9vNHzipdEPrRcxtVbAeDkAvve0iM2QozVD9hfjhp4YP/UrkJYDbD2AtBxgfSkAvvHEeNcDSAsilgtAWxIy91J8AXgZAJ5e33+4tuACcAG4AFwALgBXRXQB6AFcB5MXAuA6nl9/0Vx/011/1V5/1/dfTPJvRtdnu/zL6beeFO/7r+fXBYbrEkt/j+i6ytXfpuvvE/ZXOnsA/a3a/l5xf7O6v1t+Xe/vOyz6HpO8yyboM8o7rfJes77bru83THk48p7TvOs27zvOO6/73vO++z7l4cgnMPQzKPopHC0N9noSSz6LJp/Gk88jyicy5TOp6qlc+VyyfDJbPpuuns6XzyfMJzTmMyrrKZ35nNJ8Ums+q7af1tvPK+4nNodEnPKp3fnc8npyez67/qVP7+/fL8hfcMjfsOhf8cjfMclfcnn9+BkOnLECP8Q58OYeyJ40eoyF6Ee/En/JHlP6mIlRVXprF4BxtAvArV0AxtEuALd2ARhHuwDc2gVgHPX/hFv9fMBddjIGeKg/WCxlCsI46u+Ga5mCcJd+sIG9UkGAW32ZbApFAHhod4Bb3eo04h3god0BbiUHYApVCNjbHeBW+QDAXT4a7qg7r7e214057vg0QhkEHkoSwq0kIdydXw4/Q3H8hjYJ3vL0WConBJhCHQaOToeBrU0BljYFmEoVgHGUKgAPnREAt84IgLuqFgAYSUEOAHszDwuAtSkHAZhLGYIpdCLgKGUIHtocZG1zkLmUIRhxDnJU1RDA1uYga5uDzKUOwhTnIEfnxcDe5iBrcyQAYGlzkKkUYhhxDrKXQgxbSwLWUohhbknA1JKAEZOAvSUBW0sC1pYEzC0JmFoSMMJyCDhaFrK3JGDtyiFgaVnI3LKQqWUhI2YhR8tC9paFrC0LWVoWMrcsZGpZyIhZyNGykL2rSIGtlQHWVgZYWhlgbmWAqZUBRiwDHK0MsLcywNbKAGsOoNUhllaHmFsdYmp1iBHrEEerQ+w5gFYI2VodYm11iKXVIeYcQCuETK0QMmIh5MgBtELI3gohWyuErDmAVolZWiFkzgG0SszUKjGjfj6gVmKOVonZcwCtFbB9HQC+ozWDbz1bvGu9iKW1AuYcQOtFTLEX1GbIaFegN0OOHEBrhuw5gNYM2XIArRuz5gDacoB3bTnAEktxXQ4wfw0AvveM8b4tiJjSJOwLIsbXsAKeNeKCiOO3D+AVbUl0AfjGs8ZPbUnIdgFoa1LWC0BblfMuB9AeC1j6gqQE0J9LmC8AOYD2ZMb7i4bt2ZTpWoHfPoB7Tj2fXzT8N1X41vkq/QHOAAAAAElFTkSuQmCC";
                //if image not found this will display
              }
          ?>

          <tr>

            <?php $_SESSION['cid'] = $rijen['ID']; ?>
            <td><?php echo '<img height="50" width="50" src="data:image;base64,'.$img.'" alt="Contact image"/>';?><br /><input type="file" name="foto"></td>
            <td><input type="textbox" value="<?php echo $rijen['Voornaam'] ?>" name="voornaam"/></td>
            <td><input type="textbox" value="<?php echo $rijen['Tussenvoegsel'] ?>" name="prefix"/></td>
            <td><input type="textbox" value="<?php echo $rijen['Achternaam'] ?>" name="achternaam" /></td>
            <td><input type="textbox" value="<?php echo $rijen['Adres'] ?>" name="adres" /></td>
            <td><input type="textbox" value="<?php echo $rijen['Postcode'] ?>" name="postcode"/></td>
            <td><input type="textbox" value="<?php echo $rijen['Plaats'] ?>" name="plaats"/></td>
            <td><input type="textbox" value="<?php echo $rijen['Telefoonnummer'] ?>" name="telnummer"/></td>
            <!-- <td><input type="textbox" value="" name="opmerking"/></td> -->

            <td><textarea rows="4" cols="50" maxlength="140" value="" name="opmerking"><?php echo $rijen['opmerking'] ?></textarea></td>

              <?php
          }
          ?>
    		</table>
        <p class="infoadmin">Klik op een veld om het te wijzigen</p>


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
            $opmerking = $_POST['opmerking'];
            $conID = $_SESSION['cid'];
          if(!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
                $query = "UPDATE `Gebruikers` SET `Voornaam`='".$vnaam."',`Tussenvoegsel`='".$prefix."',`Achternaam`='".$anaam."',`Adres`='".$adres."',`Postcode`='".$postcode."',`Plaats`='".$plaats."',`Telefoonnummer`='".$telnummer."',`opmerking`='".$opmerking."' WHERE `ID`='".$conID."'";
            }else {
              $image = addslashes($_FILES['foto']['tmp_name']);
              $name = addslashes($_FILES['foto']['name']);
              $image = file_get_contents($image);
              $image = base64_encode($image);
              $query = "UPDATE `Gebruikers` SET `image`='".$image."',`Voornaam`='".$vnaam."',`Tussenvoegsel`='".$prefix."',`Achternaam`='".$anaam."',`Adres`='".$adres."',`Postcode`='".$postcode."',`Plaats`='".$plaats."',`Telefoonnummer`='".$telnummer."',`opmerking`='".$opmerking."' WHERE `ID`='".$conID."'";
            }

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
