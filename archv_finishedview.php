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
<?php include "archv_finishedinfo.php" ?>
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
$archv_finished_view = new carchv_finished_view();
$Page =& $archv_finished_view;

// Page init
$archv_finished_view->Page_Init();

// Page main
$archv_finished_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($archv_finished->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var archv_finished_view = new ew_Page("archv_finished_view");

// page properties
archv_finished_view.PageID = "view"; // page ID
archv_finished_view.FormID = "farchv_finishedview"; // form ID
var EW_PAGE_ID = archv_finished_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
archv_finished_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
archv_finished_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
archv_finished_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
archv_finished_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
archv_finished_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
archv_finished_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>


<div class="row">
    <div class="col-lg-4 col-md-4">
    	<h3><strong><i class="fa fa-file-text"></i> View Details</strong></h3>
    </div>
</div>
    	
<?php include('fmd-nav.php'); ?>

<hr>
<?php } ?>

<?php if ($archv_finished->Export == "") { ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $archv_finished_view->ListUrl ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">
<img src="img/system/buttons/export_excel.png" title="Export to Excel" onclick="javascript:location.href='<?php echo $archv_finished_view->ExportExcelUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
<img src="img/system/buttons/csv.png" title="Export to CSV" onclick="javascript:location.href='<?php echo $archv_finished_view->ExportCsvUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
<?php } ?>

<?php if ($archv_finished->Export == "") { ?>
<?php } ?>

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$archv_finished_view->ShowMessage();
?>



<!--View  jrf_tbl logs -->
    <?php
    require 'dbc.php';
        	$finish_id =  $archv_finished->ID->ViewValue;
           	$set_ID=trim($finish_id);
           
        $view_record = new Record();
        $view_record->finish_table($set_ID);
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
            $work_days = $view_record->work_days;
             $strdatecomplete= $view_record->strdatecomplete;
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


switch ($strstatus) {
	case 'Finished':
		//$color = "color:#449d44";
        $color = "color:#449d44;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
        $verified_icon =  "<img src='img/system/buttons/check.gif' width=18px height=17px title='Verified Finished!'>";
		$warning_icon = "";
        $command_button = "";
		break;

    case 'Cancelled':
        //$color = "color:#449d44";
        $color = "color:#449d44;background-color:#ecdf0d;padding-left:3px;padding-right:3px";
        $verified_icon =  "<img src='img/system/buttons/check.gif' width=18px height=17px title='Verified Finished!'>";
        $warning_icon = "";
        $command_button = "";
        break;
	
	default:
	break;
};

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
                    <td><p class="textboxleft"><?php echo $strjrfnum; ?></p></td>
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
                    <td><label><i class="fa fa-list-alt"></i> SAP #:</label></td>
                    <td><p class="textboxleft"><?php echo $sap_num; ?></td>
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
                        <label>Attachment:</label>
                    </td>
                    <td><a href="http://www.skygroup.com.ph/servicetracker/upload/<?php echo $strattach ?>" target='_blank'><?php echo $strattach ?></a></td>
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
                        <p class="textboxleft" style="text-align:center"><?php echo strtoupper($strdatecomplete); ?> <span title="This request was finished in <?php echo $work_days; ?>."><?php echo  $work_days;?></span> </p>
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
                        <textarea class="form-control" style="border:0px;background-color:#ddd;color:black;font-size:12px" class="form-control" rows="20" readonly cols="150px"><?php echo ucfirst($strremarks); ?></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

	
</div><!--div row-->

<!-- Modal -->
<!-- VIEW PR -->
<div class="modal fade" id="view_pr_id" role="dialog" aria-labelledby="view_pr_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="pull-left">
               <i class="fa fa-question-circle fa-lg"></i> <label><strong>VIEW PR for <?php echo $strjrfnum; ?></strong></label>
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
                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_pr_id">Edit PR</button>        
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </form>
            </div>

        </div>
</div>
</div>


<?php if ($archv_finished->Export == "") { ?>
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
$archv_finished_view->Page_Terminate();
?>
<?php

//
// Page class
//
class carchv_finished_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'archv_finished';

	// Page object name
	var $PageObjName = 'archv_finished_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $archv_finished;
		if ($archv_finished->UseTokenInUrl) $PageUrl .= "t=" . $archv_finished->TableVar . "&"; // Add page token
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
		global $objForm, $archv_finished;
		if ($archv_finished->UseTokenInUrl) {
			if ($objForm)
				return ($archv_finished->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($archv_finished->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function carchv_finished_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (archv_finished)
		$GLOBALS["archv_finished"] = new carchv_finished();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'archv_finished', TRUE);

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
		global $archv_finished;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$archv_finished->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$archv_finished->Export = $_POST["exporttype"];
		} else {
			$archv_finished->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $archv_finished->Export; // Get export parameter, used in header
		$gsExportFile = $archv_finished->TableVar; // Get export file, used in header
		if (@$_GET["ID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["ID"]);
		}
		if ($archv_finished->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($archv_finished->Export == "csv") {
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
		global $Language, $archv_finished;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ID"] <> "") {
				$archv_finished->ID->setQueryStringValue($_GET["ID"]);
				$this->arRecKey["ID"] = $archv_finished->ID->QueryStringValue;
			} else {
				$sReturnUrl = "archv_finishedlist.php"; // Return to list
			}

			// Get action
			$archv_finished->CurrentAction = "I"; // Display form
			switch ($archv_finished->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "archv_finishedlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($archv_finished->Export, array("html","word","excel","xml","csv","email"))) {
				if ($archv_finished->Export == "email" && $archv_finished->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$archv_finished->setExportReturnUrl($archv_finished->ViewUrl()); // Add key
				$this->ExportData();
				if ($archv_finished->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "archv_finishedlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$archv_finished->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $archv_finished;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$archv_finished->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$archv_finished->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $archv_finished->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$archv_finished->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$archv_finished->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$archv_finished->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $archv_finished;

		// Call Recordset Selecting event
		$archv_finished->Recordset_Selecting($archv_finished->CurrentFilter);

		// Load List page SQL
		$sSql = $archv_finished->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$archv_finished->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $archv_finished;
		$sFilter = $archv_finished->KeyFilter();

		// Call Row Selecting event
		$archv_finished->Row_Selecting($sFilter);

		// Load SQL based on filter
		$archv_finished->CurrentFilter = $sFilter;
		$sSql = $archv_finished->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$archv_finished->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $archv_finished;
		$archv_finished->ID->setDbValue($rs->fields('ID'));
		$archv_finished->strjrfnum->setDbValue($rs->fields('strjrfnum'));
		$archv_finished->strquarter->setDbValue($rs->fields('strquarter'));
		$archv_finished->strmon->setDbValue($rs->fields('strmon'));
		$archv_finished->stryear->setDbValue($rs->fields('stryear'));
		$archv_finished->strdate->setDbValue($rs->fields('strdate'));
		$archv_finished->strtime->setDbValue($rs->fields('strtime'));
		$archv_finished->strusername->setDbValue($rs->fields('strusername'));
		$archv_finished->strusereadd->setDbValue($rs->fields('strusereadd'));
		$archv_finished->strcompany->setDbValue($rs->fields('strcompany'));
		$archv_finished->strdepartment->setDbValue($rs->fields('strdepartment'));
		$archv_finished->strloc->setDbValue($rs->fields('strloc'));
		$archv_finished->strposition->setDbValue($rs->fields('strposition'));
		$archv_finished->strtelephone->setDbValue($rs->fields('strtelephone'));
		$archv_finished->strcostcent->setDbValue($rs->fields('strcostcent'));
		$archv_finished->strsubject->setDbValue($rs->fields('strsubject'));
		$archv_finished->strnature->setDbValue($rs->fields('strnature'));
		$archv_finished->strdescript->setDbValue($rs->fields('strdescript'));
		$archv_finished->strarea->setDbValue($rs->fields('strarea'));
		$archv_finished->strattach->setDbValue($rs->fields('strattach'));
		$archv_finished->strpriority->setDbValue($rs->fields('strpriority'));
		$archv_finished->strduedate->setDbValue($rs->fields('strduedate'));
		$archv_finished->strstatus->setDbValue($rs->fields('strstatus'));
		$archv_finished->strlastedit->setDbValue($rs->fields('strlastedit'));
		$archv_finished->strcategory->setDbValue($rs->fields('strcategory'));
		$archv_finished->strassigned->setDbValue($rs->fields('strassigned'));
		$archv_finished->strdatecomplete->setDbValue($rs->fields('strdatecomplete'));
		$archv_finished->strwithpr->setDbValue($rs->fields('strwithpr'));
		$archv_finished->strremarks->setDbValue($rs->fields('strremarks'));
		$archv_finished->sap_num->setDbValue($rs->fields('sap_num'));
		$archv_finished->work_days->setDbValue($rs->fields('work_days'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $archv_finished;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "ID=" . urlencode($archv_finished->ID->CurrentValue);
		$this->AddUrl = $archv_finished->AddUrl();
		$this->EditUrl = $archv_finished->EditUrl();
		$this->CopyUrl = $archv_finished->CopyUrl();
		$this->DeleteUrl = $archv_finished->DeleteUrl();
		$this->ListUrl = $archv_finished->ListUrl();

		// Call Row_Rendering event
		$archv_finished->Row_Rendering();

		// Common render codes for all row types
		// ID

		$archv_finished->ID->CellCssStyle = ""; $archv_finished->ID->CellCssClass = "";
		$archv_finished->ID->CellAttrs = array(); $archv_finished->ID->ViewAttrs = array(); $archv_finished->ID->EditAttrs = array();

		// strjrfnum
		$archv_finished->strjrfnum->CellCssStyle = ""; $archv_finished->strjrfnum->CellCssClass = "";
		$archv_finished->strjrfnum->CellAttrs = array(); $archv_finished->strjrfnum->ViewAttrs = array(); $archv_finished->strjrfnum->EditAttrs = array();

		// strquarter
		$archv_finished->strquarter->CellCssStyle = ""; $archv_finished->strquarter->CellCssClass = "";
		$archv_finished->strquarter->CellAttrs = array(); $archv_finished->strquarter->ViewAttrs = array(); $archv_finished->strquarter->EditAttrs = array();

		// strmon
		$archv_finished->strmon->CellCssStyle = ""; $archv_finished->strmon->CellCssClass = "";
		$archv_finished->strmon->CellAttrs = array(); $archv_finished->strmon->ViewAttrs = array(); $archv_finished->strmon->EditAttrs = array();

		// stryear
		$archv_finished->stryear->CellCssStyle = ""; $archv_finished->stryear->CellCssClass = "";
		$archv_finished->stryear->CellAttrs = array(); $archv_finished->stryear->ViewAttrs = array(); $archv_finished->stryear->EditAttrs = array();

		// strdate
		$archv_finished->strdate->CellCssStyle = ""; $archv_finished->strdate->CellCssClass = "";
		$archv_finished->strdate->CellAttrs = array(); $archv_finished->strdate->ViewAttrs = array(); $archv_finished->strdate->EditAttrs = array();

		// strtime
		$archv_finished->strtime->CellCssStyle = ""; $archv_finished->strtime->CellCssClass = "";
		$archv_finished->strtime->CellAttrs = array(); $archv_finished->strtime->ViewAttrs = array(); $archv_finished->strtime->EditAttrs = array();

		// strusername
		$archv_finished->strusername->CellCssStyle = ""; $archv_finished->strusername->CellCssClass = "";
		$archv_finished->strusername->CellAttrs = array(); $archv_finished->strusername->ViewAttrs = array(); $archv_finished->strusername->EditAttrs = array();

		// strusereadd
		$archv_finished->strusereadd->CellCssStyle = ""; $archv_finished->strusereadd->CellCssClass = "";
		$archv_finished->strusereadd->CellAttrs = array(); $archv_finished->strusereadd->ViewAttrs = array(); $archv_finished->strusereadd->EditAttrs = array();

		// strcompany
		$archv_finished->strcompany->CellCssStyle = ""; $archv_finished->strcompany->CellCssClass = "";
		$archv_finished->strcompany->CellAttrs = array(); $archv_finished->strcompany->ViewAttrs = array(); $archv_finished->strcompany->EditAttrs = array();

		// strdepartment
		$archv_finished->strdepartment->CellCssStyle = ""; $archv_finished->strdepartment->CellCssClass = "";
		$archv_finished->strdepartment->CellAttrs = array(); $archv_finished->strdepartment->ViewAttrs = array(); $archv_finished->strdepartment->EditAttrs = array();

		// strloc
		$archv_finished->strloc->CellCssStyle = ""; $archv_finished->strloc->CellCssClass = "";
		$archv_finished->strloc->CellAttrs = array(); $archv_finished->strloc->ViewAttrs = array(); $archv_finished->strloc->EditAttrs = array();

		// strposition
		$archv_finished->strposition->CellCssStyle = ""; $archv_finished->strposition->CellCssClass = "";
		$archv_finished->strposition->CellAttrs = array(); $archv_finished->strposition->ViewAttrs = array(); $archv_finished->strposition->EditAttrs = array();

		// strtelephone
		$archv_finished->strtelephone->CellCssStyle = ""; $archv_finished->strtelephone->CellCssClass = "";
		$archv_finished->strtelephone->CellAttrs = array(); $archv_finished->strtelephone->ViewAttrs = array(); $archv_finished->strtelephone->EditAttrs = array();

		// strcostcent
		$archv_finished->strcostcent->CellCssStyle = ""; $archv_finished->strcostcent->CellCssClass = "";
		$archv_finished->strcostcent->CellAttrs = array(); $archv_finished->strcostcent->ViewAttrs = array(); $archv_finished->strcostcent->EditAttrs = array();

		// strsubject
		$archv_finished->strsubject->CellCssStyle = ""; $archv_finished->strsubject->CellCssClass = "";
		$archv_finished->strsubject->CellAttrs = array(); $archv_finished->strsubject->ViewAttrs = array(); $archv_finished->strsubject->EditAttrs = array();

		// strnature
		$archv_finished->strnature->CellCssStyle = ""; $archv_finished->strnature->CellCssClass = "";
		$archv_finished->strnature->CellAttrs = array(); $archv_finished->strnature->ViewAttrs = array(); $archv_finished->strnature->EditAttrs = array();

		// strdescript
		$archv_finished->strdescript->CellCssStyle = ""; $archv_finished->strdescript->CellCssClass = "";
		$archv_finished->strdescript->CellAttrs = array(); $archv_finished->strdescript->ViewAttrs = array(); $archv_finished->strdescript->EditAttrs = array();

		// strarea
		$archv_finished->strarea->CellCssStyle = ""; $archv_finished->strarea->CellCssClass = "";
		$archv_finished->strarea->CellAttrs = array(); $archv_finished->strarea->ViewAttrs = array(); $archv_finished->strarea->EditAttrs = array();

		// strattach
		$archv_finished->strattach->CellCssStyle = ""; $archv_finished->strattach->CellCssClass = "";
		$archv_finished->strattach->CellAttrs = array(); $archv_finished->strattach->ViewAttrs = array(); $archv_finished->strattach->EditAttrs = array();

		// strpriority
		$archv_finished->strpriority->CellCssStyle = ""; $archv_finished->strpriority->CellCssClass = "";
		$archv_finished->strpriority->CellAttrs = array(); $archv_finished->strpriority->ViewAttrs = array(); $archv_finished->strpriority->EditAttrs = array();

		// strduedate
		$archv_finished->strduedate->CellCssStyle = ""; $archv_finished->strduedate->CellCssClass = "";
		$archv_finished->strduedate->CellAttrs = array(); $archv_finished->strduedate->ViewAttrs = array(); $archv_finished->strduedate->EditAttrs = array();

		// strstatus
		$archv_finished->strstatus->CellCssStyle = ""; $archv_finished->strstatus->CellCssClass = "";
		$archv_finished->strstatus->CellAttrs = array(); $archv_finished->strstatus->ViewAttrs = array(); $archv_finished->strstatus->EditAttrs = array();

		// strlastedit
		$archv_finished->strlastedit->CellCssStyle = ""; $archv_finished->strlastedit->CellCssClass = "";
		$archv_finished->strlastedit->CellAttrs = array(); $archv_finished->strlastedit->ViewAttrs = array(); $archv_finished->strlastedit->EditAttrs = array();

		// strcategory
		$archv_finished->strcategory->CellCssStyle = ""; $archv_finished->strcategory->CellCssClass = "";
		$archv_finished->strcategory->CellAttrs = array(); $archv_finished->strcategory->ViewAttrs = array(); $archv_finished->strcategory->EditAttrs = array();

		// strassigned
		$archv_finished->strassigned->CellCssStyle = ""; $archv_finished->strassigned->CellCssClass = "";
		$archv_finished->strassigned->CellAttrs = array(); $archv_finished->strassigned->ViewAttrs = array(); $archv_finished->strassigned->EditAttrs = array();

		// strdatecomplete
		$archv_finished->strdatecomplete->CellCssStyle = ""; $archv_finished->strdatecomplete->CellCssClass = "";
		$archv_finished->strdatecomplete->CellAttrs = array(); $archv_finished->strdatecomplete->ViewAttrs = array(); $archv_finished->strdatecomplete->EditAttrs = array();

		// strwithpr
		$archv_finished->strwithpr->CellCssStyle = ""; $archv_finished->strwithpr->CellCssClass = "";
		$archv_finished->strwithpr->CellAttrs = array(); $archv_finished->strwithpr->ViewAttrs = array(); $archv_finished->strwithpr->EditAttrs = array();

		// strremarks
		$archv_finished->strremarks->CellCssStyle = ""; $archv_finished->strremarks->CellCssClass = "";
		$archv_finished->strremarks->CellAttrs = array(); $archv_finished->strremarks->ViewAttrs = array(); $archv_finished->strremarks->EditAttrs = array();

		// sap_num
		$archv_finished->sap_num->CellCssStyle = ""; $archv_finished->sap_num->CellCssClass = "";
		$archv_finished->sap_num->CellAttrs = array(); $archv_finished->sap_num->ViewAttrs = array(); $archv_finished->sap_num->EditAttrs = array();

		// work_days
		$archv_finished->work_days->CellCssStyle = ""; $archv_finished->work_days->CellCssClass = "";
		$archv_finished->work_days->CellAttrs = array(); $archv_finished->work_days->ViewAttrs = array(); $archv_finished->work_days->EditAttrs = array();
		if ($archv_finished->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$archv_finished->ID->ViewValue = $archv_finished->ID->CurrentValue;
			$archv_finished->ID->CssStyle = "";
			$archv_finished->ID->CssClass = "";
			$archv_finished->ID->ViewCustomAttributes = "";

			// strjrfnum
			$archv_finished->strjrfnum->ViewValue = $archv_finished->strjrfnum->CurrentValue;
			$archv_finished->strjrfnum->CssStyle = "";
			$archv_finished->strjrfnum->CssClass = "";
			$archv_finished->strjrfnum->ViewCustomAttributes = "";

			// strquarter
			$archv_finished->strquarter->ViewValue = $archv_finished->strquarter->CurrentValue;
			$archv_finished->strquarter->CssStyle = "";
			$archv_finished->strquarter->CssClass = "";
			$archv_finished->strquarter->ViewCustomAttributes = "";

			// strmon
			$archv_finished->strmon->ViewValue = $archv_finished->strmon->CurrentValue;
			$archv_finished->strmon->CssStyle = "";
			$archv_finished->strmon->CssClass = "";
			$archv_finished->strmon->ViewCustomAttributes = "";

			// stryear
			$archv_finished->stryear->ViewValue = $archv_finished->stryear->CurrentValue;
			$archv_finished->stryear->CssStyle = "";
			$archv_finished->stryear->CssClass = "";
			$archv_finished->stryear->ViewCustomAttributes = "";

			// strdate
			$archv_finished->strdate->ViewValue = $archv_finished->strdate->CurrentValue;
			$archv_finished->strdate->CssStyle = "";
			$archv_finished->strdate->CssClass = "";
			$archv_finished->strdate->ViewCustomAttributes = "";

			// strtime
			$archv_finished->strtime->ViewValue = $archv_finished->strtime->CurrentValue;
			$archv_finished->strtime->CssStyle = "";
			$archv_finished->strtime->CssClass = "";
			$archv_finished->strtime->ViewCustomAttributes = "";

			// strusername
			$archv_finished->strusername->ViewValue = $archv_finished->strusername->CurrentValue;
			$archv_finished->strusername->CssStyle = "";
			$archv_finished->strusername->CssClass = "";
			$archv_finished->strusername->ViewCustomAttributes = "";

			// strusereadd
			$archv_finished->strusereadd->ViewValue = $archv_finished->strusereadd->CurrentValue;
			$archv_finished->strusereadd->CssStyle = "";
			$archv_finished->strusereadd->CssClass = "";
			$archv_finished->strusereadd->ViewCustomAttributes = "";

			// strcompany
			$archv_finished->strcompany->ViewValue = $archv_finished->strcompany->CurrentValue;
			$archv_finished->strcompany->CssStyle = "";
			$archv_finished->strcompany->CssClass = "";
			$archv_finished->strcompany->ViewCustomAttributes = "";

			// strdepartment
			$archv_finished->strdepartment->ViewValue = $archv_finished->strdepartment->CurrentValue;
			$archv_finished->strdepartment->CssStyle = "";
			$archv_finished->strdepartment->CssClass = "";
			$archv_finished->strdepartment->ViewCustomAttributes = "";

			// strloc
			$archv_finished->strloc->ViewValue = $archv_finished->strloc->CurrentValue;
			$archv_finished->strloc->CssStyle = "";
			$archv_finished->strloc->CssClass = "";
			$archv_finished->strloc->ViewCustomAttributes = "";

			// strposition
			$archv_finished->strposition->ViewValue = $archv_finished->strposition->CurrentValue;
			$archv_finished->strposition->CssStyle = "";
			$archv_finished->strposition->CssClass = "";
			$archv_finished->strposition->ViewCustomAttributes = "";

			// strtelephone
			$archv_finished->strtelephone->ViewValue = $archv_finished->strtelephone->CurrentValue;
			$archv_finished->strtelephone->CssStyle = "";
			$archv_finished->strtelephone->CssClass = "";
			$archv_finished->strtelephone->ViewCustomAttributes = "";

			// strcostcent
			$archv_finished->strcostcent->ViewValue = $archv_finished->strcostcent->CurrentValue;
			$archv_finished->strcostcent->CssStyle = "";
			$archv_finished->strcostcent->CssClass = "";
			$archv_finished->strcostcent->ViewCustomAttributes = "";

			// strsubject
			$archv_finished->strsubject->ViewValue = $archv_finished->strsubject->CurrentValue;
			$archv_finished->strsubject->CssStyle = "";
			$archv_finished->strsubject->CssClass = "";
			$archv_finished->strsubject->ViewCustomAttributes = "";

			// strnature
			$archv_finished->strnature->ViewValue = $archv_finished->strnature->CurrentValue;
			$archv_finished->strnature->CssStyle = "";
			$archv_finished->strnature->CssClass = "";
			$archv_finished->strnature->ViewCustomAttributes = "";

			// strdescript
			$archv_finished->strdescript->ViewValue = $archv_finished->strdescript->CurrentValue;
			$archv_finished->strdescript->CssStyle = "";
			$archv_finished->strdescript->CssClass = "";
			$archv_finished->strdescript->ViewCustomAttributes = "";

			// strarea
			$archv_finished->strarea->ViewValue = $archv_finished->strarea->CurrentValue;
			$archv_finished->strarea->CssStyle = "";
			$archv_finished->strarea->CssClass = "";
			$archv_finished->strarea->ViewCustomAttributes = "";

			// strattach
			$archv_finished->strattach->ViewValue = $archv_finished->strattach->CurrentValue;
			$archv_finished->strattach->CssStyle = "";
			$archv_finished->strattach->CssClass = "";
			$archv_finished->strattach->ViewCustomAttributes = "";

			// strpriority
			$archv_finished->strpriority->ViewValue = $archv_finished->strpriority->CurrentValue;
			$archv_finished->strpriority->CssStyle = "";
			$archv_finished->strpriority->CssClass = "";
			$archv_finished->strpriority->ViewCustomAttributes = "";

			// strduedate
			$archv_finished->strduedate->ViewValue = $archv_finished->strduedate->CurrentValue;
			$archv_finished->strduedate->CssStyle = "";
			$archv_finished->strduedate->CssClass = "";
			$archv_finished->strduedate->ViewCustomAttributes = "";

			// strstatus
			$archv_finished->strstatus->ViewValue = $archv_finished->strstatus->CurrentValue;
			$archv_finished->strstatus->CssStyle = "";
			$archv_finished->strstatus->CssClass = "";
			$archv_finished->strstatus->ViewCustomAttributes = "";

			// strlastedit
			$archv_finished->strlastedit->ViewValue = $archv_finished->strlastedit->CurrentValue;
			$archv_finished->strlastedit->CssStyle = "";
			$archv_finished->strlastedit->CssClass = "";
			$archv_finished->strlastedit->ViewCustomAttributes = "";

			// strcategory
			$archv_finished->strcategory->ViewValue = $archv_finished->strcategory->CurrentValue;
			$archv_finished->strcategory->CssStyle = "";
			$archv_finished->strcategory->CssClass = "";
			$archv_finished->strcategory->ViewCustomAttributes = "";

			// strassigned
			$archv_finished->strassigned->ViewValue = $archv_finished->strassigned->CurrentValue;
			$archv_finished->strassigned->CssStyle = "";
			$archv_finished->strassigned->CssClass = "";
			$archv_finished->strassigned->ViewCustomAttributes = "";

			// strdatecomplete
			$archv_finished->strdatecomplete->ViewValue = $archv_finished->strdatecomplete->CurrentValue;
			$archv_finished->strdatecomplete->CssStyle = "";
			$archv_finished->strdatecomplete->CssClass = "";
			$archv_finished->strdatecomplete->ViewCustomAttributes = "";

			// strwithpr
			$archv_finished->strwithpr->ViewValue = $archv_finished->strwithpr->CurrentValue;
			$archv_finished->strwithpr->CssStyle = "";
			$archv_finished->strwithpr->CssClass = "";
			$archv_finished->strwithpr->ViewCustomAttributes = "";

			// strremarks
			$archv_finished->strremarks->ViewValue = $archv_finished->strremarks->CurrentValue;
			$archv_finished->strremarks->CssStyle = "";
			$archv_finished->strremarks->CssClass = "";
			$archv_finished->strremarks->ViewCustomAttributes = "";

			// sap_num
			$archv_finished->sap_num->ViewValue = $archv_finished->sap_num->CurrentValue;
			$archv_finished->sap_num->CssStyle = "";
			$archv_finished->sap_num->CssClass = "";
			$archv_finished->sap_num->ViewCustomAttributes = "";

			// work_days
			$archv_finished->work_days->ViewValue = $archv_finished->work_days->CurrentValue;
			$archv_finished->work_days->CssStyle = "";
			$archv_finished->work_days->CssClass = "";
			$archv_finished->work_days->ViewCustomAttributes = "";

			// ID
			$archv_finished->ID->HrefValue = "";
			$archv_finished->ID->TooltipValue = "";

			// strjrfnum
			$archv_finished->strjrfnum->HrefValue = "";
			$archv_finished->strjrfnum->TooltipValue = "";

			// strquarter
			$archv_finished->strquarter->HrefValue = "";
			$archv_finished->strquarter->TooltipValue = "";

			// strmon
			$archv_finished->strmon->HrefValue = "";
			$archv_finished->strmon->TooltipValue = "";

			// stryear
			$archv_finished->stryear->HrefValue = "";
			$archv_finished->stryear->TooltipValue = "";

			// strdate
			$archv_finished->strdate->HrefValue = "";
			$archv_finished->strdate->TooltipValue = "";

			// strtime
			$archv_finished->strtime->HrefValue = "";
			$archv_finished->strtime->TooltipValue = "";

			// strusername
			$archv_finished->strusername->HrefValue = "";
			$archv_finished->strusername->TooltipValue = "";

			// strusereadd
			$archv_finished->strusereadd->HrefValue = "";
			$archv_finished->strusereadd->TooltipValue = "";

			// strcompany
			$archv_finished->strcompany->HrefValue = "";
			$archv_finished->strcompany->TooltipValue = "";

			// strdepartment
			$archv_finished->strdepartment->HrefValue = "";
			$archv_finished->strdepartment->TooltipValue = "";

			// strloc
			$archv_finished->strloc->HrefValue = "";
			$archv_finished->strloc->TooltipValue = "";

			// strposition
			$archv_finished->strposition->HrefValue = "";
			$archv_finished->strposition->TooltipValue = "";

			// strtelephone
			$archv_finished->strtelephone->HrefValue = "";
			$archv_finished->strtelephone->TooltipValue = "";

			// strcostcent
			$archv_finished->strcostcent->HrefValue = "";
			$archv_finished->strcostcent->TooltipValue = "";

			// strsubject
			$archv_finished->strsubject->HrefValue = "";
			$archv_finished->strsubject->TooltipValue = "";

			// strnature
			$archv_finished->strnature->HrefValue = "";
			$archv_finished->strnature->TooltipValue = "";

			// strdescript
			$archv_finished->strdescript->HrefValue = "";
			$archv_finished->strdescript->TooltipValue = "";

			// strarea
			$archv_finished->strarea->HrefValue = "";
			$archv_finished->strarea->TooltipValue = "";

			// strattach
			$archv_finished->strattach->HrefValue = "";
			$archv_finished->strattach->TooltipValue = "";

			// strpriority
			$archv_finished->strpriority->HrefValue = "";
			$archv_finished->strpriority->TooltipValue = "";

			// strduedate
			$archv_finished->strduedate->HrefValue = "";
			$archv_finished->strduedate->TooltipValue = "";

			// strstatus
			$archv_finished->strstatus->HrefValue = "";
			$archv_finished->strstatus->TooltipValue = "";

			// strlastedit
			$archv_finished->strlastedit->HrefValue = "";
			$archv_finished->strlastedit->TooltipValue = "";

			// strcategory
			$archv_finished->strcategory->HrefValue = "";
			$archv_finished->strcategory->TooltipValue = "";

			// strassigned
			$archv_finished->strassigned->HrefValue = "";
			$archv_finished->strassigned->TooltipValue = "";

			// strdatecomplete
			$archv_finished->strdatecomplete->HrefValue = "";
			$archv_finished->strdatecomplete->TooltipValue = "";

			// strwithpr
			$archv_finished->strwithpr->HrefValue = "";
			$archv_finished->strwithpr->TooltipValue = "";

			// strremarks
			$archv_finished->strremarks->HrefValue = "";
			$archv_finished->strremarks->TooltipValue = "";

			// sap_num
			$archv_finished->sap_num->HrefValue = "";
			$archv_finished->sap_num->TooltipValue = "";

			// work_days
			$archv_finished->work_days->HrefValue = "";
			$archv_finished->work_days->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($archv_finished->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$archv_finished->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $archv_finished;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $archv_finished->SelectRecordCount();
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
		if ($archv_finished->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($archv_finished, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($archv_finished->ID);
				$ExportDoc->ExportCaption($archv_finished->strjrfnum);
				$ExportDoc->ExportCaption($archv_finished->strquarter);
				$ExportDoc->ExportCaption($archv_finished->strmon);
				$ExportDoc->ExportCaption($archv_finished->stryear);
				$ExportDoc->ExportCaption($archv_finished->strdate);
				$ExportDoc->ExportCaption($archv_finished->strtime);
				$ExportDoc->ExportCaption($archv_finished->strusername);
				$ExportDoc->ExportCaption($archv_finished->strusereadd);
				$ExportDoc->ExportCaption($archv_finished->strcompany);
				$ExportDoc->ExportCaption($archv_finished->strdepartment);
				$ExportDoc->ExportCaption($archv_finished->strloc);
				$ExportDoc->ExportCaption($archv_finished->strposition);
				$ExportDoc->ExportCaption($archv_finished->strtelephone);
				$ExportDoc->ExportCaption($archv_finished->strcostcent);
				$ExportDoc->ExportCaption($archv_finished->strnature);
				$ExportDoc->ExportCaption($archv_finished->strarea);
				$ExportDoc->ExportCaption($archv_finished->strattach);
				$ExportDoc->ExportCaption($archv_finished->strpriority);
				$ExportDoc->ExportCaption($archv_finished->strduedate);
				$ExportDoc->ExportCaption($archv_finished->strstatus);
				$ExportDoc->ExportCaption($archv_finished->strlastedit);
				$ExportDoc->ExportCaption($archv_finished->strcategory);
				$ExportDoc->ExportCaption($archv_finished->strassigned);
				$ExportDoc->ExportCaption($archv_finished->strdatecomplete);
				$ExportDoc->ExportCaption($archv_finished->strwithpr);
				$ExportDoc->ExportCaption($archv_finished->sap_num);
				$ExportDoc->ExportCaption($archv_finished->work_days);
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
				$archv_finished->CssClass = "";
				$archv_finished->CssStyle = "";
				$archv_finished->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($archv_finished->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $archv_finished->ID->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strjrfnum', $archv_finished->strjrfnum->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strquarter', $archv_finished->strquarter->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strmon', $archv_finished->strmon->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('stryear', $archv_finished->stryear->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdate', $archv_finished->strdate->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strtime', $archv_finished->strtime->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strusername', $archv_finished->strusername->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strusereadd', $archv_finished->strusereadd->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcompany', $archv_finished->strcompany->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdepartment', $archv_finished->strdepartment->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strloc', $archv_finished->strloc->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strposition', $archv_finished->strposition->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strtelephone', $archv_finished->strtelephone->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcostcent', $archv_finished->strcostcent->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strnature', $archv_finished->strnature->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strarea', $archv_finished->strarea->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strattach', $archv_finished->strattach->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strpriority', $archv_finished->strpriority->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strduedate', $archv_finished->strduedate->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strstatus', $archv_finished->strstatus->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strlastedit', $archv_finished->strlastedit->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcategory', $archv_finished->strcategory->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strassigned', $archv_finished->strassigned->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdatecomplete', $archv_finished->strdatecomplete->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strwithpr', $archv_finished->strwithpr->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('sap_num', $archv_finished->sap_num->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('work_days', $archv_finished->work_days->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($archv_finished->ID);
					$ExportDoc->ExportField($archv_finished->strjrfnum);
					$ExportDoc->ExportField($archv_finished->strquarter);
					$ExportDoc->ExportField($archv_finished->strmon);
					$ExportDoc->ExportField($archv_finished->stryear);
					$ExportDoc->ExportField($archv_finished->strdate);
					$ExportDoc->ExportField($archv_finished->strtime);
					$ExportDoc->ExportField($archv_finished->strusername);
					$ExportDoc->ExportField($archv_finished->strusereadd);
					$ExportDoc->ExportField($archv_finished->strcompany);
					$ExportDoc->ExportField($archv_finished->strdepartment);
					$ExportDoc->ExportField($archv_finished->strloc);
					$ExportDoc->ExportField($archv_finished->strposition);
					$ExportDoc->ExportField($archv_finished->strtelephone);
					$ExportDoc->ExportField($archv_finished->strcostcent);
					$ExportDoc->ExportField($archv_finished->strnature);
					$ExportDoc->ExportField($archv_finished->strarea);
					$ExportDoc->ExportField($archv_finished->strattach);
					$ExportDoc->ExportField($archv_finished->strpriority);
					$ExportDoc->ExportField($archv_finished->strduedate);
					$ExportDoc->ExportField($archv_finished->strstatus);
					$ExportDoc->ExportField($archv_finished->strlastedit);
					$ExportDoc->ExportField($archv_finished->strcategory);
					$ExportDoc->ExportField($archv_finished->strassigned);
					$ExportDoc->ExportField($archv_finished->strdatecomplete);
					$ExportDoc->ExportField($archv_finished->strwithpr);
					$ExportDoc->ExportField($archv_finished->sap_num);
					$ExportDoc->ExportField($archv_finished->work_days);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($archv_finished->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($archv_finished->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($archv_finished->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($archv_finished->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($archv_finished->ExportReturnUrl());
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
