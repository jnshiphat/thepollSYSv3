<?php
//session_start();
if(!isset($_REQUEST['submitnid'])) // 'votebtn' is the name for voting button
{
	header('Location: vote.php'); //path to home page
}elseif (!isset($_SESSION['counter_varified'])) {
	header('Location: ../../index.php'); //path to home page
}
	require_once('../../common/db.php');
	//counter id and poll id will be used to populate count_in_counter table
	$c_id = $_REQUEST['c_id']; //taking counter id into variable
	$poll_id = $_REQUEST['poll_id']; //taking poll id into variable
	
	$nationalid = $_REQUEST['nationalid'];

// Here there will be API for getting NID autometically --------------------------------

	$sql = "SELECT nid FROM testing_nid WHERE nid='$nationalid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	echo $row['nid'];
	
	if(!isset($row['nid'])){
		echo "hello wrong";
		header('Location: ../../index.php');
		exit();
	}
// The API space ends -------------------------------------------------------------------

// Adding the voter's data to user table // if it is needed we can STOP voting by giving a message in between if-else
	$sqlU = "SELECT nid, pid FROM user WHERE nid = '$nationalid' AND pid = '$poll_id'";
	$resultU = mysqli_query($con, $sqlU);
	$rowU = mysqli_fetch_array($resultU);
	//echo " "; echo $rowU['nid']; echo " "; echo $rowU['pid'];
	if(!isset($rowU['nid']) || !isset($rowU['pid'])) // start from here
	{
		$sqlIx  = "INSERT INTO user (nid, vote_status, pid) VALUES('$nationalid','1','$poll_id')";
		echo "Hello in not rowU";
		mysqli_query($con, $sqlIx);	
	}else if(isset($rowU['vote_status'])){
		$sqlIx = "UPDATE user SET vote_status = vote_status+1 WHERE nid = $nationalid AND pid = '$poll_id'";
		echo "vote status set - increament 1";
		mysqli_query($con, $sqlIx);
	}/*else{
		$sqlIx = "UPDATE user SET vote_status = vote_status+1 WHERE nid = $nationalid AND pid = '$poll_id'";
		mysqli_query($con, $sqlIx);
	}*/
// --------------------------------------------------------------------------------------
	$sqlI = "UPDATE count_in_counter SET countvote = countvote + 1 WHERE pid = '$poll_id' AND cid = '$c_id'";
	mysqli_query($con, $sqlI);
	
mysqli_close($con);

echo "<center><h2>Thanks For The Vote. Your Vote Has Been Confirmed. You have voted for this poll: "; 
echo $rowU['vote_status']+1;

echo " times</h2></center>";


header("Location: vote.php", TRUE, 1);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirmed</title>
	<meta http-equiv="Refresh" content="5;url=vote.php">
</head>
<body>

</body>
</html>