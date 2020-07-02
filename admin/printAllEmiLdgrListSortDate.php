<?php include_once('main.class.php'); 
$frmDt=base64_decode($_GET['frmDt']);
$toDt=base64_decode($_GET['toDt']);
$formatedfrmDt=date("d-m-Y", strtotime($frmDt));
$formatedtoDt=date("d-m-Y", strtotime($toDt));
?>
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
      
      
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">        
          <h1>
         All EMI Ledger List (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)
          </h1>
          <ol class="breadcrumb">      
            <li ><i style="font-weight: 400; font-size: 16px;cursor: pointer; " onclick="myFunction()" class="fa fa-print">&nbsp;&nbsp;Take a Print-Out?</i></li>
          </ol>
        </section>
          
        <!-- Main content -->
        
        <section class="content">
          <div class="row">

            <div class="col-xs-12">
              <div style="text-align: center;" >
             <br> <p style="font-size: 16px;font-weight: 600;">MEDINIPUR SADAR EAST SCHOOL EMPLOYEES CO-OPERATIVE CREDIT SOCIETY LTD</p>
              <p style="font-size: 16px;">Reg.No-7 PAS-MED &nbsp;&nbsp; Date-08.10.2013</p>
              <b style="font-size: 18px;" >EMI Ledger List (From Date - <?= $formatedfrmDt;?> - To Date - <?=$formatedtoDt;?>)</b>
               </div>             
              
            <div class="box">
                
                <div class="box-body">
                  <table  class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>Row.No</th>
                        <th>Name</th>                 
                        <th>Loan account Number</th>
                        <th>Type of Loan</th>                       
                        <th>Date of Payment</th>
                        <th>Emi Principal</th>
                        <th>Emi Interest</th>
                        <th>Total Emi</th>                     
                        <th>Outstanding Principal</th>                                                                              
                      </tr>
                    </thead>
                    <tbody>
          <?php                 
              foreach($object->allEMILedgrBYDate($frmDt,$toDt) as $con=>$row) { 
              $snglSociMbr=$object->singelSocietyMBRDtls($row['cust_id']);                
          ?>
                      <tr>
                        <td><?= $con+1;?></td>
                        <td><?= $snglSociMbr['member_name'];?></td>                        
                        <td><?= $row['loan_acunt_no'];?></td>
                        <td><?= $row['loan_type'];?></td>
                        <td><?= DATE("d M Y",strtotime($row['due_date']));?></td>
                        <td><?= $row['emi_principal'];?></td>
                        <td><?= $row['emi_nterest'];?></td>
                        <td><?= ($row['emi_principal']+$row['emi_nterest']);?></td>                      
                        <td><?= $row['new_outstang_principal'];?></td>                                         
                      </tr>

            <?php   } ?>
                    </tbody>
                  </table>
                   <h4 class="box-title"><b> Total Amount of EMI 'M.T' ( 'Principal' = &#x20B9; <?= $object->findTotalAmountMTEMIPrincipalLedgrBydate($frmDt,$toDt);?> </b> &nbsp;<b>  "Interest" = &#x20B9; <?= $object->findTotalAmountMTEMIInterestLedgrBydate($frmDt,$toDt);?>)</b></h4>
                   <h4><b>Total Amount of EMI 'S.T' ( "Principal" = &#x20B9; <?= $object->findTotalAmountSTEMIPrincipalLedgrBydate($frmDt,$toDt);?>  </b> &nbsp;&nbsp;<b>  "Interest" = &#x20B9;<?= $object->findTotalAmountSTEMIInterestLedgrBydate($frmDt,$toDt);?>  )</b></h4>
                  
                  <br><br><br><br>

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

                </div><!-- /.box-body -->

              </div><!-- /.box -->
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
