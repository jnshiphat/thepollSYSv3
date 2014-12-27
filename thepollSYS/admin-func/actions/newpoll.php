<?php
session_start();
if (!isset($_SESSION['polladmin'])) { // 'polladmin' is the session for polladmin
	header('Location: ../index.php'); //patth to admin index
}

require_once('../../common/db.php');

if (isset($_REQUEST['insert'])) 								// for inserting poll - called from ../monitor/allpolls.php
{
	$description = $_REQUEST['description'];
	$validity	 = $_REQUEST['validity'];

	$sql = "INSERT INTO poll_list VALUES ('', '$description',now(), '$validity')";
	mysqli_query($con, $sql);
	mysqli_close($con);
	header('Location: ../monitor/allpolls.php');

} 
?>