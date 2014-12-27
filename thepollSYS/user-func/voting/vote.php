<?php
session_start();
if(!isset($_SESSION['counter_varified'])) // 'votebtn' is the name for voting button
{
	header('Location: ../../index.php'); //path to home page
}

require_once('../../common/db.php');
	//counter id and poll id will be used to populate count_in_counter table
	$vote = $_SESSION['counter_id']; //taking counter id into variable
	$poll_id = $_SESSION['poll_id']; //taking poll id into variable
	//testing if this vote and poll_id already exist
	$sqlT = "SELECT * FROM count_in_counter WHERE pid = '$poll_id' AND cid = '$vote'";
	$resultT = mysqli_query($con, $sqlT);
	$rowT = mysqli_fetch_array($resultT);
	//----
	//echo $poll_id;
	$voteQuestion = "";
	//----
	if(!$rowT)
	{
		$sql  = "INSERT INTO count_in_counter (pid,cid) VALUES('$poll_id','$vote')";
		mysqli_query($con, $sql);	
	}

/*
	$sqlI = "UPDATE count_in_counter SET countvote = countvote + 1 WHERE pid = '$poll_id' AND cid = '$vote'";
	mysqli_query($con, $sqlI);
	mysql_close($con);
*/
		//parsing the question
	$sqlV = "SELECT * FROM poll_list WHERE validity = '1'";
	$resultV = mysqli_query($con, $sqlV);
	$rowV = mysqli_fetch_array($resultV);
	if(!$rowV)
	{
		header('Location: notstarted.php');
	}else{
		$voteQuestion = $rowV['description'];
	}
	mysqli_close($con);
?>
<html>
	<head>
		<title>Access To Poll</title>
	</head>
	<body>
		<center>
			<h2>The Posll System</h2>
			<form method="post" action="voteconfirm.php">
				<table>
					<tr><?php echo $voteQuestion ?></tr>
					<tr>
						<td>National Id</td><td> :</td>
						<td><input type="text" name="nationalid"></td>
						<td><input type="hidden" name="poll_id" value="<?php echo $poll_id; ?>"></td>
						<td><input type="hidden" name="c_id" value="<?php echo $vote; ?>"></td>
						<td><input type="submit" name="submitnid" value="Submit">
						</td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>