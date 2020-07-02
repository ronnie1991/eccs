<?php 
include_once("main.class.php");
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> | Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include_once('header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
     <?php include_once('left_asid.php');
            if($_SESSION['sl_no']!='5')
            {
     ?>
      <script type="text/javascript">
      window.location='logout';
      </script>
      <?php }
         $decodedUerId=base64_decode($_GET['sli']);
         $singelMemberDetail=$object->singelSocietyMBRDtls($decodedUerId);
         $singelLoginAccessDetail=$object->singelAdminLoginDtls($decodedUerId);
       ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Update a login credential for <?= $singelMemberDetail['member_name'];?>            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Update Login Controls</a></li>
            <li class="active">Create a User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE -->
      <?php
          if(isset($_POST['update_member_login']))

          {
            if($_POST["form_id"] == $_SESSION["formid"])    

            {
            $_SESSION["formid"] = '';
            if($_POST['mbr_confirm_password']==$_POST['confirm_password'])
            {
            $msg=$object->updateLoginUsers($decodedUerId);
            }
            else
            {
              echo "<h3 style='color:red;'>Password Missed Match</h3>";
            }
            }
          }
          
          else
          {
          $_SESSION["formid"] = md5(uniqid(rand(0,10000000)));
                     session_write_close();   
           }
      ?>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?= isset($msg)? $msg:'All Fields are required';?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
    <div class="box-body">
     <form action="" method="post">
     <input type="hidden" name="form_id" value="<?= $_SESSION["formid"]?>" />
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label>Login Access Status</label>
                    <select name="login_status" class="form-control select2" style="width: 100%;" required="required">
                      <option value="">Select A Status </option>
                      <option value="1" <?php if ($singelLoginAccessDetail['status']=='1') {echo "selected";} ?>>Allow Login Access</option>  
                      <option value="0" <?php if ($singelLoginAccessDetail['status']=='0') {echo "selected";} ?>>Block Login Access</option>                                  
                    </select>
                  </div><!-- /.form-group -->                
                </div><!-- /.col --> 
                <div class="col-md-6">
                <div class="form-group">
                  <label class="status">User Id</label>
                  <input id="lognUsrId" type="text" name="mbr_userid" value="<?= $singelLoginAccessDetail['user_id'];?>" class="form-control" pattern="[a-zA-Z][a-zA-Z\s]*" minlength="5" maxlength="50" oninvalid="setCustomValidity('Enter Valid User Id (Minimum 5 Characters)')"  onchange="try{setCustomValidity('')}catch(e){}" placeholder="Enter a User Id (minimum 5 charecters)"required>
                </div>                 
              </div><!-- /.col -->                   
      </div><!-- /.row -->
        <div class="row">
        <div class="col-md-6">                
        <div class="form-group">
        <label>Enter a password</label>
        <input type="password" value="<?= $singelLoginAccessDetail['password'];?>"  id="password" name="mbr_confirm_password" pattern=".{6,}" oninvalid="setCustomValidity('Enter Minimum 6 Characters ')"  onchange="try{setCustomValidity('')}catch(e){}" class="form-control" placeholder="Enter a password (minimum 6 charecters)"required>
        </div>                 
        </div><!-- /.col -->     
        <div class="col-md-6">                
        <div class="form-group">
        <label>Confirm password</label>
        <input type="password" value="<?= $singelLoginAccessDetail['password'];?>" id="repassword" name="confirm_password" class="form-control" placeholder="Confirm  password..."required>
        </div>                 
        </div><!-- /.col -->  
        <!-- /.form-group -->                  
        </div><!-- /.col --> 
        <div class="col-sm-6">
        <div class="form-group">         
        <button id="submt" type="submit" name="update_member_login" class="btn btn-primary">Update</button>
        </div>                 
        </div><!-- /.col -->         
        </div><!-- /.row -->                
        </form>
            </div><!-- /.box-body -->            
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once('footer.php');?>      
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>  
    <!-- Page script -->
    <script>
      $(function () {
        $("#repassword").on('keyup keydown blur',function(){
        var rePass=$(this).val();
        var pass=$("#password").val();
         if(pass!=rePass)
         {
            $("#repassword").css("background-color", "#FF0000");
          $("#submt").prop('disabled', true);
         }
        else
        {
          $("#repassword").css("background-color","#a1ffa1");
          $("#submt").prop('disabled', false);
        }
      });
        $(document).on('keyup','#lognUsrId',function(){           
        var lgUsrId = $.trim($('#lognUsrId').val());    
        console.log(lgUsrId);
         $.ajax({
          url:'ajax_emp_lgusrid_valid',
          data:{lgUsrId:lgUsrId},
          type : 'POST' ,
          cache:false,
          success:function(data){
          $(".status").html(data);
                   if(data.indexOf("Employee User ID / Not Available") > -1)
          {
             $("#submt").prop('disabled', true);
          } 
                  if(data.indexOf("Employee User ID/ Available") > -1)
          {
             $("#submt").prop('disabled', false);
          }         
         }       
    });
    });
        //Initialize Select2 Elements
        $(".select2").select2();
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
      });
    </script>
  </body>
</html>
