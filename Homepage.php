
<!doctype html>
<html>
	<head>
    <base href="/">
		<meta charset="utf-8">
		<title>HomePage</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="jquery.tablesorter.js">
		</script>

    <link rel="stylesheet" type="text/css" href="Homepage.css">
	</head>


<body>
  <?php
   session_start();
  	if (!isset($_SESSION["login"])) {
  		header("Location:http://adressboek.000webhostapp.com");
  		exit;
  	}
    $user = $_SESSION["usrname"];
   ?>
<!-- PHP voor zoeken -->
<?php


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
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li>About</li>
			<li>Sign up</li>
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
				<a class="toggleBtn"><img class="buttonImg" src="Images/arrow-right.png"/></a>

				<h1>Zoeken:</h1>
				<form action="Homepage.php" method="post">
	          <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
	          <input type="submit" name="search" value="Filter"><br><br>
				</form>
			</nav>



      <table id="myTable">
				<thead>
          <tr>

							<th>ID</th>
							<th>Voornaam</th>
							<th>Tussenvoegsel</th>
							<th>Achternaam</th>
							<th>Adres</th>
							<th>Postcode</th>
							<th>Plaats</th>
							<th>Telefoonnumme</th>
          </tr>
				</thead>
				<tbody>

          <?php
            while($row = mysqli_fetch_assoc($search_result))
            {
          ?>
          <tr>
              <td><?php echo $row['ID'];?></td>
              <td><?php echo $row['Voornaam'];?></td>
              <td><?php echo $row['Tussenvoegsel'];?></td>
              <td><?php echo $row['Achternaam'];?></td>
              <td><?php echo $row['Adres'];?></td>
              <td><?php echo $row['Postcode'];?></td>
              <td><?php echo $row['Plaats'];?></td>
              <td><?php echo $row['Telefoonnummer'];?></td>

          </tr>
          <?php
          }
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

</script>

</body>
</html>
