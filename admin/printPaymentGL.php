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
         Payment General Ledger (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
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
              <b style="font-size: 18px;" >Payment General Ledger (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>
            <div class="box">


                <div class="box-body">
          <table class="table table-bordered table-striped">
                    <thead>
                      
                      <tr>
                        <th>Date </th>  
                        <th>Particulars</th>             
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td><h4>Expanses</h4></td></tr>
            <?php 
               $totalExpns=0;
               foreach ($object->findTotalAmounExpansesBydate($frmDt,$toDt) as $expns) {
               $totalExpns=$totalExpns+$expns['amount'];         
              ?>

                      <tr>
                        <td><?= date("d-m-Y",strtotime($expns['date']));?></td> 
                        <td><?= $expns['particulars'];?></td>                        
                        <td><?= $expns['amount'];?></td>            
                      </tr>   
             <?php } ?>                        
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Expanses - <?= $totalExpns;?> </b>   
                  <br>

                  <table class="table table-bordered table-striped">
                     <tr><td><h4>Share to bank</h4></td></tr>
                   <thead>                      
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>                 
                  <?php 
                  $totalStb=0;
                  foreach ($object->findAllShareMoneyByDateWitoutLoanAcount($frmDt,$toDt) as $stb) { 
                  $totalStb=$totalStb+$stb['receiving_amount'];        
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($stb['receiving_date']));?></td>
                        <td><?= $stb['receiving_amount'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Share to bank - <?= $totalStb;?> </b>   
                  <br>
                  

                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Co-Operative share</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $totalCoopshr=0;
                  foreach ($object->findTotalAmounCOOperativeShareBydate($frmDt,$toDt) as $coopshr) {  
                  $totalCoopshr=$totalCoopshr+$coopshr['share_amount'];       
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($coopshr['date']));?></td>
                        <td><?= $coopshr['share_amount'];?></td>                                 
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Co-Operative share - <?= $totalCoopshr;?> </b>   
                  <br>

                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Admission to bank</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Amount</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $totalAdmisintb=0;
                  foreach ($object->findAllMembrAdmissionFeesBetwnDt($frmDt,$toDt) as $admisintb) { 
                  $totalAdmisintb=$totalAdmisintb+$admisintb['amount_recv'];        
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($admisintb['recv_date']));?></td>
                        <td><?= $admisintb['amount_recv'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Admission to bank - <?= $totalAdmisintb;?> </b>   
                  <br>
                 
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>SCD Deposit Loan</h4>
                      <tr>
                        <th>Date</th>               
                        <th>SCD</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $totalScdDeposite=0;
                    foreach($object->findTotalAmounLoanAccountBydate($frmDt,$toDt) as $con=>$row) {              
                          $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
                          $share=$object->findCOOperativeShare($row['loan_account_no']);              
                          $cgs10=($cgsTotal+(($cgsTotal*10)/100));
                          $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount'])); 
                          $totalScdDeposite=$totalScdDeposite+$scdDeposite;         
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($row['loan_date']));?></td>
                        <td><?= $scdDeposite;?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total SCD Deposit Loan - <?= $totalScdDeposite;?> </b>   
                  <br>

                    <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Miscellaneous</h4>
                      <tr>
                        <th>Date</th>               
                        <th>Reasone</th> 
                        <th>Amount</th>                                                                
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                  $totalMisc=0; 
                  foreach ($object->findTotalAmountExpenditureMiscellaneousBydateLIst($frmDt,$toDt) as $misc) {
                  $totalMisc=$totalMisc+$misc['miscellaneous_amount'];                             
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($misc['miscellaneous_date']));?></td>                          
                        <td><?= $misc['reson_miscellaneous'];?></td>
                        <td><?= $misc['miscellaneous_amount'];?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Miscellaneous - <?= $totalMisc;?> </b>   
                  <br>
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>CGS to Bank </h4>
                      <tr>
                        <th>Date</th>
                        <th>C.G.S</th>                                                             
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $totalCGS=0;
                  foreach($object->findTotalAmounLoanAccountBydate($frmDt,$toDt) as $con=>$row) {   
                   $cgsTotal=$object->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
                  $share=$object->findCOOperativeShare($row['loan_account_no']);              
                  $cgs10=($cgsTotal+(($cgsTotal*10)/100));
                  $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount']));
                  $totalCGS=$totalCGS+$cgs10;                          
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($row['loan_date']));?></td>   
                        <td><?= $cgs10;?></td>                             
                      </tr>  
                   <?php } ?>                
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total CGS to Bank - <?= $totalCGS;?> </b>   
                  <br>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4>M.T Loan Principal</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Principal Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalMtLP=0; 
                     foreach ($object->findSUMMTAmountDepositedVCCBByMonth($frmDt,$toDt) as $mtLP) {
                     $totalMtLP=$totalMtLP+$mtLP['amount']; 
                     $month=$object->numrcMonth($mtLP['month']);                     
                  ?>
                      <tr>
                        <td><?= $month;?> -  <?=$mtLP['year'];?></td>                          
                        <td><?= $mtLP['amount'];?></td>
                                            
                      </tr>  
                  <?php } ?>             
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total M.T Loan Principal - <?= $totalMtLP;?> </b>   
                  <br>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4>S.T Loan Principal</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Principal Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalStLP=0; 
                     foreach ($object->findSUMSTAmountDepositedVCCBByMonth($frmDt,$toDt) as $stLP) {
                     $totalStLP=$totalStLP+$stLP['amount']; 
                     $month=$object->numrcMonth($stLP['month']);                     
                  ?>
                      <tr>
                        <td><?= $month;?> -  <?=$stLP['year'];?></td>                          
                        <td><?= $stLP['amount'];?></td>
                                            
                      </tr>  
                  <?php } ?>             
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.T Loan Principal - <?= $totalStLP;?> </b>   
                  <br>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4>M.T Loan Interest</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                      $totalMtLI=0; 
                      foreach ($object->findSUMMTInterestAmountDepositedVCCBByMonth($frmDt,$toDt) as $mtLI) {
                      $totalMtLI=$totalMtLI+$mtLI['amount']; 
                      $month=$object->numrcMonth($mtLI['month']);                         
                  ?>
                      <tr>
                        <td><?= $month;?> -  <?=$mtLI['year'];?></td>                           
                        <td><?= $mtLI['amount'];?></td>
                                            
                      </tr>  
                    <?php } ?>             
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total M.T Loan Interest - <?= $totalMtLI;?> </b>   
                  <br>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4>S.T Loan Interest</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Interest Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalStLInterest=0; 
                     foreach ($object->findSUMSTPrincipalDepositedVCCBByMonth($frmDt,$toDt) as $stLIntrst) {
                     $totalStLInterest=$totalStLInterest+$stLIntrst['amount']; 
                     $month=$object->numrcMonth($stLIntrst['month']);                     
                  ?>
                      <tr>
                        <td><?= $month;?> -  <?=$stLIntrst['year'];?></td>                          
                        <td><?= $stLIntrst['amount'];?></td>
                                            
                      </tr>  
                  <?php } ?>             
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.T Loan Interest - <?= $totalStLInterest;?> </b>   
                  <br>
                 <table class="table table-bordered table-striped">
                   <thead>
                      <h4>S.B.I Deposited</h4>
                      <tr>
                        <th>Date</th>                        
                        <th>Total Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $totalSbiDeposite=0;
                  foreach ($object->findTotalSBIDepositedBydateList($frmDt,$toDt) as $sbiDeposite) {  
                  $totalSbiDeposite=$totalSbiDeposite+$sbiDeposite['amount'];                         
                  ?>
                      <tr>
                        <td> <?= $sbiDeposite['date'];?> </td>                          
                        <td><?= $sbiDeposite['amount'];?></td>
                                            
                      </tr>  
                   <?php } ?>                  
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.B.I Deposited - <?= $totalSbiDeposite;?> </b> 
                  <br>
                <table class="table table-bordered table-striped">
                   <thead>
                      <h4>VCCB Deposited</h4>
                      <tr>
                        <th>Date</th>  
                        <th>Particulars</th> 
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalVccbDepo=0; 
                     foreach ($object->findTotalAmountExpanditureDepositedVCCBBydate($frmDt,$toDt) as $vccbDepo) {
                     $totalVccbDepo=$totalVccbDepo+$vccbDepo['withdrwl_amount'];                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($vccbDepo['deposite_date']));?></td>                          
                        <td><?= $vccbDepo['name_of_account'];?></td>
                        <td><?= $vccbDepo['deposite_amount'];?></td>                    
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total VCCB Deposited - <?= $totalVccbDepo;?> </b> 
                  <br>
                  <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Dividend to bank</h4>
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
                        <td> <?= date("d-m-Y", strtotime($divident['date']));?></td>                          
                        <td><?= $divident['amount'];?></td>                   
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Dividend to bank - <?= $totalDivident;?> </b> 
                  <br>
                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4>Audit Fees</h4>
                      <tr>
                        <th>Date</th>  
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $totalAuditfe=0;
                     foreach ($object->findTotalAmountaddAuditFeeBydate($frmDt,$toDt) as $auditfe) {
                     $totalAuditfe=$totalAuditfe+$auditfe['amount'];                     
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($auditfe['receiving_date']));?></td>                          
                        <td><?= $auditfe['amount'];?></td>                   
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total Audit Fees - <?= $totalAuditfe;?> </b> 
                  <br>
                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4>M.T Loan issued to member</h4>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalMtLIm=0; 
                     foreach ($object->findAllMTLoanLedgerBYDate($frmDt,$toDt) as $mtLIm) { 
                     $totalMtLIm=$totalMtLIm+$mtLIm['loan_amount'];                    
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($mtLIm['loan_date']));?></td>                          
                        <td><?= $mtLIm['loan_amount'];?></td>                   
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total M.T Loan issued to member - <?= $totalMtLIm;?> </b> 
                  <br>
                   <table class="table table-bordered table-striped">
                   <thead>
                      <h4>S.T Loan issued to member</h4>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>                                                               
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                     $totalStLIm=0; 
                     foreach ($object->findAllSTLoanLedgerBYDate($frmDt,$toDt) as $stLIm) { 
                     $totalStLIm=$totalStLIm+$stLIm['loan_amount'];                    
                  ?>
                      <tr>
                        <td> <?= date("d-m-Y", strtotime($stLIm['loan_date']));?></td>                          
                        <td><?= $stLIm['loan_amount'];?></td>                   
                      </tr>  
                      <?php } ?>         
                    </tbody>                    
                  </table>
                  <b style="font-size:18px;margin-left: 37%;color:#ff6b02;">Total S.T Loan issued to member - <?= $totalStLIm;?> </b> 
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
                  <br> <br>
                  <?php 
                  $totalPaymentLedger=$totalExpns+$totalStb+$totalCoopshr+$totalAdmisintb+$totalScdDeposite+$totalMisc+$totalCGS+$totalMtLP+$totalStLP+$totalMtLI+$totalStLInterest+$totalSbiDeposite+$totalVccbDepo+$totalDivident+$totalAuditfe+$totalMtLIm+$totalStLIm+$totalSBIInterest+$totalVCCBInterest;

                  ?>

                  <b style="font-size:18px;margin-left: 37%;color:#048014;">Total Payment General Ledger  - <?= $totalPaymentLedger;?> </b> 
                 
                

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
