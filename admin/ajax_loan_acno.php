 <?php 
include_once('main.class.php');
$mbrNo=$_POST['mbrNo'];
?>                         
<div class="col-md-3">
<div class="form-group">
<label>Loan Account Number <b style="color: red;font-size: 14px;">*</b></label>
<select  class="form-control select2 loanacNo" name="loan_ac_no" required style="width: 100%;">
  <option value="" >Select a Loan Account No.</option>
   <?php foreach($object->findAMbrLoanLedgerByFolioNo($mbrNo) as $row) { 
   	  $singelParenAcDtls=$object->singelLoanAccountDtlsByAcount($row['loan_account_number'],$mbrNo);
   	  if ( $singelParenAcDtls['status']=='1') {
   	  
   	?>
  <option value="<?= $row['loan_account_number'];?>" ><?= $row['loan_account_number'];?></option>
    <?php } } ?>
</select>                   					
</div><!-- /.form-group -->                  
</div><!-- /.col -->                         

<script>
  $(function () {		  
    //Initialize Select2 Elements
    $(".select2").select2();        
  });
</script>