<?php include_once('main.class.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> ECCS | Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
       
      
      <!-- Left side column. contains the logo and sidebar -->
      <?php 
            $frmDt=base64_decode($_GET['frmDt']);
            $toDt=base64_decode($_GET['toDt']);
            $formatedfrmDt=date("d-m-Y", strtotime($frmDt));
            $formatedtoDt=date("d-m-Y", strtotime($toDt));
       ?>
      
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">        
          <h1>
         Eccs Cash Book Expenditure (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
          </h1>
          <ol class="breadcrumb">      
            <li ><i style="font-weight: 400; font-size: 16px;cursor: pointer; " onclick="myFunction()" class="fa fa-print">&nbsp;&nbsp;Print?</i></li>
          </ol>
        </section>
          
        <!-- Main content -->
        
        <section class="content">
          <div class="row">

            <div class="col-xs-12">
               <div style="text-align: center;" >
             <br> <p style="font-size: 16px;font-weight: 600;">MEDINIPUR SADAR EAST SCHOOL EMPLOYEES CO-OPERATIVE CREDIT SOCIETY LTD</p>
              <p style="font-size: 16px;">Reg.No-7 PAS-MED &nbsp;&nbsp; Date-08.10.2013</p>
              <b style="font-size: 18px;" >Cash Book Expenditure (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>  
            <div class="box">


                <div class="box-body">
          <table class="table table-bordered table-striped">
                    <thead>
                      
                      <tr>
                        <th>Date </th>  
                        <th>Particulars</th>             
                        <th>Voucher</th>
                        <th>Bank Amount (Principal)</th>
                        <th>Cash Amount (Interest)</th>                       
                        <th>Total Under Each Head</th>                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td><h4>EMI Deposited to VCCB</h4></td></tr>
            <?php 
               foreach ($object->findTotalAmountDepositedVCCBBydate($frmDt,$toDt) as $dvr) {         
              ?>

                      <tr>
                        <td><?= date("d-m-Y",strtotime($dvr['date']));?></td> 
                        <td><?= $dvr['particulars'];?></td>                        
                        <td><?= $dvr['voucher'];?></td>    
                        <td><?= $dvr['bank_amount'];?></td> 
                        <td><?= $dvr['cash_amount'];?></td> 
                        <td><?= $dvr['total'];?></td>             
                      </tr>   
             <?php } ?>                        
                    </tbody>                    
                  </table>

                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Dividend To Bank Account</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                  foreach ($object->findTotalAmountDividendBydateListed($frmDt,$toDt) as $dividend) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($dividend['date']));?></td>
                        <td><?= $dividend['amount'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  

                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Audit Fee</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findTotalAmountaddAuditFeeBydate($frmDt,$toDt) as $auditFee) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($auditFee['receiving_date']));?></td>
                        <td><?= $auditFee['amount'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>

                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Expenses</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Particulars</th> 
                        <th>Expanses Amount</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findTotalAmounExpansesBydate($frmDt,$toDt) as $expenses) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($expenses['date']));?></td>
                        <td><?= $expenses['particulars'];?></td>     
                        <td><?= $expenses['amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                 
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Loan issued to member</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Particulars</th> 
                        <th>Type of loan</th> 
                        <th>Loan Amount</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findTotalLoanAccountBydate($frmDt,$toDt) as $lim) {
                   $snglSociMbr=$object->singelSocietyMBRDtls($lim['ledger_folio']);           
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($lim['loan_date']));?></td>
                        <td><?= $snglSociMbr['member_name'];?></td>     
                        <td><?= $lim['type_loan'];?></td>
                        <td><?= $lim['loan_amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>

                    <table class="table table-bordered table-striped">
                   <thead>
                      <h4>CO-Operative Share (Loan)</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Loan Account Number</th> 
                        <th>Share Amount</th>                                                                
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findTotalAmounCOOperativeShareBydate($frmDt,$toDt) as $coops) {                            
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($coops['date']));?></td>                          
                        <td><?= $coops['loan_account_no'];?></td>
                        <td><?= $coops['share_amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Bank Deposit for Loan (C.G.S)</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Type of Loan</th> 
                        <th>C.G.S</th>                        
                        <th>S.C.D</th>  
                        <th>Total</th>                                                             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach($object->findTotalAmounLoanAccountBydate($frmDt,$toDt) as $con=>$row) {   
                   $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
                  $share=$object->findCOOperativeShare($row['loan_account_no']);              
                  $cgs10=($cgsTotal+(($cgsTotal*10)/100));
                  $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount']));                          
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($row['loan_date']));?></td>                          
                        <td><?= $row['loan_type'];?></td>
                        <td><?= $cgs10;?></td>                         
                        <td><?= $scdDeposite;?></td>  
                        <td><?= ($cgs10+$scdDeposite);?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Admission Fees Deposited to Bank</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     $afdb=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDt);                         
                  ?>
                      <tr>
                        <td> <?= $frmDt;?> TO <?=$toDt;?></td>                          
                        <td><?= $afdb;?></td>
                                            
                      </tr>  
                               
                    </tbody>                    
                  </table>
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>SBI Deposited (33974632653)</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalSBIDepositedBydateList($frmDt,$toDt) as $sbid) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($sbid['date']));?></td>                          
                        <td><?= $sbid['amount'];?></td>
                                            
                      </tr>  
                   <?php } ?>            
                    </tbody>                    
                  </table>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Deposited to VCCB</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Name of the Account</th> 
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalAmountExpanditureDepositedVCCBBydate($frmDt,$toDt) as $dVccb) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($dVccb['deposite_date']));?></td>                          
                        <td><?= $dVccb['name_of_account'];?></td>
                        <td><?= $dVccb['deposite_amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 style="text-align: center;">Interest to Account</h4>
                      <h4>S.B.I</h4>
                      <tr>
                        <th>Date</th>    
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     $totalSbiInterstAc=0;
                     foreach ($object->findAllSBIInterest($frmDt,$toDt) as $sbiInterest) {  
                     $totalSbiInterstAc=$totalSbiInterstAc+$sbiInterest['receive_amount'];                   
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($sbiInterest['date']));?></td>                          
                        <td><?= $sbiInterest['receive_amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                                        
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4>V.C.C.B</h4>
                      <tr>
                        <th>Date</th>
                        <th>Account Name</th>    
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     $totalVCCBInterset=0;
                     foreach ($object->findTotalVCCBLedgrBydate($frmDt,$toDt) as $vccbInterest) {   
                     $totalVCCBInterset=$totalVCCBInterset+$vccbInterest['amount'];                  
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($vccbInterest['recev_date']));?></td>  
                        <td><?= $vccbInterest['account_name'];?></td>                        
                        <td><?= $vccbInterest['amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                                        
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Miscellaneous</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Miscellaneous Reasone</th> 
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalAmountExpenditureMiscellaneousBydateLIst($frmDt,$toDt) as $expMisc) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($expMisc['miscellaneous_date']));?></td>                          
                        <td><?= $expMisc['reson_miscellaneous'];?></td>
                        <td><?= $expMisc['miscellaneous_amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <?php 
                   $depositedVccb=$object->findTotalSumAmountDepositedVCCBBydate($frmDt,$toDt);
                   $dividend=$object->findTotalAmountDividendBydate($frmDt,$toDt);
                   $auditFee=$object->findTotalSumAmountAuditFeeBydate($frmDt,$toDt);
                   $expancess=$object->findTotalSumAmounExpansesBydate($frmDt,$toDt);
                   $loanAccoun=$object->findTotalAmountLoanAccountBydate($frmDt,$toDt);
                   $cOOperativeShare=$object->findTotalSumAmounCOOperativeShareBydate($frmDt,$toDt);                  
                   $sumCgsTotal=0;
                   foreach($object->findTotalAmounLoanAccountBydate($frmDt,$toDt) as $con=>$row) {   
                   $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
                  $share=$object->findCOOperativeShare($row['loan_account_no']);              
                  $cgs10=($cgsTotal+(($cgsTotal*10)/100));
                  $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount']));
                  $cgsTotal=$cgs10+$scdDeposite;
                  $sumCgsTotal=$sumCgsTotal+$cgsTotal;

                  }                  

                                 
                   $afdb=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDt);                   
                   $sbid=$object->findTotalSBIDepositedBydate($frmDt,$toDt); 
                   $depositedVccbSum=$object->findTotalSumAmountExpanditureDepositedVCCBBydate($frmDt,$toDt);                     
                   $expMisc=$object->findSumOfExpenditureMiscellaneousBydate($frmDt,$toDt); 
                   $texp=($depositedVccb+$dividend+$auditFee+$expancess+$loanAccoun+$cOOperativeShare+$sumCgsTotal+$afdb+$depositedVccbSum+$sbid+$totalSbiInterstAc+$totalVCCBInterset+$expMisc); 

                  ?>
                  <table class="table table-bordered table-striped">
                   
                    <tbody>
                  
                      <tr>
                        <td> <?= "Total Total Expanses";?></td>                          
                        <td><?= $texp;?></td>                   
                      </tr>  
                            
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   
                    <tbody>
                     <?php 
                       $sortedDate = strtotime($frmDt);
                      $lastMonthDt=date("Y-m-d", strtotime("-1 month", $sortedDate));
                      $opBlcDT=$object->openingBalanceInReceipt($lastMonthDt);
                      if($opBlcDT=='')
                      {
                        $opBlc=0; 
                      }
                      if($opBlcDT!='')
                      {
                        $opBlc=$opBlcDT['balance'];
                      }
                      $gTR=$object->findTotalGrandTotalinReceiptsBydate($frmDt,$toDt);                           
                            $gt=$gTR+$opBlc;
                            $cb=$gt-$texp; 
                            $chkClosingBlance=$object->chkClosingBalanceExe($frmDt);
                            if($chkClosingBlance==0)
                            {
                              $inserClosingBlance=$object->insertClosingBlance($frmDt,$cb);
                            }
                     ?>
                      <tr>
                        <td> <?= "Closing Balance";?></td>                          
                        <td><?= $cb;?></td>                   
                      </tr>  
                            
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   
                    <tbody>
                     
                      <tr>
                        <td> <?= "Grand Total";?></td>                          
                        <td><?= $cb+$texp;?></td>                   
                      </tr>  
                            
                    </tbody>                    
                  </table>
                

                </div><!-- /.box-body -->
              </div><!-- /.box --> 
              <br>             
              <div class="col-xs-4">
              	<table>
              	<tr>
              		<td>___________________________</td>              		
              	</tr>
              	<tr>
              		<td>Chairman of the Society</td>              		
              	</tr>
              	</table>
              </div>
              <div class="col-xs-4">
              	<table>
              	<tr>
              		<td>___________________________</td>              		
              	</tr>
              	<tr>
              		<td>Secretary of the Society</td>              		
              	</tr>
              	</table>
              </div>
              <div class="col-xs-4">
              	<table>
              	<tr>
              		<td>______________________________</td>              		
              	</tr>
              	<tr>
              		<td>Supervisor of the Bank (EC No........)</td>              		
              	</tr>
              	</table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      function myFunction() {
        window.print();
        }

      $(function () {        
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
