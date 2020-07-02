 <?php 
include_once('main.class.php');
$slNo=$_POST['slNo'];
$loanacno=$_POST['loanacno'];
?>                         
<div class="col-md-3">
 <div class="form-group">
<label>Emi For <b style="color: red;font-size: 14px;">*</b></label>
<select  class="form-control select2" name="loanterm" required style="width: 100%;">
  <option value="" >Select a Emi</option>
   <?php foreach($object->singelEMILedgrAllDtlsBYCustIDNLoanAc($loanacno,$slNo) as $row) { ?>
  <option value="<?= $row['loan_term'];?>" ><?= $row['loan_term'];?>-><?=DATE("M",strtotime($row['due_date']));?>->&nbsp;<?= $row['emi_principal'];?></option>
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