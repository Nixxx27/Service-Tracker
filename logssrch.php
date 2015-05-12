<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "logsinfo.php" ?>
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
$logs_search = new clogs_search();
$Page =& $logs_search;

// Page init
$logs_search->Page_Init();

// Page main
$logs_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logs_search = new ew_Page("logs_search");

// page properties
logs_search.PageID = "search"; // page ID
logs_search.FormID = "flogssearch"; // form ID
var EW_PAGE_ID = logs_search.PageID; // for backward compatibility

// extend page with validate function for search
logs_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($logs->ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_strdate"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($logs->strdate->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
logs_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logs_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logs_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logs_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logs_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
logs_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logs->TableCaption() ?><br><br>
<a href="<?php echo $logs->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$logs_search->ShowMessage();
?>
<form name="flogssearch" id="flogssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logs_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logs">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logs->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $logs->ID->FldCaption() ?></td>
		<td<?php echo $logs->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $logs->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $logs->ID->FldTitle() ?>" value="<?php echo $logs->ID->EditValue ?>"<?php echo $logs->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $logs->struname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $logs->struname->FldCaption() ?></td>
		<td<?php echo $logs->struname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_struname" id="z_struname" value="LIKE"></span></td>
		<td<?php echo $logs->struname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_struname" id="x_struname" title="<?php echo $logs->struname->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $logs->struname->EditValue ?>"<?php echo $logs->struname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $logs->strdate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $logs->strdate->FldCaption() ?></td>
		<td<?php echo $logs->strdate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_strdate" id="z_strdate" value="="></span></td>
		<td<?php echo $logs->strdate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdate" id="x_strdate" title="<?php echo $logs->strdate->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $logs->strdate->EditValue ?>"<?php echo $logs->strdate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $logs->straction->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $logs->straction->FldCaption() ?></td>
		<td<?php echo $logs->straction->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_straction" id="z_straction" value="LIKE"></span></td>
		<td<?php echo $logs->straction->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_straction" id="x_straction" title="<?php echo $logs->straction->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $logs->straction->EditValue ?>"<?php echo $logs->straction->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$logs_search->Page_Terminate();
?>
<?php

//
// Page class
//
class clogs_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'logs';

	// Page object name
	var $PageObjName = 'logs_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logs;
		if ($logs->UseTokenInUrl) $PageUrl .= "t=" . $logs->TableVar . "&"; // Add page token
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
		global $objForm, $logs;
		if ($logs->UseTokenInUrl) {
			if ($objForm)
				return ($logs->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logs->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function clogs_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (logs)
		$GLOBALS["logs"] = new clogs();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logs', TRUE);

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
		global $logs;

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $logs;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logs->CurrentAction = $objForm->GetValue("a_search");
			switch ($logs->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $logs->UrlParm($sSrchStr);
						$this->Page_Terminate("logslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logs->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logs;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logs->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $logs->struname); // struname
	$this->BuildSearchUrl($sSrchUrl, $logs->strdate); // strdate
	$this->BuildSearchUrl($sSrchUrl, $logs->straction); // straction
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logs;

		// Load search values
		// ID

		$logs->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$logs->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// struname
		$logs->struname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_struname"));
		$logs->struname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_struname");

		// strdate
		$logs->strdate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdate"));
		$logs->strdate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdate");

		// straction
		$logs->straction->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_straction"));
		$logs->straction->AdvancedSearch->SearchOperator = $objForm->GetValue("z_straction");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $logs;

		// Initialize URLs
		// Call Row_Rendering event

		$logs->Row_Rendering();

		// Common render codes for all row types
		// ID

		$logs->ID->CellCssStyle = ""; $logs->ID->CellCssClass = "";
		$logs->ID->CellAttrs = array(); $logs->ID->ViewAttrs = array(); $logs->ID->EditAttrs = array();

		// struname
		$logs->struname->CellCssStyle = ""; $logs->struname->CellCssClass = "";
		$logs->struname->CellAttrs = array(); $logs->struname->ViewAttrs = array(); $logs->struname->EditAttrs = array();

		// strdate
		$logs->strdate->CellCssStyle = ""; $logs->strdate->CellCssClass = "";
		$logs->strdate->CellAttrs = array(); $logs->strdate->ViewAttrs = array(); $logs->strdate->EditAttrs = array();

		// straction
		$logs->straction->CellCssStyle = ""; $logs->straction->CellCssClass = "";
		$logs->straction->CellAttrs = array(); $logs->straction->ViewAttrs = array(); $logs->straction->EditAttrs = array();
		if ($logs->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$logs->ID->ViewValue = $logs->ID->CurrentValue;
			$logs->ID->CssStyle = "";
			$logs->ID->CssClass = "";
			$logs->ID->ViewCustomAttributes = "";

			// struname
			$logs->struname->ViewValue = $logs->struname->CurrentValue;
			$logs->struname->CssStyle = "";
			$logs->struname->CssClass = "";
			$logs->struname->ViewCustomAttributes = "";

			// strdate
			$logs->strdate->ViewValue = $logs->strdate->CurrentValue;
			$logs->strdate->CssStyle = "";
			$logs->strdate->CssClass = "";
			$logs->strdate->ViewCustomAttributes = "";

			// straction
			$logs->straction->ViewValue = $logs->straction->CurrentValue;
			$logs->straction->CssStyle = "";
			$logs->straction->CssClass = "";
			$logs->straction->ViewCustomAttributes = "";

			// ID
			$logs->ID->HrefValue = "";
			$logs->ID->TooltipValue = "";

			// struname
			$logs->struname->HrefValue = "";
			$logs->struname->TooltipValue = "";

			// strdate
			$logs->strdate->HrefValue = "";
			$logs->strdate->TooltipValue = "";

			// straction
			$logs->straction->HrefValue = "";
			$logs->straction->TooltipValue = "";
		} elseif ($logs->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$logs->ID->EditCustomAttributes = "";
			$logs->ID->EditValue = ew_HtmlEncode($logs->ID->AdvancedSearch->SearchValue);

			// struname
			$logs->struname->EditCustomAttributes = "";
			$logs->struname->EditValue = ew_HtmlEncode($logs->struname->AdvancedSearch->SearchValue);

			// strdate
			$logs->strdate->EditCustomAttributes = "";
			$logs->strdate->EditValue = ew_HtmlEncode(ew_UnFormatDateTime($logs->strdate->AdvancedSearch->SearchValue, 0));

			// straction
			$logs->straction->EditCustomAttributes = "";
			$logs->straction->EditValue = ew_HtmlEncode($logs->straction->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($logs->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$logs->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logs;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($logs->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $logs->ID->FldErrMsg();
		}
		if (!ew_CheckDate($logs->strdate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $logs->strdate->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $logs;
		$logs->ID->AdvancedSearch->SearchValue = $logs->getAdvancedSearch("x_ID");
		$logs->struname->AdvancedSearch->SearchValue = $logs->getAdvancedSearch("x_struname");
		$logs->strdate->AdvancedSearch->SearchValue = $logs->getAdvancedSearch("x_strdate");
		$logs->straction->AdvancedSearch->SearchValue = $logs->getAdvancedSearch("x_straction");
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
