<?php
session_start();
if (isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: monitor/allpolls.php'); //patth to admin index
}

$ermessage = "";
if (isset($_SESSION['ermessage'])) { // checking error message
	$ermessage = $_SESSION['ermessage'];
}
?>
<html>
	<head>
		<title>Poll Administrator</title>
	</head>
	<body>
		<center>
			<h2>The Posll System - Administrator</h2>
			<form method="post" action="login/login.php">
				<table>
					<tr>
						<td>Login from here:</td>
					</tr>
					<tr>
						<td><?php echo $ermessage; session_destroy(); ?></td>
					</tr>
					<tr>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td><input type="submit" name="adminlgbtn" value="Login"></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>