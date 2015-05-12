<?php
//$con = mysql_connect("localhost","root","nikkoz06");
  //  if (!$con){
   // die("Can not connect: " . mysql_error());
   // }
   // mysql_select_db("sts",$con);


//$hostname="127.0.0.1";
//$username="root";
//$password="nikkoz06";
//$dbname="sts";

//$db = new mysqli ($hostname,$username,$password,$dbname);
//	if($db->connect_errno){
//		//echo $db->connect_error; // friendly error message
//		die('Can\'t Connect to DB');
//	};


$driver ='mysql:host=127.0.0.1;dbname=sts';
$username='root';
$password='nikkoz06';

try {
		$db = new PDO ($driver,$username,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
 		//die('Sorry, Database Problem');
 		$err = $e->getMessage();
 		die("Sorry Database Problem : $err");
 	}

