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
$logs_list = new clogs_list();
$Page =& $logs_list;

// Page init
$logs_list->Page_Init();

// Page main
$logs_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($logs->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logs_list = new ew_Page("logs_list");

// page properties
logs_list.PageID = "list"; // page ID
logs_list.FormID = "flogslist"; // form ID
var EW_PAGE_ID = logs_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
logs_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logs_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logs_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logs_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logs_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
logs_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($logs->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$logs_list->lTotalRecs = $logs->SelectRecordCount();
	} else {
		if ($rs = $logs_list->LoadRecordset())
			$logs_list->lTotalRecs = $rs->RecordCount();
	}
	$logs_list->lStartRec = 1;
	if ($logs_list->lDisplayRecs <= 0 || ($logs->Export <> "" && $logs->ExportAll)) // Display all records
		$logs_list->lDisplayRecs = $logs_list->lTotalRecs;
	if (!($logs->Export <> "" && $logs->ExportAll))
		$logs_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $logs_list->LoadRecordset($logs_list->lStartRec-1, $logs_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logs->TableCaption() ?>
<?php if ($logs->Export == "" && $logs->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $logs_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $logs_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($logs->Export == "" && $logs->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logs_list);" style="text-decoration: none;"><img id="logs_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="logs_list_SearchPanel">
<form name="flogslistsrch" id="flogslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="logs">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($logs->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $logs_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="logssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($logs_list->sSrchWhere <> "" && $logs_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(logs_list, this, '<?php echo $logs->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($logs->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($logs->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($logs->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$logs_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="flogslist" id="flogslist" class="ewForm" action="" method="post">
<div id="gmp_logs" class="ewGridMiddlePanel">
<?php if ($logs_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $logs->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$logs_list->RenderListOptions();

// Render list options (header, left)
$logs_list->ListOptions->Render("header", "left");
?>
<?php if ($logs->ID->Visible) { // ID ?>
	<?php if ($logs->SortUrl($logs->ID) == "") { ?>
		<td><?php echo $logs->ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logs->SortUrl($logs->ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logs->ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($logs->ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logs->ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logs->struname->Visible) { // struname ?>
	<?php if ($logs->SortUrl($logs->struname) == "") { ?>
		<td><?php echo $logs->struname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logs->SortUrl($logs->struname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logs->struname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($logs->struname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logs->struname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logs->strdate->Visible) { // strdate ?>
	<?php if ($logs->SortUrl($logs->strdate) == "") { ?>
		<td><?php echo $logs->strdate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logs->SortUrl($logs->strdate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logs->strdate->FldCaption() ?></td><td style="width: 10px;"><?php if ($logs->strdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logs->strdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logs->straction->Visible) { // straction ?>
	<?php if ($logs->SortUrl($logs->straction) == "") { ?>
		<td><?php echo $logs->straction->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logs->SortUrl($logs->straction) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logs->straction->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($logs->straction->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logs->straction->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$logs_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($logs->ExportAll && $logs->Export <> "") {
	$logs_list->lStopRec = $logs_list->lTotalRecs;
} else {
	$logs_list->lStopRec = $logs_list->lStartRec + $logs_list->lDisplayRecs - 1; // Set the last record to display
}
$logs_list->lRecCount = $logs_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $logs_list->lStartRec > 1)
		$rs->Move($logs_list->lStartRec - 1);
}

// Initialize aggregate
$logs->RowType = EW_ROWTYPE_AGGREGATEINIT;
$logs_list->RenderRow();
$logs_list->lRowCnt = 0;
while (($logs->CurrentAction == "gridadd" || !$rs->EOF) &&
	$logs_list->lRecCount < $logs_list->lStopRec) {
	$logs_list->lRecCount++;
	if (intval($logs_list->lRecCount) >= intval($logs_list->lStartRec)) {
		$logs_list->lRowCnt++;

	// Init row class and style
	$logs->CssClass = "";
	$logs->CssStyle = "";
	$logs->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($logs->CurrentAction == "gridadd") {
		$logs_list->LoadDefaultValues(); // Load default values
	} else {
		$logs_list->LoadRowValues($rs); // Load row values
	}
	$logs->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$logs_list->RenderRow();

	// Render list options
	$logs_list->RenderListOptions();
?>
	<tr<?php echo $logs->RowAttributes() ?>>
<?php

// Render list options (body, left)
$logs_list->ListOptions->Render("body", "left");
?>
	<?php if ($logs->ID->Visible) { // ID ?>
		<td<?php echo $logs->ID->CellAttributes() ?>>
<div<?php echo $logs->ID->ViewAttributes() ?>><?php echo $logs->ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logs->struname->Visible) { // struname ?>
		<td<?php echo $logs->struname->CellAttributes() ?>>
<div<?php echo $logs->struname->ViewAttributes() ?>><?php echo $logs->struname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logs->strdate->Visible) { // strdate ?>
		<td<?php echo $logs->strdate->CellAttributes() ?>>
<div<?php echo $logs->strdate->ViewAttributes() ?>><?php echo $logs->strdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logs->straction->Visible) { // straction ?>
		<td<?php echo $logs->straction->CellAttributes() ?>>
<div<?php echo $logs->straction->ViewAttributes() ?>><?php echo $logs->straction->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$logs_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($logs->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($logs->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($logs->CurrentAction <> "gridadd" && $logs->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logs_list->Pager)) $logs_list->Pager = new cPrevNextPager($logs_list->lStartRec, $logs_list->lDisplayRecs, $logs_list->lTotalRecs) ?>
<?php if ($logs_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($logs_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logs_list->PageUrl() ?>start=<?php echo $logs_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logs_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logs_list->PageUrl() ?>start=<?php echo $logs_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logs_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logs_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logs_list->PageUrl() ?>start=<?php echo $logs_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logs_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logs_list->PageUrl() ?>start=<?php echo $logs_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $logs_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $logs_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $logs_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $logs_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logs_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($logs_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($logs->Export == "" && $logs->CurrentAction == "") { ?>
<?php } ?>
<?php if ($logs->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$logs_list->Page_Terminate();
?>
<?php

//
// Page class
//
class clogs_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'logs';

	// Page object name
	var $PageObjName = 'logs_list';

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
	function clogs_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (logs)
		$GLOBALS["logs"] = new clogs();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["logs"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "logsdelete.php";
		$this->MultiUpdateUrl = "logsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logs', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $logs;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$logs->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$logs->Export = $_POST["exporttype"];
		} else {
			$logs->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $logs->Export; // Get export parameter, used in header
		$gsExportFile = $logs->TableVar; // Get export file, used in header
		if ($logs->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($logs->Export == "csv") {
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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 25;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $logs;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$logs->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($logs->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $logs->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 25; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$logs->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$logs->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$logs->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $logs->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$logs->setSessionWhere($sFilter);
		$logs->CurrentFilter = "";

		// Export data only
		if (in_array($logs->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($logs->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $logs;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $logs->ID, FALSE); // ID
		$this->BuildSearchSql($sWhere, $logs->struname, FALSE); // struname
		$this->BuildSearchSql($sWhere, $logs->strdate, FALSE); // strdate
		$this->BuildSearchSql($sWhere, $logs->straction, FALSE); // straction

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($logs->ID); // ID
			$this->SetSearchParm($logs->struname); // struname
			$this->SetSearchParm($logs->strdate); // strdate
			$this->SetSearchParm($logs->straction); // straction
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $logs;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$logs->setAdvancedSearch("x_$FldParm", $FldVal);
		$logs->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$logs->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$logs->setAdvancedSearch("y_$FldParm", $FldVal2);
		$logs->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $logs;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $logs->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $logs->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $logs->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $logs->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $logs->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $logs;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $logs->struname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $logs->straction, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $logs;
		$sSearchStr = "";
		$sSearchKeyword = $logs->BasicSearchKeyword;
		$sSearchType = $logs->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$logs->setSessionBasicSearchKeyword($sSearchKeyword);
			$logs->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $logs;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$logs->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $logs;
		$logs->setSessionBasicSearchKeyword("");
		$logs->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $logs;
		$logs->setAdvancedSearch("x_ID", "");
		$logs->setAdvancedSearch("x_struname", "");
		$logs->setAdvancedSearch("x_strdate", "");
		$logs->setAdvancedSearch("x_straction", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $logs;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_struname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_straction"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$logs->BasicSearchKeyword = $logs->getSessionBasicSearchKeyword();
			$logs->BasicSearchType = $logs->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($logs->ID);
			$this->GetSearchParm($logs->struname);
			$this->GetSearchParm($logs->strdate);
			$this->GetSearchParm($logs->straction);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $logs;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$logs->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logs->CurrentOrderType = @$_GET["ordertype"];
			$logs->UpdateSort($logs->ID); // ID
			$logs->UpdateSort($logs->struname); // struname
			$logs->UpdateSort($logs->strdate); // strdate
			$logs->UpdateSort($logs->straction); // straction
			$logs->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $logs;
		$sOrderBy = $logs->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($logs->SqlOrderBy() <> "") {
				$sOrderBy = $logs->SqlOrderBy();
				$logs->setSessionOrderBy($sOrderBy);
				$logs->ID->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $logs;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logs->setSessionOrderBy($sOrderBy);
				$logs->ID->setSort("");
				$logs->struname->setSort("");
				$logs->strdate->setSort("");
				$logs->straction->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$logs->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $logs;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($logs->Export <> "" ||
			$logs->CurrentAction == "gridadd" ||
			$logs->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $logs;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $logs;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $logs;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$logs->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$logs->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $logs->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$logs->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$logs->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$logs->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $logs;
		$logs->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$logs->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $logs;

		// Load search values
		// ID

		$logs->ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ID"]);
		$logs->ID->AdvancedSearch->SearchOperator = @$_GET["z_ID"];

		// struname
		$logs->struname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_struname"]);
		$logs->struname->AdvancedSearch->SearchOperator = @$_GET["z_struname"];

		// strdate
		$logs->strdate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdate"]);
		$logs->strdate->AdvancedSearch->SearchOperator = @$_GET["z_strdate"];

		// straction
		$logs->straction->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_straction"]);
		$logs->straction->AdvancedSearch->SearchOperator = @$_GET["z_straction"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logs;

		// Call Recordset Selecting event
		$logs->Recordset_Selecting($logs->CurrentFilter);

		// Load List page SQL
		$sSql = $logs->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$logs->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logs;
		$sFilter = $logs->KeyFilter();

		// Call Row Selecting event
		$logs->Row_Selecting($sFilter);

		// Load SQL based on filter
		$logs->CurrentFilter = $sFilter;
		$sSql = $logs->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$logs->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $logs;
		$logs->ID->setDbValue($rs->fields('ID'));
		$logs->struname->setDbValue($rs->fields('struname'));
		$logs->strdate->setDbValue($rs->fields('strdate'));
		$logs->strauthorization->setDbValue($rs->fields('strauthorization'));
		$logs->straction->setDbValue($rs->fields('straction'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $logs;

		// Initialize URLs
		$this->ViewUrl = $logs->ViewUrl();
		$this->EditUrl = $logs->EditUrl();
		$this->InlineEditUrl = $logs->InlineEditUrl();
		$this->CopyUrl = $logs->CopyUrl();
		$this->InlineCopyUrl = $logs->InlineCopyUrl();
		$this->DeleteUrl = $logs->DeleteUrl();

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
			if ($logs->Export == "")
				$logs->struname->ViewValue = ew_Highlight($logs->HighlightName(), $logs->struname->ViewValue, $logs->getSessionBasicSearchKeyword(), $logs->getSessionBasicSearchType(), $logs->getAdvancedSearch("x_struname"));

			// strdate
			$logs->strdate->HrefValue = "";
			$logs->strdate->TooltipValue = "";

			// straction
			$logs->straction->HrefValue = "";
			$logs->straction->TooltipValue = "";
			if ($logs->Export == "")
				$logs->straction->ViewValue = ew_Highlight($logs->HighlightName(), $logs->straction->ViewValue, $logs->getSessionBasicSearchKeyword(), $logs->getSessionBasicSearchType(), $logs->getAdvancedSearch("x_straction"));
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $logs;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $logs->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($logs->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($logs->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($logs, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($logs->ID);
				$ExportDoc->ExportCaption($logs->struname);
				$ExportDoc->ExportCaption($logs->strdate);
				$ExportDoc->ExportCaption($logs->straction);
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
				$logs->CssClass = "";
				$logs->CssStyle = "";
				$logs->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($logs->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $logs->ID->ExportValue($logs->Export, $logs->ExportOriginalValue));
					$XmlDoc->AddField('struname', $logs->struname->ExportValue($logs->Export, $logs->ExportOriginalValue));
					$XmlDoc->AddField('strdate', $logs->strdate->ExportValue($logs->Export, $logs->ExportOriginalValue));
					$XmlDoc->AddField('straction', $logs->straction->ExportValue($logs->Export, $logs->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($logs->ID);
					$ExportDoc->ExportField($logs->struname);
					$ExportDoc->ExportField($logs->strdate);
					$ExportDoc->ExportField($logs->straction);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($logs->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($logs->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($logs->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($logs->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($logs->ExportReturnUrl());
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
