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
$nature_tbl_search = new cnature_tbl_search();
$Page =& $nature_tbl_search;

// Page init
$nature_tbl_search->Page_Init();

// Page main
$nature_tbl_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nature_tbl_search = new ew_Page("nature_tbl_search");

// page properties
nature_tbl_search.PageID = "search"; // page ID
nature_tbl_search.FormID = "fnature_tblsearch"; // form ID
var EW_PAGE_ID = nature_tbl_search.PageID; // for backward compatibility

// extend page with validate function for search
nature_tbl_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($nature_tbl->ID->FldErrMsg()) ?>");

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
nature_tbl_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nature_tbl_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nature_tbl_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nature_tbl_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
nature_tbl_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
nature_tbl_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nature_tbl->TableCaption() ?><br><br>
<a href="<?php echo $nature_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$nature_tbl_search->ShowMessage();
?>
<form name="fnature_tblsearch" id="fnature_tblsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return nature_tbl_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="nature_tbl">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $nature_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->ID->FldCaption() ?></td>
		<td<?php echo $nature_tbl->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $nature_tbl->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $nature_tbl->ID->FldTitle() ?>" value="<?php echo $nature_tbl->ID->EditValue ?>"<?php echo $nature_tbl->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $nature_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strnature->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strnature" id="z_strnature" value="LIKE"></span></td>
		<td<?php echo $nature_tbl->strnature->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strnature" id="x_strnature" title="<?php echo $nature_tbl->strnature->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $nature_tbl->strnature->EditValue ?>"<?php echo $nature_tbl->strnature->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $nature_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strremarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strremarks" id="z_strremarks" value="LIKE"></span></td>
		<td<?php echo $nature_tbl->strremarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $nature_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $nature_tbl->strremarks->EditAttributes() ?>><?php echo $nature_tbl->strremarks->EditValue ?></textarea>
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
$nature_tbl_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cnature_tbl_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'nature_tbl';

	// Page object name
	var $PageObjName = 'nature_tbl_search';

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
	function cnature_tbl_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (nature_tbl)
		$GLOBALS["nature_tbl"] = new cnature_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $nature_tbl;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$nature_tbl->CurrentAction = $objForm->GetValue("a_search");
			switch ($nature_tbl->CurrentAction) {
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
						$sSrchStr = $nature_tbl->UrlParm($sSrchStr);
						$this->Page_Terminate("nature_tbllist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$nature_tbl->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $nature_tbl;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $nature_tbl->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $nature_tbl->strnature); // strnature
	$this->BuildSearchUrl($sSrchUrl, $nature_tbl->strremarks); // strremarks
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
		global $objForm, $nature_tbl;

		// Load search values
		// ID

		$nature_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$nature_tbl->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// strnature
		$nature_tbl->strnature->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strnature"));
		$nature_tbl->strnature->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strnature");

		// strremarks
		$nature_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strremarks"));
		$nature_tbl->strremarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strremarks");
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
		} elseif ($nature_tbl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$nature_tbl->ID->EditCustomAttributes = "";
			$nature_tbl->ID->EditValue = ew_HtmlEncode($nature_tbl->ID->AdvancedSearch->SearchValue);

			// strnature
			$nature_tbl->strnature->EditCustomAttributes = "";
			$nature_tbl->strnature->EditValue = ew_HtmlEncode($nature_tbl->strnature->AdvancedSearch->SearchValue);

			// strremarks
			$nature_tbl->strremarks->EditCustomAttributes = "";
			$nature_tbl->strremarks->EditValue = ew_HtmlEncode($nature_tbl->strremarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($nature_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nature_tbl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $nature_tbl;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($nature_tbl->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $nature_tbl->ID->FldErrMsg();
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
		global $nature_tbl;
		$nature_tbl->ID->AdvancedSearch->SearchValue = $nature_tbl->getAdvancedSearch("x_ID");
		$nature_tbl->strnature->AdvancedSearch->SearchValue = $nature_tbl->getAdvancedSearch("x_strnature");
		$nature_tbl->strremarks->AdvancedSearch->SearchValue = $nature_tbl->getAdvancedSearch("x_strremarks");
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
