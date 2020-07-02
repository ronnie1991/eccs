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
      ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Registered Member List <?= date("d-M-Y", strtotime($frmDt));?> To <?= date("d-M-Y", strtotime($toDt));?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="obycs_vsa">Member Official</a></li>
            <li class="active">View Members sort by date </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">You Can View Member Register </h3>
				  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">                    
				   <div class="col-sm-3">
             <a class="btn" style="padding:  0px 1px;background:#dddddd;color: #080808; " href="printMemberListByDate?frmDt=<?=$_GET['frmDt']?>&toDt=<?=$_GET['toDt']?>" target="_blank"><i style="font-weight: 400;    font-size: 16px;" class="fa fa-print"></i>&nbsp;&nbsp;<b>Print-Out?</b></a>
					 </div>
                    <thead>
                      <tr>
                        <th>Row.No</th>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Present Address</th>
                        <th>Occupation</th>
            						<th>Membership Date</th>
            						<th>Nominee</th>
            						<th>Register folio number</th>                         
            						<th>Salary Ac.</th>
            						<th>Action</th>                                                           					
                      </tr>
                    </thead>
                    <tbody>
					<?php 
         				
					    foreach($object->findAllSocietyMBRegistrationBYMembrShipDate($frmDt,$toDt) as $con=>$row) {						
						
					?>
                      <tr <?php if($row['status']=='0') { echo "style='color:red'";}  ?> >
                        <td><?= $con+1;?></td>
                        <td><?= $row['sl_no'];?>&nbsp;&nbsp;<?php if($row['status']=='0') { echo "<b style='color:red'>Resigned</b>";}  ?></td>
                        <td><?= $row['member_name'];?></td>
                        <td><?= $row['mobile_number'];?></td>
                        <td><?= $row['present_resident'];?></td>
                        <td><?= $row['occupation'];?></td>
                        <td><?= date("d-M-Y", strtotime($row['date_membership']) );?></td>
                        <td><?= $row['name_nominee'];?></td>
                        <td><?= $row['register_folio_number'];?></td>
                        <td><?= $row['salary_account'];?> </td>
                        <td><a href="update_member?memberId=<?= base64_encode($row['sl_no']); ?>" ><img src="dist/img/pencil.png" width="29" height="29" title="Edit" ></a></td>
										
                      </tr>
					  <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr> 
                        <th>Row.No</th>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Permanent  Address</th>
                        <th>Present Address</th>
                        <th>Occupation</th>
                        <th>Membership Date</th>
                        <th>Nominee</th>
                        <th>Register folio number</th>                         
                        <th>Salary Ac.</th>
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
