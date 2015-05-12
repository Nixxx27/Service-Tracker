<?php

// Global variable for table object
$archv_finished = NULL;

//
// Table class for archv_finished
//
class carchv_finished {
	var $TableVar = 'archv_finished';
	var $TableName = 'archv_finished';
	var $TableType = 'TABLE';
	var $ID;
	var $strjrfnum;
	var $strquarter;
	var $strmon;
	var $stryear;
	var $strdate;
	var $strtime;
	var $strusername;
	var $strusereadd;
	var $strcompany;
	var $strdepartment;
	var $strloc;
	var $strposition;
	var $strtelephone;
	var $strcostcent;
	var $strsubject;
	var $strnature;
	var $strdescript;
	var $strarea;
	var $strattach;
	var $strpriority;
	var $strduedate;
	var $strstatus;
	var $strlastedit;
	var $strcategory;
	var $strassigned;
	var $strdatecomplete;
	var $strwithpr;
	var $strremarks;
	var $sap_num;
	var $work_days;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function carchv_finished() {
		global $Language;

		// ID
		$this->ID = new cField('archv_finished', 'archv_finished', 'x_ID', 'ID', '`ID`', 3, -1, FALSE, '`ID`', FALSE);
		$this->ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ID'] =& $this->ID;

		// strjrfnum
		$this->strjrfnum = new cField('archv_finished', 'archv_finished', 'x_strjrfnum', 'strjrfnum', '`strjrfnum`', 200, -1, FALSE, '`strjrfnum`', FALSE);
		$this->fields['strjrfnum'] =& $this->strjrfnum;

		// strquarter
		$this->strquarter = new cField('archv_finished', 'archv_finished', 'x_strquarter', 'strquarter', '`strquarter`', 200, -1, FALSE, '`strquarter`', FALSE);
		$this->fields['strquarter'] =& $this->strquarter;

		// strmon
		$this->strmon = new cField('archv_finished', 'archv_finished', 'x_strmon', 'strmon', '`strmon`', 200, -1, FALSE, '`strmon`', FALSE);
		$this->fields['strmon'] =& $this->strmon;

		// stryear
		$this->stryear = new cField('archv_finished', 'archv_finished', 'x_stryear', 'stryear', '`stryear`', 200, -1, FALSE, '`stryear`', FALSE);
		$this->fields['stryear'] =& $this->stryear;

		// strdate
		$this->strdate = new cField('archv_finished', 'archv_finished', 'x_strdate', 'strdate', '`strdate`', 200, -1, FALSE, '`strdate`', FALSE);
		$this->fields['strdate'] =& $this->strdate;

		// strtime
		$this->strtime = new cField('archv_finished', 'archv_finished', 'x_strtime', 'strtime', '`strtime`', 200, -1, FALSE, '`strtime`', FALSE);
		$this->fields['strtime'] =& $this->strtime;

		// strusername
		$this->strusername = new cField('archv_finished', 'archv_finished', 'x_strusername', 'strusername', '`strusername`', 200, -1, FALSE, '`strusername`', FALSE);
		$this->fields['strusername'] =& $this->strusername;

		// strusereadd
		$this->strusereadd = new cField('archv_finished', 'archv_finished', 'x_strusereadd', 'strusereadd', '`strusereadd`', 200, -1, FALSE, '`strusereadd`', FALSE);
		$this->fields['strusereadd'] =& $this->strusereadd;

		// strcompany
		$this->strcompany = new cField('archv_finished', 'archv_finished', 'x_strcompany', 'strcompany', '`strcompany`', 200, -1, FALSE, '`strcompany`', FALSE);
		$this->fields['strcompany'] =& $this->strcompany;

		// strdepartment
		$this->strdepartment = new cField('archv_finished', 'archv_finished', 'x_strdepartment', 'strdepartment', '`strdepartment`', 200, -1, FALSE, '`strdepartment`', FALSE);
		$this->fields['strdepartment'] =& $this->strdepartment;

		// strloc
		$this->strloc = new cField('archv_finished', 'archv_finished', 'x_strloc', 'strloc', '`strloc`', 200, -1, FALSE, '`strloc`', FALSE);
		$this->fields['strloc'] =& $this->strloc;

		// strposition
		$this->strposition = new cField('archv_finished', 'archv_finished', 'x_strposition', 'strposition', '`strposition`', 200, -1, FALSE, '`strposition`', FALSE);
		$this->fields['strposition'] =& $this->strposition;

		// strtelephone
		$this->strtelephone = new cField('archv_finished', 'archv_finished', 'x_strtelephone', 'strtelephone', '`strtelephone`', 200, -1, FALSE, '`strtelephone`', FALSE);
		$this->fields['strtelephone'] =& $this->strtelephone;

		// strcostcent
		$this->strcostcent = new cField('archv_finished', 'archv_finished', 'x_strcostcent', 'strcostcent', '`strcostcent`', 200, -1, FALSE, '`strcostcent`', FALSE);
		$this->fields['strcostcent'] =& $this->strcostcent;

		// strsubject
		$this->strsubject = new cField('archv_finished', 'archv_finished', 'x_strsubject', 'strsubject', '`strsubject`', 201, -1, FALSE, '`strsubject`', FALSE);
		$this->fields['strsubject'] =& $this->strsubject;

		// strnature
		$this->strnature = new cField('archv_finished', 'archv_finished', 'x_strnature', 'strnature', '`strnature`', 200, -1, FALSE, '`strnature`', FALSE);
		$this->fields['strnature'] =& $this->strnature;

		// strdescript
		$this->strdescript = new cField('archv_finished', 'archv_finished', 'x_strdescript', 'strdescript', '`strdescript`', 201, -1, FALSE, '`strdescript`', FALSE);
		$this->fields['strdescript'] =& $this->strdescript;

		// strarea
		$this->strarea = new cField('archv_finished', 'archv_finished', 'x_strarea', 'strarea', '`strarea`', 200, -1, FALSE, '`strarea`', FALSE);
		$this->fields['strarea'] =& $this->strarea;

		// strattach
		$this->strattach = new cField('archv_finished', 'archv_finished', 'x_strattach', 'strattach', '`strattach`', 200, -1, FALSE, '`strattach`', FALSE);
		$this->fields['strattach'] =& $this->strattach;

		// strpriority
		$this->strpriority = new cField('archv_finished', 'archv_finished', 'x_strpriority', 'strpriority', '`strpriority`', 200, -1, FALSE, '`strpriority`', FALSE);
		$this->fields['strpriority'] =& $this->strpriority;

		// strduedate
		$this->strduedate = new cField('archv_finished', 'archv_finished', 'x_strduedate', 'strduedate', '`strduedate`', 200, -1, FALSE, '`strduedate`', FALSE);
		$this->fields['strduedate'] =& $this->strduedate;

		// strstatus
		$this->strstatus = new cField('archv_finished', 'archv_finished', 'x_strstatus', 'strstatus', '`strstatus`', 200, -1, FALSE, '`strstatus`', FALSE);
		$this->fields['strstatus'] =& $this->strstatus;

		// strlastedit
		$this->strlastedit = new cField('archv_finished', 'archv_finished', 'x_strlastedit', 'strlastedit', '`strlastedit`', 200, -1, FALSE, '`strlastedit`', FALSE);
		$this->fields['strlastedit'] =& $this->strlastedit;

		// strcategory
		$this->strcategory = new cField('archv_finished', 'archv_finished', 'x_strcategory', 'strcategory', '`strcategory`', 200, -1, FALSE, '`strcategory`', FALSE);
		$this->fields['strcategory'] =& $this->strcategory;

		// strassigned
		$this->strassigned = new cField('archv_finished', 'archv_finished', 'x_strassigned', 'strassigned', '`strassigned`', 200, -1, FALSE, '`strassigned`', FALSE);
		$this->fields['strassigned'] =& $this->strassigned;

		// strdatecomplete
		$this->strdatecomplete = new cField('archv_finished', 'archv_finished', 'x_strdatecomplete', 'strdatecomplete', '`strdatecomplete`', 200, -1, FALSE, '`strdatecomplete`', FALSE);
		$this->fields['strdatecomplete'] =& $this->strdatecomplete;

		// strwithpr
		$this->strwithpr = new cField('archv_finished', 'archv_finished', 'x_strwithpr', 'strwithpr', '`strwithpr`', 200, -1, FALSE, '`strwithpr`', FALSE);
		$this->fields['strwithpr'] =& $this->strwithpr;

		// strremarks
		$this->strremarks = new cField('archv_finished', 'archv_finished', 'x_strremarks', 'strremarks', '`strremarks`', 201, -1, FALSE, '`strremarks`', FALSE);
		$this->fields['strremarks'] =& $this->strremarks;

		// sap_num
		$this->sap_num = new cField('archv_finished', 'archv_finished', 'x_sap_num', 'sap_num', '`sap_num`', 200, -1, FALSE, '`sap_num`', FALSE);
		$this->fields['sap_num'] =& $this->sap_num;

		// work_days
		$this->work_days = new cField('archv_finished', 'archv_finished', 'x_work_days', 'work_days', '`work_days`', 200, -1, FALSE, '`work_days`', FALSE);
		$this->fields['work_days'] =& $this->work_days;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "archv_finished_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`archv_finished`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere .= "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`ID` DESC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return ;
			case "edit":
			case "update":
				return ;
			case "delete":
				return ;
			case "view":
				return ;
			case "search":
				return ;
			default:
				return ;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `archv_finished` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `archv_finished` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `archv_finished` WHERE ";
		$SQL .= ew_QuotedName('ID') . '=' . ew_QuotedValue($rs['ID'], $this->ID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`ID` = @ID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@ID@", ew_AdjustSql($this->ID->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "archv_finishedlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "archv_finishedlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("archv_finishedview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "archv_finishedadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("archv_finishededit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("archv_finishedadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("archv_finisheddelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ID->CurrentValue)) {
			$sUrl .= "ID=" . urlencode($this->ID->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=archv_finished" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->ID->setDbValue($rs->fields('ID'));
		$this->strjrfnum->setDbValue($rs->fields('strjrfnum'));
		$this->strquarter->setDbValue($rs->fields('strquarter'));
		$this->strmon->setDbValue($rs->fields('strmon'));
		$this->stryear->setDbValue($rs->fields('stryear'));
		$this->strdate->setDbValue($rs->fields('strdate'));
		$this->strtime->setDbValue($rs->fields('strtime'));
		$this->strusername->setDbValue($rs->fields('strusername'));
		$this->strusereadd->setDbValue($rs->fields('strusereadd'));
		$this->strcompany->setDbValue($rs->fields('strcompany'));
		$this->strdepartment->setDbValue($rs->fields('strdepartment'));
		$this->strloc->setDbValue($rs->fields('strloc'));
		$this->strposition->setDbValue($rs->fields('strposition'));
		$this->strtelephone->setDbValue($rs->fields('strtelephone'));
		$this->strcostcent->setDbValue($rs->fields('strcostcent'));
		$this->strsubject->setDbValue($rs->fields('strsubject'));
		$this->strnature->setDbValue($rs->fields('strnature'));
		$this->strdescript->setDbValue($rs->fields('strdescript'));
		$this->strarea->setDbValue($rs->fields('strarea'));
		$this->strattach->setDbValue($rs->fields('strattach'));
		$this->strpriority->setDbValue($rs->fields('strpriority'));
		$this->strduedate->setDbValue($rs->fields('strduedate'));
		$this->strstatus->setDbValue($rs->fields('strstatus'));
		$this->strlastedit->setDbValue($rs->fields('strlastedit'));
		$this->strcategory->setDbValue($rs->fields('strcategory'));
		$this->strassigned->setDbValue($rs->fields('strassigned'));
		$this->strdatecomplete->setDbValue($rs->fields('strdatecomplete'));
		$this->strwithpr->setDbValue($rs->fields('strwithpr'));
		$this->strremarks->setDbValue($rs->fields('strremarks'));
		$this->sap_num->setDbValue($rs->fields('sap_num'));
		$this->work_days->setDbValue($rs->fields('work_days'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// ID

		$this->ID->CellCssStyle = ""; $this->ID->CellCssClass = "";
		$this->ID->CellAttrs = array(); $this->ID->ViewAttrs = array(); $this->ID->EditAttrs = array();

		// strjrfnum
		$this->strjrfnum->CellCssStyle = ""; $this->strjrfnum->CellCssClass = "";
		$this->strjrfnum->CellAttrs = array(); $this->strjrfnum->ViewAttrs = array(); $this->strjrfnum->EditAttrs = array();

		// strquarter
		$this->strquarter->CellCssStyle = ""; $this->strquarter->CellCssClass = "";
		$this->strquarter->CellAttrs = array(); $this->strquarter->ViewAttrs = array(); $this->strquarter->EditAttrs = array();

		// strmon
		$this->strmon->CellCssStyle = ""; $this->strmon->CellCssClass = "";
		$this->strmon->CellAttrs = array(); $this->strmon->ViewAttrs = array(); $this->strmon->EditAttrs = array();

		// stryear
		$this->stryear->CellCssStyle = ""; $this->stryear->CellCssClass = "";
		$this->stryear->CellAttrs = array(); $this->stryear->ViewAttrs = array(); $this->stryear->EditAttrs = array();

		// strdate
		$this->strdate->CellCssStyle = ""; $this->strdate->CellCssClass = "";
		$this->strdate->CellAttrs = array(); $this->strdate->ViewAttrs = array(); $this->strdate->EditAttrs = array();

		// strtime
		$this->strtime->CellCssStyle = ""; $this->strtime->CellCssClass = "";
		$this->strtime->CellAttrs = array(); $this->strtime->ViewAttrs = array(); $this->strtime->EditAttrs = array();

		// strusername
		$this->strusername->CellCssStyle = ""; $this->strusername->CellCssClass = "";
		$this->strusername->CellAttrs = array(); $this->strusername->ViewAttrs = array(); $this->strusername->EditAttrs = array();

		// strusereadd
		$this->strusereadd->CellCssStyle = ""; $this->strusereadd->CellCssClass = "";
		$this->strusereadd->CellAttrs = array(); $this->strusereadd->ViewAttrs = array(); $this->strusereadd->EditAttrs = array();

		// strcompany
		$this->strcompany->CellCssStyle = ""; $this->strcompany->CellCssClass = "";
		$this->strcompany->CellAttrs = array(); $this->strcompany->ViewAttrs = array(); $this->strcompany->EditAttrs = array();

		// strdepartment
		$this->strdepartment->CellCssStyle = ""; $this->strdepartment->CellCssClass = "";
		$this->strdepartment->CellAttrs = array(); $this->strdepartment->ViewAttrs = array(); $this->strdepartment->EditAttrs = array();

		// strloc
		$this->strloc->CellCssStyle = ""; $this->strloc->CellCssClass = "";
		$this->strloc->CellAttrs = array(); $this->strloc->ViewAttrs = array(); $this->strloc->EditAttrs = array();

		// strposition
		$this->strposition->CellCssStyle = ""; $this->strposition->CellCssClass = "";
		$this->strposition->CellAttrs = array(); $this->strposition->ViewAttrs = array(); $this->strposition->EditAttrs = array();

		// strtelephone
		$this->strtelephone->CellCssStyle = ""; $this->strtelephone->CellCssClass = "";
		$this->strtelephone->CellAttrs = array(); $this->strtelephone->ViewAttrs = array(); $this->strtelephone->EditAttrs = array();

		// strcostcent
		$this->strcostcent->CellCssStyle = ""; $this->strcostcent->CellCssClass = "";
		$this->strcostcent->CellAttrs = array(); $this->strcostcent->ViewAttrs = array(); $this->strcostcent->EditAttrs = array();

		// strsubject
		$this->strsubject->CellCssStyle = ""; $this->strsubject->CellCssClass = "";
		$this->strsubject->CellAttrs = array(); $this->strsubject->ViewAttrs = array(); $this->strsubject->EditAttrs = array();

		// strnature
		$this->strnature->CellCssStyle = ""; $this->strnature->CellCssClass = "";
		$this->strnature->CellAttrs = array(); $this->strnature->ViewAttrs = array(); $this->strnature->EditAttrs = array();

		// strdescript
		$this->strdescript->CellCssStyle = ""; $this->strdescript->CellCssClass = "";
		$this->strdescript->CellAttrs = array(); $this->strdescript->ViewAttrs = array(); $this->strdescript->EditAttrs = array();

		// strarea
		$this->strarea->CellCssStyle = ""; $this->strarea->CellCssClass = "";
		$this->strarea->CellAttrs = array(); $this->strarea->ViewAttrs = array(); $this->strarea->EditAttrs = array();

		// strattach
		$this->strattach->CellCssStyle = ""; $this->strattach->CellCssClass = "";
		$this->strattach->CellAttrs = array(); $this->strattach->ViewAttrs = array(); $this->strattach->EditAttrs = array();

		// strpriority
		$this->strpriority->CellCssStyle = ""; $this->strpriority->CellCssClass = "";
		$this->strpriority->CellAttrs = array(); $this->strpriority->ViewAttrs = array(); $this->strpriority->EditAttrs = array();

		// strduedate
		$this->strduedate->CellCssStyle = ""; $this->strduedate->CellCssClass = "";
		$this->strduedate->CellAttrs = array(); $this->strduedate->ViewAttrs = array(); $this->strduedate->EditAttrs = array();

		// strstatus
		$this->strstatus->CellCssStyle = ""; $this->strstatus->CellCssClass = "";
		$this->strstatus->CellAttrs = array(); $this->strstatus->ViewAttrs = array(); $this->strstatus->EditAttrs = array();

		// strlastedit
		$this->strlastedit->CellCssStyle = ""; $this->strlastedit->CellCssClass = "";
		$this->strlastedit->CellAttrs = array(); $this->strlastedit->ViewAttrs = array(); $this->strlastedit->EditAttrs = array();

		// strcategory
		$this->strcategory->CellCssStyle = ""; $this->strcategory->CellCssClass = "";
		$this->strcategory->CellAttrs = array(); $this->strcategory->ViewAttrs = array(); $this->strcategory->EditAttrs = array();

		// strassigned
		$this->strassigned->CellCssStyle = ""; $this->strassigned->CellCssClass = "";
		$this->strassigned->CellAttrs = array(); $this->strassigned->ViewAttrs = array(); $this->strassigned->EditAttrs = array();

		// strdatecomplete
		$this->strdatecomplete->CellCssStyle = ""; $this->strdatecomplete->CellCssClass = "";
		$this->strdatecomplete->CellAttrs = array(); $this->strdatecomplete->ViewAttrs = array(); $this->strdatecomplete->EditAttrs = array();

		// strwithpr
		$this->strwithpr->CellCssStyle = ""; $this->strwithpr->CellCssClass = "";
		$this->strwithpr->CellAttrs = array(); $this->strwithpr->ViewAttrs = array(); $this->strwithpr->EditAttrs = array();

		// strremarks
		$this->strremarks->CellCssStyle = ""; $this->strremarks->CellCssClass = "";
		$this->strremarks->CellAttrs = array(); $this->strremarks->ViewAttrs = array(); $this->strremarks->EditAttrs = array();

		// sap_num
		$this->sap_num->CellCssStyle = ""; $this->sap_num->CellCssClass = "";
		$this->sap_num->CellAttrs = array(); $this->sap_num->ViewAttrs = array(); $this->sap_num->EditAttrs = array();

		// work_days
		$this->work_days->CellCssStyle = ""; $this->work_days->CellCssClass = "";
		$this->work_days->CellAttrs = array(); $this->work_days->ViewAttrs = array(); $this->work_days->EditAttrs = array();

		// ID
		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->CssStyle = "";
		$this->ID->CssClass = "";
		$this->ID->ViewCustomAttributes = "";

		// strjrfnum
		$this->strjrfnum->ViewValue = $this->strjrfnum->CurrentValue;
		$this->strjrfnum->CssStyle = "";
		$this->strjrfnum->CssClass = "";
		$this->strjrfnum->ViewCustomAttributes = "";

		// strquarter
		$this->strquarter->ViewValue = $this->strquarter->CurrentValue;
		$this->strquarter->CssStyle = "";
		$this->strquarter->CssClass = "";
		$this->strquarter->ViewCustomAttributes = "";

		// strmon
		$this->strmon->ViewValue = $this->strmon->CurrentValue;
		$this->strmon->CssStyle = "";
		$this->strmon->CssClass = "";
		$this->strmon->ViewCustomAttributes = "";

		// stryear
		$this->stryear->ViewValue = $this->stryear->CurrentValue;
		$this->stryear->CssStyle = "";
		$this->stryear->CssClass = "";
		$this->stryear->ViewCustomAttributes = "";

		// strdate
		$this->strdate->ViewValue = $this->strdate->CurrentValue;
		$this->strdate->CssStyle = "";
		$this->strdate->CssClass = "";
		$this->strdate->ViewCustomAttributes = "";

		// strtime
		$this->strtime->ViewValue = $this->strtime->CurrentValue;
		$this->strtime->CssStyle = "";
		$this->strtime->CssClass = "";
		$this->strtime->ViewCustomAttributes = "";

		// strusername
		$this->strusername->ViewValue = $this->strusername->CurrentValue;
		$this->strusername->CssStyle = "";
		$this->strusername->CssClass = "";
		$this->strusername->ViewCustomAttributes = "";

		// strusereadd
		$this->strusereadd->ViewValue = $this->strusereadd->CurrentValue;
		$this->strusereadd->CssStyle = "";
		$this->strusereadd->CssClass = "";
		$this->strusereadd->ViewCustomAttributes = "";

		// strcompany
		$this->strcompany->ViewValue = $this->strcompany->CurrentValue;
		$this->strcompany->CssStyle = "";
		$this->strcompany->CssClass = "";
		$this->strcompany->ViewCustomAttributes = "";

		// strdepartment
		$this->strdepartment->ViewValue = $this->strdepartment->CurrentValue;
		$this->strdepartment->CssStyle = "";
		$this->strdepartment->CssClass = "";
		$this->strdepartment->ViewCustomAttributes = "";

		// strloc
		$this->strloc->ViewValue = $this->strloc->CurrentValue;
		$this->strloc->CssStyle = "";
		$this->strloc->CssClass = "";
		$this->strloc->ViewCustomAttributes = "";

		// strposition
		$this->strposition->ViewValue = $this->strposition->CurrentValue;
		$this->strposition->CssStyle = "";
		$this->strposition->CssClass = "";
		$this->strposition->ViewCustomAttributes = "";

		// strtelephone
		$this->strtelephone->ViewValue = $this->strtelephone->CurrentValue;
		$this->strtelephone->CssStyle = "";
		$this->strtelephone->CssClass = "";
		$this->strtelephone->ViewCustomAttributes = "";

		// strcostcent
		$this->strcostcent->ViewValue = $this->strcostcent->CurrentValue;
		$this->strcostcent->CssStyle = "";
		$this->strcostcent->CssClass = "";
		$this->strcostcent->ViewCustomAttributes = "";

		// strsubject
		$this->strsubject->ViewValue = $this->strsubject->CurrentValue;
		$this->strsubject->CssStyle = "";
		$this->strsubject->CssClass = "";
		$this->strsubject->ViewCustomAttributes = "";

		// strnature
		$this->strnature->ViewValue = $this->strnature->CurrentValue;
		$this->strnature->CssStyle = "";
		$this->strnature->CssClass = "";
		$this->strnature->ViewCustomAttributes = "";

		// strdescript
		$this->strdescript->ViewValue = $this->strdescript->CurrentValue;
		$this->strdescript->CssStyle = "";
		$this->strdescript->CssClass = "";
		$this->strdescript->ViewCustomAttributes = "";

		// strarea
		$this->strarea->ViewValue = $this->strarea->CurrentValue;
		$this->strarea->CssStyle = "";
		$this->strarea->CssClass = "";
		$this->strarea->ViewCustomAttributes = "";

		// strattach
		$this->strattach->ViewValue = $this->strattach->CurrentValue;
		$this->strattach->CssStyle = "";
		$this->strattach->CssClass = "";
		$this->strattach->ViewCustomAttributes = "";

		// strpriority
		$this->strpriority->ViewValue = $this->strpriority->CurrentValue;
		$this->strpriority->CssStyle = "";
		$this->strpriority->CssClass = "";
		$this->strpriority->ViewCustomAttributes = "";

		// strduedate
		$this->strduedate->ViewValue = $this->strduedate->CurrentValue;
		$this->strduedate->CssStyle = "";
		$this->strduedate->CssClass = "";
		$this->strduedate->ViewCustomAttributes = "";

		// strstatus
		$this->strstatus->ViewValue = $this->strstatus->CurrentValue;
		$this->strstatus->CssStyle = "";
		$this->strstatus->CssClass = "";
		$this->strstatus->ViewCustomAttributes = "";

		// strlastedit
		$this->strlastedit->ViewValue = $this->strlastedit->CurrentValue;
		$this->strlastedit->CssStyle = "";
		$this->strlastedit->CssClass = "";
		$this->strlastedit->ViewCustomAttributes = "";

		// strcategory
		$this->strcategory->ViewValue = $this->strcategory->CurrentValue;
		$this->strcategory->CssStyle = "";
		$this->strcategory->CssClass = "";
		$this->strcategory->ViewCustomAttributes = "";

		// strassigned
		$this->strassigned->ViewValue = $this->strassigned->CurrentValue;
		$this->strassigned->CssStyle = "";
		$this->strassigned->CssClass = "";
		$this->strassigned->ViewCustomAttributes = "";

		// strdatecomplete
		$this->strdatecomplete->ViewValue = $this->strdatecomplete->CurrentValue;
		$this->strdatecomplete->CssStyle = "";
		$this->strdatecomplete->CssClass = "";
		$this->strdatecomplete->ViewCustomAttributes = "";

		// strwithpr
		$this->strwithpr->ViewValue = $this->strwithpr->CurrentValue;
		$this->strwithpr->CssStyle = "";
		$this->strwithpr->CssClass = "";
		$this->strwithpr->ViewCustomAttributes = "";

		// strremarks
		$this->strremarks->ViewValue = $this->strremarks->CurrentValue;
		$this->strremarks->CssStyle = "";
		$this->strremarks->CssClass = "";
		$this->strremarks->ViewCustomAttributes = "";

		// sap_num
		$this->sap_num->ViewValue = $this->sap_num->CurrentValue;
		$this->sap_num->CssStyle = "";
		$this->sap_num->CssClass = "";
		$this->sap_num->ViewCustomAttributes = "";

		// work_days
		$this->work_days->ViewValue = $this->work_days->CurrentValue;
		$this->work_days->CssStyle = "";
		$this->work_days->CssClass = "";
		$this->work_days->ViewCustomAttributes = "";

		// ID
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

		// strjrfnum
		$this->strjrfnum->HrefValue = "";
		$this->strjrfnum->TooltipValue = "";

		// strquarter
		$this->strquarter->HrefValue = "";
		$this->strquarter->TooltipValue = "";

		// strmon
		$this->strmon->HrefValue = "";
		$this->strmon->TooltipValue = "";

		// stryear
		$this->stryear->HrefValue = "";
		$this->stryear->TooltipValue = "";

		// strdate
		$this->strdate->HrefValue = "";
		$this->strdate->TooltipValue = "";

		// strtime
		$this->strtime->HrefValue = "";
		$this->strtime->TooltipValue = "";

		// strusername
		$this->strusername->HrefValue = "";
		$this->strusername->TooltipValue = "";

		// strusereadd
		$this->strusereadd->HrefValue = "";
		$this->strusereadd->TooltipValue = "";

		// strcompany
		$this->strcompany->HrefValue = "";
		$this->strcompany->TooltipValue = "";

		// strdepartment
		$this->strdepartment->HrefValue = "";
		$this->strdepartment->TooltipValue = "";

		// strloc
		$this->strloc->HrefValue = "";
		$this->strloc->TooltipValue = "";

		// strposition
		$this->strposition->HrefValue = "";
		$this->strposition->TooltipValue = "";

		// strtelephone
		$this->strtelephone->HrefValue = "";
		$this->strtelephone->TooltipValue = "";

		// strcostcent
		$this->strcostcent->HrefValue = "";
		$this->strcostcent->TooltipValue = "";

		// strsubject
		$this->strsubject->HrefValue = "";
		$this->strsubject->TooltipValue = "";

		// strnature
		$this->strnature->HrefValue = "";
		$this->strnature->TooltipValue = "";

		// strdescript
		$this->strdescript->HrefValue = "";
		$this->strdescript->TooltipValue = "";

		// strarea
		$this->strarea->HrefValue = "";
		$this->strarea->TooltipValue = "";

		// strattach
		$this->strattach->HrefValue = "";
		$this->strattach->TooltipValue = "";

		// strpriority
		$this->strpriority->HrefValue = "";
		$this->strpriority->TooltipValue = "";

		// strduedate
		$this->strduedate->HrefValue = "";
		$this->strduedate->TooltipValue = "";

		// strstatus
		$this->strstatus->HrefValue = "";
		$this->strstatus->TooltipValue = "";

		// strlastedit
		$this->strlastedit->HrefValue = "";
		$this->strlastedit->TooltipValue = "";

		// strcategory
		$this->strcategory->HrefValue = "";
		$this->strcategory->TooltipValue = "";

		// strassigned
		$this->strassigned->HrefValue = "";
		$this->strassigned->TooltipValue = "";

		// strdatecomplete
		$this->strdatecomplete->HrefValue = "";
		$this->strdatecomplete->TooltipValue = "";

		// strwithpr
		$this->strwithpr->HrefValue = "";
		$this->strwithpr->TooltipValue = "";

		// strremarks
		$this->strremarks->HrefValue = "";
		$this->strremarks->TooltipValue = "";

		// sap_num
		$this->sap_num->HrefValue = "";
		$this->sap_num->TooltipValue = "";

		// work_days
		$this->work_days->HrefValue = "";
		$this->work_days->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
