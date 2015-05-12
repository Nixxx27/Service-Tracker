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
<?php include "techician_tblinfo.php" ?>
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
$techician_tbl_add = new ctechician_tbl_add();
$Page =& $techician_tbl_add;

// Page init
$techician_tbl_add->Page_Init();

// Page main
$techician_tbl_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var techician_tbl_add = new ew_Page("techician_tbl_add");

// page properties
techician_tbl_add.PageID = "add"; // page ID
techician_tbl_add.FormID = "ftechician_tbladd"; // form ID
var EW_PAGE_ID = techician_tbl_add.PageID; // for backward compatibility

// extend page with ValidateForm function
techician_tbl_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
techician_tbl_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
techician_tbl_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
techician_tbl_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
techician_tbl_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
techician_tbl_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
techician_tbl_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
    <div class="col-lg-12">
    	<h3><strong><i class="fa fa-wrench"></i> TECHNICIAN <small>Add New</small></strong></h3>
    </div>
</div>
    	<hr>
<?php include('fmd-nav.php'); ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $techician_tbl->getReturnUrl() ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$techician_tbl_add->ShowMessage();
?>
<form name="ftechician_tbladd" id="ftechician_tbladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return techician_tbl_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="techician_tbl">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($techician_tbl->strtechname->Visible) { // strtechname ?>
	<tr<?php echo $techician_tbl->strtechname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Technician Name"?></td>
		<td<?php echo $techician_tbl->strtechname->CellAttributes() ?>><span id="el_strtechname">
<input type="text" name="x_strtechname" id="x_strtechname" required title="<?php echo $techician_tbl->strtechname->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $techician_tbl->strtechname->EditValue ?>"<?php echo $techician_tbl->strtechname->EditAttributes() ?>>
</span><?php echo $techician_tbl->strtechname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($techician_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $techician_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Remarks"?></td>
		<td<?php echo $techician_tbl->strremarks->CellAttributes() ?>><span id="el_strremarks">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $techician_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $techician_tbl->strremarks->EditAttributes() ?>><?php echo $techician_tbl->strremarks->EditValue ?></textarea>
</span><?php echo $techician_tbl->strremarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<br/>
<input type="submit" name="btnAction" id="btnAction" class="btn btn-primary btn-sm" value="Save Record">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$techician_tbl_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctechician_tbl_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'techician_tbl';

	// Page object name
	var $PageObjName = 'techician_tbl_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $techician_tbl;
		if ($techician_tbl->UseTokenInUrl) $PageUrl .= "t=" . $techician_tbl->TableVar . "&"; // Add page token
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
		global $objForm, $techician_tbl;
		if ($techician_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($techician_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($techician_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctechician_tbl_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (techician_tbl)
		$GLOBALS["techician_tbl"] = new ctechician_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'techician_tbl', TRUE);

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
		global $techician_tbl;

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $techician_tbl;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["ID"] != "") {
		  $techician_tbl->ID->setQueryStringValue($_GET["ID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $techician_tbl->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$techician_tbl->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $techician_tbl->CurrentAction = "C"; // Copy record
		  } else {
		    $techician_tbl->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($techician_tbl->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("techician_tbllist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$techician_tbl->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $techician_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$techician_tbl->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $techician_tbl;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $techician_tbl;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $techician_tbl;
		$techician_tbl->strtechname->setFormValue($objForm->GetValue("x_strtechname"));
		$techician_tbl->strremarks->setFormValue($objForm->GetValue("x_strremarks"));
		$techician_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $techician_tbl;
		$techician_tbl->ID->CurrentValue = $techician_tbl->ID->FormValue;
		$techician_tbl->strtechname->CurrentValue = $techician_tbl->strtechname->FormValue;
		$techician_tbl->strremarks->CurrentValue = $techician_tbl->strremarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $techician_tbl;
		$sFilter = $techician_tbl->KeyFilter();

		// Call Row Selecting event
		$techician_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$techician_tbl->CurrentFilter = $sFilter;
		$sSql = $techician_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$techician_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $techician_tbl;
		$techician_tbl->ID->setDbValue($rs->fields('ID'));
		$techician_tbl->strtechname->setDbValue($rs->fields('strtechname'));
		$techician_tbl->strremarks->setDbValue($rs->fields('strremarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $techician_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$techician_tbl->Row_Rendering();

		// Common render codes for all row types
		// strtechname

		$techician_tbl->strtechname->CellCssStyle = ""; $techician_tbl->strtechname->CellCssClass = "";
		$techician_tbl->strtechname->CellAttrs = array(); $techician_tbl->strtechname->ViewAttrs = array(); $techician_tbl->strtechname->EditAttrs = array();

		// strremarks
		$techician_tbl->strremarks->CellCssStyle = ""; $techician_tbl->strremarks->CellCssClass = "";
		$techician_tbl->strremarks->CellAttrs = array(); $techician_tbl->strremarks->ViewAttrs = array(); $techician_tbl->strremarks->EditAttrs = array();
		if ($techician_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$techician_tbl->ID->ViewValue = $techician_tbl->ID->CurrentValue;
			$techician_tbl->ID->CssStyle = "";
			$techician_tbl->ID->CssClass = "";
			$techician_tbl->ID->ViewCustomAttributes = "";

			// strtechname
			$techician_tbl->strtechname->ViewValue = $techician_tbl->strtechname->CurrentValue;
			$techician_tbl->strtechname->CssStyle = "";
			$techician_tbl->strtechname->CssClass = "";
			$techician_tbl->strtechname->ViewCustomAttributes = "";

			// strremarks
			$techician_tbl->strremarks->ViewValue = $techician_tbl->strremarks->CurrentValue;
			$techician_tbl->strremarks->CssStyle = "";
			$techician_tbl->strremarks->CssClass = "";
			$techician_tbl->strremarks->ViewCustomAttributes = "";

			// strtechname
			$techician_tbl->strtechname->HrefValue = "";
			$techician_tbl->strtechname->TooltipValue = "";

			// strremarks
			$techician_tbl->strremarks->HrefValue = "";
			$techician_tbl->strremarks->TooltipValue = "";
		} elseif ($techician_tbl->RowType == EW_ROWTYPE_ADD) { // Add row

			// strtechname
			$techician_tbl->strtechname->EditCustomAttributes = "";
			$techician_tbl->strtechname->EditValue = ew_HtmlEncode($techician_tbl->strtechname->CurrentValue);

			// strremarks
			$techician_tbl->strremarks->EditCustomAttributes = "";
			$techician_tbl->strremarks->EditValue = ew_HtmlEncode($techician_tbl->strremarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($techician_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$techician_tbl->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $techician_tbl;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $techician_tbl;
		$rsnew = array();

		// strtechname
		$techician_tbl->strtechname->SetDbValueDef($rsnew, $techician_tbl->strtechname->CurrentValue, NULL, FALSE);

		// strremarks
		$techician_tbl->strremarks->SetDbValueDef($rsnew, $techician_tbl->strremarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $techician_tbl->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($techician_tbl->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($techician_tbl->CancelMessage <> "") {
				$this->setMessage($techician_tbl->CancelMessage);
				$techician_tbl->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$techician_tbl->ID->setDbValue($conn->Insert_ID());
			$rsnew['ID'] = $techician_tbl->ID->DbValue;

			// Call Row Inserted event
			$techician_tbl->Row_Inserted($rsnew);
		}
		return $AddRow;
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
