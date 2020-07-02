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
      <?php include_once('left_asid.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          All New Loans Account      
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="obycs_vsa">New Loans Account  </a></li>
            <li class="active">All New Loans Account   </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Total Amount New Loan<b> <?= $object->findSumOfAmounLoanAccount();?> INR </b></h3>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
				          <div class="col-sm-3">
                      
                      <a class="btn" style="padding: 0px 12px;background:#dddddd;color: #080808;" href="exclAllParentLoan"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<b>Excel ?</b></a>

                      &nbsp;&nbsp;<a class="btn" style="padding:  0px 1px;background:#dddddd;color: #080808; " href="printAllParentLoanAc" target="_blank"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-print"></i>&nbsp;&nbsp;<b>Print-Out?</b></a>
                   </div>
                    <thead>
                      <tr>
                        <th>Sl.No</th>
                        <th>Loan Ac.</th>    
                        <th>Type</th>   
                        <th>Total Amount</th>
                        <th>Total Amount E.M.I</th>                         
                        <th>Total No. E.M.I</th>                           
                        <th>Loan Date</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th>Created By</th>                                             
                        <th>Action</th>                                                   					
                      </tr>
                    </thead>
                    <tbody>
					<?php 
         				
					    foreach($object->findAllLoanAccountNumber() as $con=>$row) {			
              if($row['status']=='1')
                {
                  $status="<b style='color:green'>Open</b>";
                  $statusDate="<b style='color:green'>Active</b>";

                }
              else{
                $status="<b style='color:red'>Closed</b>" ;
                $statusDate=date("d-M-Y", strtotime($row['closing_date']));

              } 	    
					?>
                      <tr <?php if($row['status']=='0') { echo "style='color:red;font-size:17px;font-weight:600'"; }  ?> style="font-size: 16px;font-weight: 600;"  >
                        <td><?= $con+1;?></td>
                        <td><?= $row['loan_account_no'];?></td>
                        <td><?= $row['loan_type'];?></td>
                        <td><?= $row['total_loan_amount'];?></td> 
                        <td><?= $row['total_amount_emi'];?></td>                       
                        <td><?= $row['total_number_emi'];?></td>
                        <td><?= date("d-M-Y", strtotime($row['loan_date']));?></td>
                        <td><?= $status;?></td>
                        <td><?= $statusDate;?></td>                
                        <td><?= $row['created_by'];?> </td>                                              
										    <td>
                          <?php if($row['status']=='1')  { ?>
                          <a href="close_loan?lnId=<?= base64_encode($row['loan_account_no']); ?>" ><img src="dist/img/pencil.png" width="29" height="29" title="Edit" ></a>
                        <?php } ?>
                        </td>
                      </tr>

					  <?php   } ?>
                    </tbody>
                    <tfoot>
                       <tr>
                        <th>Sl.No</th>
                        <th>Loan Ac.</th>    
                        <th>Type</th>   
                        <th>Total Amount</th>
                        <th>Total Amount E.M.I</th>                         
                        <th>Total No. E.M.I</th>                           
                        <th>Loan Date</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th>Created By</th>                                             
                        <th>Action</th>                                                                           
                      </tr>
                    </tfoot>
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
