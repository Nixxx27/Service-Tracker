<?php 
include('copyright.php'); 
include('sec_acess.php');
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
    		<div class="col-lg-12">
    			<h3><strong><i class="fa fa-file-text"></i> View Details</strong></h3>
    		</div>
    	</div>
    	
<?php include('fmd-nav.php'); ?>

<hr>

<?php if ($jrf_tbl->Export == "") { ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $jrf_tbl_view->ListUrl ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">
<a href="<?php echo $jrf_tbl_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_view->ShowMessage();
?>
    <!--View  jrf_tbl logs -->
        <?php
            require("dbc.php");
            $jrfID_NUM = $jrf_tbl->ID->ViewValue;

        //Employee ID number IN jrf_tbl
        $viewQuery = 
        "SELECT * FROM jrf_tbl
        WHERE ID='$jrfID_NUM'
         ORDER BY ID DESC";

        $resultQuery =mysql_query($viewQuery); 

        //retrieve data from jrf_tbl DB
            while($resultQuery = mysql_fetch_array($resultQuery)){
                $ID= $resultQuery['ID'];
                $strjrfnum= $resultQuery['strjrfnum'];
                $strquarter= $resultQuery['strquarter'];
                $strmon= $resultQuery['strmon'];
                $stryear  = $resultQuery['stryear'];
                $strdate= $resultQuery['strdate'];
                $strtime= $resultQuery['strtime'];
                $strusername= $resultQuery['strusername'];
                $strusereadd= $resultQuery['strusereadd'];
                $strcompany= $resultQuery['strcompany'];
                $strdepartment= $resultQuery['strdepartment'];
                $strloc= $resultQuery['strloc'];
                $strposition= $resultQuery['strposition'];
                $strtelephone= $resultQuery['strtelephone'];
                $strcostcent= $resultQuery['strcostcent'];
                $strsubject= $resultQuery['strsubject'];
                $strnature= $resultQuery['strnature'];
                $strdescript= $resultQuery['strdescript'];
                $strarea= $resultQuery['strarea'];
                $strattach= $resultQuery['strattach'];
                $strpriority= $resultQuery['strpriority'];
                $strduedate= $resultQuery['strduedate'];
                $strstatus= $resultQuery['strstatus'];
                $strlastedit= $resultQuery['strlastedit'];
                $strcategory= $resultQuery['strcategory'];
                $strassigned= $resultQuery['strassigned'];
                $strremarks= $resultQuery['strremarks'];
                $strdatecomplete= $resultQuery['strdatecomplete'];


            };

                
            ?>


<form name="form_view_new_job" id="form_view_new_job">

<div class="row">
	<div class="col-md-8 col-sm-8">
		<table align="left">
			<tr>
				<td>
					<h3><strong>STATUS: <?php echo strtoupper($strstatus); ?></strong></h3>
				</td>
			</tr>
		</table>
	</div>
</div>

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
                    <td><label><i class="fa fa-calendar"></i> Received Date</label></td>
                    <td><p class="textboxleft"><?php echo $strdate . " " . $strtime; ?></p></td>
                </tr>

                 <tr>
                    <td><label><i class="fa fa-info-circle"></i> Due Date:</label></td>
                    <td><p class="textboxleft"><?php echo $strduedate . " " . $strtime; ; ?></p></td>
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
                    <td><label><i class="fa fa-phone-square"></i> Cost Center #:</label></td>
                    <td><p class="textboxleft"><?php echo $strcostcent; ?></td>
                </tr>
			</table>
        </fieldset>
	</div>


	<div class="col-md-10 col-sm-10">
		<br/>
		<fieldset>
            <legend><i class="fa fa-info-circle"></i> DESCRIPTION:</legend>
            <table border="0">
            	<tr>
                   <td>
                   		<textarea style="border:0px;background-color:#ddd;color:black" class="form-control" rows="6" readonly cols="150px"><?php echo ucfirst($strdescript); ?></textarea>
                   </td>
                </tr>
                
            </table>
        </fieldset>
	</div>

	<div class="col-md-10 col-sm-10">
		<table>
			<tr>
				<td>
					<label>Attachment:</label>
				</td>
				<td>abc.doc</td>
			</tr>
		</table>
	</div> 	
</div><!--div row-->

<div class="row">
	<div class="col-md-6 col-sm-6">
		<fieldset>
            <legend><i class="fa fa-pencil-square-o"></i> PLEASE COMPLETE FIELDS</legend>
            <table border="0">
            	<tr>
                    <td><label><i class="fa fa-wrench"></i> PRIORITY:</label>
                    	<p class="textboxleft" style="font-weight:bold;text-align:center"><?php echo strtoupper($strpriority); ?></p>
                    </td>
                
                    <td><label><i class="fa fa-info-circle"></i> CATEGORY:</label>
         				<p class="textboxleft" style="font-weight:bold;text-align:center"><?php echo strtoupper($strcategory); ?></p>
         			</td>
                </tr>

                <tr>
                    <td><label><i class="fa fa-wrench"></i> ASSIGNED TO:</label>
                    	<p class="textboxleft" style="font-weight:bold;text-align:center"><?php echo strtoupper($strassigned); ?></p>
                    </td>
                
                    <td><label><i class="fa fa-info-circle"></i> STATUS:</label>
         				<p class="textboxleft" style="font-weight:bold;text-align:center"><?php echo strtoupper($strstatus); ?></p>
         			</td>
                </tr>
                <tr>
                	<td colspan="4">
                		<label> REMARKS</label>
        				<textarea class="form-control" rows="3" cols="150px"></textarea>
                	</td>
                </tr>
                <tr>
                	<td>
					<label><i class="fa fa-calendar"></i> ASSIGNED TO:</label>
                    	<select name="strnature" class="form-control" required="required">
			                <option>--Please Select</option>
			                <option>Mechanical</option>
			                <option>Electrical</option>
			            </select>
			        </td>
			        <td colspan="2" align="right">
			        	<input type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to submit and proceed?')" name="submit_request" value="Submit Request">
            			<button type="button" class="btn btn-primary" onclick="clearForm();"><i class="fa fa-times"></i> Clear</button>
            		</td>
                </tr>

			</table>
        </fieldset>
	</div>

</div><!--ROW--> 


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
		$jrf_tbl->strduedate->setDbValue($rs->fields('strduedate'));
		$jrf_tbl->strarea->setDbValue($rs->fields('strarea'));
		$jrf_tbl->strpriority->setDbValue($rs->fields('strpriority'));
		$jrf_tbl->strstatus->setDbValue($rs->fields('strstatus'));
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

		// strduedate
		$jrf_tbl->strduedate->CellCssStyle = ""; $jrf_tbl->strduedate->CellCssClass = "";
		$jrf_tbl->strduedate->CellAttrs = array(); $jrf_tbl->strduedate->ViewAttrs = array(); $jrf_tbl->strduedate->EditAttrs = array();

		// strarea
		$jrf_tbl->strarea->CellCssStyle = ""; $jrf_tbl->strarea->CellCssClass = "";
		$jrf_tbl->strarea->CellAttrs = array(); $jrf_tbl->strarea->ViewAttrs = array(); $jrf_tbl->strarea->EditAttrs = array();

		// strpriority
		$jrf_tbl->strpriority->CellCssStyle = ""; $jrf_tbl->strpriority->CellCssClass = "";
		$jrf_tbl->strpriority->CellAttrs = array(); $jrf_tbl->strpriority->ViewAttrs = array(); $jrf_tbl->strpriority->EditAttrs = array();

		// strstatus
		$jrf_tbl->strstatus->CellCssStyle = ""; $jrf_tbl->strstatus->CellCssClass = "";
		$jrf_tbl->strstatus->CellAttrs = array(); $jrf_tbl->strstatus->ViewAttrs = array(); $jrf_tbl->strstatus->EditAttrs = array();
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

			// strduedate
			$jrf_tbl->strduedate->ViewValue = $jrf_tbl->strduedate->CurrentValue;
			$jrf_tbl->strduedate->CssStyle = "";
			$jrf_tbl->strduedate->CssClass = "";
			$jrf_tbl->strduedate->ViewCustomAttributes = "";

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

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";
			$jrf_tbl->strduedate->TooltipValue = "";

			// strarea
			$jrf_tbl->strarea->HrefValue = "";
			$jrf_tbl->strarea->TooltipValue = "";

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";
			$jrf_tbl->strpriority->TooltipValue = "";

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";
			$jrf_tbl->strstatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
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