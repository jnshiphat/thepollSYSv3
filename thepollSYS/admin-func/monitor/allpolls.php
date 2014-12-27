<?php
session_start();
if (!isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: ../index.php'); //patth to admin index
}

require_once('../../common/db.php');

$sql = "SELECT * FROM poll_list";
$result = mysqli_query($con, $sql);

?>
<html>
	<head>
		<title>Monitor as Admin</title>
	</head>

	<body>
		<center>
			<a href="logout.php">Logout</a>
			<h2>Poll creation and other operations</h2>

<table>														
	<tr>
		<th>Description</th><th>Validity</th><th>Creation Time</th><th>Actions</th>
	</tr>
	<tr>
		<form action="../actions/newpoll.php" method="post">						<!-- for adding Question -->
			<td><input type="text" name="description" placeholder="Write Question(250 words)"></td>
			<td><input type="text" name="validity" placeholder="0(invalid) or 1(valid)"></td>
			<td><center>Auto Taken</center></td>
			<td><input type="submit" name="insert" value="Insert - Poll"></td>
		</form>
	</tr>
	<?php

	while($row = mysqli_fetch_array($result)) 
	  {
	  echo "<tr>";
	  echo "<form action='../actions/edit_deletepoll.php' method='post'>";
	  /*echo "<td><input type='text' name='month' value='" . $row['description'] . "'></td>";//brand - month
	  echo "<td><input type='text' name='year' value='" . $row['creation_time'] . "'></td>";//price - year
      echo "<td><input type='submit' value='Update  Data' name='update'> <a href='#'><input type='submit' value='X' name='delete'></a></td>
      </form>";*/
      echo "<td><a href='singlepoll.php?pid=".$row['pid']."'>" . $row['description'] . "</a><input type='hidden' name='poll_id' value='" . $row['pid'] . "'></td>";//brand - month
	  echo "<td><input type='text' name='validity' value='" . $row['validity'] . "'></td>";
	  echo "<td>" . $row['creation_time'] . "</td>";
      echo "<td><input type='submit' value='Delete Poll' name='delete'></td><td><input type='submit' value='Update' name='update'></td></form>";
	  echo "</tr>";
	  }
	 ?>
</table>
		</center>
	</body>
</html>