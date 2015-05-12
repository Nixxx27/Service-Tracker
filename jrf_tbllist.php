<?php
include('sec_access.php');
require 'class.php';
ob_start(); // Turn on output buffering


switch ($global_authorization) {
	case 'user':
		echo "<script type=text/javascript>alert('Sorry!, You are Not Authorized to acces this page');window.location.href='welcome.php';</script>";
		break;
	default:
		break;
}

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
<?php include "jrf_tblinfo.php" ?>
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
$jrf_tbl_list = new cjrf_tbl_list();
$Page =& $jrf_tbl_list;

// Page init
$jrf_tbl_list->Page_Init();

// Page main
$jrf_tbl_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($jrf_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_list = new ew_Page("jrf_tbl_list");

// page properties
jrf_tbl_list.PageID = "list"; // page ID
jrf_tbl_list.FormID = "fjrf_tbllist"; // form ID
var EW_PAGE_ID = jrf_tbl_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
jrf_tbl_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
jrf_tbl_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($jrf_tbl->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$jrf_tbl_list->lTotalRecs = $jrf_tbl->SelectRecordCount();
	} else {
		if ($rs = $jrf_tbl_list->LoadRecordset())
			$jrf_tbl_list->lTotalRecs = $rs->RecordCount();
	}
	$jrf_tbl_list->lStartRec = 1;
	if ($jrf_tbl_list->lDisplayRecs <= 0 || ($jrf_tbl->Export <> "" && $jrf_tbl->ExportAll)) // Display all records
		$jrf_tbl_list->lDisplayRecs = $jrf_tbl_list->lTotalRecs;
	if (!($jrf_tbl->Export <> "" && $jrf_tbl->ExportAll))
		$jrf_tbl_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $jrf_tbl_list->LoadRecordset($jrf_tbl_list->lStartRec-1, $jrf_tbl_list->lDisplayRecs);
?>
<?php if ($jrf_tbl->Export == "" && $jrf_tbl->CurrentAction == "") { ?>
<?php } ?>
<?php if ($jrf_tbl->Export == "" && $jrf_tbl->CurrentAction == "") { ?>
<?php include('fmd-nav.php'); ?>
<div class="row">
    <div class="col-lg-12">
    	<?php
    		// all
    		$query = "SELECT COUNT(*) AS total FROM jrf_tbl";
    		$result = mysql_query($query); 
    		$values = mysql_fetch_assoc($result); 
   			$num_total = $values['total'];  

   			if (isset($_GET['filter_section'])) {
   				$section = $_GET['filter_section'];

   				if($section=="Clear Filter"){
					echo  "<script type=text/javascript>window.location.href='jrf_tbllist.php?cmd=reset';</script>";
   				}else{
					echo  "<script type=text/javascript>window.location.href='jrf_tbllist.php?x_strcategory=$section&z_strcategory=LIKE';</script>";
   				}
   			}

			//overdue notification
   			if ($num_total_over_due > 0) {
					$overdue_notification ="<a href='jrf_tbllist.php?x_strifoverdue=overdue&z_strifoverdue=LIKE' style='color:red' title='click to view'>" . $num_total_over_due . " " . "overdue " .  "<img src='img/system/buttons/warning.gif' width=18px height=17px>" . "</a>";
				}else{
						$overdue_notification ="";
				} 

			

		?>
    			<h3><strong><i class="fa fa-wrench"></i> JOB REQUEST <small>In-Progress & New Records</small> <span class="badge" title="Total Request">&nbsp;<?php echo $num_total; ?>&nbsp;</span> <small style="color:red;font-weight:bold"><?php echo $overdue_notification ?></small> </strong></h3>
    </div>
   
</div>


    	<hr>
<div class="row">
	<div class="col-lg-6">

<a href="javascript:ew_ToggleSearchPanel(jrf_tbl_list);" style="text-decoration: none;"><img id="jrf_tbl_list_SearchImage" src="images/collapse.gif" alt="" width="10" height="10" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="jrf_tbl_list_SearchPanel">
<form name="fjrf_tbllistsrch" id="fjrf_tbllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="jrf_tbl">
<table class="ewBasicSearch" style="margin-left:50px">
	<tr>
		<td><span class="phpmaker">
			<input type="text" class="searchbox" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($jrf_tbl->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit"  class="btn btn-primary btn-sm" id="Submit" value="Search">

			<img src="img/system/buttons/export_excel.png" title="Export to Excel" onclick="javascript:location.href='<?php echo $jrf_tbl_list->ExportExcelUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/csv.png" title="Export to CSV" onclick="javascript:location.href='<?php echo $jrf_tbl_list->ExportCsvUrl ?>'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/showall.png" title="Show All" onclick="javascript:location.href='<?php echo $jrf_tbl_list->PageUrl() ?>cmd=reset'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src="img/system/buttons/advanced_search.png" title="Advanced Search" onclick="javascript:location.href='jrf_tblsrch.php'" class='onhover cursorpointer' height='40px' width='auto'>
			<img src='img/system/buttons/with_pr.png' onclick="javascript:location.href='jrf_tbllist.php?x_strwithpr=1&z_strwithpr=LIKE'" class='onhover cursorpointer' height='35px' width='auto' title='View JO with PR'>
			
		</td>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($jrf_tbl->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($jrf_tbl->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($jrf_tbl->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
	</div>

	<div class="col-lg-3 col-md-3 pull-right">
    	<form action="" name="filter_form" method="GET">
    	      <select name="filter_section"  class="form-control" required  onChange="this.form.submit();">
                       <option id="0" value="">--Filter by Section --</option>
                      	<option>Civil</option>
                       <option>Electrical</option>
                       <option>Mechanical</option>
                       <option>Galley</option>
                       <option>RO Operation</option>
                        <option value="Clear Filter">-- Clear Filter --</option>
				</select>
        </form>  
        <br>  
        <?php if ($jrf_tbl_list->sSrchWhere <> "" && $jrf_tbl_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(jrf_tbl_list, this, '<?php echo $jrf_tbl->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>    
	</div>


</div> <!--row-->

 

<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fjrf_tbllist" id="fjrf_tbllist" class="ewForm" action="" method="post">
<div id="gmp_jrf_tbl" class="ewGridMiddlePanel">
<?php if ($jrf_tbl_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $jrf_tbl->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$jrf_tbl_list->RenderListOptions();

// Render list options (header, left)
$jrf_tbl_list->ListOptions->Render("header", "left");
?>
<?php if ($jrf_tbl->ID->Visible) { // ID ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->ID) == "") { ?>
		<td><?php echo $jrf_tbl->ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td>&nbsp;<?php echo $jrf_tbl->ID->FldCaption() ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strjrfnum->Visible) { // strjrfnum ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strjrfnum) == "") { ?>
		<td><?php echo $jrf_tbl->strjrfnum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strjrfnum) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo  "JRF/SC#" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strjrfnum->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strjrfnum->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

<?php if ($jrf_tbl->strdate->Visible) { // strdate ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strdate) == "") { ?>
		<td><?php echo $jrf_tbl->strdate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strdate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo "DATE RECEIVED" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
	
<?php if ($jrf_tbl->strduedate->Visible) { // strduedate ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strduedate) == "") { ?>
		<td><?php echo $jrf_tbl->strduedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strduedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo "DUE DATE" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strduedate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strduedate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strsubject->Visible) { // strsubject ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strsubject) == "") { ?>
		<td><?php echo $jrf_tbl->strsubject->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strsubject) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo "SUBJECT" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strsubject->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strsubject->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>	

<?php if ($jrf_tbl->strarea->Visible) { // strarea ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strarea) == "") { ?>
		<td><?php echo $jrf_tbl->strarea->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strarea) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center"><?php echo "AREA" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strarea->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strarea->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strusername->Visible) { // strusername ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strusername) == "") { ?>
		<td><?php echo $jrf_tbl->strusername->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strusername) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo "REQUESTED BY" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strusername->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strusername->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
	
	
<?php if ($jrf_tbl->strdepartment->Visible) { // strdepartment ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strdepartment) == "") { ?>
		<td><?php echo $jrf_tbl->strdepartment->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strdepartment) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center"><?php echo "DEPARTMENT" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strdepartment->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strdepartment->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
	

<?php if ($jrf_tbl->strnature->Visible) { // strnature ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strnature) == "") { ?>
		<td><?php echo $jrf_tbl->strnature->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strnature) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center">&nbsp;<?php echo "NATURE" ?>&nbsp;</td><td style="width: 10px;"><?php if ($jrf_tbl->strnature->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strnature->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strpriority->Visible) { // strpriority ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strpriority) == "") { ?>
		<td><?php echo $jrf_tbl->strpriority->FldCaption() ?></td>
	<?php } else { ?>
		<td ><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strpriority) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo "PRIORITY" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strpriority->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strpriority->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strstatus->Visible) { // strstatus ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strstatus) == "") { ?>
		<td><?php echo $jrf_tbl->strstatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strstatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td align="center"><?php echo "STATUS" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strstatus->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strstatus->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($jrf_tbl->strcategory->Visible) { // strcategory ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strcategory) == "") { ?>
		<td><?php echo $jrf_tbl->strcategory->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strcategory) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo "SECTION" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strcategory->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strcategory->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

	
<?php if ($jrf_tbl->strwithpr->Visible) { // strwithpr ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strwithpr) == "") { ?>
		<td><?php echo $jrf_tbl->strwithpr->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strwithpr) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td title="with PR"><?php echo "PR"?></td><td style="width: 10px;"><?php if ($jrf_tbl->strwithpr->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strwithpr->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>	

	
<?php if ($jrf_tbl->strifoverdue->Visible) { // strifoverdue ?>
	<?php if ($jrf_tbl->SortUrl($jrf_tbl->strifoverdue) == "") { ?>
		<td><?php echo $jrf_tbl->strifoverdue->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $jrf_tbl->SortUrl($jrf_tbl->strifoverdue) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo "OVERDUE" ?></td><td style="width: 10px;"><?php if ($jrf_tbl->strifoverdue->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($jrf_tbl->strifoverdue->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>


<?php

// Render list options (header, right)
$jrf_tbl_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($jrf_tbl->ExportAll && $jrf_tbl->Export <> "") {
	$jrf_tbl_list->lStopRec = $jrf_tbl_list->lTotalRecs;
} else {
	$jrf_tbl_list->lStopRec = $jrf_tbl_list->lStartRec + $jrf_tbl_list->lDisplayRecs - 1; // Set the last record to display
}
$jrf_tbl_list->lRecCount = $jrf_tbl_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $jrf_tbl_list->lStartRec > 1)
		$rs->Move($jrf_tbl_list->lStartRec - 1);
}

// Initialize aggregate
$jrf_tbl->RowType = EW_ROWTYPE_AGGREGATEINIT;
$jrf_tbl_list->RenderRow();
$jrf_tbl_list->lRowCnt = 0;
while (($jrf_tbl->CurrentAction == "gridadd" || !$rs->EOF) &&
	$jrf_tbl_list->lRecCount < $jrf_tbl_list->lStopRec) {
	$jrf_tbl_list->lRecCount++;
	if (intval($jrf_tbl_list->lRecCount) >= intval($jrf_tbl_list->lStartRec)) {
		$jrf_tbl_list->lRowCnt++;

	// Init row class and style
	$jrf_tbl->CssClass = "";
	$jrf_tbl->CssStyle = "";
	$jrf_tbl->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($jrf_tbl->CurrentAction == "gridadd") {
		$jrf_tbl_list->LoadDefaultValues(); // Load default values
	} else {
		$jrf_tbl_list->LoadRowValues($rs); // Load row values
	}
	$jrf_tbl->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$jrf_tbl_list->RenderRow();

	// Render list options
	$jrf_tbl_list->RenderListOptions();
?>
	<tr<?php echo $jrf_tbl->RowAttributes() ?>>
<?php

// Render list options (body, left)
$jrf_tbl_list->ListOptions->Render("body", "left");
?>


<?php
	$strdue_date =  $jrf_tbl->strduedate->ListViewValue();
	$strstatus =  $jrf_tbl->strstatus->ListViewValue();
	$Over_due_caption = $jrf_tbl->strifoverdue->ListViewValue() ;

	/* For Over Due*/



if ($Over_due_caption=="overdue") {
		$color = "bgcolor='#d31111'";
		$overdue_image = "<img src='img/system/buttons/warning.gif' width=18px height=17px title='This request is Over Due!'>";

		$strdate_now=date("m/d/Y");    //date now
		$datetime1= date_create($strdue_date);
		$datetime2 = date_create($strdate_now);
		$interval = date_diff($datetime1, $datetime2);
		$total_overdue_num= $interval->format('%R%a');

		$stroverdue_num =  $interval->format('%a');
			switch ($stroverdue_num) {
				case '1':
					$day_name=" Day";
					break;
				default:
					$day_name=" Days";
					break;
				}
		$stroverdue_num =  $interval->format('%a' .$day_name);

	}else{
			switch ($strstatus) {
				case 'New':
					$color = "bgcolor='#e7e06b'";
					break;
				case 'For GM Approval':
					$color = "bgcolor='#e7e06b'";
					break;
				case 'For VP Approval':
					$color = "bgcolor='#e7e06b'";
					break;
				case 'In-Progress':
					$color = "bgcolor='#e7e06b'";
					break;
				case 'Encoded to SAP':
					$color = "bgcolor='#e7e06b'";
					break;
				case 'For Encoding to SAP':
					$color = "bgcolor='#e7e06b'";
					break;
				
				default:
					$color = "bgcolor='#eee7e6'";
					break;
				}
		$overdue_image = "";
		$stroverdue_num = "";

		}//EndIf

		//SORTED BY COLOR

	if($_GET['x_strstatus']=='new'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strstatus']=='For GM Approval'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strstatus']=='For VP Approval'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strstatus']=='In-Progress'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strstatus']=='Encoded to SAP'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strstatus']=='For Encoding to SAP'){
		$color = "bgcolor='#e7e06b'";
	}elseif($_GET['x_strifoverdue']=='overdue'){
				$color = "bgcolor='#d31111'";
				$overdue_image = "<img src='img/system/buttons/warning.gif' width=18px height=17px title='This request is Over Due!'>";

				$strdate_now=date("m/d/Y");    //date now
				$datetime1= date_create($strdue_date);
				$datetime2 = date_create($strdate_now);
				$interval = date_diff($datetime1, $datetime2);
				$total_overdue_num= $interval->format('%R%a');

				$stroverdue_num =  $interval->format('%a');
					switch ($stroverdue_num) {
						case '1':
							$day_name=" Day";
							break;
						default:
							$day_name=" Days";
							break;
						}
				$stroverdue_num =  $interval->format('%a' .$day_name);
			}


?>	


<?php if ($jrf_tbl->ID->Visible) { // ID ?>
		<td <?php echo $color; ?> align="center">
<div<?php echo $jrf_tbl->ID->ViewAttributes() ?>><?php echo $jrf_tbl->ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strjrfnum->Visible) { // strjrfnum ?>
		<td <?php echo $color; ?> align="center">
<div<?php echo $jrf_tbl->strjrfnum->ViewAttributes() ?>><?php echo $jrf_tbl->strjrfnum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strdate->Visible) { // strdate ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strdate->ViewAttributes() ?>>
	<?php
	$orig_received_date = $jrf_tbl->strdate->ListViewValue();
	  $the_month_received =substr($orig_received_date, 0, 2); //01,02

	  switch ($the_month_received) {
	  	case '01':
	  		$the_month_received = "January";
	  		break;
	  	case '02':
	  		$the_month_received = "February";
	  		break;
	  	case '03':
	  		$the_month_received = "March";
	  		break;
	  	case '04':
	  		$the_month_received = "April";
	  		break;
	  	case '05':
	  		$the_month_received = "May";
	  		break;
	  	case '06':
	  		$the_month_received = "June";
	  		break;
	  	case '07':
	  		$the_month_received = "July";
	  		break;
	  	case '08':
	  		$the_month_received = "August";
	  		break;
	  	case '09':
	  		$the_month_received = "September";
	  		break;
	  	case '10':
	  		$the_month_received = "October";
	  		break;
	  	case '11':
	  		$the_month_received = "November";
	  		break;
	  	case '12':
	  		$the_month_received = "December";
	  		break;
	  	
	  	default:
	  		$the_month_received = "";
	  		break;
	  }

		$convert_month_received = $the_month_received.substr($orig_received_date, 2, 8);
		echo str_replace("/"," ",$convert_month_received). " " . $jrf_tbl->strtime->ListViewValue();

	?>
</div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strduedate->Visible) { // strduedate ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strduedate->ViewAttributes() ?>>
	<?php  $orig_dute = $jrf_tbl->strduedate->ListViewValue();
	  $the_month =substr($orig_dute, 0, 2); //01,02

	  switch ($the_month) {
	  	case '01':
	  		$the_month = "January";
	  		break;
	  	case '02':
	  		$the_month = "February";
	  		break;
	  	case '03':
	  		$the_month = "March";
	  		break;
	  	case '04':
	  		$the_month = "April";
	  		break;
	  	case '05':
	  		$the_month = "May";
	  		break;
	  	case '06':
	  		$the_month = "June";
	  		break;
	  	case '07':
	  		$the_month = "July";
	  		break;
	  	case '08':
	  		$the_month = "August";
	  		break;
	  	case '09':
	  		$the_month = "September";
	  		break;
	  	case '10':
	  		$the_month = "October";
	  		break;
	  	case '11':
	  		$the_month = "November";
	  		break;
	  	case '12':
	  		$the_month = "December";
	  		break;
	  	
	  	default:
	  		$the_month = "";
	  		break;
	  }

		$convert_month = $the_month.substr($orig_dute, 2, 8);
		echo str_replace("/"," ",$convert_month);

	?>
</div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strsubject->Visible) { // strsubject ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strsubject->ViewAttributes() ?>><?php echo ucwords(strtolower($jrf_tbl->strsubject->ListViewValue())); ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strarea->Visible) { // strarea ?>
		<td  <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strarea->ViewAttributes() ?>><?php echo ucwords(strtolower($jrf_tbl->strarea->ListViewValue())) ?></div>
</td>
	<?php } ?>

	<?php if ($jrf_tbl->strusername->Visible) { // strusername ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strusername->ViewAttributes() ?>><?php echo $jrf_tbl->strusername->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strdepartment->Visible) { // strdepartment ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strdepartment->ViewAttributes() ?>><?php echo $jrf_tbl->strdepartment->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strnature->Visible) { // strnature ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strnature->ViewAttributes() ?>><?php echo $jrf_tbl->strnature->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strpriority->Visible) { // strpriority ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strpriority->ViewAttributes() ?>><?php echo $jrf_tbl->strpriority->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($jrf_tbl->strstatus->Visible) { // strstatus ?>
		<td <?php echo $color; ?>>
<div<?php echo $jrf_tbl->strstatus->ViewAttributes() ?>><?php echo $jrf_tbl->strstatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($jrf_tbl->strcategory->Visible) { // strcategory ?>
		<td <?php echo $color ; ?> style="padding-left:5px">
<div<?php echo $jrf_tbl->strcategory->ViewAttributes() ?>>
	<?php 
		$cat  = $jrf_tbl->strcategory->ListViewValue();
		$orig = array("Section","Equipment");
		$rep_with = array("","");
	 	echo str_replace($orig,$rep_with,$cat);

	?>
</div>
</td>
	<?php } ?>
<?php if ($jrf_tbl->strwithpr->Visible) { // strwithpr ?>
		<td <?php echo $color; ?>  align="center">
<div<?php echo $jrf_tbl->strwithpr->ViewAttributes() ?>>
	<?php 
		$with_pr = $jrf_tbl->strwithpr->ListViewValue();
		
		switch($with_pr){
			case 1:
			 	$n = "<img src='img/system/buttons/with_pr.png' height='25px' width='25px' title='Request has PR'>";
			break;

			default:
				$n =  "";
			break;

		}
		

		echo $n;


		if($_GET['x_strwithpr']==1){
			$z = "<img src='img/system/buttons/with_pr.png' height='25px' width='25px' title='Request has PR'>";
		}
		echo $z;
	?>
</div>
</td>
	<?php } ?>

<?php if ($jrf_tbl->strifoverdue->Visible) { // strifoverdue ?>


<td <?php echo $color; ?> align="center">
<div<?php echo $jrf_tbl->strifoverdue->ViewAttributes() ?>>
	<?php echo  $stroverdue_num. $overdue_image; //Over Due Caption?> 
</div>
</td>
	<?php } ?>
	
<?php

// Render list options (body, right)
$jrf_tbl_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($jrf_tbl->CurrentAction <> "gridadd")
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
<?php if ($jrf_tbl->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($jrf_tbl->CurrentAction <> "gridadd" && $jrf_tbl->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($jrf_tbl_list->Pager)) $jrf_tbl_list->Pager = new cPrevNextPager($jrf_tbl_list->lStartRec, $jrf_tbl_list->lDisplayRecs, $jrf_tbl_list->lTotalRecs) ?>
<?php if ($jrf_tbl_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($jrf_tbl_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $jrf_tbl_list->PageUrl() ?>start=<?php echo $jrf_tbl_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($jrf_tbl_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $jrf_tbl_list->PageUrl() ?>start=<?php echo $jrf_tbl_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $jrf_tbl_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($jrf_tbl_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $jrf_tbl_list->PageUrl() ?>start=<?php echo $jrf_tbl_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($jrf_tbl_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $jrf_tbl_list->PageUrl() ?>start=<?php echo $jrf_tbl_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $jrf_tbl_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $jrf_tbl_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $jrf_tbl_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $jrf_tbl_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($jrf_tbl_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($jrf_tbl_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($jrf_tbl->Export == "" && $jrf_tbl->CurrentAction == "") { ?>
<?php } ?>
<?php if ($jrf_tbl->Export == "") { ?>
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




<script>
    $(document).ready(function(){
        $("#view_loader").hide();
        
        $("#hide").click(function(){
            $("#view_loader").hide();
        });

        $("#show").click(function(){
            $("#view_loader").show();
        });
    });



    $(document).ready(function(){
        $("#view_loader_finish").hide();
    

        $("#show_finish").click(function(){
            $("#view_loader_finish").show();
        });
    });
</script>



<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .add-box').click(function(){
        var n = $('.text-box').length + 1;
        if( 20 < n ) {
            alert('You\'ve reached the Limit!');
            return false;
        }
        var box_html = $('<p class="text-box"><label for="box' + n + '">Item:   <span class="box-number">' + n + '</span></label> <input type="text" placeholder="Quantity" size="5" name="boxes[]" value="" id="box' + n + '" /> <input type="text" placeholder="Unit" name="strunit[]" size="5"  value="" id="strunit' + n + '" /> <input type="text" placeholder="Item Name" name="stritmname[]" size="10"  value="" id="stritmname' + n + '" /> <input type="text" placeholder="Item Description" name="stritmdesc[]" size="25"  value="" id="stritmdesc' + n + '" />&nbsp;<button type="button" class="remove-box  btn btn-danger"><i class="fa fa-times"></i></button></p>');
        box_html.hide();
        $('.my-form p.text-box:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().css( 'background-color', '#FF6C6C' );
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
        return false;
    });
});
</script>

<?php } ?>
<?php include "footer.php" ?>
<?php
$jrf_tbl_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $jrf_tbl;
		if ($jrf_tbl->UseTokenInUrl) $PageUrl .= "t=" . $jrf_tbl->TableVar . "&"; // Add page token
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
		global $objForm, $jrf_tbl;
		if ($jrf_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($jrf_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($jrf_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjrf_tbl_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["jrf_tbl"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "jrf_tbldelete.php";
		$this->MultiUpdateUrl = "jrf_tblupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'jrf_tbl', TRUE);

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
		global $jrf_tbl;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$jrf_tbl->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$jrf_tbl->Export = $_POST["exporttype"];
		} else {
			$jrf_tbl->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $jrf_tbl->Export; // Get export parameter, used in header
		$gsExportFile = $jrf_tbl->TableVar; // Get export file, used in header
		if ($jrf_tbl->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($jrf_tbl->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $jrf_tbl;

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
			$jrf_tbl->Recordset_SearchValidated();

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
		if ($jrf_tbl->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $jrf_tbl->getRecordsPerPage(); // Restore from Session
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
		$jrf_tbl->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$jrf_tbl->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$jrf_tbl->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $jrf_tbl->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$jrf_tbl->setSessionWhere($sFilter);
		$jrf_tbl->CurrentFilter = "";

		// Export data only
		if (in_array($jrf_tbl->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($jrf_tbl->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $jrf_tbl;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $jrf_tbl->ID, FALSE); // ID
		$this->BuildSearchSql($sWhere, $jrf_tbl->strjrfnum, FALSE); // strjrfnum
		$this->BuildSearchSql($sWhere, $jrf_tbl->strquarter, FALSE); // strquarter
		$this->BuildSearchSql($sWhere, $jrf_tbl->strmon, FALSE); // strmon
		$this->BuildSearchSql($sWhere, $jrf_tbl->stryear, FALSE); // stryear
		$this->BuildSearchSql($sWhere, $jrf_tbl->strdate, FALSE); // strdate
		$this->BuildSearchSql($sWhere, $jrf_tbl->strtime, FALSE); // strtime
		$this->BuildSearchSql($sWhere, $jrf_tbl->strduedate, FALSE); // strduedate
		$this->BuildSearchSql($sWhere, $jrf_tbl->strsubject, FALSE); // strsubject
		$this->BuildSearchSql($sWhere, $jrf_tbl->strusername, FALSE); // strusername
		$this->BuildSearchSql($sWhere, $jrf_tbl->strusereadd, FALSE); // strusereadd
		$this->BuildSearchSql($sWhere, $jrf_tbl->strcompany, FALSE); // strcompany
		$this->BuildSearchSql($sWhere, $jrf_tbl->strdepartment, FALSE); // strdepartment
		$this->BuildSearchSql($sWhere, $jrf_tbl->strloc, FALSE); // strloc
		$this->BuildSearchSql($sWhere, $jrf_tbl->strposition, FALSE); // strposition
		$this->BuildSearchSql($sWhere, $jrf_tbl->strtelephone, FALSE); // strtelephone
		$this->BuildSearchSql($sWhere, $jrf_tbl->strcostcent, FALSE); // strcostcent
		$this->BuildSearchSql($sWhere, $jrf_tbl->strnature, FALSE); // strnature
		$this->BuildSearchSql($sWhere, $jrf_tbl->strdescript, FALSE); // strdescript
		$this->BuildSearchSql($sWhere, $jrf_tbl->strattach, FALSE); // strattach
		$this->BuildSearchSql($sWhere, $jrf_tbl->strarea, FALSE); // strarea
		$this->BuildSearchSql($sWhere, $jrf_tbl->strpriority, FALSE); // strpriority
		$this->BuildSearchSql($sWhere, $jrf_tbl->strstatus, FALSE); // strstatus
		$this->BuildSearchSql($sWhere, $jrf_tbl->strlastedit, FALSE); // strlastedit
		$this->BuildSearchSql($sWhere, $jrf_tbl->strcategory, FALSE); // strcategory
		$this->BuildSearchSql($sWhere, $jrf_tbl->strassigned, FALSE); // strassigned
		$this->BuildSearchSql($sWhere, $jrf_tbl->strremarks, FALSE); // strremarks
		$this->BuildSearchSql($sWhere, $jrf_tbl->strdatecomplete, FALSE); // strdatecomplete
		$this->BuildSearchSql($sWhere, $jrf_tbl->strifoverdue, FALSE); // strifoverdue
		$this->BuildSearchSql($sWhere, $jrf_tbl->strwithpr, FALSE); // strwithpr
		$this->BuildSearchSql($sWhere, $jrf_tbl->sap_num, FALSE); // sap_num

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($jrf_tbl->ID); // ID
			$this->SetSearchParm($jrf_tbl->strjrfnum); // strjrfnum
			$this->SetSearchParm($jrf_tbl->strquarter); // strquarter
			$this->SetSearchParm($jrf_tbl->strmon); // strmon
			$this->SetSearchParm($jrf_tbl->stryear); // stryear
			$this->SetSearchParm($jrf_tbl->strdate); // strdate
			$this->SetSearchParm($jrf_tbl->strtime); // strtime
			$this->SetSearchParm($jrf_tbl->strduedate); // strduedate
			$this->SetSearchParm($jrf_tbl->strsubject); // strsubject
			$this->SetSearchParm($jrf_tbl->strusername); // strusername
			$this->SetSearchParm($jrf_tbl->strusereadd); // strusereadd
			$this->SetSearchParm($jrf_tbl->strcompany); // strcompany
			$this->SetSearchParm($jrf_tbl->strdepartment); // strdepartment
			$this->SetSearchParm($jrf_tbl->strloc); // strloc
			$this->SetSearchParm($jrf_tbl->strposition); // strposition
			$this->SetSearchParm($jrf_tbl->strtelephone); // strtelephone
			$this->SetSearchParm($jrf_tbl->strcostcent); // strcostcent
			$this->SetSearchParm($jrf_tbl->strnature); // strnature
			$this->SetSearchParm($jrf_tbl->strdescript); // strdescript
			$this->SetSearchParm($jrf_tbl->strattach); // strattach
			$this->SetSearchParm($jrf_tbl->strarea); // strarea
			$this->SetSearchParm($jrf_tbl->strpriority); // strpriority
			$this->SetSearchParm($jrf_tbl->strstatus); // strstatus
			$this->SetSearchParm($jrf_tbl->strlastedit); // strlastedit
			$this->SetSearchParm($jrf_tbl->strcategory); // strcategory
			$this->SetSearchParm($jrf_tbl->strassigned); // strassigned
			$this->SetSearchParm($jrf_tbl->strremarks); // strremarks
			$this->SetSearchParm($jrf_tbl->strdatecomplete); // strdatecomplete
			$this->SetSearchParm($jrf_tbl->strifoverdue); // strifoverdue
			$this->SetSearchParm($jrf_tbl->strwithpr); // strwithpr
			$this->SetSearchParm($jrf_tbl->sap_num); // sap_num
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
		global $jrf_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$jrf_tbl->setAdvancedSearch("x_$FldParm", $FldVal);
		$jrf_tbl->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$jrf_tbl->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$jrf_tbl->setAdvancedSearch("y_$FldParm", $FldVal2);
		$jrf_tbl->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $jrf_tbl;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $jrf_tbl->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $jrf_tbl->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $jrf_tbl->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $jrf_tbl->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $jrf_tbl->GetAdvancedSearch("w_$FldParm");
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
		global $jrf_tbl;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strjrfnum, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strquarter, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strmon, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->stryear, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strdate, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strtime, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strduedate, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strsubject, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strusername, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strusereadd, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strcompany, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strdepartment, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strloc, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strposition, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strtelephone, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strcostcent, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strnature, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strdescript, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strattach, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strarea, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strpriority, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strstatus, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strlastedit, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strcategory, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strassigned, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strremarks, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strdatecomplete, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strifoverdue, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->strwithpr, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $jrf_tbl->sap_num, $Keyword);
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
		global $Security, $jrf_tbl;
		$sSearchStr = "";
		$sSearchKeyword = $jrf_tbl->BasicSearchKeyword;
		$sSearchType = $jrf_tbl->BasicSearchType;
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
			$jrf_tbl->setSessionBasicSearchKeyword($sSearchKeyword);
			$jrf_tbl->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $jrf_tbl;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$jrf_tbl->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $jrf_tbl;
		$jrf_tbl->setSessionBasicSearchKeyword("");
		$jrf_tbl->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $jrf_tbl;
		$jrf_tbl->setAdvancedSearch("x_ID", "");
		$jrf_tbl->setAdvancedSearch("x_strjrfnum", "");
		$jrf_tbl->setAdvancedSearch("x_strquarter", "");
		$jrf_tbl->setAdvancedSearch("x_strmon", "");
		$jrf_tbl->setAdvancedSearch("x_stryear", "");
		$jrf_tbl->setAdvancedSearch("x_strdate", "");
		$jrf_tbl->setAdvancedSearch("x_strtime", "");
		$jrf_tbl->setAdvancedSearch("x_strduedate", "");
		$jrf_tbl->setAdvancedSearch("x_strsubject", "");
		$jrf_tbl->setAdvancedSearch("x_strusername", "");
		$jrf_tbl->setAdvancedSearch("x_strusereadd", "");
		$jrf_tbl->setAdvancedSearch("x_strcompany", "");
		$jrf_tbl->setAdvancedSearch("x_strdepartment", "");
		$jrf_tbl->setAdvancedSearch("x_strloc", "");
		$jrf_tbl->setAdvancedSearch("x_strposition", "");
		$jrf_tbl->setAdvancedSearch("x_strtelephone", "");
		$jrf_tbl->setAdvancedSearch("x_strcostcent", "");
		$jrf_tbl->setAdvancedSearch("x_strnature", "");
		$jrf_tbl->setAdvancedSearch("x_strdescript", "");
		$jrf_tbl->setAdvancedSearch("x_strattach", "");
		$jrf_tbl->setAdvancedSearch("x_strarea", "");
		$jrf_tbl->setAdvancedSearch("x_strpriority", "");
		$jrf_tbl->setAdvancedSearch("x_strstatus", "");
		$jrf_tbl->setAdvancedSearch("x_strlastedit", "");
		$jrf_tbl->setAdvancedSearch("x_strcategory", "");
		$jrf_tbl->setAdvancedSearch("x_strassigned", "");
		$jrf_tbl->setAdvancedSearch("x_strremarks", "");
		$jrf_tbl->setAdvancedSearch("x_strdatecomplete", "");
		$jrf_tbl->setAdvancedSearch("x_strifoverdue", "");
		$jrf_tbl->setAdvancedSearch("x_strwithpr", "");
		$jrf_tbl->setAdvancedSearch("x_sap_num", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $jrf_tbl;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strjrfnum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strquarter"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strmon"] <> "") $bRestore = FALSE;
		if (@$_GET["x_stryear"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strtime"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strduedate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strsubject"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strusername"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strusereadd"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcompany"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdepartment"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strloc"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strposition"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strtelephone"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcostcent"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strnature"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdescript"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strattach"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strarea"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strpriority"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strstatus"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strlastedit"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strcategory"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strassigned"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strremarks"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strdatecomplete"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strifoverdue"] <> "") $bRestore = FALSE;
		if (@$_GET["x_strwithpr"] <> "") $bRestore = FALSE;
		if (@$_GET["x_sap_num"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$jrf_tbl->BasicSearchKeyword = $jrf_tbl->getSessionBasicSearchKeyword();
			$jrf_tbl->BasicSearchType = $jrf_tbl->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($jrf_tbl->ID);
			$this->GetSearchParm($jrf_tbl->strjrfnum);
			$this->GetSearchParm($jrf_tbl->strquarter);
			$this->GetSearchParm($jrf_tbl->strmon);
			$this->GetSearchParm($jrf_tbl->stryear);
			$this->GetSearchParm($jrf_tbl->strdate);
			$this->GetSearchParm($jrf_tbl->strtime);
			$this->GetSearchParm($jrf_tbl->strduedate);
			$this->GetSearchParm($jrf_tbl->strsubject);
			$this->GetSearchParm($jrf_tbl->strusername);
			$this->GetSearchParm($jrf_tbl->strusereadd);
			$this->GetSearchParm($jrf_tbl->strcompany);
			$this->GetSearchParm($jrf_tbl->strdepartment);
			$this->GetSearchParm($jrf_tbl->strloc);
			$this->GetSearchParm($jrf_tbl->strposition);
			$this->GetSearchParm($jrf_tbl->strtelephone);
			$this->GetSearchParm($jrf_tbl->strcostcent);
			$this->GetSearchParm($jrf_tbl->strnature);
			$this->GetSearchParm($jrf_tbl->strdescript);
			$this->GetSearchParm($jrf_tbl->strattach);
			$this->GetSearchParm($jrf_tbl->strarea);
			$this->GetSearchParm($jrf_tbl->strpriority);
			$this->GetSearchParm($jrf_tbl->strstatus);
			$this->GetSearchParm($jrf_tbl->strlastedit);
			$this->GetSearchParm($jrf_tbl->strcategory);
			$this->GetSearchParm($jrf_tbl->strassigned);
			$this->GetSearchParm($jrf_tbl->strremarks);
			$this->GetSearchParm($jrf_tbl->strdatecomplete);
			$this->GetSearchParm($jrf_tbl->strifoverdue);
			$this->GetSearchParm($jrf_tbl->strwithpr);
			$this->GetSearchParm($jrf_tbl->sap_num);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $jrf_tbl;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$jrf_tbl->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$jrf_tbl->CurrentOrderType = @$_GET["ordertype"];
			$jrf_tbl->UpdateSort($jrf_tbl->ID); // ID
			$jrf_tbl->UpdateSort($jrf_tbl->strjrfnum); // strjrfnum
			$jrf_tbl->UpdateSort($jrf_tbl->strquarter); // strquarter
			$jrf_tbl->UpdateSort($jrf_tbl->strmon); // strmon
			$jrf_tbl->UpdateSort($jrf_tbl->stryear); // stryear
			$jrf_tbl->UpdateSort($jrf_tbl->strdate); // strdate
			$jrf_tbl->UpdateSort($jrf_tbl->strtime); // strtime
			$jrf_tbl->UpdateSort($jrf_tbl->strduedate); // strduedate
			$jrf_tbl->UpdateSort($jrf_tbl->strsubject); // strsubject
			$jrf_tbl->UpdateSort($jrf_tbl->strusername); // strusername
			$jrf_tbl->UpdateSort($jrf_tbl->strusereadd); // strusereadd
			$jrf_tbl->UpdateSort($jrf_tbl->strcompany); // strcompany
			$jrf_tbl->UpdateSort($jrf_tbl->strdepartment); // strdepartment
			$jrf_tbl->UpdateSort($jrf_tbl->strloc); // strloc
			$jrf_tbl->UpdateSort($jrf_tbl->strposition); // strposition
			$jrf_tbl->UpdateSort($jrf_tbl->strtelephone); // strtelephone
			$jrf_tbl->UpdateSort($jrf_tbl->strcostcent); // strcostcent
			$jrf_tbl->UpdateSort($jrf_tbl->strnature); // strnature
			$jrf_tbl->UpdateSort($jrf_tbl->strdescript); // strdescript
			$jrf_tbl->UpdateSort($jrf_tbl->strattach); // strattach
			$jrf_tbl->UpdateSort($jrf_tbl->strarea); // strarea
			$jrf_tbl->UpdateSort($jrf_tbl->strpriority); // strpriority
			$jrf_tbl->UpdateSort($jrf_tbl->strstatus); // strstatus
			$jrf_tbl->UpdateSort($jrf_tbl->strlastedit); // strlastedit
			$jrf_tbl->UpdateSort($jrf_tbl->strcategory); // strcategory
			$jrf_tbl->UpdateSort($jrf_tbl->strassigned); // strassigned
			$jrf_tbl->UpdateSort($jrf_tbl->strremarks); // strremarks
			$jrf_tbl->UpdateSort($jrf_tbl->strdatecomplete); // strdatecomplete
			$jrf_tbl->UpdateSort($jrf_tbl->strifoverdue); // strifoverdue
			$jrf_tbl->UpdateSort($jrf_tbl->strwithpr); // strwithpr
			$jrf_tbl->UpdateSort($jrf_tbl->sap_num); // sap_num
			$jrf_tbl->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $jrf_tbl;
		$sOrderBy = $jrf_tbl->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($jrf_tbl->SqlOrderBy() <> "") {
				$sOrderBy = $jrf_tbl->SqlOrderBy();
				$jrf_tbl->setSessionOrderBy($sOrderBy);
				$jrf_tbl->ID->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $jrf_tbl;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$jrf_tbl->setSessionOrderBy($sOrderBy);
				$jrf_tbl->ID->setSort("");
				$jrf_tbl->strjrfnum->setSort("");
				$jrf_tbl->strquarter->setSort("");
				$jrf_tbl->strmon->setSort("");
				$jrf_tbl->stryear->setSort("");
				$jrf_tbl->strdate->setSort("");
				$jrf_tbl->strtime->setSort("");
				$jrf_tbl->strduedate->setSort("");
				$jrf_tbl->strsubject->setSort("");
				$jrf_tbl->strusername->setSort("");
				$jrf_tbl->strusereadd->setSort("");
				$jrf_tbl->strcompany->setSort("");
				$jrf_tbl->strdepartment->setSort("");
				$jrf_tbl->strloc->setSort("");
				$jrf_tbl->strposition->setSort("");
				$jrf_tbl->strtelephone->setSort("");
				$jrf_tbl->strcostcent->setSort("");
				$jrf_tbl->strnature->setSort("");
				$jrf_tbl->strdescript->setSort("");
				$jrf_tbl->strattach->setSort("");
				$jrf_tbl->strarea->setSort("");
				$jrf_tbl->strpriority->setSort("");
				$jrf_tbl->strstatus->setSort("");
				$jrf_tbl->strlastedit->setSort("");
				$jrf_tbl->strcategory->setSort("");
				$jrf_tbl->strassigned->setSort("");
				$jrf_tbl->strremarks->setSort("");
				$jrf_tbl->strdatecomplete->setSort("");
				$jrf_tbl->strifoverdue->setSort("");
				$jrf_tbl->strwithpr->setSort("");
				$jrf_tbl->sap_num->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $jrf_tbl;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		
		// "edit"
		//$this->ListOptions->Add("edit");
		//$item =& $this->ListOptions->Items["edit"];
		//$item->CssStyle = "white-space: nowrap;";
		//$item->Visible = TRUE;
		//$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($jrf_tbl->Export <> "" ||
			$jrf_tbl->CurrentAction == "gridadd" ||
			$jrf_tbl->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $jrf_tbl;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$view_img ="<img src='img/system/buttons/request.png' width='auto' height='28px' title='View Request Details'>";
			$oListOpt->Body = "<a class='onhover' href=\"" . $this->ViewUrl . "\">" . $view_img . "</a>";

		// "edit"
		//$oListOpt =& $this->ListOptions->Items["edit"];
		//if ($oListOpt->Visible) {
		//	$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		//}
		$this->RenderListOptionsExt();
		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $jrf_tbl;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $jrf_tbl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$jrf_tbl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$jrf_tbl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $jrf_tbl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$jrf_tbl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $jrf_tbl;
		$jrf_tbl->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$jrf_tbl->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $jrf_tbl;

		// Load search values
		// ID

		$jrf_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ID"]);
		$jrf_tbl->ID->AdvancedSearch->SearchOperator = @$_GET["z_ID"];

		// strjrfnum
		$jrf_tbl->strjrfnum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strjrfnum"]);
		$jrf_tbl->strjrfnum->AdvancedSearch->SearchOperator = @$_GET["z_strjrfnum"];

		// strquarter
		$jrf_tbl->strquarter->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strquarter"]);
		$jrf_tbl->strquarter->AdvancedSearch->SearchOperator = @$_GET["z_strquarter"];

		// strmon
		$jrf_tbl->strmon->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strmon"]);
		$jrf_tbl->strmon->AdvancedSearch->SearchOperator = @$_GET["z_strmon"];

		// stryear
		$jrf_tbl->stryear->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_stryear"]);
		$jrf_tbl->stryear->AdvancedSearch->SearchOperator = @$_GET["z_stryear"];

		// strdate
		$jrf_tbl->strdate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdate"]);
		$jrf_tbl->strdate->AdvancedSearch->SearchOperator = @$_GET["z_strdate"];

		// strtime
		$jrf_tbl->strtime->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strtime"]);
		$jrf_tbl->strtime->AdvancedSearch->SearchOperator = @$_GET["z_strtime"];

		// strduedate
		$jrf_tbl->strduedate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strduedate"]);
		$jrf_tbl->strduedate->AdvancedSearch->SearchOperator = @$_GET["z_strduedate"];

		// strsubject
		$jrf_tbl->strsubject->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strsubject"]);
		$jrf_tbl->strsubject->AdvancedSearch->SearchOperator = @$_GET["z_strsubject"];

		// strusername
		$jrf_tbl->strusername->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strusername"]);
		$jrf_tbl->strusername->AdvancedSearch->SearchOperator = @$_GET["z_strusername"];

		// strusereadd
		$jrf_tbl->strusereadd->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strusereadd"]);
		$jrf_tbl->strusereadd->AdvancedSearch->SearchOperator = @$_GET["z_strusereadd"];

		// strcompany
		$jrf_tbl->strcompany->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcompany"]);
		$jrf_tbl->strcompany->AdvancedSearch->SearchOperator = @$_GET["z_strcompany"];

		// strdepartment
		$jrf_tbl->strdepartment->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdepartment"]);
		$jrf_tbl->strdepartment->AdvancedSearch->SearchOperator = @$_GET["z_strdepartment"];

		// strloc
		$jrf_tbl->strloc->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strloc"]);
		$jrf_tbl->strloc->AdvancedSearch->SearchOperator = @$_GET["z_strloc"];

		// strposition
		$jrf_tbl->strposition->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strposition"]);
		$jrf_tbl->strposition->AdvancedSearch->SearchOperator = @$_GET["z_strposition"];

		// strtelephone
		$jrf_tbl->strtelephone->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strtelephone"]);
		$jrf_tbl->strtelephone->AdvancedSearch->SearchOperator = @$_GET["z_strtelephone"];

		// strcostcent
		$jrf_tbl->strcostcent->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcostcent"]);
		$jrf_tbl->strcostcent->AdvancedSearch->SearchOperator = @$_GET["z_strcostcent"];

		// strnature
		$jrf_tbl->strnature->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strnature"]);
		$jrf_tbl->strnature->AdvancedSearch->SearchOperator = @$_GET["z_strnature"];

		// strdescript
		$jrf_tbl->strdescript->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdescript"]);
		$jrf_tbl->strdescript->AdvancedSearch->SearchOperator = @$_GET["z_strdescript"];

		// strattach
		$jrf_tbl->strattach->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strattach"]);
		$jrf_tbl->strattach->AdvancedSearch->SearchOperator = @$_GET["z_strattach"];

		// strarea
		$jrf_tbl->strarea->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strarea"]);
		$jrf_tbl->strarea->AdvancedSearch->SearchOperator = @$_GET["z_strarea"];

		// strpriority
		$jrf_tbl->strpriority->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strpriority"]);
		$jrf_tbl->strpriority->AdvancedSearch->SearchOperator = @$_GET["z_strpriority"];

		// strstatus
		$jrf_tbl->strstatus->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strstatus"]);
		$jrf_tbl->strstatus->AdvancedSearch->SearchOperator = @$_GET["z_strstatus"];

		// strlastedit
		$jrf_tbl->strlastedit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strlastedit"]);
		$jrf_tbl->strlastedit->AdvancedSearch->SearchOperator = @$_GET["z_strlastedit"];

		// strcategory
		$jrf_tbl->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strcategory"]);
		$jrf_tbl->strcategory->AdvancedSearch->SearchOperator = @$_GET["z_strcategory"];

		// strassigned
		$jrf_tbl->strassigned->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strassigned"]);
		$jrf_tbl->strassigned->AdvancedSearch->SearchOperator = @$_GET["z_strassigned"];

		// strremarks
		$jrf_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strremarks"]);
		$jrf_tbl->strremarks->AdvancedSearch->SearchOperator = @$_GET["z_strremarks"];

		// strdatecomplete
		$jrf_tbl->strdatecomplete->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strdatecomplete"]);
		$jrf_tbl->strdatecomplete->AdvancedSearch->SearchOperator = @$_GET["z_strdatecomplete"];

		// strifoverdue
		$jrf_tbl->strifoverdue->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strifoverdue"]);
		$jrf_tbl->strifoverdue->AdvancedSearch->SearchOperator = @$_GET["z_strifoverdue"];

		// strwithpr
		$jrf_tbl->strwithpr->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_strwithpr"]);
		$jrf_tbl->strwithpr->AdvancedSearch->SearchOperator = @$_GET["z_strwithpr"];

		// sap_num
		$jrf_tbl->sap_num->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sap_num"]);
		$jrf_tbl->sap_num->AdvancedSearch->SearchOperator = @$_GET["z_sap_num"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $jrf_tbl;

		// Call Recordset Selecting event
		$jrf_tbl->Recordset_Selecting($jrf_tbl->CurrentFilter);

		// Load List page SQL
		$sSql = $jrf_tbl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$jrf_tbl->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $jrf_tbl;
		$sFilter = $jrf_tbl->KeyFilter();

		// Call Row Selecting event
		$jrf_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$jrf_tbl->CurrentFilter = $sFilter;
		$sSql = $jrf_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$jrf_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $jrf_tbl;
		$jrf_tbl->ID->setDbValue($rs->fields('ID'));
		$jrf_tbl->strjrfnum->setDbValue($rs->fields('strjrfnum'));
		$jrf_tbl->strquarter->setDbValue($rs->fields('strquarter'));
		$jrf_tbl->strmon->setDbValue($rs->fields('strmon'));
		$jrf_tbl->stryear->setDbValue($rs->fields('stryear'));
		$jrf_tbl->strdate->setDbValue($rs->fields('strdate'));
		$jrf_tbl->strtime->setDbValue($rs->fields('strtime'));
		$jrf_tbl->strduedate->setDbValue($rs->fields('strduedate'));
		$jrf_tbl->strsubject->setDbValue($rs->fields('strsubject'));
		$jrf_tbl->strusername->setDbValue($rs->fields('strusername'));
		$jrf_tbl->strusereadd->setDbValue($rs->fields('strusereadd'));
		$jrf_tbl->strcompany->setDbValue($rs->fields('strcompany'));
		$jrf_tbl->strdepartment->setDbValue($rs->fields('strdepartment'));
		$jrf_tbl->strloc->setDbValue($rs->fields('strloc'));
		$jrf_tbl->strposition->setDbValue($rs->fields('strposition'));
		$jrf_tbl->strtelephone->setDbValue($rs->fields('strtelephone'));
		$jrf_tbl->strcostcent->setDbValue($rs->fields('strcostcent'));
		$jrf_tbl->strnature->setDbValue($rs->fields('strnature'));
		$jrf_tbl->strdescript->setDbValue($rs->fields('strdescript'));
		$jrf_tbl->strattach->setDbValue($rs->fields('strattach'));
		$jrf_tbl->strarea->setDbValue($rs->fields('strarea'));
		$jrf_tbl->strpriority->setDbValue($rs->fields('strpriority'));
		$jrf_tbl->strstatus->setDbValue($rs->fields('strstatus'));
		$jrf_tbl->strlastedit->setDbValue($rs->fields('strlastedit'));
		$jrf_tbl->strcategory->setDbValue($rs->fields('strcategory'));
		$jrf_tbl->strassigned->setDbValue($rs->fields('strassigned'));
		$jrf_tbl->strremarks->setDbValue($rs->fields('strremarks'));
		$jrf_tbl->strdatecomplete->setDbValue($rs->fields('strdatecomplete'));
		$jrf_tbl->strifoverdue->setDbValue($rs->fields('strifoverdue'));
		$jrf_tbl->strwithpr->setDbValue($rs->fields('strwithpr'));
		$jrf_tbl->sap_num->setDbValue($rs->fields('sap_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $jrf_tbl;

		// Initialize URLs
		$this->ViewUrl = $jrf_tbl->ViewUrl();
		$this->EditUrl = $jrf_tbl->EditUrl();
		$this->InlineEditUrl = $jrf_tbl->InlineEditUrl();
		$this->CopyUrl = $jrf_tbl->CopyUrl();
		$this->InlineCopyUrl = $jrf_tbl->InlineCopyUrl();
		$this->DeleteUrl = $jrf_tbl->DeleteUrl();

		// Call Row_Rendering event
		$jrf_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$jrf_tbl->ID->CellCssStyle = ""; $jrf_tbl->ID->CellCssClass = "";
		$jrf_tbl->ID->CellAttrs = array(); $jrf_tbl->ID->ViewAttrs = array(); $jrf_tbl->ID->EditAttrs = array();

		// strjrfnum
		$jrf_tbl->strjrfnum->CellCssStyle = ""; $jrf_tbl->strjrfnum->CellCssClass = "";
		$jrf_tbl->strjrfnum->CellAttrs = array(); $jrf_tbl->strjrfnum->ViewAttrs = array(); $jrf_tbl->strjrfnum->EditAttrs = array();

		// strquarter
		$jrf_tbl->strquarter->CellCssStyle = ""; $jrf_tbl->strquarter->CellCssClass = "";
		$jrf_tbl->strquarter->CellAttrs = array(); $jrf_tbl->strquarter->ViewAttrs = array(); $jrf_tbl->strquarter->EditAttrs = array();

		// strmon
		$jrf_tbl->strmon->CellCssStyle = ""; $jrf_tbl->strmon->CellCssClass = "";
		$jrf_tbl->strmon->CellAttrs = array(); $jrf_tbl->strmon->ViewAttrs = array(); $jrf_tbl->strmon->EditAttrs = array();

		// stryear
		$jrf_tbl->stryear->CellCssStyle = ""; $jrf_tbl->stryear->CellCssClass = "";
		$jrf_tbl->stryear->CellAttrs = array(); $jrf_tbl->stryear->ViewAttrs = array(); $jrf_tbl->stryear->EditAttrs = array();

		// strdate
		$jrf_tbl->strdate->CellCssStyle = ""; $jrf_tbl->strdate->CellCssClass = "";
		$jrf_tbl->strdate->CellAttrs = array(); $jrf_tbl->strdate->ViewAttrs = array(); $jrf_tbl->strdate->EditAttrs = array();

		// strtime
		$jrf_tbl->strtime->CellCssStyle = ""; $jrf_tbl->strtime->CellCssClass = "";
		$jrf_tbl->strtime->CellAttrs = array(); $jrf_tbl->strtime->ViewAttrs = array(); $jrf_tbl->strtime->EditAttrs = array();

		// strduedate
		$jrf_tbl->strduedate->CellCssStyle = ""; $jrf_tbl->strduedate->CellCssClass = "";
		$jrf_tbl->strduedate->CellAttrs = array(); $jrf_tbl->strduedate->ViewAttrs = array(); $jrf_tbl->strduedate->EditAttrs = array();

		// strsubject
		$jrf_tbl->strsubject->CellCssStyle = ""; $jrf_tbl->strsubject->CellCssClass = "";
		$jrf_tbl->strsubject->CellAttrs = array(); $jrf_tbl->strsubject->ViewAttrs = array(); $jrf_tbl->strsubject->EditAttrs = array();

		// strusername
		$jrf_tbl->strusername->CellCssStyle = ""; $jrf_tbl->strusername->CellCssClass = "";
		$jrf_tbl->strusername->CellAttrs = array(); $jrf_tbl->strusername->ViewAttrs = array(); $jrf_tbl->strusername->EditAttrs = array();

		// strusereadd
		$jrf_tbl->strusereadd->CellCssStyle = ""; $jrf_tbl->strusereadd->CellCssClass = "";
		$jrf_tbl->strusereadd->CellAttrs = array(); $jrf_tbl->strusereadd->ViewAttrs = array(); $jrf_tbl->strusereadd->EditAttrs = array();

		// strcompany
		$jrf_tbl->strcompany->CellCssStyle = ""; $jrf_tbl->strcompany->CellCssClass = "";
		$jrf_tbl->strcompany->CellAttrs = array(); $jrf_tbl->strcompany->ViewAttrs = array(); $jrf_tbl->strcompany->EditAttrs = array();

		// strdepartment
		$jrf_tbl->strdepartment->CellCssStyle = ""; $jrf_tbl->strdepartment->CellCssClass = "";
		$jrf_tbl->strdepartment->CellAttrs = array(); $jrf_tbl->strdepartment->ViewAttrs = array(); $jrf_tbl->strdepartment->EditAttrs = array();

		// strloc
		$jrf_tbl->strloc->CellCssStyle = ""; $jrf_tbl->strloc->CellCssClass = "";
		$jrf_tbl->strloc->CellAttrs = array(); $jrf_tbl->strloc->ViewAttrs = array(); $jrf_tbl->strloc->EditAttrs = array();

		// strposition
		$jrf_tbl->strposition->CellCssStyle = ""; $jrf_tbl->strposition->CellCssClass = "";
		$jrf_tbl->strposition->CellAttrs = array(); $jrf_tbl->strposition->ViewAttrs = array(); $jrf_tbl->strposition->EditAttrs = array();

		// strtelephone
		$jrf_tbl->strtelephone->CellCssStyle = ""; $jrf_tbl->strtelephone->CellCssClass = "";
		$jrf_tbl->strtelephone->CellAttrs = array(); $jrf_tbl->strtelephone->ViewAttrs = array(); $jrf_tbl->strtelephone->EditAttrs = array();

		// strcostcent
		$jrf_tbl->strcostcent->CellCssStyle = ""; $jrf_tbl->strcostcent->CellCssClass = "";
		$jrf_tbl->strcostcent->CellAttrs = array(); $jrf_tbl->strcostcent->ViewAttrs = array(); $jrf_tbl->strcostcent->EditAttrs = array();

		// strnature
		$jrf_tbl->strnature->CellCssStyle = ""; $jrf_tbl->strnature->CellCssClass = "";
		$jrf_tbl->strnature->CellAttrs = array(); $jrf_tbl->strnature->ViewAttrs = array(); $jrf_tbl->strnature->EditAttrs = array();

		// strdescript
		$jrf_tbl->strdescript->CellCssStyle = ""; $jrf_tbl->strdescript->CellCssClass = "";
		$jrf_tbl->strdescript->CellAttrs = array(); $jrf_tbl->strdescript->ViewAttrs = array(); $jrf_tbl->strdescript->EditAttrs = array();

		// strattach
		$jrf_tbl->strattach->CellCssStyle = ""; $jrf_tbl->strattach->CellCssClass = "";
		$jrf_tbl->strattach->CellAttrs = array(); $jrf_tbl->strattach->ViewAttrs = array(); $jrf_tbl->strattach->EditAttrs = array();

		// strarea
		$jrf_tbl->strarea->CellCssStyle = ""; $jrf_tbl->strarea->CellCssClass = "";
		$jrf_tbl->strarea->CellAttrs = array(); $jrf_tbl->strarea->ViewAttrs = array(); $jrf_tbl->strarea->EditAttrs = array();

		// strpriority
		$jrf_tbl->strpriority->CellCssStyle = ""; $jrf_tbl->strpriority->CellCssClass = "";
		$jrf_tbl->strpriority->CellAttrs = array(); $jrf_tbl->strpriority->ViewAttrs = array(); $jrf_tbl->strpriority->EditAttrs = array();

		// strstatus
		$jrf_tbl->strstatus->CellCssStyle = ""; $jrf_tbl->strstatus->CellCssClass = "";
		$jrf_tbl->strstatus->CellAttrs = array(); $jrf_tbl->strstatus->ViewAttrs = array(); $jrf_tbl->strstatus->EditAttrs = array();

		// strlastedit
		$jrf_tbl->strlastedit->CellCssStyle = ""; $jrf_tbl->strlastedit->CellCssClass = "";
		$jrf_tbl->strlastedit->CellAttrs = array(); $jrf_tbl->strlastedit->ViewAttrs = array(); $jrf_tbl->strlastedit->EditAttrs = array();

		// strcategory
		$jrf_tbl->strcategory->CellCssStyle = ""; $jrf_tbl->strcategory->CellCssClass = "";
		$jrf_tbl->strcategory->CellAttrs = array(); $jrf_tbl->strcategory->ViewAttrs = array(); $jrf_tbl->strcategory->EditAttrs = array();

		// strassigned
		$jrf_tbl->strassigned->CellCssStyle = ""; $jrf_tbl->strassigned->CellCssClass = "";
		$jrf_tbl->strassigned->CellAttrs = array(); $jrf_tbl->strassigned->ViewAttrs = array(); $jrf_tbl->strassigned->EditAttrs = array();

		// strremarks
		$jrf_tbl->strremarks->CellCssStyle = ""; $jrf_tbl->strremarks->CellCssClass = "";
		$jrf_tbl->strremarks->CellAttrs = array(); $jrf_tbl->strremarks->ViewAttrs = array(); $jrf_tbl->strremarks->EditAttrs = array();

		// strdatecomplete
		$jrf_tbl->strdatecomplete->CellCssStyle = ""; $jrf_tbl->strdatecomplete->CellCssClass = "";
		$jrf_tbl->strdatecomplete->CellAttrs = array(); $jrf_tbl->strdatecomplete->ViewAttrs = array(); $jrf_tbl->strdatecomplete->EditAttrs = array();

		// strifoverdue
		$jrf_tbl->strifoverdue->CellCssStyle = ""; $jrf_tbl->strifoverdue->CellCssClass = "";
		$jrf_tbl->strifoverdue->CellAttrs = array(); $jrf_tbl->strifoverdue->ViewAttrs = array(); $jrf_tbl->strifoverdue->EditAttrs = array();

		// strwithpr
		$jrf_tbl->strwithpr->CellCssStyle = ""; $jrf_tbl->strwithpr->CellCssClass = "";
		$jrf_tbl->strwithpr->CellAttrs = array(); $jrf_tbl->strwithpr->ViewAttrs = array(); $jrf_tbl->strwithpr->EditAttrs = array();

		// sap_num
		$jrf_tbl->sap_num->CellCssStyle = ""; $jrf_tbl->sap_num->CellCssClass = "";
		$jrf_tbl->sap_num->CellAttrs = array(); $jrf_tbl->sap_num->ViewAttrs = array(); $jrf_tbl->sap_num->EditAttrs = array();
		if ($jrf_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$jrf_tbl->ID->ViewValue = $jrf_tbl->ID->CurrentValue;
			$jrf_tbl->ID->CssStyle = "";
			$jrf_tbl->ID->CssClass = "";
			$jrf_tbl->ID->ViewCustomAttributes = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->ViewValue = $jrf_tbl->strjrfnum->CurrentValue;
			$jrf_tbl->strjrfnum->CssStyle = "";
			$jrf_tbl->strjrfnum->CssClass = "";
			$jrf_tbl->strjrfnum->ViewCustomAttributes = "";

			// strquarter
			$jrf_tbl->strquarter->ViewValue = $jrf_tbl->strquarter->CurrentValue;
			$jrf_tbl->strquarter->CssStyle = "";
			$jrf_tbl->strquarter->CssClass = "";
			$jrf_tbl->strquarter->ViewCustomAttributes = "";

			// strmon
			$jrf_tbl->strmon->ViewValue = $jrf_tbl->strmon->CurrentValue;
			$jrf_tbl->strmon->CssStyle = "";
			$jrf_tbl->strmon->CssClass = "";
			$jrf_tbl->strmon->ViewCustomAttributes = "";

			// stryear
			$jrf_tbl->stryear->ViewValue = $jrf_tbl->stryear->CurrentValue;
			$jrf_tbl->stryear->CssStyle = "";
			$jrf_tbl->stryear->CssClass = "";
			$jrf_tbl->stryear->ViewCustomAttributes = "";

			// strdate
			$jrf_tbl->strdate->ViewValue = $jrf_tbl->strdate->CurrentValue;
			$jrf_tbl->strdate->CssStyle = "";
			$jrf_tbl->strdate->CssClass = "";
			$jrf_tbl->strdate->ViewCustomAttributes = "";

			// strtime
			$jrf_tbl->strtime->ViewValue = $jrf_tbl->strtime->CurrentValue;
			$jrf_tbl->strtime->CssStyle = "";
			$jrf_tbl->strtime->CssClass = "";
			$jrf_tbl->strtime->ViewCustomAttributes = "";

			// strduedate
			$jrf_tbl->strduedate->ViewValue = $jrf_tbl->strduedate->CurrentValue;
			$jrf_tbl->strduedate->CssStyle = "";
			$jrf_tbl->strduedate->CssClass = "";
			$jrf_tbl->strduedate->ViewCustomAttributes = "";

			// strsubject
			$jrf_tbl->strsubject->ViewValue = $jrf_tbl->strsubject->CurrentValue;
			$jrf_tbl->strsubject->CssStyle = "";
			$jrf_tbl->strsubject->CssClass = "";
			$jrf_tbl->strsubject->ViewCustomAttributes = "";

			// strusername
			$jrf_tbl->strusername->ViewValue = $jrf_tbl->strusername->CurrentValue;
			$jrf_tbl->strusername->CssStyle = "";
			$jrf_tbl->strusername->CssClass = "";
			$jrf_tbl->strusername->ViewCustomAttributes = "";

			// strusereadd
			$jrf_tbl->strusereadd->ViewValue = $jrf_tbl->strusereadd->CurrentValue;
			$jrf_tbl->strusereadd->CssStyle = "";
			$jrf_tbl->strusereadd->CssClass = "";
			$jrf_tbl->strusereadd->ViewCustomAttributes = "";

			// strcompany
			$jrf_tbl->strcompany->ViewValue = $jrf_tbl->strcompany->CurrentValue;
			$jrf_tbl->strcompany->CssStyle = "";
			$jrf_tbl->strcompany->CssClass = "";
			$jrf_tbl->strcompany->ViewCustomAttributes = "";

			// strdepartment
			$jrf_tbl->strdepartment->ViewValue = $jrf_tbl->strdepartment->CurrentValue;
			$jrf_tbl->strdepartment->CssStyle = "";
			$jrf_tbl->strdepartment->CssClass = "";
			$jrf_tbl->strdepartment->ViewCustomAttributes = "";

			// strloc
			$jrf_tbl->strloc->ViewValue = $jrf_tbl->strloc->CurrentValue;
			$jrf_tbl->strloc->CssStyle = "";
			$jrf_tbl->strloc->CssClass = "";
			$jrf_tbl->strloc->ViewCustomAttributes = "";

			// strposition
			$jrf_tbl->strposition->ViewValue = $jrf_tbl->strposition->CurrentValue;
			$jrf_tbl->strposition->CssStyle = "";
			$jrf_tbl->strposition->CssClass = "";
			$jrf_tbl->strposition->ViewCustomAttributes = "";

			// strtelephone
			$jrf_tbl->strtelephone->ViewValue = $jrf_tbl->strtelephone->CurrentValue;
			$jrf_tbl->strtelephone->CssStyle = "";
			$jrf_tbl->strtelephone->CssClass = "";
			$jrf_tbl->strtelephone->ViewCustomAttributes = "";

			// strcostcent
			$jrf_tbl->strcostcent->ViewValue = $jrf_tbl->strcostcent->CurrentValue;
			$jrf_tbl->strcostcent->CssStyle = "";
			$jrf_tbl->strcostcent->CssClass = "";
			$jrf_tbl->strcostcent->ViewCustomAttributes = "";

			// strnature
			$jrf_tbl->strnature->ViewValue = $jrf_tbl->strnature->CurrentValue;
			$jrf_tbl->strnature->CssStyle = "";
			$jrf_tbl->strnature->CssClass = "";
			$jrf_tbl->strnature->ViewCustomAttributes = "";

			// strdescript
			$jrf_tbl->strdescript->ViewValue = $jrf_tbl->strdescript->CurrentValue;
			$jrf_tbl->strdescript->CssStyle = "";
			$jrf_tbl->strdescript->CssClass = "";
			$jrf_tbl->strdescript->ViewCustomAttributes = "";

			// strattach
			$jrf_tbl->strattach->ViewValue = $jrf_tbl->strattach->CurrentValue;
			$jrf_tbl->strattach->CssStyle = "";
			$jrf_tbl->strattach->CssClass = "";
			$jrf_tbl->strattach->ViewCustomAttributes = "";

			// strarea
			$jrf_tbl->strarea->ViewValue = $jrf_tbl->strarea->CurrentValue;
			$jrf_tbl->strarea->CssStyle = "";
			$jrf_tbl->strarea->CssClass = "";
			$jrf_tbl->strarea->ViewCustomAttributes = "";

			// strpriority
			$jrf_tbl->strpriority->ViewValue = $jrf_tbl->strpriority->CurrentValue;
			$jrf_tbl->strpriority->CssStyle = "";
			$jrf_tbl->strpriority->CssClass = "";
			$jrf_tbl->strpriority->ViewCustomAttributes = "";

			// strstatus
			$jrf_tbl->strstatus->ViewValue = $jrf_tbl->strstatus->CurrentValue;
			$jrf_tbl->strstatus->CssStyle = "";
			$jrf_tbl->strstatus->CssClass = "";
			$jrf_tbl->strstatus->ViewCustomAttributes = "";

			// strlastedit
			$jrf_tbl->strlastedit->ViewValue = $jrf_tbl->strlastedit->CurrentValue;
			$jrf_tbl->strlastedit->CssStyle = "";
			$jrf_tbl->strlastedit->CssClass = "";
			$jrf_tbl->strlastedit->ViewCustomAttributes = "";

			// strcategory
			$jrf_tbl->strcategory->ViewValue = $jrf_tbl->strcategory->CurrentValue;
			$jrf_tbl->strcategory->CssStyle = "";
			$jrf_tbl->strcategory->CssClass = "";
			$jrf_tbl->strcategory->ViewCustomAttributes = "";

			// strassigned
			$jrf_tbl->strassigned->ViewValue = $jrf_tbl->strassigned->CurrentValue;
			$jrf_tbl->strassigned->CssStyle = "";
			$jrf_tbl->strassigned->CssClass = "";
			$jrf_tbl->strassigned->ViewCustomAttributes = "";

			// strremarks
			$jrf_tbl->strremarks->ViewValue = $jrf_tbl->strremarks->CurrentValue;
			$jrf_tbl->strremarks->CssStyle = "";
			$jrf_tbl->strremarks->CssClass = "";
			$jrf_tbl->strremarks->ViewCustomAttributes = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->ViewValue = $jrf_tbl->strdatecomplete->CurrentValue;
			$jrf_tbl->strdatecomplete->CssStyle = "";
			$jrf_tbl->strdatecomplete->CssClass = "";
			$jrf_tbl->strdatecomplete->ViewCustomAttributes = "";

			// strifoverdue
			$jrf_tbl->strifoverdue->ViewValue = $jrf_tbl->strifoverdue->CurrentValue;
			$jrf_tbl->strifoverdue->CssStyle = "";
			$jrf_tbl->strifoverdue->CssClass = "";
			$jrf_tbl->strifoverdue->ViewCustomAttributes = "";

			// strwithpr
			$jrf_tbl->strwithpr->ViewValue = $jrf_tbl->strwithpr->CurrentValue;
			$jrf_tbl->strwithpr->CssStyle = "";
			$jrf_tbl->strwithpr->CssClass = "";
			$jrf_tbl->strwithpr->ViewCustomAttributes = "";

			// sap_num
			$jrf_tbl->sap_num->ViewValue = $jrf_tbl->sap_num->CurrentValue;
			$jrf_tbl->sap_num->CssStyle = "";
			$jrf_tbl->sap_num->CssClass = "";
			$jrf_tbl->sap_num->ViewCustomAttributes = "";

			// ID
			$jrf_tbl->ID->HrefValue = "";
			$jrf_tbl->ID->TooltipValue = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->HrefValue = "";
			$jrf_tbl->strjrfnum->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strjrfnum->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strjrfnum->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strjrfnum"));

			// strquarter
			$jrf_tbl->strquarter->HrefValue = "";
			$jrf_tbl->strquarter->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strquarter->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strquarter->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strquarter"));

			// strmon
			$jrf_tbl->strmon->HrefValue = "";
			$jrf_tbl->strmon->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strmon->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strmon->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strmon"));

			// stryear
			$jrf_tbl->stryear->HrefValue = "";
			$jrf_tbl->stryear->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->stryear->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->stryear->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_stryear"));

			// strdate
			$jrf_tbl->strdate->HrefValue = "";
			$jrf_tbl->strdate->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strdate->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strdate->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strdate"));

			// strtime
			$jrf_tbl->strtime->HrefValue = "";
			$jrf_tbl->strtime->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strtime->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strtime->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strtime"));

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";
			$jrf_tbl->strduedate->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strduedate->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strduedate->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strduedate"));

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";
			$jrf_tbl->strsubject->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strsubject->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strsubject->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strsubject"));

			// strusername
			$jrf_tbl->strusername->HrefValue = "";
			$jrf_tbl->strusername->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strusername->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strusername->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strusername"));

			// strusereadd
			$jrf_tbl->strusereadd->HrefValue = "";
			$jrf_tbl->strusereadd->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strusereadd->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strusereadd->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strusereadd"));

			// strcompany
			$jrf_tbl->strcompany->HrefValue = "";
			$jrf_tbl->strcompany->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strcompany->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strcompany->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strcompany"));

			// strdepartment
			$jrf_tbl->strdepartment->HrefValue = "";
			$jrf_tbl->strdepartment->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strdepartment->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strdepartment->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strdepartment"));

			// strloc
			$jrf_tbl->strloc->HrefValue = "";
			$jrf_tbl->strloc->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strloc->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strloc->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strloc"));

			// strposition
			$jrf_tbl->strposition->HrefValue = "";
			$jrf_tbl->strposition->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strposition->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strposition->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strposition"));

			// strtelephone
			$jrf_tbl->strtelephone->HrefValue = "";
			$jrf_tbl->strtelephone->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strtelephone->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strtelephone->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strtelephone"));

			// strcostcent
			$jrf_tbl->strcostcent->HrefValue = "";
			$jrf_tbl->strcostcent->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strcostcent->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strcostcent->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strcostcent"));

			// strnature
			$jrf_tbl->strnature->HrefValue = "";
			$jrf_tbl->strnature->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strnature->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strnature->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strnature"));

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";
			$jrf_tbl->strdescript->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strdescript->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strdescript->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strdescript"));

			// strattach
			$jrf_tbl->strattach->HrefValue = "";
			$jrf_tbl->strattach->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strattach->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strattach->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strattach"));

			// strarea
			$jrf_tbl->strarea->HrefValue = "";
			$jrf_tbl->strarea->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strarea->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strarea->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strarea"));

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";
			$jrf_tbl->strpriority->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strpriority->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strpriority->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strpriority"));

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";
			$jrf_tbl->strstatus->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strstatus->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strstatus->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strstatus"));

			// strlastedit
			$jrf_tbl->strlastedit->HrefValue = "";
			$jrf_tbl->strlastedit->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strlastedit->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strlastedit->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strlastedit"));

			// strcategory
			$jrf_tbl->strcategory->HrefValue = "";
			$jrf_tbl->strcategory->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strcategory->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strcategory->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strcategory"));

			// strassigned
			$jrf_tbl->strassigned->HrefValue = "";
			$jrf_tbl->strassigned->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strassigned->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strassigned->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strassigned"));

			// strremarks
			$jrf_tbl->strremarks->HrefValue = "";
			$jrf_tbl->strremarks->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strremarks->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strremarks->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strremarks"));

			// strdatecomplete
			$jrf_tbl->strdatecomplete->HrefValue = "";
			$jrf_tbl->strdatecomplete->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strdatecomplete->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strdatecomplete->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strdatecomplete"));

			// strifoverdue
			$jrf_tbl->strifoverdue->HrefValue = "";
			$jrf_tbl->strifoverdue->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strifoverdue->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strifoverdue->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strifoverdue"));

			// strwithpr
			$jrf_tbl->strwithpr->HrefValue = "";
			$jrf_tbl->strwithpr->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->strwithpr->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->strwithpr->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_strwithpr"));

			// sap_num
			$jrf_tbl->sap_num->HrefValue = "";
			$jrf_tbl->sap_num->TooltipValue = "";
			if ($jrf_tbl->Export == "")
				$jrf_tbl->sap_num->ViewValue = ew_Highlight($jrf_tbl->HighlightName(), $jrf_tbl->sap_num->ViewValue, $jrf_tbl->getSessionBasicSearchKeyword(), $jrf_tbl->getSessionBasicSearchType(), $jrf_tbl->getAdvancedSearch("x_sap_num"));
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $jrf_tbl;

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
		global $jrf_tbl;
		$jrf_tbl->ID->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_ID");
		$jrf_tbl->strjrfnum->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strjrfnum");
		$jrf_tbl->strquarter->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strquarter");
		$jrf_tbl->strmon->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strmon");
		$jrf_tbl->stryear->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_stryear");
		$jrf_tbl->strdate->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strdate");
		$jrf_tbl->strtime->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strtime");
		$jrf_tbl->strduedate->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strduedate");
		$jrf_tbl->strsubject->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strsubject");
		$jrf_tbl->strusername->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strusername");
		$jrf_tbl->strusereadd->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strusereadd");
		$jrf_tbl->strcompany->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strcompany");
		$jrf_tbl->strdepartment->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strdepartment");
		$jrf_tbl->strloc->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strloc");
		$jrf_tbl->strposition->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strposition");
		$jrf_tbl->strtelephone->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strtelephone");
		$jrf_tbl->strcostcent->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strcostcent");
		$jrf_tbl->strnature->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strnature");
		$jrf_tbl->strdescript->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strdescript");
		$jrf_tbl->strattach->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strattach");
		$jrf_tbl->strarea->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strarea");
		$jrf_tbl->strpriority->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strpriority");
		$jrf_tbl->strstatus->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strstatus");
		$jrf_tbl->strlastedit->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strlastedit");
		$jrf_tbl->strcategory->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strcategory");
		$jrf_tbl->strassigned->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strassigned");
		$jrf_tbl->strremarks->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strremarks");
		$jrf_tbl->strdatecomplete->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strdatecomplete");
		$jrf_tbl->strifoverdue->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strifoverdue");
		$jrf_tbl->strwithpr->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_strwithpr");
		$jrf_tbl->sap_num->AdvancedSearch->SearchValue = $jrf_tbl->getAdvancedSearch("x_sap_num");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $jrf_tbl;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $jrf_tbl->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($jrf_tbl->ExportAll) {
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
		if ($jrf_tbl->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($jrf_tbl, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($jrf_tbl->ID);
				$ExportDoc->ExportCaption($jrf_tbl->strjrfnum);
				$ExportDoc->ExportCaption($jrf_tbl->strdate);
				$ExportDoc->ExportCaption($jrf_tbl->strtime);
				$ExportDoc->ExportCaption($jrf_tbl->strduedate);
				$ExportDoc->ExportCaption($jrf_tbl->strsubject);
				$ExportDoc->ExportCaption($jrf_tbl->strusername);
				$ExportDoc->ExportCaption($jrf_tbl->strusereadd);
				$ExportDoc->ExportCaption($jrf_tbl->strcompany);
				$ExportDoc->ExportCaption($jrf_tbl->strdepartment);
				$ExportDoc->ExportCaption($jrf_tbl->strloc);
				$ExportDoc->ExportCaption($jrf_tbl->strposition);
				$ExportDoc->ExportCaption($jrf_tbl->strtelephone);
				$ExportDoc->ExportCaption($jrf_tbl->strcostcent);
				$ExportDoc->ExportCaption($jrf_tbl->strnature);
				$ExportDoc->ExportCaption($jrf_tbl->strdescript);
				$ExportDoc->ExportCaption($jrf_tbl->strarea);
				$ExportDoc->ExportCaption($jrf_tbl->strpriority);
				$ExportDoc->ExportCaption($jrf_tbl->strstatus);
				$ExportDoc->ExportCaption($jrf_tbl->strlastedit);
				$ExportDoc->ExportCaption($jrf_tbl->strcategory);
				$ExportDoc->ExportCaption($jrf_tbl->strassigned);
				$ExportDoc->ExportCaption($jrf_tbl->strremarks);
				$ExportDoc->ExportCaption($jrf_tbl->strdatecomplete);
				$ExportDoc->ExportCaption($jrf_tbl->strifoverdue);
				$ExportDoc->ExportCaption($jrf_tbl->strwithpr);
				$ExportDoc->ExportCaption($jrf_tbl->sap_num);
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
				$jrf_tbl->CssClass = "";
				$jrf_tbl->CssStyle = "";
				$jrf_tbl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($jrf_tbl->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('ID', $jrf_tbl->ID->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strjrfnum', $jrf_tbl->strjrfnum->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdate', $jrf_tbl->strdate->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strtime', $jrf_tbl->strtime->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strduedate', $jrf_tbl->strduedate->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strsubject', $jrf_tbl->strsubject->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strusername', $jrf_tbl->strusername->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strusereadd', $jrf_tbl->strusereadd->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcompany', $jrf_tbl->strcompany->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdepartment', $jrf_tbl->strdepartment->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strloc', $jrf_tbl->strloc->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strposition', $jrf_tbl->strposition->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strtelephone', $jrf_tbl->strtelephone->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcostcent', $jrf_tbl->strcostcent->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strnature', $jrf_tbl->strnature->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdescript', $jrf_tbl->strdescript->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strarea', $jrf_tbl->strarea->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strpriority', $jrf_tbl->strpriority->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strstatus', $jrf_tbl->strstatus->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strlastedit', $jrf_tbl->strlastedit->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strcategory', $jrf_tbl->strcategory->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strassigned', $jrf_tbl->strassigned->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strremarks', $jrf_tbl->strremarks->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strdatecomplete', $jrf_tbl->strdatecomplete->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strifoverdue', $jrf_tbl->strifoverdue->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('strwithpr', $jrf_tbl->strwithpr->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
					$XmlDoc->AddField('sap_num', $jrf_tbl->sap_num->ExportValue($jrf_tbl->Export, $jrf_tbl->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($jrf_tbl->ID);
					$ExportDoc->ExportField($jrf_tbl->strjrfnum);
					$ExportDoc->ExportField($jrf_tbl->strdate);
					$ExportDoc->ExportField($jrf_tbl->strtime);
					$ExportDoc->ExportField($jrf_tbl->strduedate);
					$ExportDoc->ExportField($jrf_tbl->strsubject);
					$ExportDoc->ExportField($jrf_tbl->strusername);
					$ExportDoc->ExportField($jrf_tbl->strusereadd);
					$ExportDoc->ExportField($jrf_tbl->strcompany);
					$ExportDoc->ExportField($jrf_tbl->strdepartment);
					$ExportDoc->ExportField($jrf_tbl->strloc);
					$ExportDoc->ExportField($jrf_tbl->strposition);
					$ExportDoc->ExportField($jrf_tbl->strtelephone);
					$ExportDoc->ExportField($jrf_tbl->strcostcent);
					$ExportDoc->ExportField($jrf_tbl->strnature);
					$ExportDoc->ExportField($jrf_tbl->strdescript);
					$ExportDoc->ExportField($jrf_tbl->strarea);
					$ExportDoc->ExportField($jrf_tbl->strpriority);
					$ExportDoc->ExportField($jrf_tbl->strstatus);
					$ExportDoc->ExportField($jrf_tbl->strlastedit);
					$ExportDoc->ExportField($jrf_tbl->strcategory);
					$ExportDoc->ExportField($jrf_tbl->strassigned);
					$ExportDoc->ExportField($jrf_tbl->strremarks);
					$ExportDoc->ExportField($jrf_tbl->strdatecomplete);
					$ExportDoc->ExportField($jrf_tbl->strifoverdue);
					$ExportDoc->ExportField($jrf_tbl->strwithpr);
					$ExportDoc->ExportField($jrf_tbl->sap_num);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($jrf_tbl->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($jrf_tbl->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($jrf_tbl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($jrf_tbl->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($jrf_tbl->ExportReturnUrl());
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
