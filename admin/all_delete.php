<?php 

include_once('main.class.php');

if(isset($_POST['expMiscdel']))

{
	$object->delExpenditureMiscellaneous($_POST['expMiscdel']);
}

if(isset($_POST['emiDtlsId']))

{
	$object->delEmiLedger($_POST['emiDtlsId']);
}
if(isset($_POST['closigDtlsId']))

{
	$object->delClosingBalance($_POST['closigDtlsId']);
}
if(isset($_POST['emiDepVccb']))

{
	$object->delEmiDepositedVCCBB($_POST['emiDepVccb']);
}
if(isset($_POST['shareId']))

{
	$object->delShareMony($_POST['shareId']);
}

if(isset($_POST['receiptMisceDele']))

{
	$object->delReceiptMiscellaneous($_POST['receiptMisceDele']);
}


?>