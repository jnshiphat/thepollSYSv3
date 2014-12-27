<?php
session_start();
if (!isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: ../index.php'); //patth to admin index
}

require_once('../../common/db.php');

$poll_id 	= $_GET['pid'];	

$sqlT 	= "SELECT SUM(countvote) AS totalvote FROM count_in_counter where pid = '$poll_id'";
$resultT= mysqli_query($con, $sqlT);
$rowT	= mysqli_fetch_array($resultT);

$sqlY	= "SELECT SUM(countvote) AS totalvote FROM count_in_counter where pid = '$poll_id' AND cid=ANY(SELECT cid FROM counter_idn WHERE used_for ='yes')";
$resultY= mysqli_query($con, $sqlY);
$rowY	= mysqli_fetch_array($resultY);

$sqlN	= "SELECT SUM(countvote) AS totalvote FROM count_in_counter where pid = '$poll_id' AND cid=ANY(SELECT cid FROM counter_idn WHERE used_for ='no')";
$resultN= mysqli_query($con, $sqlN);
$rowN	= mysqli_fetch_array($resultN);
?>

<html>
	<head><title>Poll Results</title></head>
	<body>
		<center>
			<table>
				<tr>
					<td>Total Vote Casted</td><td><?php echo $rowT['totalvote']; ?></td>
				</tr>
				<tr>
					<td>Vote For</td><td><?php echo $rowY['totalvote']; ?></td>
				</tr>
				<tr>
					<td>Vote Against</td><td><?php echo $rowN['totalvote']; ?></td>
				</tr>
				<tr><a href='allpolls.php'>Go Back</a></tr>
			</table>
		</center>
	</body>
</html>