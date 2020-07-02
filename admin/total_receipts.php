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
          Eccs Receipt.  <?= date("d-M-Y", strtotime($frmDt));?> To <?= date("d-M-Y", strtotime($toDt));?>         
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Total Receipt </a></li>            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Receipt</h3>
                <div class="col-sm-3 pull-right">
                <a class="btn" style="padding: 0px 12px;background:#dddddd;color: #080808;" href="exclTotalRecept?frmDt=<?=$_GET['frmDt']?>&toDate=<?= $_GET['toDt'];?>"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<b>Excel ?</b></a>

                      &nbsp;&nbsp;<a class="btn" style="padding:  0px 1px;background:#dddddd;color: #080808; " href="printCashBookRecept?frmDt=<?=$_GET['frmDt']?>&toDt=<?= $_GET['toDt'];?>" target="_blank"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-print"></i>&nbsp;&nbsp;<b>Print-Out?</b></a>  
                </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered table-striped">				 
                    <thead>
                      <tr>
                        <th>Particulars </th>
                        <th>Bank Amount (Principal)</th>
                        <th>Cash Amount (Interest)</th>
                        <th>Total Under Each Head</th>                       
                      </tr>
                    </thead>
                    <tbody>
    					  <?php 
                   $emiPrincipalSum=$object->findTotalAmountEMIPrincipalLedgrBydate($frmDt,$toDt);
                    $emiInterestSum=$object->findTotalAmountEMIInterestLedgrBydate($frmDt,$toDt);
                    $toEH=$emiPrincipalSum+$emiInterestSum;
    				     	?>
                      <tr>
                        <td><?= 'EMI';?></td>
                        <td><?= $emiPrincipalSum;?></td>
                        <td><?= $emiInterestSum;?></td>
                        <td><?= $toEH;?></td>                
                      </tr>					         
                    </tbody>                    
                  </table>

                  <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                   $shareMoneySum=$object->findTotalAmountCallMoneyBydate($frmDt,$toDt);               
                  ?>
                      <tr>
                        <td><?= 'Share Money';?></td>
                        <td><?= $shareMoneySum;?></td>                                 
                      </tr>                  
                    </tbody>                    
                  </table>
                  

                  <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $cgsSum=$object->findTotalAmountCGSLedgrBydate($frmDt,$toDt);               
                    ?>
                    <tr>
                      <td><?= 'CGS';?></td>
                      <td><?= $cgsSum;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>

                 <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $scdSum=$object->findTotalAmountLoanLedgerBydate($frmDt,$toDt);
                       $shareMoneySumByLN=$object->findTotalAmountCallMoneyBydateAndLoanAcNo($frmDt,$toDt); 
                       $scdWithdrawl=(($scdSum)-($cgsSum+$shareMoneySumByLN));                
                    ?>
                    <tr>
                      <td><?= 'SCD Withdrawal (Loan)';?></td>
                      <td><?= $scdWithdrawl;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>                 
                                  
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
                    <tbody>
                  <?php 
                     $totalLoan=$object->findTotalAmountLoanLedgerBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Total Loan Amount';?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td ><?= $totalLoan;?></td>                                 
                    </tr>                 
                    </tbody>                    
                  </table>
                  <br>

                   <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $totalMemberAdminFee=$object->findAllMembrAdmissionFeesByDate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Admission Amount';?></td>
                      <td><?= $totalMemberAdminFee;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $totalBankInterestreceiptSBI=$object->findAllBankInterestreceiptSBIbyDate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Bank Interest receipt S.B.I';?></td>
                      <td><?= $totalBankInterestreceiptSBI;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                 <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $totalBankInterestreceiptVCCB=$object->findTotalAmountBankInterestreceiptVCCBBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Bank Interest receipt V.C.C.B';?></td>
                      <td><?= $totalBankInterestreceiptVCCB;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">
                   
                    <tbody>
                  
                    <tr>
                      <td><?= 'Deposited to VCCB';?></td>
                      <td><?= '';?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $totalDividend=$object->findTotalAmountDividendBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Dividend';?></td>
                      <td><?= $totalDividend;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                 <table class="table table-bordered table-striped">
                   
                    <tbody>
                  <?php 
                     $totalwithdrawalSBI=$object->findTotalAmountwithdrawalSBIBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Withdrawal from S.B.I ';?></td>
                      <td><?= $totalwithdrawalSBI;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">                   
                    <tbody>
                  <?php 
                     $totalwithdrawalVccb=$object->findTotalAmountWithdrawalVccbBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Withdrawal from V.C.C.B ';?></td>
                      <td><?= $totalwithdrawalVccb;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">  
                   <tr><td><h4>Miscellaneous</h4></td></tr>
                 <thead>
                      <tr>
                        <th>Date</th>
                        <th>Reasone</th>
                        <th>Amount</th>                     
                      </tr>
                    </thead>                 
                    <tbody>
                  <?php 
                    foreach ($object->findTotalAmountMiscellaneousBydateByList($frmDt,$toDt) as $miscellaneous) {  ?>
                    <tr>
                      <td><?= date("d-M-Y", strtotime($miscellaneous['miscellaneous_date']));?></td>
                      <td><?= $miscellaneous['reson_miscellaneous'];?></td> 
                      <td><?= $miscellaneous['miscellaneous_amount'];?></td>                                
                    </tr>
                  <?php } ?>                  
                  </tbody>                    
                </table>
                 <table class="table table-bordered table-striped">                   
                    <tbody>
                  <?php 
                    $gTR=$object->findTotalGrandTotalinReceiptsBydate($frmDt,$toDt);                                      
                    ?>
                    <tr>
                      <td><?= 'Total Receipt';?></td>
                      <td><?= $gTR;?></td>                                 
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
                    
                                                  
                    ?>
                    <tr>
                      <td><?= 'Opening Balance';?></td>
                      <td><?= $opBlc;?></td>                                 
                    </tr>                  
                  </tbody>                    
                </table>
                <table class="table table-bordered table-striped">                   
                    <tbody>
                  <?php 
                   
                   $gt=$gTR+$opBlc;                                    
                    ?>
                    <tr>
                      <td><?= 'Graqnd Total';?></td>
                      <td><?= $gt;?></td>                                 
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
