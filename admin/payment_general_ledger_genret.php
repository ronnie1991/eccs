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
       <?php include_once('header.php'); ?>
      
      <!-- Left side column. contains the logo and sidebar -->
      <?php include_once('left_asid.php');
        $frmDt=base64_decode($_GET['frmDt']);
        $toDt=base64_decode($_GET['toDt']);
       //$singlMembr=$object->singelSocietyMBRDtls($memID);
       ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Medinipur Sadar East School Eccs Ltd.         
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Total Expenditure </a></li>            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Payment  -> <b> a  </b></h3>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
          <table class="table table-bordered table-striped">
				  <div class="col-sm-3">
				  <div class="dataTables_length" id="example1_length"><label>
				  Filter By Month 
				  <select name="example1_length" aria-controls="example1" class="form-control input-sm">
				  <option value="">Year</option>
				  <?php for($i=2000;$i<=2025;$i++) { ?>
				  <option value="<?= $i;?>"><?= $i;?></option>
                  <?php } ?>				  
				  </select></label>
				  </div></div>
                    <thead>
                      
                      <tr>
                        <th>Date </th> 
                        <th>Particulars </th>                                               
                        <th>Amount</th>                       
                      </tr>
                    </thead>
                    <style type="text/css">
                      .hedercs{
                        color: #008000;
                        font-size: 20px;
                        font-weight: 600;
                      }
                    </style>
                    <tbody>
                      <tr><td><h4 class="hedercs">Miscellaneous</h4></td></tr>
					  <?php 
               foreach ($object->findAllExpenditureMiscellaneousBydate($frmDt,$toDt) as $expMisc) {         
				     	?>

                      <tr>
                        <td><b><?= date("d-m-Y",strtotime($expMisc['miscellaneous_date']));?></b></td> 
                        <td><b><?= $expMisc['reson_miscellaneous'];?></b></td>                      
                        <td><b><?= $expMisc['miscellaneous_amount'];?></b></td>             
                      </tr>		
             <?php } ?>         			         
                    </tbody>                    
                  </table>

                  <table class="table table-bordered table-striped">
                     <tr><td><h4 class="hedercs">Share To Bank Account</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                  <tr><td><b>Share Deposited To Bank</b></td> </tr>                 
                  <?php 
                  foreach ($object->findAllShareMoneyByDate($frmDt,$toDt) as $sharedB) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($sharedB['receiving_date']));?></td>
                        <td><?= $sharedB['receiving_amount'];?></td>                                 
                      </tr>  
                   <?php } ?> 
                   <tr><td><b>CO-Operative Share</b></td> </tr> 
                   <?php 
                  foreach ($object->findTotalAmounCOOperativeShareBydate($frmDt,$toDt) as $coopSharedB) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($coopSharedB['date']));?></td>
                        <td><?= $coopSharedB['share_amount'];?></td>                                 
                      </tr>  
                   <?php } ?>              
                    </tbody>                    
                  </table>
                  

                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">Admission To Bank</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findAllMembrAdmissionFeesBetwnDt($frmDt,$toDt) as $admisionTBnk) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($admisionTBnk['recv_date']));?></td>
                        <td><?= $admisionTBnk['amount_recv'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>

                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">Expanses</h4>
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
                      <h4 class="hedercs">MT Loan Issue</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Loan Amount</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findAllMTLoanLedgerBYDate($frmDt,$toDt) as $mtLoanIsu) {                           
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($mtLoanIsu['loan_date']));?></td>                        
                        <td><?= $mtLoanIsu['loan_amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">ST Loan Issue</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Loan Amount</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findAllSTLoanLedgerBYDate($frmDt,$toDt) as $mtLoanIsu) {                           
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($mtLoanIsu['loan_date']));?></td>                        
                        <td><?= $mtLoanIsu['loan_amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>

                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">S.C.D Deposite</h4>
                      <tr>
                        <th>Date</th>                         
                        <th>S.C.D Amount</th>                                                                
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
                        <td><?= $scdDeposite;?></td>                                                
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>  
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">CGS to Bank</h4>
                      <tr>
                        <th>Date</th>                         
                        <th>C.G.S Amount</th>                                                                
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($object->findTotalAmounLoanAccountBydate($frmDt,$toDt) as $row) {  
                   $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']);                                
                  $cgs10=($cgsTotal+(($cgsTotal*10)/100));                                             
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($row['loan_date']));?></td>                          
                        <td><?= $cgs10;?></td>                                                
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>               
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">MT Principal Repay</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                   <?php 
                     foreach ($object->findTotalAmountDepositedVCCBBydate($frmDt,$toDt) as $dvr) {         
                   ?>
                      <tr>
                        <td><?= date("d-m-Y",strtotime($dvr['date']));?></td>                    
                        <td><?= $dvr['bank_amount'];?></td>
                                            
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">MT Interest Repay</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalAmountDepositedVCCBBydate($frmDt,$toDt) as $dvr) {         
                   ?>
                      <tr>
                        <td><?= date("d-m-Y",strtotime($dvr['date']));?></td>                    
                        <td><?= $dvr['cash_amount'];?></td>
                                            
                      </tr>  
                      <?php } ?>   
                               
                    </tbody>                    
                  </table>                 
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">Deposited to S.B.I Current</h4>
                      <tr>
                        <th>Date</th>                     
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findAllSBIDepositedBydate($frmDt,$toDt) as $dVccb) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($dVccb['date']));?></td>                
                        <td><?= $dVccb['amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">Divident</h4>
                      <tr>
                        <th>Date</th>                 
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalAmountDividendBydateListed($frmDt,$toDt) as $dividendExpanse) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($dividendExpanse['date']));?></td>   
                        <td><?= $dividendExpanse['amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4 class="hedercs">Audit Fees</h4>
                      <tr>
                        <th>Date</th>                 
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                     foreach ($object->findTotalAmountaddAuditFeeBydate($frmDt,$toDt) as $auditFees) {                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($auditFees['receiving_date']));?></td>   
                        <td><?= $auditFees['amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                   <tr><td><h4 class="hedercs">Bank Interest to Account</h4></td></tr>
                  <table class="table table-bordered table-striped">
                    
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                  <tr><td><b>S.B.I(Current)</b></td> </tr>                 
                  <?php 
                  foreach ($object->findAllSBIInterest($frmDt,$toDt) as $sbiIntrs) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($sbiIntrs['date']));?></td>
                        <td><?= $sbiIntrs['receive_amount'];?></td>                                 
                      </tr>  
                   <?php } ?> 
                   <tr><td><b>V.C.C.B</b></td> </tr> 
                   <?php 
                  foreach ($object->findTotalVCCBLedgrBydate($frmDt,$toDt) as $vccbLedgr) {         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($vccbLedgr['recev_date']));?></td>
                        <td><?= $vccbLedgr['amount'];?></td>                                 
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
                   //Bank Deposit for Loan (C.G.S) 
                   $afdb=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDt);
                   $sdb=$object->findTotalAmountCallMoneyBydate($frmDt,$toDt); 
                   $sbid=$object->findTotalSBIDepositedBydate($frmDt,$toDt);   
                   $widrlSBI=$object->findTotalAmountDepositedwalVCCBBydateByDate($frmDt,$toDt);  
                   $texp=($depositedVccb+$dividend+$auditFee+$expancess+$loanAccoun+$cOOperativeShare+$afdb+$sdb+$sbid+$widrlSBI); 

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
                     <?php  $gTR=$object->findTotalGrandTotalinReceiptsBydate($frmDt,$toDt);
                            $opBlcDT=$object->openingBalanceInReceipt();
                            $opBlc=$opBlcDT['balance'];
                            $gt=$gTR+$opBlc;
                            $cb=$gt-$texp;
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
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once('footer.php');?>
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
   
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
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
