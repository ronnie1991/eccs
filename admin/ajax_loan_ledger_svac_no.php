 <?php 
include_once('main.class.php');
$slNo=$_POST['slNo'];
?>                         
<div class="col-md-3">
<div class="form-group">
<label>Savings account number  <b style="color: red;font-size: 14px;">*</b></label>
<select class="form-control select2 svAcNo" name="sv_ac_no" style="width: 100%;" required>
	<option value="" >Select A Savings account number</option>
	<?php foreach($object->findAllMbrLoanLedgerByAccount($slNo) as $row) { ?>
	<option value="<?= $row['savings_account_number'];?>"><?= $row['savings_account_number'];?> </option>  
	<?php } ?> 
  					  
</select>                  					
</div><!-- /.form-group -->                  
</div><!-- /.col -->                         

<script>
  $(function () {		  
    //Initialize Select2 Elements
    $(".select2").select2();        
  });
</script>