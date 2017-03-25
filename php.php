
<script type="text/javascript">function errorHandler() {
				alert("Wrong password/username, Please try again.");
}
</script>
	<?php
	session_start();
	//Now grabs passwords from external file so no one can see.
		$lines = file('../configinlog.txt', FILE_IGNORE_NEW_LINES);
		$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
		if (!$conn) {
	    die("Connection failed: " . mysqli_connect_errno());
		};



		$usr = $_POST["username"];
		$pwd = $_POST["password"];

		if (isset($usr) && isset($pwd)) {
			$stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ? AND wachtwoord = ?");
			$stmt->bind_param("ss", $username, $password);
			$username = $usr;
			$password = $pwd;

			$stmt->execute();

			$result = $stmt->get_result();
			$rowNum = $result->num_rows;

			if ($rowNum > 0) {
					$row = $result->fetch_assoc();
					$_SESSION["usrname"] = $row['gebruikersnaam'];
					$adminOrNah = $row['beheerder'];

					if ($adminOrNah == 1) {
						$_SESSION["isAdmin"] = 1;
						$_SESSION["login"] = "true";
						header("Location:https://adressboek.000webhostapp.com/adminpage.php/");
						exit;
					}else if($adminOrNah == 0) {
						$_SESSION["isAdmin"] = 0;
						$_SESSION["login"] = "true";
						header("Location:https://adressboek.000webhostapp.com/Homepage.php/");
						exit;
					}

				}else{
					$_SESSION["error"] = "usrPwdEr";
					header("Location:http://adressboek.000webhostapp.com");
					exit();
				}

			}



 ?>
