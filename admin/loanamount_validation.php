 <?php 
include_once('main.class.php');
$loanAmount=$_POST['loanAmount'];
$loanAcountNo=$_POST['loanAcountNo'];
$slNoSta=$object->loanAccountNumberValidation($loanAmount,$loanAcountNo);

?>                         
