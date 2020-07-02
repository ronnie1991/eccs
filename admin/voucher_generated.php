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
        $memID=base64_decode($_GET['mi']);
        $month=base64_decode($_GET['mont']);
        $year=base64_decode($_GET['yr']);
        $singlMembr=$object->singelSocietyMBRDtls($memID);
        $englishMonth=$object->numrcMonth($month);
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
            <li><a href="">Voucher</a></li>            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><b>Voucher Date ->  <?= $englishMonth;?> - <?= $year;?>  </b>
                  <b style="margin-left: 50px">  Member Name ->  <?= $singlMembr['member_name'];?>   </b>   </h3>
                  <div class="col-sm-3 pull-right"><a class="btn" style="padding:  0px 1px;background:#dddddd;color: #080808; " href="printVoucher?mi=<?= $_GET['mi']?>&mont=<?= $_GET['mont']?>&yr=<?= $_GET['yr']?>" target="_blank"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-print"></i>&nbsp;&nbsp;<b>Print-Out?</b></a>              
                  </div>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
          <table class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>Particulars (Loan)</th>
                        <th>Loan Principal</th>
                        <th>Loan Interest</th>
                        <th>Total</th>
                        <th>Outstanding</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
         				
					    foreach($object->eMILedgrDtlsByMonthFrVouchr($memID,$year,$month) as $con=>$row) {
               $loanAcDtls=$object->singelMbrLoanLedger($row['loan_acunt_no']);        
					?>
                      <tr>
                        <td><?= $loanAcDtls['type_loan'];?></td>
                        <td><?= $row['emi_principal'];?></td>
                        <td><?= $row['emi_nterest'];?></td>
                        <td><?= $row['emi_principal']+$row['emi_nterest'];?></td>
                        <td><?= $row['outstanding_principa'];?></td>
                      </tr>

					  <?php   } ?>
                    </tbody>                    
                  </table>
                  <br>  
                  <table  class="table table-bordered table-striped">         
                    <thead>
                      <tr>
                        <th>Particulars (Share Money)</th>
                        <th>Amount</th>                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php                 
                      foreach($object->findCallMonyByMonthYear($memID,$year,$month) as $con=>$row) { 
                  ?>
                              <tr>
                                <td><?= 'Share Money';?></td>
                                <td><?= $row['receiving_amount'];?></td>
                              </tr>

                    <?php   } ?>
                    </tbody>                    
                  </table>
                  <br>
                  <table  class="table table-bordered table-striped">         
                    <thead>
                      <tr>
                        <th>Particulars (Admission)</th>
                        <th>Amount</th>                        
                      </tr>
                    </thead>
                    <tbody>
          <?php                 
              foreach($object->findAllMembrAdmissionFeesByMonth($memID,$year,$month) as $con=>$row) { 
          ?>
                      <tr>
                        <td><?= 'Admission';?></td>
                        <td><?= $row['amount_recv'];?></td>
                      </tr>

            <?php   } ?>
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
