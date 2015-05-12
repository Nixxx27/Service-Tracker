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
$jrf_tbl_view = new cjrf_tbl_view();
$Page =& $jrf_tbl_view;

// Page init
$jrf_tbl_view->Page_Init();

// Page main
$jrf_tbl_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($jrf_tbl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var jrf_tbl_view = new ew_Page("jrf_tbl_view");

// page properties
jrf_tbl_view.PageID = "view"; // page ID
jrf_tbl_view.FormID = "fjrf_tblview"; // form ID
var EW_PAGE_ID = jrf_tbl_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
jrf_tbl_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
jrf_tbl_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
jrf_tbl_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
jrf_tbl_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
jrf_tbl_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
jrf_tbl_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $jrf_tbl->TableCaption() ?>
<?php if ($jrf_tbl->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $jrf_tbl_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $jrf_tbl_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($jrf_tbl->Export == "") { ?>
<a href="<?php echo $jrf_tbl_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $jrf_tbl_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$jrf_tbl_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($jrf_tbl->ID->Visible) { // ID ?>
	<tr<?php echo $jrf_tbl->ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->ID->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->ID->CellAttributes() ?>>
<div<?php echo $jrf_tbl->ID->ViewAttributes() ?>><?php echo $jrf_tbl->ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strjrfnum->Visible) { // strjrfnum ?>
	<tr<?php echo $jrf_tbl->strjrfnum->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strjrfnum->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strjrfnum->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strjrfnum->ViewAttributes() ?>><?php echo $jrf_tbl->strjrfnum->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strquarter->Visible) { // strquarter ?>
	<tr<?php echo $jrf_tbl->strquarter->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strquarter->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strquarter->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strquarter->ViewAttributes() ?>><?php echo $jrf_tbl->strquarter->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strmon->Visible) { // strmon ?>
	<tr<?php echo $jrf_tbl->strmon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strmon->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strmon->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strmon->ViewAttributes() ?>><?php echo $jrf_tbl->strmon->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->stryear->Visible) { // stryear ?>
	<tr<?php echo $jrf_tbl->stryear->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->stryear->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->stryear->CellAttributes() ?>>
<div<?php echo $jrf_tbl->stryear->ViewAttributes() ?>><?php echo $jrf_tbl->stryear->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdate->Visible) { // strdate ?>
	<tr<?php echo $jrf_tbl->strdate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdate->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strdate->ViewAttributes() ?>><?php echo $jrf_tbl->strdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strtime->Visible) { // strtime ?>
	<tr<?php echo $jrf_tbl->strtime->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtime->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtime->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strtime->ViewAttributes() ?>><?php echo $jrf_tbl->strtime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strduedate->Visible) { // strduedate ?>
	<tr<?php echo $jrf_tbl->strduedate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strduedate->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strduedate->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strduedate->ViewAttributes() ?>><?php echo $jrf_tbl->strduedate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strsubject->Visible) { // strsubject ?>
	<tr<?php echo $jrf_tbl->strsubject->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strsubject->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strsubject->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strsubject->ViewAttributes() ?>><?php echo $jrf_tbl->strsubject->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strusername->Visible) { // strusername ?>
	<tr<?php echo $jrf_tbl->strusername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusername->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusername->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strusername->ViewAttributes() ?>><?php echo $jrf_tbl->strusername->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strusereadd->Visible) { // strusereadd ?>
	<tr<?php echo $jrf_tbl->strusereadd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strusereadd->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strusereadd->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strusereadd->ViewAttributes() ?>><?php echo $jrf_tbl->strusereadd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcompany->Visible) { // strcompany ?>
	<tr<?php echo $jrf_tbl->strcompany->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcompany->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcompany->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strcompany->ViewAttributes() ?>><?php echo $jrf_tbl->strcompany->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdepartment->Visible) { // strdepartment ?>
	<tr<?php echo $jrf_tbl->strdepartment->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdepartment->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdepartment->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strdepartment->ViewAttributes() ?>><?php echo $jrf_tbl->strdepartment->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strloc->Visible) { // strloc ?>
	<tr<?php echo $jrf_tbl->strloc->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strloc->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strloc->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strloc->ViewAttributes() ?>><?php echo $jrf_tbl->strloc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strposition->Visible) { // strposition ?>
	<tr<?php echo $jrf_tbl->strposition->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strposition->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strposition->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strposition->ViewAttributes() ?>><?php echo $jrf_tbl->strposition->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strtelephone->Visible) { // strtelephone ?>
	<tr<?php echo $jrf_tbl->strtelephone->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strtelephone->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strtelephone->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strtelephone->ViewAttributes() ?>><?php echo $jrf_tbl->strtelephone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcostcent->Visible) { // strcostcent ?>
	<tr<?php echo $jrf_tbl->strcostcent->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcostcent->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcostcent->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strcostcent->ViewAttributes() ?>><?php echo $jrf_tbl->strcostcent->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strnature->Visible) { // strnature ?>
	<tr<?php echo $jrf_tbl->strnature->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strnature->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strnature->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strnature->ViewAttributes() ?>><?php echo $jrf_tbl->strnature->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdescript->Visible) { // strdescript ?>
	<tr<?php echo $jrf_tbl->strdescript->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdescript->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdescript->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strdescript->ViewAttributes() ?>><?php echo $jrf_tbl->strdescript->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strattach->Visible) { // strattach ?>
	<tr<?php echo $jrf_tbl->strattach->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strattach->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strattach->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strattach->ViewAttributes() ?>><?php echo $jrf_tbl->strattach->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strarea->Visible) { // strarea ?>
	<tr<?php echo $jrf_tbl->strarea->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strarea->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strarea->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strarea->ViewAttributes() ?>><?php echo $jrf_tbl->strarea->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strpriority->Visible) { // strpriority ?>
	<tr<?php echo $jrf_tbl->strpriority->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strpriority->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strpriority->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strpriority->ViewAttributes() ?>><?php echo $jrf_tbl->strpriority->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strstatus->Visible) { // strstatus ?>
	<tr<?php echo $jrf_tbl->strstatus->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strstatus->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strstatus->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strstatus->ViewAttributes() ?>><?php echo $jrf_tbl->strstatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strlastedit->Visible) { // strlastedit ?>
	<tr<?php echo $jrf_tbl->strlastedit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strlastedit->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strlastedit->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strlastedit->ViewAttributes() ?>><?php echo $jrf_tbl->strlastedit->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strcategory->Visible) { // strcategory ?>
	<tr<?php echo $jrf_tbl->strcategory->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strcategory->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strcategory->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strcategory->ViewAttributes() ?>><?php echo $jrf_tbl->strcategory->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strassigned->Visible) { // strassigned ?>
	<tr<?php echo $jrf_tbl->strassigned->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strassigned->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strassigned->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strassigned->ViewAttributes() ?>><?php echo $jrf_tbl->strassigned->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strremarks->Visible) { // strremarks ?>
	<tr<?php echo $jrf_tbl->strremarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strremarks->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strremarks->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strremarks->ViewAttributes() ?>><?php echo $jrf_tbl->strremarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strdatecomplete->Visible) { // strdatecomplete ?>
	<tr<?php echo $jrf_tbl->strdatecomplete->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strdatecomplete->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strdatecomplete->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strdatecomplete->ViewAttributes() ?>><?php echo $jrf_tbl->strdatecomplete->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strifoverdue->Visible) { // strifoverdue ?>
	<tr<?php echo $jrf_tbl->strifoverdue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strifoverdue->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strifoverdue->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strifoverdue->ViewAttributes() ?>><?php echo $jrf_tbl->strifoverdue->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->strwithpr->Visible) { // strwithpr ?>
	<tr<?php echo $jrf_tbl->strwithpr->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->strwithpr->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->strwithpr->CellAttributes() ?>>
<div<?php echo $jrf_tbl->strwithpr->ViewAttributes() ?>><?php echo $jrf_tbl->strwithpr->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($jrf_tbl->sap_num->Visible) { // sap_num ?>
	<tr<?php echo $jrf_tbl->sap_num->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $jrf_tbl->sap_num->FldCaption() ?></td>
		<td<?php echo $jrf_tbl->sap_num->CellAttributes() ?>>
<div<?php echo $jrf_tbl->sap_num->ViewAttributes() ?>><?php echo $jrf_tbl->sap_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($jrf_tbl->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$jrf_tbl_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cjrf_tbl_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'jrf_tbl';

	// Page object name
	var $PageObjName = 'jrf_tbl_view';

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
	function cjrf_tbl_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (jrf_tbl)
		$GLOBALS["jrf_tbl"] = new cjrf_tbl();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		if (@$_GET["ID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["ID"]);
		}
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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $jrf_tbl;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ID"] <> "") {
				$jrf_tbl->ID->setQueryStringValue($_GET["ID"]);
				$this->arRecKey["ID"] = $jrf_tbl->ID->QueryStringValue;
			} else {
				$sReturnUrl = "jrf_tbllist.php"; // Return to list
			}

			// Get action
			$jrf_tbl->CurrentAction = "I"; // Display form
			switch ($jrf_tbl->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "jrf_tbllist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($jrf_tbl->Export, array("html","word","excel","xml","csv","email"))) {
				if ($jrf_tbl->Export == "email" && $jrf_tbl->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$jrf_tbl->setExportReturnUrl($jrf_tbl->ViewUrl()); // Add key
				$this->ExportData();
				if ($jrf_tbl->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "jrf_tbllist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$jrf_tbl->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "ID=" . urlencode($jrf_tbl->ID->CurrentValue);
		$this->AddUrl = $jrf_tbl->AddUrl();
		$this->EditUrl = $jrf_tbl->EditUrl();
		$this->CopyUrl = $jrf_tbl->CopyUrl();
		$this->DeleteUrl = $jrf_tbl->DeleteUrl();
		$this->ListUrl = $jrf_tbl->ListUrl();

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
		}

		// Call Row Rendered event
		if ($jrf_tbl->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$jrf_tbl->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $jrf_tbl;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $jrf_tbl->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->lDisplayRecs < 0) {
			$this->lStopRec = $this->lTotalRecs;
		} else {
			$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
		}
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
			$ExportDoc = new cExportDocument($jrf_tbl, "v");
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
}
?>
