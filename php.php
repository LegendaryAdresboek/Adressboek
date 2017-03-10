<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="Homepage.css">
		<script>
			function errorHandler() {
				alert("Wachtwoord en/of gebruikernaam incorrect, probeer het opnieuw.");
				window.location.href="/"
			}
		</script>
	</head>


<body>
	<?php
	//Now grabs passwords from external file so no one can see.
		$lines = file('configinlog.txt', FILE_IGNORE_NEW_LINES);
		session_start();
		$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
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
		$_SESSION["loggedin"] = true;
		// stuur door naar Homepage
		header("Location:http://adressboek.000webhostapp.com/Homepage.php");
		exit;
	}
	else {
		echo "<script> errorHandler(); </script>";
	}



 ?>
</body>
</html>
