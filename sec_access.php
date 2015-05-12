<?php

if (session_id() == '' ) {
    session_start();
    

    if (isset($_SESSION['successfull_login']) && $_SESSION['successfull_login'] == true) {
		$global_user_fullname 	=	trim($_SESSION['servicetracker_fullname']);
		$global_username 		=	trim($_SESSION['servicetracker_username']);
		$global_company			=	trim($_SESSION['servicetracker_company']);
		$global_department		=	trim($_SESSION['servicetracker_department']);
		$global_location		=	trim($_SESSION['servicetracker_location']);
		$global_position		=	trim($_SESSION['servicetracker_position']);
		$global_authorization	=	trim($_SESSION['servicetracker_authorization']);
		$global_role			=	trim($_SESSION['servicetracker_role']);
		$global_emailadd		=	trim($_SESSION['servicetracker_emailadd']);
		$global_costcent		=	trim($_SESSION['servicetracker_costcent']);
		$global_telephone		=	trim($_SESSION['servicetracker_telephone']);
	}else{
  		header("location:pleaselogin.php");
	}
}/* if session start */
    
