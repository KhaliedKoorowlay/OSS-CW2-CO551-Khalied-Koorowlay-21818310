<?php
	//  replace mysqllogin and mysqlpassword with your own
	$conn = mysqli_connect("intweb.bucks.ac.uk", "root", "", "cw2 21818310 oss");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

?>
