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
$jrf_tbl_edit = new cjrf_tbl_edit();
$Page =& $jrf_tbl_edit;

// Page init
$jrf_tbl_edit->Page_Init();

// Page main
$jrf_tbl_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_edit = new ew_Page("jrf_tbl_edit");

// page properties
jrf_tbl_edit.PageID = "edit"; // page ID
jrf_tbl_edit.FormID = "fjrf_tbledit"; // form ID
var EW_PAGE_ID = jrf_tbl_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
jrf_tbl_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_strmon"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($jrf_tbl->strmon->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
jrf_tbl_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
jrf_tbl_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $jrf_tbl->TableCaption() ?><br><br>
<a href="<?php echo $jrf_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_edit->ShowMessage();
?>
<form name="fjrf_tbledit" id="fjrf_tbledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return jrf_tbl_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="jrf_tbl">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($jrf_tbl->ID->Visible) { // ID ?>
	<tr<?php echo $jrf_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->ID->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->ID->CellAttributes() ?>><span id="el_ID">
<div<?php echo $jrf_tbl->ID->ViewAttributes() ?>><?php echo $jrf_tbl->ID->EditValue ?></div><input type="hidden" name="x_ID" id="x_ID" value="<?php echo ew_HtmlEncode($jrf_tbl->ID->CurrentValue) ?>">
</span><?php echo $jrf_tbl->ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strjrfnum->Visible) { // strjrfnum ?>
	<tr<?php echo $jrf_tbl->strjrfnum->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strjrfnum->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strjrfnum->CellAttributes() ?>><span id="el_strjrfnum">
<input type="text" name="x_strjrfnum" id="x_strjrfnum" title="<?php echo $jrf_tbl->strjrfnum->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strjrfnum->EditValue ?>"<?php echo $jrf_tbl->strjrfnum->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strjrfnum->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strquarter->Visible) { // strquarter ?>
	<tr<?php echo $jrf_tbl->strquarter->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strquarter->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strquarter->CellAttributes() ?>><span id="el_strquarter">
<input type="text" name="x_strquarter" id="x_strquarter" title="<?php echo $jrf_tbl->strquarter->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strquarter->EditValue ?>"<?php echo $jrf_tbl->strquarter->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strquarter->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strmon->Visible) { // strmon ?>
	<tr<?php echo $jrf_tbl->strmon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strmon->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strmon->CellAttributes() ?>><span id="el_strmon">
<input type="text" name="x_strmon" id="x_strmon" title="<?php echo $jrf_tbl->strmon->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strmon->EditValue ?>"<?php echo $jrf_tbl->strmon->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strmon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->stryear->Visible) { // stryear ?>
	<tr<?php echo $jrf_tbl->stryear->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->stryear->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->stryear->CellAttributes() ?>><span id="el_stryear">
<input type="text" name="x_stryear" id="x_stryear" title="<?php echo $jrf_tbl->stryear->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $jrf_tbl->stryear->EditValue ?>"<?php echo $jrf_tbl->stryear->EditAttributes() ?>>
</span><?php echo $jrf_tbl->stryear->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdate->Visible) { // strdate ?>
	<tr<?php echo $jrf_tbl->strdate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdate->CellAttributes() ?>><span id="el_strdate">
<input type="text" name="x_strdate" id="x_strdate" title="<?php echo $jrf_tbl->strdate->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strdate->EditValue ?>"<?php echo $jrf_tbl->strdate->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strdate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strtime->Visible) { // strtime ?>
	<tr<?php echo $jrf_tbl->strtime->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtime->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtime->CellAttributes() ?>><span id="el_strtime">
<input type="text" name="x_strtime" id="x_strtime" title="<?php echo $jrf_tbl->strtime->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $jrf_tbl->strtime->EditValue ?>"<?php echo $jrf_tbl->strtime->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strtime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strduedate->Visible) { // strduedate ?>
	<tr<?php echo $jrf_tbl->strduedate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strduedate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strduedate->CellAttributes() ?>><span id="el_strduedate">
<input type="text" name="x_strduedate" id="x_strduedate" title="<?php echo $jrf_tbl->strduedate->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $jrf_tbl->strduedate->EditValue ?>"<?php echo $jrf_tbl->strduedate->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strduedate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strsubject->Visible) { // strsubject ?>
	<tr<?php echo $jrf_tbl->strsubject->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strsubject->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strsubject->CellAttributes() ?>><span id="el_strsubject">
<textarea name="x_strsubject" id="x_strsubject" title="<?php echo $jrf_tbl->strsubject->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strsubject->EditAttributes() ?>><?php echo $jrf_tbl->strsubject->EditValue ?></textarea>
</span><?php echo $jrf_tbl->strsubject->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strusername->Visible) { // strusername ?>
	<tr<?php echo $jrf_tbl->strusername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusername->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusername->CellAttributes() ?>><span id="el_strusername">
<input type="text" name="x_strusername" id="x_strusername" title="<?php echo $jrf_tbl->strusername->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strusername->EditValue ?>"<?php echo $jrf_tbl->strusername->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strusername->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strusereadd->Visible) { // strusereadd ?>
	<tr<?php echo $jrf_tbl->strusereadd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusereadd->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusereadd->CellAttributes() ?>><span id="el_strusereadd">
<input type="text" name="x_strusereadd" id="x_strusereadd" title="<?php echo $jrf_tbl->strusereadd->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strusereadd->EditValue ?>"<?php echo $jrf_tbl->strusereadd->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strusereadd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcompany->Visible) { // strcompany ?>
	<tr<?php echo $jrf_tbl->strcompany->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcompany->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcompany->CellAttributes() ?>><span id="el_strcompany">
<input type="text" name="x_strcompany" id="x_strcompany" title="<?php echo $jrf_tbl->strcompany->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strcompany->EditValue ?>"<?php echo $jrf_tbl->strcompany->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strcompany->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdepartment->Visible) { // strdepartment ?>
	<tr<?php echo $jrf_tbl->strdepartment->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdepartment->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdepartment->CellAttributes() ?>><span id="el_strdepartment">
<input type="text" name="x_strdepartment" id="x_strdepartment" title="<?php echo $jrf_tbl->strdepartment->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strdepartment->EditValue ?>"<?php echo $jrf_tbl->strdepartment->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strdepartment->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strloc->Visible) { // strloc ?>
	<tr<?php echo $jrf_tbl->strloc->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strloc->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strloc->CellAttributes() ?>><span id="el_strloc">
<input type="text" name="x_strloc" id="x_strloc" title="<?php echo $jrf_tbl->strloc->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strloc->EditValue ?>"<?php echo $jrf_tbl->strloc->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strloc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strposition->Visible) { // strposition ?>
	<tr<?php echo $jrf_tbl->strposition->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strposition->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strposition->CellAttributes() ?>><span id="el_strposition">
<input type="text" name="x_strposition" id="x_strposition" title="<?php echo $jrf_tbl->strposition->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strposition->EditValue ?>"<?php echo $jrf_tbl->strposition->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strposition->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strtelephone->Visible) { // strtelephone ?>
	<tr<?php echo $jrf_tbl->strtelephone->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtelephone->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtelephone->CellAttributes() ?>><span id="el_strtelephone">
<input type="text" name="x_strtelephone" id="x_strtelephone" title="<?php echo $jrf_tbl->strtelephone->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strtelephone->EditValue ?>"<?php echo $jrf_tbl->strtelephone->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strtelephone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcostcent->Visible) { // strcostcent ?>
	<tr<?php echo $jrf_tbl->strcostcent->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcostcent->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcostcent->CellAttributes() ?>><span id="el_strcostcent">
<input type="text" name="x_strcostcent" id="x_strcostcent" title="<?php echo $jrf_tbl->strcostcent->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strcostcent->EditValue ?>"<?php echo $jrf_tbl->strcostcent->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strcostcent->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strnature->Visible) { // strnature ?>
	<tr<?php echo $jrf_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strnature->CellAttributes() ?>><span id="el_strnature">
<input type="text" name="x_strnature" id="x_strnature" title="<?php echo $jrf_tbl->strnature->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strnature->EditValue ?>"<?php echo $jrf_tbl->strnature->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strnature->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdescript->Visible) { // strdescript ?>
	<tr<?php echo $jrf_tbl->strdescript->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdescript->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdescript->CellAttributes() ?>><span id="el_strdescript">
<textarea name="x_strdescript" id="x_strdescript" title="<?php echo $jrf_tbl->strdescript->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strdescript->EditAttributes() ?>><?php echo $jrf_tbl->strdescript->EditValue ?></textarea>
</span><?php echo $jrf_tbl->strdescript->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strattach->Visible) { // strattach ?>
	<tr<?php echo $jrf_tbl->strattach->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strattach->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strattach->CellAttributes() ?>><span id="el_strattach">
<input type="text" name="x_strattach" id="x_strattach" title="<?php echo $jrf_tbl->strattach->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strattach->EditValue ?>"<?php echo $jrf_tbl->strattach->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strattach->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strarea->Visible) { // strarea ?>
	<tr<?php echo $jrf_tbl->strarea->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strarea->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strarea->CellAttributes() ?>><span id="el_strarea">
<input type="text" name="x_strarea" id="x_strarea" title="<?php echo $jrf_tbl->strarea->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strarea->EditValue ?>"<?php echo $jrf_tbl->strarea->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strarea->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strpriority->Visible) { // strpriority ?>
	<tr<?php echo $jrf_tbl->strpriority->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strpriority->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strpriority->CellAttributes() ?>><span id="el_strpriority">
<input type="text" name="x_strpriority" id="x_strpriority" title="<?php echo $jrf_tbl->strpriority->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->strpriority->EditValue ?>"<?php echo $jrf_tbl->strpriority->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strpriority->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strstatus->Visible) { // strstatus ?>
	<tr<?php echo $jrf_tbl->strstatus->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strstatus->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strstatus->CellAttributes() ?>><span id="el_strstatus">
<input type="text" name="x_strstatus" id="x_strstatus" title="<?php echo $jrf_tbl->strstatus->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $jrf_tbl->strstatus->EditValue ?>"<?php echo $jrf_tbl->strstatus->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strstatus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strlastedit->Visible) { // strlastedit ?>
	<tr<?php echo $jrf_tbl->strlastedit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strlastedit->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strlastedit->CellAttributes() ?>><span id="el_strlastedit">
<input type="text" name="x_strlastedit" id="x_strlastedit" title="<?php echo $jrf_tbl->strlastedit->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strlastedit->EditValue ?>"<?php echo $jrf_tbl->strlastedit->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strlastedit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcategory->Visible) { // strcategory ?>
	<tr<?php echo $jrf_tbl->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcategory->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcategory->CellAttributes() ?>><span id="el_strcategory">
<input type="text" name="x_strcategory" id="x_strcategory" title="<?php echo $jrf_tbl->strcategory->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strcategory->EditValue ?>"<?php echo $jrf_tbl->strcategory->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strcategory->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strassigned->Visible) { // strassigned ?>
	<tr<?php echo $jrf_tbl->strassigned->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strassigned->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strassigned->CellAttributes() ?>><span id="el_strassigned">
<input type="text" name="x_strassigned" id="x_strassigned" title="<?php echo $jrf_tbl->strassigned->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $jrf_tbl->strassigned->EditValue ?>"<?php echo $jrf_tbl->strassigned->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strassigned->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $jrf_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strremarks->CellAttributes() ?>><span id="el_strremarks">
<textarea name="x_strremarks" id="x_strremarks" title="<?php echo $jrf_tbl->strremarks->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strremarks->EditAttributes() ?>><?php echo $jrf_tbl->strremarks->EditValue ?></textarea>
</span><?php echo $jrf_tbl->strremarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdatecomplete->Visible) { // strdatecomplete ?>
	<tr<?php echo $jrf_tbl->strdatecomplete->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdatecomplete->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdatecomplete->CellAttributes() ?>><span id="el_strdatecomplete">
<input type="text" name="x_strdatecomplete" id="x_strdatecomplete" title="<?php echo $jrf_tbl->strdatecomplete->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $jrf_tbl->strdatecomplete->EditValue ?>"<?php echo $jrf_tbl->strdatecomplete->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strdatecomplete->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strifoverdue->Visible) { // strifoverdue ?>
	<tr<?php echo $jrf_tbl->strifoverdue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strifoverdue->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strifoverdue->CellAttributes() ?>><span id="el_strifoverdue">
<input type="text" name="x_strifoverdue" id="x_strifoverdue" title="<?php echo $jrf_tbl->strifoverdue->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $jrf_tbl->strifoverdue->EditValue ?>"<?php echo $jrf_tbl->strifoverdue->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strifoverdue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strwithpr->Visible) { // strwithpr ?>
	<tr<?php echo $jrf_tbl->strwithpr->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strwithpr->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strwithpr->CellAttributes() ?>><span id="el_strwithpr">
<input type="text" name="x_strwithpr" id="x_strwithpr" title="<?php echo $jrf_tbl->strwithpr->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $jrf_tbl->strwithpr->EditValue ?>"<?php echo $jrf_tbl->strwithpr->EditAttributes() ?>>
</span><?php echo $jrf_tbl->strwithpr->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->sap_num->Visible) { // sap_num ?>
	<tr<?php echo $jrf_tbl->sap_num->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->sap_num->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->sap_num->CellAttributes() ?>><span id="el_sap_num">
<input type="text" name="x_sap_num" id="x_sap_num" title="<?php echo $jrf_tbl->sap_num->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $jrf_tbl->sap_num->EditValue ?>"<?php echo $jrf_tbl->sap_num->EditAttributes() ?>>
</span><?php echo $jrf_tbl->sap_num->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$jrf_tbl_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_edit';

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
	function cjrf_tbl_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $jrf_tbl;

		// Load key from QueryString
		if (@$_GET["ID"] <> "")
			$jrf_tbl->ID->setQueryStringValue($_GET["ID"]);
		if (@$_POST["a_edit"] <> "") {
			$jrf_tbl->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$jrf_tbl->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$jrf_tbl->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$jrf_tbl->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($jrf_tbl->ID->CurrentValue == "")
			$this->Page_Terminate("jrf_tbllist.php"); // Invalid key, return to list
		switch ($jrf_tbl->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("jrf_tbllist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$jrf_tbl->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $jrf_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$jrf_tbl->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$jrf_tbl->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $jrf_tbl;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $jrf_tbl;
		$jrf_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
		$jrf_tbl->strjrfnum->setFormValue($objForm->GetValue("x_strjrfnum"));
		$jrf_tbl->strquarter->setFormValue($objForm->GetValue("x_strquarter"));
		$jrf_tbl->strmon->setFormValue($objForm->GetValue("x_strmon"));
		$jrf_tbl->stryear->setFormValue($objForm->GetValue("x_stryear"));
		$jrf_tbl->strdate->setFormValue($objForm->GetValue("x_strdate"));
		$jrf_tbl->strtime->setFormValue($objForm->GetValue("x_strtime"));
		$jrf_tbl->strduedate->setFormValue($objForm->GetValue("x_strduedate"));
		$jrf_tbl->strsubject->setFormValue($objForm->GetValue("x_strsubject"));
		$jrf_tbl->strusername->setFormValue($objForm->GetValue("x_strusername"));
		$jrf_tbl->strusereadd->setFormValue($objForm->GetValue("x_strusereadd"));
		$jrf_tbl->strcompany->setFormValue($objForm->GetValue("x_strcompany"));
		$jrf_tbl->strdepartment->setFormValue($objForm->GetValue("x_strdepartment"));
		$jrf_tbl->strloc->setFormValue($objForm->GetValue("x_strloc"));
		$jrf_tbl->strposition->setFormValue($objForm->GetValue("x_strposition"));
		$jrf_tbl->strtelephone->setFormValue($objForm->GetValue("x_strtelephone"));
		$jrf_tbl->strcostcent->setFormValue($objForm->GetValue("x_strcostcent"));
		$jrf_tbl->strnature->setFormValue($objForm->GetValue("x_strnature"));
		$jrf_tbl->strdescript->setFormValue($objForm->GetValue("x_strdescript"));
		$jrf_tbl->strattach->setFormValue($objForm->GetValue("x_strattach"));
		$jrf_tbl->strarea->setFormValue($objForm->GetValue("x_strarea"));
		$jrf_tbl->strpriority->setFormValue($objForm->GetValue("x_strpriority"));
		$jrf_tbl->strstatus->setFormValue($objForm->GetValue("x_strstatus"));
		$jrf_tbl->strlastedit->setFormValue($objForm->GetValue("x_strlastedit"));
		$jrf_tbl->strcategory->setFormValue($objForm->GetValue("x_strcategory"));
		$jrf_tbl->strassigned->setFormValue($objForm->GetValue("x_strassigned"));
		$jrf_tbl->strremarks->setFormValue($objForm->GetValue("x_strremarks"));
		$jrf_tbl->strdatecomplete->setFormValue($objForm->GetValue("x_strdatecomplete"));
		$jrf_tbl->strifoverdue->setFormValue($objForm->GetValue("x_strifoverdue"));
		$jrf_tbl->strwithpr->setFormValue($objForm->GetValue("x_strwithpr"));
		$jrf_tbl->sap_num->setFormValue($objForm->GetValue("x_sap_num"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $jrf_tbl;
		$this->LoadRow();
		$jrf_tbl->ID->CurrentValue = $jrf_tbl->ID->FormValue;
		$jrf_tbl->strjrfnum->CurrentValue = $jrf_tbl->strjrfnum->FormValue;
		$jrf_tbl->strquarter->CurrentValue = $jrf_tbl->strquarter->FormValue;
		$jrf_tbl->strmon->CurrentValue = $jrf_tbl->strmon->FormValue;
		$jrf_tbl->stryear->CurrentValue = $jrf_tbl->stryear->FormValue;
		$jrf_tbl->strdate->CurrentValue = $jrf_tbl->strdate->FormValue;
		$jrf_tbl->strtime->CurrentValue = $jrf_tbl->strtime->FormValue;
		$jrf_tbl->strduedate->CurrentValue = $jrf_tbl->strduedate->FormValue;
		$jrf_tbl->strsubject->CurrentValue = $jrf_tbl->strsubject->FormValue;
		$jrf_tbl->strusername->CurrentValue = $jrf_tbl->strusername->FormValue;
		$jrf_tbl->strusereadd->CurrentValue = $jrf_tbl->strusereadd->FormValue;
		$jrf_tbl->strcompany->CurrentValue = $jrf_tbl->strcompany->FormValue;
		$jrf_tbl->strdepartment->CurrentValue = $jrf_tbl->strdepartment->FormValue;
		$jrf_tbl->strloc->CurrentValue = $jrf_tbl->strloc->FormValue;
		$jrf_tbl->strposition->CurrentValue = $jrf_tbl->strposition->FormValue;
		$jrf_tbl->strtelephone->CurrentValue = $jrf_tbl->strtelephone->FormValue;
		$jrf_tbl->strcostcent->CurrentValue = $jrf_tbl->strcostcent->FormValue;
		$jrf_tbl->strnature->CurrentValue = $jrf_tbl->strnature->FormValue;
		$jrf_tbl->strdescript->CurrentValue = $jrf_tbl->strdescript->FormValue;
		$jrf_tbl->strattach->CurrentValue = $jrf_tbl->strattach->FormValue;
		$jrf_tbl->strarea->CurrentValue = $jrf_tbl->strarea->FormValue;
		$jrf_tbl->strpriority->CurrentValue = $jrf_tbl->strpriority->FormValue;
		$jrf_tbl->strstatus->CurrentValue = $jrf_tbl->strstatus->FormValue;
		$jrf_tbl->strlastedit->CurrentValue = $jrf_tbl->strlastedit->FormValue;
		$jrf_tbl->strcategory->CurrentValue = $jrf_tbl->strcategory->FormValue;
		$jrf_tbl->strassigned->CurrentValue = $jrf_tbl->strassigned->FormValue;
		$jrf_tbl->strremarks->CurrentValue = $jrf_tbl->strremarks->FormValue;
		$jrf_tbl->strdatecomplete->CurrentValue = $jrf_tbl->strdatecomplete->FormValue;
		$jrf_tbl->strifoverdue->CurrentValue = $jrf_tbl->strifoverdue->FormValue;
		$jrf_tbl->strwithpr->CurrentValue = $jrf_tbl->strwithpr->FormValue;
		$jrf_tbl->sap_num->CurrentValue = $jrf_tbl->sap_num->FormValue;
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
		} elseif ($jrf_tbl->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ID
			$jrf_tbl->ID->EditCustomAttributes = "";
			$jrf_tbl->ID->EditValue = $jrf_tbl->ID->CurrentValue;
			$jrf_tbl->ID->CssStyle = "";
			$jrf_tbl->ID->CssClass = "";
			$jrf_tbl->ID->ViewCustomAttributes = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->EditCustomAttributes = "";
			$jrf_tbl->strjrfnum->EditValue = ew_HtmlEncode($jrf_tbl->strjrfnum->CurrentValue);

			// strquarter
			$jrf_tbl->strquarter->EditCustomAttributes = "";
			$jrf_tbl->strquarter->EditValue = ew_HtmlEncode($jrf_tbl->strquarter->CurrentValue);

			// strmon
			$jrf_tbl->strmon->EditCustomAttributes = "";
			$jrf_tbl->strmon->EditValue = ew_HtmlEncode($jrf_tbl->strmon->CurrentValue);

			// stryear
			$jrf_tbl->stryear->EditCustomAttributes = "";
			$jrf_tbl->stryear->EditValue = ew_HtmlEncode($jrf_tbl->stryear->CurrentValue);

			// strdate
			$jrf_tbl->strdate->EditCustomAttributes = "";
			$jrf_tbl->strdate->EditValue = ew_HtmlEncode($jrf_tbl->strdate->CurrentValue);

			// strtime
			$jrf_tbl->strtime->EditCustomAttributes = "";
			$jrf_tbl->strtime->EditValue = ew_HtmlEncode($jrf_tbl->strtime->CurrentValue);

			// strduedate
			$jrf_tbl->strduedate->EditCustomAttributes = "";
			$jrf_tbl->strduedate->EditValue = ew_HtmlEncode($jrf_tbl->strduedate->CurrentValue);

			// strsubject
			$jrf_tbl->strsubject->EditCustomAttributes = "";
			$jrf_tbl->strsubject->EditValue = ew_HtmlEncode($jrf_tbl->strsubject->CurrentValue);

			// strusername
			$jrf_tbl->strusername->EditCustomAttributes = "";
			$jrf_tbl->strusername->EditValue = ew_HtmlEncode($jrf_tbl->strusername->CurrentValue);

			// strusereadd
			$jrf_tbl->strusereadd->EditCustomAttributes = "";
			$jrf_tbl->strusereadd->EditValue = ew_HtmlEncode($jrf_tbl->strusereadd->CurrentValue);

			// strcompany
			$jrf_tbl->strcompany->EditCustomAttributes = "";
			$jrf_tbl->strcompany->EditValue = ew_HtmlEncode($jrf_tbl->strcompany->CurrentValue);

			// strdepartment
			$jrf_tbl->strdepartment->EditCustomAttributes = "";
			$jrf_tbl->strdepartment->EditValue = ew_HtmlEncode($jrf_tbl->strdepartment->CurrentValue);

			// strloc
			$jrf_tbl->strloc->EditCustomAttributes = "";
			$jrf_tbl->strloc->EditValue = ew_HtmlEncode($jrf_tbl->strloc->CurrentValue);

			// strposition
			$jrf_tbl->strposition->EditCustomAttributes = "";
			$jrf_tbl->strposition->EditValue = ew_HtmlEncode($jrf_tbl->strposition->CurrentValue);

			// strtelephone
			$jrf_tbl->strtelephone->EditCustomAttributes = "";
			$jrf_tbl->strtelephone->EditValue = ew_HtmlEncode($jrf_tbl->strtelephone->CurrentValue);

			// strcostcent
			$jrf_tbl->strcostcent->EditCustomAttributes = "";
			$jrf_tbl->strcostcent->EditValue = ew_HtmlEncode($jrf_tbl->strcostcent->CurrentValue);

			// strnature
			$jrf_tbl->strnature->EditCustomAttributes = "";
			$jrf_tbl->strnature->EditValue = ew_HtmlEncode($jrf_tbl->strnature->CurrentValue);

			// strdescript
			$jrf_tbl->strdescript->EditCustomAttributes = "";
			$jrf_tbl->strdescript->EditValue = ew_HtmlEncode($jrf_tbl->strdescript->CurrentValue);

			// strattach
			$jrf_tbl->strattach->EditCustomAttributes = "";
			$jrf_tbl->strattach->EditValue = ew_HtmlEncode($jrf_tbl->strattach->CurrentValue);

			// strarea
			$jrf_tbl->strarea->EditCustomAttributes = "";
			$jrf_tbl->strarea->EditValue = ew_HtmlEncode($jrf_tbl->strarea->CurrentValue);

			// strpriority
			$jrf_tbl->strpriority->EditCustomAttributes = "";
			$jrf_tbl->strpriority->EditValue = ew_HtmlEncode($jrf_tbl->strpriority->CurrentValue);

			// strstatus
			$jrf_tbl->strstatus->EditCustomAttributes = "";
			$jrf_tbl->strstatus->EditValue = ew_HtmlEncode($jrf_tbl->strstatus->CurrentValue);

			// strlastedit
			$jrf_tbl->strlastedit->EditCustomAttributes = "";
			$jrf_tbl->strlastedit->EditValue = ew_HtmlEncode($jrf_tbl->strlastedit->CurrentValue);

			// strcategory
			$jrf_tbl->strcategory->EditCustomAttributes = "";
			$jrf_tbl->strcategory->EditValue = ew_HtmlEncode($jrf_tbl->strcategory->CurrentValue);

			// strassigned
			$jrf_tbl->strassigned->EditCustomAttributes = "";
			$jrf_tbl->strassigned->EditValue = ew_HtmlEncode($jrf_tbl->strassigned->CurrentValue);

			// strremarks
			$jrf_tbl->strremarks->EditCustomAttributes = "";
			$jrf_tbl->strremarks->EditValue = ew_HtmlEncode($jrf_tbl->strremarks->CurrentValue);

			// strdatecomplete
			$jrf_tbl->strdatecomplete->EditCustomAttributes = "";
			$jrf_tbl->strdatecomplete->EditValue = ew_HtmlEncode($jrf_tbl->strdatecomplete->CurrentValue);

			// strifoverdue
			$jrf_tbl->strifoverdue->EditCustomAttributes = "";
			$jrf_tbl->strifoverdue->EditValue = ew_HtmlEncode($jrf_tbl->strifoverdue->CurrentValue);

			// strwithpr
			$jrf_tbl->strwithpr->EditCustomAttributes = "";
			$jrf_tbl->strwithpr->EditValue = ew_HtmlEncode($jrf_tbl->strwithpr->CurrentValue);

			// sap_num
			$jrf_tbl->sap_num->EditCustomAttributes = "";
			$jrf_tbl->sap_num->EditValue = ew_HtmlEncode($jrf_tbl->sap_num->CurrentValue);

			// Edit refer script
			// ID

			$jrf_tbl->ID->HrefValue = "";

			// strjrfnum
			$jrf_tbl->strjrfnum->HrefValue = "";

			// strquarter
			$jrf_tbl->strquarter->HrefValue = "";

			// strmon
			$jrf_tbl->strmon->HrefValue = "";

			// stryear
			$jrf_tbl->stryear->HrefValue = "";

			// strdate
			$jrf_tbl->strdate->HrefValue = "";

			// strtime
			$jrf_tbl->strtime->HrefValue = "";

			// strduedate
			$jrf_tbl->strduedate->HrefValue = "";

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";

			// strusername
			$jrf_tbl->strusername->HrefValue = "";

			// strusereadd
			$jrf_tbl->strusereadd->HrefValue = "";

			// strcompany
			$jrf_tbl->strcompany->HrefValue = "";

			// strdepartment
			$jrf_tbl->strdepartment->HrefValue = "";

			// strloc
			$jrf_tbl->strloc->HrefValue = "";

			// strposition
			$jrf_tbl->strposition->HrefValue = "";

			// strtelephone
			$jrf_tbl->strtelephone->HrefValue = "";

			// strcostcent
			$jrf_tbl->strcostcent->HrefValue = "";

			// strnature
			$jrf_tbl->strnature->HrefValue = "";

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";

			// strattach
			$jrf_tbl->strattach->HrefValue = "";

			// strarea
			$jrf_tbl->strarea->HrefValue = "";

			// strpriority
			$jrf_tbl->strpriority->HrefValue = "";

			// strstatus
			$jrf_tbl->strstatus->HrefValue = "";

			// strlastedit
			$jrf_tbl->strlastedit->HrefValue = "";

			// strcategory
			$jrf_tbl->strcategory->HrefValue = "";

			// strassigned
			$jrf_tbl->strassigned->HrefValue = "";

			// strremarks
			$jrf_tbl->strremarks->HrefValue = "";

			// strdatecomplete
			$jrf_tbl->strdatecomplete->HrefValue = "";

			// strifoverdue
			$jrf_tbl->strifoverdue->HrefValue = "";

			// strwithpr
			$jrf_tbl->strwithpr->HrefValue = "";

			// sap_num
			$jrf_tbl->sap_num->HrefValue = "";
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $jrf_tbl;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($jrf_tbl->strmon->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $jrf_tbl->strmon->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $jrf_tbl;
		$sFilter = $jrf_tbl->KeyFilter();
		$jrf_tbl->CurrentFilter = $sFilter;
		$sSql = $jrf_tbl->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// strjrfnum
			$jrf_tbl->strjrfnum->SetDbValueDef($rsnew, $jrf_tbl->strjrfnum->CurrentValue, NULL, FALSE);

			// strquarter
			$jrf_tbl->strquarter->SetDbValueDef($rsnew, $jrf_tbl->strquarter->CurrentValue, NULL, FALSE);

			// strmon
			$jrf_tbl->strmon->SetDbValueDef($rsnew, $jrf_tbl->strmon->CurrentValue, NULL, FALSE);

			// stryear
			$jrf_tbl->stryear->SetDbValueDef($rsnew, $jrf_tbl->stryear->CurrentValue, NULL, FALSE);

			// strdate
			$jrf_tbl->strdate->SetDbValueDef($rsnew, $jrf_tbl->strdate->CurrentValue, NULL, FALSE);

			// strtime
			$jrf_tbl->strtime->SetDbValueDef($rsnew, $jrf_tbl->strtime->CurrentValue, NULL, FALSE);

			// strduedate
			$jrf_tbl->strduedate->SetDbValueDef($rsnew, $jrf_tbl->strduedate->CurrentValue, NULL, FALSE);

			// strsubject
			$jrf_tbl->strsubject->SetDbValueDef($rsnew, $jrf_tbl->strsubject->CurrentValue, NULL, FALSE);

			// strusername
			$jrf_tbl->strusername->SetDbValueDef($rsnew, $jrf_tbl->strusername->CurrentValue, NULL, FALSE);

			// strusereadd
			$jrf_tbl->strusereadd->SetDbValueDef($rsnew, $jrf_tbl->strusereadd->CurrentValue, NULL, FALSE);

			// strcompany
			$jrf_tbl->strcompany->SetDbValueDef($rsnew, $jrf_tbl->strcompany->CurrentValue, NULL, FALSE);

			// strdepartment
			$jrf_tbl->strdepartment->SetDbValueDef($rsnew, $jrf_tbl->strdepartment->CurrentValue, NULL, FALSE);

			// strloc
			$jrf_tbl->strloc->SetDbValueDef($rsnew, $jrf_tbl->strloc->CurrentValue, NULL, FALSE);

			// strposition
			$jrf_tbl->strposition->SetDbValueDef($rsnew, $jrf_tbl->strposition->CurrentValue, NULL, FALSE);

			// strtelephone
			$jrf_tbl->strtelephone->SetDbValueDef($rsnew, $jrf_tbl->strtelephone->CurrentValue, NULL, FALSE);

			// strcostcent
			$jrf_tbl->strcostcent->SetDbValueDef($rsnew, $jrf_tbl->strcostcent->CurrentValue, NULL, FALSE);

			// strnature
			$jrf_tbl->strnature->SetDbValueDef($rsnew, $jrf_tbl->strnature->CurrentValue, NULL, FALSE);

			// strdescript
			$jrf_tbl->strdescript->SetDbValueDef($rsnew, $jrf_tbl->strdescript->CurrentValue, NULL, FALSE);

			// strattach
			$jrf_tbl->strattach->SetDbValueDef($rsnew, $jrf_tbl->strattach->CurrentValue, NULL, FALSE);

			// strarea
			$jrf_tbl->strarea->SetDbValueDef($rsnew, $jrf_tbl->strarea->CurrentValue, NULL, FALSE);

			// strpriority
			$jrf_tbl->strpriority->SetDbValueDef($rsnew, $jrf_tbl->strpriority->CurrentValue, NULL, FALSE);

			// strstatus
			$jrf_tbl->strstatus->SetDbValueDef($rsnew, $jrf_tbl->strstatus->CurrentValue, NULL, FALSE);

			// strlastedit
			$jrf_tbl->strlastedit->SetDbValueDef($rsnew, $jrf_tbl->strlastedit->CurrentValue, NULL, FALSE);

			// strcategory
			$jrf_tbl->strcategory->SetDbValueDef($rsnew, $jrf_tbl->strcategory->CurrentValue, NULL, FALSE);

			// strassigned
			$jrf_tbl->strassigned->SetDbValueDef($rsnew, $jrf_tbl->strassigned->CurrentValue, NULL, FALSE);

			// strremarks
			$jrf_tbl->strremarks->SetDbValueDef($rsnew, $jrf_tbl->strremarks->CurrentValue, NULL, FALSE);

			// strdatecomplete
			$jrf_tbl->strdatecomplete->SetDbValueDef($rsnew, $jrf_tbl->strdatecomplete->CurrentValue, NULL, FALSE);

			// strifoverdue
			$jrf_tbl->strifoverdue->SetDbValueDef($rsnew, $jrf_tbl->strifoverdue->CurrentValue, NULL, FALSE);

			// strwithpr
			$jrf_tbl->strwithpr->SetDbValueDef($rsnew, $jrf_tbl->strwithpr->CurrentValue, NULL, FALSE);

			// sap_num
			$jrf_tbl->sap_num->SetDbValueDef($rsnew, $jrf_tbl->sap_num->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $jrf_tbl->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($jrf_tbl->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($jrf_tbl->CancelMessage <> "") {
					$this->setMessage($jrf_tbl->CancelMessage);
					$jrf_tbl->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$jrf_tbl->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
