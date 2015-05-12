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
$jrf_tbl_edit = new cjrf_tbl_edit();
$Page =& $jrf_tbl_edit;

// Page init
$jrf_tbl_edit->Page_Init();

// Page main
$jrf_tbl_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_edit = new ew_Page("jrf_tbl_edit");

// page properties
jrf_tbl_edit.PageID = "edit"; // page ID
jrf_tbl_edit.FormID = "fjrf_tbledit"; // form ID
var EW_PAGE_ID = jrf_tbl_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
jrf_tbl_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_strmon"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($jrf_tbl->strmon->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_strremarks"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($jrf_tbl->strremarks->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
jrf_tbl_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php include('nav-simple.php'); ?>

    	
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_edit->ShowMessage();
?>
    <!--View  jrf_tbl logs -->
        <?php

            $jrfID_NUM = $jrf_tbl->ID->EditValue;
            $_SESSION['set_id']=trim($jrfID_NUM);
            $set_ID=$_SESSION['set_id'];

            $e_add= $jrf_tbl->strusereadd->EditValue;

                       
            $view_record = new Record();
            $view_record->viewRecord($set_ID);

            switch ($global_authorization) {
            case 'user':
                $view_attachment = "";
                break;
            default:
                $view_attachment = "<table>
                <tr>
                    <td>
                        <label>Attachment (requestor) :</label>
                    </td>
                    <td><a href='http://www.skygroup.com.ph/servicetracker/upload/$view_record->strattach' target='_blank'>$view_record->strattach</a></td>
                  
                    <td>
                        <label>Attachment (fmd) :</label>
                    </td>
                    <td><a href='http://www.skygroup.com.ph/servicetracker/upload/$view_record->strattach2' target='_blank'>$view_record->strattach2</a></td>
                </tr>
            </table>";
                break;
                }


            if($view_record->strstatus=="Finished" || $view_record->strstatus=="Cancelled"|| $view_record->strstatus=="New" || $view_record->strstatus=="In-Progress"){
                $encoded_to_sap_view="style='visibility:hidden'";
                $vpstyle ="";
                $ogmstyle="";
                $ogm_option ="";
                $PRDate="";
                $cols="col-md-10 col-sm-10";
                }elseif($view_record->strstatus=="Encoded to SAP" || $view_record->strstatus=="For Encoding to SAP"){
                $encoded_to_sap_view="style='visibility:hidden'";
                $vpstyle ="";
                $ogmstyle="";
                $ogm_option ="";
                $cols="col-md-10 col-sm-10";
                    if($global_role=="purchaser"){
                        $PRDate ="
                        <hr>
                        <table align='right'>
                            <tr>
                                <td>
                                    <label>Processing & Delivery Lead Time</label>
                                </td>
                          
                                <td>
                                    <select name='strpurchase' class='form-control'>
                                        <option value=''>-- Please Select --</option>
                                        <option value=''>-- Consumable Items --</option>
                                            <option value='12'>Existing Office Supplies (Repeat Order Only)</option>
                                            <option value='16'>Customized Office Supplies</option>
                                            <option value='32'>Official Company Documents</option>
                                            <option value='10'>Adhesive Labels</option>
                                        <option value='35'>Tally Ribbon, Rainwear-Repeat Order</option>
                                        <option value=''>-- Tools, Equipment,Motors,Machineries --</option>
                                            <option value='40'>Spare Parts -Electronic/Electric Parts</option>
                                            <option value='60'>Special Tools & Equipment</option>
                                            <option value='30'>Ordinary Tools & Equipment</option>
                                        <option value=''>-- Customized Wear --</option>
                                            <option value='45'>Uniforms per Department Only</option>
                                        <option value=''>-- Hardware/Construction Materials --</option>
                                            <option value='5'>Construction Materials (Common)</option>
                                            <option value='10'>Construction Materials (Special Order)</option>
                                        <option value=''>-- CAPEX --</option>
                                            <option value='66'>Kitchen Equipment (Indent Purchase)</option>
                                            <option value='30'>Vehicles (Locally Available)</option>
                                    </select>
                                </td>
                            </tr> 
                            <tr> 
                               <td colspan=2>
                                    <textarea style='border:0px;color:black;font-size:12px' placeholder='Insert Comment here' name='purchasing_remarks' class='form-control' rows='5' cols='150px'></textarea>
                                </td>
                            </tr>    
                            <tr>
                                <td>
                                    <input type='submit' name='purchase' value='Submit' class='btn btn-primary btn-sm'>
                                </td>
                            </tr>  
                        </table>      
                        ";
                    }elseif
                        ($global_role=="sap_encoder"){
                            $sap_num = 
                            "<hr>
                            <table align='right'>
                                <tr>
                                    <td>
                                        <label>SAP num: </label> <input type='text' required name='sap_id_num' placeholder=' insert sap number'>
                                        <input type='submit' name='add_sap_num'  value='Submit' class='btn btn-primary btn-sm'>
                              
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <textarea style='border:0px;color:black;font-size:12px' placeholder='Insert Comment here' name='sap_encoder_remarks' class='form-control' rows='5' cols='150px'></textarea>
                                    </td>
                                </tr>
                            </table>";
                    }else{
                        $PRDate="";
                    }

                }elseif ($view_record->strstatus=="For GM Approval"){
                    $button_name ="ogm_approved";
                    $cols="col-md-6 col-sm-6";
                    $encoded_to_sap_view="";
                    $ogm_option = 
                    "<select name='ogm_select' class='form-control' required >
                        <option value=''>--Please Select</option>
                        <option value=1>Approved</option>
                        <option value=2>Returned</option>
                        <option value=3>VP Approval</option>
                        <option value=4>Disapproved / Cancelled</option>
                    </select>";
                    $vp_option ="";
                    $PRDate="";
                    if($global_role=="ogm"){
                     }else{
                         echo  "<script type=text/javascript>alert('You are not authorized to view this page!');window.location.href='index.php';</script>";
                     }
                }elseif($view_record->strstatus=="For VP Approval"){
                    $button_name ="vp_approved";
                    $cols="col-md-6 col-sm-6";
                    $encoded_to_sap_view="";
                    $ogm_option ="";
                    $PRDate="";
                    $vp_option = 
                    "<select name='vp_select' class='form-control' required >
                        <option value=''>--Please Select</option>
                        <option value=1>Approved</option>
                        <option value=2>Return</option>
                        <option value=3>Disapproved / Cancelled</option>
                    </select>";
                    if($global_role=="vp"){
                        }else{
                            echo "<script type=text/javascript>alert('You are not authorized to view this page!');window.location.href='index.php';</script>";
                        }

                }

          
        ?>

<?php

    
//======== ADD DAYS BY PURCHASING ==//
if(isset($_POST['purchase'])){

    $current_due=$view_record->strduedate;    //current due date
    $strpurchase = $_POST['strpurchase'] . " " . "days";



    $due_date=date_create("$current_due"); //current due date
    date_add($due_date,date_interval_create_from_date_string("$strpurchase"));
    $strduedate = date_format($due_date,"m/d/Y");
    $strduedate = trim($strduedate);


    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $purchasing_remarks = $_POST['purchasing_remarks'];
    $db_remarks = $view_record->strremarks;

    if(empty($purchasing_remarks)){
        $pur_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" . "Added: " . $strpurchase . " to due date" ."\r\n". "\r\n" . $db_remarks;
    }else{
          $pur_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" . $purchasing_remarks ."\r\n" . "Added: " . $strpurchase . " to due date" ."\r\n". "\r\n" . $db_remarks;
    };
  
     $sql =
        "
        strremarks =  '$pur_remarks',
        strduedate = '$strduedate',
        strlastedit = '$global_user_fullname'
       ";

    //success message
    $msg= "Processing Time Successfully Set!";
    
    //for logs
    $action = "Added $strpurchase to JRF #" .  $view_record->strjrfnum;

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);


}//endIf  





//Insert SAP num and comments by SAP Encoder
if(isset($_POST['add_sap_num'])){

    date_default_timezone_set('Asia/Manila');
    $date_now = date("Y-m-d H:i:s"); 
    $sap_id_num = $_POST['sap_id_num'];
    $sap_encoder_remarks = $_POST['sap_encoder_remarks'];
    $db_remarks = $view_record->strremarks;

    if(empty($sap_encoder_remarks)){
        $sap_encoder_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" . "Request Encoded to SAP. #" . $sap_id_num ."\r\n". "\r\n" . $db_remarks;
    }else{
          $sap_encoder_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now ."\r\n" . $sap_encoder_remarks ."\r\n". "SAP #".$sap_id_num. "\r\n" . "\r\n" . $db_remarks;
    };
  
     $sql =
        "
        strremarks =  '$sap_encoder_remarks',
        sap_num = '$sap_id_num',
        strlastedit = '$global_user_fullname',
        strstatus = 'Encoded to SAP'
       ";

    //success message
    $msg= "SAP number succesfully Inserted!";
    
    //for logs
    $action = "Added SAP #$sap_id_num to JRF #" .  $view_record->strjrfnum;

    $obj = new UpdateClass();
    $obj->getUpdateVar($sql, $set_ID,$msg);
    $obj->updateView($global_user_fullname,$global_authorization,$action);



require_once("phpmailer/class.phpmailer.php");

$email='ronielo.bulan@skygroup.com.ph'; /* Purchasing  e-mail */
$cc_email = 'irene.uy@skygroup.com.ph';
$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';
$subject = "Approved PR under JRF #" .  $view_record->strjrfnum;
$message= $_POST['address'];

$message=<<<EMAIL

Hello Sir Ronnie Bulan,

WorkOrder JRF # $view_record->strjrfnum has been approved and Encoded to SAP.

Details:

SAP #: $sap_id_num
Request Type : $view_record->strnature
Subject : $view_record->strsubject 
Location: $view_record->strarea
Description: $view_record->strdescript                                                             
 

To check the request,

---------------------------------------------------------------------------
Please click this link : http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$view_record->ID
----------------------------------------------------------------------------

or call the Helpdesk and provide your:  JRF#:$view_record->strjrfnum


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
$mailer->AddCC($cc_email);
$mailer->AddBCC($bcc);
//$mailer->AddAttachment($target);


if(!$mailer->Send())
{
   echo "<script>alert('Your Application Sending Failed.');'</script>";

}



}//endIf  
?>


<div class="row">
    		<div class="col-lg-12">
    			<h3><strong><i class="fa fa-pencil"></i> <?php echo strtoupper($view_record->strstatus); ?> <small>JRF# <?php echo $view_record->strjrfnum; ?></small></strong></h3>
    		</div>
    	</div>
    <hr>

<div class="row">
	<div class="col-md-6 col-sm-6">
		 <table border="0">
            	<tr>
                    <td><label><i class="fa fa-info-circle"></i> Subject:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($view_record->strsubject); ?></p></td>
                </tr> 
                <tr>
                    <td><label><i class="fa fa-map-marker"></i> Requested By:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($view_record->strusername); ?></p></td>
                </tr>
                <tr>
                    <td><label><i class="fa fa-user"></i> Area/Location:</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($view_record->strarea); ?></p></td>
                </tr>
                
                <tr>
                    <td><label><i class="fa fa-cart-arrow-down"></i> PR Charged to:</label></td>
                    <td><p class="textboxleft">
                            <?php    
                                $jrf = $view_record->strjrfnum;
                                $viewCostCenter = new viewCostCenter(); 
                                $viewCostCenter->chargedTo($jrf); 
                            ?>
                        </p>
                    </td>
                </tr>
                
			</table>
	</div>

	<div class="col-md-4 col-sm-4">
			<table border="0">
				<tr>
                   <td><label><i class="fa fa-calendar"></i> Date Received:</label></td>
                    <td><p class="textboxleft"><?php echo $view_record->strdate; ?></p></td>
                </tr>

                <tr>
                    <td><label><i class="fa fa-calendar"></i> Due Date:</label></td>
                    <td><p class="textboxleft"><?php echo $view_record->strduedate; ?></p></td>
                </tr>
                <tr>
                    <td><label><i class="fa fa-user"></i> Assigned to</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($view_record->strassigned); ?></p></td>
                </tr>
                <tr>
                    <td><label><i class="fa fa-list-alt"></i> SAP #</label></td>
                    <td><p class="textboxleft"><?php echo strtoupper($view_record->sap_num); ?></p></td>
                </tr>
                

            </table>
	</div>


	<div class="col-md-10 col-sm-10">
		<br/>
		<fieldset>
            <legend><i class="fa fa-info-circle"></i> DESCRIPTION:</legend>
            <table border="0">
            	<tr>
                   <td>
                   		<textarea style="border:0px;background-color:#ddd;color:black" class="form-control" rows="6" readonly cols="150px"><?php echo ucfirst($view_record->strdescript); ?></textarea>
                   </td>
                </tr>
                
            </table>
        </fieldset>
	</div>
</div>	
<hr>
<div class="row">
	<div class="col-md-10 col-sm-10">
		<fieldset>
            <legend><i class="fa fa-pencil-square-o"></i> PURCHASE REQUEST DETAILS</legend>
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
                font-size:14px;
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
            }
            .tfoot{
                color:red;
                border: 0px solid black;
            }
        </style>

            <table class="viewtable" style="margin-left:20px">
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
                        $prview = new PR($view_record->ID);
                        $prview->viewPR($view_record->strjrfnum);
                    ?>
                </tbody> 
            </table>     
            <?php echo $view_attachment ?>   
       </fieldset>
      
	</div>

 
</div><!--ROW--> 

<hr>
<div class="row">
	<div class="<?php echo $cols ?>">
		<fieldset>
            <legend><i class="fa fa-pencil-square-o"></i> REMARKS</legend>
            <table border="0">
            	<tr>
                	<td>
                	<textarea style="border:0px;background-color:#ddd;color:black;font-size:12px" class="form-control" rows="10" readonly cols="150px"><?php echo ucfirst($view_record->strremarks); ?></textarea>
                  	</td>
                </tr>
           	</table>
            <form action="" method="POST">
                <?php echo $PRDate ?>
                <?php echo $sap_num ?>
             </form>
             
    
        </fieldset>
	</div>
<?php

//=================== APPROVED BY OGM ==============//
if(isset($_POST['ogm_approved'])){
    
    $ogm_select = $_POST['ogm_select'];
    $ogm_select = trim($ogm_select);

    if ($ogm_select=="1") {
        //if request is Fixed Asset
        if($view_record->strfixed_asset=="yes"){

            $strstatus = "For VP Approval";
            $msg= "Request Successfully Send to VP!";
            $auto_msg = "--For VP Approval--";
            $action = "Approved & Send JRF # $view_record->strjrfnum to VP";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
          
            if(empty($the_remarks)){
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };

           $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = '$global_user_fullname'
                ";

          
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);

        //for email
            $email="prisco.ponce@mannyogroup.com";//"VP EMAIL";
            $cc_email ="jerlyn.cotoner@skygroup.com.ph" ; //VP Secretary
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "requires your approval";

$message=<<<EMAIL

Hello Sir Prisco,

The following request needs your approval.

WorkOrder Details:

Request Type :$view_record->strnature
Subject :  $view_record->strsubject   
Description: $view_record->strdescript                                                               
Location: $view_record->strarea

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$view_record->ID
---------------------------------------------------------------------------

If you have any questions or comments regarding the request, please call the Helpdesk and provide reference number: JRF# $view_record->strjrfnum

Please keep a copy of this information for your reference.

Kind regards,
Helpdesk
                                                                                  

EMAIL;



        }else{
            //if not Fixed Asset
            $strstatus = "For Encoding to SAP";
            $msg= "Request Successfully Approved!";  //success message
            $auto_msg = "--Approved PR--";
            $action = "Approved JRF # $view_record->strjrfnum";//for logs


            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
          
            if(empty($the_remarks)){
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };

           $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = '$global_user_fullname'
                ";

          
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);

           //for email
            $email="christina.denolo@gmail.com ";//"Christina Denolo EMAIL";
            $cc_email = "" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "has been Approved by the GM";

$message=<<<EMAIL


Hello Christina Denolo,

Workorder Number: JRF# $view_record->strjrfnum has been approved by GM.

please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$view_record->ID

WorkOrder Details:

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


If you have any questions or comments, please call the Helpdesk and provide reference number: JRF# $view_record->strjrfnum

Please keep a copy of this information for your reference.   

Kind regards,
Helpdesk                                                                                               


EMAIL;



        }



}elseif($ogm_select=="2"){
            $strstatus = "In-Progress";
            $msg= "Request Successfully returned to FMD!";
            $auto_msg = "--Returned--";
            $action = "Returned PR of JRF # $view_record->strjrfnum";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
          
            if(empty($the_remarks)){
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };

           $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = '$global_user_fullname'
                ";

          
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);
    
        //for email
            $email="ed.cuya@skykitchen.com.ph ";//"FMD EMAIL";
            $cc_email = "" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "has been Returned by the GM";

$message=<<<EMAIL

Hello Ed Cuya,

Purchase Request for Workorder Number: JRF# $view_record->strjrfnum has been returned by GM.

please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tblview.php?ID=$view_record->ID

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


Kind regards,
Helpdesk                                                                                                

EMAIL;

 }elseif($ogm_select=="3"){
            $strstatus = "For VP Approval";
            $msg= "Request Successfully Send to VP!";
            $auto_msg = "--For VP Approval--";
            $action = "Approved & Send JRF # $view_record->strjrfnum to VP";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
          
            if(empty($the_remarks)){
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };

           $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = '$global_user_fullname'
                ";

          
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);

        //for email
            $email="prisco.ponce@mannyogroup.com";//"VP EMAIL";
            $cc_email ="jerlyn.cotoner@skygroup.com.ph" ; //VP Secretary
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "requires your approval";

$message=<<<EMAIL

Hello Sir Prisco,

The following request needs your approval.

WorkOrder Details:

Request Type :$view_record->strnature
Subject :  $view_record->strsubject   
Description: $view_record->strdescript                                                               
Location: $view_record->strarea

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$view_record->ID
---------------------------------------------------------------------------

If you have any questions or comments regarding the request, please call the Helpdesk and provide reference number: JRF# $view_record->strjrfnum

Please keep a copy of this information for your reference.

Kind regards,
Helpdesk
                                                                                  

EMAIL;


 }elseif($ogm_select=="4"){
            $strstatus = "Cancelled";
            $auto_msg = "--Cancelled--";
            $msg= "Request has been Cancelled Successfully!";
            $action = "Cancelled JRF # $view_record->strjrfnum to VP";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
            
            if(empty($the_remarks)){
               $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };
            //success message
            $msg= "Request has been Cancelled Successfully!";
            
            //for logs
            $action = "Cancelled JRF # $strjrfnum";

            date_default_timezone_set('Asia/Manila');
            $date_time = date("m/d/Y H:i");
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->markFinished($view_record->ID,$view_record->strjrfnum,$view_record->strquarter,$view_record->strmon,$view_record->stryear,$view_record->strdate,$view_record->strtime,$sview_record->trusername,$view_record->strusereadd,$view_record->strcompany,$view_record->strdepartment,$view_record->strloc,$view_record->strposition,$view_record->strtelephone,$view_record->strcostcent,$view_record->strsubject,$view_record->strnature,$view_record->strdescript,$view_record->strarea,$view_record->strattach,$view_record->strpriority,$view_record->strduedate,'Cancelled',$view_record->strattach2,$global_user_fullname,$view_record->strcategory,$view_record->strassigned,$date_time,$view_record->strwithpr,$strcancel_remarks,$view_record->sap_num,'Cancelled',$view_record->strattach2,$global_user_fullname,$global_authorization,$action);



        //for email
            $email=$e_add;//"user EMAIL";
            $cc_email = "" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "has been Cancelled by the GM";

$message=<<<EMAIL


Hello $view_record->strusername,

Workorder Number: JRF# $view_record->strjrfnum has been cancelled by GM.

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/archv_finishedview.php?ID=$view_record->ID
---------------------------------------------------------------------------

WorkOrder Details:

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


If you have any questions or comments regarding the cancellation, please call the Helpdesk and provide reference number.

Please keep a copy of this information for your reference.   

Kind regards,
Helpdesk                                                                                               

EMAIL;
 }
 
  
//EMAIL

require_once("phpmailer/class.phpmailer.php");

$bcc ="ict@skygroup.com.ph";
$feedback= 'Thanks for the worthless Email';

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk';//$view_record->strusername; // This is the from name in the email, you can put anything you like here
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
}; // END APPROVED BY GM



//=================== APPROVED BY VP ==============//
if(isset($_POST['vp_approved'])){
   
    $vp_select = $_POST['vp_select'];

    if ($vp_select=="1") {
            $strstatus = "For Encoding to SAP";
            $msg= "Request Successfully Approved!";  //success message
            $auto_msg_vp = "--Approved--";
            $action = "Approved JRF # $view_record->strjrfnum";//for logs

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
            $the_remarks =trim($_POST['the_remarks']);
            
            if(empty($the_remarks)){
               $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg_vp ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };


            $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = 'VP'
                ";

            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);

            //for email
            $email="christina.denolo@gmail.com ";//"Christina denolo EMAIL for SAP Encoding";
            $cc_email ="jerlyn.cotoner@skygroup.com.ph" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " "  .$vp_select. "has been Approved by the VP";

$message=<<<EMAIL


Hello Christina Denolo,

Workorder Number: JRF# $view_record->strjrfnum has been Approved by VP.

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tbledit.php?ID=$view_record->ID
---------------------------------------------------------------------------

WorkOrder Details:

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


If you have any questions or comments, please call the Helpdesk and provide reference number: JRF# $view_record->strjrfnum

Please keep a copy of this information for your reference.   

Kind regards,
Helpdesk                                                                                               


EMAIL;

}elseif($vp_select=="2"){
            $strstatus = "In-Progress";
            $msg= "Request Successfully returned to FMD!";
            $auto_msg_vp = "--Returned--";
            $action = "Returned PR of JRF # $view_record->strjrfnum";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
             $the_remarks =trim($_POST['the_remarks']);
            
            if(empty($the_remarks)){
               $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg_vp ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };


            $sql =
                "
                strremarks =  '$the_remarks',
                strstatus = '$strstatus',
                strlastedit = 'VP'
                ";

            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->updateView($global_user_fullname,$global_authorization,$action);
            
        //for email
            $email="ed.cuya@skykitchen.com.ph ";//"Ed Cuya Email. returned by VP";
            $cc_email = "" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "has been Returned by VP";

$message=<<<EMAIL

Hello Ed Cuya,

Purchase Request for Workorder Number: JRF# $view_record->strjrfnum has been returned by VP.

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/jrf_tblview.php?ID=$view_record->ID
---------------------------------------------------------------------------

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


Kind regards,
Helpdesk                                                   

EMAIL;

}elseif($vp_select=="3"){
            $strstatus = "Cancelled";
            $msg= "Request has been Cancelled Successfully!";
            $auto_msg_vp = "--Cancelled--";
            $action = "Cancelled JRF # $view_record->strjrfnum";

            date_default_timezone_set('Asia/Manila');
            $date_now = date("Y-m-d H:i:s"); 
             $the_remarks =trim($_POST['the_remarks']);
            
            if(empty($the_remarks)){
               $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $auto_msg_vp ."\r\n". "\r\n" . $view_record->strremarks;
            }else{
                $the_remarks = $global_user_fullname ." wrote" . "\r\n" . $date_now . "\r\n" . $the_remarks ."\r\n". "\r\n" . $view_record->strremarks;
            };
            //success message
            $msg= "Request has been Cancelled Successfully!";
            
            //for logs
            $action = "Cancel JRF # $strjrfnum";

            date_default_timezone_set('Asia/Manila');
            $date_time = date("m/d/Y H:i");
            $obj = new UpdateClass();
            $obj->getUpdateVar($sql, $view_record->ID,$msg);
            $obj->markFinished($view_record->ID,$view_record->strjrfnum,$view_record->strquarter,$view_record->strmon,$view_record->stryear,$view_record->strdate,$view_record->strtime,$sview_record->trusername,$view_record->strusereadd,$view_record->strcompany,$view_record->strdepartment,$view_record->strloc,$view_record->strposition,$view_record->strtelephone,$view_record->strcostcent,$view_record->strsubject,$view_record->strnature,$view_record->strdescript,$view_record->strarea,$view_record->strattach,$view_record->strpriority,$view_record->strduedate,'Cancelled',$view_record->strattach2,$global_user_fullname,$view_record->strcategory,$view_record->strassigned,$date_time,$view_record->strwithpr,$the_remarks,$view_record->sap_num,'Cancelled',$view_record->strattach2,$global_user_fullname,$global_authorization,$action);



        //for email
            $email=$view_record->strusereadd;//"USER EMAIL.com.ph";
            $cc_email = "" ;
            $subject = "Workorder Number:" . "JRF#:" . $view_record->strjrfnum . " " . "has been Cancelled by VP";

$message=<<<EMAIL


Hello $view_record->strusername,

Workorder Number: JRF# $view_record->strjrfnum has been cancelled by VP.

---------------------------------------------------------------------------
please see details :  http://www.skygroup.com.ph/servicetracker/archv_finishedview.php?ID=$view_record->ID
---------------------------------------------------------------------------

WorkOrder Details:

Request Type : $view_record->strnature
Subject : $view_record->strsubject                                                                     
Location: $view_record->strarea


If you have any questions or comments regarding the cancellation, please call the Helpdesk and provide reference number.

Please keep a copy of this information for your reference.   

Kind regards,
Helpdesk                                                                                             

EMAIL;
 }

    

 //EMAIL

require_once("phpmailer/class.phpmailer.php");
$bcc ="ict@skygroup.com.ph";


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.gmail.com:465';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'mail.manager27@gmail.com';  // Change this to your gmail adress
$mailer->Password = 'nikkoz06';  // Change this to your gmail password
$mailer->From = 'mail.manager27@gmail.com';  // This HAVE TO be your gmail adress
$mailer->FromName = 'Helpdesk';//$view_record->strusername; // This is the from name in the email, you can put anything you like here
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
}; // END IF MARK FINISH

  

?>

<form name="form_view_new_job" id="form_view_new_job" method="POST" action="" onsubmit="$('#loading').show();">
    <div class="col-md-4 col-sm-4" <?php echo $encoded_to_sap_view ?>>
		<table border="0">
			<tr>
               	<td colspan="2">
               		<label>Add New Remarks</label>
            	   	<textarea class="form-control" name="the_remarks" rows="5" cols="50px"></textarea>
               	</td>
            </tr> 
            <tr>
                <td>
                    <?php echo $ogm_option; ?>
                    <?php echo $vp_option; ?>
                    
                </td>
                <td>    
                    <input type="submit" name="<?php echo $button_name; ?>"  value="Submit" class="btn btn-primary"  onclick="return confirm('Submit Action?')">
                </td>
            </tr>
            <tr>
                <td>
                    <div id="loading" style="display:none">
                        <p style="font-style:italic">Email Sending Please Wait... <i class="fa fa-spinner fa-spin fa-2x"></i></p>
                    </div>
                </td>
            </tr>
        </table>

	
	</div>
 </form>	
</div>





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
<?php include "footer.php" ?>
<?php
$jrf_tbl_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_edit';

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
	function cjrf_tbl_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $jrf_tbl;

		// Load key from QueryString
		if (@$_GET["ID"] <> "")
			$jrf_tbl->ID->setQueryStringValue($_GET["ID"]);
		if (@$_POST["a_edit"] <> "") {
			$jrf_tbl->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$jrf_tbl->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$jrf_tbl->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$jrf_tbl->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($jrf_tbl->ID->CurrentValue == "")
			$this->Page_Terminate("jrf_tbllist.php"); // Invalid key, return to list
		switch ($jrf_tbl->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("jrf_tbllist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$jrf_tbl->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $jrf_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$jrf_tbl->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$jrf_tbl->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $jrf_tbl;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $jrf_tbl;
		$jrf_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
		$jrf_tbl->strjrfnum->setFormValue($objForm->GetValue("x_strjrfnum"));
		$jrf_tbl->strquarter->setFormValue($objForm->GetValue("x_strquarter"));
		$jrf_tbl->strmon->setFormValue($objForm->GetValue("x_strmon"));
		$jrf_tbl->stryear->setFormValue($objForm->GetValue("x_stryear"));
		$jrf_tbl->strdate->setFormValue($objForm->GetValue("x_strdate"));
		$jrf_tbl->strtime->setFormValue($objForm->GetValue("x_strtime"));
		$jrf_tbl->strduedate->setFormValue($objForm->GetValue("x_strduedate"));
		$jrf_tbl->strsubject->setFormValue($objForm->GetValue("x_strsubject"));
		$jrf_tbl->strusername->setFormValue($objForm->GetValue("x_strusername"));
		$jrf_tbl->strusereadd->setFormValue($objForm->GetValue("x_strusereadd"));
		$jrf_tbl->strcompany->setFormValue($objForm->GetValue("x_strcompany"));
		$jrf_tbl->strdepartment->setFormValue($objForm->GetValue("x_strdepartment"));
		$jrf_tbl->strloc->setFormValue($objForm->GetValue("x_strloc"));
		$jrf_tbl->strposition->setFormValue($objForm->GetValue("x_strposition"));
		$jrf_tbl->strtelephone->setFormValue($objForm->GetValue("x_strtelephone"));
		$jrf_tbl->strcostcent->setFormValue($objForm->GetValue("x_strcostcent"));
		$jrf_tbl->strnature->setFormValue($objForm->GetValue("x_strnature"));
		$jrf_tbl->strdescript->setFormValue($objForm->GetValue("x_strdescript"));
		$jrf_tbl->strattach->setFormValue($objForm->GetValue("x_strattach"));
		$jrf_tbl->strarea->setFormValue($objForm->GetValue("x_strarea"));
		$jrf_tbl->strpriority->setFormValue($objForm->GetValue("x_strpriority"));
		$jrf_tbl->strstatus->setFormValue($objForm->GetValue("x_strstatus"));
		$jrf_tbl->strlastedit->setFormValue($objForm->GetValue("x_strlastedit"));
		$jrf_tbl->strcategory->setFormValue($objForm->GetValue("x_strcategory"));
		$jrf_tbl->strassigned->setFormValue($objForm->GetValue("x_strassigned"));
		$jrf_tbl->strremarks->setFormValue($objForm->GetValue("x_strremarks"));
		$jrf_tbl->strdatecomplete->setFormValue($objForm->GetValue("x_strdatecomplete"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $jrf_tbl;
		$this->LoadRow();
		$jrf_tbl->ID->CurrentValue = $jrf_tbl->ID->FormValue;
		$jrf_tbl->strjrfnum->CurrentValue = $jrf_tbl->strjrfnum->FormValue;
		$jrf_tbl->strquarter->CurrentValue = $jrf_tbl->strquarter->FormValue;
		$jrf_tbl->strmon->CurrentValue = $jrf_tbl->strmon->FormValue;
		$jrf_tbl->stryear->CurrentValue = $jrf_tbl->stryear->FormValue;
		$jrf_tbl->strdate->CurrentValue = $jrf_tbl->strdate->FormValue;
		$jrf_tbl->strtime->CurrentValue = $jrf_tbl->strtime->FormValue;
		$jrf_tbl->strduedate->CurrentValue = $jrf_tbl->strduedate->FormValue;
		$jrf_tbl->strsubject->CurrentValue = $jrf_tbl->strsubject->FormValue;
		$jrf_tbl->strusername->CurrentValue = $jrf_tbl->strusername->FormValue;
		$jrf_tbl->strusereadd->CurrentValue = $jrf_tbl->strusereadd->FormValue;
		$jrf_tbl->strcompany->CurrentValue = $jrf_tbl->strcompany->FormValue;
		$jrf_tbl->strdepartment->CurrentValue = $jrf_tbl->strdepartment->FormValue;
		$jrf_tbl->strloc->CurrentValue = $jrf_tbl->strloc->FormValue;
		$jrf_tbl->strposition->CurrentValue = $jrf_tbl->strposition->FormValue;
		$jrf_tbl->strtelephone->CurrentValue = $jrf_tbl->strtelephone->FormValue;
		$jrf_tbl->strcostcent->CurrentValue = $jrf_tbl->strcostcent->FormValue;
		$jrf_tbl->strnature->CurrentValue = $jrf_tbl->strnature->FormValue;
		$jrf_tbl->strdescript->CurrentValue = $jrf_tbl->strdescript->FormValue;
		$jrf_tbl->strattach->CurrentValue = $jrf_tbl->strattach->FormValue;
		$jrf_tbl->strarea->CurrentValue = $jrf_tbl->strarea->FormValue;
		$jrf_tbl->strpriority->CurrentValue = $jrf_tbl->strpriority->FormValue;
		$jrf_tbl->strstatus->CurrentValue = $jrf_tbl->strstatus->FormValue;
		$jrf_tbl->strlastedit->CurrentValue = $jrf_tbl->strlastedit->FormValue;
		$jrf_tbl->strcategory->CurrentValue = $jrf_tbl->strcategory->FormValue;
		$jrf_tbl->strassigned->CurrentValue = $jrf_tbl->strassigned->FormValue;
		$jrf_tbl->strremarks->CurrentValue = $jrf_tbl->strremarks->FormValue;
		$jrf_tbl->strdatecomplete->CurrentValue = $jrf_tbl->strdatecomplete->FormValue;
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
		} elseif ($jrf_tbl->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ID
			$jrf_tbl->ID->EditCustomAttributes = "";
			$jrf_tbl->ID->EditValue = $jrf_tbl->ID->CurrentValue;
			$jrf_tbl->ID->CssStyle = "";
			$jrf_tbl->ID->CssClass = "";
			$jrf_tbl->ID->ViewCustomAttributes = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->EditCustomAttributes = "";
			$jrf_tbl->strjrfnum->EditValue = ew_HtmlEncode($jrf_tbl->strjrfnum->CurrentValue);

			// strquarter
			$jrf_tbl->strquarter->EditCustomAttributes = "";
			$jrf_tbl->strquarter->EditValue = ew_HtmlEncode($jrf_tbl->strquarter->CurrentValue);

			// strmon
			$jrf_tbl->strmon->EditCustomAttributes = "";
			$jrf_tbl->strmon->EditValue = ew_HtmlEncode($jrf_tbl->strmon->CurrentValue);

			// stryear
			$jrf_tbl->stryear->EditCustomAttributes = "";
			$jrf_tbl->stryear->EditValue = ew_HtmlEncode($jrf_tbl->stryear->CurrentValue);

			// strdate
			$jrf_tbl->strdate->EditCustomAttributes = "";
			$jrf_tbl->strdate->EditValue = ew_HtmlEncode($jrf_tbl->strdate->CurrentValue);

			// strtime
			$jrf_tbl->strtime->EditCustomAttributes = "";
			$jrf_tbl->strtime->EditValue = ew_HtmlEncode($jrf_tbl->strtime->CurrentValue);

			// strduedate
			$jrf_tbl->strduedate->EditCustomAttributes = "";
			$jrf_tbl->strduedate->EditValue = ew_HtmlEncode($jrf_tbl->strduedate->CurrentValue);

			// strsubject
			$jrf_tbl->strsubject->EditCustomAttributes = "";
			$jrf_tbl->strsubject->EditValue = ew_HtmlEncode($jrf_tbl->strsubject->CurrentValue);

			// strusername
			$jrf_tbl->strusername->EditCustomAttributes = "";
			$jrf_tbl->strusername->EditValue = ew_HtmlEncode($jrf_tbl->strusername->CurrentValue);

			// strusereadd
			$jrf_tbl->strusereadd->EditCustomAttributes = "";
			$jrf_tbl->strusereadd->EditValue = ew_HtmlEncode($jrf_tbl->strusereadd->CurrentValue);

			// strcompany
			$jrf_tbl->strcompany->EditCustomAttributes = "";
			$jrf_tbl->strcompany->EditValue = ew_HtmlEncode($jrf_tbl->strcompany->CurrentValue);

			// strdepartment
			$jrf_tbl->strdepartment->EditCustomAttributes = "";
			$jrf_tbl->strdepartment->EditValue = ew_HtmlEncode($jrf_tbl->strdepartment->CurrentValue);

			// strloc
			$jrf_tbl->strloc->EditCustomAttributes = "";
			$jrf_tbl->strloc->EditValue = ew_HtmlEncode($jrf_tbl->strloc->CurrentValue);

			// strposition
			$jrf_tbl->strposition->EditCustomAttributes = "";
			$jrf_tbl->strposition->EditValue = ew_HtmlEncode($jrf_tbl->strposition->CurrentValue);

			// strtelephone
			$jrf_tbl->strtelephone->EditCustomAttributes = "";
			$jrf_tbl->strtelephone->EditValue = ew_HtmlEncode($jrf_tbl->strtelephone->CurrentValue);

			// strcostcent
			$jrf_tbl->strcostcent->EditCustomAttributes = "";
			$jrf_tbl->strcostcent->EditValue = ew_HtmlEncode($jrf_tbl->strcostcent->CurrentValue);

			// strnature
			$jrf_tbl->strnature->EditCustomAttributes = "";
			$jrf_tbl->strnature->EditValue = ew_HtmlEncode($jrf_tbl->strnature->CurrentValue);

			// strdescript
			$jrf_tbl->strdescript->EditCustomAttributes = "";
			$jrf_tbl->strdescript->EditValue = ew_HtmlEncode($jrf_tbl->strdescript->CurrentValue);

			// strattach
			$jrf_tbl->strattach->EditCustomAttributes = "";
			$jrf_tbl->strattach->EditValue = ew_HtmlEncode($jrf_tbl->strattach->CurrentValue);

			// strarea
			$jrf_tbl->strarea->EditCustomAttributes = "";
			$jrf_tbl->strarea->EditValue = ew_HtmlEncode($jrf_tbl->strarea->CurrentValue);

			// strpriority
			$jrf_tbl->strpriority->EditCustomAttributes = "";
			$jrf_tbl->strpriority->EditValue = ew_HtmlEncode($jrf_tbl->strpriority->CurrentValue);

			// strstatus
			$jrf_tbl->strstatus->EditCustomAttributes = "";
			$jrf_tbl->strstatus->EditValue = ew_HtmlEncode($jrf_tbl->strstatus->CurrentValue);

			// strlastedit
			$jrf_tbl->strlastedit->EditCustomAttributes = "";
			$jrf_tbl->strlastedit->EditValue = ew_HtmlEncode($jrf_tbl->strlastedit->CurrentValue);

			// strcategory
			$jrf_tbl->strcategory->EditCustomAttributes = "";
			$jrf_tbl->strcategory->EditValue = ew_HtmlEncode($jrf_tbl->strcategory->CurrentValue);

			// strassigned
			$jrf_tbl->strassigned->EditCustomAttributes = "";
			$jrf_tbl->strassigned->EditValue = ew_HtmlEncode($jrf_tbl->strassigned->CurrentValue);

			// strremarks
			$jrf_tbl->strremarks->EditCustomAttributes = "";
			$jrf_tbl->strremarks->EditValue = ew_HtmlEncode($jrf_tbl->strremarks->CurrentValue);

			// strdatecomplete
			$jrf_tbl->strdatecomplete->EditCustomAttributes = "";
			$jrf_tbl->strdatecomplete->EditValue = ew_HtmlEncode($jrf_tbl->strdatecomplete->CurrentValue);

			// Edit refer script
			// ID

			$jrf_tbl->ID->HrefValue = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->HrefValue = "";

			// strquarter
			$jrf_tbl->strquarter->HrefValue = "";

			// strmon
			$jrf_tbl->strmon->HrefValue = "";

			// stryear
			$jrf_tbl->stryear->HrefValue = "";

			// strdate
			$jrf_tbl->strdate->HrefValue = "";

			// strtime
			$jrf_tbl->strtime->HrefValue = "";

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";

			// strusername
			$jrf_tbl->strusername->HrefValue = "";

			// strusereadd
			$jrf_tbl->strusereadd->HrefValue = "";

			// strcompany
			$jrf_tbl->strcompany->HrefValue = "";

			// strdepartment
			$jrf_tbl->strdepartment->HrefValue = "";

			// strloc
			$jrf_tbl->strloc->HrefValue = "";

			// strposition
			$jrf_tbl->strposition->HrefValue = "";

			// strtelephone
			$jrf_tbl->strtelephone->HrefValue = "";

			// strcostcent
			$jrf_tbl->strcostcent->HrefValue = "";

			// strnature
			$jrf_tbl->strnature->HrefValue = "";

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";

			// strattach
			$jrf_tbl->strattach->HrefValue = "";

			// strarea
			$jrf_tbl->strarea->HrefValue = "";

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";

			// strlastedit
			$jrf_tbl->strlastedit->HrefValue = "";

			// strcategory
			$jrf_tbl->strcategory->HrefValue = "";

			// strassigned
			$jrf_tbl->strassigned->HrefValue = "";

			// strremarks
			$jrf_tbl->strremarks->HrefValue = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->HrefValue = "";
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $jrf_tbl;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($jrf_tbl->strmon->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $jrf_tbl->strmon->FldErrMsg();
		}
		if (!is_null($jrf_tbl->strremarks->FormValue) && $jrf_tbl->strremarks->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $jrf_tbl->strremarks->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $jrf_tbl;
		$sFilter = $jrf_tbl->KeyFilter();
		$jrf_tbl->CurrentFilter = $sFilter;
		$sSql = $jrf_tbl->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// strjrfnum
			$jrf_tbl->strjrfnum->SetDbValueDef($rsnew, $jrf_tbl->strjrfnum->CurrentValue, NULL, FALSE);

			// strquarter
			$jrf_tbl->strquarter->SetDbValueDef($rsnew, $jrf_tbl->strquarter->CurrentValue, NULL, FALSE);

			// strmon
			$jrf_tbl->strmon->SetDbValueDef($rsnew, $jrf_tbl->strmon->CurrentValue, NULL, FALSE);

			// stryear
			$jrf_tbl->stryear->SetDbValueDef($rsnew, $jrf_tbl->stryear->CurrentValue, NULL, FALSE);

			// strdate
			$jrf_tbl->strdate->SetDbValueDef($rsnew, $jrf_tbl->strdate->CurrentValue, NULL, FALSE);

			// strtime
			$jrf_tbl->strtime->SetDbValueDef($rsnew, $jrf_tbl->strtime->CurrentValue, NULL, FALSE);

			// strduedate
			$jrf_tbl->strduedate->SetDbValueDef($rsnew, $jrf_tbl->strduedate->CurrentValue, NULL, FALSE);

			// strsubject
			$jrf_tbl->strsubject->SetDbValueDef($rsnew, $jrf_tbl->strsubject->CurrentValue, NULL, FALSE);

			// strusername
			$jrf_tbl->strusername->SetDbValueDef($rsnew, $jrf_tbl->strusername->CurrentValue, NULL, FALSE);

			// strusereadd
			$jrf_tbl->strusereadd->SetDbValueDef($rsnew, $jrf_tbl->strusereadd->CurrentValue, NULL, FALSE);

			// strcompany
			$jrf_tbl->strcompany->SetDbValueDef($rsnew, $jrf_tbl->strcompany->CurrentValue, NULL, FALSE);

			// strdepartment
			$jrf_tbl->strdepartment->SetDbValueDef($rsnew, $jrf_tbl->strdepartment->CurrentValue, NULL, FALSE);

			// strloc
			$jrf_tbl->strloc->SetDbValueDef($rsnew, $jrf_tbl->strloc->CurrentValue, NULL, FALSE);

			// strposition
			$jrf_tbl->strposition->SetDbValueDef($rsnew, $jrf_tbl->strposition->CurrentValue, NULL, FALSE);

			// strtelephone
			$jrf_tbl->strtelephone->SetDbValueDef($rsnew, $jrf_tbl->strtelephone->CurrentValue, NULL, FALSE);

			// strcostcent
			$jrf_tbl->strcostcent->SetDbValueDef($rsnew, $jrf_tbl->strcostcent->CurrentValue, NULL, FALSE);

			// strnature
			$jrf_tbl->strnature->SetDbValueDef($rsnew, $jrf_tbl->strnature->CurrentValue, NULL, FALSE);

			// strdescript
			$jrf_tbl->strdescript->SetDbValueDef($rsnew, $jrf_tbl->strdescript->CurrentValue, NULL, FALSE);

			// strattach
			$jrf_tbl->strattach->SetDbValueDef($rsnew, $jrf_tbl->strattach->CurrentValue, NULL, FALSE);

			// strarea
			$jrf_tbl->strarea->SetDbValueDef($rsnew, $jrf_tbl->strarea->CurrentValue, NULL, FALSE);

			// strpriority
			$jrf_tbl->strpriority->SetDbValueDef($rsnew, $jrf_tbl->strpriority->CurrentValue, NULL, FALSE);

			// strstatus
			$jrf_tbl->strstatus->SetDbValueDef($rsnew, $jrf_tbl->strstatus->CurrentValue, NULL, FALSE);

			// strlastedit
			$jrf_tbl->strlastedit->SetDbValueDef($rsnew, $jrf_tbl->strlastedit->CurrentValue, NULL, FALSE);

			// strcategory
			$jrf_tbl->strcategory->SetDbValueDef($rsnew, $jrf_tbl->strcategory->CurrentValue, NULL, FALSE);

			// strassigned
			$jrf_tbl->strassigned->SetDbValueDef($rsnew, $jrf_tbl->strassigned->CurrentValue, NULL, FALSE);

			// strremarks
			$jrf_tbl->strremarks->SetDbValueDef($rsnew, $jrf_tbl->strremarks->CurrentValue, "", FALSE);

			// strdatecomplete
			$jrf_tbl->strdatecomplete->SetDbValueDef($rsnew, $jrf_tbl->strdatecomplete->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $jrf_tbl->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($jrf_tbl->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($jrf_tbl->CancelMessage <> "") {
					$this->setMessage($jrf_tbl->CancelMessage);
					$jrf_tbl->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$jrf_tbl->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
 </div> <!-- /.container -->

</body>
</html>