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
      if(isset($_GET['loacn'])) 
     {
       $loanacno=base64_decode($_GET['loacn']);  
       $sv_ac_no=base64_decode($_GET['svac']);
     }
          ?>
      
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Member EMI Details    

          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="obycs_vsa">Ledger OF Emi</a></li>
            <li class="active">Member EMI Details </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Total Amount of EMI =<b> <?= $object->findTotalAmountEMILedgrByAcNo($loanacno,$sv_ac_no);?> INR </b></h3>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
				 
                    <thead>
                      <tr>
                        <th>Row.No</th>
                        <th>Name</th>
                        <th>Loan account Number</th>
                        <th>Date Of Payment</th>
                        <th>Days Interval</th>
                        <th>Emi Principal</th>
                        <th>Emi Interest</th>
						            <th>Emi Outstanding</th>
						            <th>New Outstanding</th>                                                                					
                      </tr>
                    </thead>
                    <tbody>
					<?php          				
					    foreach($object->singelEMILedgrAllDtls($loanacno,$sv_ac_no) as $con=>$row) {	
              $snglSociMbr=$object->singelSocietyMBRDtls($row['cust_id']); 
             		    
					?>
                      <tr>
                        <td><?= $con+1;?></td>
                        <td><?= $snglSociMbr['member_name'];?></td>
                        <td><?= $row['loan_acunt_no'];?></td>
                        <td><?= DATE("d M Y",strtotime($row['due_date']));?></td>
                        <td><?= $row['days_interval'];?></td>
                        <td><?= $row['emi_principal'];?></td>
                        <td><?= $row['emi_nterest'];?></td>
                        <td><?= $row['outstanding_principa'];;?></td>
                        <td><?= $row['new_outstang_principal'];?></td>                                       
                      </tr>

					  <?php   } ?>
                    </tbody>
                    <tfoot>
                       <tr>
                        <th>Row.No</th>
                        <th>Name</th>
                        <th>Loan account Number</th>
                        <th>Date Of Payment</th>
                        <th>Days Interval</th>
                        <th>Emi Principal</th>
                        <th>Emi Interest</th>
                        <th>Emi Outstanding</th>
                        <th>New Outstanding</th>                                                                             
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php  include_once('footer.php');?>
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
