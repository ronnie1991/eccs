<?php 
include_once("main.class.php");
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> ECCS| Admin</title>
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
	  $memberDtls=$object->singelSocietyMBRDtls(base64_decode($_GET['memberId']));  
	 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Update Register Of Members & their Nominees            
          </h1>
          <ol class="breadcrumb">
            <?php if($memberDtls['status']=='1'){?>
            <li><b><a style="color:#bf02b9;font-size: 16px;" href="member_retiermrnt?memberId=<?=$_GET['memberId'];?>"><i class="fa fa-dashboard"></i> Let`s Grant Retirement / Cessation?</a></b></li>
          <?php } ?>
            <li><a href="#">Home</a></li>
            <li class="active">Update Members & their Nominees</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE -->
		  <?php
				if(isset($_POST['update_oldloan_mbr']))
				{
				if($_POST['form_id']==$_SESSION['session_form'])
				{
				$_SESSION['session_form']='';
				$msg=$object->updateOldLoanMember(base64_decode($_GET['memberId']));
				}                					
				}
				else
				{
				$_SESSION['session_form']=md5(uniqid(rand(0,10000000)));
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
              <div class="row">
			<form method="post" enctype="multipart/form-data" >
			 <input type="hidden" name="form_id" value="<?= $_SESSION['session_form'];?>" />        
			
                 <div class="slno">
                 <div class="col-md-3">
                  <div class="form-group">
                    <label class="slNoStatus">SL. No <b style="color: red;font-size: 14px;">*</b></label>
                    <input id="lMbrSlNo" type="text" class="form-control" name="sl-number" value="<?=$memberDtls['sl_no'];?>" placeholder="Serial Number" required="required">          
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->                                 
                </div><!-- /.col -->
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Share Register folio number <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="srfn" placeholder="Share Register folio number" value="<?=$memberDtls['register_folio_number'];?>"  required >    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Member Name  <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="member_name" placeholder="Member Name" value="<?=$memberDtls['member_name'];?>" pattern="[a-zA-Z][a-zA-Z\s]*" minlength="3" maxlength="50" oninvalid="setCustomValidity('Enter Valid Name')"  onchange="try{setCustomValidity('')}catch(e){}" required >
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->		
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Mobile Number  <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="mobile_number"  placeholder="Member Name" value="<?=$memberDtls['mobile_number'];?>"  pattern="[0-9]{1}[0-9]{9}" maxlength="10"  oninvalid="setCustomValidity('Enter Valid Mobile Number')" onchange="try{setCustomValidity('')}catch(e){}" required >
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->    		
        				<div class="col-md-3">
        					<div class="form-group">
        					<label class="rollAvl">Father`s Name</label>
        					<input id="rollNum" type="text" class="form-control" name="father_name" placeholder="Father`s Name" value="<?=$memberDtls['father_name'];?>" pattern="[a-zA-Z][a-zA-Z\s]*" minlength="3" maxlength="50" oninvalid="setCustomValidity('Enter Valid Name')"  onchange="try{setCustomValidity('')}catch(e){}"  >				
        					</div><!-- /.form-group -->                  
        				</div><!-- /.col -->				
              <div class="col-md-3">
              <div class="form-group">
              <label class="rollAvl">Spouse Name</label>
              <input id="rollNum" type="text" class="form-control" name="husband_name" placeholder="Husband`s Name"  value="<?=$memberDtls['husband_name'];?>"  >        
              </div><!-- /.form-group -->                  
             </div><!-- /.col -->                 
				      <div class="col-md-3">
                  <div class="form-group">
                    <label>Age as on Date</label>
                    <input type="text" class="form-control" name="ageaod" placeholder="Age as on Date" value="<?=$memberDtls['age_on_date'];?>"  >					
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 
				<div class="col-md-3">
                  <div class="form-group">
                      <label>Permanent Place of resident </label>
                      <textarea class="form-control" rows="3" name="prmnt_p_adres" placeholder="Permanent Place of resident" ><?=$memberDtls['permanent_resident'];?></textarea>
                    </div><!-- /.form-group -->                  
                </div><!-- /.col -->
			 <div class="col-md-3">
                  <div class="form-group">
                      <label>Present Place of resident </label>
                      <textarea class="form-control" rows="3" name="prsnt_p_adres" placeholder="Present Place of resident" ><?=$memberDtls['present_resident'];?></textarea>
                    </div><!-- /.form-group -->                  
                </div><!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Occupation </label>
                    <input type="text" class="form-control" name="occupation" placeholder="Occupation" value="<?=$memberDtls['occupation'];?>" >          
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
				<div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Membership</label>
                    <input type="date" class="form-control" name="dt_of_membrship" value="<?=$memberDtls['date_membership'];?>" >               					
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Name Of nominee</label>
                    <input type="text" class="form-control" name="name_nominee" placeholder="Name Of nominee"  value="<?=$memberDtls['name_nominee'];?>" >                    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
                 </div><!-- /.row --> 

                 <div class="row">
				
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nominee Residence </label>
                   <textarea class="form-control" rows="3" name="nomine_residence" placeholder="Nominee Residence " ><?=$memberDtls['nominee_residence'];?></textarea>        
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
               
               <div class="col-md-3">
                  <div class="form-group">
                    <label>Nominee Relationship</label>
                    <input type="text" class="form-control" name="nominee_relationship" placeholder="Nominee Relationship" value="<?=$memberDtls['nmominee_relationship'];?>"  >                
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->  

                

            <div class="col-md-3">
                  <div class="form-group">
                    <label>Savings bank account number</label>
                    <input type="text" class="form-control" name="savings_bank_acn" placeholder="Savings bank account number" value="<?=$memberDtls['savings_bank_account'];?>"  >    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 

             <div class="col-md-3">
                  <div class="form-group">
                    <label>Salary account number </label>
                    <input type="text" class="form-control" name="salary_acn" placeholder="Salary account number" value="<?=$memberDtls['salary_account'];?>" >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col --> 
          </div> 
          <div class="row">
           <div class="col-md-3">
                  <div class="form-group">
                    <label>Date Of Birth </label>
                    <input type="date" class="form-control" name="dob" value="<?=$memberDtls['dob'];?>" >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>Date Of Retierment </label>
                    <input type="date" class="form-control" name="dor" value="<?=$memberDtls['date_retirment'];?>" >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>Adhar Card Number</label>
                    <input type="text" class="form-control" name="adhar_card_number" placeholder="Adhar Card Number" value="<?=$memberDtls['adhar_number'];?>"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>Pan Card Number</label>
                    <input type="text" class="form-control" name="pan_card_number" placeholder="Pan Card Number" value="<?=$memberDtls['pancard_number'];?>"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
         </div>
        
        <div class="row">
           <div class="col-md-2">
           <div class="form-group">
                      <label for="exampleInputFile">Update Member Image</label>
                      <input type="file" id="exampleInputFile" name="membr_img" >
                      <p class="help-block">Update Member Image</p>
                    </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 
        <div class="col-md-2">
           <div class="form-group">
                      <img src="../common/member_img/<?=$memberDtls['membr_img'];?>" width="120" height="90">
                    </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 

         <div class="col-md-2">
           <div class="form-group">
                      <label for="exampleInputFile">Signature Image</label>
                      <input type="file" id="exampleInputFile" name="signature_img" >
                      <p class="help-block">Member Signature </p>
          </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 
        <div class="col-md-2">
           <div class="form-group">
                      <img src="../common/signature_thumbImpression/<?=$memberDtls['signature_thumb'];?>" width="120" height="90">
                    </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 
        
       <div class="col-md-4">
                   <div class="box-footer">
                    <button id="submt"  type="submit" name="update_oldloan_mbr" class="btn btn-block btn-primary btn-flat">Update</button>
                  </div>                 
                </div><!-- /.col -->
          </div> 
         
				</div>
				
				</form>
              </div><!-- /.row -->
            </div><!-- /.box-body -->            
          </div><!-- /.box -->          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once('footer.php');?>
     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
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
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->
    <script>
      $(function () {
		
		$(document).on('keyup','#lMbrSlNo',function(){           
			  var slNo = $.trim($('#lMbrSlNo').val());		
         $.ajax({
				  url:'ajax_lmbr_slno_valid',
				  data:{slNo:slNo},
				  type : 'POST' ,
				  cache:false,
				  success:function(data){
				  $(".slNoStatus").html(data);
          if(data.indexOf("Sl. No. Not Available") > -1)
				  {
					   $("#submt").prop('disabled', true);
				  }	
                  if(data.indexOf("Sl. No.  Available") > -1)
				  {
					   $("#submt").prop('disabled', false);
				  }	
          //console.log(data);				  
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
