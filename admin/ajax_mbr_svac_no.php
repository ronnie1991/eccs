 <?php 
include_once('main.class.php');
$slNo=$_POST['slNo'];
$mbrSvAc=$object->mbrSvAcNo($slNo);
?>                         
<div class="col-md-3">
<div class="form-group">
<label>Savings account number  <b style="color: red;font-size: 14px;">*</b></label>
<select class="form-control select2" name="mbrSvAc" style="width: 100%;">
  
  <option value="<?= $mbrSvAc['savings_bank_account'];?>"><?= $mbrSvAc['savings_bank_account'];?> </option>  
  					  
</select>                  					
</div><!-- /.form-group -->                  
</div><!-- /.col -->                         

<script>
  $(function () {		  
    //Initialize Select2 Elements
    $(".select2").select2();        
  });
</script>