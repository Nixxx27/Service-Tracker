<?php

// Compatibility with PHP Report Maker 3
if (!isset($Language)) {
	include_once "ewcfg7.php";
	include_once "ewshared7.php";
	$Language = new cLanguage();
}
?>

<?php if (@$gsExport == "") { ?>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<?php } ?>
<meta name="generator" content="PHPMaker v7.0.0.0">
</head>
<body>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="js/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup7.php"; // lookup file name

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="js/ewp7.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="js/userfn7.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>

<?php } ?>
<?php if (@$gsExport == "") { ?>

<?php } ?>
