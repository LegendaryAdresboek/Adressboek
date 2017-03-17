<!doctype html>
<?php


// $lines = file('configgebruikers.txt', FILE_IGNORE_NEW_LINES);
// $connection = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
$host = "localhost";
$gebruiker = "root";
$wachtwoord = "";
$database = "lessenphp";

$conection = mysqli_connect($host, $gebruiker, $wachtwoord, $database);



if(mysqli_connect_error())
{
	echo"Connectie Failed: " . mysqli_connect_error() . " ( " . mysqli_connect_errno() . " )";
}


$query = "SELECT * FROM Adressboek";

$result = mysqli_query($conection, $query);

if(!$result)
{
	echo"error";
}
 ?>


<html>
	<head>
		<meta charset="utf-8">
		<title>Adminpagina</title>
		<link rel="stylesheet" type="text/css" href="Adminpagina.css">
	</head>


<body>
<div id="container">
<h1>Het adressboek</h1>
	<div id="loginvak">
	<form>
			<p>Voornaam:</p><input class="textvak" type="text" name="gebruikersnaam">
			<p>Tussenvoegsel:</p> <input class="textvak" type="text" name="tussenvoegsel">
            <p>Achternaam:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Telefoon Nummer:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Adress:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <input class="button" type="submit" value="Zoeken" style="height: 40px">
						<input class="button" type="submit" value="Toevoegen" style="height: 40px">
						<input class="button" type="submit" value="Wijzigen" style="height: 40px">
						<input onclick="verwijder()"  class="button" type="submit" value="Verwijderen" style="height: 40px";>
		</form>
	</div>

	<div id="tabel">


		<table>
			<tr>
				<th class="checkbox"><input onchange="checkAll(this)" name="chk[]" validate id="check" class="checkbox" type="checkbox"></th>
				<th>Voornaam</th>
				<th>Tussenvoegsel</th>
				<th>Achternaam</th>
				<th>Nummer</th>
				<th>Adress</th>
				<th class="icon"></th>
			</tr>
<?php


		while($row = mysqli_fetch_assoc($result))
		{
		?>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td><?php print($row["voornaam"]); ?></td>
				<td><?php print($row['tussenvoegsel']); ?></td>
				<td><?php print($row['achternaam']); ?></td>
				<td><?php print($row['nummer']); ?></td>
				<td><?php print($row['adress']); ?></td>
				<td class="icon"><button class="weizigbutton"><img src="icon.ico"></button></td>
			</tr>

<?php
}
?>
	</table>
	</div>

</div>




</body>

<script type="text/javascript">

	function checkAll(ele)
	{
		var checkboxes = document.getElementsByTagName('input');
		if (ele.checked)
		{
			for (var i = 0; i < checkboxes.length; i++)
			{
				if (checkboxes[i].type == 'checkbox')
				{
					checkboxes[i].checked = true;
				}
			}
		}

		else
		{
			for (var i = 0; i < checkboxes.length; i++)
			{

				if (checkboxes[i].type == 'checkbox')
				{
					checkboxes[i].checked = false;
				}
			}
		}
	}

function verwijder()
{

	if(document.getElementById('check').checked)
	{
		alert("Weet u zeker dat u dit wilt verwijderen?");

	}
	else
	{
		alert("Selecteer iets");

	}
}



	 </script>
</html>
