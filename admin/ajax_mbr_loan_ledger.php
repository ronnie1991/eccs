 <?php 
include_once('main.class.php');
$slNo=$_POST['slNo'];

?>                         
<div class="col-md-3">
<div class="form-group">
<label>Loan Account  <b style="color: red;font-size: 14px;">*</b></label>
 <select  class="form-control select2 loanacno" name="loanac_no" required style="width: 100%;">
  <option value="" >Select a Account</option>
   <?php foreach($object->findAMbrLoanLedgerByFolioNo($slNo) as $row) { ?>
  <option value="<?= $row['loan_account_number'];?>" ><?= $row['loan_account_number'];?></option>
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