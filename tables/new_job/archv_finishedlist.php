<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "archv_finishedinfo.php" ?>
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
$archv_finished_list = new carchv_finished_list();
$Page =& $archv_finished_list;

// Page init
$archv_finished_list->Page_Init();

// Page main
$archv_finished_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($archv_finished->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var archv_finished_list = new ew_Page("archv_finished_list");

// page properties
archv_finished_list.PageID = "list"; // page ID
archv_finished_list.FormID = "farchv_finishedlist"; // form ID
var EW_PAGE_ID = archv_finished_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
archv_finished_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
archv_finished_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
archv_finished_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
archv_finished_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
archv_finished_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
archv_finished_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($archv_finished->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$archv_finished_list->lTotalRecs = $archv_finished->SelectRecordCount();
	} else {
		if ($rs = $archv_finished_list->LoadRecordset())
			$archv_finished_list->lTotalRecs = $rs->RecordCount();
	}
	$archv_finished_list->lStartRec = 1;
	if ($archv_finished_list->lDisplayRecs <= 0 || ($archv_finished->Export <> "" && $archv_finished->ExportAll)) // Display all records
		$archv_finished_list->lDisplayRecs = $archv_finished_list->lTotalRecs;
	if (!($archv_finished->Export <> "" && $archv_finished->ExportAll))
		$archv_finished_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $archv_finished_list->LoadRecordset($archv_finished_list->lStartRec-1, $archv_finished_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $archv_finished->TableCaption() ?>
<?php if ($archv_finished->Export == "" && $archv_finished->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $archv_finished_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $archv_finished_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($archv_finished->Export == "" && $archv_finished->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(archv_finished_list);" style="text-decoration: none;"><img id="archv_finished_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="archv_finished_list_SearchPanel">
<form name="farchv_finishedlistsrch" id="farchv_finishedlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="archv_finished">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($archv_finished->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $archv_finished_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="archv_finishedsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($archv_finished_list->sSrchWhere <> "" && $archv_finished_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(archv_finished_list, this, '<?php echo $archv_finished->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($archv_finished->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($archv_finished->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($archv_finished->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$archv_finished_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="farchv_finishedlist" id="farchv_finishedlist" class="ewForm" action="" method="post">
<div id="gmp_archv_finished" class="ewGridMiddlePanel">
<?php if ($archv_finished_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $archv_finished->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$archv_finished_list->RenderListOptions();

// Render list options (header, left)
$archv_finished_list->ListOptions->Render("header", "left");
?>
<?php if ($archv_finished->ID->Visible) { // ID ?>
	<?php if ($archv_finished->SortUrl($archv_finished->ID) == "") { ?>
		<td><?php echo $archv_finished->ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($archv_finished->ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strjrfnum->Visible) { // strjrfnum ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strjrfnum) == "") { ?>
		<td><?php echo $archv_finished->strjrfnum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strjrfnum) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strjrfnum->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strjrfnum->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strjrfnum->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strquarter->Visible) { // strquarter ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strquarter) == "") { ?>
		<td><?php echo $archv_finished->strquarter->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strquarter) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strquarter->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strquarter->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strquarter->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strmon->Visible) { // strmon ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strmon) == "") { ?>
		<td><?php echo $archv_finished->strmon->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strmon) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strmon->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strmon->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strmon->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->stryear->Visible) { // stryear ?>
	<?php if ($archv_finished->SortUrl($archv_finished->stryear) == "") { ?>
		<td><?php echo $archv_finished->stryear->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->stryear) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->stryear->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->stryear->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->stryear->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strdate->Visible) { // strdate ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strdate) == "") { ?>
		<td><?php echo $archv_finished->strdate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strdate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strdate->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strtime->Visible) { // strtime ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strtime) == "") { ?>
		<td><?php echo $archv_finished->strtime->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strtime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strtime->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strtime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strtime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strusername->Visible) { // strusername ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strusername) == "") { ?>
		<td><?php echo $archv_finished->strusername->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strusername) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strusername->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strusername->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strusername->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strusereadd->Visible) { // strusereadd ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strusereadd) == "") { ?>
		<td><?php echo $archv_finished->strusereadd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strusereadd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strusereadd->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strusereadd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strusereadd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strcompany->Visible) { // strcompany ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strcompany) == "") { ?>
		<td><?php echo $archv_finished->strcompany->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strcompany) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strcompany->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strcompany->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strcompany->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strdepartment->Visible) { // strdepartment ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strdepartment) == "") { ?>
		<td><?php echo $archv_finished->strdepartment->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strdepartment) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strdepartment->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strdepartment->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strdepartment->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strloc->Visible) { // strloc ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strloc) == "") { ?>
		<td><?php echo $archv_finished->strloc->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strloc) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strloc->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strloc->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strloc->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strposition->Visible) { // strposition ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strposition) == "") { ?>
		<td><?php echo $archv_finished->strposition->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strposition) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strposition->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strposition->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strposition->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strtelephone->Visible) { // strtelephone ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strtelephone) == "") { ?>
		<td><?php echo $archv_finished->strtelephone->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strtelephone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strtelephone->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strtelephone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strtelephone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strcostcent->Visible) { // strcostcent ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strcostcent) == "") { ?>
		<td><?php echo $archv_finished->strcostcent->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strcostcent) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strcostcent->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strcostcent->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strcostcent->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strsubject->Visible) { // strsubject ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strsubject) == "") { ?>
		<td><?php echo $archv_finished->strsubject->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strsubject) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strsubject->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strsubject->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strsubject->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strnature->Visible) { // strnature ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strnature) == "") { ?>
		<td><?php echo $archv_finished->strnature->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strnature) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strnature->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strnature->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strnature->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strdescript->Visible) { // strdescript ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strdescript) == "") { ?>
		<td><?php echo $archv_finished->strdescript->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strdescript) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strdescript->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strdescript->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strdescript->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strarea->Visible) { // strarea ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strarea) == "") { ?>
		<td><?php echo $archv_finished->strarea->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strarea) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strarea->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strarea->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strarea->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strattach->Visible) { // strattach ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strattach) == "") { ?>
		<td><?php echo $archv_finished->strattach->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strattach) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strattach->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strattach->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strattach->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strpriority->Visible) { // strpriority ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strpriority) == "") { ?>
		<td><?php echo $archv_finished->strpriority->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strpriority) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strpriority->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strpriority->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strpriority->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strduedate->Visible) { // strduedate ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strduedate) == "") { ?>
		<td><?php echo $archv_finished->strduedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strduedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strduedate->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strduedate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strduedate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strstatus->Visible) { // strstatus ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strstatus) == "") { ?>
		<td><?php echo $archv_finished->strstatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strstatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strstatus->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strstatus->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strstatus->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strlastedit->Visible) { // strlastedit ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strlastedit) == "") { ?>
		<td><?php echo $archv_finished->strlastedit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strlastedit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strlastedit->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strlastedit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strlastedit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strcategory->Visible) { // strcategory ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strcategory) == "") { ?>
		<td><?php echo $archv_finished->strcategory->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strcategory) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strcategory->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strcategory->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strcategory->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strassigned->Visible) { // strassigned ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strassigned) == "") { ?>
		<td><?php echo $archv_finished->strassigned->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strassigned) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strassigned->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strassigned->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strassigned->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strdatecomplete->Visible) { // strdatecomplete ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strdatecomplete) == "") { ?>
		<td><?php echo $archv_finished->strdatecomplete->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strdatecomplete) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strdatecomplete->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strdatecomplete->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strdatecomplete->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strwithpr->Visible) { // strwithpr ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strwithpr) == "") { ?>
		<td><?php echo $archv_finished->strwithpr->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strwithpr) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strwithpr->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strwithpr->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strwithpr->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->strremarks->Visible) { // strremarks ?>
	<?php if ($archv_finished->SortUrl($archv_finished->strremarks) == "") { ?>
		<td><?php echo $archv_finished->strremarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->strremarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->strremarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->strremarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->strremarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->sap_num->Visible) { // sap_num ?>
	<?php if ($archv_finished->SortUrl($archv_finished->sap_num) == "") { ?>
		<td><?php echo $archv_finished->sap_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->sap_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->sap_num->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->sap_num->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->sap_num->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($archv_finished->work_days->Visible) { // work_days ?>
	<?php if ($archv_finished->SortUrl($archv_finished->work_days) == "") { ?>
		<td><?php echo $archv_finished->work_days->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $archv_finished->SortUrl($archv_finished->work_days) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $archv_finished->work_days->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($archv_finished->work_days->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($archv_finished->work_days->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$archv_finished_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($archv_finished->ExportAll && $archv_finished->Export <> "") {
	$archv_finished_list->lStopRec = $archv_finished_list->lTotalRecs;
} else {
	$archv_finished_list->lStopRec = $archv_finished_list->lStartRec + $archv_finished_list->lDisplayRecs - 1; // Set the last record to display
}
$archv_finished_list->lRecCount = $archv_finished_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $archv_finished_list->lStartRec > 1)
		$rs->Move($archv_finished_list->lStartRec - 1);
}

// Initialize aggregate
$archv_finished->RowType = EW_ROWTYPE_AGGREGATEINIT;
$archv_finished_list->RenderRow();
$archv_finished_list->lRowCnt = 0;
while (($archv_finished->CurrentAction == "gridadd" || !$rs->EOF) &&
	$archv_finished_list->lRecCount < $archv_finished_list->lStopRec) {
	$archv_finished_list->lRecCount++;
	if (intval($archv_finished_list->lRecCount) >= intval($archv_finished_list->lStartRec)) {
		$archv_finished_list->lRowCnt++;

	// Init row class and style
	$archv_finished->CssClass = "";
	$archv_finished->CssStyle = "";
	$archv_finished->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($archv_finished->CurrentAction == "gridadd") {
		$archv_finished_list->LoadDefaultValues(); // Load default values
	} else {
		$archv_finished_list->LoadRowValues($rs); // Load row values
	}
	$archv_finished->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$archv_finished_list->RenderRow();

	// Render list options
	$archv_finished_list->RenderListOptions();
?>
	<tr<?php echo $archv_finished->RowAttributes() ?>>
<?php

// Render list options (body, left)
$archv_finished_list->ListOptions->Render("body", "left");
?>
	<?php if ($archv_finished->ID->Visible) { // ID ?>
		<td<?php echo $archv_finished->ID->CellAttributes() ?>>
<div<?php echo $archv_finished->ID->ViewAttributes() ?>><?php echo $archv_finished->ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strjrfnum->Visible) { // strjrfnum ?>
		<td<?php echo $archv_finished->strjrfnum->CellAttributes() ?>>
<div<?php echo $archv_finished->strjrfnum->ViewAttributes() ?>><?php echo $archv_finished->strjrfnum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strquarter->Visible) { // strquarter ?>
		<td<?php echo $archv_finished->strquarter->CellAttributes() ?>>
<div<?php echo $archv_finished->strquarter->ViewAttributes() ?>><?php echo $archv_finished->strquarter->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strmon->Visible) { // strmon ?>
		<td<?php echo $archv_finished->strmon->CellAttributes() ?>>
<div<?php echo $archv_finished->strmon->ViewAttributes() ?>><?php echo $archv_finished->strmon->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->stryear->Visible) { // stryear ?>
		<td<?php echo $archv_finished->stryear->CellAttributes() ?>>
<div<?php echo $archv_finished->stryear->ViewAttributes() ?>><?php echo $archv_finished->stryear->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strdate->Visible) { // strdate ?>
		<td<?php echo $archv_finished->strdate->CellAttributes() ?>>
<div<?php echo $archv_finished->strdate->ViewAttributes() ?>><?php echo $archv_finished->strdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strtime->Visible) { // strtime ?>
		<td<?php echo $archv_finished->strtime->CellAttributes() ?>>
<div<?php echo $archv_finished->strtime->ViewAttributes() ?>><?php echo $archv_finished->strtime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strusername->Visible) { // strusername ?>
		<td<?php echo $archv_finished->strusername->CellAttributes() ?>>
<div<?php echo $archv_finished->strusername->ViewAttributes() ?>><?php echo $archv_finished->strusername->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strusereadd->Visible) { // strusereadd ?>
		<td<?php echo $archv_finished->strusereadd->CellAttributes() ?>>
<div<?php echo $archv_finished->strusereadd->ViewAttributes() ?>><?php echo $archv_finished->strusereadd->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strcompany->Visible) { // strcompany ?>
		<td<?php echo $archv_finished->strcompany->CellAttributes() ?>>
<div<?php echo $archv_finished->strcompany->ViewAttributes() ?>><?php echo $archv_finished->strcompany->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strdepartment->Visible) { // strdepartment ?>
		<td<?php echo $archv_finished->strdepartment->CellAttributes() ?>>
<div<?php echo $archv_finished->strdepartment->ViewAttributes() ?>><?php echo $archv_finished->strdepartment->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strloc->Visible) { // strloc ?>
		<td<?php echo $archv_finished->strloc->CellAttributes() ?>>
<div<?php echo $archv_finished->strloc->ViewAttributes() ?>><?php echo $archv_finished->strloc->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strposition->Visible) { // strposition ?>
		<td<?php echo $archv_finished->strposition->CellAttributes() ?>>
<div<?php echo $archv_finished->strposition->ViewAttributes() ?>><?php echo $archv_finished->strposition->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strtelephone->Visible) { // strtelephone ?>
		<td<?php echo $archv_finished->strtelephone->CellAttributes() ?>>
<div<?php echo $archv_finished->strtelephone->ViewAttributes() ?>><?php echo $archv_finished->strtelephone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strcostcent->Visible) { // strcostcent ?>
		<td<?php echo $archv_finished->strcostcent->CellAttributes() ?>>
<div<?php echo $archv_finished->strcostcent->ViewAttributes() ?>><?php echo $archv_finished->strcostcent->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strsubject->Visible) { // strsubject ?>
		<td<?php echo $archv_finished->strsubject->CellAttributes() ?>>
<div<?php echo $archv_finished->strsubject->ViewAttributes() ?>><?php echo $archv_finished->strsubject->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strnature->Visible) { // strnature ?>
		<td<?php echo $archv_finished->strnature->CellAttributes() ?>>
<div<?php echo $archv_finished->strnature->ViewAttributes() ?>><?php echo $archv_finished->strnature->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strdescript->Visible) { // strdescript ?>
		<td<?php echo $archv_finished->strdescript->CellAttributes() ?>>
<div<?php echo $archv_finished->strdescript->ViewAttributes() ?>><?php echo $archv_finished->strdescript->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strarea->Visible) { // strarea ?>
		<td<?php echo $archv_finished->strarea->CellAttributes() ?>>
<div<?php echo $archv_finished->strarea->ViewAttributes() ?>><?php echo $archv_finished->strarea->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strattach->Visible) { // strattach ?>
		<td<?php echo $archv_finished->strattach->CellAttributes() ?>>
<div<?php echo $archv_finished->strattach->ViewAttributes() ?>><?php echo $archv_finished->strattach->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strpriority->Visible) { // strpriority ?>
		<td<?php echo $archv_finished->strpriority->CellAttributes() ?>>
<div<?php echo $archv_finished->strpriority->ViewAttributes() ?>><?php echo $archv_finished->strpriority->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strduedate->Visible) { // strduedate ?>
		<td<?php echo $archv_finished->strduedate->CellAttributes() ?>>
<div<?php echo $archv_finished->strduedate->ViewAttributes() ?>><?php echo $archv_finished->strduedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strstatus->Visible) { // strstatus ?>
		<td<?php echo $archv_finished->strstatus->CellAttributes() ?>>
<div<?php echo $archv_finished->strstatus->ViewAttributes() ?>><?php echo $archv_finished->strstatus->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strlastedit->Visible) { // strlastedit ?>
		<td<?php echo $archv_finished->strlastedit->CellAttributes() ?>>
<div<?php echo $archv_finished->strlastedit->ViewAttributes() ?>><?php echo $archv_finished->strlastedit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strcategory->Visible) { // strcategory ?>
		<td<?php echo $archv_finished->strcategory->CellAttributes() ?>>
<div<?php echo $archv_finished->strcategory->ViewAttributes() ?>><?php echo $archv_finished->strcategory->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strassigned->Visible) { // strassigned ?>
		<td<?php echo $archv_finished->strassigned->CellAttributes() ?>>
<div<?php echo $archv_finished->strassigned->ViewAttributes() ?>><?php echo $archv_finished->strassigned->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strdatecomplete->Visible) { // strdatecomplete ?>
		<td<?php echo $archv_finished->strdatecomplete->CellAttributes() ?>>
<div<?php echo $archv_finished->strdatecomplete->ViewAttributes() ?>><?php echo $archv_finished->strdatecomplete->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strwithpr->Visible) { // strwithpr ?>
		<td<?php echo $archv_finished->strwithpr->CellAttributes() ?>>
<div<?php echo $archv_finished->strwithpr->ViewAttributes() ?>><?php echo $archv_finished->strwithpr->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->strremarks->Visible) { // strremarks ?>
		<td<?php echo $archv_finished->strremarks->CellAttributes() ?>>
<div<?php echo $archv_finished->strremarks->ViewAttributes() ?>><?php echo $archv_finished->strremarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->sap_num->Visible) { // sap_num ?>
		<td<?php echo $archv_finished->sap_num->CellAttributes() ?>>
<div<?php echo $archv_finished->sap_num->ViewAttributes() ?>><?php echo $archv_finished->sap_num->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($archv_finished->work_days->Visible) { // work_days ?>
		<td<?php echo $archv_finished->work_days->CellAttributes() ?>>
<div<?php echo $archv_finished->work_days->ViewAttributes() ?>><?php echo $archv_finished->work_days->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$archv_finished_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($archv_finished->CurrentAction <> "gridadd")
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
<?php if ($archv_finished->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($archv_finished->CurrentAction <> "gridadd" && $archv_finished->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($archv_finished_list->Pager)) $archv_finished_list->Pager = new cPrevNextPager($archv_finished_list->lStartRec, $archv_finished_list->lDisplayRecs, $archv_finished_list->lTotalRecs) ?>
<?php if ($archv_finished_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($archv_finished_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $archv_finished_list->PageUrl() ?>start=<?php echo $archv_finished_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($archv_finished_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $archv_finished_list->PageUrl() ?>start=<?php echo $archv_finished_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $archv_finished_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($archv_finished_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $archv_finished_list->PageUrl() ?>start=<?php echo $archv_finished_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($archv_finished_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $archv_finished_list->PageUrl() ?>start=<?php echo $archv_finished_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $archv_finished_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $archv_finished_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $archv_finished_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $archv_finished_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($archv_finished_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($archv_finished_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($archv_finished->Export == "" && $archv_finished->CurrentAction == "") { ?>
<?php } ?>
<?php if ($archv_finished->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$archv_finished_list->Page_Terminate();
?>
<?php

//
// Page class
//
class carchv_finished_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'archv_finished';

	// Page object name
	var $PageObjName = 'archv_finished_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $archv_finished;
		if ($archv_finished->UseTokenInUrl) $PageUrl .= "t=" . $archv_finished->TableVar . "&"; // Add page token
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
		global $objForm, $archv_finished;
		if ($archv_finished->UseTokenInUrl) {
			if ($objForm)
				return ($archv_finished->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($archv_finished->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function carchv_finished_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (archv_finished)
		$GLOBALS["archv_finished"] = new carchv_finished();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["archv_finished"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "archv_finisheddelete.php";
		$this->MultiUpdateUrl = "archv_finishedupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'archv_finished', TRUE);

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
		global $archv_finished;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$archv_finished->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$archv_finished->Export = $_POST["exporttype"];
		} else {
			$archv_finished->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $archv_finished->Export; // Get export parameter, used in header
		$gsExportFile = $archv_finished->TableVar; // Get export file, used in header
		if ($archv_finished->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($archv_finished->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $archv_finished;

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
			$archv_finished->Recordset_SearchValidated();

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
		if ($archv_finished->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $archv_finished->getRecordsPerPage(); // Restore from Session
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
		$archv_finished->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$archv_finished->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$archv_finished->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $archv_finished->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$archv_finished->setSessionWhere($sFilter);
		$archv_finished->CurrentFilter = "";

		// Export data only
		if (in_array($archv_finished->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($archv_finished->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $archv_finished;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $archv_finished->ID, FALSE); // ID
		$this->BuildSearchSql($sWhere, $archv_finished->strjrfnum, FALSE); // strjrfnum
		$this->BuildSearchSql($sWhere, $archv_finished->strquarter, FALSE); // strquarter
		$this->BuildSearchSql($sWhere, $archv_finished->strmon, FALSE); // strmon
		$this->BuildSearchSql($sWhere, $archv_finished->stryear, FALSE); // stryear
		$this->BuildSearchSql($sWhere, $archv_finished->strdate, FALSE); // strdate
		$this->BuildSearchSql($sWhere, $archv_finished->strtime, FALSE); // strtime
		$this->BuildSearchSql($sWhere, $archv_finished->strusername, FALSE); // strusername
		$this->BuildSearchSql($sWhere, $archv_finished->strusereadd, FALSE); // strusereadd
		$this->BuildSearchSql($sWhere, $archv_finished->strcompany, FALSE); // strcompany
		$this->BuildSearchSql($sWhere, $archv_finished->strdepartment, FALSE); // strdepartment
		$this->BuildSearchSql($sWhere, $archv_finished->strloc, FALSE); // strloc
		$this->BuildSearchSql($sWhere, $archv_finished->strposition, FALSE); // strposition
		$this->BuildSearchSql($sWhere, $archv_finished->strtelephone, FALSE); // strtelephone
		$this->BuildSearchSql($sWhere, $archv_finished->strcostcent, FALSE); // strcostcent
		$this->BuildSearchSql($sWhere, $archv_finished->strsubject, FALSE); // strsubject
		$this->BuildSearchSql($sWhere, $archv_finished->strnature, FALSE); // strnature
		$this->BuildSearchSql($sWhere, $archv_finished->strdescript, FALSE); // strdescript
		$this->BuildSearchSql($sWhere, $archv_finished->strarea, FALSE); // strarea
		$this->BuildSearchSql($sWhere, $archv_finished->strattach, FALSE); // strattach
		$this->BuildSearchSql($sWhere, $archv_finished->strpriority, FALSE); // strpriority
		$this->BuildSearchSql($sWhere, $archv_finished->strduedate, FALSE); // strduedate
		$this->BuildSearchSql($sWhere, $archv_finished->strstatus, FALSE); // strstatus
		$this->BuildSearchSql($sWhere, $archv_finished->strlastedit, FALSE); // strlastedit
		$this->BuildSearchSql($sWhere, $archv_finished->strcategory, FALSE); // strcategory
		$this->BuildSearchSql($sWhere, $archv_finished->strassigned, FALSE); // strassigned
		$this->BuildSearchSql($sWhere, $archv_finished->strdatecomplete, FALSE); // strdatecomplete
		$this->BuildSearchSql($sWhere, $archv_finished->strwithpr, FALSE); // strwithpr
		$this->BuildSearchSql($sWhere, $archv_finished->strremarks, FALSE); // strremarks
		$this->BuildSearchSql($sWhere, $archv_finished->sap_num, FALSE); // sap_num
		$this->BuildSearchSql($sWhere, $archv_finished->work_days, FALSE); // work_days

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($archv_finished->ID); // ID
			$this->SetSearchParm($archv_finished->strjrfnum); // strjrfnum
			$this->SetSearchParm($archv_finished->strquarter); // strquarter
			$this->SetSearchParm($archv_finished->strmon); // strmon
			$this->SetSearchParm($archv_finished->stryear); // stryear
			$this->SetSearchParm($archv_finished->strdate); // strdate
			$this->SetSearchParm($archv_finished->strtime); // strtime
			$this->SetSearchParm($archv_finished->strusername); // strusername
			$this->SetSearchParm($archv_finished->strusereadd); // strusereadd
			$this->SetSearchParm($archv_finished->strcompany); // strcompany
			$this->SetSearchParm($archv_finished->strdepartment); // strdepartment
			$this->SetSearchParm($archv_finished->strloc); // strloc
			$this->SetSearchParm($archv_finished->strposition); // strposition
			$this->SetSearchParm($archv_finished->strtelephone); // strtelephone
			$this->SetSearchParm($archv_finished->strcostcent); // strcostcent
			$this->SetSearchParm($archv_finished->strsubject); // strsubject
			$this->SetSearchParm($archv_finished->strnature); // strnature
			$this->SetSearchParm($archv_finished->strdescript); // strdescript
			$this->SetSearchParm($archv_finished->strarea); // strarea
			$this->SetSearchParm($archv_finished->strattach); // strattach
			$this->SetSearchParm($archv_finished->strpriority); // strpriority
			$this->SetSearchParm($archv_finished->strduedate); // strduedate
			$this->SetSearchParm($archv_finished->strstatus); // strstatus
			$this->SetSearchParm($archv_finished->strlastedit); // strlastedit
			$this->SetSearchParm($archv_finished->strcategory); // strcategory
			$this->SetSearchParm($archv_finished->strassigned); // strassigned
			$this->SetSearchParm($archv_finished->strdatecomplete); // strdatecomplete
			$this->SetSearchParm($archv_finished->strwithpr); // strwithpr
			$this->SetSearchParm($archv_finished->strremarks); // strremarks
			$this->SetSearchParm($archv_finished->sap_num); // sap_num
			$this->SetSearchParm($archv_finished->work_days); // work_days
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
		global $archv_finished;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$archv_finished->setAdvancedSearch("x_$FldParm", $FldVal);
		$archv_finished->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$archv_finished->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$archv_finished->setAdvancedSearch("y_$FldParm", $FldVal2);
		$archv_finished->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $archv_finished;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $archv_finished->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $archv_finished->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $archv_finished->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $archv_finished->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $archv_finished->GetAdvancedSearch("w_$FldParm");
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
		global $archv_finished;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strjrfnum, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strquarter, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strmon, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->stryear, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strdate, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strtime, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strusername, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strusereadd, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strcompany, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strdepartment, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strloc, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strposition, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strtelephone, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strcostcent, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strsubject, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strnature, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strdescript, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strarea, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strattach, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strpriority, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strduedate, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strstatus, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strlastedit, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strcategory, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strassigned, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strdatecomplete, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strwithpr, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->strremarks, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->sap_num, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $archv_finished->work_days, $Keyword);
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
		global $Security, $archv_finished;
		$sSearchStr = "";
		$sSearchKeyword = $archv_finished->BasicSearchKeyword;
		$sSearchType = $archv_finished->BasicSearchType;
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
			$archv_finished->setSessionBasicSearchKeyword($sSearchKeyword);
			$archv_finished->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $archv_finished;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$archv_finished->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $archv_finished;
		$archv_finished->setSessionBasicSearchKeyword("");
		$archv_finished->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $archv_finished;
		$archv_finished->setAdvancedSearch("x_ID", "");
		$archv_finished->setAdvancedSearch("x_strjrfnum", "");
		$archv_finished->setAdvancedSearch("x_strquarter", "");
		$archv_finished->setAdvancedSearch("x_strmon", "");
		$archv_finished->setAdvancedSearch("x_stryear", "");
		$archv_finished->setAdvancedSearch("x_strdate", "");
		$archv_finished->setAdvancedSearch("x_strtime", "");
		$archv_finished->setAdvancedSearch("x_strusername", "");
		$archv_finished->setAdvancedSearch("x_strusereadd", "");
		$archv_finished->setAdvancedSearch("x_strcompany", "");
		$archv_finished->setAdvancedSearch("x_strdepartment", "");
		$archv_finished->setAdvancedSearch("x_strloc", "");
		$archv_finished->setAdvancedSearch("x_strposition", "");
		$archv_finished->setAdvancedSearch("x_strtelephone", "");
		$archv_finished->setAdvancedSearch("x_strcostcent", "");
		$archv_finished->setAdvancedSearch("x_strsubject", "");
		$archv_finished->setAdvancedSearch("x_strnature", "");
		$archv_finished->setAdvancedSearch("x_strdescript", "");
		$archv_finished->setAdvancedSearch("x_strarea", "");
		$archv_finished->setAdvancedSearch("x_strattach", "");
		$archv_finished->setAdvancedSearch("x_strpriority", "");
		$archv_finished->setAdvancedSearch("x_strduedate", "");
		$archv_finished->setAdvancedSearch("x_strstatus", "");
		$archv_finished->setAdvancedSearch("x_strlastedit", "");
		$archv_finished->setAdvancedSearch("x_strcategory", "");
		$archv_finished->setAdvancedSearch("x_strassigned", "");
		$archv_finished->setAdvancedSearch("x_strdatecomplete", "");
		$archv_finished->setAdvancedSearch("x_strwithpr", "");
		$archv_finished->setAdvancedSearch("x_strremarks", "");
		$archv_finished->setAdvancedSearch("x_sap_num", "");
		$archv_finished->setAdvancedSearch("x_work_days", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $archv_finished;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strjrfnum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strquarter"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strmon"] <> "") $bRestore = FALSE;
		if (@$_GET["x_stryear"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strtime"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strusername"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strusereadd"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcompany"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdepartment"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strloc"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strposition"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strtelephone"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcostcent"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strsubject"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strnature"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdescript"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strarea"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strattach"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strpriority"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strduedate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strstatus"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strlastedit"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcategory"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strassigned"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdatecomplete"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strwithpr"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strremarks"] <> "") $bRestore = FALSE;
		if (@$_GET["x_sap_num"] <> "") $bRestore = FALSE;
		if (@$_GET["x_work_days"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$archv_finished->BasicSearchKeyword = $archv_finished->getSessionBasicSearchKeyword();
			$archv_finished->BasicSearchType = $archv_finished->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($archv_finished->ID);
			$this->GetSearchParm($archv_finished->strjrfnum);
			$this->GetSearchParm($archv_finished->strquarter);
			$this->GetSearchParm($archv_finished->strmon);
			$this->GetSearchParm($archv_finished->stryear);
			$this->GetSearchParm($archv_finished->strdate);
			$this->GetSearchParm($archv_finished->strtime);
			$this->GetSearchParm($archv_finished->strusername);
			$this->GetSearchParm($archv_finished->strusereadd);
			$this->GetSearchParm($archv_finished->strcompany);
			$this->GetSearchParm($archv_finished->strdepartment);
			$this->GetSearchParm($archv_finished->strloc);
			$this->GetSearchParm($archv_finished->strposition);
			$this->GetSearchParm($archv_finished->strtelephone);
			$this->GetSearchParm($archv_finished->strcostcent);
			$this->GetSearchParm($archv_finished->strsubject);
			$this->GetSearchParm($archv_finished->strnature);
			$this->GetSearchParm($archv_finished->strdescript);
			$this->GetSearchParm($archv_finished->strarea);
			$this->GetSearchParm($archv_finished->strattach);
			$this->GetSearchParm($archv_finished->strpriority);
			$this->GetSearchParm($archv_finished->strduedate);
			$this->GetSearchParm($archv_finished->strstatus);
			$this->GetSearchParm($archv_finished->strlastedit);
			$this->GetSearchParm($archv_finished->strcategory);
			$this->GetSearchParm($archv_finished->strassigned);
			$this->GetSearchParm($archv_finished->strdatecomplete);
			$this->GetSearchParm($archv_finished->strwithpr);
			$this->GetSearchParm($archv_finished->strremarks);
			$this->GetSearchParm($archv_finished->sap_num);
			$this->GetSearchParm($archv_finished->work_days);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $archv_finished;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$archv_finished->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$archv_finished->CurrentOrderType = @$_GET["ordertype"];
			$archv_finished->UpdateSort($archv_finished->ID); // ID
			$archv_finished->UpdateSort($archv_finished->strjrfnum); // strjrfnum
			$archv_finished->UpdateSort($archv_finished->strquarter); // strquarter
			$archv_finished->UpdateSort($archv_finished->strmon); // strmon
			$archv_finished->UpdateSort($archv_finished->stryear); // stryear
			$archv_finished->UpdateSort($archv_finished->strdate); // strdate
			$archv_finished->UpdateSort($archv_finished->strtime); // strtime
			$archv_finished->UpdateSort($archv_finished->strusername); // strusername
			$archv_finished->UpdateSort($archv_finished->strusereadd); // strusereadd
			$archv_finished->UpdateSort($archv_finished->strcompany); // strcompany
			$archv_finished->UpdateSort($archv_finished->strdepartment); // strdepartment
			$archv_finished->UpdateSort($archv_finished->strloc); // strloc
			$archv_finished->UpdateSort($archv_finished->strposition); // strposition
			$archv_finished->UpdateSort($archv_finished->strtelephone); // strtelephone
			$archv_finished->UpdateSort($archv_finished->strcostcent); // strcostcent
			$archv_finished->UpdateSort($archv_finished->strsubject); // strsubject
			$archv_finished->UpdateSort($archv_finished->strnature); // strnature
			$archv_finished->UpdateSort($archv_finished->strdescript); // strdescript
			$archv_finished->UpdateSort($archv_finished->strarea); // strarea
			$archv_finished->UpdateSort($archv_finished->strattach); // strattach
			$archv_finished->UpdateSort($archv_finished->strpriority); // strpriority
			$archv_finished->UpdateSort($archv_finished->strduedate); // strduedate
			$archv_finished->UpdateSort($archv_finished->strstatus); // strstatus
			$archv_finished->UpdateSort($archv_finished->strlastedit); // strlastedit
			$archv_finished->UpdateSort($archv_finished->strcategory); // strcategory
			$archv_finished->UpdateSort($archv_finished->strassigned); // strassigned
			$archv_finished->UpdateSort($archv_finished->strdatecomplete); // strdatecomplete
			$archv_finished->UpdateSort($archv_finished->strwithpr); // strwithpr
			$archv_finished->UpdateSort($archv_finished->strremarks); // strremarks
			$archv_finished->UpdateSort($archv_finished->sap_num); // sap_num
			$archv_finished->UpdateSort($archv_finished->work_days); // work_days
			$archv_finished->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $archv_finished;
		$sOrderBy = $archv_finished->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($archv_finished->SqlOrderBy() <> "") {
				$sOrderBy = $archv_finished->SqlOrderBy();
				$archv_finished->setSessionOrderBy($sOrderBy);
				$archv_finished->ID->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $archv_finished;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$archv_finished->setSessionOrderBy($sOrderBy);
				$archv_finished->ID->setSort("");
				$archv_finished->strjrfnum->setSort("");
				$archv_finished->strquarter->setSort("");
				$archv_finished->strmon->setSort("");
				$archv_finished->stryear->setSort("");
				$archv_finished->strdate->setSort("");
				$archv_finished->strtime->setSort("");
				$archv_finished->strusername->setSort("");
				$archv_finished->strusereadd->setSort("");
				$archv_finished->strcompany->setSort("");
				$archv_finished->strdepartment->setSort("");
				$archv_finished->strloc->setSort("");
				$archv_finished->strposition->setSort("");
				$archv_finished->strtelephone->setSort("");
				$archv_finished->strcostcent->setSort("");
				$archv_finished->strsubject->setSort("");
				$archv_finished->strnature->setSort("");
				$archv_finished->strdescript->setSort("");
				$archv_finished->strarea->setSort("");
				$archv_finished->strattach->setSort("");
				$archv_finished->strpriority->setSort("");
				$archv_finished->strduedate->setSort("");
				$archv_finished->strstatus->setSort("");
				$archv_finished->strlastedit->setSort("");
				$archv_finished->strcategory->setSort("");
				$archv_finished->strassigned->setSort("");
				$archv_finished->strdatecomplete->setSort("");
				$archv_finished->strwithpr->setSort("");
				$archv_finished->strremarks->setSort("");
				$archv_finished->sap_num->setSort("");
				$archv_finished->work_days->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$archv_finished->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $archv_finished;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($archv_finished->Export <> "" ||
			$archv_finished->CurrentAction == "gridadd" ||
			$archv_finished->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $archv_finished;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $archv_finished;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $archv_finished;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$archv_finished->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$archv_finished->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $archv_finished->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$archv_finished->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$archv_finished->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$archv_finished->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $archv_finished;
		$archv_finished->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$archv_finished->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $archv_finished;

		// Load search values
		// ID

		$archv_finished->ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ID"]);
		$archv_finished->ID->AdvancedSearch->SearchOperator = @$_GET["z_ID"];

		// strjrfnum
		$archv_finished->strjrfnum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strjrfnum"]);
		$archv_finished->strjrfnum->AdvancedSearch->SearchOperator = @$_GET["z_strjrfnum"];

		// strquarter
		$archv_finished->strquarter->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strquarter"]);
		$archv_finished->strquarter->AdvancedSearch->SearchOperator = @$_GET["z_strquarter"];

		// strmon
		$archv_finished->strmon->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strmon"]);
		$archv_finished->strmon->AdvancedSearch->SearchOperator = @$_GET["z_strmon"];

		// stryear
		$archv_finished->stryear->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_stryear"]);
		$archv_finished->stryear->AdvancedSearch->SearchOperator = @$_GET["z_stryear"];

		// strdate
		$archv_finished->strdate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdate"]);
		$archv_finished->strdate->AdvancedSearch->SearchOperator = @$_GET["z_strdate"];

		// strtime
		$archv_finished->strtime->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strtime"]);
		$archv_finished->strtime->AdvancedSearch->SearchOperator = @$_GET["z_strtime"];

		// strusername
		$archv_finished->strusername->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strusername"]);
		$archv_finished->strusername->AdvancedSearch->SearchOperator = @$_GET["z_strusername"];

		// strusereadd
		$archv_finished->strusereadd->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strusereadd"]);
		$archv_finished->strusereadd->AdvancedSearch->SearchOperator = @$_GET["z_strusereadd"];

		// strcompany
		$archv_finished->strcompany->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcompany"]);
		$archv_finished->strcompany->AdvancedSearch->SearchOperator = @$_GET["z_strcompany"];

		// strdepartment
		$archv_finished->strdepartment->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdepartment"]);
		$archv_finished->strdepartment->AdvancedSearch->SearchOperator = @$_GET["z_strdepartment"];

		// strloc
		$archv_finished->strloc->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strloc"]);
		$archv_finished->strloc->AdvancedSearch->SearchOperator = @$_GET["z_strloc"];

		// strposition
		$archv_finished->strposition->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strposition"]);
		$archv_finished->strposition->AdvancedSearch->SearchOperator = @$_GET["z_strposition"];

		// strtelephone
		$archv_finished->strtelephone->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strtelephone"]);
		$archv_finished->strtelephone->AdvancedSearch->SearchOperator = @$_GET["z_strtelephone"];

		// strcostcent
		$archv_finished->strcostcent->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcostcent"]);
		$archv_finished->strcostcent->AdvancedSearch->SearchOperator = @$_GET["z_strcostcent"];

		// strsubject
		$archv_finished->strsubject->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strsubject"]);
		$archv_finished->strsubject->AdvancedSearch->SearchOperator = @$_GET["z_strsubject"];

		// strnature
		$archv_finished->strnature->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strnature"]);
		$archv_finished->strnature->AdvancedSearch->SearchOperator = @$_GET["z_strnature"];

		// strdescript
		$archv_finished->strdescript->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdescript"]);
		$archv_finished->strdescript->AdvancedSearch->SearchOperator = @$_GET["z_strdescript"];

		// strarea
		$archv_finished->strarea->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strarea"]);
		$archv_finished->strarea->AdvancedSearch->SearchOperator = @$_GET["z_strarea"];

		// strattach
		$archv_finished->strattach->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strattach"]);
		$archv_finished->strattach->AdvancedSearch->SearchOperator = @$_GET["z_strattach"];

		// strpriority
		$archv_finished->strpriority->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strpriority"]);
		$archv_finished->strpriority->AdvancedSearch->SearchOperator = @$_GET["z_strpriority"];

		// strduedate
		$archv_finished->strduedate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strduedate"]);
		$archv_finished->strduedate->AdvancedSearch->SearchOperator = @$_GET["z_strduedate"];

		// strstatus
		$archv_finished->strstatus->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strstatus"]);
		$archv_finished->strstatus->AdvancedSearch->SearchOperator = @$_GET["z_strstatus"];

		// strlastedit
		$archv_finished->strlastedit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strlastedit"]);
		$archv_finished->strlastedit->AdvancedSearch->SearchOperator = @$_GET["z_strlastedit"];

		// strcategory
		$archv_finished->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcategory"]);
		$archv_finished->strcategory->AdvancedSearch->SearchOperator = @$_GET["z_strcategory"];

		// strassigned
		$archv_finished->strassigned->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strassigned"]);
		$archv_finished->strassigned->AdvancedSearch->SearchOperator = @$_GET["z_strassigned"];

		// strdatecomplete
		$archv_finished->strdatecomplete->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdatecomplete"]);
		$archv_finished->strdatecomplete->AdvancedSearch->SearchOperator = @$_GET["z_strdatecomplete"];

		// strwithpr
		$archv_finished->strwithpr->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strwithpr"]);
		$archv_finished->strwithpr->AdvancedSearch->SearchOperator = @$_GET["z_strwithpr"];

		// strremarks
		$archv_finished->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strremarks"]);
		$archv_finished->strremarks->AdvancedSearch->SearchOperator = @$_GET["z_strremarks"];

		// sap_num
		$archv_finished->sap_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sap_num"]);
		$archv_finished->sap_num->AdvancedSearch->SearchOperator = @$_GET["z_sap_num"];

		// work_days
		$archv_finished->work_days->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_work_days"]);
		$archv_finished->work_days->AdvancedSearch->SearchOperator = @$_GET["z_work_days"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $archv_finished;

		// Call Recordset Selecting event
		$archv_finished->Recordset_Selecting($archv_finished->CurrentFilter);

		// Load List page SQL
		$sSql = $archv_finished->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$archv_finished->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $archv_finished;
		$sFilter = $archv_finished->KeyFilter();

		// Call Row Selecting event
		$archv_finished->Row_Selecting($sFilter);

		// Load SQL based on filter
		$archv_finished->CurrentFilter = $sFilter;
		$sSql = $archv_finished->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$archv_finished->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $archv_finished;
		$archv_finished->ID->setDbValue($rs->fields('ID'));
		$archv_finished->strjrfnum->setDbValue($rs->fields('strjrfnum'));
		$archv_finished->strquarter->setDbValue($rs->fields('strquarter'));
		$archv_finished->strmon->setDbValue($rs->fields('strmon'));
		$archv_finished->stryear->setDbValue($rs->fields('stryear'));
		$archv_finished->strdate->setDbValue($rs->fields('strdate'));
		$archv_finished->strtime->setDbValue($rs->fields('strtime'));
		$archv_finished->strusername->setDbValue($rs->fields('strusername'));
		$archv_finished->strusereadd->setDbValue($rs->fields('strusereadd'));
		$archv_finished->strcompany->setDbValue($rs->fields('strcompany'));
		$archv_finished->strdepartment->setDbValue($rs->fields('strdepartment'));
		$archv_finished->strloc->setDbValue($rs->fields('strloc'));
		$archv_finished->strposition->setDbValue($rs->fields('strposition'));
		$archv_finished->strtelephone->setDbValue($rs->fields('strtelephone'));
		$archv_finished->strcostcent->setDbValue($rs->fields('strcostcent'));
		$archv_finished->strsubject->setDbValue($rs->fields('strsubject'));
		$archv_finished->strnature->setDbValue($rs->fields('strnature'));
		$archv_finished->strdescript->setDbValue($rs->fields('strdescript'));
		$archv_finished->strarea->setDbValue($rs->fields('strarea'));
		$archv_finished->strattach->setDbValue($rs->fields('strattach'));
		$archv_finished->strpriority->setDbValue($rs->fields('strpriority'));
		$archv_finished->strduedate->setDbValue($rs->fields('strduedate'));
		$archv_finished->strstatus->setDbValue($rs->fields('strstatus'));
		$archv_finished->strlastedit->setDbValue($rs->fields('strlastedit'));
		$archv_finished->strcategory->setDbValue($rs->fields('strcategory'));
		$archv_finished->strassigned->setDbValue($rs->fields('strassigned'));
		$archv_finished->strdatecomplete->setDbValue($rs->fields('strdatecomplete'));
		$archv_finished->strwithpr->setDbValue($rs->fields('strwithpr'));
		$archv_finished->strremarks->setDbValue($rs->fields('strremarks'));
		$archv_finished->sap_num->setDbValue($rs->fields('sap_num'));
		$archv_finished->work_days->setDbValue($rs->fields('work_days'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $archv_finished;

		// Initialize URLs
		$this->ViewUrl = $archv_finished->ViewUrl();
		$this->EditUrl = $archv_finished->EditUrl();
		$this->InlineEditUrl = $archv_finished->InlineEditUrl();
		$this->CopyUrl = $archv_finished->CopyUrl();
		$this->InlineCopyUrl = $archv_finished->InlineCopyUrl();
		$this->DeleteUrl = $archv_finished->DeleteUrl();

		// Call Row_Rendering event
		$archv_finished->Row_Rendering();

		// Common render codes for all row types
		// ID

		$archv_finished->ID->CellCssStyle = ""; $archv_finished->ID->CellCssClass = "";
		$archv_finished->ID->CellAttrs = array(); $archv_finished->ID->ViewAttrs = array(); $archv_finished->ID->EditAttrs = array();

		// strjrfnum
		$archv_finished->strjrfnum->CellCssStyle = ""; $archv_finished->strjrfnum->CellCssClass = "";
		$archv_finished->strjrfnum->CellAttrs = array(); $archv_finished->strjrfnum->ViewAttrs = array(); $archv_finished->strjrfnum->EditAttrs = array();

		// strquarter
		$archv_finished->strquarter->CellCssStyle = ""; $archv_finished->strquarter->CellCssClass = "";
		$archv_finished->strquarter->CellAttrs = array(); $archv_finished->strquarter->ViewAttrs = array(); $archv_finished->strquarter->EditAttrs = array();

		// strmon
		$archv_finished->strmon->CellCssStyle = ""; $archv_finished->strmon->CellCssClass = "";
		$archv_finished->strmon->CellAttrs = array(); $archv_finished->strmon->ViewAttrs = array(); $archv_finished->strmon->EditAttrs = array();

		// stryear
		$archv_finished->stryear->CellCssStyle = ""; $archv_finished->stryear->CellCssClass = "";
		$archv_finished->stryear->CellAttrs = array(); $archv_finished->stryear->ViewAttrs = array(); $archv_finished->stryear->EditAttrs = array();

		// strdate
		$archv_finished->strdate->CellCssStyle = ""; $archv_finished->strdate->CellCssClass = "";
		$archv_finished->strdate->CellAttrs = array(); $archv_finished->strdate->ViewAttrs = array(); $archv_finished->strdate->EditAttrs = array();

		// strtime
		$archv_finished->strtime->CellCssStyle = ""; $archv_finished->strtime->CellCssClass = "";
		$archv_finished->strtime->CellAttrs = array(); $archv_finished->strtime->ViewAttrs = array(); $archv_finished->strtime->EditAttrs = array();

		// strusername
		$archv_finished->strusername->CellCssStyle = ""; $archv_finished->strusername->CellCssClass = "";
		$archv_finished->strusername->CellAttrs = array(); $archv_finished->strusername->ViewAttrs = array(); $archv_finished->strusername->EditAttrs = array();

		// strusereadd
		$archv_finished->strusereadd->CellCssStyle = ""; $archv_finished->strusereadd->CellCssClass = "";
		$archv_finished->strusereadd->CellAttrs = array(); $archv_finished->strusereadd->ViewAttrs = array(); $archv_finished->strusereadd->EditAttrs = array();

		// strcompany
		$archv_finished->strcompany->CellCssStyle = ""; $archv_finished->strcompany->CellCssClass = "";
		$archv_finished->strcompany->CellAttrs = array(); $archv_finished->strcompany->ViewAttrs = array(); $archv_finished->strcompany->EditAttrs = array();

		// strdepartment
		$archv_finished->strdepartment->CellCssStyle = ""; $archv_finished->strdepartment->CellCssClass = "";
		$archv_finished->strdepartment->CellAttrs = array(); $archv_finished->strdepartment->ViewAttrs = array(); $archv_finished->strdepartment->EditAttrs = array();

		// strloc
		$archv_finished->strloc->CellCssStyle = ""; $archv_finished->strloc->CellCssClass = "";
		$archv_finished->strloc->CellAttrs = array(); $archv_finished->strloc->ViewAttrs = array(); $archv_finished->strloc->EditAttrs = array();

		// strposition
		$archv_finished->strposition->CellCssStyle = ""; $archv_finished->strposition->CellCssClass = "";
		$archv_finished->strposition->CellAttrs = array(); $archv_finished->strposition->ViewAttrs = array(); $archv_finished->strposition->EditAttrs = array();

		// strtelephone
		$archv_finished->strtelephone->CellCssStyle = ""; $archv_finished->strtelephone->CellCssClass = "";
		$archv_finished->strtelephone->CellAttrs = array(); $archv_finished->strtelephone->ViewAttrs = array(); $archv_finished->strtelephone->EditAttrs = array();

		// strcostcent
		$archv_finished->strcostcent->CellCssStyle = ""; $archv_finished->strcostcent->CellCssClass = "";
		$archv_finished->strcostcent->CellAttrs = array(); $archv_finished->strcostcent->ViewAttrs = array(); $archv_finished->strcostcent->EditAttrs = array();

		// strsubject
		$archv_finished->strsubject->CellCssStyle = ""; $archv_finished->strsubject->CellCssClass = "";
		$archv_finished->strsubject->CellAttrs = array(); $archv_finished->strsubject->ViewAttrs = array(); $archv_finished->strsubject->EditAttrs = array();

		// strnature
		$archv_finished->strnature->CellCssStyle = ""; $archv_finished->strnature->CellCssClass = "";
		$archv_finished->strnature->CellAttrs = array(); $archv_finished->strnature->ViewAttrs = array(); $archv_finished->strnature->EditAttrs = array();

		// strdescript
		$archv_finished->strdescript->CellCssStyle = ""; $archv_finished->strdescript->CellCssClass = "";
		$archv_finished->strdescript->CellAttrs = array(); $archv_finished->strdescript->ViewAttrs = array(); $archv_finished->strdescript->EditAttrs = array();

		// strarea
		$archv_finished->strarea->CellCssStyle = ""; $archv_finished->strarea->CellCssClass = "";
		$archv_finished->strarea->CellAttrs = array(); $archv_finished->strarea->ViewAttrs = array(); $archv_finished->strarea->EditAttrs = array();

		// strattach
		$archv_finished->strattach->CellCssStyle = ""; $archv_finished->strattach->CellCssClass = "";
		$archv_finished->strattach->CellAttrs = array(); $archv_finished->strattach->ViewAttrs = array(); $archv_finished->strattach->EditAttrs = array();

		// strpriority
		$archv_finished->strpriority->CellCssStyle = ""; $archv_finished->strpriority->CellCssClass = "";
		$archv_finished->strpriority->CellAttrs = array(); $archv_finished->strpriority->ViewAttrs = array(); $archv_finished->strpriority->EditAttrs = array();

		// strduedate
		$archv_finished->strduedate->CellCssStyle = ""; $archv_finished->strduedate->CellCssClass = "";
		$archv_finished->strduedate->CellAttrs = array(); $archv_finished->strduedate->ViewAttrs = array(); $archv_finished->strduedate->EditAttrs = array();

		// strstatus
		$archv_finished->strstatus->CellCssStyle = ""; $archv_finished->strstatus->CellCssClass = "";
		$archv_finished->strstatus->CellAttrs = array(); $archv_finished->strstatus->ViewAttrs = array(); $archv_finished->strstatus->EditAttrs = array();

		// strlastedit
		$archv_finished->strlastedit->CellCssStyle = ""; $archv_finished->strlastedit->CellCssClass = "";
		$archv_finished->strlastedit->CellAttrs = array(); $archv_finished->strlastedit->ViewAttrs = array(); $archv_finished->strlastedit->EditAttrs = array();

		// strcategory
		$archv_finished->strcategory->CellCssStyle = ""; $archv_finished->strcategory->CellCssClass = "";
		$archv_finished->strcategory->CellAttrs = array(); $archv_finished->strcategory->ViewAttrs = array(); $archv_finished->strcategory->EditAttrs = array();

		// strassigned
		$archv_finished->strassigned->CellCssStyle = ""; $archv_finished->strassigned->CellCssClass = "";
		$archv_finished->strassigned->CellAttrs = array(); $archv_finished->strassigned->ViewAttrs = array(); $archv_finished->strassigned->EditAttrs = array();

		// strdatecomplete
		$archv_finished->strdatecomplete->CellCssStyle = ""; $archv_finished->strdatecomplete->CellCssClass = "";
		$archv_finished->strdatecomplete->CellAttrs = array(); $archv_finished->strdatecomplete->ViewAttrs = array(); $archv_finished->strdatecomplete->EditAttrs = array();

		// strwithpr
		$archv_finished->strwithpr->CellCssStyle = ""; $archv_finished->strwithpr->CellCssClass = "";
		$archv_finished->strwithpr->CellAttrs = array(); $archv_finished->strwithpr->ViewAttrs = array(); $archv_finished->strwithpr->EditAttrs = array();

		// strremarks
		$archv_finished->strremarks->CellCssStyle = ""; $archv_finished->strremarks->CellCssClass = "";
		$archv_finished->strremarks->CellAttrs = array(); $archv_finished->strremarks->ViewAttrs = array(); $archv_finished->strremarks->EditAttrs = array();

		// sap_num
		$archv_finished->sap_num->CellCssStyle = ""; $archv_finished->sap_num->CellCssClass = "";
		$archv_finished->sap_num->CellAttrs = array(); $archv_finished->sap_num->ViewAttrs = array(); $archv_finished->sap_num->EditAttrs = array();

		// work_days
		$archv_finished->work_days->CellCssStyle = ""; $archv_finished->work_days->CellCssClass = "";
		$archv_finished->work_days->CellAttrs = array(); $archv_finished->work_days->ViewAttrs = array(); $archv_finished->work_days->EditAttrs = array();
		if ($archv_finished->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$archv_finished->ID->ViewValue = $archv_finished->ID->CurrentValue;
			$archv_finished->ID->CssStyle = "";
			$archv_finished->ID->CssClass = "";
			$archv_finished->ID->ViewCustomAttributes = "";

			// strjrfnum
			$archv_finished->strjrfnum->ViewValue = $archv_finished->strjrfnum->CurrentValue;
			$archv_finished->strjrfnum->CssStyle = "";
			$archv_finished->strjrfnum->CssClass = "";
			$archv_finished->strjrfnum->ViewCustomAttributes = "";

			// strquarter
			$archv_finished->strquarter->ViewValue = $archv_finished->strquarter->CurrentValue;
			$archv_finished->strquarter->CssStyle = "";
			$archv_finished->strquarter->CssClass = "";
			$archv_finished->strquarter->ViewCustomAttributes = "";

			// strmon
			$archv_finished->strmon->ViewValue = $archv_finished->strmon->CurrentValue;
			$archv_finished->strmon->CssStyle = "";
			$archv_finished->strmon->CssClass = "";
			$archv_finished->strmon->ViewCustomAttributes = "";

			// stryear
			$archv_finished->stryear->ViewValue = $archv_finished->stryear->CurrentValue;
			$archv_finished->stryear->CssStyle = "";
			$archv_finished->stryear->CssClass = "";
			$archv_finished->stryear->ViewCustomAttributes = "";

			// strdate
			$archv_finished->strdate->ViewValue = $archv_finished->strdate->CurrentValue;
			$archv_finished->strdate->CssStyle = "";
			$archv_finished->strdate->CssClass = "";
			$archv_finished->strdate->ViewCustomAttributes = "";

			// strtime
			$archv_finished->strtime->ViewValue = $archv_finished->strtime->CurrentValue;
			$archv_finished->strtime->CssStyle = "";
			$archv_finished->strtime->CssClass = "";
			$archv_finished->strtime->ViewCustomAttributes = "";

			// strusername
			$archv_finished->strusername->ViewValue = $archv_finished->strusername->CurrentValue;
			$archv_finished->strusername->CssStyle = "";
			$archv_finished->strusername->CssClass = "";
			$archv_finished->strusername->ViewCustomAttributes = "";

			// strusereadd
			$archv_finished->strusereadd->ViewValue = $archv_finished->strusereadd->CurrentValue;
			$archv_finished->strusereadd->CssStyle = "";
			$archv_finished->strusereadd->CssClass = "";
			$archv_finished->strusereadd->ViewCustomAttributes = "";

			// strcompany
			$archv_finished->strcompany->ViewValue = $archv_finished->strcompany->CurrentValue;
			$archv_finished->strcompany->CssStyle = "";
			$archv_finished->strcompany->CssClass = "";
			$archv_finished->strcompany->ViewCustomAttributes = "";

			// strdepartment
			$archv_finished->strdepartment->ViewValue = $archv_finished->strdepartment->CurrentValue;
			$archv_finished->strdepartment->CssStyle = "";
			$archv_finished->strdepartment->CssClass = "";
			$archv_finished->strdepartment->ViewCustomAttributes = "";

			// strloc
			$archv_finished->strloc->ViewValue = $archv_finished->strloc->CurrentValue;
			$archv_finished->strloc->CssStyle = "";
			$archv_finished->strloc->CssClass = "";
			$archv_finished->strloc->ViewCustomAttributes = "";

			// strposition
			$archv_finished->strposition->ViewValue = $archv_finished->strposition->CurrentValue;
			$archv_finished->strposition->CssStyle = "";
			$archv_finished->strposition->CssClass = "";
			$archv_finished->strposition->ViewCustomAttributes = "";

			// strtelephone
			$archv_finished->strtelephone->ViewValue = $archv_finished->strtelephone->CurrentValue;
			$archv_finished->strtelephone->CssStyle = "";
			$archv_finished->strtelephone->CssClass = "";
			$archv_finished->strtelephone->ViewCustomAttributes = "";

			// strcostcent
			$archv_finished->strcostcent->ViewValue = $archv_finished->strcostcent->CurrentValue;
			$archv_finished->strcostcent->CssStyle = "";
			$archv_finished->strcostcent->CssClass = "";
			$archv_finished->strcostcent->ViewCustomAttributes = "";

			// strsubject
			$archv_finished->strsubject->ViewValue = $archv_finished->strsubject->CurrentValue;
			$archv_finished->strsubject->CssStyle = "";
			$archv_finished->strsubject->CssClass = "";
			$archv_finished->strsubject->ViewCustomAttributes = "";

			// strnature
			$archv_finished->strnature->ViewValue = $archv_finished->strnature->CurrentValue;
			$archv_finished->strnature->CssStyle = "";
			$archv_finished->strnature->CssClass = "";
			$archv_finished->strnature->ViewCustomAttributes = "";

			// strdescript
			$archv_finished->strdescript->ViewValue = $archv_finished->strdescript->CurrentValue;
			$archv_finished->strdescript->CssStyle = "";
			$archv_finished->strdescript->CssClass = "";
			$archv_finished->strdescript->ViewCustomAttributes = "";

			// strarea
			$archv_finished->strarea->ViewValue = $archv_finished->strarea->CurrentValue;
			$archv_finished->strarea->CssStyle = "";
			$archv_finished->strarea->CssClass = "";
			$archv_finished->strarea->ViewCustomAttributes = "";

			// strattach
			$archv_finished->strattach->ViewValue = $archv_finished->strattach->CurrentValue;
			$archv_finished->strattach->CssStyle = "";
			$archv_finished->strattach->CssClass = "";
			$archv_finished->strattach->ViewCustomAttributes = "";

			// strpriority
			$archv_finished->strpriority->ViewValue = $archv_finished->strpriority->CurrentValue;
			$archv_finished->strpriority->CssStyle = "";
			$archv_finished->strpriority->CssClass = "";
			$archv_finished->strpriority->ViewCustomAttributes = "";

			// strduedate
			$archv_finished->strduedate->ViewValue = $archv_finished->strduedate->CurrentValue;
			$archv_finished->strduedate->CssStyle = "";
			$archv_finished->strduedate->CssClass = "";
			$archv_finished->strduedate->ViewCustomAttributes = "";

			// strstatus
			$archv_finished->strstatus->ViewValue = $archv_finished->strstatus->CurrentValue;
			$archv_finished->strstatus->CssStyle = "";
			$archv_finished->strstatus->CssClass = "";
			$archv_finished->strstatus->ViewCustomAttributes = "";

			// strlastedit
			$archv_finished->strlastedit->ViewValue = $archv_finished->strlastedit->CurrentValue;
			$archv_finished->strlastedit->CssStyle = "";
			$archv_finished->strlastedit->CssClass = "";
			$archv_finished->strlastedit->ViewCustomAttributes = "";

			// strcategory
			$archv_finished->strcategory->ViewValue = $archv_finished->strcategory->CurrentValue;
			$archv_finished->strcategory->CssStyle = "";
			$archv_finished->strcategory->CssClass = "";
			$archv_finished->strcategory->ViewCustomAttributes = "";

			// strassigned
			$archv_finished->strassigned->ViewValue = $archv_finished->strassigned->CurrentValue;
			$archv_finished->strassigned->CssStyle = "";
			$archv_finished->strassigned->CssClass = "";
			$archv_finished->strassigned->ViewCustomAttributes = "";

			// strdatecomplete
			$archv_finished->strdatecomplete->ViewValue = $archv_finished->strdatecomplete->CurrentValue;
			$archv_finished->strdatecomplete->CssStyle = "";
			$archv_finished->strdatecomplete->CssClass = "";
			$archv_finished->strdatecomplete->ViewCustomAttributes = "";

			// strwithpr
			$archv_finished->strwithpr->ViewValue = $archv_finished->strwithpr->CurrentValue;
			$archv_finished->strwithpr->CssStyle = "";
			$archv_finished->strwithpr->CssClass = "";
			$archv_finished->strwithpr->ViewCustomAttributes = "";

			// strremarks
			$archv_finished->strremarks->ViewValue = $archv_finished->strremarks->CurrentValue;
			$archv_finished->strremarks->CssStyle = "";
			$archv_finished->strremarks->CssClass = "";
			$archv_finished->strremarks->ViewCustomAttributes = "";

			// sap_num
			$archv_finished->sap_num->ViewValue = $archv_finished->sap_num->CurrentValue;
			$archv_finished->sap_num->CssStyle = "";
			$archv_finished->sap_num->CssClass = "";
			$archv_finished->sap_num->ViewCustomAttributes = "";

			// work_days
			$archv_finished->work_days->ViewValue = $archv_finished->work_days->CurrentValue;
			$archv_finished->work_days->CssStyle = "";
			$archv_finished->work_days->CssClass = "";
			$archv_finished->work_days->ViewCustomAttributes = "";

			// ID
			$archv_finished->ID->HrefValue = "";
			$archv_finished->ID->TooltipValue = "";

			// strjrfnum
			$archv_finished->strjrfnum->HrefValue = "";
			$archv_finished->strjrfnum->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strjrfnum->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strjrfnum->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strjrfnum"));

			// strquarter
			$archv_finished->strquarter->HrefValue = "";
			$archv_finished->strquarter->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strquarter->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strquarter->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strquarter"));

			// strmon
			$archv_finished->strmon->HrefValue = "";
			$archv_finished->strmon->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strmon->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strmon->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strmon"));

			// stryear
			$archv_finished->stryear->HrefValue = "";
			$archv_finished->stryear->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->stryear->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->stryear->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_stryear"));

			// strdate
			$archv_finished->strdate->HrefValue = "";
			$archv_finished->strdate->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strdate->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strdate->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strdate"));

			// strtime
			$archv_finished->strtime->HrefValue = "";
			$archv_finished->strtime->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strtime->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strtime->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strtime"));

			// strusername
			$archv_finished->strusername->HrefValue = "";
			$archv_finished->strusername->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strusername->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strusername->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strusername"));

			// strusereadd
			$archv_finished->strusereadd->HrefValue = "";
			$archv_finished->strusereadd->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strusereadd->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strusereadd->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strusereadd"));

			// strcompany
			$archv_finished->strcompany->HrefValue = "";
			$archv_finished->strcompany->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strcompany->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strcompany->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strcompany"));

			// strdepartment
			$archv_finished->strdepartment->HrefValue = "";
			$archv_finished->strdepartment->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strdepartment->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strdepartment->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strdepartment"));

			// strloc
			$archv_finished->strloc->HrefValue = "";
			$archv_finished->strloc->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strloc->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strloc->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strloc"));

			// strposition
			$archv_finished->strposition->HrefValue = "";
			$archv_finished->strposition->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strposition->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strposition->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strposition"));

			// strtelephone
			$archv_finished->strtelephone->HrefValue = "";
			$archv_finished->strtelephone->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strtelephone->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strtelephone->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strtelephone"));

			// strcostcent
			$archv_finished->strcostcent->HrefValue = "";
			$archv_finished->strcostcent->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strcostcent->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strcostcent->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strcostcent"));

			// strsubject
			$archv_finished->strsubject->HrefValue = "";
			$archv_finished->strsubject->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strsubject->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strsubject->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strsubject"));

			// strnature
			$archv_finished->strnature->HrefValue = "";
			$archv_finished->strnature->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strnature->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strnature->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strnature"));

			// strdescript
			$archv_finished->strdescript->HrefValue = "";
			$archv_finished->strdescript->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strdescript->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strdescript->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strdescript"));

			// strarea
			$archv_finished->strarea->HrefValue = "";
			$archv_finished->strarea->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strarea->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strarea->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strarea"));

			// strattach
			$archv_finished->strattach->HrefValue = "";
			$archv_finished->strattach->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strattach->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strattach->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strattach"));

			// strpriority
			$archv_finished->strpriority->HrefValue = "";
			$archv_finished->strpriority->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strpriority->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strpriority->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strpriority"));

			// strduedate
			$archv_finished->strduedate->HrefValue = "";
			$archv_finished->strduedate->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strduedate->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strduedate->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strduedate"));

			// strstatus
			$archv_finished->strstatus->HrefValue = "";
			$archv_finished->strstatus->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strstatus->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strstatus->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strstatus"));

			// strlastedit
			$archv_finished->strlastedit->HrefValue = "";
			$archv_finished->strlastedit->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strlastedit->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strlastedit->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strlastedit"));

			// strcategory
			$archv_finished->strcategory->HrefValue = "";
			$archv_finished->strcategory->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strcategory->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strcategory->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strcategory"));

			// strassigned
			$archv_finished->strassigned->HrefValue = "";
			$archv_finished->strassigned->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strassigned->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strassigned->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strassigned"));

			// strdatecomplete
			$archv_finished->strdatecomplete->HrefValue = "";
			$archv_finished->strdatecomplete->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strdatecomplete->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strdatecomplete->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strdatecomplete"));

			// strwithpr
			$archv_finished->strwithpr->HrefValue = "";
			$archv_finished->strwithpr->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strwithpr->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strwithpr->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strwithpr"));

			// strremarks
			$archv_finished->strremarks->HrefValue = "";
			$archv_finished->strremarks->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->strremarks->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->strremarks->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_strremarks"));

			// sap_num
			$archv_finished->sap_num->HrefValue = "";
			$archv_finished->sap_num->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->sap_num->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->sap_num->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_sap_num"));

			// work_days
			$archv_finished->work_days->HrefValue = "";
			$archv_finished->work_days->TooltipValue = "";
			if ($archv_finished->Export == "")
				$archv_finished->work_days->ViewValue = ew_Highlight($archv_finished->HighlightName(), $archv_finished->work_days->ViewValue, $archv_finished->getSessionBasicSearchKeyword(), $archv_finished->getSessionBasicSearchType(), $archv_finished->getAdvancedSearch("x_work_days"));
		}

		// Call Row Rendered event
		if ($archv_finished->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$archv_finished->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $archv_finished;

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
		global $archv_finished;
		$archv_finished->ID->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_ID");
		$archv_finished->strjrfnum->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strjrfnum");
		$archv_finished->strquarter->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strquarter");
		$archv_finished->strmon->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strmon");
		$archv_finished->stryear->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_stryear");
		$archv_finished->strdate->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strdate");
		$archv_finished->strtime->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strtime");
		$archv_finished->strusername->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strusername");
		$archv_finished->strusereadd->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strusereadd");
		$archv_finished->strcompany->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strcompany");
		$archv_finished->strdepartment->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strdepartment");
		$archv_finished->strloc->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strloc");
		$archv_finished->strposition->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strposition");
		$archv_finished->strtelephone->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strtelephone");
		$archv_finished->strcostcent->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strcostcent");
		$archv_finished->strsubject->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strsubject");
		$archv_finished->strnature->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strnature");
		$archv_finished->strdescript->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strdescript");
		$archv_finished->strarea->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strarea");
		$archv_finished->strattach->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strattach");
		$archv_finished->strpriority->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strpriority");
		$archv_finished->strduedate->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strduedate");
		$archv_finished->strstatus->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strstatus");
		$archv_finished->strlastedit->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strlastedit");
		$archv_finished->strcategory->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strcategory");
		$archv_finished->strassigned->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strassigned");
		$archv_finished->strdatecomplete->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strdatecomplete");
		$archv_finished->strwithpr->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strwithpr");
		$archv_finished->strremarks->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_strremarks");
		$archv_finished->sap_num->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_sap_num");
		$archv_finished->work_days->AdvancedSearch->SearchValue = $archv_finished->getAdvancedSearch("x_work_days");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $archv_finished;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $archv_finished->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($archv_finished->ExportAll) {
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
		if ($archv_finished->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($archv_finished, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($archv_finished->ID);
				$ExportDoc->ExportCaption($archv_finished->strjrfnum);
				$ExportDoc->ExportCaption($archv_finished->strquarter);
				$ExportDoc->ExportCaption($archv_finished->strmon);
				$ExportDoc->ExportCaption($archv_finished->stryear);
				$ExportDoc->ExportCaption($archv_finished->strdate);
				$ExportDoc->ExportCaption($archv_finished->strtime);
				$ExportDoc->ExportCaption($archv_finished->strusername);
				$ExportDoc->ExportCaption($archv_finished->strusereadd);
				$ExportDoc->ExportCaption($archv_finished->strcompany);
				$ExportDoc->ExportCaption($archv_finished->strdepartment);
				$ExportDoc->ExportCaption($archv_finished->strloc);
				$ExportDoc->ExportCaption($archv_finished->strposition);
				$ExportDoc->ExportCaption($archv_finished->strtelephone);
				$ExportDoc->ExportCaption($archv_finished->strcostcent);
				$ExportDoc->ExportCaption($archv_finished->strsubject);
				$ExportDoc->ExportCaption($archv_finished->strnature);
				$ExportDoc->ExportCaption($archv_finished->strdescript);
				$ExportDoc->ExportCaption($archv_finished->strarea);
				$ExportDoc->ExportCaption($archv_finished->strattach);
				$ExportDoc->ExportCaption($archv_finished->strpriority);
				$ExportDoc->ExportCaption($archv_finished->strduedate);
				$ExportDoc->ExportCaption($archv_finished->strstatus);
				$ExportDoc->ExportCaption($archv_finished->strlastedit);
				$ExportDoc->ExportCaption($archv_finished->strcategory);
				$ExportDoc->ExportCaption($archv_finished->strassigned);
				$ExportDoc->ExportCaption($archv_finished->strdatecomplete);
				$ExportDoc->ExportCaption($archv_finished->strwithpr);
				$ExportDoc->ExportCaption($archv_finished->strremarks);
				$ExportDoc->ExportCaption($archv_finished->sap_num);
				$ExportDoc->ExportCaption($archv_finished->work_days);
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
				$archv_finished->CssClass = "";
				$archv_finished->CssStyle = "";
				$archv_finished->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($archv_finished->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $archv_finished->ID->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strjrfnum', $archv_finished->strjrfnum->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strquarter', $archv_finished->strquarter->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strmon', $archv_finished->strmon->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('stryear', $archv_finished->stryear->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdate', $archv_finished->strdate->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strtime', $archv_finished->strtime->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strusername', $archv_finished->strusername->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strusereadd', $archv_finished->strusereadd->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcompany', $archv_finished->strcompany->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdepartment', $archv_finished->strdepartment->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strloc', $archv_finished->strloc->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strposition', $archv_finished->strposition->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strtelephone', $archv_finished->strtelephone->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcostcent', $archv_finished->strcostcent->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strsubject', $archv_finished->strsubject->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strnature', $archv_finished->strnature->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdescript', $archv_finished->strdescript->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strarea', $archv_finished->strarea->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strattach', $archv_finished->strattach->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strpriority', $archv_finished->strpriority->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strduedate', $archv_finished->strduedate->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strstatus', $archv_finished->strstatus->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strlastedit', $archv_finished->strlastedit->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strcategory', $archv_finished->strcategory->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strassigned', $archv_finished->strassigned->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strdatecomplete', $archv_finished->strdatecomplete->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strwithpr', $archv_finished->strwithpr->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('strremarks', $archv_finished->strremarks->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('sap_num', $archv_finished->sap_num->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
					$XmlDoc->AddField('work_days', $archv_finished->work_days->ExportValue($archv_finished->Export, $archv_finished->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($archv_finished->ID);
					$ExportDoc->ExportField($archv_finished->strjrfnum);
					$ExportDoc->ExportField($archv_finished->strquarter);
					$ExportDoc->ExportField($archv_finished->strmon);
					$ExportDoc->ExportField($archv_finished->stryear);
					$ExportDoc->ExportField($archv_finished->strdate);
					$ExportDoc->ExportField($archv_finished->strtime);
					$ExportDoc->ExportField($archv_finished->strusername);
					$ExportDoc->ExportField($archv_finished->strusereadd);
					$ExportDoc->ExportField($archv_finished->strcompany);
					$ExportDoc->ExportField($archv_finished->strdepartment);
					$ExportDoc->ExportField($archv_finished->strloc);
					$ExportDoc->ExportField($archv_finished->strposition);
					$ExportDoc->ExportField($archv_finished->strtelephone);
					$ExportDoc->ExportField($archv_finished->strcostcent);
					$ExportDoc->ExportField($archv_finished->strsubject);
					$ExportDoc->ExportField($archv_finished->strnature);
					$ExportDoc->ExportField($archv_finished->strdescript);
					$ExportDoc->ExportField($archv_finished->strarea);
					$ExportDoc->ExportField($archv_finished->strattach);
					$ExportDoc->ExportField($archv_finished->strpriority);
					$ExportDoc->ExportField($archv_finished->strduedate);
					$ExportDoc->ExportField($archv_finished->strstatus);
					$ExportDoc->ExportField($archv_finished->strlastedit);
					$ExportDoc->ExportField($archv_finished->strcategory);
					$ExportDoc->ExportField($archv_finished->strassigned);
					$ExportDoc->ExportField($archv_finished->strdatecomplete);
					$ExportDoc->ExportField($archv_finished->strwithpr);
					$ExportDoc->ExportField($archv_finished->strremarks);
					$ExportDoc->ExportField($archv_finished->sap_num);
					$ExportDoc->ExportField($archv_finished->work_days);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($archv_finished->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($archv_finished->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($archv_finished->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($archv_finished->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($archv_finished->ExportReturnUrl());
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
