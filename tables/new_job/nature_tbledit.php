<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "nature_tblinfo.php" ?>
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
$nature_tbl_edit = new cnature_tbl_edit();
$Page =& $nature_tbl_edit;

// Page init
$nature_tbl_edit->Page_Init();

// Page main
$nature_tbl_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nature_tbl_edit = new ew_Page("nature_tbl_edit");

// page properties
nature_tbl_edit.PageID = "edit"; // page ID
nature_tbl_edit.FormID = "fnature_tbledit"; // form ID
var EW_PAGE_ID = nature_tbl_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
nature_tbl_edit.ValidateForm = function(fobj) {
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
nature_tbl_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nature_tbl_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nature_tbl_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nature_tbl_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
nature_tbl_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
nature_tbl_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nature_tbl->TableCaption() ?><br><br>
<a href="<?php echo $nature_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$nature_tbl_edit->ShowMessage();
?>
<form name="fnature_tbledit" id="fnature_tbledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return nature_tbl_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="nature_tbl">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($nature_tbl->ID->Visible) { // ID ?>
	<tr<?php echo $nature_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->ID->FldCaption() ?></td>
		<td<?php echo $nature_tbl->ID->CellAttributes() ?>><span id="el_ID">
<div<?php echo $nature_tbl->ID->ViewAttributes() ?>><?php echo $nature_tbl->ID->EditValue ?></div><input type="hidden" name="x_ID" id="x_ID" value="<?php echo ew_HtmlEncode($nature_tbl->ID->CurrentValue) ?>">
</span><?php echo $nature_tbl->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nature_tbl->strnature->Visible) { // strnature ?>
	<tr<?php echo $nature_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strnature->CellAttributes() ?>><span id="el_strnature">
<input type="text" name="x_strnature" id="x_strnature" title="<?php echo $nature_tbl->strnature->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $nature_tbl->strnature->EditValue ?>"<?php echo $nature_tbl->strnature->EditAttributes() ?>>
</span><?php echo $nature_tbl->strnature->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($nature_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $nature_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strremarks->CellAttributes() ?>><span id="el_strremarks">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $nature_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $nature_tbl->strremarks->EditAttributes() ?>><?php echo $nature_tbl->strremarks->EditValue ?></textarea>
</span><?php echo $nature_tbl->strremarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$nature_tbl_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cnature_tbl_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'nature_tbl';

	// Page object name
	var $PageObjName = 'nature_tbl_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nature_tbl;
		if ($nature_tbl->UseTokenInUrl) $PageUrl .= "t=" . $nature_tbl->TableVar . "&"; // Add page token
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
		global $objForm, $nature_tbl;
		if ($nature_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($nature_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nature_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnature_tbl_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (nature_tbl)
		$GLOBALS["nature_tbl"] = new cnature_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nature_tbl', TRUE);

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
		global $nature_tbl;

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
		global $objForm, $Language, $gsFormError, $nature_tbl;

		// Load key from QueryString
		if (@$_GET["ID"] <> "")
			$nature_tbl->ID->setQueryStringValue($_GET["ID"]);
		if (@$_POST["a_edit"] <> "") {
			$nature_tbl->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$nature_tbl->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$nature_tbl->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$nature_tbl->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($nature_tbl->ID->CurrentValue == "")
			$this->Page_Terminate("nature_tbllist.php"); // Invalid key, return to list
		switch ($nature_tbl->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("nature_tbllist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$nature_tbl->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $nature_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$nature_tbl->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$nature_tbl->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $nature_tbl;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $nature_tbl;
		$nature_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
		$nature_tbl->strnature->setFormValue($objForm->GetValue("x_strnature"));
		$nature_tbl->strremarks->setFormValue($objForm->GetValue("x_strremarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $nature_tbl;
		$this->LoadRow();
		$nature_tbl->ID->CurrentValue = $nature_tbl->ID->FormValue;
		$nature_tbl->strnature->CurrentValue = $nature_tbl->strnature->FormValue;
		$nature_tbl->strremarks->CurrentValue = $nature_tbl->strremarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nature_tbl;
		$sFilter = $nature_tbl->KeyFilter();

		// Call Row Selecting event
		$nature_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$nature_tbl->CurrentFilter = $sFilter;
		$sSql = $nature_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$nature_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $nature_tbl;
		$nature_tbl->ID->setDbValue($rs->fields('ID'));
		$nature_tbl->strnature->setDbValue($rs->fields('strnature'));
		$nature_tbl->strremarks->setDbValue($rs->fields('strremarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $nature_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$nature_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$nature_tbl->ID->CellCssStyle = ""; $nature_tbl->ID->CellCssClass = "";
		$nature_tbl->ID->CellAttrs = array(); $nature_tbl->ID->ViewAttrs = array(); $nature_tbl->ID->EditAttrs = array();

		// strnature
		$nature_tbl->strnature->CellCssStyle = ""; $nature_tbl->strnature->CellCssClass = "";
		$nature_tbl->strnature->CellAttrs = array(); $nature_tbl->strnature->ViewAttrs = array(); $nature_tbl->strnature->EditAttrs = array();

		// strremarks
		$nature_tbl->strremarks->CellCssStyle = ""; $nature_tbl->strremarks->CellCssClass = "";
		$nature_tbl->strremarks->CellAttrs = array(); $nature_tbl->strremarks->ViewAttrs = array(); $nature_tbl->strremarks->EditAttrs = array();
		if ($nature_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$nature_tbl->ID->ViewValue = $nature_tbl->ID->CurrentValue;
			$nature_tbl->ID->CssStyle = "";
			$nature_tbl->ID->CssClass = "";
			$nature_tbl->ID->ViewCustomAttributes = "";

			// strnature
			$nature_tbl->strnature->ViewValue = $nature_tbl->strnature->CurrentValue;
			$nature_tbl->strnature->CssStyle = "";
			$nature_tbl->strnature->CssClass = "";
			$nature_tbl->strnature->ViewCustomAttributes = "";

			// strremarks
			$nature_tbl->strremarks->ViewValue = $nature_tbl->strremarks->CurrentValue;
			$nature_tbl->strremarks->CssStyle = "";
			$nature_tbl->strremarks->CssClass = "";
			$nature_tbl->strremarks->ViewCustomAttributes = "";

			// ID
			$nature_tbl->ID->HrefValue = "";
			$nature_tbl->ID->TooltipValue = "";

			// strnature
			$nature_tbl->strnature->HrefValue = "";
			$nature_tbl->strnature->TooltipValue = "";

			// strremarks
			$nature_tbl->strremarks->HrefValue = "";
			$nature_tbl->strremarks->TooltipValue = "";
		} elseif ($nature_tbl->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ID
			$nature_tbl->ID->EditCustomAttributes = "";
			$nature_tbl->ID->EditValue = $nature_tbl->ID->CurrentValue;
			$nature_tbl->ID->CssStyle = "";
			$nature_tbl->ID->CssClass = "";
			$nature_tbl->ID->ViewCustomAttributes = "";

			// strnature
			$nature_tbl->strnature->EditCustomAttributes = "";
			$nature_tbl->strnature->EditValue = ew_HtmlEncode($nature_tbl->strnature->CurrentValue);

			// strremarks
			$nature_tbl->strremarks->EditCustomAttributes = "";
			$nature_tbl->strremarks->EditValue = ew_HtmlEncode($nature_tbl->strremarks->CurrentValue);

			// Edit refer script
			// ID

			$nature_tbl->ID->HrefValue = "";

			// strnature
			$nature_tbl->strnature->HrefValue = "";

			// strremarks
			$nature_tbl->strremarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($nature_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nature_tbl->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $nature_tbl;

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $nature_tbl;
		$sFilter = $nature_tbl->KeyFilter();
		$nature_tbl->CurrentFilter = $sFilter;
		$sSql = $nature_tbl->SQL();
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

			// strnature
			$nature_tbl->strnature->SetDbValueDef($rsnew, $nature_tbl->strnature->CurrentValue, NULL, FALSE);

			// strremarks
			$nature_tbl->strremarks->SetDbValueDef($rsnew, $nature_tbl->strremarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $nature_tbl->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($nature_tbl->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($nature_tbl->CancelMessage <> "") {
					$this->setMessage($nature_tbl->CancelMessage);
					$nature_tbl->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$nature_tbl->Row_Updated($rsold, $rsnew);
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
