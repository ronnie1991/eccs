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
         Principal Details "M.T" (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
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
              <b style="font-size: 18px;" >Principal Details "M.T" (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>  
            <div class="box">


                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       
                        <th>Collected Form Members (Principal)</th>
                        <th>Amount</th>
                                                                                             
                      </tr>
                    </thead>
                    <tbody>
          <?php 
              $toPriAmColFM=0;               
              foreach ($object->findSUMAmountMTEMIPrincipalByMonth($frmDt,$toDt) as  $emiPrinci) {  
              $toPriAmColFM=$toPriAmColFM+$emiPrinci['amount']; 
              $month=$object->numrcMonth($emiPrinci['month']);       
          ?>
                      <tr>
                        
                        <td><?= $month;?> - <?= $emiPrinci['year'];?></td>
                        <td><?= $emiPrinci['amount'];?></td>
                    
                      </tr>
          <?php              
              }        
          ?>
                    </tbody>
                  </table>
                  <br>                   
                   <tr>
                    <span class="pull-left"> 
                    <td><b>Total Loan Amount -></b></td>
                    <td><b><?= $object->findTotalAmountMTLoanBydate($frmDt,$toDt);?></b></td>
                    </span>
                  </tr>
                   <tr>
                    <span class="pull-right"> 
                    <td><b>Total Principal Amount -></b></td>
                    <td><b><?= $toPriAmColFM;?></b></td>
                    </span>
                  </tr>
                  <br><br><br><br>
                  <div class="box-header">
                  <h3 class="box-title"><b>Principal Details "M.T" : (From- <?= $frmDt;?> - To Date - <?=$toDt;?>)</b></h3>
                                   
                </div><!-- /.box-header -->
                  <table  class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Row.No</th>
                        <th>Deposited To Bank</th>
                        <th>Amount</th>
                                                                                             
                      </tr>
                    </thead>
                    <tbody>
          <?php 
              $toPriAmDetobank=0;                
              foreach ($object->findSUMMTAmountDepositedVCCBByMonth($frmDt,$toDt) as $con=>$dvr) {  
              $toPriAmDetobank=$toPriAmDetobank+$dvr['amount']; 
              $month=$object->numrcMonth($dvr['month']); 
          ?>
                      <tr>
                        <td><?= $con+1;?></td>
                        <td><?= $month;?> - <?= $dvr['year'];?></td>
                        <td><?= $dvr['amount'];?></td>
                    
                      </tr>
            <?php } ?>
                    </tbody>
                  </table>
                  
                  <br>
                  <tr>
                    <span class="pull-right"> 
                    <td><b>Total Principal Amount -></b></td>
                    <td><b><?= $toPriAmDetobank;?></b></td>
                    </span>
                  </tr>
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
