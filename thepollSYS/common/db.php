<?php
	// Connection Parameters
	$server = "localhost";
	$username = "root";
	$password = "j01911450873u";
	$database = "pollsysdb";

	//$con = mysql_connect($server, $username, $password);
	$con = mysqli_connect($server, $username, $password, $database);
	if (!isset($con))
	{
		die("Error connecting database");
	}

	//mysql_select_db($database, $con);
?>