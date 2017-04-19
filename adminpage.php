<?php
 session_start();
	if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
		header("Location:http://adressboek.000webhostapp.com");
		exit;
	}
	if ($_SESSION["isAdmin"] == 0) {
		header("location:javascript://history.go(-1)");
	}
  $user = $_SESSION["usrname"];
 ?>



<!doctype html>
<html>
	<head>
    <base href="/">
		<meta charset="utf-8">
		<title>AdminPage</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="jquery.tablesorter.js">
		</script>

    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
    <script src="magnific-popup/jquery.magnific-popup.js"></script>

    <link rel="stylesheet" type="text/css" href="Homepage.css">
	</head>


<body>

  <div id="test-popup" class="white-popup mfp-hide">
	<img class="modal-image" src="Images/logoboven.png" />
	<h3>Legendary AdresBook</h3>
	<p>Version 1.1<br />
		By: Darwin, Egbert-Jan, KaChung, Joshua and Rik. <br /><br />
		Copyright &copy; 2017 Legendary Inc. <br />
		All Rights Reserved.
	</p>
</div>

  <?php
  	if (!isset($_SESSION["login"])) {
  		header("Location:http://adressboek.000webhostapp.com");
  		exit;
  	}
    $user = $_SESSION["usrname"];
   ?>
<!-- PHP voor zoeken -->
<?php

if (isset($_POST['delThis'])) {
	$delID = $_POST['delThis'];
	$lines = file('../configgebruikers.txt', FILE_IGNORE_NEW_LINES);
	$connect = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
	$delQuery = "DELETE FROM Gebruikers WHERE ID = '$delID'";
	$resultaat = mysqli_query($connect, $delQuery);
	unset($_POST['delThis']);
}

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Gebruikers` WHERE CONCAT(`ID`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Adres`, `Postcode`, `Plaats`, `Telefoonnummer`) LIKE '%".$valueToSearch."%' ";

    $search_result = filterTable($query);

}
  else
  {
    $query = "SELECT * FROM `Gebruikers`";
    $search_result = filterTable($query);

  }

if(!isset($search_result)){
  die("Error");
}
// function to connect and execute the query
function filterTable($query)
{
    $lines = file('../configgebruikers.txt', FILE_IGNORE_NEW_LINES);
  	$connect = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);

    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>





<div id="container">
	<div id="header">
		<a href="#test-popup" class="open-popup-link"><img src="Images/logoboven.png" class="logoplaatje"/></a>
		<ul>
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
				<label><a href="UserSettings.php">Change Password?</a></label>
			</div>
			<div>
				<label><a href="uitlog.php">Log Out</a></label>
			</div>

	</div>


	<div id="content">

		<!-- Search menu -->
			<nav id="searchMenu">
				<a class="toggleBtn"><img class="buttonImg" src="Images/arrow-right.png"/></a>

				<h1>Zoeken:</h1>
				<form action="adminpage.php" method="post">
	          <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
	          <input type="submit" name="search" value="Filter" style="width:250px; margin-left:29px;"><br><br>
				</form>
				<form action="addContact.php" method="post" enctype="multipart/form-data">
					<input type="file" name="foto" style="margin-left:29px;"/>
					<input type="text" name="voornaam" placeholder="Voornaam"/>
					<input type="text" name="tvg" placeholder="Tussenvoegsel"/>
					<input type="text" name="achternaam" placeholder="Achternaam"/>
					<input type="text" name="adres" placeholder="Adres"/>
					<input type="text" name="postcode" placeholder="Postcode"/>
					<input type="text" name="plaats" placeholder="Plaats"/>
					<input type="text" name="telnr" placeholder="Telefoonnummer"/>
          <input type="text" name="opmerking" placeholder="Opmerking"/>
					<input type="submit" name="AddContact" style="width:250px; margin-left:29px;" />
				</form>
			</nav>




      <table id="myTable" border="0">
				<thead>
          <tr>

							<th style="width:90px;">PasFoto</th>
							<th>Voornaam</th>
							<th>Tussenvoegsel</th>
							<th>Achternaam</th>
							<th>Adres</th>
							<th>Postcode</th>
							<th>Plaats</th>
							<th>Telefoonnumme</th>
							<th>Opmerking</th>
              <th>Acties</th>

          </tr>
				</thead>
				<tbody>

          <?php
            while($row = mysqli_fetch_assoc($search_result))
            {
							$img=$row["image"]; //orginal image url from  db
    					if($img == null)
    						{
        					$img="iVBORw0KGgoAAAANSUhEUgAAAgAAAAIAAgMAAACJFjxpAAAADFBMVEXFxcX////p6enW1tbAmiBwAAAFiElEQVR4AezAgQAAAACAoP2pF6kAAAAAAAAAAAAAAIDbu2MkvY0jiuMWWQoUmI50BB+BgRTpCAz4G6C8CJDrC3AEXGKPoMTlYA/gAJfwETawI8cuBs5Nk2KtvfiLW+gLfK9m+r3X82G653+JP/zjF8afP1S//y+An4/i51//AsB4aH+/QPD6EQAY/zwZwN8BAP50bh786KP4+VT+3fs4/noigEc+jnHeJrzxX+NWMDDh4g8+EXcnLcC9T8U5S/CdT8bcUeBEIrwBOiI8ki7Ba5+NrePgWUy89/nYyxQ8Iw3f+pWY4h1gb3eAW7sDTPEOsLc7wK1TIeDuDB+I/OA1QOUHv/dFsZQkhKkh4QlEfOULYz2nGj2/Nn1LmwR/86VxlCoAW6kCsHRGANx1RgCMo5Qh2EsZgrXNQZZShp5Liv7Il8eIc5C91EHY2hxk6bwYmNscZIReDBwtCdhbErC1JGBpScBcOgFMLQsZMQs5Whayd+UQsLYsZGlZyNyykKllISNmIUfAwifw8NXvTojAjGFrdYi11SGWVoeYWx1i6lmQCiEjFkKOVgjZ+xxIhZCtFULWHkCqxCw9gNQKmP9vNHzipdEPrRcxtVbAeDkAvve0iM2QozVD9hfjhp4YP/UrkJYDbD2AtBxgfSkAvvHEeNcDSAsilgtAWxIy91J8AXgZAJ5e33+4tuACcAG4AFwALgBXRXQB6AFcB5MXAuA6nl9/0Vx/011/1V5/1/dfTPJvRtdnu/zL6beeFO/7r+fXBYbrEkt/j+i6ytXfpuvvE/ZXOnsA/a3a/l5xf7O6v1t+Xe/vOyz6HpO8yyboM8o7rfJes77bru83THk48p7TvOs27zvOO6/73vO++z7l4cgnMPQzKPopHC0N9noSSz6LJp/Gk88jyicy5TOp6qlc+VyyfDJbPpuuns6XzyfMJzTmMyrrKZ35nNJ8Ums+q7af1tvPK+4nNodEnPKp3fnc8npyez67/qVP7+/fL8hfcMjfsOhf8cjfMclfcnn9+BkOnLECP8Q58OYeyJ40eoyF6Ee/En/JHlP6mIlRVXprF4BxtAvArV0AxtEuALd2ARhHuwDc2gVgHPX/hFv9fMBddjIGeKg/WCxlCsI46u+Ga5mCcJd+sIG9UkGAW32ZbApFAHhod4Bb3eo04h3god0BbiUHYApVCNjbHeBW+QDAXT4a7qg7r7e214057vg0QhkEHkoSwq0kIdydXw4/Q3H8hjYJ3vL0WConBJhCHQaOToeBrU0BljYFmEoVgHGUKgAPnREAt84IgLuqFgAYSUEOAHszDwuAtSkHAZhLGYIpdCLgKGUIHtocZG1zkLmUIRhxDnJU1RDA1uYga5uDzKUOwhTnIEfnxcDe5iBrcyQAYGlzkKkUYhhxDrKXQgxbSwLWUohhbknA1JKAEZOAvSUBW0sC1pYEzC0JmFoSMMJyCDhaFrK3JGDtyiFgaVnI3LKQqWUhI2YhR8tC9paFrC0LWVoWMrcsZGpZyIhZyNGykL2rSIGtlQHWVgZYWhlgbmWAqZUBRiwDHK0MsLcywNbKAGsOoNUhllaHmFsdYmp1iBHrEEerQ+w5gFYI2VodYm11iKXVIeYcQCuETK0QMmIh5MgBtELI3gohWyuErDmAVolZWiFkzgG0SszUKjGjfj6gVmKOVonZcwCtFbB9HQC+ozWDbz1bvGu9iKW1AuYcQOtFTLEX1GbIaFegN0OOHEBrhuw5gNYM2XIArRuz5gDacoB3bTnAEktxXQ4wfw0AvveM8b4tiJjSJOwLIsbXsAKeNeKCiOO3D+AVbUl0AfjGs8ZPbUnIdgFoa1LWC0BblfMuB9AeC1j6gqQE0J9LmC8AOYD2ZMb7i4bt2ZTpWoHfPoB7Tj2fXzT8N1X41vkq/QHOAAAAAElFTkSuQmCC";
									//if image not found this will display
     						}
          ?>
          <tr>
              <td style="height:90px; padding:0px;"><?php echo '<img height="100%" width="100%" src="data:image;base64,'.$img.'" alt="Contact image"/>';?></td>
              <td><?php echo $row['Voornaam'];?></td>
              <td><?php echo $row['Tussenvoegsel'];?></td>
              <td><?php echo $row['Achternaam'];?></td>
              <td><?php echo $row['Adres'];?></td>
              <td><?php echo $row['Postcode'];?></td>
              <td><?php echo $row['Plaats'];?></td>
              <td><?php echo $row['Telefoonnummer'];?></td>
              <td><?php echo $row['opmerking'];?></td>
							<td><form method="post" action="editContactAdmin.php" ><button type="submit" name="buttonid" value="<?php echo $row['ID'] ?>"><img src="icon.ico" height="30" width="30" /></button></form>
								<form method="post" action="adminpage.php" ><button onclick="return confirm('Weet u zeker dat u dit wil verwijderen?')" type="submit" name="delThis" value="<?php echo $row['ID'] ?>"><img src="trash-icon.png" height="30" width="30" /></button></form>
							</td>
          </tr>
          <?php
          }
					// $_SESSION['nummerid'] = $_POST['buttonid'];
          ?>

				</tbody>
      </table>



	</div>



</div>

<!--DO NOT TOUCH THIS UNLESS UR ME-->
<!--I AM ME-->
<script type="text/javascript">
$(document).ready(function(){
	$("#myTable").tablesorter();
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

$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true,
	closeBtnInside:true,
	alignTop:false
});

</script>

</body>
</html>
