<?php
include('sec_access.php');
require 'class.php';
// Turn on output buffering ob_start(); 
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
$archv_finished_search = new carchv_finished_search();
$Page =& $archv_finished_search;

// Page init
$archv_finished_search->Page_Init();

// Page main
$archv_finished_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var archv_finished_search = new ew_Page("archv_finished_search");

// page properties
archv_finished_search.PageID = "search"; // page ID
archv_finished_search.FormID = "farchv_finishedsearch"; // form ID
var EW_PAGE_ID = archv_finished_search.PageID; // for backward compatibility

// extend page with validate function for search
archv_finished_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($archv_finished->ID->FldErrMsg()) ?>");

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
archv_finished_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
archv_finished_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
archv_finished_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
archv_finished_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
archv_finished_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
archv_finished_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
    			<h3><strong><i class="fa fa-wrench"></i> ADVANCED SEARCH</strong></h3>
    		</div>
    	</div>
    	<hr>
<?php include('fmd-nav.php'); ?>

<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $archv_finished->getReturnUrl() ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$archv_finished_search->ShowMessage();
?>
<form name="farchv_finishedsearch" id="farchv_finishedsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return archv_finished_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="archv_finished">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $archv_finished->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $archv_finished->ID->FldCaption() ?></td>
		<td<?php echo $archv_finished->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $archv_finished->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $archv_finished->ID->FldTitle() ?>" value="<?php echo $archv_finished->ID->EditValue ?>"<?php echo $archv_finished->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strjrfnum->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "JRF NUM" ?></td>
		<td<?php echo $archv_finished->strjrfnum->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strjrfnum" id="z_strjrfnum" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strjrfnum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strjrfnum" id="x_strjrfnum" title="<?php echo $archv_finished->strjrfnum->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $archv_finished->strjrfnum->EditValue ?>"<?php echo $archv_finished->strjrfnum->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strquarter->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "QUARTER" ?></td>
		<td<?php echo $archv_finished->strquarter->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strquarter" id="z_strquarter" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strquarter->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strquarter" id="x_strquarter" title="<?php echo $archv_finished->strquarter->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $archv_finished->strquarter->EditValue ?>"<?php echo $archv_finished->strquarter->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strmon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "MONTH" ?></td>
		<td<?php echo $archv_finished->strmon->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strmon" id="z_strmon" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strmon->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
			<select name="x_strmon" id="x_strmon">
				<option value="">--Select--</option>
				<option value="01">Jan</option>	
				<option value="02">Feb</option>
				<option value="03">Mar</option>
				<option value="04">Apr</option>
				<option value="05">May</option>
				<option value="06">Jun</option>
				<option value="07">Jul</option>
				<option value="08">Aug</option>
				<option value="09">Sep</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>
			</select>
<!--<input type="text" name="x_strmon" id="x_strmon" title="<?php// echo $archv_finished->strmon->FldTitle() ?>" size="30" maxlength="50" value="<?php// echo $archv_finished->strmon->EditValue ?>"<?php// echo $archv_finished->strmon->EditAttributes() ?>>-->
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->stryear->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "YEAR" ?></td>
		<td<?php echo $archv_finished->stryear->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_stryear" id="z_stryear" value="LIKE"></span></td>
		<td<?php echo $archv_finished->stryear->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stryear" id="x_stryear" title="<?php echo $archv_finished->stryear->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $archv_finished->stryear->EditValue ?>"<?php echo $archv_finished->stryear->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strdate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "DATE RECEIVED" ?></td>
		<td<?php echo $archv_finished->strdate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdate" id="z_strdate" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strdate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdate" id="x_strdate" title="<?php echo $archv_finished->strdate->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $archv_finished->strdate->EditValue ?>"<?php echo $archv_finished->strdate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>

	<tr<?php echo $archv_finished->strusername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "REQUESTED BY" ?></td>
		<td<?php echo $archv_finished->strusername->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strusername" id="z_strusername" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strusername->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strusername" id="x_strusername" title="<?php echo $archv_finished->strusername->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $archv_finished->strusername->EditValue ?>"<?php echo $archv_finished->strusername->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strusereadd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "USER E-ADD"?></td>
		<td<?php echo $archv_finished->strusereadd->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strusereadd" id="z_strusereadd" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strusereadd->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strusereadd" id="x_strusereadd" title="<?php echo $archv_finished->strusereadd->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $archv_finished->strusereadd->EditValue ?>"<?php echo $archv_finished->strusereadd->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<tr<?php echo $archv_finished->strsubject->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "SUBJECT"?></td>
		<td<?php echo $archv_finished->strsubject->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strsubject" id="z_strsubject" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strsubject->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strsubject" id="x_strsubject" title="<?php echo $archv_finished->strsubject->FldTitle() ?>" cols="35" rows="4"<?php echo $archv_finished->strsubject->EditAttributes() ?>><?php echo $archv_finished->strsubject->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "NATURE"; ?></td>
		<td<?php echo $archv_finished->strnature->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strnature" id="z_strnature" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strnature->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strnature" id="x_strnature" title="<?php echo $archv_finished->strnature->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $archv_finished->strnature->EditValue ?>"<?php echo $archv_finished->strnature->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strdescript->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "DESCRIPTION" ?></td>
		<td<?php echo $archv_finished->strdescript->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdescript" id="z_strdescript" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strdescript->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strdescript" id="x_strdescript" title="<?php echo $archv_finished->strdescript->FldTitle() ?>" cols="35" rows="4"<?php echo $archv_finished->strdescript->EditAttributes() ?>><?php echo $archv_finished->strdescript->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
<tr<?php echo $archv_finished->strpriority->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "PRIORITY LEVEL" ?></td>
		<td<?php echo $archv_finished->strpriority->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strpriority" id="z_strpriority" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strpriority->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strpriority" id="x_strpriority" title="<?php echo $archv_finished->strpriority->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $archv_finished->strpriority->EditValue ?>"<?php echo $archv_finished->strpriority->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strduedate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "DUE DATE" ?></td>
		<td<?php echo $archv_finished->strduedate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strduedate" id="z_strduedate" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strduedate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strduedate" id="x_strduedate" title="<?php echo $archv_finished->strduedate->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $archv_finished->strduedate->EditValue ?>"<?php echo $archv_finished->strduedate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strstatus->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "STATUS" ?></td>
		<td<?php echo $archv_finished->strstatus->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strstatus" id="z_strstatus" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strstatus->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strstatus" id="x_strstatus" title="<?php echo $archv_finished->strstatus->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $archv_finished->strstatus->EditValue ?>"<?php echo $archv_finished->strstatus->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strlastedit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "LAST EDITED BY" ?></td>
		<td<?php echo $archv_finished->strlastedit->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strlastedit" id="z_strlastedit" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strlastedit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strlastedit" id="x_strlastedit" title="<?php echo $archv_finished->strlastedit->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $archv_finished->strlastedit->EditValue ?>"<?php echo $archv_finished->strlastedit->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "SECTION" ?></td>
		<td<?php echo $archv_finished->strcategory->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strcategory" id="z_strcategory" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strcategory->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strcategory" id="x_strcategory" title="<?php echo $archv_finished->strcategory->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $archv_finished->strcategory->EditValue ?>"<?php echo $archv_finished->strcategory->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strassigned->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "ASSIGNED TO" ?></td>
		<td<?php echo $archv_finished->strassigned->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strassigned" id="z_strassigned" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strassigned->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strassigned" id="x_strassigned" title="<?php echo $archv_finished->strassigned->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $archv_finished->strassigned->EditValue ?>"<?php echo $archv_finished->strassigned->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strdatecomplete->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "DATE COMPLETED" ?></td>
		<td<?php echo $archv_finished->strdatecomplete->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdatecomplete" id="z_strdatecomplete" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strdatecomplete->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdatecomplete" id="x_strdatecomplete" title="<?php echo $archv_finished->strdatecomplete->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $archv_finished->strdatecomplete->EditValue ?>"<?php echo $archv_finished->strdatecomplete->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strwithpr->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "WITH PR" ?></td>
		<td<?php echo $archv_finished->strwithpr->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strwithpr" id="z_strwithpr" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strwithpr->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
				<select name="x_strwithpr" id="x_strwithpr">
					<option value=""></option>
					<option value="1">Yes</option>
				</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $archv_finished->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "REMARKS" ?></td>
		<td<?php echo $archv_finished->strremarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strremarks" id="z_strremarks" value="LIKE"></span></td>
		<td<?php echo $archv_finished->strremarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $archv_finished->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $archv_finished->strremarks->EditAttributes() ?>><?php echo $archv_finished->strremarks->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
<tr<?php echo $archv_finished->work_days->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo "DAYS OF WORK" ?></td>
		<td<?php echo $archv_finished->work_days->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_work_days" id="z_work_days" value="LIKE"></span></td>
		<td<?php echo $archv_finished->work_days->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_work_days" id="x_work_days" title="<?php echo $archv_finished->work_days->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $archv_finished->work_days->EditValue ?>"<?php echo $archv_finished->work_days->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
	<BR/>
<input type="submit" name="Action" id="Action" class="btn btn-primary btn-sm" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" class="btn btn-info btn-sm" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
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
$archv_finished_search->Page_Terminate();
?>
<?php

//
// Page class
//
class carchv_finished_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'archv_finished';

	// Page object name
	var $PageObjName = 'archv_finished_search';

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
	function carchv_finished_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (archv_finished)
		$GLOBALS["archv_finished"] = new carchv_finished();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'archv_finished', TRUE);

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
		global $archv_finished;

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
		global $objForm, $Language, $gsSearchError, $archv_finished;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$archv_finished->CurrentAction = $objForm->GetValue("a_search");
			switch ($archv_finished->CurrentAction) {
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
						$sSrchStr = $archv_finished->UrlParm($sSrchStr);
						$this->Page_Terminate("archv_finishedlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$archv_finished->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $archv_finished;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strjrfnum); // strjrfnum
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strquarter); // strquarter
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strmon); // strmon
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->stryear); // stryear
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strdate); // strdate
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strtime); // strtime
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strusername); // strusername
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strusereadd); // strusereadd
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strcompany); // strcompany
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strdepartment); // strdepartment
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strloc); // strloc
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strposition); // strposition
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strtelephone); // strtelephone
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strcostcent); // strcostcent
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strsubject); // strsubject
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strnature); // strnature
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strdescript); // strdescript
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strarea); // strarea
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strattach); // strattach
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strpriority); // strpriority
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strduedate); // strduedate
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strstatus); // strstatus
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strlastedit); // strlastedit
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strcategory); // strcategory
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strassigned); // strassigned
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strdatecomplete); // strdatecomplete
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strwithpr); // strwithpr
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->strremarks); // strremarks
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->sap_num); // sap_num
	$this->BuildSearchUrl($sSrchUrl, $archv_finished->work_days); // work_days
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
		global $objForm, $archv_finished;

		// Load search values
		// ID

		$archv_finished->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$archv_finished->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// strjrfnum
		$archv_finished->strjrfnum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strjrfnum"));
		$archv_finished->strjrfnum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strjrfnum");

		// strquarter
		$archv_finished->strquarter->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strquarter"));
		$archv_finished->strquarter->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strquarter");

		// strmon
		$archv_finished->strmon->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strmon"));
		$archv_finished->strmon->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strmon");

		// stryear
		$archv_finished->stryear->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stryear"));
		$archv_finished->stryear->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stryear");

		// strdate
		$archv_finished->strdate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdate"));
		$archv_finished->strdate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdate");

		// strtime
		$archv_finished->strtime->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strtime"));
		$archv_finished->strtime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strtime");

		// strusername
		$archv_finished->strusername->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strusername"));
		$archv_finished->strusername->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strusername");

		// strusereadd
		$archv_finished->strusereadd->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strusereadd"));
		$archv_finished->strusereadd->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strusereadd");

		// strcompany
		$archv_finished->strcompany->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcompany"));
		$archv_finished->strcompany->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcompany");

		// strdepartment
		$archv_finished->strdepartment->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdepartment"));
		$archv_finished->strdepartment->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdepartment");

		// strloc
		$archv_finished->strloc->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strloc"));
		$archv_finished->strloc->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strloc");

		// strposition
		$archv_finished->strposition->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strposition"));
		$archv_finished->strposition->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strposition");

		// strtelephone
		$archv_finished->strtelephone->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strtelephone"));
		$archv_finished->strtelephone->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strtelephone");

		// strcostcent
		$archv_finished->strcostcent->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcostcent"));
		$archv_finished->strcostcent->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcostcent");

		// strsubject
		$archv_finished->strsubject->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strsubject"));
		$archv_finished->strsubject->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strsubject");

		// strnature
		$archv_finished->strnature->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strnature"));
		$archv_finished->strnature->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strnature");

		// strdescript
		$archv_finished->strdescript->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdescript"));
		$archv_finished->strdescript->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdescript");

		// strarea
		$archv_finished->strarea->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strarea"));
		$archv_finished->strarea->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strarea");

		// strattach
		$archv_finished->strattach->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strattach"));
		$archv_finished->strattach->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strattach");

		// strpriority
		$archv_finished->strpriority->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strpriority"));
		$archv_finished->strpriority->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strpriority");

		// strduedate
		$archv_finished->strduedate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strduedate"));
		$archv_finished->strduedate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strduedate");

		// strstatus
		$archv_finished->strstatus->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strstatus"));
		$archv_finished->strstatus->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strstatus");

		// strlastedit
		$archv_finished->strlastedit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strlastedit"));
		$archv_finished->strlastedit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strlastedit");

		// strcategory
		$archv_finished->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcategory"));
		$archv_finished->strcategory->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcategory");

		// strassigned
		$archv_finished->strassigned->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strassigned"));
		$archv_finished->strassigned->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strassigned");

		// strdatecomplete
		$archv_finished->strdatecomplete->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdatecomplete"));
		$archv_finished->strdatecomplete->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdatecomplete");

		// strwithpr
		$archv_finished->strwithpr->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strwithpr"));
		$archv_finished->strwithpr->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strwithpr");

		// strremarks
		$archv_finished->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strremarks"));
		$archv_finished->strremarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strremarks");

		// sap_num
		$archv_finished->sap_num->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sap_num"));
		$archv_finished->sap_num->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sap_num");

		// work_days
		$archv_finished->work_days->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_work_days"));
		$archv_finished->work_days->AdvancedSearch->SearchOperator = $objForm->GetValue("z_work_days");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $archv_finished;

		// Initialize URLs
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

			// strquarter
			$archv_finished->strquarter->HrefValue = "";
			$archv_finished->strquarter->TooltipValue = "";

			// strmon
			$archv_finished->strmon->HrefValue = "";
			$archv_finished->strmon->TooltipValue = "";

			// stryear
			$archv_finished->stryear->HrefValue = "";
			$archv_finished->stryear->TooltipValue = "";

			// strdate
			$archv_finished->strdate->HrefValue = "";
			$archv_finished->strdate->TooltipValue = "";

			// strtime
			$archv_finished->strtime->HrefValue = "";
			$archv_finished->strtime->TooltipValue = "";

			// strusername
			$archv_finished->strusername->HrefValue = "";
			$archv_finished->strusername->TooltipValue = "";

			// strusereadd
			$archv_finished->strusereadd->HrefValue = "";
			$archv_finished->strusereadd->TooltipValue = "";

			// strcompany
			$archv_finished->strcompany->HrefValue = "";
			$archv_finished->strcompany->TooltipValue = "";

			// strdepartment
			$archv_finished->strdepartment->HrefValue = "";
			$archv_finished->strdepartment->TooltipValue = "";

			// strloc
			$archv_finished->strloc->HrefValue = "";
			$archv_finished->strloc->TooltipValue = "";

			// strposition
			$archv_finished->strposition->HrefValue = "";
			$archv_finished->strposition->TooltipValue = "";

			// strtelephone
			$archv_finished->strtelephone->HrefValue = "";
			$archv_finished->strtelephone->TooltipValue = "";

			// strcostcent
			$archv_finished->strcostcent->HrefValue = "";
			$archv_finished->strcostcent->TooltipValue = "";

			// strsubject
			$archv_finished->strsubject->HrefValue = "";
			$archv_finished->strsubject->TooltipValue = "";

			// strnature
			$archv_finished->strnature->HrefValue = "";
			$archv_finished->strnature->TooltipValue = "";

			// strdescript
			$archv_finished->strdescript->HrefValue = "";
			$archv_finished->strdescript->TooltipValue = "";

			// strarea
			$archv_finished->strarea->HrefValue = "";
			$archv_finished->strarea->TooltipValue = "";

			// strattach
			$archv_finished->strattach->HrefValue = "";
			$archv_finished->strattach->TooltipValue = "";

			// strpriority
			$archv_finished->strpriority->HrefValue = "";
			$archv_finished->strpriority->TooltipValue = "";

			// strduedate
			$archv_finished->strduedate->HrefValue = "";
			$archv_finished->strduedate->TooltipValue = "";

			// strstatus
			$archv_finished->strstatus->HrefValue = "";
			$archv_finished->strstatus->TooltipValue = "";

			// strlastedit
			$archv_finished->strlastedit->HrefValue = "";
			$archv_finished->strlastedit->TooltipValue = "";

			// strcategory
			$archv_finished->strcategory->HrefValue = "";
			$archv_finished->strcategory->TooltipValue = "";

			// strassigned
			$archv_finished->strassigned->HrefValue = "";
			$archv_finished->strassigned->TooltipValue = "";

			// strdatecomplete
			$archv_finished->strdatecomplete->HrefValue = "";
			$archv_finished->strdatecomplete->TooltipValue = "";

			// strwithpr
			$archv_finished->strwithpr->HrefValue = "";
			$archv_finished->strwithpr->TooltipValue = "";

			// strremarks
			$archv_finished->strremarks->HrefValue = "";
			$archv_finished->strremarks->TooltipValue = "";

			// sap_num
			$archv_finished->sap_num->HrefValue = "";
			$archv_finished->sap_num->TooltipValue = "";

			// work_days
			$archv_finished->work_days->HrefValue = "";
			$archv_finished->work_days->TooltipValue = "";
		} elseif ($archv_finished->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$archv_finished->ID->EditCustomAttributes = "";
			$archv_finished->ID->EditValue = ew_HtmlEncode($archv_finished->ID->AdvancedSearch->SearchValue);

			// strjrfnum
			$archv_finished->strjrfnum->EditCustomAttributes = "";
			$archv_finished->strjrfnum->EditValue = ew_HtmlEncode($archv_finished->strjrfnum->AdvancedSearch->SearchValue);

			// strquarter
			$archv_finished->strquarter->EditCustomAttributes = "";
			$archv_finished->strquarter->EditValue = ew_HtmlEncode($archv_finished->strquarter->AdvancedSearch->SearchValue);

			// strmon
			$archv_finished->strmon->EditCustomAttributes = "";
			$archv_finished->strmon->EditValue = ew_HtmlEncode($archv_finished->strmon->AdvancedSearch->SearchValue);

			// stryear
			$archv_finished->stryear->EditCustomAttributes = "";
			$archv_finished->stryear->EditValue = ew_HtmlEncode($archv_finished->stryear->AdvancedSearch->SearchValue);

			// strdate
			$archv_finished->strdate->EditCustomAttributes = "";
			$archv_finished->strdate->EditValue = ew_HtmlEncode($archv_finished->strdate->AdvancedSearch->SearchValue);

			// strtime
			$archv_finished->strtime->EditCustomAttributes = "";
			$archv_finished->strtime->EditValue = ew_HtmlEncode($archv_finished->strtime->AdvancedSearch->SearchValue);

			// strusername
			$archv_finished->strusername->EditCustomAttributes = "";
			$archv_finished->strusername->EditValue = ew_HtmlEncode($archv_finished->strusername->AdvancedSearch->SearchValue);

			// strusereadd
			$archv_finished->strusereadd->EditCustomAttributes = "";
			$archv_finished->strusereadd->EditValue = ew_HtmlEncode($archv_finished->strusereadd->AdvancedSearch->SearchValue);

			// strcompany
			$archv_finished->strcompany->EditCustomAttributes = "";
			$archv_finished->strcompany->EditValue = ew_HtmlEncode($archv_finished->strcompany->AdvancedSearch->SearchValue);

			// strdepartment
			$archv_finished->strdepartment->EditCustomAttributes = "";
			$archv_finished->strdepartment->EditValue = ew_HtmlEncode($archv_finished->strdepartment->AdvancedSearch->SearchValue);

			// strloc
			$archv_finished->strloc->EditCustomAttributes = "";
			$archv_finished->strloc->EditValue = ew_HtmlEncode($archv_finished->strloc->AdvancedSearch->SearchValue);

			// strposition
			$archv_finished->strposition->EditCustomAttributes = "";
			$archv_finished->strposition->EditValue = ew_HtmlEncode($archv_finished->strposition->AdvancedSearch->SearchValue);

			// strtelephone
			$archv_finished->strtelephone->EditCustomAttributes = "";
			$archv_finished->strtelephone->EditValue = ew_HtmlEncode($archv_finished->strtelephone->AdvancedSearch->SearchValue);

			// strcostcent
			$archv_finished->strcostcent->EditCustomAttributes = "";
			$archv_finished->strcostcent->EditValue = ew_HtmlEncode($archv_finished->strcostcent->AdvancedSearch->SearchValue);

			// strsubject
			$archv_finished->strsubject->EditCustomAttributes = "";
			$archv_finished->strsubject->EditValue = ew_HtmlEncode($archv_finished->strsubject->AdvancedSearch->SearchValue);

			// strnature
			$archv_finished->strnature->EditCustomAttributes = "";
			$archv_finished->strnature->EditValue = ew_HtmlEncode($archv_finished->strnature->AdvancedSearch->SearchValue);

			// strdescript
			$archv_finished->strdescript->EditCustomAttributes = "";
			$archv_finished->strdescript->EditValue = ew_HtmlEncode($archv_finished->strdescript->AdvancedSearch->SearchValue);

			// strarea
			$archv_finished->strarea->EditCustomAttributes = "";
			$archv_finished->strarea->EditValue = ew_HtmlEncode($archv_finished->strarea->AdvancedSearch->SearchValue);

			// strattach
			$archv_finished->strattach->EditCustomAttributes = "";
			$archv_finished->strattach->EditValue = ew_HtmlEncode($archv_finished->strattach->AdvancedSearch->SearchValue);

			// strpriority
			$archv_finished->strpriority->EditCustomAttributes = "";
			$archv_finished->strpriority->EditValue = ew_HtmlEncode($archv_finished->strpriority->AdvancedSearch->SearchValue);

			// strduedate
			$archv_finished->strduedate->EditCustomAttributes = "";
			$archv_finished->strduedate->EditValue = ew_HtmlEncode($archv_finished->strduedate->AdvancedSearch->SearchValue);

			// strstatus
			$archv_finished->strstatus->EditCustomAttributes = "";
			$archv_finished->strstatus->EditValue = ew_HtmlEncode($archv_finished->strstatus->AdvancedSearch->SearchValue);

			// strlastedit
			$archv_finished->strlastedit->EditCustomAttributes = "";
			$archv_finished->strlastedit->EditValue = ew_HtmlEncode($archv_finished->strlastedit->AdvancedSearch->SearchValue);

			// strcategory
			$archv_finished->strcategory->EditCustomAttributes = "";
			$archv_finished->strcategory->EditValue = ew_HtmlEncode($archv_finished->strcategory->AdvancedSearch->SearchValue);

			// strassigned
			$archv_finished->strassigned->EditCustomAttributes = "";
			$archv_finished->strassigned->EditValue = ew_HtmlEncode($archv_finished->strassigned->AdvancedSearch->SearchValue);

			// strdatecomplete
			$archv_finished->strdatecomplete->EditCustomAttributes = "";
			$archv_finished->strdatecomplete->EditValue = ew_HtmlEncode($archv_finished->strdatecomplete->AdvancedSearch->SearchValue);

			// strwithpr
			$archv_finished->strwithpr->EditCustomAttributes = "";
			$archv_finished->strwithpr->EditValue = ew_HtmlEncode($archv_finished->strwithpr->AdvancedSearch->SearchValue);

			// strremarks
			$archv_finished->strremarks->EditCustomAttributes = "";
			$archv_finished->strremarks->EditValue = ew_HtmlEncode($archv_finished->strremarks->AdvancedSearch->SearchValue);

			// sap_num
			$archv_finished->sap_num->EditCustomAttributes = "";
			$archv_finished->sap_num->EditValue = ew_HtmlEncode($archv_finished->sap_num->AdvancedSearch->SearchValue);

			// work_days
			$archv_finished->work_days->EditCustomAttributes = "";
			$archv_finished->work_days->EditValue = ew_HtmlEncode($archv_finished->work_days->AdvancedSearch->SearchValue);
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
		if (!ew_CheckInteger($archv_finished->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $archv_finished->ID->FldErrMsg();
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
