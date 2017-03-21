
	<?php
	//Now grabs passwords from external file so no one can see.
		$lines = file('configinlog.txt', FILE_IGNORE_NEW_LINES);
		session_start();
		$conn = mysqli_connect("localhost", $lines[0], $lines[1], $lines[2]);
		if (!$conn) {
	    die("Connection failed: " . mysqli_connect_errno());
		};
 ?>
