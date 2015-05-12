<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
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
$jrf_tbl_search = new cjrf_tbl_search();
$Page =& $jrf_tbl_search;

// Page init
$jrf_tbl_search->Page_Init();

// Page main
$jrf_tbl_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_search = new ew_Page("jrf_tbl_search");

// page properties
jrf_tbl_search.PageID = "search"; // page ID
jrf_tbl_search.FormID = "fjrf_tblsearch"; // form ID
var EW_PAGE_ID = jrf_tbl_search.PageID; // for backward compatibility

// extend page with validate function for search
jrf_tbl_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($jrf_tbl->ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_strmon"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($jrf_tbl->strmon->FldErrMsg()) ?>");

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
jrf_tbl_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
jrf_tbl_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $jrf_tbl->TableCaption() ?><br><br>
<a href="<?php echo $jrf_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_search->ShowMessage();
?>
<form name="fjrf_tblsearch" id="fjrf_tblsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return jrf_tbl_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="jrf_tbl">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $jrf_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->ID->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_ID" id="z_ID" value="="></span></td>
		<td<?php echo $jrf_tbl->ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ID" id="x_ID" title="<?php echo $jrf_tbl->ID->FldTitle() ?>" value="<?php echo $jrf_tbl->ID->EditValue ?>"<?php echo $jrf_tbl->ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strjrfnum->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strjrfnum->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strjrfnum->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strjrfnum" id="z_strjrfnum" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strjrfnum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strjrfnum" id="x_strjrfnum" title="<?php echo $jrf_tbl->strjrfnum->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strjrfnum->EditValue ?>"<?php echo $jrf_tbl->strjrfnum->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strquarter->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strquarter->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strquarter->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strquarter" id="z_strquarter" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strquarter->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strquarter" id="x_strquarter" title="<?php echo $jrf_tbl->strquarter->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strquarter->EditValue ?>"<?php echo $jrf_tbl->strquarter->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strmon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strmon->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strmon->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strmon" id="z_strmon" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strmon->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strmon" id="x_strmon" title="<?php echo $jrf_tbl->strmon->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strmon->EditValue ?>"<?php echo $jrf_tbl->strmon->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->stryear->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->stryear->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->stryear->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_stryear" id="z_stryear" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->stryear->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stryear" id="x_stryear" title="<?php echo $jrf_tbl->stryear->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $jrf_tbl->stryear->EditValue ?>"<?php echo $jrf_tbl->stryear->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strdate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdate" id="z_strdate" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strdate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdate" id="x_strdate" title="<?php echo $jrf_tbl->strdate->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strdate->EditValue ?>"<?php echo $jrf_tbl->strdate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strtime->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtime->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtime->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strtime" id="z_strtime" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strtime->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strtime" id="x_strtime" title="<?php echo $jrf_tbl->strtime->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $jrf_tbl->strtime->EditValue ?>"<?php echo $jrf_tbl->strtime->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strduedate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strduedate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strduedate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strduedate" id="z_strduedate" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strduedate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strduedate" id="x_strduedate" title="<?php echo $jrf_tbl->strduedate->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $jrf_tbl->strduedate->EditValue ?>"<?php echo $jrf_tbl->strduedate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strsubject->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strsubject->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strsubject->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strsubject" id="z_strsubject" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strsubject->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strsubject" id="x_strsubject" title="<?php echo $jrf_tbl->strsubject->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strsubject->EditAttributes() ?>><?php echo $jrf_tbl->strsubject->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strusername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusername->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusername->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strusername" id="z_strusername" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strusername->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strusername" id="x_strusername" title="<?php echo $jrf_tbl->strusername->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strusername->EditValue ?>"<?php echo $jrf_tbl->strusername->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strusereadd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusereadd->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusereadd->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strusereadd" id="z_strusereadd" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strusereadd->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strusereadd" id="x_strusereadd" title="<?php echo $jrf_tbl->strusereadd->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strusereadd->EditValue ?>"<?php echo $jrf_tbl->strusereadd->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strcompany->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcompany->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcompany->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strcompany" id="z_strcompany" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strcompany->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strcompany" id="x_strcompany" title="<?php echo $jrf_tbl->strcompany->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strcompany->EditValue ?>"<?php echo $jrf_tbl->strcompany->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strdepartment->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdepartment->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdepartment->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdepartment" id="z_strdepartment" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strdepartment->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdepartment" id="x_strdepartment" title="<?php echo $jrf_tbl->strdepartment->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strdepartment->EditValue ?>"<?php echo $jrf_tbl->strdepartment->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strloc->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strloc->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strloc->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strloc" id="z_strloc" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strloc->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strloc" id="x_strloc" title="<?php echo $jrf_tbl->strloc->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strloc->EditValue ?>"<?php echo $jrf_tbl->strloc->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strposition->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strposition->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strposition->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strposition" id="z_strposition" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strposition->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strposition" id="x_strposition" title="<?php echo $jrf_tbl->strposition->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strposition->EditValue ?>"<?php echo $jrf_tbl->strposition->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strtelephone->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtelephone->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtelephone->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strtelephone" id="z_strtelephone" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strtelephone->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strtelephone" id="x_strtelephone" title="<?php echo $jrf_tbl->strtelephone->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strtelephone->EditValue ?>"<?php echo $jrf_tbl->strtelephone->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strcostcent->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcostcent->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcostcent->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strcostcent" id="z_strcostcent" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strcostcent->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strcostcent" id="x_strcostcent" title="<?php echo $jrf_tbl->strcostcent->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strcostcent->EditValue ?>"<?php echo $jrf_tbl->strcostcent->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strnature->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strnature" id="z_strnature" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strnature->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strnature" id="x_strnature" title="<?php echo $jrf_tbl->strnature->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strnature->EditValue ?>"<?php echo $jrf_tbl->strnature->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strdescript->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdescript->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdescript->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdescript" id="z_strdescript" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strdescript->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strdescript" id="x_strdescript" title="<?php echo $jrf_tbl->strdescript->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strdescript->EditAttributes() ?>><?php echo $jrf_tbl->strdescript->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strattach->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strattach->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strattach->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strattach" id="z_strattach" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strattach->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strattach" id="x_strattach" title="<?php echo $jrf_tbl->strattach->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strattach->EditValue ?>"<?php echo $jrf_tbl->strattach->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strarea->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strarea->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strarea->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strarea" id="z_strarea" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strarea->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strarea" id="x_strarea" title="<?php echo $jrf_tbl->strarea->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strarea->EditValue ?>"<?php echo $jrf_tbl->strarea->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strpriority->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strpriority->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strpriority->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strpriority" id="z_strpriority" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strpriority->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strpriority" id="x_strpriority" title="<?php echo $jrf_tbl->strpriority->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strpriority->EditValue ?>"<?php echo $jrf_tbl->strpriority->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strstatus->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strstatus->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strstatus->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strstatus" id="z_strstatus" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strstatus->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strstatus" id="x_strstatus" title="<?php echo $jrf_tbl->strstatus->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strstatus->EditValue ?>"<?php echo $jrf_tbl->strstatus->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strlastedit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strlastedit->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strlastedit->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strlastedit" id="z_strlastedit" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strlastedit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strlastedit" id="x_strlastedit" title="<?php echo $jrf_tbl->strlastedit->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strlastedit->EditValue ?>"<?php echo $jrf_tbl->strlastedit->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcategory->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcategory->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strcategory" id="z_strcategory" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strcategory->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strcategory" id="x_strcategory" title="<?php echo $jrf_tbl->strcategory->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strcategory->EditValue ?>"<?php echo $jrf_tbl->strcategory->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strassigned->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strassigned->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strassigned->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strassigned" id="z_strassigned" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strassigned->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strassigned" id="x_strassigned" title="<?php echo $jrf_tbl->strassigned->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strassigned->EditValue ?>"<?php echo $jrf_tbl->strassigned->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strremarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strremarks" id="z_strremarks" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strremarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $jrf_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strremarks->EditAttributes() ?>><?php echo $jrf_tbl->strremarks->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strdatecomplete->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdatecomplete->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdatecomplete->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strdatecomplete" id="z_strdatecomplete" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strdatecomplete->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strdatecomplete" id="x_strdatecomplete" title="<?php echo $jrf_tbl->strdatecomplete->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strdatecomplete->EditValue ?>"<?php echo $jrf_tbl->strdatecomplete->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strifoverdue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strifoverdue->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strifoverdue->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strifoverdue" id="z_strifoverdue" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strifoverdue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strifoverdue" id="x_strifoverdue" title="<?php echo $jrf_tbl->strifoverdue->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $jrf_tbl->strifoverdue->EditValue ?>"<?php echo $jrf_tbl->strifoverdue->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->strwithpr->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strwithpr->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strwithpr->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_strwithpr" id="z_strwithpr" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->strwithpr->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_strwithpr" id="x_strwithpr" title="<?php echo $jrf_tbl->strwithpr->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $jrf_tbl->strwithpr->EditValue ?>"<?php echo $jrf_tbl->strwithpr->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $jrf_tbl->sap_num->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->sap_num->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->sap_num->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_sap_num" id="z_sap_num" value="LIKE"></span></td>
		<td<?php echo $jrf_tbl->sap_num->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_sap_num" id="x_sap_num" title="<?php echo $jrf_tbl->sap_num->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->sap_num->EditValue ?>"<?php echo $jrf_tbl->sap_num->EditAttributes() ?>>
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
$jrf_tbl_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_search';

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
	function cjrf_tbl_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'jrf_tbl', TRUE);

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
		global $jrf_tbl;

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
		global $objForm, $Language, $gsSearchError, $jrf_tbl;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$jrf_tbl->CurrentAction = $objForm->GetValue("a_search");
			switch ($jrf_tbl->CurrentAction) {
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
						$sSrchStr = $jrf_tbl->UrlParm($sSrchStr);
						$this->Page_Terminate("jrf_tbllist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$jrf_tbl->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $jrf_tbl;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->ID); // ID
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strjrfnum); // strjrfnum
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strquarter); // strquarter
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strmon); // strmon
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->stryear); // stryear
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strdate); // strdate
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strtime); // strtime
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strduedate); // strduedate
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strsubject); // strsubject
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strusername); // strusername
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strusereadd); // strusereadd
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strcompany); // strcompany
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strdepartment); // strdepartment
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strloc); // strloc
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strposition); // strposition
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strtelephone); // strtelephone
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strcostcent); // strcostcent
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strnature); // strnature
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strdescript); // strdescript
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strattach); // strattach
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strarea); // strarea
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strpriority); // strpriority
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strstatus); // strstatus
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strlastedit); // strlastedit
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strcategory); // strcategory
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strassigned); // strassigned
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strremarks); // strremarks
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strdatecomplete); // strdatecomplete
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strifoverdue); // strifoverdue
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->strwithpr); // strwithpr
	$this->BuildSearchUrl($sSrchUrl, $jrf_tbl->sap_num); // sap_num
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
		global $objForm, $jrf_tbl;

		// Load search values
		// ID

		$jrf_tbl->ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ID"));
		$jrf_tbl->ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ID");

		// strjrfnum
		$jrf_tbl->strjrfnum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strjrfnum"));
		$jrf_tbl->strjrfnum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strjrfnum");

		// strquarter
		$jrf_tbl->strquarter->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strquarter"));
		$jrf_tbl->strquarter->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strquarter");

		// strmon
		$jrf_tbl->strmon->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strmon"));
		$jrf_tbl->strmon->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strmon");

		// stryear
		$jrf_tbl->stryear->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stryear"));
		$jrf_tbl->stryear->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stryear");

		// strdate
		$jrf_tbl->strdate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdate"));
		$jrf_tbl->strdate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdate");

		// strtime
		$jrf_tbl->strtime->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strtime"));
		$jrf_tbl->strtime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strtime");

		// strduedate
		$jrf_tbl->strduedate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strduedate"));
		$jrf_tbl->strduedate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strduedate");

		// strsubject
		$jrf_tbl->strsubject->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strsubject"));
		$jrf_tbl->strsubject->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strsubject");

		// strusername
		$jrf_tbl->strusername->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strusername"));
		$jrf_tbl->strusername->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strusername");

		// strusereadd
		$jrf_tbl->strusereadd->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strusereadd"));
		$jrf_tbl->strusereadd->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strusereadd");

		// strcompany
		$jrf_tbl->strcompany->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcompany"));
		$jrf_tbl->strcompany->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcompany");

		// strdepartment
		$jrf_tbl->strdepartment->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdepartment"));
		$jrf_tbl->strdepartment->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdepartment");

		// strloc
		$jrf_tbl->strloc->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strloc"));
		$jrf_tbl->strloc->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strloc");

		// strposition
		$jrf_tbl->strposition->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strposition"));
		$jrf_tbl->strposition->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strposition");

		// strtelephone
		$jrf_tbl->strtelephone->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strtelephone"));
		$jrf_tbl->strtelephone->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strtelephone");

		// strcostcent
		$jrf_tbl->strcostcent->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcostcent"));
		$jrf_tbl->strcostcent->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcostcent");

		// strnature
		$jrf_tbl->strnature->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strnature"));
		$jrf_tbl->strnature->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strnature");

		// strdescript
		$jrf_tbl->strdescript->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdescript"));
		$jrf_tbl->strdescript->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdescript");

		// strattach
		$jrf_tbl->strattach->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strattach"));
		$jrf_tbl->strattach->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strattach");

		// strarea
		$jrf_tbl->strarea->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strarea"));
		$jrf_tbl->strarea->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strarea");

		// strpriority
		$jrf_tbl->strpriority->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strpriority"));
		$jrf_tbl->strpriority->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strpriority");

		// strstatus
		$jrf_tbl->strstatus->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strstatus"));
		$jrf_tbl->strstatus->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strstatus");

		// strlastedit
		$jrf_tbl->strlastedit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strlastedit"));
		$jrf_tbl->strlastedit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strlastedit");

		// strcategory
		$jrf_tbl->strcategory->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strcategory"));
		$jrf_tbl->strcategory->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strcategory");

		// strassigned
		$jrf_tbl->strassigned->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strassigned"));
		$jrf_tbl->strassigned->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strassigned");

		// strremarks
		$jrf_tbl->strremarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strremarks"));
		$jrf_tbl->strremarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strremarks");

		// strdatecomplete
		$jrf_tbl->strdatecomplete->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strdatecomplete"));
		$jrf_tbl->strdatecomplete->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strdatecomplete");

		// strifoverdue
		$jrf_tbl->strifoverdue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strifoverdue"));
		$jrf_tbl->strifoverdue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strifoverdue");

		// strwithpr
		$jrf_tbl->strwithpr->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_strwithpr"));
		$jrf_tbl->strwithpr->AdvancedSearch->SearchOperator = $objForm->GetValue("z_strwithpr");

		// sap_num
		$jrf_tbl->sap_num->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sap_num"));
		$jrf_tbl->sap_num->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sap_num");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $jrf_tbl;

		// Initialize URLs
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

			// strquarter
			$jrf_tbl->strquarter->HrefValue = "";
			$jrf_tbl->strquarter->TooltipValue = "";

			// strmon
			$jrf_tbl->strmon->HrefValue = "";
			$jrf_tbl->strmon->TooltipValue = "";

			// stryear
			$jrf_tbl->stryear->HrefValue = "";
			$jrf_tbl->stryear->TooltipValue = "";

			// strdate
			$jrf_tbl->strdate->HrefValue = "";
			$jrf_tbl->strdate->TooltipValue = "";

			// strtime
			$jrf_tbl->strtime->HrefValue = "";
			$jrf_tbl->strtime->TooltipValue = "";

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";
			$jrf_tbl->strduedate->TooltipValue = "";

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";
			$jrf_tbl->strsubject->TooltipValue = "";

			// strusername
			$jrf_tbl->strusername->HrefValue = "";
			$jrf_tbl->strusername->TooltipValue = "";

			// strusereadd
			$jrf_tbl->strusereadd->HrefValue = "";
			$jrf_tbl->strusereadd->TooltipValue = "";

			// strcompany
			$jrf_tbl->strcompany->HrefValue = "";
			$jrf_tbl->strcompany->TooltipValue = "";

			// strdepartment
			$jrf_tbl->strdepartment->HrefValue = "";
			$jrf_tbl->strdepartment->TooltipValue = "";

			// strloc
			$jrf_tbl->strloc->HrefValue = "";
			$jrf_tbl->strloc->TooltipValue = "";

			// strposition
			$jrf_tbl->strposition->HrefValue = "";
			$jrf_tbl->strposition->TooltipValue = "";

			// strtelephone
			$jrf_tbl->strtelephone->HrefValue = "";
			$jrf_tbl->strtelephone->TooltipValue = "";

			// strcostcent
			$jrf_tbl->strcostcent->HrefValue = "";
			$jrf_tbl->strcostcent->TooltipValue = "";

			// strnature
			$jrf_tbl->strnature->HrefValue = "";
			$jrf_tbl->strnature->TooltipValue = "";

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";
			$jrf_tbl->strdescript->TooltipValue = "";

			// strattach
			$jrf_tbl->strattach->HrefValue = "";
			$jrf_tbl->strattach->TooltipValue = "";

			// strarea
			$jrf_tbl->strarea->HrefValue = "";
			$jrf_tbl->strarea->TooltipValue = "";

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";
			$jrf_tbl->strpriority->TooltipValue = "";

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";
			$jrf_tbl->strstatus->TooltipValue = "";

			// strlastedit
			$jrf_tbl->strlastedit->HrefValue = "";
			$jrf_tbl->strlastedit->TooltipValue = "";

			// strcategory
			$jrf_tbl->strcategory->HrefValue = "";
			$jrf_tbl->strcategory->TooltipValue = "";

			// strassigned
			$jrf_tbl->strassigned->HrefValue = "";
			$jrf_tbl->strassigned->TooltipValue = "";

			// strremarks
			$jrf_tbl->strremarks->HrefValue = "";
			$jrf_tbl->strremarks->TooltipValue = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->HrefValue = "";
			$jrf_tbl->strdatecomplete->TooltipValue = "";

			// strifoverdue
			$jrf_tbl->strifoverdue->HrefValue = "";
			$jrf_tbl->strifoverdue->TooltipValue = "";

			// strwithpr
			$jrf_tbl->strwithpr->HrefValue = "";
			$jrf_tbl->strwithpr->TooltipValue = "";

			// sap_num
			$jrf_tbl->sap_num->HrefValue = "";
			$jrf_tbl->sap_num->TooltipValue = "";
		} elseif ($jrf_tbl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// ID
			$jrf_tbl->ID->EditCustomAttributes = "";
			$jrf_tbl->ID->EditValue = ew_HtmlEncode($jrf_tbl->ID->AdvancedSearch->SearchValue);

			// strjrfnum
			$jrf_tbl->strjrfnum->EditCustomAttributes = "";
			$jrf_tbl->strjrfnum->EditValue = ew_HtmlEncode($jrf_tbl->strjrfnum->AdvancedSearch->SearchValue);

			// strquarter
			$jrf_tbl->strquarter->EditCustomAttributes = "";
			$jrf_tbl->strquarter->EditValue = ew_HtmlEncode($jrf_tbl->strquarter->AdvancedSearch->SearchValue);

			// strmon
			$jrf_tbl->strmon->EditCustomAttributes = "";
			$jrf_tbl->strmon->EditValue = ew_HtmlEncode($jrf_tbl->strmon->AdvancedSearch->SearchValue);

			// stryear
			$jrf_tbl->stryear->EditCustomAttributes = "";
			$jrf_tbl->stryear->EditValue = ew_HtmlEncode($jrf_tbl->stryear->AdvancedSearch->SearchValue);

			// strdate
			$jrf_tbl->strdate->EditCustomAttributes = "";
			$jrf_tbl->strdate->EditValue = ew_HtmlEncode($jrf_tbl->strdate->AdvancedSearch->SearchValue);

			// strtime
			$jrf_tbl->strtime->EditCustomAttributes = "";
			$jrf_tbl->strtime->EditValue = ew_HtmlEncode($jrf_tbl->strtime->AdvancedSearch->SearchValue);

			// strduedate
			$jrf_tbl->strduedate->EditCustomAttributes = "";
			$jrf_tbl->strduedate->EditValue = ew_HtmlEncode($jrf_tbl->strduedate->AdvancedSearch->SearchValue);

			// strsubject
			$jrf_tbl->strsubject->EditCustomAttributes = "";
			$jrf_tbl->strsubject->EditValue = ew_HtmlEncode($jrf_tbl->strsubject->AdvancedSearch->SearchValue);

			// strusername
			$jrf_tbl->strusername->EditCustomAttributes = "";
			$jrf_tbl->strusername->EditValue = ew_HtmlEncode($jrf_tbl->strusername->AdvancedSearch->SearchValue);

			// strusereadd
			$jrf_tbl->strusereadd->EditCustomAttributes = "";
			$jrf_tbl->strusereadd->EditValue = ew_HtmlEncode($jrf_tbl->strusereadd->AdvancedSearch->SearchValue);

			// strcompany
			$jrf_tbl->strcompany->EditCustomAttributes = "";
			$jrf_tbl->strcompany->EditValue = ew_HtmlEncode($jrf_tbl->strcompany->AdvancedSearch->SearchValue);

			// strdepartment
			$jrf_tbl->strdepartment->EditCustomAttributes = "";
			$jrf_tbl->strdepartment->EditValue = ew_HtmlEncode($jrf_tbl->strdepartment->AdvancedSearch->SearchValue);

			// strloc
			$jrf_tbl->strloc->EditCustomAttributes = "";
			$jrf_tbl->strloc->EditValue = ew_HtmlEncode($jrf_tbl->strloc->AdvancedSearch->SearchValue);

			// strposition
			$jrf_tbl->strposition->EditCustomAttributes = "";
			$jrf_tbl->strposition->EditValue = ew_HtmlEncode($jrf_tbl->strposition->AdvancedSearch->SearchValue);

			// strtelephone
			$jrf_tbl->strtelephone->EditCustomAttributes = "";
			$jrf_tbl->strtelephone->EditValue = ew_HtmlEncode($jrf_tbl->strtelephone->AdvancedSearch->SearchValue);

			// strcostcent
			$jrf_tbl->strcostcent->EditCustomAttributes = "";
			$jrf_tbl->strcostcent->EditValue = ew_HtmlEncode($jrf_tbl->strcostcent->AdvancedSearch->SearchValue);

			// strnature
			$jrf_tbl->strnature->EditCustomAttributes = "";
			$jrf_tbl->strnature->EditValue = ew_HtmlEncode($jrf_tbl->strnature->AdvancedSearch->SearchValue);

			// strdescript
			$jrf_tbl->strdescript->EditCustomAttributes = "";
			$jrf_tbl->strdescript->EditValue = ew_HtmlEncode($jrf_tbl->strdescript->AdvancedSearch->SearchValue);

			// strattach
			$jrf_tbl->strattach->EditCustomAttributes = "";
			$jrf_tbl->strattach->EditValue = ew_HtmlEncode($jrf_tbl->strattach->AdvancedSearch->SearchValue);

			// strarea
			$jrf_tbl->strarea->EditCustomAttributes = "";
			$jrf_tbl->strarea->EditValue = ew_HtmlEncode($jrf_tbl->strarea->AdvancedSearch->SearchValue);

			// strpriority
			$jrf_tbl->strpriority->EditCustomAttributes = "";
			$jrf_tbl->strpriority->EditValue = ew_HtmlEncode($jrf_tbl->strpriority->AdvancedSearch->SearchValue);

			// strstatus
			$jrf_tbl->strstatus->EditCustomAttributes = "";
			$jrf_tbl->strstatus->EditValue = ew_HtmlEncode($jrf_tbl->strstatus->AdvancedSearch->SearchValue);

			// strlastedit
			$jrf_tbl->strlastedit->EditCustomAttributes = "";
			$jrf_tbl->strlastedit->EditValue = ew_HtmlEncode($jrf_tbl->strlastedit->AdvancedSearch->SearchValue);

			// strcategory
			$jrf_tbl->strcategory->EditCustomAttributes = "";
			$jrf_tbl->strcategory->EditValue = ew_HtmlEncode($jrf_tbl->strcategory->AdvancedSearch->SearchValue);

			// strassigned
			$jrf_tbl->strassigned->EditCustomAttributes = "";
			$jrf_tbl->strassigned->EditValue = ew_HtmlEncode($jrf_tbl->strassigned->AdvancedSearch->SearchValue);

			// strremarks
			$jrf_tbl->strremarks->EditCustomAttributes = "";
			$jrf_tbl->strremarks->EditValue = ew_HtmlEncode($jrf_tbl->strremarks->AdvancedSearch->SearchValue);

			// strdatecomplete
			$jrf_tbl->strdatecomplete->EditCustomAttributes = "";
			$jrf_tbl->strdatecomplete->EditValue = ew_HtmlEncode($jrf_tbl->strdatecomplete->AdvancedSearch->SearchValue);

			// strifoverdue
			$jrf_tbl->strifoverdue->EditCustomAttributes = "";
			$jrf_tbl->strifoverdue->EditValue = ew_HtmlEncode($jrf_tbl->strifoverdue->AdvancedSearch->SearchValue);

			// strwithpr
			$jrf_tbl->strwithpr->EditCustomAttributes = "";
			$jrf_tbl->strwithpr->EditValue = ew_HtmlEncode($jrf_tbl->strwithpr->AdvancedSearch->SearchValue);

			// sap_num
			$jrf_tbl->sap_num->EditCustomAttributes = "";
			$jrf_tbl->sap_num->EditValue = ew_HtmlEncode($jrf_tbl->sap_num->AdvancedSearch->SearchValue);
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
		if (!ew_CheckInteger($jrf_tbl->ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $jrf_tbl->ID->FldErrMsg();
		}
		if (!ew_CheckInteger($jrf_tbl->strmon->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $jrf_tbl->strmon->FldErrMsg();
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
