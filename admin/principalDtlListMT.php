<?php
include_once("main.class.php");  
$frmDt=base64_decode($_GET['frmDt']);
$toDt=base64_decode($_GET['toDate']);
  $data=$object->exportPrincipalDtlsLedgerMTBtDate($frmDt,$toDt);
  $data2=$object->exportPrincipalDtlsLedgerMTBtDateDepositToBank($frmDt,$toDt);
   
    
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    // file name for download
    $fileName = "principal-dtls-of-MT($frmDt-$toDt)";
    
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    
    $flag = false;
    foreach($data as $row) {
        if(!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }
    
    $flag2 = false;
    foreach($data2 as $row) {
        if(!$flag2) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag2 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }
    exit;

    //https://www.codexworld.com/export-data-to-excel-in-php/

    // google - export data to excel in php
?>