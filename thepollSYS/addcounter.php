<?php
session_start();
error_reporting(E_ALL);

/*if (isset($_SESSION['counter_varified'])) { // checking error message
	header('Location: user-func/voting/vote.php');
}
echo $_SESSION['counter_varified'];*/
$ermessage = "";

if (isset($_SESSION['ermessage'])) { // checking error message
	$ermessage = $_SESSION['ermessage'];
}
//echo $_SESSION['counter_varified'];
require_once('common/db.php');
/*
	//parsing the question
	$sql = "SELECT * FROM poll_list";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	//parsing the counters
	$sqlC = "SELECT * FROM counter_idn";
	$resultC = mysql_query($sqlC);
	mysql_close($con);
*/
	//parsing the question
	$sql = "SELECT * FROM poll_list WHERE validity = '1'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

?>
<html>
	<head>
		<title>Choose Your Counter</title>
	</head>
	<body>
		<center>
			<h2>This Counter Is Not Yet Initiated!</h2>
			<form method="post" action="user-func/voting/varifycounter.php">
				<table>
					<tr><td>Poll Question: <?php echo $row['description']; ?></td></tr>
					<tr><td><input type="hidden" name="poll_id" value="<?php echo $row['pid']; ?>"></td></tr>
					<tr><td>Hello Poll-Agent, Will You Please Initiate Me For This Poll?</td></tr>
					<tr>
							<td>
								<select name="used_for">
								  <option value="yes">Yes Vote</option>
								  <option value="no">No Vote</option>
								</select>
							</td>
					</tr>
					<tr>
						<td>Admin Username: <input type="text" name="username"></td>
					</tr>
					<tr>
						<td><?php echo $ermessage; session_destroy(); ?></td>
					</tr>
					<tr>
						<td>Admin Password: <input type="password" name="password"></td>
					</tr>
					<tr>
						<td><input type="submit" value="Add Counter" name="votebtn"></td>
					</tr>
				</table>
			</form>
			
		</center>
	</body>
</html>