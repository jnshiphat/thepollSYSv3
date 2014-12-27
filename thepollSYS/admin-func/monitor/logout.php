<?php
	session_start();
	session_destroy();
	require_once('../../common/db.php');
	mysql_close($con);
	header('Location: ../index.php');
?>