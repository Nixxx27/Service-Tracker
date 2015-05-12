<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
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
$category_tbl_search = new ccategory_tbl_search();
$Page =& $category_tbl_search;

// Page init
$category_tbl_search->Page_Init();

// Page main
$category_tbl_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var category_tbl_search = new ew_Page("category_tbl_search");

// page properties
category_tbl_search.PageID = "search"; // page ID
category_tbl_search.FormID = "fcategory_tblsearch"; // form ID
var EW_PAGE_ID = category_tbl_search.PageID; // for backward compatibility

// extend page with validate function for search
category_tbl_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($category_tbl->ID->FldErrMsg()) ?>");

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
category_tbl_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
category_tbl_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
category_tbl_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_tbl_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
category_tbl_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
category_tbl_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $category_tbl->TableCaption() ?><br><br>
<a href="<?php echo $category_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$category_tbl_search->ShowMessage();
?>
<form name="fcategory_tblsearch" id="fcategory_tblsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return category_tbl_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="category_tbl">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $category_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $category_tbl->ID->FldCaption() ?></td>
		<td<?php echo $category_tbl->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $category_tbl->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $category_tbl->ID->FldTitle() ?>" value="<?php echo $category_tbl->ID->EditValue ?>"<?php echo $category_tbl->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $category_tbl->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $category_tbl->strcategory->FldCaption() ?></td>
		<td<?php echo $category_tbl->strcategory->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strcategory" id="z_strcategory" value="LIKE"></span></td>
		<td<?php echo $category_tbl->strcategory->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strcategory" id="x_strcategory" title="<?php echo $category_tbl->strcategory->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $category_tbl->strcategory->EditValue ?>"<?php echo $category_tbl->strcategory->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $category_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $category_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $category_tbl->strremarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strremarks" id="z_strremarks" value="LIKE"></span></td>
		<td<?php echo $category_tbl->strremarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $category_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $category_tbl->strremarks->EditAttributes() ?>><?php echo $category_tbl->strremarks->EditValue ?></textarea>
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
$category_tbl_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ccategory_tbl_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'category_tbl';

	// Page object name
	var $PageObjName = 'category_tbl_search';

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
	function ccategory_tbl_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (category_tbl)
		$GLOBALS["category_tbl"] = new ccategory_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $category_tbl;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$category_tbl->CurrentAction = $objForm->GetValue("a_search");
			switch ($category_tbl->CurrentAction) {
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
						$sSrchStr = $category_tbl->UrlParm($sSrchStr);
						$this->Page_Terminate("category_tbllist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$category_tbl->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $category_tbl;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $category_tbl->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $category_tbl->strcategory); // strcategory
	$this->BuildSearchUrl($sSrchUrl, $category_tbl->strremarks); // strremarks
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
		global $objForm, $category_tbl;

		// Load search values
		// ID

		$category_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$category_tbl->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// strcategory
		$category_tbl->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcategory"));
		$category_tbl->strcategory->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcategory");

		// strremarks
		$category_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strremarks"));
		$category_tbl->strremarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strremarks");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $category_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$category_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$category_tbl->ID->CellCssStyle = ""; $category_tbl->ID->CellCssClass = "";
		$category_tbl->ID->CellAttrs = array(); $category_tbl->ID->ViewAttrs = array(); $category_tbl->ID->EditAttrs = array();

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

			// ID
			$category_tbl->ID->HrefValue = "";
			$category_tbl->ID->TooltipValue = "";

			// strcategory
			$category_tbl->strcategory->HrefValue = "";
			$category_tbl->strcategory->TooltipValue = "";

			// strremarks
			$category_tbl->strremarks->HrefValue = "";
			$category_tbl->strremarks->TooltipValue = "";
		} elseif ($category_tbl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$category_tbl->ID->EditCustomAttributes = "";
			$category_tbl->ID->EditValue = ew_HtmlEncode($category_tbl->ID->AdvancedSearch->SearchValue);

			// strcategory
			$category_tbl->strcategory->EditCustomAttributes = "";
			$category_tbl->strcategory->EditValue = ew_HtmlEncode($category_tbl->strcategory->AdvancedSearch->SearchValue);

			// strremarks
			$category_tbl->strremarks->EditCustomAttributes = "";
			$category_tbl->strremarks->EditValue = ew_HtmlEncode($category_tbl->strremarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($category_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$category_tbl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $category_tbl;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($category_tbl->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $category_tbl->ID->FldErrMsg();
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
		global $category_tbl;
		$category_tbl->ID->AdvancedSearch->SearchValue = $category_tbl->getAdvancedSearch("x_ID");
		$category_tbl->strcategory->AdvancedSearch->SearchValue = $category_tbl->getAdvancedSearch("x_strcategory");
		$category_tbl->strremarks->AdvancedSearch->SearchValue = $category_tbl->getAdvancedSearch("x_strremarks");
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
