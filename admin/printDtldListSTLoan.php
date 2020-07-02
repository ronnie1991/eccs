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
         Detailed List Of S.T Loan (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
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
              <b style="font-size: 18px;" >Detailed List Of S.T Loan (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>  
            <div class="box">


                <div class="box-body" >
                  <table id="example1" class="table table-bordered table-striped" >         
                    <thead>
                      <tr>
                        
                        <th>Sl No</th>
                        <th>Name of the Mamber</th>
                        <th>L/F</th>
                        <th>Date of Retirment</th>
                        <th>Membership No</th>
                        <th>Date of issue of loan</th>
                        <th>Amount of loan issued</th>
                        <th>Rate of intt</th>
                        <th>No of EMI fixed</th>
                        <th>Amount of EMI fixed</th>
                        <th>No of EMI Due</th>
                        <th>No of EMI paid</th>
                        <th>Out Standing Principal</th>
                        <th>Interest</th>
                        <th>Of Which O/D Prin.</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $year = date('Y', strtotime($frmDt));
                        $month = date('m', strtotime($frmDt));
                       $noDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                        $totalLoan=0;
                        $totalOutstandPrinci=0;
                        $totalInterest=0;
                       foreach ($object->findAllEmiLedgerSTLoan($frmDt,$toDt) as $rc=>$dLMTl) { 
                           $singlMbrDtls=$object->singelSocietyMBRDtls($dLMTl['cust_id']);
                           $loanLedgerDetls=$object->singelLoanAccountDtlsByAcount($dLMTl['loan_acunt_no'],$dLMTl['cust_id']);
                           if($singlMbrDtls['date_retirment']=='0000-00-00')
                           {
                            $reterStatus='N/A';
                           }
                           if($singlMbrDtls['date_retirment']!='0000-00-00')
                           {
                            $reterStatus=$singlMbrDtls['date_retirment'];
                           }
                            $totalLoan=$totalLoan+$loanLedgerDetls['loan_amount'];  
                            $totalOutstandPrinci=$totalOutstandPrinci+$dLMTl['outstanding_principa'];

                            $lastPayDate = date('d', strtotime($dLMTl['payd_date']));
                             $diffRenceDate=($noDays-$lastPayDate);
                            $interest=round(((($loanLedgerDetls['rate_Interest'] / 100) * $dLMTl['outstanding_principa'])*$diffRenceDate)/365);
                            $totalInterest=$totalInterest+$interest;
                        ?>
                      <tr>
                       <td><?= $rc+1;?></td>
                        <td><?=$singlMbrDtls['member_name'];?></td>
                        <td><?=$singlMbrDtls['sl_no'];?></td>
                        <td><?= $reterStatus;?></td>
                        <td><?=$singlMbrDtls['register_folio_number'];?></td>
                        <td><?= date("d-m-Y", strtotime($dLMTl['payd_date']));?></td>
                        <td><?=$loanLedgerDetls['loan_amount'];?></td>
                        <td><?=$loanLedgerDetls['rate_Interest'];?></td>
                        <td><?=$loanLedgerDetls['term_loan'];?></td>
                        <td><?=$loanLedgerDetls['emi'];?></td>
                        <td><?=$loanLedgerDetls['term_loan']-$dLMTl['loan_term'];?></td>
                        <td><?=$dLMTl['loan_term'];?></td>
                        <td><?=$dLMTl['outstanding_principa'];?></td>
                        <td><?= $interest;?></td>
                        <td>N/A</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="col-sm-4 ">
                  <b>Total Amount of Loan Issued  -> </b>
                  <b><?= $totalLoan;?>
                  </div>

                  <div class="col-sm-4 ">
                  <b>Total Out Standing Principal -> </b>
                  <?= $totalOutstandPrinci;?>
                  </div>

                  <div class="col-sm-4 ">
                  <b>Total Interest -></b>
                  <b><?= $totalInterest;?></b>
                  </div>
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
