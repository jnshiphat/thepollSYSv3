<?php
session_start();
if (isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: ../monitor/allpolls.php'); //patth to admin index
}elseif (!isset($_REQUEST['adminlgbtn'])) {
	header('Location: ../index.php');
}

require_once('../../common/db.php');

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	
	if(!$row)
	{	
		$_SESSION['ermessage'] = "Worng Username or Password";
		header('Location: ../index.php');		
	}
	else
	{	
		$_SESSION['polladmin'] = $username;
		header('Location: ../monitor/allpolls.php');
	}

?>