<?php
error_reporting(0);
// Directory Path ================================
function directory($path){


	$base="http://www.skygroup.com.ph/slpi/".$path;
	echo $base;
 
}

// Title ================================
function title($mytitle){

    $title="<title>" . "Service Tracker System". " | " .$mytitle . "</title>";
    echo $title;
}


// Style ================================
function style(){

	$stylename = array(
		'bootsrapcss' => '<link href="http://www.skygroup.com.ph/servicetracker/css/bootstrap.min.css" rel="stylesheet">' , 
		'customcss' => '<link href="http://www.skygroup.com.ph/servicetracker/css/custom.css" rel="stylesheet">',
		'fontawesome' => ' <link href="http://www.skygroup.com.ph/servicetracker/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">',
		'icon' => ' <link rel="shortcut icon" href="http://www.skygroup.com.ph/servicetracker/img/icon/skyicon.ico" type="image/x-icon">',

		);


	// Bootstrap Core CSS
    echo $stylename['bootsrapcss'] ;

    // Custom CSS
    echo $stylename['customcss'] ;

    // Font Awesome
    echo $stylename['fontawesome'] ;

    // Icon
    echo $stylename['icon'] ;


 }



function logs($action){
	require 'dbc.php';
    require 'sec_access.php';
    
    $straction = $action;
   	$sql = 
    "INSERT INTO logs 
        (struname,strdate,strauthorization,straction) 
    VALUES 
        (?,NOW(),?,?)" ;
    $stmt=$db->prepare($sql);
    $stmt->bindParam(1,$global_user_fullname, PDO::PARAM_STR);
    $stmt->bindParam(2,$global_authorization, PDO::PARAM_STR);
    $stmt->bindParam(3,$straction, PDO::PARAM_STR);
    $stmt->execute();
}
