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
	 
	 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Register Of Members & their Nominees            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Members & their Nominees</a></li>
            <li class="active">Add Members</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE -->
		  <?php
				if(isset($_POST['add_newloan_mbr']))
				{
				if($_POST['form_id']==$_SESSION['session_form'])
				{
				$_SESSION['session_form']='';
				$msg=$object->addNewLoanMember();
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
                    <input id="lMbrSlNo" type="text" class="form-control" name="sl-number" placeholder="Serial Number" required="required">          
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->                                 
                </div><!-- /.col -->
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Share Register folio number <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="srfn" placeholder="Share Register folio number"  required >    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Member`s Name  <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="member_name" placeholder="Member Name" pattern="[a-zA-Z][a-zA-Z\s]*" minlength="3" maxlength="50" oninvalid="setCustomValidity('Enter Valid Name')"  onchange="try{setCustomValidity('')}catch(e){}" required >
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->		
                 <div class="col-md-3">
                  <div class="form-group">
                    <label>Mobile Number  <b style="color: red;font-size: 14px;">*</b></label>
                    <input type="text" class="form-control" name="mobile_number"  placeholder="Member Name" pattern="[0-9]{1}[0-9]{9}" maxlength="10"  oninvalid="setCustomValidity('Enter Valid Mobile Number')" onchange="try{setCustomValidity('')}catch(e){}" required >
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->    		
        				<div class="col-md-3">
        					<div class="form-group">
        					<label class="rollAvl">Father`s Name</label>
        					<input id="rollNum" type="text" class="form-control" name="father_name" placeholder="Father`s Name" pattern="[a-zA-Z][a-zA-Z\s]*" minlength="3" maxlength="50" oninvalid="setCustomValidity('Enter Valid Name')"  onchange="try{setCustomValidity('')}catch(e){}"  >				
        					</div><!-- /.form-group -->                  
        				</div><!-- /.col -->				
              <div class="col-md-3">
              <div class="form-group">
              <label class="rollAvl">Spouse Name</label>
              <input id="rollNum" type="text" class="form-control" name="husband_name" placeholder="Husband`s Name"  >        
              </div><!-- /.form-group -->                  
             </div><!-- /.col -->                 
				      <div class="col-md-3">
                  <div class="form-group">
                    <label>Age as on Date</label>
                    <input type="text" class="form-control" name="ageaod" placeholder="Age as on Date"  >					
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 
				<div class="col-md-3">
                  <div class="form-group">
                      <label>Permanent Address </label>
                      <textarea class="form-control" rows="3" name="prmnt_p_adres" placeholder="Permanent Place of resident" ></textarea>
                    </div><!-- /.form-group -->                  
                </div><!-- /.col -->
			 <div class="col-md-3">
                  <div class="form-group">
                      <label>Present Address</label>
                      <textarea class="form-control" rows="3" name="prsnt_p_adres" placeholder="Present Place of resident" ></textarea>
                    </div><!-- /.form-group -->                  
                </div><!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Occupation </label>
                    <input type="text" class="form-control" name="occupation" placeholder="Occupation "  >          
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
				<div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Membership</label>
                    <input type="date" class="form-control" name="dt_of_membrship"  >               					
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Name Of nominee</label>
                    <input type="text" class="form-control" name="name_nominee" placeholder="Name Of nominee"  >                    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
                 </div><!-- /.row --> 

                 <div class="row">
				
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nominee Residence </label>
                   <textarea class="form-control" rows="3" name="nomine_residence" placeholder="Nominee Residence " ></textarea>        
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->
               
               <div class="col-md-3">
                  <div class="form-group">
                    <label>Nominee Relationship</label>
                    <input type="text" class="form-control" name="nominee_relationship" placeholder="Nominee Relationship"  >                
                  </div><!-- /.form-group -->                  
                </div><!-- /.col -->  

                

            <div class="col-md-3">
                  <div class="form-group">
                    <label>Savings bank account number</label>
                    <input type="text" class="form-control" name="savings_bank_acn" placeholder="Savings bank account number"  >    
                  </div><!-- /.form-group -->                  
                </div><!-- /.col --> 

             <div class="col-md-3">
                  <div class="form-group">
                    <label>Salary account number </label>
                    <input type="text" class="form-control" name="salary_acn" placeholder="Salary account number"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
        </div> 
         <div class="row">
           <div class="col-md-3">
                  <div class="form-group">
                    <label>Date Of Birth </label>
                    <input type="date" class="form-control" name="dob" >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>Date Of Retirement </label>
                    <input type="date" class="form-control" name="dor"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>Aadhar Card Number</label>
                    <input type="text" class="form-control" name="adhar_card_number" placeholder="Aadhar Card Number"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
            <div class="col-md-3">
                  <div class="form-group">
                    <label>PAN Card Number</label>
                    <input type="text" class="form-control" name="pan_card_number" placeholder="PAN Card Number"  >    
                  </div><!-- /.form-group -->                  
            </div><!-- /.col -->
         </div>
        
        <div class="row">
           <div class="col-md-4">
           <div class="form-group">
                      <label for="exampleInputFile">Member Image</label>
                      <input type="file" id="exampleInputFile" name="membr_img" >
                      <p class="help-block">Member Image </p>
                    </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 
        <div class="col-md-4">
           <div class="form-group">
                      <label for="exampleInputFile">Signature Image</label>
                      <input type="file" id="exampleInputFile" name="signature_img" >
                      <p class="help-block">Member Signature </p>
                    </div>
                  <!-- /.form-group -->                  
        </div><!-- /.col --> 
        
       <div class="col-md-4">
                   <div class="box-footer">
                    <button id="submt"  type="submit" name="add_newloan_mbr" class="btn btn-block btn-primary btn-flat">Submit</button>
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
