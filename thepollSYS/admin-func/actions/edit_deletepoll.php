<?php
session_start();
if (!isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: ../index.php'); //patth to admin index
}

require_once('../../common/db.php');

if (isset($_REQUEST['delete'])) 								// for inserting poll - called from ../monitor/allpolls.php
{
	$poll_id = $_REQUEST['poll_id'];


	$sqlU = "DELETE FROM user WHERE pid ='$poll_id'";
	mysqli_query($con, $sqlU);
	$sqlP = "DELETE FROM poll_duration WHERE pid = '$poll_id'";
	mysqli_query($con, $sqlP);
	$sqlC = "DELETE FROM count_in_counter WHERE pid = '$poll_id'";
	mysqli_query($con, $sqlC);
	$sqlL = "DELETE FROM poll_list WHERE pid = '$poll_id'";
	mysqli_query($con, $sqlL);

	header('Location: ../monitor/allpolls.php');

}else if (isset($_REQUEST['update'])) 								// for inserting poll - called from ../monitor/allpolls.php
{
	$poll_id = $_REQUEST['poll_id'];
	$validity= $_REQUEST['validity'];

	$sql = "UPDATE poll_list SET validity ='$validity' WHERE pid ='$poll_id'";
	mysqli_query($con, $sql);

	header('Location: ../monitor/allpolls.php');

}  
?>