<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
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
	}else {
		echo "vul wat in...";
	}
    if ($userName && $userPass )
    {

        $query = "SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = '$userName' AND wachtwoord = '$userPass'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if($row){
            echo "Hallo het is gelukt.";
			}else {
				echo "het is mislukt";
			}
			}
//dit is een test
?>


</body>
</html>
