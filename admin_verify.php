<?php 

include 'sec_access.php';
require 'class.php';


switch ($global_department) {
	case 'Info. & Comm. Tech.':
		$admin_page="ict_admin_page.php";
		break;
	case 'FMD':
		$admin_page="jrf_tbllist.php?cmd=reset";
		break;
	
	default:
		$admin_page="";
		break;
}


switch ($global_authorization) {
	case 'administrator':
		echo "<script type=text/javascript>window.location.href='jrf_tbllist.php?cmd=reset';</script>";
		break;
	case 'approver':
		echo "<script type=text/javascript>window.location.href='jrf_tbllist.php?cmd=reset';</script>";
		break;
	case 'editor':
		echo "<script type=text/javascript>window.location.href='jrf_tbllist.php?cmd=reset';</script>";
		break;
	case 'user':
		echo "<script type=text/javascript>alert('Sorry!, You are Not Authorized to acces this page');window.location.href='welcome.php';</script>";
		break;
	
	default:
		echo "<script type=text/javascript>alert('Sorry!, You are Not Authorized to acces this page');window.location.href='welcome.php';</script>";
		break;
}

	//UPDATE OVER DUE to overdue and no
	$OverDue = new updateOverdue();
	$date_now = date("m/d/Y"); 
	$sql = "UPDATE jrf_tbl SET strifoverdue ='overdue' WHERE strstatus <> 'Finished' AND strstatus <> 'Cancelled' AND  strduedate < '$date_now' ";
	$OverDue->updatefields($sql);

	$sql = "UPDATE jrf_tbl SET strifoverdue ='no' WHERE strduedate > '$date_now' ";
	$OverDue->updatefields($sql);



 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Tracker</title>
</head>

<style type="text/css">
	.centerme {
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    width: 6em
}


</style>

<body>
	<div class="centerme">
		<img src="img\system\ajax-loader.gif">
	</div>
</body>
</html>