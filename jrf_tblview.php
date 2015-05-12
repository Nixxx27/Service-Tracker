<?php 
include 'sec_access.php';
require 'class.php';

switch ($global_authorization) {
    case 'user':
        echo "<script type=text/javascript>alert('Sorry!, You are Not Authorized to acces this page');window.location.href='welcome.php';</script>";
        break;
    default:
        break;
}
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
</head>

<body>
    
    <!-- Container -->
    <div class="container">
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "jrf_tblinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

?>
<?php

// Create page object
$jrf_tbl_view = new cjrf_tbl_view();
$Page =& $jrf_tbl_view;

// Page init
$jrf_tbl_view->Page_Init();

// Page main
$jrf_tbl_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($jrf_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_view = new ew_Page("jrf_tbl_view");

// page properties
jrf_tbl_view.PageID = "view"; // page ID
jrf_tbl_view.FormID = "fjrf_tblview"; // form ID
var EW_PAGE_ID = jrf_tbl_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
jrf_tbl_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>

<div class="row">
    <div class="col-lg-4 col-md-4">
    	<h3><strong><i class="fa fa-file-text"></i> View Details</strong></h3>
    </div>
</div>
    	
<?php include('fmd-nav.php'); ?>

<hr>
<?php if ($jrf_tbl->Export == "") { ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $jrf_tbl_view->ListUrl ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<!--
<img src="img/system/buttons/edit.png" title="Edit Record" onclick="javascript:location.href='<?php echo $jrf_tbl_view->EditUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
-->

<?php } ?>

<?php if ($jrf_tbl->Export == "") { ?>
<?php } ?>

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_view->ShowMessage();
?>

<!--View  jrf_tbl logs -->
    <?php
    require 'dbc.php';
            $jrfID_NUM = $jrf_tbl->ID->ViewValue;
           $_SESSION['set_id']=trim($jrfID_NUM);
            $set_ID=$_SESSION['set_id'];

        $view_record = new Record();
        $view_record->viewRecord($set_ID);
            $ID= $view_record->ID;
            $strjrfnum= $view_record->strjrfnum;
            $strquarter= $view_record->strquarter;
            $strmon= $view_record->strmon;
            $stryear  = $view_record->stryear;
            $strdate= $view_record->strdate;
            $strtime= $view_record->strtime;
            $strusername= $view_record->strusername;
            $strusereadd= $view_record->strusereadd;
            $strcompany= $view_record->strcompany;
            $strdepartment= $view_record->strdepartment;
            $strloc= $view_record->strloc;
            $strposition= $view_record->strposition;
            $strtelephone= $view_record->strtelephone;
            $strcostcent= $view_record->strcostcent;
            $strsubject= $view_record->strsubject;
            $strnature= $view_record->strnature;
            $strdescript= $view_record->strdescript;
            $strarea= $view_record->strarea;
            $strattach= $view_record->strattach;
            $strpriority= $view_record->strpriority;
            $strduedate= $view_record->strduedate;
            $strstatus= $view_record->strstatus;
            $strlastedit= $view_record->strlastedit;
            $strcategory= $view_record->strcategory;
            $sap_num= $view_record->sap_num;
            $strfixed_asset= $view_record->strfixed_asset;
            $strattach2= $view_record->strattach2;
                if($strattach2 ==""){
                    $add_fmd_attachment = "<img src='img/system/buttons/add_attach.png' data-toggle='modal' class='cursorpointer' data-target='#add_attachment' height='20px' width='auto' title='Add attachment'>";
                }else{
                     $add_fmd_attachment ="";
                }
                if($strcategory==""){
                    $strcategory="n/a";
                        $strcategory_img = "<img src='img/system/buttons/na.png' height='20px' width='20px'>";
                    }else{
                         $strcategory_img = "";    
                    }
            $strassigned= $view_record->strassigned;
                if($strassigned==""){
                    $strassigned="not yet assigned";
                        $strassigned_img = "<img src='img/system/buttons/na.png' height='20px' width='20px'>";
                    }else{
                        $strassigned_img = "";
                    }
            $strremarks=  $view_record->strremarks;
            $strdatecomplete= $view_record->strdatecomplete;
                if($strdatecomplete==""){
                    $strdatecomplete_forview=$strstatus;
                }else{
                    $strdatecomplete_forview=$strdatecomplete;  
                };
            $strwithpr =  $view_record->strwithpr;
                if($strwithpr==1){
                    $with_pr_icon = "<img src='img/system/buttons/with_pr.png' height='30px' width='30px' title='Request has PR. click to view' class='cursorpointer' data-toggle='modal' data-target='#view_pr_id'>";
                }else{
                    $with_pr_icon = "";
                }
      
    //priority definition
    
    switch ($strpriority) {
    	case 'P1':
    		$priority_definition ="Emergency";
    		break;
    	case 'P2':
    		$priority_definition ="Urgent 3 Days";
    		break;
    	case 'P3':
    		$priority_definition ="Regular 7 Days";
    		break;
    	case 'P4':
    		$priority_definition ="Scheduled 31 Days";
    		break;
    	case 'P5':
    		$priority_definition ="In Excess of 31 Days";
    		break;
    	
    	default:
    		$priority_definition ="";
    		break;
    }

     //color red if pass due date, green normal
        date_default_timezone_set('Asia/Manila');
		$strdate_now=date("m/d/Y");
	
	//compute diff, over due date
		$datetime1= date_create($strduedate);
		$datetime2 = date_create($strdate_now);
		$interval = date_diff($datetime1, $datetime2);
		$total_overdue_num= $interval->format('%R%a');

if( $strstatus=="Encoded to SAP" || $strstatus=="For Encoding to SAP" || $strstatus=="For VP Approval" ){
    $add_pr_button = "";
    $edit_pr_button = "";
}else{
     $add_pr_button = "<li>
                        <a href='' data-toggle='modal' data-target='#add_pr_id'><img src='img/system/buttons/add_pr.png' width='auto' height='25px'><strong> Add PR</strong></a></li>
                    ";
     $edit_pr_button=   "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#edit_pr_id'>Edit PR</button>";
}


    $command_button = 
            "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            <ul class='nav navbar-nav navbar-right'>

                <li class='dropdown'> <img src='img/system/buttons/mark.png' width='auto' height='40px' class='cursorpointer'>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='' data-toggle='modal' data-target='#mark_finish'><img src='img/system/buttons/finish.png' width='auto' height='25px'><strong> Finish Job</strong></a>
                        </li>
                        
                        <li>
                            <a href='' data-toggle='modal' data-target='#change_tech_prio_remarks_id'><img src='img/system/buttons/edit.png' width='auto' height='25px'><strong> Add Details</strong> </a>
                        </li>  

                        <li>
                            <a href='' data-toggle='modal' data-target='#mark_cancel'><img src='img/system/buttons/cancel.png' width='auto' height='25px'><strong> Cancel Job</strong> </a>
                        </li>
                    </ul>
                </li>

                <li class='dropdown'> <img src='img/system/buttons/wrench.png' width='auto' height='40px' class='cursorpointer'>
                    <ul class='dropdown-menu'>
                         <li>
                            <a href='' data-toggle='modal' data-target='#remarks_id'><img src='img/system/buttons/remarks.png' width='auto' height='25px'><strong> Add Remarks</strong> </a>
                        </li>

                        <li>
                            <a href='' data-toggle='modal' data-target='#for_ogm_approval'><img src='img/system/buttons/forogmapproval.png' width='auto' height='25px'><strong> for OGM Approval</strong> </a>
                        </li>

                        <li>
                            <a href='' data-toggle='modal' data-target='#set_priority'><img src='img/system/buttons/priority.png' width='auto' height='25px'><strong> Change Priority</strong> </a>
                        </li>

                        <li>
                            <a href='' data-toggle='modal' data-target='#change_technician_id'><img src='img/system/buttons/assign_technician.png' width='auto' height='25px'><strong> Assign Technician </strong></a>
                        </li>

                         <li>
                            <a href='' data-toggle='modal' data-target='#add_attachment'><img src='img/system/buttons/attachment.png' width='auto' height='30px'><strong> Add Attachment</strong> </a>
                        </li>

                    </ul>
                </li>
                
                <li class='dropdown'> <img src='img/system/buttons/printwof.png' width='auto' height='40px' class='cursorpointer'>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='#' onclick='document.form_view_new_job_10.submit();'><img src='img/system/buttons/printwof_icon.png' width='auto' height='25px'><strong> Print W.O. Form</strong></a>
                        </li>
                        <li>
                            <a href='<?php echo $jrf_tbl_view->ExportExcelUrl ?>'><img src='img/system/buttons/export_excel.png' width='auto' height='25px'><strong> Export to Excel</strong> </a>
                        </li>                        
                        <li>
                            <a href='<?php echo $jrf_tbl_view->ExportCsvUrl ?>'><img src='img/system/buttons/csv_icon.png' width='auto' height='25px'><strong> Export to CSV</strong> </a>
                        </li>
                    </ul>
                </li>
                
                <li class='dropdown'>  <img src='img/system/buttons/pr.png' width='auto' height='40px' class='cursorpointer' >
                    <ul class='dropdown-menu'>
                        $add_pr_button
                        <li>
                            <a href='' data-toggle='modal' data-target='#view_pr_id'><img src='img/system/buttons/view_pr.png' width='auto' height='25px'><strong> View PR </strong> </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>";

		if($total_overdue_num<=0){
			//$stroverdue_num = "0";
            switch ($strstatus) {
                case 'New':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
                case 'In-Progress':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    $verified_icon =  "<i class='fa fa-cog fa-spin'></i>";
                    break;
                case 'For GM Approval':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
                case 'For VP Approval':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
                case 'For Encoding to SAP':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
                case 'Encoded to SAP':
                    $color = "color:#0c0c0c;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
                default:
                    //$color = "color:#449d44";
                       $color = "color:#449d44;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
                    break;
            };
			$warning_icon = "";
		}else{
			$stroverdue_num =  $interval->format('%a');
				switch ($stroverdue_num) {
					case '1':
						$day_name=" Day";
						break;
					
					default:
                       $day_name=" Days";
						break;
				}

		
			$stroverdue_num ="-" .  $interval->format('%a' .$day_name);
			$color= "color:#d31111";
			$warning_caption = "Over Due";
			$warning_icon = "<img src='img/system/buttons/warning.gif' width=18px height=17px title='This request is Over Due!'>";
			$verified_icon =  "<img src='img/system/buttons/xmark.gif' width=18px height=17px title='Verified Finished!'>";

		};


	if($strdatecomplete==""){
		$str_date_complete =$strdate;
	}else{
	 	$str_date_complete =$strdatecomplete;
	 };
		//for completion date
		//compute diff, date completed - date received
		$date_completed= date_create($str_date_complete);
		$date_received = date_create($strdate);
		$workdiff = date_diff($date_received, $date_completed);
		$total_work_num= $workdiff->format('%R%a');

		if($total_work_num<=0){
			$total_work_num = " ";
		}else{
			$total_work_num =  $workdiff->format('%a');
				switch ($total_work_num) {
					case '1':
						$workday_name=" day";
						break;
					
					default:

						$workday_name=" days";
						break;
				    }//switch

			$total_work_num = "| " . $workdiff->format('%a' .$workday_name);
        }//endif



//if not admin no command button
if($global_authorization !=="administrator"){
    $command_button = "";
    }

?>



<div class="row">
	<div class="col-md-7 col-sm-7">
		<table align="left">
			<tr>
				<td>
					<h3><strong>STATUS: <span style="<?php echo $color ?>" ><?php echo strtoupper($strstatus)?> <?php echo strtoupper($stroverdue_num . " " . $warning_caption)?></span></strong>&nbsp;<?php echo $verified_icon;?> <b><?php echo  $with_pr_icon ?></b></h3>
				</td>
			</tr>
		</table>
	</div>

    <div class="col-md-4 col-sm-4" >
        <?php echo $command_button; ?>
    </div>
</div> <!-- row-->

<div class="row">
	<div class="col-md-6 col-sm-6">
		<fieldset>
            <legend><i class="fa fa-cog fa-spin"></i> JOB DETAILS</legend>
            <table border="0">
            	<tr>
                    <td><label><i class="fa fa-wrench"></i> JRF/SC #:</label></td>
                    <td><p class="textboxleft" style="font-weight:bold;font-size:12px"><?php echo $strjrfnum; ?></p></td>
                </tr> 

                <tr>
                    <td><label><i class="fa fa-info-circle"></i> Subject:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strsubject); ?></p></td>
                </tr> 
                
                <tr>
                    <td><label><i class="fa fa-calendar"></i> Date Received</label></td>
                    <td><p class="textboxleft"><?php echo $strdate . " " . $strtime; ?></p></td>
                </tr>

                 <tr>
                    <td><label><i class="fa fa-info-circle"></i> Due Date:</label></td>
                    <td><p class="textboxleft"><?php echo $strduedate . " " . $strtime . " " . $warning_icon ?></p></td>
                </tr> 


                <tr>
                    <td><label><i class="fa fa-map-marker"></i> Area:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strarea); ?></p></td>
                </tr>

                <tr>
                    <td><label><i class="fa fa-bookmark"></i> Nature of Call:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strnature); ?></p></td>
                </tr>
                
            </table>
        </fieldset>
	</div>

		<div class="col-md-4 col-sm-4">
		<fieldset>
            <legend><i class="fa fa-user"></i> REQUESTED BY:</legend>
            <table border="0">
            	<tr>
                    <td><label><i class="fa fa-male"></i><i class="fa fa-female"></i> Name:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strusername); ?></p></td>
                </tr> 

                <tr>
                    <td><label><i class="fa fa-briefcase"></i> Position:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strposition); ?></p></td>
                </tr> 

                <tr>
                    <td><label><i class="fa fa-folder"></i> Department:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strdepartment); ?></p></td>
                </tr> 
                
                <tr>
                    <td><label><i class="fa fa-location-arrow"></i> Location:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($strloc); ?></p></td>
                </tr>

                <tr>
                    <td><label><i class="fa fa-phone-square"></i> Phone #:</label></td>
                    <td><p class="textboxleft"><?php echo $strtelephone; ?></td>
                </tr>

                <tr>
                    <td><label><i class="fa fa-list-alt"></i> Cost Center #:</label></td>
                    <td><p class="textboxleft"><?php echo $strcostcent; ?> </td>
                </tr>
            </table>
        </fieldset>
	</div>

</div> <!--row-->

<div class="row">
	<div class="col-md-6 col-sm-6">
		<br/>
		<fieldset>
            <legend><i class="fa fa-info-circle"></i> DESCRIPTION:</legend>
            <table border="0">
            	<tr>
                   <td>
                   		<textarea style="border:0px;background-color:#ddd;color:black;" class="form-control" rows="6" readonly cols="150px"><?php echo ucfirst($strdescript); ?></textarea>
                   </td>
                </tr>
            </table>
        </fieldset>
            <table>
                <tr>
                    <td>
                        <label>Attachment (requestor) :</label>
                    </td>
                    <td><a href="http://www.skygroup.com.ph/servicetracker/upload/<?php echo $strattach ?>" target='_blank'><?php echo $strattach ?></a></td>
                </tr>
                <tr>   
                    <td>
                        <label>Attachment (fmd) : <?php echo $add_fmd_attachment; ?> </label>
                    </td>
                    <td><a href="http://www.skygroup.com.ph/servicetracker/upload/<?php echo $strattach2 ?>" target='_blank'><?php echo $strattach2 ?></a></td>
                </tr>
            </table>
        <br>
        <fieldset>
            <legend><i class="fa fa-pencil-square-o"></i> OTHER DETAILS</legend>
            <table border="0">
                <tr>
                    <td width="200px"><label><i class="fa fa-star"></i> PRIORITY:</label>
                        <p class="textboxleft" style="text-align:center"><?php echo strtoupper($strpriority) . " " . strtoupper($priority_definition); ?></p>
                    </td>
                
                    <td width="200px"><label><i class="fa fa-tasks"></i> CATEGORY:</label>
                        <p class="textboxleft" style="text-align:center"><?php echo $strcategory_img . " " .  strtoupper($strcategory);?></p>
                    </td>
                </tr>

                <tr>
                    <td width="200px"><label><i class="fa fa-user"></i> ASSIGNED TO:</label>
                        <p class="textboxleft" style="text-align:center"><?php echo  $strassigned_img . " " .strtoupper($strassigned); ?></p>
                    </td>
                
                    <td width="200px"><label><i class="fa fa-calendar"></i> COMPLETION DATE:</label>
                        <p class="textboxleft" style="text-align:center"><?php echo strtoupper($strdatecomplete_forview); ?> <span title="This request was finished in <?php echo $total_work_num; ?>."><?php echo  $total_work_num;?></span> </p>
                    </td>
                </tr>
            </table>
        </fieldset>
	</div><!--div 6-->

    <div class="col-md-4 col-sm-4">
        <br>
        <fieldset>
            <legend><i class="fa fa-file-o"></i> REMARKS</legend>
            <table border="0">
                <tr>
                    <td>
                        <textarea class="form-control" style="border:0px;background-color:#ddd;color:black;font-size:12px" class="form-control" rows="22" readonly cols="150px"><?php echo ucfirst($strremarks); ?></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

	
</div><!--div row-->



<?php

//=================== SET PRIORITY ==============//
if(isset($_POST['set_priority'])){
    
        $strpriority = $_POST['strpriority'];
        $strpriority =trim($strpriority);

        switch ($strpriority) {
            case 'P1':
               $added_day="1 day";
                break;
            case 'P2':
               $added_day="2 days";
                break;
            case 'P3':
               $added_day="7 days";
                break;
            case 'P4':
               $added_day="31 days";
                break;
            case 'P5':
               $added_day="90 days";
                break;
            
            default:
                # code...
                break;
        }

        $due_date=date_create("$strdate"); //due date plus 7 days, P3 default priority
        date_add($due_date,date_interval_create_from_date_string("$added_day"));
        $strduedate = date_format($due_date,"m/d/Y");

        $sql =
        "
        strpriority =  '$strpriority',
        strduedate = '$strduedate',
        strlastedit = '$global_user_fullname'
       ";

        //success message
        $msg= "Priority Set Successfully!";
    
        //for logs
        $action = "Update priority of JRF # $strjrfnum";

        $obj = new UpdateClass();
        $obj->getUpdateVar($sql, $set_ID,$msg);
        $obj->updateView($global_user_fullname,$global_authorization,$action);

//EMAIL

require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd; /* user e-mail */
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Priority Changed re:". ' ' .$strsubject;
$message= $_POST['address'];

$message=<<<EMAIL

Hello $strusername,

Thank you for contacting the Helpdesk. Your request Priority has been changed to $strpriority

WorkOrder Details:

Request Type : $strnature
Subject : $strsubject 
Location: $strarea
Description: $strdescript                                                             


Your Workorder Status: 
To check the status of your request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$ID
----------------------------------------------------------------------------

or call the Helpdesk and provide your:  JRF#:$strjrfnum


Please keep a copy of this information for your reference.     

Kind regards,
Helpdesk                                                                                                


EMAIL;


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://74.125.23.109:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk';//$strusername; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";

}
}; // END IF SET PRIORITY



//=================== MARK FINISH ==============//
if(isset($_POST['set_finish'])){
    date_default_timezone_set('Asia/Manila');
    $strdate_now=date("m/d/Y");    //date now


        $date_completed= date_create($strdate_now);
        $date_received = date_create($strdate);
        $workdiff = date_diff($date_received, $date_completed);
        $total_work_num= $workdiff->format('%R%a');

        if($total_work_num<=0){
            $total_work_num = "same day";
        }else{
            $total_work_num =  $workdiff->format('%a');
                switch ($total_work_num) {
                    case '1':
                        $workday_name=" day";
                        break;
                    
                    default:

                        $workday_name=" days";
                        break;
                    }//switch

            $total_work_num = $workdiff->format('%a' .$workday_name);
        }//endif


    
    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $strfinish_remarks =trim($_POST['strfinish_remarks']);
    $strfinish_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" ."\r\n" . "--Finished--" ."\r\n" . $strfinish_remarks ."\r\n". "\r\n" . $strremarks;

   
    //success message
    $msg= "Request Successfully mark as Finished!";
    
    //for logs
    $action = "Mark as Finished JRF # $strjrfnum";

    date_default_timezone_set('Asia/Manila');
    $date_time = date("m/d/Y H:i");

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->markFinished($set_ID,$strjrfnum,$strquarter,$strmon,$stryear,$strdate,$strtime,$strusername,$strusereadd,$strcompany,$strdepartment,$strloc,$strposition,$strtelephone,$strcostcent,$strsubject,$strnature,$strdescript,$strarea,$strattach,$strpriority,$strduedate,'Finished',$global_user_fullname,$strcategory,$strassigned,$date_time,$strwithpr,$strfinish_remarks,$sap_num,$total_work_num,$strattach2,$global_user_fullname,$global_authorization,$action);


//EMAIL

require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd; /* user e-mail */
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Your request with Workorder Number:" . "JRF#:" . $strjrfnum . " " . "has been completed";

$message=<<<EMAIL

Hello $strusername,

Thank you for contacting the FMD Helpdesk. Your request has been completed and you will receive no further emails regarding this request.

Workorder Number: JRF# $strjrfnum

WorkOrder Details:

Request Type : $strnature
Subject : $strsubject                                                                     
Location: $strarea
Date Received: $strdate $strtime
Date Completed: $date_time

Job Details: 
$strdescript


We would be very grateful if you could provide Feedback within 24hrs upon the receipt of this email.

The ticket will be closed automatically if no response has been received within 24hrs.


Kind regards,
Helpdesk                                                                                                 


EMAIL;


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; //$strusername; // This is the from name in the email, you can put anything you like here;
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";
}
}; // END IF MARK FINISH




//=================== CANCEL JOB REQUEST ==============//
if(isset($_POST['cancel_job'])){
    //connection
    require 'dbc.php';
    $strdate_now=date("m/d/Y");    //date now

    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $strcancel_remarks =trim($_POST['strcancel_remarks']);
    $strcancel_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" ."\r\n" . "--Cancelled--" ."\r\n" . $strcancel_remarks ."\r\n". "\r\n" . $strremarks;

    //success message
    $msg= "Request has been Cancelled Successfully!";
    
    //for logs
    $action = "Cancel JRF # $strjrfnum";

    date_default_timezone_set('Asia/Manila');
    $date_time = date("m/d/Y H:i");
    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->markFinished($set_ID,$strjrfnum,$strquarter,$strmon,$stryear,$strdate,$strtime,$strusername,$strusereadd,$strcompany,$strdepartment,$strloc,$strposition,$strtelephone,$strcostcent,$strsubject,$strnature,$strdescript,$strarea,$strattach,$strpriority,$strduedate,'Cancelled',$global_user_fullname,$strcategory,$strassigned,$date_time,$strwithpr,$strcancel_remarks,$sap_num,'Cancelled',$strattach2,$global_user_fullname,$global_authorization,$action);


    
//EMAIL

require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd; /* user e-mail */
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Your request with Workorder Number:" . "JRF#:" . $strjrfnum . " " . "has been cancelled";

$message=<<<EMAIL

Hello $strusername,

Thank you for contacting the Helpdesk. Your request has been cancelled and no further action will take place. If you think this is an error please contact us.

WorkOrder Details:

Request Type :$strnature
Subject :  $strsubject                                                                  
Location: $strarea

Reason for cancellation:

$strcancel_remarks

Your Workorder Status: 
To check the status of your request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/archv_finishedview.php?ID=$ID
----------------------------------------------------------------------------

or call the Helpdesk and provide:  JRF#:$strjrfnum


Please keep a copy of this information for your reference.     

Kind regards,
Helpdesk  


EMAIL;


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";
}
}; // END IF MARK CANCEL



//=================== SEND TO OGM ==============//
if(isset($_POST['ogm_approval'])){
    //connection
    //$strdate_now=date("m/d/Y");    //date now

    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $strogmapproval_remarks =trim($_POST['strogmapproval_remarks']);
   
    if(empty($strogmapproval_remarks)){
        $strogmapproval_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . "Added PR" ."\r\n". "\r\n" . $strremarks;
    }else{
        $strogmapproval_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $strogmapproval_remarks ."\r\n". "\r\n" . $strremarks;
    };

    $sql =
        "
        strremarks =  '$strogmapproval_remarks',
        strstatus = 'For GM Approval',
        strlastedit = '$global_user_fullname'
       ";

    //success message
    $msg= "Request Successfully Sent to OGM for Approval!";
    
    //for logs
    $action = "Sent JRF # $strjrfnum to OGM for Approval";

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);

//EMAIL

require_once("phpmailer/class.phpmailer.php");

$email="mariza.deluzuriaga@skykitchen.com.ph ";/* OGM e-add */
$cc_email = $strusereadd;
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "A Work Order requires your approval" . " " . "JRF#:" . $strjrfnum;
$message= $_POST['address'];

$message=<<<EMAIL

Hello Miss Mariza de Luzuriaga,

WorkOrder Details:

Request Type :$strnature
Subject :  $strsubject                                                                  
Location: $strarea
---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$ID
----------------------------------------------------------------------------
Requester:      $strusername
----------------------------------------------------------------------------


If you have any questions, do not hesitate to contact your local Helpdesk.

Kind regards,
Helpdesk    


EMAIL;


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = $strusername; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddCC($cc_email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";
}

}; // END IF SENT TO OGM


//=================== ASSIGN 3==============//
if(isset($_POST['assign_3'])){

     $strpriority = $_POST['strpriority'];
        $strpriority =trim($strpriority);

        switch ($strpriority) {
            case 'P1':
               $added_day="1 day";
                break;
            case 'P2':
               $added_day="2 days";
                break;
            case 'P3':
               $added_day="7 days";
                break;
            case 'P4':
               $added_day="31 days";
                break;
            case 'P5':
               $added_day="90 days";
                break;
            
            default:
                # code...
                break;
        }

        $due_date=date_create("$strdate"); //due date plus 7 days, P3 default priority
        date_add($due_date,date_interval_create_from_date_string("$added_day"));
        $strduedate = date_format($due_date,"m/d/Y");

        $strassigned_mode = trim($_POST['strassigned_mode']);
        $strcategory_mode = trim($_POST['strcategory_mode']);

        date_default_timezone_set('Asia/Manila');
        $date_now = date("Y-m-d H:i:s"); 
        $strremarks_3 =trim($_POST['strremarks_3']);

        if(empty($strremarks_3)){
            $strremarks_3 = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . "Added Job Details" ."\r\n". "\r\n" . $strremarks;
        }else{
            $strremarks_3 = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $strremarks_3 ."\r\n". "\r\n" . $strremarks;
        };


    $sql =
        "
        strpriority =  '$strpriority',
        strduedate = '$strduedate',
        strstatus =  'In-Progress', 
        strassigned =  '$strassigned_mode',
        strcategory = '$strcategory_mode',
        strremarks =  '$strremarks_3',
        strlastedit = '$global_user_fullname'
       ";

    //success message
    $msg= "Record successfully updated and email sent to User!";
    
    //for logs
    $action = "JRF # $strjrfnum:Assigned Tech,Category & Priority";

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);
 
 

//EMAIL
require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd; /* user e-mail */
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Call request number " . "JRF#:" . $strjrfnum;

$message=<<<EMAIL

Hello $strusername,

Thank you for contacting the Helpdesk. Your request has been assigned to a member of the FMD Technical Team.

You will receive an update via email as soon as we have looked into your request.

Your Workorder Number: JRF#:$strjrfnum

Your Request Information:
Request Type :$strnature
Subject :  $strsubject   
Description: $strdescript                                                               
Location: $strarea

Assigned to: $strassigned_mode
Section:     $strcategory_mode


Your Workorder Status: 
To check the status of your request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$ID
----------------------------------------------------------------------------

or call the Helpdesk and provide:  JRF#:$strjrfnum


Please keep a copy of this information for your reference.     

Kind regards,
Helpdesk                                                                                                           



EMAIL;

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);

if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";

}
}; // Assign 3 




//=================== TECHNICIAN AND CATEGORY ==============//
if(isset($_POST['assign_tech'])){
    $strassigned_mode = trim($_POST['strassigned_mode']);
    $strcategory_mode = trim($_POST['strcategory_mode']);

    $sql =
        "
        strstatus =  'In-Progress', 
        strassigned =  '$strassigned_mode',
        strcategory = '$strcategory_mode',
        strlastedit = '$global_user_fullname'
       ";

    //success message
    $msg= "Technician & Category Successfully Assigned!";
    
    //for logs
    $action = "Assigned $strassigned_mode to JRF # $strjrfnum";

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);
 
 

//EMAIL
require_once("phpmailer/class.phpmailer.php");

$email=$strusereadd; /* user e-mail */
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Your request with Workorder Number:" . "JRF#:" . $strjrfnum . " " . "has been assigned";

$message=<<<EMAIL

Hello $strusername,

Thank you for contacting the Helpdesk. Your request has been assigned to a member of the FMD Technical Team.

You will receive an update via email as soon as we have looked into your request.

Your Workorder Number: JRF#:$strjrfnum

Your Request Information:
Request Type :$strnature
Subject :  $strsubject   
Description: $strdescript                                                               
Location: $strarea


Your Workorder Status: 
To check the status of your request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$ID
----------------------------------------------------------------------------

or call the Helpdesk and provide:  JRF#:$strjrfnum


Please keep a copy of this information for your reference.     

Kind regards,
Helpdesk                                                                                                         



EMAIL;

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);

if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";

}
}; // TECHNICIAN AND CATEGORY 



//=================== ADD REMARKS ==============//
if(isset($_POST['add_remarks'])){

    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $stradd_remarks =trim($_POST['stradd_remarks']);
    $stradd_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $stradd_remarks ."\r\n". "\r\n" . $strremarks;

    $sql =
        "
        strremarks =  '$stradd_remarks',
        strlastedit = '$global_user_fullname'
       ";

    $msg= "Remarks Successfully Added!";
    
    $action = "Add Remarks to JRF # $strjrfnum";

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);
}; // END ADD REMARKS



//=================== ADD ATTACHMENT ==============//
if(isset($_POST['add_attachment'])){

    $strattach2 = basename($_FILES['uploaded']['name']); 


    
    $sql =
        "
        strattach2 ='$strattach2',
        strlastedit = '$global_user_fullname'
       ";

    $msg= "Attachment successfully uploaded Successfully Added!";
    
    $action = "Add Attachment to JRF # $strjrfnum";

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);


        //upload attachment
    $strattach2 = "upload/";
 
    $strattach2 = $strattach2 . basename( $_FILES['uploaded']['name']); 
       if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $strattach2)) 
            {
        //   echo "The file ".  basename( $_FILES['uploaded']['name']). 
            " has been uploaded";
            } 

         

}; // END ADD ATTACHMENT


?>


<form name="form_view_new_job_1" id="form_view_new_job_1" method="POST" action="" onsubmit="$('#loading_priority').show();$('#linkspin').hide();">   
<!-- Modal -->

<!-- PRIORITY -->
<div class="modal fade" id="set_priority" role="dialog" aria-labelledby="set_priority_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>SET PRIORITY</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <select class="form-control" name="strpriority" >
                    <option <?php echo "value=$strpriority";?>><?php echo strtoupper($strpriority) . " " . strtoupper($priority_definition); ?></option>
                    <option value="P1">P1 (Emergency 1day)</option>
                    <option value="P2">P2 (Urgent 3days)</option>
                    <option value="P3">P3 (Regular 7days)</option>
                    <option value="P4">P4 (Scheduled 31days)</option>
                    <option value="P5">P5 (In excess of 31days)</option>
                </select>
                <br/>

                <small>
                    <strong>* changing priority will notify requestor via email.</strong>
                </small>

                <br/>
                <div id="loading_priority" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
                    
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin"></i>

                    <input type="submit" name="set_priority" value="Set Priority" class="btn btn-default"  onclick="return confirm('Are you sure you want to Change Priority?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
</div>
</div>
</form>


<form name="form_view_new_job_2" id="form_view_new_job_2" method="POST" action="" onsubmit="$('#loading_finish').show();$('#linkspin_finish').hide();">   
<!-- MARK AS FINISH -->
<div class="modal fade" id="mark_finish" role="dialog" aria-labelledby="mark_finish_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>MARK AS FINISH</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                    <tr>
                    <td colspan="4">
                        <label> REMARKS</label>
                        <textarea class="form-control" name="strfinish_remarks" rows="3" cols="150px" placeholder="add remarks..."></textarea>
                    </td>
                </tr>
                </table>
                
                <br/>
                <div id="loading_finish" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>

            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_finish"></i>

                    <input type="submit" name="set_finish" value="Finish Request"  class="btn btn-success"  onclick="return confirm('Are you sure you want to set Finish this Request?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--end finish-->
</form>


<form name="form_view_new_job_3" id="form_view_new_job_3" method="POST" action="" onsubmit="$('#loading_cancel').show();$('#linkspin_cancel').hide();">   
<!-- CANCEL JOB -->
<div class="modal fade" id="mark_cancel" role="dialog" aria-labelledby="mark_cancel_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>CANCEL JOB REQUEST</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                    <tr>
                    <td colspan="4">
                        <label> REMARKS</label>
                        <textarea class="form-control" required name="strcancel_remarks" rows="3" cols="150px" placeholder="*required..."></textarea>
                    </td>
                </tr>
                </table>
                
                <br/>
                <div id="loading_cancel" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>

            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_cancel"></i>

                    <input type="submit" name="cancel_job" value="Cancel Request"  class="btn btn-danger"  onclick="return confirm('Are you sure you want to Cancel Request?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--end cancel-->
</form>


<form name="form_view_new_job_4" id="form_view_new_job_4" method="POST" action="" onsubmit="$('#loading_ogm').show();;$('#linkspin_ogm').hide();">  
<!-- FOR OGM APPROVAL -->
<div class="modal fade" id="for_ogm_approval" role="dialog" aria-labelledby="for_ogm_approval_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>FOR OGM APPROVAL</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                    <tr>
                    <td colspan="4">
                        <label> REMARKS</label>
                        <textarea class="form-control" name="strogmapproval_remarks" rows="3" cols="150px" placeholder="add remarks..."></textarea>
                    </td>
                </tr>
                </table>
                
                <br/>
                <div id="loading_ogm" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
            
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_ogm"></i>
                    <input type="submit" name="ogm_approval" value="Send to OGM..."  class="btn btn-info"  onclick="return confirm('Are you sure you want send request to OGM?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--end cancel-->
</form>


<form name="form_view_new_job_5" id="form_view_new_job_5" method="POST" action="" onsubmit="$('#loading_remarks').show();;$('#linkspin_remarks').hide();">   
<!-- ADD REMARKS-->
<div class="modal fade" id="remarks_id" role="dialog" aria-labelledby="remarks_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>ADD REMARKS</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                <tr>
                    <td colspan="4">
                        <label> REMARKS</label>
                        <textarea class="form-control" required name="stradd_remarks" rows="6" cols="150px" placeholder="*required..."></textarea>
                    </td>
                </tr>
                </table>
                <br/>
                <div id="loading_remarks" style="display:none">
                    <p style="font-style:italic">Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
            </div>  
            <div class="modal-footer">
                <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_remarks"></i>
                <input type="submit" name="add_remarks" value="Add Remarks"  class="btn btn-info"  onclick="return confirm('Add Remarks?')">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--end cancel-->
</form>


<form name="form_view_new_job_6" id="form_view_new_job_6" method="POST" action="" onsubmit="$('#loading_technician').show();$('#linkspin_technician').hide();">   
<!-- Modal -->
<!-- TECHNICIAN AND CATEGORY -->
<div class="modal fade" id="change_technician_id" role="dialog" aria-labelledby="change_technician_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> 
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <label>SELECT TECHNICIAN</label>
                <select name="strassigned_mode"  class="form-control" required="required">
                            <option id="0" value="">Select Technician</option>
                        <?php
                        require("dbc.php");
                            $getalltech=  mysql_query("SELECT strtechname, COUNT(*) as total FROM techician_tbl GROUP BY strtechname ASC");
                            while($viewalltech = mysql_fetch_array($getalltech)){
                            $selecttech="";
                            if($selected_tech==$viewalltech['strtechname'] ){

                            $selecttech="selected='selected'";
                        }

                        ?>
                            <option id="<?php echo $viewalltech['ID']; ?>" <?php echo $selecttech ?> >
                        <?php 
                            echo $viewalltech['strtechname'] ?> </option>
                        <?php } ?>
                </select>

                <br/>
                
                <label>SELECT CATEGORY</label>
                <select name="strcategory_mode"  class="form-control" required="required">
                    <option id="0" value="">Select Job Category</option>
                        <?php
                        require("dbc.php");
                            $getallcategory=  mysql_query("SELECT strcategory, COUNT(*) as total FROM category_tbl GROUP BY strcategory ASC");
                            while($viewallcategory = mysql_fetch_array($getallcategory)){
                            $selectcategory="";
                            if($selected_cat==$viewallcategory['strcategory'] ){

                            $selectcategory="selected='selected'";
                        }

                        ?>
                            <option id="<?php echo $viewallcategory['ID']; ?>" <?php echo $selectcategory ?> >
                        <?php 
                            echo $viewallcategory['strcategory'] ?> </option>
                        <?php } ?>
                </select>

                <br/>
                <div id="loading_technician" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
                    
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_technician"></i>

                    <input type="submit" name="assign_tech" value="Save Changes" class="btn btn-info"  onclick="return confirm('Are you sure you want to save this Changes?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
</div>
</div>
</form>


<form name="form_view_new_job_7" id="form_view_new_job_7" method="POST" action="" onsubmit="$('#loading_tech_priority').show();$('#linkspin_tech_priority').hide();">   
<!-- Modal -->
<!-- SET PRIORITY AND ADD TECHNICIAN  CATEGORY -->
<div class="modal fade" id="change_tech_prio_remarks_id" role="dialog" aria-labelledby="change_tech_prio_remarks_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>ADD DETAILS</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                
                <select class="form-control" name="strpriority">
                    <option <?php echo "value=$strpriority";?>>-- SELECT PRIORITY --</option>
                    <option value="P1">P1 (Emergency 1day)</option>
                    <option value="P2">P2 (Urgent 3days)</option>
                    <option value="P3">P3 (Regular 7days)</option>
                    <option value="P4">P4 (Scheduled 31days)</option>
                    <option value="P5">P5 (In excess of 31days)</option>
                </select><br/>
                    
                <select name="strassigned_mode"  class="form-control" required>
                    <option id="0" value="">--SELECT TECHNICIAN --</option>
                        <?php
                            $sql ="SELECT DISTINCT strtechname from techician_tbl GROUP BY strtechname ASC";
                            $view_record->view_tech($sql);
                        ?>
                </select>
                <br/>
                <select name="strcategory_mode"  class="form-control" required>
                    <option id="0" value="">--SELECT CATEGORY --</option>
                        <?php
                            $sql ="SELECT DISTINCT strcategory from category_tbl GROUP BY strcategory ASC";
                            $view_record->view_categories($sql);
                        ?>
                </select>
                <br/>
                 <label> REMARKS</label>
                        <textarea class="form-control" name="strremarks_3" rows="3" cols="150px" placeholder="add remarks..."></textarea>
                <br/>        
                <label><small>*Note: this action will send email to user. </small></label> 
                        
                <div id="loading_tech_priority" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
                    
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_tech_priority"></i>

                    <input type="submit" name="assign_3" value="Save Changes" class="btn btn-info"  onclick="return confirm('Are you sure you want to save this Changes?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
</div>
</div>
</form>


<!-- Modal -->
<!-- ADD PR -->
<div class="modal fade" id="add_pr_id" role="dialog" aria-labelledby="add_pr_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
                <i class="fa fa-question-circle fa-lg"></i>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                
   <div class="my-form">
        <h3><strong><i class="fa fa-cubes"></i> Add Purchase Request</strong><small> Please fill-up correctly</small></h3>
        <hr>
<?php   
include('dbc.php');

if(isset($_POST['add_pr'])){

    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $pr_remarks =trim($_POST['pr_remarks']);
     
    if(empty($pr_remarks)){
        $pr_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . "Added PR" ."\r\n". "\r\n" . $strremarks;
    }else{
        $pr_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $pr_remarks ."\r\n". "\r\n" . $strremarks;
    };


    $num= 1;
    //update jrf table with PR to yes
  
    $is_fixed_asset = $_POST['fixed_asset'];
   

    $pr = new PR($set_ID);
    $pr->set1PR($num,$set_ID,$status,$is_fixed_asset);

$i = 0; 
$status = "In-Progress";
$charged_to = $_POST['charged_to'];
foreach($_POST['boxes'] as $textbox){
    $strquantity= $textbox;
    $stritmname = $_POST['stritmname'][$i];
    $strunit = $_POST['strunit'][$i];
    $stritmdesc  = $_POST['stritmdesc'][$i];
    $pr->insertPR($strjrfnum,$strquantity,$stritmname,$strunit,$stritmdesc,$pr_remarks,$status,$charged_to);
$i++;
} // for each

    //add to Logs
    $action = "Add PR to JRF # $strjrfnum";
    $logs = new logs();
    $logs->addLogs($global_user_fullname,$global_authorization,$action);

    //succesfull message
    $msg ="PR Successfully Added!";
    $alert_msg = new scriptwrapper();
    echo $alert_msg->JAlert($msg,$set_ID);

}// if isset


if(isset($_POST['edit_pr'])){
   
    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $pr_remarks =trim($_POST['pr_remarks']);
    $pr_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $pr_remarks ."\r\n". "\r\n" . $strremarks;

    //update jrf table with PR to yes
    $pr = new PR($set_ID);
    $update_view = new UpdateClass();
    

    
$i = 0; 
$costcent=$_POST['charged_to'];

foreach($_POST['strquantity'] as $strquantity){
    
    $ID=$_POST['id'][$i];
    $stritmname = $_POST['stritmname'][$i];
    $strunit = $_POST['strunit'][$i];
    $stritmdesc  = $_POST['stritmdesc'][$i];
    $del  = $_POST['delete'][$i];
    $pr->updatePR($strjrfnum,$ID,$strquantity,$stritmname,$strunit,$stritmdesc,$pr_remarks);
    $pr->updatePRCostCenter($costcent,$strjrfnum);
        if(isset($del)){
            $pr->deleteRequest($strjrfnum,$ID);
        }
$i++;
} // for each

$fixed_asset=$_POST['fixed_asset'];
    


    $sql = "UPDATE jrf_tbl SET strfixed_asset='$fixed_asset' WHERE ID='$view_record->ID'";
    $update_view->UpdateViewOnly($sql);
     
    $action = "Updated PR of JRF # $strjrfnum | Charged to $costcent";
        
   
    $logs = new logs();
    $logs->addLogs($global_user_fullname,$global_authorization,$action);

echo  "<script type=text/javascript>alert('PR Succesfully Updated!');window.location.href='jrf_tblview.php?ID=$view_record->ID';</script>";
  }//Endif Isset


if(isset($_POST['send_e_ogm'])){

    $sql =
        "
        strstatus =  'For GM Approval',
        strlastedit = '$global_user_fullname'
       ";

    $msg= "Email Successfully sent to GM!";
    
    $action = "Send JRF # $strjrfnum to GM";
    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);


//EMAIL

require_once("phpmailer/class.phpmailer.php");

$email="mariza.deluzuriaga@skykitchen.com.ph ";/* OGM e-add */
$cc_email = $strusereadd;
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "A Work Order requires your approval" . " " . "JRF#:" . $strjrfnum;
$message=<<<EMAIL

Hello Miss Mariza de Luzuriaga,

The following request needs your approval.

WorkOrder Details:

Request Type :$strnature
Subject :  $strsubject                                                                  
Location: $strarea

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$ID
----------------------------------------------------------------------------
Requester:      $strusername
----------------------------------------------------------------------------


If you have any questions, do not hesitate to contact Helpdesk.

Kind regards,
Helpdesk    


EMAIL;

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk'; // This is the from name in the email, you can put anything you like here
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->AddAddress($email);
$mailer->AddCC($cc_email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


   // $action = "Send JRF # $strjrfnum to GM";
    //$logs = new logs();
     //$logs->addLogs($global_user_fullname,$global_authorization,$action);
   // echo "<script>alert('Successfully sent to GM!');window.location.href='jrf_tblview.php?ID=$ID';</script>";

if(!$mailer->Send()){
   echo "<script>alert('Your Application Sending Failed.');'</script>";
}


}//EndIf Isset

?>
        <form role="form" name="form_view_new_job_8" id="form_view_new_job_8" method="POST" action="">   

            <p class="text-box">
                <label for="box1">Item: <span class="box-number">1</span></label>
                <input type="text" size="5" name="boxes[]" placeholder="Quantity" value="" id="box1" />
                <input type="text" size="5"  name="strunit[]" placeholder="&nbsp;Unit" value="" id="strunit" />
                <input type="text" size="10"  name="stritmname[]" placeholder="&nbsp;Item Name" value="" id="stritmname" />
                <input type="text" size="25"  name="stritmdesc[]" placeholder="&nbsp;Item Description" value="" id="stritmdesc" />
            </p>  

            <p>
                <label> REMARKS</label>
                <textarea class="form-control" name="pr_remarks" rows="2" cols="100px"></textarea>
            </p>
            <p >
                <label for="fixed_asset"> Fixed Asset: </label>
                <select name="fixed_asset" id="fixed_asset">
                    <option value="">No</option>    
                    <option value="yes">Yes</option>
                </select>
            </p>
            <p><label for="charged_to"> Charged to :</label>
                <select name="charged_to" id="charged_to">
                    <option value="FMD - 21">Facilities & Maintenance - 21</option>
                    <option value="Accounting - 11">Accounting & Finance - 11</option>
                    <option value="Purchasing - 12">Purchasing & Warehousing  - 12</option>
                    <option value="ICT - 13">Information Technology - 13</option>
                    <option value="HR - 14">Human Resources - 14</option>
                    <option value="Safety and Security - 15">Safety & Security - 15</option>
                    <option value="OGM - 16">OGM - 16</option>
                    <option value="Production - 17">Production - 17</option>
                    <option value="Field Servicing - 18">Field Servicing - 18</option>
                    <option value="Catering Support - 19">Catering Support - 19</option>
                    <option value="Quality Assurance - 20">Quality Assurance - 20</option>
                    <option value="Canteen - 22">Canteen - 22</option>
                </select>
            </p>
            <p>
                <button type="submit" onclick="return confirm('Are you sure you want to save this PR?')" name="add_pr" class="btn btn-info btn-sm">&nbsp;&nbsp;<i class="fa fa-floppy-o"></i> Save&nbsp;&nbsp;</button>
                <button type="button" class="add-box btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add More</button>
            </p>
            
        </form>
    </div>
           <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left" id="linkspin_add_pr"></i>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
      </div>    
</div>
</div>


<!-- Modal -->
<!-- VIEW PR -->
<div class="modal fade" id="view_pr_id" role="dialog" aria-labelledby="view_pr_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 800px;">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>VIEW PR FOR 
               <?php echo $strjrfnum; 

                if($strfixed_asset=='yes'){
                    echo "<span style='color:red'> FIXED ASSET </span>";
                }

               ?></strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
        <style>
            .viewtable{
                border: 1px solid #f4f4f0;
            }
            .thead{
                background-color:#1f497d;
                color:white;
                border: 1px solid black;
                padding-right:10px;
                padding-left:7px;
                font-size:12px;
            }
            .tbody{
                color:black;
                border: 0px solid black;
                background-color:white;
            }
            .viewtd{
                border: 1px solid #d1d1cf;
                padding-right:2px;
                padding-left:3px;
                font-size:11px;
            }
            .tfoot{
                color:red;
                border: 0px solid black;
            }
        </style>
        <table class="viewtable">
            <thead>
                <tr> 
                    <th class="thead">#</th> 
                    <th class="thead">QTY</th>
                    <th class="thead">UNIT</th>
                    <th class="thead">NAME</th>
                    <th class="thead">DESCRIPTION</th>
                </tr>
            </thead>   
            <tbody class="tbody">
                <?php   
                    $prview = new PR($set_ID);
                    $prview->viewPR($strjrfnum);
                ?>
            </tbody> 
            <tr>
                <td colspan="3">
                  
                   <label> Charged to:  
                        <?php    
                           $viewCostCenter = new viewCostCenter(); 
                            echo $viewCostCenter->chargedTo($strjrfnum); 
                        ?>
                    </label>
                </td>
            </tr>
        </table>    
        </div>  
            <br/>
                <div id="loading_view_pr" style="display:none">
                    <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                </div>
            <div class="modal-footer">
                <form method="POST" action="" onsubmit="$('#loading_view_pr').show();">
                    <i class="fa fa-link fa-spin fa-2x pull-left"></i>
                    <input type="submit" name="send_e_ogm" value="Email to GM" class="btn btn-info"  onclick="return confirm('Are you sure you want to send this to GM?')">
                    <?php echo  $edit_pr_button; ?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </form>
            </div>

        </div>
</div>
</div>


<!-- EDIT PR -->
<div class="modal fade" id="edit_pr_id" role="dialog" aria-labelledby="edit_pr_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>EDIT PR FOR  <?php echo $strjrfnum; 

                if($strfixed_asset=='yes'){
                    echo "<span style='color:red'> FIXED ASSET </span>";
                  //  $fixed_asset_edit_option = 
                }

               ?></strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
        <div class="modal-body">
    <form role="form" name="form_view_new_job_9" id="form_view_new_job_9" method="POST" action="" onsubmit="$('#loading_edit_pr').show();$('#linkspin_edit_pr').hide();">   
        <table class="viewtable">
            <thead>
                <tr> 
                    <th class="thead">#</th> 
                    <th class="thead">QTY</th>
                    <th class="thead">UNIT</th>
                    <th class="thead">NAME</th>
                    <th class="thead">DESCRIPTION</th>
                    <th class="thead"><img src="img/system/buttons/cancel.png" height="20px" width="25px" title="check to delete record"></th>
                </tr>
            </thead>   
            <tbody class="tbody">
                <?php   
                    $prview = new PR($set_ID);
                    $prview->editPR($strjrfnum);
                ?>
            </tbody> 
            <tr>
                <td colspan="5">    
                    <p >
                <label for="fixed_asset"> Fixed Asset: </label>
                <select name="fixed_asset" id="fixed_asset">
                    <option><?php echo $strfixed_asset; ?></option>
                    <option value="">No</option>    
                    <option value="yes">Yes</option>
                </select>
            </p>
            <p><label for="charged_to"> Charged to :</label>
                <?php    
                    $viewCostCenter = new viewCostCenter(); 
                ?>

                <select name="charged_to" id="charged_to">
                    <option><?php $viewCostCenter->chargedTo($strjrfnum); ?></option>
                    <option value="FMD - 21">Facilities & Maintenance - 21</option>
                    <option value="Accounting - 11">Accounting & Finance - 11</option>
                    <option value="Purchasing - 12">Purchasing & Warehousing  - 12</option>
                    <option value="ICT - 13">Information Technology - 13</option>
                    <option value="HR - 14">Human Resources - 14</option>
                    <option value="Safety and Security - 15">Safety & Security - 15</option>
                    <option value="OGM - 16">OGM - 16</option>
                    <option value="Production - 17">Production - 17</option>
                    <option value="Field Servicing - 18">Field Servicing - 18</option>
                    <option value="Catering Support - 19">Catering Support - 19</option>
                    <option value="Quality Assurance - 20">Quality Assurance - 20</option>
                    <option value="Canteen - 22">Canteen - 22</option>
               </select>

            </p>
                <td>
            </tr>


            <tfoot>
               <tr>
                    <td colspan="6">
                         <input type="submit" name="edit_pr" value="Save Changes" class="btn btn-primary"  onclick="return confirm('Are you sure you want to save this Changes?')">
                         <input type="submit" name="send_e_ogm" value="Email to GM" class="btn btn-info"  onclick="return confirm('Are you sure you want to send this to GM?')">
                   </td>
                   
                </tr>
            </tfoot>
        </table> 
    </form>  
        </div>  
            <div class="modal-footer">
                <i class="fa fa-link fa-spin fa-2x pull-left"></i>
                   <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
</div>
</div><!-- edit pr-->


<form name="form_add_attachment" id="fmd-form_add_attachment-form" method="POST" action="" enctype="multipart/form-data">
 
<!-- -ADD ATTACHMENT FMD -->
<div class="modal fade" id="add_attachment" role="dialog" aria-labelledby="add_attachment_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>ADD ATTACHMENT</strong></label>
            </div>
            <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
        </div>
            <div class="modal-body">
                <table>
                    <tr>
                    <td>
                        <input name="uploaded" type="file"/>
                    </td>
                </tr>
                </table>
            </div>  
            <div class="modal-footer">
                    <i class="fa fa-link fa-spin fa-2x pull-left"></i>

                    <input type="submit" name="add_attachment" value="Add Attachment"  class="btn btn-success"  onclick="return confirm('Are you sure you want to add this attachment?')">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div><!--ADD ATTACHMENT FMD-->
</form>


<!-- PRINT WO FORM -->
<form role="form" name="form_view_new_job_10" id="form_view_new_job_10" method="GET" action="jrform.php"> 
    <input type="hidden" name="ID" value="<?php echo $set_ID; ?>">  
</form>  





<?php if ($jrf_tbl->Export == "") { ?>
<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    
    <script>
        // TITLE HOVER 
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'top'
        });

        $('[data-toggle="bottom"]').popover({
            trigger: 'hover',
                'placement': 'bottom'
        });

       
    </script>




<script>
    $(document).ready(function(){
        $("#view_loader").hide();
        
        $("#hide").click(function(){
            $("#view_loader").hide();
        });

        $("#show").click(function(){
            $("#view_loader").show();
        });
    });



    $(document).ready(function(){
        $("#view_loader_finish").hide();
    

        $("#show_finish").click(function(){
            $("#view_loader_finish").show();
        });
    });
</script>



<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        if( 20 < n ) {
            alert('You\'ve reached the Limit!');
            return false;
        }
        var box_html = $('<p class="text-box"><label for="box' + n + '">Item:   <span class="box-number">' + n + '</span></label> <input type="text" placeholder="Quantity" size="5" name="boxes[]" value="" id="box' + n + '" /> <input type="text" placeholder="Unit" name="strunit[]" size="5"  value="" id="strunit' + n + '" /> <input type="text" placeholder="Item Name" name="stritmname[]" size="10"  value="" id="stritmname' + n + '" /> <input type="text" placeholder="Item Description" name="stritmdesc[]" size="25"  value="" id="stritmdesc' + n + '" />&nbsp;<button type="button" class="remove-box  btn btn-danger"><i class="fa fa-times"></i></button></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>

  


<?php } ?>
<?php include "footer.php" ?>
<?php
$jrf_tbl_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $jrf_tbl;
		if ($jrf_tbl->UseTokenInUrl) $PageUrl .= "t=" . $jrf_tbl->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $jrf_tbl;
		if ($jrf_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($jrf_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($jrf_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjrf_tbl_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'jrf_tbl', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $jrf_tbl;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$jrf_tbl->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$jrf_tbl->Export = $_POST["exporttype"];
		} else {
			$jrf_tbl->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $jrf_tbl->Export; // Get export parameter, used in header
		$gsExportFile = $jrf_tbl->TableVar; // Get export file, used in header
		if (@$_GET["ID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["ID"]);
		}
		if ($jrf_tbl->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($jrf_tbl->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $jrf_tbl;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ID"] <> "") {
				$jrf_tbl->ID->setQueryStringValue($_GET["ID"]);
				$this->arRecKey["ID"] = $jrf_tbl->ID->QueryStringValue;
			} else {
				$sReturnUrl = "jrf_tbllist.php"; // Return to list
			}

			// Get action
			$jrf_tbl->CurrentAction = "I"; // Display form
			switch ($jrf_tbl->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "jrf_tbllist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($jrf_tbl->Export, array("html","word","excel","xml","csv","email"))) {
				if ($jrf_tbl->Export == "email" && $jrf_tbl->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$jrf_tbl->setExportReturnUrl($jrf_tbl->ViewUrl()); // Add key
				$this->ExportData();
				if ($jrf_tbl->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "jrf_tbllist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$jrf_tbl->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $jrf_tbl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$jrf_tbl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$jrf_tbl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $jrf_tbl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $jrf_tbl;

		// Call Recordset Selecting event
		$jrf_tbl->Recordset_Selecting($jrf_tbl->CurrentFilter);

		// Load List page SQL
		$sSql = $jrf_tbl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$jrf_tbl->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $jrf_tbl;
		$sFilter = $jrf_tbl->KeyFilter();

		// Call Row Selecting event
		$jrf_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$jrf_tbl->CurrentFilter = $sFilter;
		$sSql = $jrf_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$jrf_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $jrf_tbl;
		$jrf_tbl->ID->setDbValue($rs->fields('ID'));
		$jrf_tbl->strjrfnum->setDbValue($rs->fields('strjrfnum'));
		$jrf_tbl->strquarter->setDbValue($rs->fields('strquarter'));
		$jrf_tbl->strmon->setDbValue($rs->fields('strmon'));
		$jrf_tbl->stryear->setDbValue($rs->fields('stryear'));
		$jrf_tbl->strdate->setDbValue($rs->fields('strdate'));
		$jrf_tbl->strtime->setDbValue($rs->fields('strtime'));
		$jrf_tbl->strduedate->setDbValue($rs->fields('strduedate'));
		$jrf_tbl->strsubject->setDbValue($rs->fields('strsubject'));
		$jrf_tbl->strusername->setDbValue($rs->fields('strusername'));
		$jrf_tbl->strusereadd->setDbValue($rs->fields('strusereadd'));
		$jrf_tbl->strcompany->setDbValue($rs->fields('strcompany'));
		$jrf_tbl->strdepartment->setDbValue($rs->fields('strdepartment'));
		$jrf_tbl->strloc->setDbValue($rs->fields('strloc'));
		$jrf_tbl->strposition->setDbValue($rs->fields('strposition'));
		$jrf_tbl->strtelephone->setDbValue($rs->fields('strtelephone'));
		$jrf_tbl->strcostcent->setDbValue($rs->fields('strcostcent'));
		$jrf_tbl->strnature->setDbValue($rs->fields('strnature'));
		$jrf_tbl->strdescript->setDbValue($rs->fields('strdescript'));
		$jrf_tbl->strattach->setDbValue($rs->fields('strattach'));
		$jrf_tbl->strarea->setDbValue($rs->fields('strarea'));
		$jrf_tbl->strpriority->setDbValue($rs->fields('strpriority'));
		$jrf_tbl->strstatus->setDbValue($rs->fields('strstatus'));
		$jrf_tbl->strlastedit->setDbValue($rs->fields('strlastedit'));
		$jrf_tbl->strcategory->setDbValue($rs->fields('strcategory'));
		$jrf_tbl->strassigned->setDbValue($rs->fields('strassigned'));
		$jrf_tbl->strremarks->setDbValue($rs->fields('strremarks'));
		$jrf_tbl->strdatecomplete->setDbValue($rs->fields('strdatecomplete'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $jrf_tbl;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->AddUrl = $jrf_tbl->AddUrl();
		$this->EditUrl = $jrf_tbl->EditUrl();
		$this->CopyUrl = $jrf_tbl->CopyUrl();
		$this->DeleteUrl = $jrf_tbl->DeleteUrl();
		$this->ListUrl = $jrf_tbl->ListUrl();

		// Call Row_Rendering event
		$jrf_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$jrf_tbl->ID->CellCssStyle = ""; $jrf_tbl->ID->CellCssClass = "";
		$jrf_tbl->ID->CellAttrs = array(); $jrf_tbl->ID->ViewAttrs = array(); $jrf_tbl->ID->EditAttrs = array();

		// strjrfnum
		$jrf_tbl->strjrfnum->CellCssStyle = ""; $jrf_tbl->strjrfnum->CellCssClass = "";
		$jrf_tbl->strjrfnum->CellAttrs = array(); $jrf_tbl->strjrfnum->ViewAttrs = array(); $jrf_tbl->strjrfnum->EditAttrs = array();

		// strquarter
		$jrf_tbl->strquarter->CellCssStyle = ""; $jrf_tbl->strquarter->CellCssClass = "";
		$jrf_tbl->strquarter->CellAttrs = array(); $jrf_tbl->strquarter->ViewAttrs = array(); $jrf_tbl->strquarter->EditAttrs = array();

		// strmon
		$jrf_tbl->strmon->CellCssStyle = ""; $jrf_tbl->strmon->CellCssClass = "";
		$jrf_tbl->strmon->CellAttrs = array(); $jrf_tbl->strmon->ViewAttrs = array(); $jrf_tbl->strmon->EditAttrs = array();

		// stryear
		$jrf_tbl->stryear->CellCssStyle = ""; $jrf_tbl->stryear->CellCssClass = "";
		$jrf_tbl->stryear->CellAttrs = array(); $jrf_tbl->stryear->ViewAttrs = array(); $jrf_tbl->stryear->EditAttrs = array();

		// strdate
		$jrf_tbl->strdate->CellCssStyle = ""; $jrf_tbl->strdate->CellCssClass = "";
		$jrf_tbl->strdate->CellAttrs = array(); $jrf_tbl->strdate->ViewAttrs = array(); $jrf_tbl->strdate->EditAttrs = array();

		// strtime
		$jrf_tbl->strtime->CellCssStyle = ""; $jrf_tbl->strtime->CellCssClass = "";
		$jrf_tbl->strtime->CellAttrs = array(); $jrf_tbl->strtime->ViewAttrs = array(); $jrf_tbl->strtime->EditAttrs = array();

		// strduedate
		$jrf_tbl->strduedate->CellCssStyle = ""; $jrf_tbl->strduedate->CellCssClass = "";
		$jrf_tbl->strduedate->CellAttrs = array(); $jrf_tbl->strduedate->ViewAttrs = array(); $jrf_tbl->strduedate->EditAttrs = array();

		// strsubject
		$jrf_tbl->strsubject->CellCssStyle = ""; $jrf_tbl->strsubject->CellCssClass = "";
		$jrf_tbl->strsubject->CellAttrs = array(); $jrf_tbl->strsubject->ViewAttrs = array(); $jrf_tbl->strsubject->EditAttrs = array();

		// strusername
		$jrf_tbl->strusername->CellCssStyle = ""; $jrf_tbl->strusername->CellCssClass = "";
		$jrf_tbl->strusername->CellAttrs = array(); $jrf_tbl->strusername->ViewAttrs = array(); $jrf_tbl->strusername->EditAttrs = array();

		// strusereadd
		$jrf_tbl->strusereadd->CellCssStyle = ""; $jrf_tbl->strusereadd->CellCssClass = "";
		$jrf_tbl->strusereadd->CellAttrs = array(); $jrf_tbl->strusereadd->ViewAttrs = array(); $jrf_tbl->strusereadd->EditAttrs = array();

		// strcompany
		$jrf_tbl->strcompany->CellCssStyle = ""; $jrf_tbl->strcompany->CellCssClass = "";
		$jrf_tbl->strcompany->CellAttrs = array(); $jrf_tbl->strcompany->ViewAttrs = array(); $jrf_tbl->strcompany->EditAttrs = array();

		// strdepartment
		$jrf_tbl->strdepartment->CellCssStyle = ""; $jrf_tbl->strdepartment->CellCssClass = "";
		$jrf_tbl->strdepartment->CellAttrs = array(); $jrf_tbl->strdepartment->ViewAttrs = array(); $jrf_tbl->strdepartment->EditAttrs = array();

		// strloc
		$jrf_tbl->strloc->CellCssStyle = ""; $jrf_tbl->strloc->CellCssClass = "";
		$jrf_tbl->strloc->CellAttrs = array(); $jrf_tbl->strloc->ViewAttrs = array(); $jrf_tbl->strloc->EditAttrs = array();

		// strposition
		$jrf_tbl->strposition->CellCssStyle = ""; $jrf_tbl->strposition->CellCssClass = "";
		$jrf_tbl->strposition->CellAttrs = array(); $jrf_tbl->strposition->ViewAttrs = array(); $jrf_tbl->strposition->EditAttrs = array();

		// strtelephone
		$jrf_tbl->strtelephone->CellCssStyle = ""; $jrf_tbl->strtelephone->CellCssClass = "";
		$jrf_tbl->strtelephone->CellAttrs = array(); $jrf_tbl->strtelephone->ViewAttrs = array(); $jrf_tbl->strtelephone->EditAttrs = array();

		// strcostcent
		$jrf_tbl->strcostcent->CellCssStyle = ""; $jrf_tbl->strcostcent->CellCssClass = "";
		$jrf_tbl->strcostcent->CellAttrs = array(); $jrf_tbl->strcostcent->ViewAttrs = array(); $jrf_tbl->strcostcent->EditAttrs = array();

		// strnature
		$jrf_tbl->strnature->CellCssStyle = ""; $jrf_tbl->strnature->CellCssClass = "";
		$jrf_tbl->strnature->CellAttrs = array(); $jrf_tbl->strnature->ViewAttrs = array(); $jrf_tbl->strnature->EditAttrs = array();

		// strdescript
		$jrf_tbl->strdescript->CellCssStyle = ""; $jrf_tbl->strdescript->CellCssClass = "";
		$jrf_tbl->strdescript->CellAttrs = array(); $jrf_tbl->strdescript->ViewAttrs = array(); $jrf_tbl->strdescript->EditAttrs = array();

		// strattach
		$jrf_tbl->strattach->CellCssStyle = ""; $jrf_tbl->strattach->CellCssClass = "";
		$jrf_tbl->strattach->CellAttrs = array(); $jrf_tbl->strattach->ViewAttrs = array(); $jrf_tbl->strattach->EditAttrs = array();

		// strarea
		$jrf_tbl->strarea->CellCssStyle = ""; $jrf_tbl->strarea->CellCssClass = "";
		$jrf_tbl->strarea->CellAttrs = array(); $jrf_tbl->strarea->ViewAttrs = array(); $jrf_tbl->strarea->EditAttrs = array();

		// strpriority
		$jrf_tbl->strpriority->CellCssStyle = ""; $jrf_tbl->strpriority->CellCssClass = "";
		$jrf_tbl->strpriority->CellAttrs = array(); $jrf_tbl->strpriority->ViewAttrs = array(); $jrf_tbl->strpriority->EditAttrs = array();

		// strstatus
		$jrf_tbl->strstatus->CellCssStyle = ""; $jrf_tbl->strstatus->CellCssClass = "";
		$jrf_tbl->strstatus->CellAttrs = array(); $jrf_tbl->strstatus->ViewAttrs = array(); $jrf_tbl->strstatus->EditAttrs = array();

		// strlastedit
		$jrf_tbl->strlastedit->CellCssStyle = ""; $jrf_tbl->strlastedit->CellCssClass = "";
		$jrf_tbl->strlastedit->CellAttrs = array(); $jrf_tbl->strlastedit->ViewAttrs = array(); $jrf_tbl->strlastedit->EditAttrs = array();

		// strcategory
		$jrf_tbl->strcategory->CellCssStyle = ""; $jrf_tbl->strcategory->CellCssClass = "";
		$jrf_tbl->strcategory->CellAttrs = array(); $jrf_tbl->strcategory->ViewAttrs = array(); $jrf_tbl->strcategory->EditAttrs = array();

		// strassigned
		$jrf_tbl->strassigned->CellCssStyle = ""; $jrf_tbl->strassigned->CellCssClass = "";
		$jrf_tbl->strassigned->CellAttrs = array(); $jrf_tbl->strassigned->ViewAttrs = array(); $jrf_tbl->strassigned->EditAttrs = array();

		// strremarks
		$jrf_tbl->strremarks->CellCssStyle = ""; $jrf_tbl->strremarks->CellCssClass = "";
		$jrf_tbl->strremarks->CellAttrs = array(); $jrf_tbl->strremarks->ViewAttrs = array(); $jrf_tbl->strremarks->EditAttrs = array();

		// strdatecomplete
		$jrf_tbl->strdatecomplete->CellCssStyle = ""; $jrf_tbl->strdatecomplete->CellCssClass = "";
		$jrf_tbl->strdatecomplete->CellAttrs = array(); $jrf_tbl->strdatecomplete->ViewAttrs = array(); $jrf_tbl->strdatecomplete->EditAttrs = array();
		if ($jrf_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$jrf_tbl->ID->ViewValue = $jrf_tbl->ID->CurrentValue;
			$jrf_tbl->ID->CssStyle = "";
			$jrf_tbl->ID->CssClass = "";
			$jrf_tbl->ID->ViewCustomAttributes = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->ViewValue = $jrf_tbl->strjrfnum->CurrentValue;
			$jrf_tbl->strjrfnum->CssStyle = "";
			$jrf_tbl->strjrfnum->CssClass = "";
			$jrf_tbl->strjrfnum->ViewCustomAttributes = "";

			// strquarter
			$jrf_tbl->strquarter->ViewValue = $jrf_tbl->strquarter->CurrentValue;
			$jrf_tbl->strquarter->CssStyle = "";
			$jrf_tbl->strquarter->CssClass = "";
			$jrf_tbl->strquarter->ViewCustomAttributes = "";

			// strmon
			$jrf_tbl->strmon->ViewValue = $jrf_tbl->strmon->CurrentValue;
			$jrf_tbl->strmon->CssStyle = "";
			$jrf_tbl->strmon->CssClass = "";
			$jrf_tbl->strmon->ViewCustomAttributes = "";

			// stryear
			$jrf_tbl->stryear->ViewValue = $jrf_tbl->stryear->CurrentValue;
			$jrf_tbl->stryear->CssStyle = "";
			$jrf_tbl->stryear->CssClass = "";
			$jrf_tbl->stryear->ViewCustomAttributes = "";

			// strdate
			$jrf_tbl->strdate->ViewValue = $jrf_tbl->strdate->CurrentValue;
			$jrf_tbl->strdate->CssStyle = "";
			$jrf_tbl->strdate->CssClass = "";
			$jrf_tbl->strdate->ViewCustomAttributes = "";

			// strtime
			$jrf_tbl->strtime->ViewValue = $jrf_tbl->strtime->CurrentValue;
			$jrf_tbl->strtime->CssStyle = "";
			$jrf_tbl->strtime->CssClass = "";
			$jrf_tbl->strtime->ViewCustomAttributes = "";

			// strduedate
			$jrf_tbl->strduedate->ViewValue = $jrf_tbl->strduedate->CurrentValue;
			$jrf_tbl->strduedate->CssStyle = "";
			$jrf_tbl->strduedate->CssClass = "";
			$jrf_tbl->strduedate->ViewCustomAttributes = "";

			// strsubject
			$jrf_tbl->strsubject->ViewValue = $jrf_tbl->strsubject->CurrentValue;
			$jrf_tbl->strsubject->CssStyle = "";
			$jrf_tbl->strsubject->CssClass = "";
			$jrf_tbl->strsubject->ViewCustomAttributes = "";

			// strusername
			$jrf_tbl->strusername->ViewValue = $jrf_tbl->strusername->CurrentValue;
			$jrf_tbl->strusername->CssStyle = "";
			$jrf_tbl->strusername->CssClass = "";
			$jrf_tbl->strusername->ViewCustomAttributes = "";

			// strusereadd
			$jrf_tbl->strusereadd->ViewValue = $jrf_tbl->strusereadd->CurrentValue;
			$jrf_tbl->strusereadd->CssStyle = "";
			$jrf_tbl->strusereadd->CssClass = "";
			$jrf_tbl->strusereadd->ViewCustomAttributes = "";

			// strcompany
			$jrf_tbl->strcompany->ViewValue = $jrf_tbl->strcompany->CurrentValue;
			$jrf_tbl->strcompany->CssStyle = "";
			$jrf_tbl->strcompany->CssClass = "";
			$jrf_tbl->strcompany->ViewCustomAttributes = "";

			// strdepartment
			$jrf_tbl->strdepartment->ViewValue = $jrf_tbl->strdepartment->CurrentValue;
			$jrf_tbl->strdepartment->CssStyle = "";
			$jrf_tbl->strdepartment->CssClass = "";
			$jrf_tbl->strdepartment->ViewCustomAttributes = "";

			// strloc
			$jrf_tbl->strloc->ViewValue = $jrf_tbl->strloc->CurrentValue;
			$jrf_tbl->strloc->CssStyle = "";
			$jrf_tbl->strloc->CssClass = "";
			$jrf_tbl->strloc->ViewCustomAttributes = "";

			// strposition
			$jrf_tbl->strposition->ViewValue = $jrf_tbl->strposition->CurrentValue;
			$jrf_tbl->strposition->CssStyle = "";
			$jrf_tbl->strposition->CssClass = "";
			$jrf_tbl->strposition->ViewCustomAttributes = "";

			// strtelephone
			$jrf_tbl->strtelephone->ViewValue = $jrf_tbl->strtelephone->CurrentValue;
			$jrf_tbl->strtelephone->CssStyle = "";
			$jrf_tbl->strtelephone->CssClass = "";
			$jrf_tbl->strtelephone->ViewCustomAttributes = "";

			// strcostcent
			$jrf_tbl->strcostcent->ViewValue = $jrf_tbl->strcostcent->CurrentValue;
			$jrf_tbl->strcostcent->CssStyle = "";
			$jrf_tbl->strcostcent->CssClass = "";
			$jrf_tbl->strcostcent->ViewCustomAttributes = "";

			// strnature
			$jrf_tbl->strnature->ViewValue = $jrf_tbl->strnature->CurrentValue;
			$jrf_tbl->strnature->CssStyle = "";
			$jrf_tbl->strnature->CssClass = "";
			$jrf_tbl->strnature->ViewCustomAttributes = "";

			// strdescript
			$jrf_tbl->strdescript->ViewValue = $jrf_tbl->strdescript->CurrentValue;
			$jrf_tbl->strdescript->CssStyle = "";
			$jrf_tbl->strdescript->CssClass = "";
			$jrf_tbl->strdescript->ViewCustomAttributes = "";

			// strattach
			$jrf_tbl->strattach->ViewValue = $jrf_tbl->strattach->CurrentValue;
			$jrf_tbl->strattach->CssStyle = "";
			$jrf_tbl->strattach->CssClass = "";
			$jrf_tbl->strattach->ViewCustomAttributes = "";

			// strarea
			$jrf_tbl->strarea->ViewValue = $jrf_tbl->strarea->CurrentValue;
			$jrf_tbl->strarea->CssStyle = "";
			$jrf_tbl->strarea->CssClass = "";
			$jrf_tbl->strarea->ViewCustomAttributes = "";

			// strpriority
			$jrf_tbl->strpriority->ViewValue = $jrf_tbl->strpriority->CurrentValue;
			$jrf_tbl->strpriority->CssStyle = "";
			$jrf_tbl->strpriority->CssClass = "";
			$jrf_tbl->strpriority->ViewCustomAttributes = "";

			// strstatus
			$jrf_tbl->strstatus->ViewValue = $jrf_tbl->strstatus->CurrentValue;
			$jrf_tbl->strstatus->CssStyle = "";
			$jrf_tbl->strstatus->CssClass = "";
			$jrf_tbl->strstatus->ViewCustomAttributes = "";

			// strlastedit
			$jrf_tbl->strlastedit->ViewValue = $jrf_tbl->strlastedit->CurrentValue;
			$jrf_tbl->strlastedit->CssStyle = "";
			$jrf_tbl->strlastedit->CssClass = "";
			$jrf_tbl->strlastedit->ViewCustomAttributes = "";

			// strcategory
			$jrf_tbl->strcategory->ViewValue = $jrf_tbl->strcategory->CurrentValue;
			$jrf_tbl->strcategory->CssStyle = "";
			$jrf_tbl->strcategory->CssClass = "";
			$jrf_tbl->strcategory->ViewCustomAttributes = "";

			// strassigned
			$jrf_tbl->strassigned->ViewValue = $jrf_tbl->strassigned->CurrentValue;
			$jrf_tbl->strassigned->CssStyle = "";
			$jrf_tbl->strassigned->CssClass = "";
			$jrf_tbl->strassigned->ViewCustomAttributes = "";

			// strremarks
			$jrf_tbl->strremarks->ViewValue = $jrf_tbl->strremarks->CurrentValue;
			$jrf_tbl->strremarks->CssStyle = "";
			$jrf_tbl->strremarks->CssClass = "";
			$jrf_tbl->strremarks->ViewCustomAttributes = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->ViewValue = $jrf_tbl->strdatecomplete->CurrentValue;
			$jrf_tbl->strdatecomplete->CssStyle = "";
			$jrf_tbl->strdatecomplete->CssClass = "";
			$jrf_tbl->strdatecomplete->ViewCustomAttributes = "";

			// ID
			$jrf_tbl->ID->HrefValue = "";
			$jrf_tbl->ID->TooltipValue = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->HrefValue = "";
			$jrf_tbl->strjrfnum->TooltipValue = "";

			// strquarter
			$jrf_tbl->strquarter->HrefValue = "";
			$jrf_tbl->strquarter->TooltipValue = "";

			// strmon
			$jrf_tbl->strmon->HrefValue = "";
			$jrf_tbl->strmon->TooltipValue = "";

			// stryear
			$jrf_tbl->stryear->HrefValue = "";
			$jrf_tbl->stryear->TooltipValue = "";

			// strdate
			$jrf_tbl->strdate->HrefValue = "";
			$jrf_tbl->strdate->TooltipValue = "";

			// strtime
			$jrf_tbl->strtime->HrefValue = "";
			$jrf_tbl->strtime->TooltipValue = "";

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";
			$jrf_tbl->strduedate->TooltipValue = "";

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";
			$jrf_tbl->strsubject->TooltipValue = "";

			// strusername
			$jrf_tbl->strusername->HrefValue = "";
			$jrf_tbl->strusername->TooltipValue = "";

			// strusereadd
			$jrf_tbl->strusereadd->HrefValue = "";
			$jrf_tbl->strusereadd->TooltipValue = "";

			// strcompany
			$jrf_tbl->strcompany->HrefValue = "";
			$jrf_tbl->strcompany->TooltipValue = "";

			// strdepartment
			$jrf_tbl->strdepartment->HrefValue = "";
			$jrf_tbl->strdepartment->TooltipValue = "";

			// strloc
			$jrf_tbl->strloc->HrefValue = "";
			$jrf_tbl->strloc->TooltipValue = "";

			// strposition
			$jrf_tbl->strposition->HrefValue = "";
			$jrf_tbl->strposition->TooltipValue = "";

			// strtelephone
			$jrf_tbl->strtelephone->HrefValue = "";
			$jrf_tbl->strtelephone->TooltipValue = "";

			// strcostcent
			$jrf_tbl->strcostcent->HrefValue = "";
			$jrf_tbl->strcostcent->TooltipValue = "";

			// strnature
			$jrf_tbl->strnature->HrefValue = "";
			$jrf_tbl->strnature->TooltipValue = "";

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";
			$jrf_tbl->strdescript->TooltipValue = "";

			// strattach
			$jrf_tbl->strattach->HrefValue = "";
			$jrf_tbl->strattach->TooltipValue = "";

			// strarea
			$jrf_tbl->strarea->HrefValue = "";
			$jrf_tbl->strarea->TooltipValue = "";

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";
			$jrf_tbl->strpriority->TooltipValue = "";

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";
			$jrf_tbl->strstatus->TooltipValue = "";

			// strlastedit
			$jrf_tbl->strlastedit->HrefValue = "";
			$jrf_tbl->strlastedit->TooltipValue = "";

			// strcategory
			$jrf_tbl->strcategory->HrefValue = "";
			$jrf_tbl->strcategory->TooltipValue = "";

			// strassigned
			$jrf_tbl->strassigned->HrefValue = "";
			$jrf_tbl->strassigned->TooltipValue = "";

			// strremarks
			$jrf_tbl->strremarks->HrefValue = "";
			$jrf_tbl->strremarks->TooltipValue = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->HrefValue = "";
			$jrf_tbl->strdatecomplete->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $jrf_tbl;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $jrf_tbl->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->lDisplayRecs < 0) {
			$this->lStopRec = $this->lTotalRecs;
		} else {
			$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($jrf_tbl->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($jrf_tbl, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($jrf_tbl->ID);
				$ExportDoc->ExportCaption($jrf_tbl->strjrfnum);
				$ExportDoc->ExportCaption($jrf_tbl->strdate);
				$ExportDoc->ExportCaption($jrf_tbl->strtime);
				$ExportDoc->ExportCaption($jrf_tbl->strduedate);
				$ExportDoc->ExportCaption($jrf_tbl->strsubject);
				$ExportDoc->ExportCaption($jrf_tbl->strusername);
				$ExportDoc->ExportCaption($jrf_tbl->strusereadd);
				$ExportDoc->ExportCaption($jrf_tbl->strcompany);
				$ExportDoc->ExportCaption($jrf_tbl->strdepartment);
				$ExportDoc->ExportCaption($jrf_tbl->strloc);
				$ExportDoc->ExportCaption($jrf_tbl->strposition);
				$ExportDoc->ExportCaption($jrf_tbl->strtelephone);
				$ExportDoc->ExportCaption($jrf_tbl->strcostcent);
				$ExportDoc->ExportCaption($jrf_tbl->strnature);
				$ExportDoc->ExportCaption($jrf_tbl->strdescript);
				$ExportDoc->ExportCaption($jrf_tbl->strarea);
				$ExportDoc->ExportCaption($jrf_tbl->strpriority);
				$ExportDoc->ExportCaption($jrf_tbl->strstatus);
				$ExportDoc->ExportCaption($jrf_tbl->strlastedit);
				$ExportDoc->ExportCaption($jrf_tbl->strcategory);
				$ExportDoc->ExportCaption($jrf_tbl->strassigned);
				$ExportDoc->ExportCaption($jrf_tbl->strremarks);
				$ExportDoc->ExportCaption($jrf_tbl->strdatecomplete);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$jrf_tbl->CssClass = "";
				$jrf_tbl->CssStyle = "";
				$jrf_tbl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($jrf_tbl->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $jrf_tbl->ID->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strjrfnum', $jrf_tbl->strjrfnum->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdate', $jrf_tbl->strdate->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strtime', $jrf_tbl->strtime->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strduedate', $jrf_tbl->strduedate->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strsubject', $jrf_tbl->strsubject->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strusername', $jrf_tbl->strusername->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strusereadd', $jrf_tbl->strusereadd->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcompany', $jrf_tbl->strcompany->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdepartment', $jrf_tbl->strdepartment->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strloc', $jrf_tbl->strloc->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strposition', $jrf_tbl->strposition->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strtelephone', $jrf_tbl->strtelephone->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcostcent', $jrf_tbl->strcostcent->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strnature', $jrf_tbl->strnature->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdescript', $jrf_tbl->strdescript->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strarea', $jrf_tbl->strarea->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strpriority', $jrf_tbl->strpriority->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strstatus', $jrf_tbl->strstatus->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strlastedit', $jrf_tbl->strlastedit->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcategory', $jrf_tbl->strcategory->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strassigned', $jrf_tbl->strassigned->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strremarks', $jrf_tbl->strremarks->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdatecomplete', $jrf_tbl->strdatecomplete->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($jrf_tbl->ID);
					$ExportDoc->ExportField($jrf_tbl->strjrfnum);
					$ExportDoc->ExportField($jrf_tbl->strdate);
					$ExportDoc->ExportField($jrf_tbl->strtime);
					$ExportDoc->ExportField($jrf_tbl->strduedate);
					$ExportDoc->ExportField($jrf_tbl->strsubject);
					$ExportDoc->ExportField($jrf_tbl->strusername);
					$ExportDoc->ExportField($jrf_tbl->strusereadd);
					$ExportDoc->ExportField($jrf_tbl->strcompany);
					$ExportDoc->ExportField($jrf_tbl->strdepartment);
					$ExportDoc->ExportField($jrf_tbl->strloc);
					$ExportDoc->ExportField($jrf_tbl->strposition);
					$ExportDoc->ExportField($jrf_tbl->strtelephone);
					$ExportDoc->ExportField($jrf_tbl->strcostcent);
					$ExportDoc->ExportField($jrf_tbl->strnature);
					$ExportDoc->ExportField($jrf_tbl->strdescript);
					$ExportDoc->ExportField($jrf_tbl->strarea);
					$ExportDoc->ExportField($jrf_tbl->strpriority);
					$ExportDoc->ExportField($jrf_tbl->strstatus);
					$ExportDoc->ExportField($jrf_tbl->strlastedit);
					$ExportDoc->ExportField($jrf_tbl->strcategory);
					$ExportDoc->ExportField($jrf_tbl->strassigned);
					$ExportDoc->ExportField($jrf_tbl->strremarks);
					$ExportDoc->ExportField($jrf_tbl->strdatecomplete);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($jrf_tbl->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($jrf_tbl->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($jrf_tbl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($jrf_tbl->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($jrf_tbl->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}
}
?>
 </div> <!-- /.container -->

</body>
</html>