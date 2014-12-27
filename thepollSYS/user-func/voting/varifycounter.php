<?php
//request comming from home page
session_start();

require_once('../../common/db.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];


	$sqlA = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
	$resultA = mysqli_query($con, $sqlA);
	$rowA = mysqli_fetch_array($resultA);
	
if(!$rowA)
{	
	$_SESSION['ermessage'] = "Worng Username or Password";
	header('Location: ../../index.php');		
}





$poll_id = $_REQUEST['poll_id']; //taking poll id into variable
$used_for= $_REQUEST['used_for']; //taking yes or no

$in_mess = "Not Confirmed";

$_SESSION['used_for'] = $used_for;

//if ($in_mess!="Not Confirmed") {
	$sql  = "INSERT INTO counter_idn VALUES('','$used_for')";
	mysqli_query($con, $sql);
	$in_mess = "Counter Initiated!";
//}


$sqlC = "SELECT * FROM counter_idn ORDER BY cid DESC";
$resultC = mysqli_query($con, $sqlC);
$rowC = mysqli_fetch_array($resultC);
mysqli_close($con);

if (!$rowC) {
	$_SESSION['ermessage'] = "Something Wrong With Data Insert";
	header('Location: ../index.php');
}else{
	$_SESSION['counter_varified'] = "Counter Varified";
	$_SESSION['counter_id']		  = $rowC['cid'];
	$_SESSION['poll_id']  		  = $poll_id;
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Counter Initiation</title>
</head>
<body>
	<center>
		<h2>
			<?php echo $in_mess;?>
		</h2>
	</center>
</body>
</html>