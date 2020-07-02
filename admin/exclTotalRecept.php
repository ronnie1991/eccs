<?php
include_once("main.class.php");
$frmDt=base64_decode($_GET['frmDt']);
$toDate=base64_decode($_GET['toDate']);  
$data=$object->exporReceipt($frmDt,$toDate);
$data2=$object->exporShareMonyBydate($frmDt,$toDate);
$data3=$object->exporLoanIssuedToMbr($frmDt,$toDate);
$data4=$object->findTotalAmountLoanAccountBydate($frmDt,$toDate);
$data5=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDate);
$data6=$object->findAllBankInterestreceiptSBIbyDate($frmDt,$toDate);
$data7=$object->findTotalAmountBankInterestreceiptVCCBBydate($frmDt,$toDate);
$data8=$object->findTotalAmountDividendBydate($frmDt,$toDate);
$data9=$object->findTotalAmountwithdrawalSBIBydate($frmDt,$toDate);
$data10=$object->findTotalAmountWithdrawalVccbBydate($frmDt,$toDate);
$data11=$object->exporMiscellaneousBydateByList($frmDt,$toDate);
$gTR=$object->findTotalGrandTotalinReceiptsBydate($frmDt,$toDate);
 $sortedDate = strtotime($frmDt);
    $lastMonthDt=date("Y-m-d", strtotime("-1 month", $sortedDate));
    $opBlcDT=$object->openingBalanceInReceipt($lastMonthDt);
    $opBlc=$opBlcDT['balance'];
$gt=$gTR+$opBlc;   

$formatedFrmDate=date("d-m-Y", strtotime($frmDt));
$formatedTomDate=date("d-m-Y", strtotime($toDate));    
    
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    // file name for download
    $fileName = "total_recept($formatedFrmDate-$formatedTomDate)";
    
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
    echo  "\n";

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
    echo  "\n";

     $flag3 = false;
    foreach($data3 as $row) {
        if(!$flag3) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag3 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }    
    $totalLoanAmount='Total Loan Amount => '.$data4;
        // display column names as first row
        echo "\t\t\t".$totalLoanAmount . "\n";

    echo  "\n";
    
        // display column names as first row
        echo 'Admission Amountt => '.$data5 . "\n"; 

    echo  "\n"; 

       echo 'Bank Interest receipt S.B.I => '.$data6 . "\n";  

    echo  "\n"; 

       echo 'Bank Interest receipt V.C.C.B => '.$data7 . "\n"; 

    echo  "\n"; 

       echo 'Deposited to VCCB => '. "\n"; 

    echo  "\n"; 

       echo 'Dividend => '.$data8. "\n";

    echo  "\n"; 

       echo 'Withdrawal from S.B.I => '.$data9. "\n";

    echo  "\n"; 

       echo 'Withdrawal from V.C.C.B => '.$data10. "\n";
    
    echo  "\n";
    echo "\t\t".'Miscellaneous'. "\n";
    $flag11 = false;
    foreach($data11 as $row) {
        if(!$flag11) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag11 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }
    
    echo  "\n"; 

       echo 'Total Receipt => '.$gTR. "\n";

   echo  "\n"; 

   echo 'Opening Balance => '.$opBlc. "\n";
   echo  "\n"; 
   echo 'Graqnd Total => '.$gt. "\n";

   
    
    exit;

    //https://www.codexworld.com/export-data-to-excel-in-php/

    // google - export data to excel in php
?>