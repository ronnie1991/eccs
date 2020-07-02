<?php include_once('main.class.php');
 $frmDt=base64_decode($_GET['frmDt']);
 $toDt=base64_decode($_GET['toDt']);
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
         Share Money List <?= date("d-M-Y", strtotime($frmDt));?> To <?= date("d-M-Y", strtotime($toDt));?>
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
              <b style="font-size: 18px;" >Share Money List form <?= date("d-M-Y", strtotime($frmDt));?> To <?= date("d-M-Y", strtotime($toDt));?></b>
               </div>
            <div class="box">
                
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped"> 

                     <thead style="font-size: 15px;font-weight: 800;">
                      <tr>
                        <th>Number Of Shares</th>
                        <th>Sl No. Of Member Register</th>
                        <th>Name</th>
                        <th>Received Date</th>
                        <th>Received Amount </th>                        
                        <th>Total Amount Share</th>                                                                     
                      </tr>
                    </thead>
                    <tbody>
          <?php 
          $toShareAmount=0; 
          $idChk2='';
                
              foreach($object->findAllActiveCallMoneyBtwDate($frmDt,$toDt) as $con=>$row) {

                $idChk1=$row['member_slno'];
                if($idChk2!='')
                {
                if($idChk1!=$idChk2)
                {
                  $toShareAmount=$toShareAmount=0;

                }
                }
                $toShareAmount=$toShareAmount+$row['receiving_amount']; 
                


              $snglSociMbr=$object->singelSocietyMBRDtls($row['member_slno']);          
              $sumClMn=$object->findMbrSumCallMoney($row['member_slno']);
              if($row['status']=='1')
                {$status="<b style='color:green'>Open</b>";}
              else{$status="<b style='color:red'>Closed</b>" ;} 
          ?>
                      <tr style="font-size: 14px;font-weight: 600;">
                        <td><?= $con+1;?></td>
                        <td><?= $row['member_slno'];?></td>
                         <td><?= $snglSociMbr['member_name'];?></td>                        
                        <td><?= date("d-M-Y", strtotime($row['receiving_date']) );?></td>
                        <td><?= $row['receiving_amount'];?></td>
                        <td><?= $toShareAmount;?></td>
                    
                      </tr>

            <?php  $idChk2=$row['member_slno']; } ?>
                    </tbody>
                  </table>
                  <h4 class="box-title pull-right"><b> Total Amount of Share Money = <?= $object->findTotalAmountCallMoneyBydate($frmDt,$toDt);?> INR </b></h4>
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
