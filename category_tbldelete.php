<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>

<?php 
include('copyright.php'); 
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
$category_tbl_delete = new ccategory_tbl_delete();
$Page =& $category_tbl_delete;

// Page init
$category_tbl_delete->Page_Init();

// Page main
$category_tbl_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var category_tbl_delete = new ew_Page("category_tbl_delete");

// page properties
category_tbl_delete.PageID = "delete"; // page ID
category_tbl_delete.FormID = "fcategory_tbldelete"; // form ID
var EW_PAGE_ID = category_tbl_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
category_tbl_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
category_tbl_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
category_tbl_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_tbl_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
category_tbl_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
category_tbl_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
if ($rs = $category_tbl_delete->LoadRecordset())
	$category_tbl_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($category_tbl_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$category_tbl_delete->Page_Terminate("category_tbllist.php"); // Return to list
}
?>
<div class="row">
    <div class="col-lg-12">
    	<h3><strong><i class="fa fa-wrench"></i> JOB CATEGORIES <small>Delete Record</small></strong></h3>
    </div>
</div>
    	<hr>
<?php include('fmd-nav.php'); ?>
<img  class="onhover cursorpointer" onclick="javascript:location.href='<?php echo $category_tbl->getReturnUrl() ?>'" src="img/system/buttons/back.png"  title="Back to List" height="40px" width="40px">

<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$category_tbl_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="category_tbl">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($category_tbl_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $category_tbl->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $category_tbl->ID->FldCaption() ?></td>
		<td valign="top"><?php echo "Category" ?></td>
		<td valign="top"><?php echo "Remarks" ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$category_tbl_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$category_tbl_delete->lRecCnt++;

	// Set row properties
	$category_tbl->CssClass = "";
	$category_tbl->CssStyle = "";
	$category_tbl->RowAttrs = array();
	$category_tbl->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$category_tbl_delete->LoadRowValues($rs);

	// Render row
	$category_tbl_delete->RenderRow();
?>
	<tr<?php echo $category_tbl->RowAttributes() ?>>
		<td<?php echo $category_tbl->ID->CellAttributes() ?>>
<div<?php echo $category_tbl->ID->ViewAttributes() ?>><?php echo $category_tbl->ID->ListViewValue() ?></div></td>
		<td<?php echo $category_tbl->strcategory->CellAttributes() ?>>
<div<?php echo $category_tbl->strcategory->ViewAttributes() ?>><?php echo $category_tbl->strcategory->ListViewValue() ?></div></td>
		<td<?php echo $category_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $category_tbl->strremarks->ViewAttributes() ?>><?php echo $category_tbl->strremarks->ListViewValue() ?></div></td>
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
<br/>
<input type="submit" name="Action" id="Action" class="btn btn-primary btn-sm" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
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
$category_tbl_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccategory_tbl_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'category_tbl';

	// Page object name
	var $PageObjName = 'category_tbl_delete';

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
	function ccategory_tbl_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (category_tbl)
		$GLOBALS["category_tbl"] = new ccategory_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category_tbl', TRUE);

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
		global $category_tbl;

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
		global $Language, $category_tbl;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["ID"] <> "") {
			$category_tbl->ID->setQueryStringValue($_GET["ID"]);
			if (!is_numeric($category_tbl->ID->QueryStringValue))
				$this->Page_Terminate("category_tbllist.php"); // Prevent SQL injection, exit
			$sKey .= $category_tbl->ID->QueryStringValue;
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
			$this->Page_Terminate("category_tbllist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("category_tbllist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`ID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in category_tbl class, category_tblinfo.php

		$category_tbl->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$category_tbl->CurrentAction = $_POST["a_delete"];
		} else {
			$category_tbl->CurrentAction = "I"; // Display record
		}
		switch ($category_tbl->CurrentAction) {
			case "D": // Delete
				$category_tbl->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($category_tbl->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $category_tbl;
		$DeleteRows = TRUE;
		$sWrkFilter = $category_tbl->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in category_tbl class, category_tblinfo.php

		$category_tbl->CurrentFilter = $sWrkFilter;
		$sSql = $category_tbl->SQL();
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
				$DeleteRows = $category_tbl->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($category_tbl->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($category_tbl->CancelMessage <> "") {
				$this->setMessage($category_tbl->CancelMessage);
				$category_tbl->CancelMessage = "";
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
				$category_tbl->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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

			// strremarks
			$category_tbl->strremarks->HrefValue = "";
			$category_tbl->strremarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($category_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$category_tbl->Row_Rendered();
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
