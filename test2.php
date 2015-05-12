<?php 
include 'sec_access.php';
require 'class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php

        include('library.php');
        style();
        title('Help Desk');
    ?>
    <style type="text/css">
		.border {
			border : 1px solid;
		}
    </style>
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-sm-4 border">
			left
		</div>
		<div class="col-sm-8 border">
			right
		</div>

	</div>

	<div class="row">
  <div class="col-xs-6 col-sm-3 border">.col-xs-6 .col-sm-3 
Resize your viewport or check it out on your phone for an example.</div>
  <div class="col-xs-6 col-sm-3 border">.col-xs-6 .col-sm-3</div>

  <!-- Add the extra clearfix for only the required viewport -->
  <div class="clearfix visible-xs-block"></div>

  <div class="col-xs-6 col-sm-3 border">.col-xs-6 .col-sm-3</div>
  <div class="col-xs-6 col-sm-3 border">.col-xs-6 .col-sm-3</div>
</div>
</div>

</body>
</html>