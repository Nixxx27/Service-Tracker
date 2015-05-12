<?php
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
$nature_tbl_list = new cnature_tbl_list();
$Page =& $nature_tbl_list;

// Page init
$nature_tbl_list->Page_Init();

// Page main
$nature_tbl_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($nature_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var nature_tbl_list = new ew_Page("nature_tbl_list");

// page properties
nature_tbl_list.PageID = "list"; // page ID
nature_tbl_list.FormID = "fnature_tbllist"; // form ID
var EW_PAGE_ID = nature_tbl_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nature_tbl_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nature_tbl_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nature_tbl_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nature_tbl_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
nature_tbl_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
nature_tbl_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($nature_tbl->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$nature_tbl_list->lTotalRecs = $nature_tbl->SelectRecordCount();
	} else {
		if ($rs = $nature_tbl_list->LoadRecordset())
			$nature_tbl_list->lTotalRecs = $rs->RecordCount();
	}
	$nature_tbl_list->lStartRec = 1;
	if ($nature_tbl_list->lDisplayRecs <= 0 || ($nature_tbl->Export <> "" && $nature_tbl->ExportAll)) // Display all records
		$nature_tbl_list->lDisplayRecs = $nature_tbl_list->lTotalRecs;
	if (!($nature_tbl->Export <> "" && $nature_tbl->ExportAll))
		$nature_tbl_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $nature_tbl_list->LoadRecordset($nature_tbl_list->lStartRec-1, $nature_tbl_list->lDisplayRecs);
?>
<?php if ($nature_tbl->Export == "" && $nature_tbl->CurrentAction == "") { ?>
<?php } ?>
<?php if ($nature_tbl->Export == "" && $nature_tbl->CurrentAction == "") { ?>

<div class="row">
    <div class="col-lg-12">
    	<h3><strong><i class="fa fa-wrench"></i> NATURE OF JOB <small>View All Records</small></strong></h3>
    </div>
</div>
    	<hr>
<?php include('fmd-nav.php'); ?>
<a href="javascript:ew_ToggleSearchPanel(nature_tbl_list);" style="text-decoration: none;"><img id="nature_tbl_list_SearchImage" src="images/collapse.gif" alt="" width="10" height="10" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>

<div id="nature_tbl_list_SearchPanel">
<form name="fnature_tbllistsrch" id="fnature_tbllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="nature_tbl">
<table class="ewBasicSearch" style="margin-left:50px">
	<tr>
		<td><span class="phpmaker">
			<input type="text"  class="searchbox" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($nature_tbl->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit"  class="btn btn-primary btn-sm" id="Submit" value="Search">

			<img src="img/system/buttons/export_excel.png" title="Export to Excel" onclick="javascript:location.href='<?php echo $nature_tbl_list->ExportExcelUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/csv.png" title="Export to CSV" onclick="javascript:location.href='<?php echo $nature_tbl_list->ExportCsvUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/showall.png" title="Show All" onclick="javascript:location.href='<?php echo $nature_tbl_list->PageUrl() ?>cmd=reset'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/advanced_search.png" title="Advanced Search" onclick="javascript:location.href='nature_tblsrch.php'" class='onhover cursorpointer' height='40px' width='auto'>
		

			<?php if ($nature_tbl_list->sSrchWhere <> "" && $nature_tbl_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(nature_tbl_list, this, '<?php echo $nature_tbl->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($nature_tbl->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($nature_tbl->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($nature_tbl->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>


<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$nature_tbl_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid" style="margin-left:50px"><tr><td class="ewGridContent" >
<form name="fnature_tbllist" id="fnature_tbllist" class="ewForm" action="" method="post">
<div id="gmp_nature_tbl" class="ewGridMiddlePanel">
<?php if ($nature_tbl_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate" >
<?php echo $nature_tbl->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$nature_tbl_list->RenderListOptions();

// Render list options (header, left)
$nature_tbl_list->ListOptions->Render("header", "left");
?>
<?php if ($nature_tbl->ID->Visible) { // ID ?>
	<?php if ($nature_tbl->SortUrl($nature_tbl->ID) == "") { ?>
		<td><?php echo $nature_tbl->ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nature_tbl->SortUrl($nature_tbl->ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $nature_tbl->ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($nature_tbl->ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nature_tbl->ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($nature_tbl->strnature->Visible) { // strnature ?>
	<?php if ($nature_tbl->SortUrl($nature_tbl->strnature) == "") { ?>
		<td><?php echo $nature_tbl->strnature->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nature_tbl->SortUrl($nature_tbl->strnature) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center"><?php echo "Nature Of Job"?></td><td style="width: 10px;"><?php if ($nature_tbl->strnature->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nature_tbl->strnature->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($nature_tbl->strremarks->Visible) { // strremarks ?>
	<?php if ($nature_tbl->SortUrl($nature_tbl->strremarks) == "") { ?>
		<td><?php echo $nature_tbl->strremarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nature_tbl->SortUrl($nature_tbl->strremarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center"><?php echo "Remarks" ?></td><td style="width: 10px;"><?php if ($nature_tbl->strremarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nature_tbl->strremarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$nature_tbl_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($nature_tbl->ExportAll && $nature_tbl->Export <> "") {
	$nature_tbl_list->lStopRec = $nature_tbl_list->lTotalRecs;
} else {
	$nature_tbl_list->lStopRec = $nature_tbl_list->lStartRec + $nature_tbl_list->lDisplayRecs - 1; // Set the last record to display
}
$nature_tbl_list->lRecCount = $nature_tbl_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $nature_tbl_list->lStartRec > 1)
		$rs->Move($nature_tbl_list->lStartRec - 1);
}

// Initialize aggregate
$nature_tbl->RowType = EW_ROWTYPE_AGGREGATEINIT;
$nature_tbl_list->RenderRow();
$nature_tbl_list->lRowCnt = 0;
while (($nature_tbl->CurrentAction == "gridadd" || !$rs->EOF) &&
	$nature_tbl_list->lRecCount < $nature_tbl_list->lStopRec) {
	$nature_tbl_list->lRecCount++;
	if (intval($nature_tbl_list->lRecCount) >= intval($nature_tbl_list->lStartRec)) {
		$nature_tbl_list->lRowCnt++;

	// Init row class and style
	$nature_tbl->CssClass = "";
	$nature_tbl->CssStyle = "";
	$nature_tbl->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($nature_tbl->CurrentAction == "gridadd") {
		$nature_tbl_list->LoadDefaultValues(); // Load default values
	} else {
		$nature_tbl_list->LoadRowValues($rs); // Load row values
	}
	$nature_tbl->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$nature_tbl_list->RenderRow();

	// Render list options
	$nature_tbl_list->RenderListOptions();
?>
	<tr<?php echo $nature_tbl->RowAttributes() ?>>
<?php

// Render list options (body, left)
$nature_tbl_list->ListOptions->Render("body", "left");
?>
	<?php if ($nature_tbl->ID->Visible) { // ID ?>
		<td<?php echo $nature_tbl->ID->CellAttributes() ?>>
<div<?php echo $nature_tbl->ID->ViewAttributes() ?>><?php echo $nature_tbl->ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nature_tbl->strnature->Visible) { // strnature ?>
		<td<?php echo $nature_tbl->strnature->CellAttributes() ?>>
<div<?php echo $nature_tbl->strnature->ViewAttributes() ?>><?php echo $nature_tbl->strnature->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nature_tbl->strremarks->Visible) { // strremarks ?>
		<td<?php echo $nature_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $nature_tbl->strremarks->ViewAttributes() ?>><?php echo $nature_tbl->strremarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nature_tbl_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($nature_tbl->CurrentAction <> "gridadd")
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
<?php if ($nature_tbl->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($nature_tbl->CurrentAction <> "gridadd" && $nature_tbl->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nature_tbl_list->Pager)) $nature_tbl_list->Pager = new cPrevNextPager($nature_tbl_list->lStartRec, $nature_tbl_list->lDisplayRecs, $nature_tbl_list->lTotalRecs) ?>
<?php if ($nature_tbl_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($nature_tbl_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nature_tbl_list->PageUrl() ?>start=<?php echo $nature_tbl_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nature_tbl_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nature_tbl_list->PageUrl() ?>start=<?php echo $nature_tbl_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nature_tbl_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nature_tbl_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nature_tbl_list->PageUrl() ?>start=<?php echo $nature_tbl_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nature_tbl_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nature_tbl_list->PageUrl() ?>start=<?php echo $nature_tbl_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $nature_tbl_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $nature_tbl_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $nature_tbl_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $nature_tbl_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($nature_tbl_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($nature_tbl_list->lTotalRecs > 0) { ?>
<img src="img/system/buttons/assign_technician.png" title="Add New" onclick="javascript:location.href='<?php echo $nature_tbl_list->AddUrl ?>'" class='onhover cursorpointer' height='35px' width='auto'>

<?php if ($nature_tbl_list->lTotalRecs > 0) { ?>
	<a href="" onclick="ew_SubmitSelected(document.fnature_tbllist, '<?php echo $nature_tbl_list->MultiDeleteUrl ?>');return false;"><img src="img/system/buttons/delete.png" title="Delete Record" class='onhover cursorpointer' height='40px' width='auto'></a>
<?php } ?>
		
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($nature_tbl->Export == "" && $nature_tbl->CurrentAction == "") { ?>
<?php } ?>
<?php if ($nature_tbl->Export == "") { ?>

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

<?php } ?>
<?php include "footer.php" ?>
<?php
$nature_tbl_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cnature_tbl_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'nature_tbl';

	// Page object name
	var $PageObjName = 'nature_tbl_list';

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
	function cnature_tbl_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (nature_tbl)
		$GLOBALS["nature_tbl"] = new cnature_tbl();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["nature_tbl"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "nature_tbldelete.php";
		$this->MultiUpdateUrl = "nature_tblupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nature_tbl', TRUE);

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
		global $objForm, $Language, $gsSearchError, $Security, $nature_tbl;

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
			$nature_tbl->Recordset_SearchValidated();

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
		if ($nature_tbl->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $nature_tbl->getRecordsPerPage(); // Restore from Session
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
		$nature_tbl->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$nature_tbl->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$nature_tbl->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $nature_tbl->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$nature_tbl->setSessionWhere($sFilter);
		$nature_tbl->CurrentFilter = "";

		// Export data only
		if (in_array($nature_tbl->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($nature_tbl->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $nature_tbl;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $nature_tbl->ID, FALSE); // ID
		$this->BuildSearchSql($sWhere, $nature_tbl->strnature, FALSE); // strnature
		$this->BuildSearchSql($sWhere, $nature_tbl->strremarks, FALSE); // strremarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($nature_tbl->ID); // ID
			$this->SetSearchParm($nature_tbl->strnature); // strnature
			$this->SetSearchParm($nature_tbl->strremarks); // strremarks
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
		global $nature_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$nature_tbl->setAdvancedSearch("x_$FldParm", $FldVal);
		$nature_tbl->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$nature_tbl->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$nature_tbl->setAdvancedSearch("y_$FldParm", $FldVal2);
		$nature_tbl->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $nature_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $nature_tbl->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $nature_tbl->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $nature_tbl->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $nature_tbl->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $nature_tbl->GetAdvancedSearch("w_$FldParm");
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
		global $nature_tbl;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $nature_tbl->strnature, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $nature_tbl->strremarks, $Keyword);
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
		global $Security, $nature_tbl;
		$sSearchStr = "";
		$sSearchKeyword = $nature_tbl->BasicSearchKeyword;
		$sSearchType = $nature_tbl->BasicSearchType;
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
			$nature_tbl->setSessionBasicSearchKeyword($sSearchKeyword);
			$nature_tbl->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $nature_tbl;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$nature_tbl->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $nature_tbl;
		$nature_tbl->setSessionBasicSearchKeyword("");
		$nature_tbl->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $nature_tbl;
		$nature_tbl->setAdvancedSearch("x_ID", "");
		$nature_tbl->setAdvancedSearch("x_strnature", "");
		$nature_tbl->setAdvancedSearch("x_strremarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $nature_tbl;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strnature"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strremarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$nature_tbl->BasicSearchKeyword = $nature_tbl->getSessionBasicSearchKeyword();
			$nature_tbl->BasicSearchType = $nature_tbl->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($nature_tbl->ID);
			$this->GetSearchParm($nature_tbl->strnature);
			$this->GetSearchParm($nature_tbl->strremarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $nature_tbl;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$nature_tbl->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$nature_tbl->CurrentOrderType = @$_GET["ordertype"];
			$nature_tbl->UpdateSort($nature_tbl->ID); // ID
			$nature_tbl->UpdateSort($nature_tbl->strnature); // strnature
			$nature_tbl->UpdateSort($nature_tbl->strremarks); // strremarks
			$nature_tbl->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $nature_tbl;
		$sOrderBy = $nature_tbl->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($nature_tbl->SqlOrderBy() <> "") {
				$sOrderBy = $nature_tbl->SqlOrderBy();
				$nature_tbl->setSessionOrderBy($sOrderBy);
				$nature_tbl->ID->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $nature_tbl;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$nature_tbl->setSessionOrderBy($sOrderBy);
				$nature_tbl->ID->setSort("");
				$nature_tbl->strnature->setSort("");
				$nature_tbl->strremarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$nature_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $nature_tbl;

		// "view"
		//$this->ListOptions->Add("view");
		//$item =& $this->ListOptions->Items["view"];
		//$item->CssStyle = "white-space: nowrap;";
		//$item->Visible = TRUE;
		//$item->OnLeft = FALSE;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"nature_tbl_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($nature_tbl->Export <> "" ||
			$nature_tbl->CurrentAction == "gridadd" ||
			$nature_tbl->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $nature_tbl;
		$this->ListOptions->LoadDefault();

		// "view"
		//$oListOpt =& $this->ListOptions->Items["view"];
		//if ($oListOpt->Visible)
		//	$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src='img/system/buttons/assign_technician.png' height='30px' width='auto' title='View Record'>" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src='img/system/buttons/edit1.png' height='30px' width='auto' title='Edit Record'>" . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($nature_tbl->ID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $nature_tbl;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		global $nature_tbl;
		$nature_tbl->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$nature_tbl->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $nature_tbl;

		// Load search values
		// ID

		$nature_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ID"]);
		$nature_tbl->ID->AdvancedSearch->SearchOperator = @$_GET["z_ID"];

		// strnature
		$nature_tbl->strnature->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strnature"]);
		$nature_tbl->strnature->AdvancedSearch->SearchOperator = @$_GET["z_strnature"];

		// strremarks
		$nature_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strremarks"]);
		$nature_tbl->strremarks->AdvancedSearch->SearchOperator = @$_GET["z_strremarks"];
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
		$this->ViewUrl = $nature_tbl->ViewUrl();
		$this->EditUrl = $nature_tbl->EditUrl();
		$this->InlineEditUrl = $nature_tbl->InlineEditUrl();
		$this->CopyUrl = $nature_tbl->CopyUrl();
		$this->InlineCopyUrl = $nature_tbl->InlineCopyUrl();
		$this->DeleteUrl = $nature_tbl->DeleteUrl();

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
			if ($nature_tbl->Export == "")
				$nature_tbl->strnature->ViewValue = ew_Highlight($nature_tbl->HighlightName(), $nature_tbl->strnature->ViewValue, $nature_tbl->getSessionBasicSearchKeyword(), $nature_tbl->getSessionBasicSearchType(), $nature_tbl->getAdvancedSearch("x_strnature"));

			// strremarks
			$nature_tbl->strremarks->HrefValue = "";
			$nature_tbl->strremarks->TooltipValue = "";
			if ($nature_tbl->Export == "")
				$nature_tbl->strremarks->ViewValue = ew_Highlight($nature_tbl->HighlightName(), $nature_tbl->strremarks->ViewValue, $nature_tbl->getSessionBasicSearchKeyword(), $nature_tbl->getSessionBasicSearchType(), $nature_tbl->getAdvancedSearch("x_strremarks"));
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $nature_tbl;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $nature_tbl->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($nature_tbl->ExportAll) {
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
		if ($nature_tbl->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($nature_tbl, "h");
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
