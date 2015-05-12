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
$nature_tbl_view = new cnature_tbl_view();
$Page =& $nature_tbl_view;

// Page init
$nature_tbl_view->Page_Init();

// Page main
$nature_tbl_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($nature_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var nature_tbl_view = new ew_Page("nature_tbl_view");

// page properties
nature_tbl_view.PageID = "view"; // page ID
nature_tbl_view.FormID = "fnature_tblview"; // form ID
var EW_PAGE_ID = nature_tbl_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nature_tbl_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nature_tbl_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nature_tbl_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nature_tbl_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
nature_tbl_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
nature_tbl_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nature_tbl->TableCaption() ?>
<?php if ($nature_tbl->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $nature_tbl_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $nature_tbl_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($nature_tbl->Export == "") { ?>
<a href="<?php echo $nature_tbl_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $nature_tbl_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $nature_tbl_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $nature_tbl_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$nature_tbl_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($nature_tbl->ID->Visible) { // ID ?>
	<tr<?php echo $nature_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->ID->FldCaption() ?></td>
		<td<?php echo $nature_tbl->ID->CellAttributes() ?>>
<div<?php echo $nature_tbl->ID->ViewAttributes() ?>><?php echo $nature_tbl->ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nature_tbl->strnature->Visible) { // strnature ?>
	<tr<?php echo $nature_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strnature->CellAttributes() ?>>
<div<?php echo $nature_tbl->strnature->ViewAttributes() ?>><?php echo $nature_tbl->strnature->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($nature_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $nature_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $nature_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $nature_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $nature_tbl->strremarks->ViewAttributes() ?>><?php echo $nature_tbl->strremarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($nature_tbl->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$nature_tbl_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cnature_tbl_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'nature_tbl';

	// Page object name
	var $PageObjName = 'nature_tbl_view';

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
	function cnature_tbl_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (nature_tbl)
		$GLOBALS["nature_tbl"] = new cnature_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$nature_tbl->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$nature_tbl->Export = $_POST["exporttype"];
		} else {
			$nature_tbl->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $nature_tbl->Export; // Get export parameter, used in header
		$gsExportFile = $nature_tbl->TableVar; // Get export file, used in header
		if (@$_GET["ID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["ID"]);
		}
		if ($nature_tbl->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($nature_tbl->Export == "csv") {
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
		global $Language, $nature_tbl;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ID"] <> "") {
				$nature_tbl->ID->setQueryStringValue($_GET["ID"]);
				$this->arRecKey["ID"] = $nature_tbl->ID->QueryStringValue;
			} else {
				$sReturnUrl = "nature_tbllist.php"; // Return to list
			}

			// Get action
			$nature_tbl->CurrentAction = "I"; // Display form
			switch ($nature_tbl->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "nature_tbllist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($nature_tbl->Export, array("html","word","excel","xml","csv","email"))) {
				if ($nature_tbl->Export == "email" && $nature_tbl->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$nature_tbl->setExportReturnUrl($nature_tbl->ViewUrl()); // Add key
				$this->ExportData();
				if ($nature_tbl->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "nature_tbllist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$nature_tbl->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $nature_tbl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$nature_tbl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$nature_tbl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $nature_tbl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$nature_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$nature_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$nature_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nature_tbl;

		// Call Recordset Selecting event
		$nature_tbl->Recordset_Selecting($nature_tbl->CurrentFilter);

		// Load List page SQL
		$sSql = $nature_tbl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$nature_tbl->Recordset_Selected($rs);
		return $rs;
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "ID=" . urlencode($nature_tbl->ID->CurrentValue);
		$this->AddUrl = $nature_tbl->AddUrl();
		$this->EditUrl = $nature_tbl->EditUrl();
		$this->CopyUrl = $nature_tbl->CopyUrl();
		$this->DeleteUrl = $nature_tbl->DeleteUrl();
		$this->ListUrl = $nature_tbl->ListUrl();

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
		}

		// Call Row Rendered event
		if ($nature_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nature_tbl->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $nature_tbl;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $nature_tbl->SelectRecordCount();
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
		if ($nature_tbl->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($nature_tbl, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($nature_tbl->ID);
				$ExportDoc->ExportCaption($nature_tbl->strnature);
				$ExportDoc->ExportCaption($nature_tbl->strremarks);
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
				$nature_tbl->CssClass = "";
				$nature_tbl->CssStyle = "";
				$nature_tbl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($nature_tbl->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $nature_tbl->ID->ExportValue($nature_tbl->Export, $nature_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strnature', $nature_tbl->strnature->ExportValue($nature_tbl->Export, $nature_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strremarks', $nature_tbl->strremarks->ExportValue($nature_tbl->Export, $nature_tbl->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($nature_tbl->ID);
					$ExportDoc->ExportField($nature_tbl->strnature);
					$ExportDoc->ExportField($nature_tbl->strremarks);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($nature_tbl->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($nature_tbl->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($nature_tbl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($nature_tbl->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($nature_tbl->ExportReturnUrl());
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
