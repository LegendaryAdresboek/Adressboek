<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="Homepage.css">
	</head>


<body>
	<?php
		$conn = mysqli_connect("localhost", "id824985_admin", "HQo5PrygJ+Yy", "id824985_inlog");
		if (!$conn) {
	    die("Connection failed: " . mysqli_connect_errno());
		}
		if(!empty($_POST["name"]) && !empty($_POST["pass"])){
	    $userName = $_POST["name"] or "";
	    $userPass = $_POST["pass"] or "";
			$login = false;
		}else {
			echo "vul wat in...";
		}
	    if ($userName && $userPass )
	    {

	        $query = "SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = '$userName' AND wachtwoord = '$userPass'";
	        $result = mysqli_query($conn, $query);
	        $row = mysqli_fetch_assoc($result);

	        if($row){
	           $login = true;
				}else {
					$login = false;
				}
	}

	?>

	<?php
	if ($login == true) {
		echo "<div id='container'><h1>Het adressboek</h1>

			<div id='loginvak'>


				<form>
					<p>Voornaam:</p><input class='textvak' type='text' name='gebruikersnaam'>
					<p>Tussenvoegsel:</p> <input class='textvak' type='text' name='gebruikersnaam'>
		            <p>Achternaam:</p> <input class='textvak' type='text' name='gebruikersnaam'>
		            <p>Telefoon Nummer:</p> <input class='textvak' type='text' name='gebruikersnaam'>
		            <p>Adress:</p> <input class='textvak' type='text' name='gebruikersnaam'>
		            <input class='button' type='submit' value='Zoeken' style='height: 40px'>
				</form>





			</div>

			<div id='tabel'>

				<table>

					<tr>
						<th>Voornaam</th>
						<th class='klein'>Tussenvoegsel</th>
						<th>Achternaam</th>
						<th>Telefoon Nummer</th>
						<th>Adress</th>
					</tr>
					<tr>
						<td>Rik</td>
						<td class='klein'></td>
						<td>Bosman</td>
						<td>06123456789</td>
						<td>AB 8338</td>
					</tr>
					<tr>
						<td>Johua</td>
						<td class='klein'></td>
						<td>Goudsblom</td>
						<td>06123456789</td>
						<td>AB 8338</td>
					</tr>
					<tr>
						<td>Ka Chung</td>
						<td class='klein'></td>
						<td>Li</td>
						<td>06123456789</td>
						<td>AB 8338</td>
					</tr>
					<tr>
						<td>Darwin</td>
						<td class='klein'>de</td>
						<td>Wilde</td>
						<td>06123456789</td>
						<td>AB 8338</td>
					</tr>
					<tr>
						<td>Egbert-Jan</td>
						<td class='klein'></td>
						<td>Terpstra</td>
						<td>06123456789</td>
						<td>AB 8338</td>
					</tr>
				</table>
			</div>
		</div>";
	}else {
		echo "u stoopid";
	}



 ?>
</body>
</html>
