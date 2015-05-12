<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>

<?php 
include('copyright.php'); 
include('sec_access.php');
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
$techician_tbl_search = new ctechician_tbl_search();
$Page =& $techician_tbl_search;

// Page init
$techician_tbl_search->Page_Init();

// Page main
$techician_tbl_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var techician_tbl_search = new ew_Page("techician_tbl_search");

// page properties
techician_tbl_search.PageID = "search"; // page ID
techician_tbl_search.FormID = "ftechician_tblsearch"; // form ID
var EW_PAGE_ID = techician_tbl_search.PageID; // for backward compatibility

// extend page with validate function for search
techician_tbl_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($techician_tbl->ID->FldErrMsg()) ?>");

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
techician_tbl_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
techician_tbl_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
techician_tbl_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
techician_tbl_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
techician_tbl_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
techician_tbl_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
    	<h3><strong><i class="fa fa-wrench"></i> JOB CATEGORIES <small>Advanced Search</small></strong></h3>
    </div>
</div>
    	<hr>
<?php include('fmd-nav.php'); ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $techician_tbl->getReturnUrl() ?>>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$techician_tbl_search->ShowMessage();
?>
<form name="ftechician_tblsearch" id="ftechician_tblsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return techician_tbl_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="techician_tbl">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $techician_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $techician_tbl->ID->FldCaption() ?></td>
		<td<?php echo $techician_tbl->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $techician_tbl->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $techician_tbl->ID->FldTitle() ?>" value="<?php echo $techician_tbl->ID->EditValue ?>"<?php echo $techician_tbl->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $techician_tbl->strtechname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Technician Name" ?></td>
		<td<?php echo $techician_tbl->strtechname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strtechname" id="z_strtechname" value="LIKE"></span></td>
		<td<?php echo $techician_tbl->strtechname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strtechname" id="x_strtechname" title="<?php echo $techician_tbl->strtechname->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $techician_tbl->strtechname->EditValue ?>"<?php echo $techician_tbl->strtechname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $techician_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "Remarks" ?></td>
		<td<?php echo $techician_tbl->strremarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strremarks" id="z_strremarks" value="LIKE"></span></td>
		<td<?php echo $techician_tbl->strremarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $techician_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $techician_tbl->strremarks->EditAttributes() ?>><?php echo $techician_tbl->strremarks->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<br/>
<input type="submit" name="Action" id="Action" class="btn btn-primary btn-sm"  value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset"   class="btn btn-info btn-sm"  value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
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
$techician_tbl_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctechician_tbl_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'techician_tbl';

	// Page object name
	var $PageObjName = 'techician_tbl_search';

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
	function ctechician_tbl_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (techician_tbl)
		$GLOBALS["techician_tbl"] = new ctechician_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $techician_tbl;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$techician_tbl->CurrentAction = $objForm->GetValue("a_search");
			switch ($techician_tbl->CurrentAction) {
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
						$sSrchStr = $techician_tbl->UrlParm($sSrchStr);
						$this->Page_Terminate("techician_tbllist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$techician_tbl->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $techician_tbl;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $techician_tbl->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $techician_tbl->strtechname); // strtechname
	$this->BuildSearchUrl($sSrchUrl, $techician_tbl->strremarks); // strremarks
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
		global $objForm, $techician_tbl;

		// Load search values
		// ID

		$techician_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$techician_tbl->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// strtechname
		$techician_tbl->strtechname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strtechname"));
		$techician_tbl->strtechname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strtechname");

		// strremarks
		$techician_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strremarks"));
		$techician_tbl->strremarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strremarks");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $techician_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$techician_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$techician_tbl->ID->CellCssStyle = ""; $techician_tbl->ID->CellCssClass = "";
		$techician_tbl->ID->CellAttrs = array(); $techician_tbl->ID->ViewAttrs = array(); $techician_tbl->ID->EditAttrs = array();

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

			// ID
			$techician_tbl->ID->HrefValue = "";
			$techician_tbl->ID->TooltipValue = "";

			// strtechname
			$techician_tbl->strtechname->HrefValue = "";
			$techician_tbl->strtechname->TooltipValue = "";

			// strremarks
			$techician_tbl->strremarks->HrefValue = "";
			$techician_tbl->strremarks->TooltipValue = "";
		} elseif ($techician_tbl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$techician_tbl->ID->EditCustomAttributes = "";
			$techician_tbl->ID->EditValue = ew_HtmlEncode($techician_tbl->ID->AdvancedSearch->SearchValue);

			// strtechname
			$techician_tbl->strtechname->EditCustomAttributes = "";
			$techician_tbl->strtechname->EditValue = ew_HtmlEncode($techician_tbl->strtechname->AdvancedSearch->SearchValue);

			// strremarks
			$techician_tbl->strremarks->EditCustomAttributes = "";
			$techician_tbl->strremarks->EditValue = ew_HtmlEncode($techician_tbl->strremarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($techician_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$techician_tbl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $techician_tbl;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($techician_tbl->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $techician_tbl->ID->FldErrMsg();
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
		global $techician_tbl;
		$techician_tbl->ID->AdvancedSearch->SearchValue = $techician_tbl->getAdvancedSearch("x_ID");
		$techician_tbl->strtechname->AdvancedSearch->SearchValue = $techician_tbl->getAdvancedSearch("x_strtechname");
		$techician_tbl->strremarks->AdvancedSearch->SearchValue = $techician_tbl->getAdvancedSearch("x_strremarks");
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
