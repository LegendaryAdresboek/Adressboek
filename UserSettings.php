<?php
session_start();
if (!isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 0) {
	header("Location:http://adressboek.000webhostapp.com");
	exit;
}

$lines = file('configinlog.txt', FILE_IGNORE_NEW_LINES);
$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_errno());
};



	$user = $_SESSION["usrname"];


	if (isset($_POST["newpas"])) {
		$newpas = $_POST["newpas"];
		if ($_POST["newpas"] == $_POST["newpasrep"]) {
			$input = $conn ->prepare("UPDATE gebruikers SET wachtwoord = ? WHERE gebruikersnaam = ? ");
			$input->bind_param("ss", $newPassword, $currentUser);

			$newPassword = $newpas;
			$currentUser = $user;
			$input->execute();
			header("Location: uitlog.php");

		}else if ($_POST["newpas"] != $_POST["newpasrep"]) {
			echo '<script>alert("passwords do not match");</script>';
		}
	}
 ?>

<!doctype html>

<html>
	<head>
		<base href="/" />
		<meta charset="utf-8">
		<title>Admin Pagina</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="UserSettingPage.css">
	</head>


<body>

<div id="container">
	<div id="header">
		<img src="Images/logoboven.png" class="logoplaatje"/>
		<ul>
			<li><a href="#">About</a></li>
			<li><a href="#">Administratief</a></li>
			<li><a href="#" id="Login"><?php print($user); ?></a></li>
		</ul>
		<div class="upArrow"></div>
		<div class="loginForm">
			<div>
				<label>Hello, <?php print($user); ?>!</label>
				<hr />
			</div>
			<div>
				<label><a href="#">back</a></label>
			</div>
			<div>
				<label><a href="uitlog.php">Log Off</a></label>
			</div>

	</div>


	<div id="content">


			<form method="post" action="UserSettings.php">
				<table>
					<tr>
						<th colspan="2">Change user password:</th>
					</tr>
					<tr>
						<td>Change password:</td>
						<td><input type="password" name="newpas" /></td>
					</tr>
					<tr>
						<td>Repeat password:</td>
						<td><input type="password" name="newpasrep" /></td>
					</tr>
					<tr>
						<td><input type="submit" /></td>
						<td>If you change your password you will be logged out.</td>
					</tr>
				</table>
			</form>



	</div>



</div>

<script type="text/javascript">
$(document).ready(function(){
	var form = $(".loginForm");
	var arrow = $(".upArrow");
	var status = false;


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
