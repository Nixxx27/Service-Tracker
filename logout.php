
<?php 
	include 'sec_access.php';
	require 'class.php';

	$action = "Log-Out";
   	$logs = new logs();
   	$logs->addLogs($global_user_fullname,$global_authorization,$action );

	unset($_SESSION['successfull_login']);
	header("location:index.php");
?>
