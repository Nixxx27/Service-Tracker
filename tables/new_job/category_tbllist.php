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
$category_tbl_list = new ccategory_tbl_list();
$Page =& $category_tbl_list;

// Page init
$category_tbl_list->Page_Init();

// Page main
$category_tbl_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($category_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var category_tbl_list = new ew_Page("category_tbl_list");

// page properties
category_tbl_list.PageID = "list"; // page ID
category_tbl_list.FormID = "fcategory_tbllist"; // form ID
var EW_PAGE_ID = category_tbl_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
category_tbl_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
category_tbl_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
category_tbl_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_tbl_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
category_tbl_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
category_tbl_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($category_tbl->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$category_tbl_list->lTotalRecs = $category_tbl->SelectRecordCount();
	} else {
		if ($rs = $category_tbl_list->LoadRecordset())
			$category_tbl_list->lTotalRecs = $rs->RecordCount();
	}
	$category_tbl_list->lStartRec = 1;
	if ($category_tbl_list->lDisplayRecs <= 0 || ($category_tbl->Export <> "" && $category_tbl->ExportAll)) // Display all records
		$category_tbl_list->lDisplayRecs = $category_tbl_list->lTotalRecs;
	if (!($category_tbl->Export <> "" && $category_tbl->ExportAll))
		$category_tbl_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $category_tbl_list->LoadRecordset($category_tbl_list->lStartRec-1, $category_tbl_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $category_tbl->TableCaption() ?>
<?php if ($category_tbl->Export == "" && $category_tbl->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $category_tbl_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $category_tbl_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($category_tbl->Export == "" && $category_tbl->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(category_tbl_list);" style="text-decoration: none;"><img id="category_tbl_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="category_tbl_list_SearchPanel">
<form name="fcategory_tbllistsrch" id="fcategory_tbllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="category_tbl">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($category_tbl->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $category_tbl_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="category_tblsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($category_tbl_list->sSrchWhere <> "" && $category_tbl_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(category_tbl_list, this, '<?php echo $category_tbl->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($category_tbl->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($category_tbl->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($category_tbl->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$category_tbl_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcategory_tbllist" id="fcategory_tbllist" class="ewForm" action="" method="post">
<div id="gmp_category_tbl" class="ewGridMiddlePanel">
<?php if ($category_tbl_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $category_tbl->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$category_tbl_list->RenderListOptions();

// Render list options (header, left)
$category_tbl_list->ListOptions->Render("header", "left");
?>
<?php if ($category_tbl->ID->Visible) { // ID ?>
	<?php if ($category_tbl->SortUrl($category_tbl->ID) == "") { ?>
		<td><?php echo $category_tbl->ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category_tbl->SortUrl($category_tbl->ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $category_tbl->ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($category_tbl->ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category_tbl->ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($category_tbl->strcategory->Visible) { // strcategory ?>
	<?php if ($category_tbl->SortUrl($category_tbl->strcategory) == "") { ?>
		<td><?php echo $category_tbl->strcategory->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category_tbl->SortUrl($category_tbl->strcategory) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $category_tbl->strcategory->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($category_tbl->strcategory->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category_tbl->strcategory->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($category_tbl->strremarks->Visible) { // strremarks ?>
	<?php if ($category_tbl->SortUrl($category_tbl->strremarks) == "") { ?>
		<td><?php echo $category_tbl->strremarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category_tbl->SortUrl($category_tbl->strremarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $category_tbl->strremarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($category_tbl->strremarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category_tbl->strremarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$category_tbl_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($category_tbl->ExportAll && $category_tbl->Export <> "") {
	$category_tbl_list->lStopRec = $category_tbl_list->lTotalRecs;
} else {
	$category_tbl_list->lStopRec = $category_tbl_list->lStartRec + $category_tbl_list->lDisplayRecs - 1; // Set the last record to display
}
$category_tbl_list->lRecCount = $category_tbl_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $category_tbl_list->lStartRec > 1)
		$rs->Move($category_tbl_list->lStartRec - 1);
}

// Initialize aggregate
$category_tbl->RowType = EW_ROWTYPE_AGGREGATEINIT;
$category_tbl_list->RenderRow();
$category_tbl_list->lRowCnt = 0;
while (($category_tbl->CurrentAction == "gridadd" || !$rs->EOF) &&
	$category_tbl_list->lRecCount < $category_tbl_list->lStopRec) {
	$category_tbl_list->lRecCount++;
	if (intval($category_tbl_list->lRecCount) >= intval($category_tbl_list->lStartRec)) {
		$category_tbl_list->lRowCnt++;

	// Init row class and style
	$category_tbl->CssClass = "";
	$category_tbl->CssStyle = "";
	$category_tbl->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($category_tbl->CurrentAction == "gridadd") {
		$category_tbl_list->LoadDefaultValues(); // Load default values
	} else {
		$category_tbl_list->LoadRowValues($rs); // Load row values
	}
	$category_tbl->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$category_tbl_list->RenderRow();

	// Render list options
	$category_tbl_list->RenderListOptions();
?>
	<tr<?php echo $category_tbl->RowAttributes() ?>>
<?php

// Render list options (body, left)
$category_tbl_list->ListOptions->Render("body", "left");
?>
	<?php if ($category_tbl->ID->Visible) { // ID ?>
		<td<?php echo $category_tbl->ID->CellAttributes() ?>>
<div<?php echo $category_tbl->ID->ViewAttributes() ?>><?php echo $category_tbl->ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category_tbl->strcategory->Visible) { // strcategory ?>
		<td<?php echo $category_tbl->strcategory->CellAttributes() ?>>
<div<?php echo $category_tbl->strcategory->ViewAttributes() ?>><?php echo $category_tbl->strcategory->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category_tbl->strremarks->Visible) { // strremarks ?>
		<td<?php echo $category_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $category_tbl->strremarks->ViewAttributes() ?>><?php echo $category_tbl->strremarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_tbl_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($category_tbl->CurrentAction <> "gridadd")
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
<?php if ($category_tbl->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($category_tbl->CurrentAction <> "gridadd" && $category_tbl->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($category_tbl_list->Pager)) $category_tbl_list->Pager = new cPrevNextPager($category_tbl_list->lStartRec, $category_tbl_list->lDisplayRecs, $category_tbl_list->lTotalRecs) ?>
<?php if ($category_tbl_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($category_tbl_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $category_tbl_list->PageUrl() ?>start=<?php echo $category_tbl_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($category_tbl_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $category_tbl_list->PageUrl() ?>start=<?php echo $category_tbl_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $category_tbl_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($category_tbl_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $category_tbl_list->PageUrl() ?>start=<?php echo $category_tbl_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($category_tbl_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $category_tbl_list->PageUrl() ?>start=<?php echo $category_tbl_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $category_tbl_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $category_tbl_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $category_tbl_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $category_tbl_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($category_tbl_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($category_tbl_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $category_tbl_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($category_tbl_list->lTotalRecs > 0) { ?>
<a href="" onclick="ew_SubmitSelected(document.fcategory_tbllist, '<?php echo $category_tbl_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($category_tbl->Export == "" && $category_tbl->CurrentAction == "") { ?>
<?php } ?>
<?php if ($category_tbl->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$category_tbl_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccategory_tbl_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'category_tbl';

	// Page object name
	var $PageObjName = 'category_tbl_list';

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
	function ccategory_tbl_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (category_tbl)
		$GLOBALS["category_tbl"] = new ccategory_tbl();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["category_tbl"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "category_tbldelete.php";
		$this->MultiUpdateUrl = "category_tblupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category_tbl', TRUE);

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
		global $category_tbl;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$category_tbl->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$category_tbl->Export = $_POST["exporttype"];
		} else {
			$category_tbl->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $category_tbl->Export; // Get export parameter, used in header
		$gsExportFile = $category_tbl->TableVar; // Get export file, used in header
		if ($category_tbl->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($category_tbl->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $category_tbl;

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
			$category_tbl->Recordset_SearchValidated();

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
		if ($category_tbl->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $category_tbl->getRecordsPerPage(); // Restore from Session
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
		$category_tbl->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$category_tbl->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$category_tbl->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $category_tbl->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$category_tbl->setSessionWhere($sFilter);
		$category_tbl->CurrentFilter = "";

		// Export data only
		if (in_array($category_tbl->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($category_tbl->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $category_tbl;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $category_tbl->ID, FALSE); // ID
		$this->BuildSearchSql($sWhere, $category_tbl->strcategory, FALSE); // strcategory
		$this->BuildSearchSql($sWhere, $category_tbl->strremarks, FALSE); // strremarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($category_tbl->ID); // ID
			$this->SetSearchParm($category_tbl->strcategory); // strcategory
			$this->SetSearchParm($category_tbl->strremarks); // strremarks
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
		global $category_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$category_tbl->setAdvancedSearch("x_$FldParm", $FldVal);
		$category_tbl->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$category_tbl->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$category_tbl->setAdvancedSearch("y_$FldParm", $FldVal2);
		$category_tbl->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $category_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $category_tbl->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $category_tbl->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $category_tbl->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $category_tbl->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $category_tbl->GetAdvancedSearch("w_$FldParm");
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
		global $category_tbl;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $category_tbl->strcategory, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $category_tbl->strremarks, $Keyword);
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
		global $Security, $category_tbl;
		$sSearchStr = "";
		$sSearchKeyword = $category_tbl->BasicSearchKeyword;
		$sSearchType = $category_tbl->BasicSearchType;
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
			$category_tbl->setSessionBasicSearchKeyword($sSearchKeyword);
			$category_tbl->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $category_tbl;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$category_tbl->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $category_tbl;
		$category_tbl->setSessionBasicSearchKeyword("");
		$category_tbl->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $category_tbl;
		$category_tbl->setAdvancedSearch("x_ID", "");
		$category_tbl->setAdvancedSearch("x_strcategory", "");
		$category_tbl->setAdvancedSearch("x_strremarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $category_tbl;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcategory"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strremarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$category_tbl->BasicSearchKeyword = $category_tbl->getSessionBasicSearchKeyword();
			$category_tbl->BasicSearchType = $category_tbl->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($category_tbl->ID);
			$this->GetSearchParm($category_tbl->strcategory);
			$this->GetSearchParm($category_tbl->strremarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $category_tbl;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$category_tbl->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$category_tbl->CurrentOrderType = @$_GET["ordertype"];
			$category_tbl->UpdateSort($category_tbl->ID); // ID
			$category_tbl->UpdateSort($category_tbl->strcategory); // strcategory
			$category_tbl->UpdateSort($category_tbl->strremarks); // strremarks
			$category_tbl->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $category_tbl;
		$sOrderBy = $category_tbl->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($category_tbl->SqlOrderBy() <> "") {
				$sOrderBy = $category_tbl->SqlOrderBy();
				$category_tbl->setSessionOrderBy($sOrderBy);
				$category_tbl->ID->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $category_tbl;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$category_tbl->setSessionOrderBy($sOrderBy);
				$category_tbl->ID->setSort("");
				$category_tbl->strcategory->setSort("");
				$category_tbl->strremarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$category_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $category_tbl;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = True;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"category_tbl_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($category_tbl->Export <> "" ||
			$category_tbl->CurrentAction == "gridadd" ||
			$category_tbl->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $category_tbl;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($category_tbl->ID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $category_tbl;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $category_tbl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$category_tbl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$category_tbl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $category_tbl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$category_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$category_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$category_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $category_tbl;
		$category_tbl->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$category_tbl->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $category_tbl;

		// Load search values
		// ID

		$category_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ID"]);
		$category_tbl->ID->AdvancedSearch->SearchOperator = @$_GET["z_ID"];

		// strcategory
		$category_tbl->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcategory"]);
		$category_tbl->strcategory->AdvancedSearch->SearchOperator = @$_GET["z_strcategory"];

		// strremarks
		$category_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strremarks"]);
		$category_tbl->strremarks->AdvancedSearch->SearchOperator = @$_GET["z_strremarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $category_tbl;

		// Call Recordset Selecting event
		$category_tbl->Recordset_Selecting($category_tbl->CurrentFilter);

		// Load List page SQL
		$sSql = $category_tbl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$category_tbl->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $category_tbl->ViewUrl();
		$this->EditUrl = $category_tbl->EditUrl();
		$this->InlineEditUrl = $category_tbl->InlineEditUrl();
		$this->CopyUrl = $category_tbl->CopyUrl();
		$this->InlineCopyUrl = $category_tbl->InlineCopyUrl();
		$this->DeleteUrl = $category_tbl->DeleteUrl();

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
			if ($category_tbl->Export == "")
				$category_tbl->strcategory->ViewValue = ew_Highlight($category_tbl->HighlightName(), $category_tbl->strcategory->ViewValue, $category_tbl->getSessionBasicSearchKeyword(), $category_tbl->getSessionBasicSearchType(), $category_tbl->getAdvancedSearch("x_strcategory"));

			// strremarks
			$category_tbl->strremarks->HrefValue = "";
			$category_tbl->strremarks->TooltipValue = "";
			if ($category_tbl->Export == "")
				$category_tbl->strremarks->ViewValue = ew_Highlight($category_tbl->HighlightName(), $category_tbl->strremarks->ViewValue, $category_tbl->getSessionBasicSearchKeyword(), $category_tbl->getSessionBasicSearchType(), $category_tbl->getAdvancedSearch("x_strremarks"));
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $category_tbl;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $category_tbl->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($category_tbl->ExportAll) {
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
		if ($category_tbl->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($category_tbl, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($category_tbl->ID);
				$ExportDoc->ExportCaption($category_tbl->strcategory);
				$ExportDoc->ExportCaption($category_tbl->strremarks);
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
				$category_tbl->CssClass = "";
				$category_tbl->CssStyle = "";
				$category_tbl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($category_tbl->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $category_tbl->ID->ExportValue($category_tbl->Export, $category_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcategory', $category_tbl->strcategory->ExportValue($category_tbl->Export, $category_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strremarks', $category_tbl->strremarks->ExportValue($category_tbl->Export, $category_tbl->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($category_tbl->ID);
					$ExportDoc->ExportField($category_tbl->strcategory);
					$ExportDoc->ExportField($category_tbl->strremarks);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($category_tbl->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($category_tbl->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($category_tbl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($category_tbl->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($category_tbl->ExportReturnUrl());
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
