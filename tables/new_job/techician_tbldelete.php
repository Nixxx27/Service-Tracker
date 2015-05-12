<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "techician_tblinfo.php" ?>
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
$techician_tbl_delete = new ctechician_tbl_delete();
$Page =& $techician_tbl_delete;

// Page init
$techician_tbl_delete->Page_Init();

// Page main
$techician_tbl_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var techician_tbl_delete = new ew_Page("techician_tbl_delete");

// page properties
techician_tbl_delete.PageID = "delete"; // page ID
techician_tbl_delete.FormID = "ftechician_tbldelete"; // form ID
var EW_PAGE_ID = techician_tbl_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
techician_tbl_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
techician_tbl_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
techician_tbl_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
techician_tbl_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
techician_tbl_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
techician_tbl_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
if ($rs = $techician_tbl_delete->LoadRecordset())
	$techician_tbl_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($techician_tbl_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$techician_tbl_delete->Page_Terminate("techician_tbllist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $techician_tbl->TableCaption() ?><br><br>
<a href="<?php echo $techician_tbl->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$techician_tbl_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="techician_tbl">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($techician_tbl_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $techician_tbl->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $techician_tbl->ID->FldCaption() ?></td>
		<td valign="top"><?php echo $techician_tbl->strtechname->FldCaption() ?></td>
		<td valign="top"><?php echo $techician_tbl->strremarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$techician_tbl_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$techician_tbl_delete->lRecCnt++;

	// Set row properties
	$techician_tbl->CssClass = "";
	$techician_tbl->CssStyle = "";
	$techician_tbl->RowAttrs = array();
	$techician_tbl->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$techician_tbl_delete->LoadRowValues($rs);

	// Render row
	$techician_tbl_delete->RenderRow();
?>
	<tr<?php echo $techician_tbl->RowAttributes() ?>>
		<td<?php echo $techician_tbl->ID->CellAttributes() ?>>
<div<?php echo $techician_tbl->ID->ViewAttributes() ?>><?php echo $techician_tbl->ID->ListViewValue() ?></div></td>
		<td<?php echo $techician_tbl->strtechname->CellAttributes() ?>>
<div<?php echo $techician_tbl->strtechname->ViewAttributes() ?>><?php echo $techician_tbl->strtechname->ListViewValue() ?></div></td>
		<td<?php echo $techician_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $techician_tbl->strremarks->ViewAttributes() ?>><?php echo $techician_tbl->strremarks->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$techician_tbl_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctechician_tbl_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'techician_tbl';

	// Page object name
	var $PageObjName = 'techician_tbl_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $techician_tbl;
		if ($techician_tbl->UseTokenInUrl) $PageUrl .= "t=" . $techician_tbl->TableVar . "&"; // Add page token
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
		global $objForm, $techician_tbl;
		if ($techician_tbl->UseTokenInUrl) {
			if ($objForm)
				return ($techician_tbl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($techician_tbl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctechician_tbl_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (techician_tbl)
		$GLOBALS["techician_tbl"] = new ctechician_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'techician_tbl', TRUE);

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
		global $techician_tbl;

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $techician_tbl;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["ID"] <> "") {
			$techician_tbl->ID->setQueryStringValue($_GET["ID"]);
			if (!is_numeric($techician_tbl->ID->QueryStringValue))
				$this->Page_Terminate("techician_tbllist.php"); // Prevent SQL injection, exit
			$sKey .= $techician_tbl->ID->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("techician_tbllist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("techician_tbllist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`ID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in techician_tbl class, techician_tblinfo.php

		$techician_tbl->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$techician_tbl->CurrentAction = $_POST["a_delete"];
		} else {
			$techician_tbl->CurrentAction = "I"; // Display record
		}
		switch ($techician_tbl->CurrentAction) {
			case "D": // Delete
				$techician_tbl->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($techician_tbl->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $techician_tbl;
		$DeleteRows = TRUE;
		$sWrkFilter = $techician_tbl->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in techician_tbl class, techician_tblinfo.php

		$techician_tbl->CurrentFilter = $sWrkFilter;
		$sSql = $techician_tbl->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $techician_tbl->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['ID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($techician_tbl->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($techician_tbl->CancelMessage <> "") {
				$this->setMessage($techician_tbl->CancelMessage);
				$techician_tbl->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$techician_tbl->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $techician_tbl;

		// Call Recordset Selecting event
		$techician_tbl->Recordset_Selecting($techician_tbl->CurrentFilter);

		// Load List page SQL
		$sSql = $techician_tbl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$techician_tbl->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $techician_tbl;
		$sFilter = $techician_tbl->KeyFilter();

		// Call Row Selecting event
		$techician_tbl->Row_Selecting($sFilter);

		// Load SQL based on filter
		$techician_tbl->CurrentFilter = $sFilter;
		$sSql = $techician_tbl->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$techician_tbl->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $techician_tbl;
		$techician_tbl->ID->setDbValue($rs->fields('ID'));
		$techician_tbl->strtechname->setDbValue($rs->fields('strtechname'));
		$techician_tbl->strremarks->setDbValue($rs->fields('strremarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $techician_tbl;

		// Initialize URLs
		// Call Row_Rendering event

		$techician_tbl->Row_Rendering();

		// Common render codes for all row types
		// ID

		$techician_tbl->ID->CellCssStyle = ""; $techician_tbl->ID->CellCssClass = "";
		$techician_tbl->ID->CellAttrs = array(); $techician_tbl->ID->ViewAttrs = array(); $techician_tbl->ID->EditAttrs = array();

		// strtechname
		$techician_tbl->strtechname->CellCssStyle = ""; $techician_tbl->strtechname->CellCssClass = "";
		$techician_tbl->strtechname->CellAttrs = array(); $techician_tbl->strtechname->ViewAttrs = array(); $techician_tbl->strtechname->EditAttrs = array();

		// strremarks
		$techician_tbl->strremarks->CellCssStyle = ""; $techician_tbl->strremarks->CellCssClass = "";
		$techician_tbl->strremarks->CellAttrs = array(); $techician_tbl->strremarks->ViewAttrs = array(); $techician_tbl->strremarks->EditAttrs = array();
		if ($techician_tbl->RowType == EW_ROWTYPE_VIEW) { // View row

			// ID
			$techician_tbl->ID->ViewValue = $techician_tbl->ID->CurrentValue;
			$techician_tbl->ID->CssStyle = "";
			$techician_tbl->ID->CssClass = "";
			$techician_tbl->ID->ViewCustomAttributes = "";

			// strtechname
			$techician_tbl->strtechname->ViewValue = $techician_tbl->strtechname->CurrentValue;
			$techician_tbl->strtechname->CssStyle = "";
			$techician_tbl->strtechname->CssClass = "";
			$techician_tbl->strtechname->ViewCustomAttributes = "";

			// strremarks
			$techician_tbl->strremarks->ViewValue = $techician_tbl->strremarks->CurrentValue;
			$techician_tbl->strremarks->CssStyle = "";
			$techician_tbl->strremarks->CssClass = "";
			$techician_tbl->strremarks->ViewCustomAttributes = "";

			// ID
			$techician_tbl->ID->HrefValue = "";
			$techician_tbl->ID->TooltipValue = "";

			// strtechname
			$techician_tbl->strtechname->HrefValue = "";
			$techician_tbl->strtechname->TooltipValue = "";

			// strremarks
			$techician_tbl->strremarks->HrefValue = "";
			$techician_tbl->strremarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($techician_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$techician_tbl->Row_Rendered();
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
