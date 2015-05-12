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
$jrf_tbl_add = new cjrf_tbl_add();
$Page =& $jrf_tbl_add;

// Page init
$jrf_tbl_add->Page_Init();

// Page main
$jrf_tbl_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_add = new ew_Page("jrf_tbl_add");

// page properties
jrf_tbl_add.PageID = "add"; // page ID
jrf_tbl_add.FormID = "fjrf_tbladd"; // form ID
var EW_PAGE_ID = jrf_tbl_add.PageID; // for backward compatibility

// extend page with ValidateForm function
jrf_tbl_add.ValidateForm = function(fobj) {
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
jrf_tbl_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $jrf_tbl->TableCaption() ?><br><br>
<a href="<?php echo $jrf_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_add->ShowMessage();
?>
<form name="fjrf_tbladd" id="fjrf_tbladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return jrf_tbl_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="jrf_tbl">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="text" name="x_strmon" id="x_strmon" title="<?php echo $jrf_tbl->strmon->FldTitle() ?>" size="30" value="<?php echo $jrf_tbl->strmon->EditValue ?>"<?php echo $jrf_tbl->strmon->EditAttributes() ?>>
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
<?php if ($jrf_tbl->strsubject->Visible) { // strsubject ?>
	<tr<?php echo $jrf_tbl->strsubject->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strsubject->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strsubject->CellAttributes() ?>><span id="el_strsubject">
<textarea name="x_strsubject" id="x_strsubject" title="<?php echo $jrf_tbl->strsubject->FldTitle() ?>" cols="35" rows="4"<?php echo $jrf_tbl->strsubject->EditAttributes() ?>><?php echo $jrf_tbl->strsubject->EditValue ?></textarea>
</span><?php echo $jrf_tbl->strsubject->CustomMsg ?></td>
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$jrf_tbl_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_add';

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
	function cjrf_tbl_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $jrf_tbl;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["ID"] != "") {
		  $jrf_tbl->ID->setQueryStringValue($_GET["ID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $jrf_tbl->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$jrf_tbl->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $jrf_tbl->CurrentAction = "C"; // Copy record
		  } else {
		    $jrf_tbl->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($jrf_tbl->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("jrf_tbllist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$jrf_tbl->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $jrf_tbl->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$jrf_tbl->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $jrf_tbl;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $jrf_tbl;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $jrf_tbl;
		$jrf_tbl->strquarter->setFormValue($objForm->GetValue("x_strquarter"));
		$jrf_tbl->strmon->setFormValue($objForm->GetValue("x_strmon"));
		$jrf_tbl->stryear->setFormValue($objForm->GetValue("x_stryear"));
		$jrf_tbl->strdate->setFormValue($objForm->GetValue("x_strdate"));
		$jrf_tbl->strtime->setFormValue($objForm->GetValue("x_strtime"));
		$jrf_tbl->strusername->setFormValue($objForm->GetValue("x_strusername"));
		$jrf_tbl->strusereadd->setFormValue($objForm->GetValue("x_strusereadd"));
		$jrf_tbl->strcompany->setFormValue($objForm->GetValue("x_strcompany"));
		$jrf_tbl->strdepartment->setFormValue($objForm->GetValue("x_strdepartment"));
		$jrf_tbl->strloc->setFormValue($objForm->GetValue("x_strloc"));
		$jrf_tbl->strposition->setFormValue($objForm->GetValue("x_strposition"));
		$jrf_tbl->strtelephone->setFormValue($objForm->GetValue("x_strtelephone"));
		$jrf_tbl->strcostcent->setFormValue($objForm->GetValue("x_strcostcent"));
		$jrf_tbl->strsubject->setFormValue($objForm->GetValue("x_strsubject"));
		$jrf_tbl->strnature->setFormValue($objForm->GetValue("x_strnature"));
		$jrf_tbl->strdescript->setFormValue($objForm->GetValue("x_strdescript"));
		$jrf_tbl->strattach->setFormValue($objForm->GetValue("x_strattach"));
		$jrf_tbl->ID->setFormValue($objForm->GetValue("x_ID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $jrf_tbl;
		$jrf_tbl->ID->CurrentValue = $jrf_tbl->ID->FormValue;
		$jrf_tbl->strquarter->CurrentValue = $jrf_tbl->strquarter->FormValue;
		$jrf_tbl->strmon->CurrentValue = $jrf_tbl->strmon->FormValue;
		$jrf_tbl->stryear->CurrentValue = $jrf_tbl->stryear->FormValue;
		$jrf_tbl->strdate->CurrentValue = $jrf_tbl->strdate->FormValue;
		$jrf_tbl->strtime->CurrentValue = $jrf_tbl->strtime->FormValue;
		$jrf_tbl->strusername->CurrentValue = $jrf_tbl->strusername->FormValue;
		$jrf_tbl->strusereadd->CurrentValue = $jrf_tbl->strusereadd->FormValue;
		$jrf_tbl->strcompany->CurrentValue = $jrf_tbl->strcompany->FormValue;
		$jrf_tbl->strdepartment->CurrentValue = $jrf_tbl->strdepartment->FormValue;
		$jrf_tbl->strloc->CurrentValue = $jrf_tbl->strloc->FormValue;
		$jrf_tbl->strposition->CurrentValue = $jrf_tbl->strposition->FormValue;
		$jrf_tbl->strtelephone->CurrentValue = $jrf_tbl->strtelephone->FormValue;
		$jrf_tbl->strcostcent->CurrentValue = $jrf_tbl->strcostcent->FormValue;
		$jrf_tbl->strsubject->CurrentValue = $jrf_tbl->strsubject->FormValue;
		$jrf_tbl->strnature->CurrentValue = $jrf_tbl->strnature->FormValue;
		$jrf_tbl->strdescript->CurrentValue = $jrf_tbl->strdescript->FormValue;
		$jrf_tbl->strattach->CurrentValue = $jrf_tbl->strattach->FormValue;
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
		$jrf_tbl->strquarter->setDbValue($rs->fields('strquarter'));
		$jrf_tbl->strmon->setDbValue($rs->fields('strmon'));
		$jrf_tbl->stryear->setDbValue($rs->fields('stryear'));
		$jrf_tbl->strdate->setDbValue($rs->fields('strdate'));
		$jrf_tbl->strtime->setDbValue($rs->fields('strtime'));
		$jrf_tbl->strusername->setDbValue($rs->fields('strusername'));
		$jrf_tbl->strusereadd->setDbValue($rs->fields('strusereadd'));
		$jrf_tbl->strcompany->setDbValue($rs->fields('strcompany'));
		$jrf_tbl->strdepartment->setDbValue($rs->fields('strdepartment'));
		$jrf_tbl->strloc->setDbValue($rs->fields('strloc'));
		$jrf_tbl->strposition->setDbValue($rs->fields('strposition'));
		$jrf_tbl->strtelephone->setDbValue($rs->fields('strtelephone'));
		$jrf_tbl->strcostcent->setDbValue($rs->fields('strcostcent'));
		$jrf_tbl->strsubject->setDbValue($rs->fields('strsubject'));
		$jrf_tbl->strnature->setDbValue($rs->fields('strnature'));
		$jrf_tbl->strdescript->setDbValue($rs->fields('strdescript'));
		$jrf_tbl->strattach->setDbValue($rs->fields('strattach'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $jrf_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$jrf_tbl->Row_Rendering();

		// Common render codes for all row types
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

		// strsubject
		$jrf_tbl->strsubject->CellCssStyle = ""; $jrf_tbl->strsubject->CellCssClass = "";
		$jrf_tbl->strsubject->CellAttrs = array(); $jrf_tbl->strsubject->ViewAttrs = array(); $jrf_tbl->strsubject->EditAttrs = array();

		// strnature
		$jrf_tbl->strnature->CellCssStyle = ""; $jrf_tbl->strnature->CellCssClass = "";
		$jrf_tbl->strnature->CellAttrs = array(); $jrf_tbl->strnature->ViewAttrs = array(); $jrf_tbl->strnature->EditAttrs = array();

		// strdescript
		$jrf_tbl->strdescript->CellCssStyle = ""; $jrf_tbl->strdescript->CellCssClass = "";
		$jrf_tbl->strdescript->CellAttrs = array(); $jrf_tbl->strdescript->ViewAttrs = array(); $jrf_tbl->strdescript->EditAttrs = array();

		// strattach
		$jrf_tbl->strattach->CellCssStyle = ""; $jrf_tbl->strattach->CellCssClass = "";
		$jrf_tbl->strattach->CellAttrs = array(); $jrf_tbl->strattach->ViewAttrs = array(); $jrf_tbl->strattach->EditAttrs = array();
		if ($jrf_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$jrf_tbl->ID->ViewValue = $jrf_tbl->ID->CurrentValue;
			$jrf_tbl->ID->CssStyle = "";
			$jrf_tbl->ID->CssClass = "";
			$jrf_tbl->ID->ViewCustomAttributes = "";

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

			// strsubject
			$jrf_tbl->strsubject->ViewValue = $jrf_tbl->strsubject->CurrentValue;
			$jrf_tbl->strsubject->CssStyle = "";
			$jrf_tbl->strsubject->CssClass = "";
			$jrf_tbl->strsubject->ViewCustomAttributes = "";

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

			// strsubject
			$jrf_tbl->strsubject->HrefValue = "";
			$jrf_tbl->strsubject->TooltipValue = "";

			// strnature
			$jrf_tbl->strnature->HrefValue = "";
			$jrf_tbl->strnature->TooltipValue = "";

			// strdescript
			$jrf_tbl->strdescript->HrefValue = "";
			$jrf_tbl->strdescript->TooltipValue = "";

			// strattach
			$jrf_tbl->strattach->HrefValue = "";
			$jrf_tbl->strattach->TooltipValue = "";
		} elseif ($jrf_tbl->RowType == EW_ROWTYPE_ADD) { // Add row

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

			// strsubject
			$jrf_tbl->strsubject->EditCustomAttributes = "";
			$jrf_tbl->strsubject->EditValue = ew_HtmlEncode($jrf_tbl->strsubject->CurrentValue);

			// strnature
			$jrf_tbl->strnature->EditCustomAttributes = "";
			$jrf_tbl->strnature->EditValue = ew_HtmlEncode($jrf_tbl->strnature->CurrentValue);

			// strdescript
			$jrf_tbl->strdescript->EditCustomAttributes = "";
			$jrf_tbl->strdescript->EditValue = ew_HtmlEncode($jrf_tbl->strdescript->CurrentValue);

			// strattach
			$jrf_tbl->strattach->EditCustomAttributes = "";
			$jrf_tbl->strattach->EditValue = ew_HtmlEncode($jrf_tbl->strattach->CurrentValue);
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $jrf_tbl;
		$rsnew = array();

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

		// strsubject
		$jrf_tbl->strsubject->SetDbValueDef($rsnew, $jrf_tbl->strsubject->CurrentValue, NULL, FALSE);

		// strnature
		$jrf_tbl->strnature->SetDbValueDef($rsnew, $jrf_tbl->strnature->CurrentValue, NULL, FALSE);

		// strdescript
		$jrf_tbl->strdescript->SetDbValueDef($rsnew, $jrf_tbl->strdescript->CurrentValue, NULL, FALSE);

		// strattach
		$jrf_tbl->strattach->SetDbValueDef($rsnew, $jrf_tbl->strattach->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $jrf_tbl->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($jrf_tbl->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($jrf_tbl->CancelMessage <> "") {
				$this->setMessage($jrf_tbl->CancelMessage);
				$jrf_tbl->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$jrf_tbl->ID->setDbValue($conn->Insert_ID());
			$rsnew['ID'] = $jrf_tbl->ID->DbValue;

			// Call Row Inserted event
			$jrf_tbl->Row_Inserted($rsnew);
		}
		return $AddRow;
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
