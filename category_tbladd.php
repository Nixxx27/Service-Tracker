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
<?php include "category_tblinfo.php" ?>
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
$category_tbl_add = new ccategory_tbl_add();
$Page =& $category_tbl_add;

// Page init
$category_tbl_add->Page_Init();

// Page main
$category_tbl_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var category_tbl_add = new ew_Page("category_tbl_add");

// page properties
category_tbl_add.PageID = "add"; // page ID
category_tbl_add.FormID = "fcategory_tbladd"; // form ID
var EW_PAGE_ID = category_tbl_add.PageID; // for backward compatibility

// extend page with ValidateForm function
category_tbl_add.ValidateForm = function(fobj) {
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
category_tbl_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
category_tbl_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
category_tbl_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_tbl_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
category_tbl_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
category_tbl_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
    	<h3><strong><i class="fa fa-wrench"></i> JOB CATEGORIES <small>View All Records</small></strong></h3>
    </div>
</div>
    	<hr>
<?php include('fmd-nav.php'); ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $category_tbl->getReturnUrl() ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$category_tbl_add->ShowMessage();
?>
<form name="fcategory_tbladd" id="fcategory_tbladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return category_tbl_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="category_tbl">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($category_tbl->strcategory->Visible) { // strcategory ?>
	<tr<?php echo $category_tbl->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Category"?></td>
		<td<?php echo $category_tbl->strcategory->CellAttributes() ?>><span id="el_strcategory">
<input type="text" name="x_strcategory" id="x_strcategory" title="<?php echo $category_tbl->strcategory->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $category_tbl->strcategory->EditValue ?>"<?php echo $category_tbl->strcategory->EditAttributes() ?>>
</span><?php echo $category_tbl->strcategory->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $category_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Remarks"?></td>
		<td<?php echo $category_tbl->strremarks->CellAttributes() ?>><span id="el_strremarks">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $category_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $category_tbl->strremarks->EditAttributes() ?>><?php echo $category_tbl->strremarks->EditValue ?></textarea>
</span><?php echo $category_tbl->strremarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<br>
<input type="submit" name="btnAction" class="btn btn-primary btn-sm " id="btnAction" value="Add Record">
</form>
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
$category_tbl_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccategory_tbl_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'category_tbl';

	// Page object name
	var $PageObjName = 'category_tbl_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $category_tbl;
		if ($category_tbl->UseTokenInUrl) $PageUrl .= "t=" . $category_tbl->TableVar . "&"; // Add page token
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
		global $objForm, $category_tbl;
		if ($category_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($category_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($category_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccategory_tbl_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (category_tbl)
		$GLOBALS["category_tbl"] = new ccategory_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category_tbl', TRUE);

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
		global $category_tbl;

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
		global $objForm, $Language, $gsFormError, $category_tbl;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["ID"] != "") {
		  $category_tbl->ID->setQueryStringValue($_GET["ID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $category_tbl->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$category_tbl->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $category_tbl->CurrentAction = "C"; // Copy record
		  } else {
		    $category_tbl->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($category_tbl->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("category_tbllist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$category_tbl->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $category_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$category_tbl->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $category_tbl;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $category_tbl;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $category_tbl;
		$category_tbl->strcategory->setFormValue($objForm->GetValue("x_strcategory"));
		$category_tbl->strremarks->setFormValue($objForm->GetValue("x_strremarks"));
		$category_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $category_tbl;
		$category_tbl->ID->CurrentValue = $category_tbl->ID->FormValue;
		$category_tbl->strcategory->CurrentValue = $category_tbl->strcategory->FormValue;
		$category_tbl->strremarks->CurrentValue = $category_tbl->strremarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $category_tbl;
		$sFilter = $category_tbl->KeyFilter();

		// Call Row Selecting event
		$category_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$category_tbl->CurrentFilter = $sFilter;
		$sSql = $category_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$category_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $category_tbl;
		$category_tbl->ID->setDbValue($rs->fields('ID'));
		$category_tbl->strcategory->setDbValue($rs->fields('strcategory'));
		$category_tbl->strremarks->setDbValue($rs->fields('strremarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $category_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$category_tbl->Row_Rendering();

		// Common render codes for all row types
		// strcategory

		$category_tbl->strcategory->CellCssStyle = ""; $category_tbl->strcategory->CellCssClass = "";
		$category_tbl->strcategory->CellAttrs = array(); $category_tbl->strcategory->ViewAttrs = array(); $category_tbl->strcategory->EditAttrs = array();

		// strremarks
		$category_tbl->strremarks->CellCssStyle = ""; $category_tbl->strremarks->CellCssClass = "";
		$category_tbl->strremarks->CellAttrs = array(); $category_tbl->strremarks->ViewAttrs = array(); $category_tbl->strremarks->EditAttrs = array();
		if ($category_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$category_tbl->ID->ViewValue = $category_tbl->ID->CurrentValue;
			$category_tbl->ID->CssStyle = "";
			$category_tbl->ID->CssClass = "";
			$category_tbl->ID->ViewCustomAttributes = "";

			// strcategory
			$category_tbl->strcategory->ViewValue = $category_tbl->strcategory->CurrentValue;
			$category_tbl->strcategory->CssStyle = "";
			$category_tbl->strcategory->CssClass = "";
			$category_tbl->strcategory->ViewCustomAttributes = "";

			// strremarks
			$category_tbl->strremarks->ViewValue = $category_tbl->strremarks->CurrentValue;
			$category_tbl->strremarks->CssStyle = "";
			$category_tbl->strremarks->CssClass = "";
			$category_tbl->strremarks->ViewCustomAttributes = "";

			// strcategory
			$category_tbl->strcategory->HrefValue = "";
			$category_tbl->strcategory->TooltipValue = "";

			// strremarks
			$category_tbl->strremarks->HrefValue = "";
			$category_tbl->strremarks->TooltipValue = "";
		} elseif ($category_tbl->RowType == EW_ROWTYPE_ADD) { // Add row

			// strcategory
			$category_tbl->strcategory->EditCustomAttributes = "";
			$category_tbl->strcategory->EditValue = ew_HtmlEncode($category_tbl->strcategory->CurrentValue);

			// strremarks
			$category_tbl->strremarks->EditCustomAttributes = "";
			$category_tbl->strremarks->EditValue = ew_HtmlEncode($category_tbl->strremarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($category_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$category_tbl->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $category_tbl;

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
		global $conn, $Language, $Security, $category_tbl;
		$rsnew = array();

		// strcategory
		$category_tbl->strcategory->SetDbValueDef($rsnew, $category_tbl->strcategory->CurrentValue, NULL, FALSE);

		// strremarks
		$category_tbl->strremarks->SetDbValueDef($rsnew, $category_tbl->strremarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $category_tbl->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($category_tbl->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($category_tbl->CancelMessage <> "") {
				$this->setMessage($category_tbl->CancelMessage);
				$category_tbl->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$category_tbl->ID->setDbValue($conn->Insert_ID());
			$rsnew['ID'] = $category_tbl->ID->DbValue;

			// Call Row Inserted event
			$category_tbl->Row_Inserted($rsnew);
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
