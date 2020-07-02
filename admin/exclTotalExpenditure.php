<?php
//error_reporting(0);
include_once("main.class.php");
$frmDt=base64_decode($_GET['frmDt']);
$toDate=base64_decode($_GET['toDate']);  
$data=$object->exportTotalAmountDepositedVCCBBtDate($frmDt,$toDate);
$data2=$object->exportTotalAmountDividendByDate($frmDt,$toDate);
$data3=$object->exportTotalAmountDividendByDate($frmDt,$toDate);
$data4=$object->exportTotalAmountExpansesByDate($frmDt,$toDate);
$data5=$object->exporLoanIssuedToMbr($frmDt,$toDate);
$data6=$object->exportTotalCOOperativeShareBydate($frmDt,$toDate);
$data7=$object->exportBankDepositeforloanCgsByDt($frmDt,$toDate);
$data8=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDate);
$data9=$object->exportTotalSBIDepositedBydateList($frmDt,$toDate);
$data10=$object->exportTotalAmountExpanditureDepositedByDate($frmDt,$toDate);
$data11=$object->exportTotalSBIInterestByDate($frmDt,$toDate);
$data12=$object->exportTotalVCCBLedgrBydate($frmDt,$toDate);
$data14=$object->exportTotaExpenditureMiscellaneousBydateLIst($frmDt,$toDate);

$depositedVccb=$object->findTotalSumAmountDepositedVCCBBydate($frmDt,$toDate);
       $dividend=$object->findTotalAmountDividendBydate($frmDt,$toDate);
       $auditFee=$object->findTotalSumAmountAuditFeeBydate($frmDt,$toDate);
       $expancess=$object->findTotalSumAmounExpansesBydate($frmDt,$toDate);
       $loanAccoun=$object->findTotalAmountLoanAccountBydate($frmDt,$toDate);
       $cOOperativeShare=$object->findTotalSumAmounCOOperativeShareBydate($frmDt,$toDate);                  
       $sumCgsTotal=0;
       foreach($object->findTotalAmounLoanAccountBydate($frmDt,$toDate) as $con=>$row) {   
       $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
      $share=$object->findCOOperativeShare($row['loan_account_no']);              
      $cgs10=($cgsTotal+(($cgsTotal*10)/100));
      $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount']));
      $cgsTotal=$cgs10+$scdDeposite;
      $sumCgsTotal=$sumCgsTotal+$cgsTotal;

      }                  

                     
       $afdb=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDate);                   
       $sbid=$object->findTotalSBIDepositedBydate($frmDt,$toDate); 
       $depositedVccbSum=$object->findTotalSumAmountExpanditureDepositedVCCBBydate($frmDt,$toDate);                     
       $expMisc=$object->findSumOfExpenditureMiscellaneousBydate($frmDt,$toDate); 
       $texp=($depositedVccb+$dividend+$auditFee+$expancess+$loanAccoun+$cOOperativeShare+$sumCgsTotal+$afdb+$depositedVccbSum+$sbid+$expMisc); 

$sortedDate = strtotime($frmDt);
$lastMonthDt=date("Y-m-d", strtotime("-1 month", $sortedDate));
$opBlcDT=$object->openingBalanceInReceipt($lastMonthDt);
$opBlc=$opBlcDT['balance'];
 $gTR=$object->findTotalGrandTotalinReceiptsBydate($frmDt,$toDate);                           
        $gt=$gTR+$opBlc;
        $cb=$gt-$texp;      
   

$formatedFrmDate=date("d-m-Y", strtotime($frmDt));
$formatedTomDate=date("d-m-Y", strtotime($toDate));    
    
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    
    // file name for download
    $fileName = "total_expenditure($formatedFrmDate-$formatedTomDate)";
    
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
    echo "\t".'Dividend To Bank Account'. "\n";
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
    echo "\t".'Audit Fee'. "\n";
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

    echo  "\n";
    echo "\t".'Expenses'. "\n";
    $flag4 = false;
    foreach($data4 as $row) {
        if(!$flag4) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag4 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

    echo  "\n";
    echo "\t".'Loan issued to member'. "\n";

    $flag5 = false;
    foreach($data5 as $row) {
        if(!$flag5) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag5 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }
     echo  "\n";
    echo "\t".'CO-Operative Share (Loan)'. "\n";
     
    $flag6 = false;
    foreach($data6 as $row) {
        if(!$flag6) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag6 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

     echo  "\n";
    echo "\t".'Bank Deposit for Loan (C.G.S)'. "\n";     
    $flag7 = false;
    foreach($data7 as $row) {
        if(!$flag7) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag7 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

     echo  "\n";
    echo "\t".'Admission Fees Deposited to Bank'. "\n";     
    echo 'From-'.$formatedFrmDate.'To'.$formatedTomDate.'=>'.$data8 . "\n";

     echo  "\n";
    echo "\t".'SBI Deposited (33974632653)'. "\n";     
    $flag9 = false;
    foreach($data9 as $row) {
        if(!$flag9) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag9 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

    echo  "\n";
    echo "\t".'Deposited to VCCB'. "\n";     
    $flag10 = false;
    foreach($data10 as $row) {
        if(!$flag10) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag10 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

     echo  "\n";
    echo "\t".'S.B.I'. "\n";     
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
    echo "\t".'V.C.C.B'. "\n";     
    $flag12 = false;
    foreach($data12 as $row) {
        if(!$flag12) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag12 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

    echo  "\n";
    echo "\t".'Miscellaneous'. "\n";     
    $flag14 = false;
    foreach($data14 as $row) {
        if(!$flag14) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag14 = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

    echo  "\n";
    echo "\t".'Total Total Expanses => '.$texp. "\n";

    echo  "\n";
    echo "\t".'Closing Balance => '.$cb. "\n";

    echo  "\n";
    echo "\t".'Closing Balance => '.($cb+$texp). "\n";

     
    exit;

    
?>