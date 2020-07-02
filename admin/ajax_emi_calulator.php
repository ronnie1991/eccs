 <?php 
include_once('main.class.php');
$loanAcno=$_POST['loanAcno'];
$membrID=$_POST['membrID'];
$paymentDt=$_POST['paymentDt'];
$recevAmout=$_POST['recevAmout'];
$checkEmiLedger=$object->singelEMILedgrDtlsBYLANnMbrIDRowCount($loanAcno,$membrID);
if($checkEmiLedger==0)
{
  $loanLedger=$object->singelMbrLoanLedgerByLANnMbrId($loanAcno,$membrID);
  $emiDtls=$object->emiLedgerMakinngFor1stTime($loanAcno,$membrID,$paymentDt,$recevAmout);
?>                         
<div class="col-md-3">
      <div class="form-group">
        <label>Loan Date <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control"  value="<?=DATE('d M Y',strtotime($loanLedger['loan_date']));?>" required="" >
      </div><!-- /.form-group -->                  
</div> 
<?php foreach ($emiDtls as $key => $emiRow) {
  ?>
<div class="col-md-3">
      <div class="form-group">
        <label>Day Intervel <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="day_interval" value="<?=$emiRow['daysIntervl'];?>" required="" >
      </div><!-- /.form-group -->                  
</div> 
<div class="col-md-3">
      <div class="form-group">
        <label>EMI Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="emi_principal" value="<?=$emiRow['emiPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>  
<div class="col-md-3">
      <div class="form-group">
        <label>EMI Interest <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="emi_interest" value="<?=$emiRow['emiInterest'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>    
<div class="col-md-3">
      <div class="form-group">
        <label>Outstanding Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="outstanding_principal" value="<?=$emiRow['outStandingPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>    
<div class="col-md-3">
      <div class="form-group">
        <label>New Outstanding Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="new_outstanding_principal" value="<?=$emiRow['newOutstandingPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>
<?php 
}
} 
if($checkEmiLedger>0)
{
  $Eemiledger=$object->singelEMILedgrAllDtlsWithLastByLANnMbrID($loanAcno,$membrID);
  $emiDtls=$object->emiLedgerMakinngForNthTime($loanAcno,$membrID,$paymentDt,$recevAmout);
?>
<div class="col-md-3">
      <div class="form-group">
        <label>last payment Date<b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control"  value="<?=DATE('d M Y',strtotime($Eemiledger['payd_date']));?>" required="" >
      </div><!-- /.form-group -->                  
</div> 
<?php foreach ($emiDtls as $key => $emiRow) {
  ?>
<div class="col-md-3">
      <div class="form-group">
        <label>Day Intervel <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="day_interval" value="<?=$emiRow['daysIntervl'];?>" required="" >
      </div><!-- /.form-group -->                  
</div> 
<div class="col-md-3">
      <div class="form-group">
        <label>EMI Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="emi_principal" value="<?=$emiRow['emiPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>  
<div class="col-md-3">
      <div class="form-group">
        <label>EMI Interest <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="emi_interest" value="<?=$emiRow['emiInterest'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>    
<div class="col-md-3">
      <div class="form-group">
        <label>Outstanding Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="outstanding_principal" value="<?=$emiRow['outStandingPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>    
<div class="col-md-3">
      <div class="form-group">
        <label>New Outstanding Principal <b style="color: red;font-size: 14px;">*</b></label>
        <input type="text" class="form-control" name="new_outstanding_principal" value="<?=$emiRow['newOutstandingPrincipal'];?>" required="" >
      </div><!-- /.form-group -->                  
</div>  
<?php } } ?>
<script>
  $(function () {     
    //Initialize Select2 Elements
    $(".select2").select2();        
  });
</script>