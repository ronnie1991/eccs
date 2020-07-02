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
         Receipt General Ledger (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
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
              <b style="font-size: 18px;" >Receipt General Ledger (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>  
            <div class="box">


                <div class="box-body" >
                  
                  <table class="table table-bordered table-striped">                     
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                  foreach ($object->findAllShareMoneyByMonth($frmDt,$toDt) as $stb) { 
                  $month=$object->numrcMonth($stb['month']);                         
                  ?>
                      <tr>
                        <td><?= $month;?> - <?=$stb['year'];?></td>
                         <td><?= $stb['amount'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody> 
                  <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800; ">  Share Collection </b>                                 
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Share Collection - <?= $object->findTotalAmountCallMoneyBydate($frmDt,$toDt);?></b>   
                  <br>

                  <table class="table table-bordered table-striped">
                     
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                       foreach ($object->findAllMembrAdmissionFeesBetwnDt($frmDt,$toDt) as $admissionFees) {
                      ?> 
                       <tr>                                           
                        <td><?= date("d-m-Y", strtotime($admissionFees['recv_date']));?></td>  
                        <td><?= $admissionFees['amount_recv'];?></td>  
                        </tr> 
                        <?php } ?>  

                    </tbody> 
                    <br>
                    <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800;">  Admission Fees </b>                   
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Admission Fees - <?= $object->findAllMembrAdmissionFeesByDate($frmDt,$toDt);?></b>  
                  <br>

                  <table class="table table-bordered table-striped">
                     
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php
                       $toMTLaon=0;   
                       foreach ($object->findTotalMTLoanAccountByMonth($frmDt,$toDt) as $mTLoanAccount) {
                       $toMTLaon=$toMTLaon+$mTLoanAccount['amount'];
                       $month=$object->numrcMonth($mTLoanAccount['month']); 
                      ?>
                       <tr>   
                        <td><?=$month;?> - <?=$mTLoanAccount['year'];?></td>              
                        <td><?= $mTLoanAccount['amount'];?></td> 
                        </tr>       
                        <?php } ?>  

                    </tbody>    
                    <br>
                    <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800;">  M.T from Bank </b>                  
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total M.T from Bank - <?= $toMTLaon;?></b>  
                  <br>

                  <table class="table table-bordered table-striped">
                     <tr><td><h4>S.T Loan</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                        $toStLaon=0;   
                       foreach ($object->findTotalSTLoanAccountByMonth($frmDt,$toDt) as $stLoanAccount) {
                        $toStLaon=$toStLaon+$stLoanAccount['amount'];
                        $month=$object->numrcMonth($stLoanAccount['month']); 
                      ?> 
                        <tr>  
                        <td><?= $month;?> - <?=$stLoanAccount['year'];?></td>
                        <td><?= $stLoanAccount['amount'];?></td>  
                        </tr>                        
                        <?php } ?>

                    </tbody>
                    <br>
                     <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800;">  S.T Loan from Bank </b>                        
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.T Loan from Bank - <?= $toStLaon;?></b>  
                  <br>

                  <table class="table table-bordered table-striped">
                     
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                      $totalCgs=0;  
                       foreach ($object->findTotalCGSLedgrByMonth($frmDt,$toDt) as $cGSLedgr) {
                       $totalCgs=$totalCgs+$cGSLedgr['amount']; 
                       $month=$object->numrcMonth($cGSLedgr['month']);
                      ?> 
                        <tr>  
                        <td><?= $month;?> - <?=$cGSLedgr['year'];?></td>             
                        <td><?= $cGSLedgr['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>
                    <br>
                     <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800;"> C.G.S Collection </b>                    
                  </table>
                   <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total C.G.S Collection -
                    <?= $totalCgs;?></b>  
                   <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Principal (M.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                       $totalMTEmi=0;  
                       foreach ($object->findAllEmiLedgerMTLoanByMonth($frmDt,$toDt) as $mTPrincipal) {
                       $totalMTEmi=$totalMTEmi+$mTPrincipal['amount']; 
                       $month=$object->numrcMonth($mTPrincipal['month']);
                      ?> 
                        <tr>  
                       <td><?= $month;?> -  <?=$mTPrincipal['year'];?></td>                                         
                         <td><?= $mTPrincipal['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>
                    <br>
                     <b style="font-size:18px;margin-left: 25%;color:#bf02b9;font-weight: 800;"> Principal (M.T)</b>                       
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Principal (M.T) -
                    <?= $totalMTEmi;?></b>  
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Principal (S.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php
                       $totalSTEmi=0;  
                       foreach ($object->findAllEmiLedgerSTLoanByMonth($frmDt,$toDt) as $sTPrincipal) {
                        $totalSTEmi=$totalSTEmi+$sTPrincipal['amount'];
                        $month=$object->numrcMonth($sTPrincipal['month']);
                      ?> 
                        <tr>  
                        <td><?= $month;?> - <?=$sTPrincipal['year'];?></td> 
                        <td><?= $sTPrincipal['amount'];?></td>   
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                   <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Principal (S.T) -
                    <?= $totalSTEmi;?></b>  
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Interest (M.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php
                        $totalMTInterest=0;   
                        foreach ($object->findAllEmiInterestLedgerMTLoanByMonth($frmDt,$toDt) as $mTInterest) {
                          $totalMTInterest=$totalMTInterest+$mTInterest['amount'];
                          $month=$object->numrcMonth($mTInterest['month']);
                      ?> 
                        <tr>  
                         <td><?= $month;?> -  Year- <?=$mTInterest['year'];?></td>                                          
                        <td><?= $mTInterest['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Interest (M.T) - <?= $totalMTInterest;?>
                    </b> 
                  
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Interest (S.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                        $totalSTInterest=0;
                        foreach ($object->findAllEmiInterestLedgerSTLoanByMonth($frmDt,$toDt) as $sTInterest) {
                          $totalSTInterest=$totalSTInterest+$sTInterest['amount'];
                          $month=$object->numrcMonth($sTInterest['month']);
                      ?> 
                        <tr>  
                        <td> <?= $month;?> - <?=$sTInterest['year'];?></td>                                          
                        <td><?= $sTInterest['amount'];?></td>   
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Interest (S.T) - <?= $totalSTInterest;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Withdrawl Current A/C (S.B.I)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php
                        $totalwFSBI=0; 
                        foreach ($object->findAllWithdrawlFromSBIByMonth($frmDt,$toDt) as $wFSBI) {
                        $totalwFSBI=$totalwFSBI+$wFSBI['amount'];
                        $month=$object->numrcMonth($wFSBI['month']);  
                      ?> 
                        <tr>  
                       <td><?= $month;?> - <?=$wFSBI['year'];?></td>                                          
                         <td><?= $wFSBI['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Withdrawl Current A/C (S.B.I) - <?= $totalwFSBI;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Withdrawl from V.C.C.B</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                       $totalwFVCCB=0;
                       foreach ($object->findTotalAmountDepositedwalSBIBBydateByListByMonth($frmDt,$toDt) as $wFVCCB) {
                       $totalwFVCCB=$totalwFVCCB+$wFVCCB['amount'];
                        $month=$object->numrcMonth($wFVCCB['month']); 
                      ?> 
                        <tr>  
                        <td><?= $month;?> - <?=$wFVCCB['year'];?></td>                                        
                          <td><?= $wFVCCB['amount'];?></td> 
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Withdrawl from V.C.C.B - <?= $totalwFVCCB;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>S.C.D Withdrawl (M.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php
                      $totalscdWithdrawlMT=0;
                       foreach($object->findAllMTLoanLedgerBYDate($frmDt,$toDt) as $con=>$row) {                     
                      $cgs=$object->findCGSByLanAcMemberId($row['loan_account_number'],$row['ledger_folio']); 
                      $callmony=$object->findCallMonyByLanAcMemberId($row['loan_account_number'],$row['ledger_folio']); 
                      $scdWithdrawl=(($row['loan_amount'])-($cgs['cgs']+$callmony['receiving_amount']));
                      $totalscdWithdrawlMT=$totalscdWithdrawlMT+$scdWithdrawl;
                      ?>
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($row['loan_date']));?></td>                                          
                        <td><?= $scdWithdrawl;?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.C.D Withdrawl (M.T) - <?= $totalscdWithdrawlMT;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>S.C.D Withdrawl (S.T)</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php 
                      $totalscdWithdrawlST=0;
                       foreach($object->findAllSTLoanLedgerBYDate($frmDt,$toDt) as $con=>$row) {                     
                      $cgs=$object->findCGSByLanAcMemberId($row['loan_account_number'],$row['ledger_folio']); 
                      $callmony=$object->findCallMonyByLanAcMemberId($row['loan_account_number'],$row['ledger_folio']); 
                      $scdWithdrawl=(($row['loan_amount'])-($cgs['cgs']+$callmony['receiving_amount']));
                      $totalscdWithdrawlST=$totalscdWithdrawlST+$scdWithdrawl;
                      ?> 
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($row['loan_date']));?></td>                                          
                        <td><?= $scdWithdrawl;?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.C.D Withdrawl (S.T) - <?= $totalscdWithdrawlST;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Divident from Bank</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php
                      $totalDivident=0;
                      foreach ($object->findTotalAmountDividendBydateListed($frmDt,$toDt) as $divident) {
                      $totalDivident=$totalDivident+$divident['amount'];
                      ?> 
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($divident['date']));?></td>                                          
                        <td><?= $divident['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Divident from Bank - <?= $totalDivident;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Interest from S.B.I</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php
                      $totalSBIInterest=0;
                      foreach ($object->findAllSBIInterest($frmDt,$toDt) as $SBIInterest) {
                        $totalSBIInterest=$totalSBIInterest+$SBIInterest['receive_amount'];
                       ?> 
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($SBIInterest['date']));?></td>                                          
                         <td><?= $SBIInterest['receive_amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Interest from S.B.I - <?= $totalSBIInterest;?>
                    </b>
                  <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Interest from V.C.C.B</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php
                     $totalVCCBInterest=0;
                      foreach ($object->findTotalVCCBLedgrBydate($frmDt,$toDt) as $VCCBInterest) {
                        $totalVCCBInterest=$totalVCCBInterest+$VCCBInterest['amount'];
                       ?> 
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($VCCBInterest['recev_date']));?></td>                                          
                          <td><?= $VCCBInterest['amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Interest from V.C.C.B - <?= $totalVCCBInterest;?>
                    </b>
                    <br>
                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Miscellaneous</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th> 
                        <th>Particulars</th>              
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                     <?php
                     $totalMisce=0;
                      foreach ($object->findTotalAmountMiscellaneousBydateByList($frmDt,$toDt) as $misce) {
                        $totalMisce=$totalMisce+$misce['miscellaneous_amount'];
                       ?> 
                        <tr>  
                        <td><?= date("d-m-Y", strtotime($misce['miscellaneous_date']));?></td>
                        <td><?= $misce['reson_miscellaneous'];?></td>                                         
                        <td><?= $misce['miscellaneous_amount'];?></td>  
                        </tr>  
                        <?php } ?>

                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Miscellaneous - <?= $totalMisce;?>
                    </b>
                    <br> <br> <br>
                    <?php 
                      $totalRecptGL=( ($object->findTotalAmountCallMoneyBydate($frmDt,$toDt)) + ($object->findAllMembrAdmissionFeesByDate($frmDt,$toDt)) + $toMTLaon + $toStLaon +$totalCgs + $totalMTEmi + $totalSTEmi + $totalMTInterest + $totalSTInterest + $totalwFSBI + $totalwFVCCB + $totalscdWithdrawlMT + $totalscdWithdrawlST + $totalDivident + $totalSBIInterest + $totalVCCBInterest + $totalMisce);
                    ?>

                    <b style="font-size:18px;margin-left: 37%;color:#3a7504;">Total Receipt General Ledger  - <?= $totalRecptGL;?>
                    </b>

                  
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
