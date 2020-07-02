<?php 
class main
{
	protected $name='mseseccs';
	protected $localhost='localhost';
	protected $root='root';
	protected $password='';
	protected $connect;
	public $db;
	
	 function __construct()
	 {
		 $this->connect();
	 }
	
	public function connect()
	{
		$this->db=new PDO("mysql:host=$this->localhost;dbname=$this->name",$this->root,$this->password);
	}
	//Function Start For Login Users
	public function addLoginUsers()
	{
		$sl_no=$_POST['member_code'];
		$user_id=$_POST['mbr_userid'];
		$password=$_POST['mbr_confirm_password'];
		$created_by=$_SESSION['sl_no'];
		$in_time=time();
		$get_count=$this->db->query("select * from `login_table` WHERE `sl_no`='$sl_no'  ");
		$rowCount=$get_count->rowCount();
		if($rowCount>0)	
		{
			return "<h3 style='color:red;'>Admin Already Exist</h3>";	
		}	
		if($rowCount<1)	
		{
		$insert=$this->db->query("INSERT INTO `login_table`(`sl_no`, `user_id`, `password`, `created_by`, `status`, `in_time`, `up_tilme`) VALUES ('$sl_no','$user_id','$password','$created_by','1','$in_time','$in_time')");
		if($insert)
		{		
		return "<h3 style='color:green;'>Successfully a Admin Created</h3>";	
		}
	   }
	}
	public function updateLoginUsers($decodedUerId)
	{
		$status=$_POST['login_status'];
		$user_id=$_POST['mbr_userid'];
		$password=$_POST['mbr_confirm_password'];
		$created_by=$_SESSION['sl_no'];
		$in_time=time();
		$get_count=$this->db->query("select * from `login_table` WHERE `sl_no`!='$decodedUerId' AND `user_id`='$user_id' ");
		$rowCount=$get_count->rowCount();
		if($rowCount>0)	
		{
			return "<h3 style='color:red;'>Admin Already Exist</h3>";	
		}	
		if($rowCount<1)	
		{
		$insert=$this->db->query("UPDATE `login_table` SET `user_id`='$user_id',`password`='$password',`created_by`='$created_by',`status`='$status',`up_tilme`='$in_time' WHERE `sl_no`='$decodedUerId'");
		if($insert)
		{		
		return "<h3 style='color:green;'>Successfully a Admin Updated</h3>";	
		}
	   }
	}
	public function findAllAdminLoginUsers()
	{
		$sql=$this->db->query("select * from `login_table` ");
		return $fetch=$sql->fetchAll();
	}
	function adminLogin()
	{
		$username=$_POST['user_id'];
		$password=$_POST['password'];
		//$md5_password=md5($password);
		$login=$this->db->query("select * from `login_table` where `user_id`='$username' and `password`='$password' AND `status`='1' ");
		$rowcount=$login->rowCount($login); 
		$singlRc=$login->fetchAll();		    
		if($rowcount>0)
		{
		$fetch_singel=$singlRc[0];   		
		$_SESSION['sl_no'] = $fetch_singel['sl_no'];
           echo "
            <script type=\"text/javascript\">           
		   window.location='dashboard';
            </script>
        ";		
		}
		else
		return "<span style='color:red;font-size: 16px;font-weight:600'>User ID Or Password is Incorrect</span>";		
	}
	public function singelAdminLoginDtls($sl_no)
	{
		$show=$this->db->query("select * from `login_table` WHERE `sl_no`='$sl_no'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	function empLognIdValidation($empLognId)
	{		
		$get_single=$this->db->query("select user_id from `login_table`  WHERE user_id='$empLognId' ");
		$count=$get_single->rowCount();
			
        if($count==1)
        {
			echo "<b style='color:red;'>Employee User ID / Not Available</b>";
		}
		if($count==0)
        {
			echo "<b style='color:green;'>Employee User ID / Available</b>";
		}			
	}
	function logout()
	{		
		session_destroy();
	}
	//Function End For Login Users
	//Function Start For Society Members
	public function addNewLoanMember()
	{
		$sl_no=$_POST['sl-number'];
		$member_name=$_POST['member_name'];
		$mobile_number=$_POST['mobile_number'];
		$father_name=$_POST['father_name'];
		$husband_name=$_POST['husband_name'];
		$age_on_date=$_POST['ageaod'];
		$permanent_resident=$_POST['prmnt_p_adres'];
		$present_resident=$_POST['prsnt_p_adres'];
		$occupation=$_POST['occupation'];
		$date_membership=$_POST['dt_of_membrship'];
		$retirement_date='';
		$name_nominee=$_POST['name_nominee'];
		$nominee_residence=$_POST['nomine_residence'];
		$nmominee_relationship=$_POST['nominee_relationship'];
		$date_reasoned_cessation='';
		$resignation_letter='';
		$register_folio_number=$_POST['srfn'];
		$remarks='';
		$savings_bank_account=$_POST['savings_bank_acn'];
		$salary_account=$_POST['salary_acn'];
		$dob=$_POST['dob'];
		$date_retirment=$_POST['dor'];
		$adhar_number=$_POST['adhar_card_number'];
		$pancard_number=$_POST['pan_card_number'];
		$signature_thumb=$_FILES['signature_img']['name'];
		$membr_img=$_FILES['membr_img']['name'];
		$created_by=$_SESSION['sl_no'];
		$status=1;		
		$in_time=time();
		$insert=$this->db->query("INSERT INTO `register-members`(`sl_no`, `member_name`, `mobile_number`, `father_name`, `husband_name`, `age_on_date`, `permanent_resident`, `present_resident`, `occupation`, `date_membership`, `retirement_date`, `name_nominee`, `nominee_residence`, `nmominee_relationship`, `date_reasoned_cessation`, `resignation_letter`, `register_folio_number`, `remarks`, `savings_bank_account`, `salary_account`, `signature_thumb`, `membr_img`, `dob`, `date_retirment`, `adhar_number`, `pancard_number`, `created_by`, `status`, `inserted`, `up_dated`) VALUES ('$sl_no','$member_name','$mobile_number','$father_name','$husband_name','$age_on_date','$permanent_resident','$present_resident','$occupation','$date_membership','$retirement_date','$name_nominee','$nominee_residence','$nmominee_relationship','$date_reasoned_cessation','$resignation_letter','$register_folio_number','$remarks','$savings_bank_account','$salary_account','$signature_thumb','$membr_img','$dob','$date_retirment','$adhar_number','$pancard_number','$created_by','$status','$in_time','$in_time')");		
		
		move_uploaded_file($_FILES['signature_img']['tmp_name'],'../common/signature_thumbImpression/'.$signature_thumb);
		move_uploaded_file($_FILES['membr_img']['tmp_name'],'../common/member_img/'.$membr_img);
		if($insert)
		{		
		return "<h3 style='color:green;'>Successfully Added</h3>";	
		}
	}
	public function updateOldLoanMember($id)
	{
		$sl_no=$_POST['sl-number'];
		$register_folio_number=$_POST['srfn'];
		$member_name=$_POST['member_name'];
		$mobile_number=$_POST['mobile_number'];
		$father_name=$_POST['father_name'];
		$husband_name=$_POST['husband_name'];
		$age_on_date=$_POST['ageaod'];
		$permanent_resident=$_POST['prmnt_p_adres'];
		$present_resident=$_POST['prsnt_p_adres'];
		$occupation=$_POST['occupation'];
		$date_membership=$_POST['dt_of_membrship'];
		$name_nominee=$_POST['name_nominee'];
		$nominee_residence=$_POST['nomine_residence'];
		$nmominee_relationship=$_POST['nominee_relationship'];		
		$savings_bank_account=$_POST['savings_bank_acn'];
		$salary_account=$_POST['salary_acn'];
		$dob=$_POST['dob'];
		$date_retirment=$_POST['dor'];
		$adhar_number=$_POST['adhar_card_number'];
		$pancard_number=$_POST['pan_card_number'];
		$signature_thumb=$_FILES['signature_img']['name'];
		$membr_img=$_FILES['membr_img']['name'];
		$created_by=$_SESSION['sl_no'];				
		$in_time=time();
		$singlMbrInfo=$this->singelSocietyMBRDtls($id);
		 if($membr_img !='')
		 {
			$file=$membr_img; 
		     move_uploaded_file($_FILES['membr_img']['tmp_name'],'../common/member_img/'.$membr_img);
		     if($singlMbrInfo['membr_img']!='')
		     {
		     unlink('../common/member_img/'.$singlMbrInfo['membr_img']);	
		     }		 
		 }
		 if($membr_img =='')
		 {
		    if($singlMbrInfo['membr_img']!='')
			{
				$file=$singlMbrInfo['membr_img'];				
			}
			if($singlMbrInfo['membr_img']=='')
			{
				$file='';
			}
		 }	

		 if($membr_img !='')
		 {
			$file=$membr_img; 
		     move_uploaded_file($_FILES['membr_img']['tmp_name'],'../common/member_img/'.$membr_img);
		     if($singlMbrInfo['membr_img']!='')
		     {
		     unlink('../common/member_img/'.$singlMbrInfo['membr_img']);	
		     }		 
		 }
		 if($signature_thumb =='')
		 {
		    if($singlMbrInfo['signature_thumb']!='')
			{
				$singatureFile=$singlMbrInfo['signature_thumb'];				
			}
			if($singlMbrInfo['signature_thumb']=='')
			{
				$singatureFile='';
			}
		 }

		 if($signature_thumb !='')
		 {
			$singatureFile=$signature_thumb; 
		     move_uploaded_file($_FILES['signature_img']['tmp_name'],'../common/signature_thumbImpression/'.$signature_thumb);
		     if($singlMbrInfo['signature_thumb']!='')
		     {
		     unlink('../common/signature_thumbImpression/'.$singlMbrInfo['signature_thumb']);	
		     }		 
		 }
        
		  $insert=$this->db->query("UPDATE `register-members` SET `sl_no`='$sl_no',`member_name`='$member_name',`mobile_number`='$mobile_number',`father_name`='$father_name',`husband_name`='$husband_name',`age_on_date`='$age_on_date',`permanent_resident`='$permanent_resident',`present_resident`='$present_resident',`occupation`='$occupation',`date_membership`='$date_membership',`name_nominee`='$name_nominee',`nominee_residence`='$nominee_residence',`nmominee_relationship`='$nmominee_relationship',`register_folio_number`='$register_folio_number',`savings_bank_account`='$savings_bank_account',`salary_account`='$salary_account',`signature_thumb`='$signature_thumb',`membr_img`='$file',`dob`='$dob',`date_retirment`='$date_retirment',`adhar_number`='$adhar_number',`pancard_number`='$pancard_number',`created_by`='$created_by',`up_dated`='$in_time' WHERE `sl_no`='$id'");		
		
		
		if($insert)
		{		
		return "<h3 style='color:green;'>Data Successfully Updated of $member_name</h3>";	
		}
	}
	public function grantMemberRetierment($id)
	{		
		$retirement_date=$_POST['dt_of_retierment'];
		$date_reasoned_cessation=$_POST['date_resone'];
		$remarks=$_POST['remerks'];	
		$resignation_letter=$_FILES['resignation_letter']['name'];	
		$signature_thumb=$_FILES['signature']['name'];
		$created_by=$_SESSION['sl_no'];				
		$in_time=time();

		  $insert=$this->db->query("UPDATE `register-members` SET `retirement_date`='$retirement_date',`date_reasoned_cessation`='$date_reasoned_cessation',`resignation_letter`='$resignation_letter',`remarks`='$remarks',`signature_thumb`='$signature_thumb',`created_by`='$created_by',`status`='0',`up_dated`='$in_time' WHERE `sl_no`='$id'");		
		move_uploaded_file($_FILES['resignation_letter']['tmp_name'],'../common/member_resignation_letter/'.$resignation_letter);
		move_uploaded_file($_FILES['signature']['tmp_name'],'../common/signature_thumbImpression/'.$signature_thumb);
		
		if($insert)
		{		
		return "<h4 style='color:green;'>A Resignation Has Taken Successfully </h4>";	
		}
	}
	 function slNoValidation($slNo)
	{		
		$get_single=$this->db->query("select sl_no from
		`register-members`  WHERE sl_no='$slNo' ");
		$count=$get_single->rowCount();
			
        if($count==1)
        {
			echo "<b style='color:red;'>Sl. No. Not Available</b>";
		}
		if($count==0)
        {
			echo "<b style='color:green;'>Sl. No.  Available</b>";
		}			
	}
	public function findAllSocietyMBRegistration()
	{
		$sql=$this->db->query("select * from `register-members`");
		return $fetch=$sql->fetchAll();
	}
	public function findAllSocietyMBRegistrationBYMembrShipDate($frmDt,$toDt)
	{
		$sql=$this->db->query("select * from `register-members` WHERE `date_membership` BETWEEN '$frmDt' AND '$toDt' ORDER BY `sl_no` ");
		return $fetch=$sql->fetchAll();
	}
	public function exportAllSocietyMBRegistration()
	{
		$get_all=$this->db->query("select * from `register-members` ORDER BY member_name ASC");
		$data=array();
		$i=1;
		while($fetch= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		   $data[]=array("Sl No."=>$i,"Register No."=>$fetch['sl_no'],"Member Name"=>$fetch['member_name'], "Mobile No."=>$fetch['mobile_number'], "Father"=>$fetch['father_name'], "Spouse"=>$fetch['husband_name'],"Age"=>$fetch['age_on_date'],"Permanent Address"=>$fetch['permanent_resident'],"Present Address"=>$fetch['present_resident'],"Ocupation"=>$fetch['occupation'],"Ocupation"=>$fetch['occupation'],"Date Of Membership"=>$fetch['date_membership'],"Retirement Date"=>$fetch['retirement_date'],"Nominee Name"=>$fetch['name_nominee'],"Nominee Residence"=>$fetch['nominee_residence'],"Nominee Relationship"=>$fetch['nmominee_relationship'],"Folio Number"=>$fetch['register_folio_number'],"Savings Bank Account"=>$fetch['savings_bank_account'],"Salary Bank Account"=>$fetch['salary_account'],"D.O.B"=>$fetch['dob'],"Adhaar"=>$fetch['adhar_number'],"Pan"=>$fetch['pancard_number']);   
           $i++;

		}
		return $data;
	}
	public function findAllActiveSocietyMBRegistration()
	{
		$sql=$this->db->query("select * from `register-members` WHERE `status`='1'");
		return $fetch=$sql->fetchAll();
	}
	public function singelSocietyMBRDtls($sl_no)
	{
		$show=$this->db->query("select * from `register-members` WHERE `sl_no`='$sl_no'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	 function mbrSvAcNo($slNo)
	{		
		$get_single=$this->db->query("select `savings_bank_account` from `register-members`  WHERE sl_no='$slNo' ");
		$singel=$get_single->fetchAll();
		return $singel[0];			
	}
	function memberRegisterCount()
	{		
		$get_single=$this->db->query("select * from `register-members` WHERE `status`='1' ");
		$count=$get_single->rowCount();
		return $count;	
	}
	//Function End For Society Members
	//Function Start For Society Members Admission Fees
	public function receivMembrAdmissionFees()
	{
		$member_id=$_POST['membr_slno'];
		$amount_recv=$_POST['receiving_amount'];
		$recv_date=$_POST['admisnfs_recv_dt'];
		$receive_by=$_SESSION['sl_no'];
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `member_admision_fees`(`member_id`, `amount_recv`, `recv_date`, `created_by`, `in_time`) VALUES ('$member_id','$amount_recv','$recv_date','$receive_by','$in_time')");		
		if($insert)
		{		
		return "<h3 style='color:green;'>Fees Successfully Received</h3>";	
		}
	}
	public function findAllMembrAdmissionFees()
	{
		$sql=$this->db->query("select * from `member_admision_fees` ORDER BY member_id");
		return $fetch=$sql->fetchAll();
	}
	public function exportAllMembrAdmissionFees()
	{
		$get_all=$this->db->query("select * from `member_admision_fees` ORDER BY member_id ASC");
		$data=array();
		$i=1;
		while($fetch= $get_all->fetch(PDO::FETCH_BOTH))
		{
		   $singleMbrDtls=$this->singelSocietyMBRDtls($fetch['member_id']);           
		   $data[]=array("Sl No."=>$i,"Register No."=>$fetch['member_id'],"Name"=>$singleMbrDtls['member_name'],"Amount"=>$fetch['amount_recv'],"Date"=>date("d-M-Y", strtotime($fetch['recv_date'])));   
           $i++;

		}
		return $data;
	}
	

	public function findAllMembrAdmissionFeesByMonth($memID,$year,$month)
	{
		$show=$this->db->query("select * from `member_admision_fees` WHERE MONTH(recv_date) = '$month' AND YEAR(recv_date)='$year' AND `member_id`='$memID'");
		return $fetch=$show->fetchAll();
	}
	public function findAllMembrAdmissionFeesBetwnDt($fromDt,$toDt)
	{			
		$show=$this->db->query("select * from `member_admision_fees`  WHERE `recv_date` BETWEEN '$fromDt' AND '$toDt' ORDER BY `recv_date` ");
		return $fetch=$show->fetchAll();
	}

	public function findAllMembrAdmissionFeesByDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount_recv) AS allTotalAdmisnFeesByDt from `member_admision_fees` WHERE `recv_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalAdmisnFeesByDt'];
	}

	//Function End For Society MembersAdmission Fees
	//Function Start For Receipt of Call Money
	public function receivCallMoney()
	{
		$member_slno=$_POST['membr_slno'];
		$loan_account_number=$_POST['loan_ac_no'];
		$receiving_amount=$_POST['receiving_amount'];
		$receiving_date=$_POST['clmn_recv_dt'];
		$receive_by=$_SESSION['sl_no'];
		$closing_date='';
		$closing_remarks='';
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `receipt_call_money`(`member_slno`, `loan_account_number`, `receiving_amount`, `receiving_date`, `receive_by`, `status`, `closing_date`, `closing_remarks`, `in_time`, `up_time`) VALUES ('$member_slno','$loan_account_number','$receiving_amount','$receiving_date','$receive_by','1','$closing_date','$closing_remarks','$in_time','$in_time')");		
		if($insert)
		{		
		return "<h3 style='color:green;'>Data Successfully Inserted </h3>";	
		}
	}
	public function updateShareCallMoney($decId)
	{
		$member_slno=$_POST['membr_slno'];		
		$receiving_amount=$_POST['receiving_amount'];
		$receiving_date=$_POST['clmn_recv_dt'];
		$update_by=$_SESSION['sl_no'];
		$up_time=time();	

		$insert=$this->db->query("UPDATE `receipt_call_money` SET `member_slno`='$member_slno',`receiving_amount`='$receiving_amount',`receiving_date`='$receiving_date',`receive_by`='$update_by',`up_time`='$up_time' WHERE `id`='$decId'");		
		if($insert)
		{		
		return "<h3 style='color:green;'>Data Successfully Updated </h3>";	
		}
	}
	public function closeShareCallMoney($mbrId)
	{		
		$closing_date=$_POST['dt_of_share_return'];
		$closing_remarks=$_POST['remerks'];
		$update_by=$_SESSION['sl_no'];
		$up_time=time();

		foreach ($this->singelShareAcountDetailsBYMbrId($mbrId) as $sharDtls) {

				$updte=$this->db->query("UPDATE `receipt_call_money` SET `status`='0',`closing_date`='$closing_date',`closing_remarks`='$closing_remarks',`receive_by`='$update_by',`up_time`='$up_time' WHERE `member_slno`='$mbrId'");	
			}	
			return "<h3 style='color:green;'>Share Successfully Closed </h3>";	

	}
	public function singelShareAcountDetails($slid)
	{
		$show=$this->db->query("select * from `receipt_call_money` WHERE `id`='$slid'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelShareAcountDetailsBYMbrId($mbrId)
	{
		$show=$this->db->query("select * from `receipt_call_money` WHERE `member_slno`='$mbrId'");
		return $fetch=$show->fetchAll();		
	}
	public function findAllCallMoney()
	{
		$sql=$this->db->query("select * from `receipt_call_money` ORDER BY member_slno");
		return $fetch=$sql->fetchAll();
	}
	public function findAllCallMoneyBtwDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `receipt_call_money` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ORDER BY `member_slno`");
		return $fetch=$sql->fetchAll();
	}
	public function findAllActiveCallMoney()
	{
		$sql=$this->db->query("select * from `receipt_call_money` WHERE `status`='1' ORDER BY member_slno");
		return $fetch=$sql->fetchAll();
	}
	public function findAllActiveCallMoneyBtwDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `receipt_call_money` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' AND `status`='1' ORDER BY `member_slno`");
		return $fetch=$sql->fetchAll();
	}
	public function findAllDistinctCallMoney()
	{
		$sql=$this->db->query("select DISTINCT member_slno from `receipt_call_money` ORDER BY member_slno");
		return $fetch=$sql->fetchAll();
	}
	public function findDistintMbrIdShareMoney()
	{
		$sql=$this->db->query("select * from `receipt_call_money` ORDER BY member_slno");
		return $fetch=$sql->fetchAll();
	}
	public function findMbrSumCallMoney($slno)
	{
		$sql=$this->db->query("select SUM(receiving_amount) AS totalClMNCount from `receipt_call_money` WHERE `member_slno`='$slno' ");
		return $sql->fetch(PDO::FETCH_ASSOC);		
	}
	public function findTotalSumOfCallMoney()
	{
		$sql=$this->db->query("select SUM(receiving_amount) AS totalClMNAmount from `receipt_call_money` WHERE `status`='1' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['totalClMNAmount'];	
	}
	public function findTotalAmountCallMoney()
	{
		$sql=$this->db->query("select SUM(receiving_amount) AS allTotalClMNCount from `receipt_call_money` WHERE `status`='1'  ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalClMNCount'];
	}
	public function findAllShareMoneyByDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `receipt_call_money`  WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ORDER BY `receiving_date` ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllShareMoneyByDateWitoutLoanAcount($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `receipt_call_money`  WHERE `loan_account_number`='null' AND  `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ORDER BY `receiving_date` ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllShareMoneyByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(receiving_amount) AS allShareMoneyByMontht from `receipt_call_money` WHERE Month(receiving_date)='$month' AND YEAR(receiving_date)='$year'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$shareMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allShareMoneyByMontht'] );
		}
			
		return $shareMoneyAray;
	}

	public function findTotalAmountCallMoneyBydate($fromDt,$toDt)
	{
		
		$sql=$this->db->query("select SUM(receiving_amount) AS allTotalCallMonyByDt from `receipt_call_money` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalCallMonyByDt'];
	}
	public function findTotalAmountCallMoneyBydateAndLoanAcNo($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(receiving_amount) AS allTotalCallMonyByDtNAcn from `receipt_call_money` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' AND `loan_account_number`!='null'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalCallMonyByDtNAcn'];
	}
	public function findCallMonyByLanAcMemberId($loanAc,$memberId)
	{
		$show=$this->db->query("select * from `receipt_call_money` WHERE `loan_account_number`='$loanAc' AND `member_slno`='$memberId'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function findCallMonyByMonthYear($memID,$year,$month)
	{
				
		$show=$this->db->query("select * from `receipt_call_money` WHERE MONTH(receiving_date) = '$month' AND YEAR(receiving_date)='$year' AND `member_slno`='$memID'");
		return $fetch=$show->fetchAll();
	}
	function delShareMony()
	{
		$id=$_POST['shareId'];
		$del=$this->db->query("DELETE FROM `receipt_call_money` WHERE `id`='$id' ");
		
	}
	public function exporShareMonyBydate($frmDt,$toDt)
	{
		$shareMoneySum=$this->findTotalAmountCallMoneyBydate($frmDt,$toDt);
		$cgsSum=$this->findTotalAmountCGSLedgrBydate($frmDt,$toDt);
		$scdSum=$this->findTotalAmountLoanLedgerBydate($frmDt,$toDt);
        $shareMoneySumByLN=$this->findTotalAmountCallMoneyBydateAndLoanAcNo($frmDt,$toDt); 
        $scdWithdrawl=(($scdSum)-($cgsSum+$shareMoneySumByLN)); 
		 $data[]=array("Share Money"=>$shareMoneySum,"CGS"=>$cgsSum,"SCD Withdrawal (Loan)"=>$scdWithdrawl); 		
		return $data;

	}
	public function exporAllShareMony()
	{
		
		foreach ($this->findAllCallMoney() as $key => $row) 
		{   
		  $snglSociMbr=$this->singelSocietyMBRDtls($row['member_slno']);					
		  $sumClMn=$this->findMbrSumCallMoney($row['member_slno']);
           $receiveDate=date("d-m-Y", strtotime($row['receiving_date']));  
            
		   $data[]=array("Row"=>$key+1,"Name of the Mamber"=>$snglSociMbr['member_name'],"Sl. No. of Member"=>$snglSociMbr['sl_no'], "Received Date"=>$receiveDate,"Received Amount"=>$row['receiving_amount'], "Total Amount of Share"=>$sumClMn['totalClMNCount']); 
		}
		return $data;
	}
	//Function End For Receipt of Call Money
	//Function Start For Loan Account Number

	public function crateLoanAccountNumber()
	{
		$loan_type=$_POST['typ_loan'];
		$loan_account_no=$_POST['loan_ac_number'];
		$total_loan_amount=$_POST['loan_amount'];
		$total_number_emi=$_POST['number_emi'];
		$total_amount_emi=$_POST['amount_emi'];
		$loan_date=$_POST['loan_date'];
		$status=1;
		$receive_by=$_SESSION['sl_no'];
		$in_time=time();

		$get_count=$this->db->query("select * from `loan_account` WHERE `loan_account_no`='$loan_account_no' ");
		$rowCount=$get_count->rowCount();
		if($rowCount>0)
	    {
			return "<h4 style='color:red'>Loan Account Number Already Exist</h4>";
		}
		else
		{ 
			
		$insert=$this->db->query("INSERT INTO `loan_account`(`loan_type`, `loan_account_no`, `total_loan_amount`, `total_number_emi`, `total_amount_emi`, `loan_date`, `status`, `closing_date`, `loan_close_remarks`, `created_by`, `in_time`) VALUES ('$loan_type','$loan_account_no','$total_loan_amount','$total_number_emi','$total_amount_emi','$loan_date','$status','','','$receive_by','$in_time')");	

		if($insert)
		{		
		return "<h3 style='color:green;'>Data Successfully Inserted </h3>";	
		}
	    }
	}

	public function closeLoanAccountNumber($lan)
	{
		$status=$_POST['ls'];
		$closing_date=$_POST['loan__closing_date'];
		$loan_close_remarks=$_POST['close_loan'];
		$receive_by=$_SESSION['sl_no'];

		$insert=$this->db->query("UPDATE `loan_account` SET `status`='$status',`closing_date`='$closing_date',`loan_close_remarks`='$loan_close_remarks',`created_by`='$receive_by' WHERE `loan_account_no`='$lan'");	

		if($insert)
		{		
		return "<h3 style='color:green;'>The Loan Account has been Successfully Closed</h3>";	
		}
	}

	public function findAllLoanAccountNumber()
	{
		$sql=$this->db->query("select * from `loan_account`");
		return $fetch=$sql->fetchAll();
	}
	public function findAllActiveLoanAccountNumber()
	{
		$sql=$this->db->query("select * from `loan_account` WHERE `status`='1'");
		return $fetch=$sql->fetchAll();
	}
	public function singelLoanAccountNumber($loanAcNo)
	{
		$show=$this->db->query("select * from `loan_account` WHERE `loan_account_no`='$loanAcNo'");
		$singel=$show->fetchAll();
		return $singel[0];
	}	
	public function findTotalAmounLoanAccountBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `loan_account` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findSumOfAmounLoanAccount()
	{
		$sql=$this->db->query("select SUM(total_loan_amount) AS allSumLoanAmount from `loan_account` WHERE `status`='1' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allSumLoanAmount'];
	}
	public function exporAllParentLoan()
	{
		
		foreach ($this->findAllLoanAccountNumber() as $key => $row) 
		{  
		   if($row['status']=='1')
                {$status="Open";}
           else{$status="Closed" ;} 
           $loanDate=date("d-m-Y", strtotime($row['loan_date']));  
            
		   $data[]=array("Row"=>$key+1,"Loan Account"=>$row['loan_account_no'],"Loan Type"=>$row['loan_type'], "Total Amount"=>$row['total_loan_amount'],"Total EMI"=>$row['total_number_emi'], "Loan Date"=>$loanDate, "Loan Status"=>$status); 
		}
		return $data;
	}

	function loanAccountNumberValidation($loanAmount,$loanAcountNo)
	{		
		
		$sql=$this->db->query("select SUM(loan_amount) AS allTotalLLount from `ledger_loan` WHERE `loan_account_number` = '$loanAcountNo' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);
		$totalLoanAmount=$this->singelLoanAccountNumber($loanAcountNo);
		$totalLonAm=$totalLoanAmount['total_loan_amount'];
		$totalLonGivn=$ft['allTotalLLount'];
		$balanceamount=($totalLonAm-$totalLonGivn);
		 if($balanceamount<$loanAmount)
        {
			echo "<b style='color:red;'>Exide the Loan Amount</b>";			
		}
		if($balanceamount>$loanAmount)
        {
			echo "<b style='color:green;'>Loan Amount Available</b>";
		}	
	}
	public function singelLoanAccountDtlsByAcount($loanAcNo,$ledger_folio)
	{
		$show=$this->db->query("select * from `ledger_loan` WHERE `loan_account_number`='$loanAcNo' AND
		 `ledger_folio`='$ledger_folio'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function findTotalLoanAccountBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountLoanAccountBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(loan_amount) AS allLoanAccountBydate from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allLoanAccountBydate'];
	}
	public function findTotalAmountMTLoanBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(loan_amount) AS totalMTloan from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' AND `type_loan`='M.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['totalMTloan'];
	}
	public function findTotalAmountSTLoanBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(loan_amount) AS totalSTloan from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' AND `type_loan`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['totalSTloan'];
	}
	public function findTotalMTLoanAccountBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' AND `type_loan`='M.T' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalMTLoanAccountByMonth($fromDt,$toDt)
	{
	    foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(loan_amount) AS allMTByMontht from `ledger_loan` WHERE Month(loan_date)='$month' AND YEAR(loan_date)='$year' AND `type_loan`='M.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$shareMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allMTByMontht'] );
		}
			
		return $shareMoneyAray;
	}
	public function findTotalSTLoanAccountByMonth($fromDt,$toDt)
	{
	    foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(loan_amount) AS allSTByMontht from `ledger_loan` WHERE Month(loan_date)='$month' AND YEAR(loan_date)='$year' AND `type_loan`='S.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$shareMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allSTByMontht'] );
		}
			
		return $shareMoneyAray;
	}

	public function findTotalSTLoanAccountBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' AND `type_loan`='S.T' ");
		return $fetch=$sql->fetchAll();
	}
	public function closeDisbursedLoanAccountNumber($loanAcNo,$folioNo)
	{
		$status=$_POST['ls'];
		$closing_date=$_POST['loan__closing_date'];
		$remerks=$_POST['lcr'];
		$receive_by=$_SESSION['sl_no'];
		$in_time=time();
			
		$insert=$this->db->query("UPDATE `ledger_loan` SET `closing_date`='$closing_date',`remerks`='$remerks',`status`='$status',`created_by`='$receive_by',`up_time`='$in_time' WHERE `loan_account_number`='$loanAcNo' AND `ledger_folio`='$folioNo' ");	

		if($insert)
		{		
		return "<h3 style='color:green;'>Loan Successfully Closed </h3>";	
		}
	    
	}
	public function exporLoanIssuedToMbr($frmDt,$toDt)
	{
		
		foreach ($this->findTotalLoanAccountBydate($frmDt,$toDt) as $lim) 
		{   
		  $snglSociMbr=$this->singelSocietyMBRDtls($lim['ledger_folio']);
           $loanDate=date("d-m-Y", strtotime($lim['loan_date']));  
            
		   $data[]=array("Loan Issued To Member Date"=>$loanDate,"Particulars"=>$snglSociMbr['member_name'],"Type of loan"=>$lim['type_loan'], "Loan Amount"=>$lim['loan_amount']); 
		}
		return $data;
	}
	public function exportBankDepositeforloanCgsByDt($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `loan_account` WHERE `loan_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalAuditFees=array();		
		while($row= $get_all->fetch(PDO::FETCH_BOTH))
		{  
		 $cgsTotal=$this->findTotalAmountCGSedgrBYLoanAccount($row['loan_account_no']); 
          $share=$this->findCOOperativeShare($row['loan_account_no']);              
          $cgs10=($cgsTotal+(($cgsTotal*10)/100));
          $scdDeposite=(($row['total_loan_amount'])-($cgs10+$share['share_amount']));         
		  $date=date("d-m-Y", strtotime($row['loan_date']));			
		$totalAuditFees[] = array('Date' => $date, 'Type of Loan'=>$row['loan_type'],'C.G.S'=>$cgs10,'S.C.D'=>$scdDeposite,'Total'=>($cgs10+$scdDeposite));  
          
		}
		return $totalAuditFees;
		
	}


	//Function End For Loan Account Number
	//Function Start For Ledger OF Loan 
	public function assignLoanToMambr()
	{
		$loan_date=$_POST['lon_dt'];
		$ledger_folio=$_POST['membr_slno'];
		$type_loan=$_POST['typ_loan'];
		$loan_amount=$_POST['loan_amount'];
		$loan_account_number=$_POST['lon_ac_no'];
		$term_loan=$_POST['term_loan'];
		$rate_Interest=$_POST['roi'];
		$emi=$_POST['emi'];
		$savings_account_number=$_POST['mbrSvAc'];
		$created_by=$_SESSION['sl_no'];
		$closing_date='';
		$remerks='';
		$status=1;		
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `ledger_loan`(`loan_date`, `ledger_folio`, `type_loan`, `loan_amount`, `loan_account_number`, `term_loan`, `rate_Interest`, `emi`, `savings_account_number`, `closing_date`, `remerks`, `status`, `created_by`, `in_time`, `up_time`) VALUES ('$loan_date','$ledger_folio','$type_loan','$loan_amount','$loan_account_number','$term_loan','$rate_Interest','$emi','$savings_account_number','$closing_date','$remerks','$status','$created_by','$in_time','$in_time')");
				
		if($insert)
		{	
		 $base64=base64_encode($loan_account_number);	
		 $base64Saving=base64_encode($savings_account_number);	
		 return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findAllMbrLoanLedger()
	{
		$sql=$this->db->query("select * from `ledger_loan` ORDER BY `ledger_folio` ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllMTLoanLedgerBYDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt' AND '$toDt' AND `type_loan`='M.T' ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllSTLoanLedgerBYDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt' AND '$toDt' AND `type_loan`='S.T' ");
		return $fetch=$sql->fetchAll();
	}
	public function findAMbrLoanLedgerByFolioNo($folioNo)
	{
		$sql=$this->db->query("select * from `ledger_loan` WHERE ledger_folio='$folioNo' AND `status`='1' ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllMbrLoanLedgerByAccount($loanAcNo)
	{
		$sql=$this->db->query("select * from `ledger_loan` WHERE loan_account_number='$loanAcNo' ");
		return $fetch=$sql->fetchAll();
	}
	public function singelMbrLoanLedger($loanAcNo)
	{
		$show=$this->db->query("select * from `ledger_loan` WHERE `loan_account_number`='$loanAcNo'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelMbrLoanLedgerByLANnSVACN($loanAcNo,$savingAcNo)
	{
		$show=$this->db->query("select * from `ledger_loan` WHERE loan_account_number='$loanAcNo' AND `savings_account_number`='$savingAcNo'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelMbrLoanLedgerByLANnMbrId($loanAcNo,$mbrId)
	{
		$show=$this->db->query("select * from `ledger_loan` WHERE `loan_account_number`='$loanAcNo' AND `ledger_folio`='$mbrId'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function findTotalAmountLoanLedger()
	{
		$sql=$this->db->query("select SUM(loan_amount) AS allTotalLLount from `ledger_loan` ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalLLount'];
	}
	public function findTotalAmountLoanLedgerBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(loan_amount) AS allTotalLoanByDt from `ledger_loan` WHERE `loan_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalLoanByDt'];
	}
	public function exporAllDisbursmentOfLoan()
	{
		
		foreach ($this->findAllMbrLoanLedger() as $key => $row) 
		{ 
		   $snglSociMbr=$this->singelSocietyMBRDtls($row['ledger_folio']);
		    
           $loanDate=date("d-m-Y", strtotime($row['loan_date']));  
            
		   $data[]=array("Row"=>$key+1,"Loan Account"=>$row['loan_account_number'],"Sb. Ac."=>$snglSociMbr['savings_bank_account'], "Salary Ac."=>$snglSociMbr['salary_account'],"Folio No."=>$row['ledger_folio'], "Name"=>$snglSociMbr['member_name'], "Type of Loan"=>$row['type_loan'],"T O L"=>$row['term_loan'],"Loan Date"=>$loanDate,"Loan Amount"=>$row['loan_amount'],"R O I"=>$row['rate_Interest'],"E.M.I"=>$row['emi']); 
		}
		return $data;
	}
	//Function End For Ledger OF Loan
	//Function Start For EMI Ledger
	public function emiLedgerMakinngFor1stTime($loanAcNo,$membrID,$paymentDt,$recevAmout)
	{
		
		$mbrlnkdgr=$this->singelMbrLoanLedgerByLANnMbrId($loanAcNo,$membrID);		 
		   	 $loanDate=$mbrlnkdgr['loan_date'];		   	    	
	       $FormatloanDate = strtotime($loanDate);	
            $FormatdnewDt = strtotime($paymentDt);
            $timeDiff = abs($FormatdnewDt - $FormatloanDate);
           $numberDays = $timeDiff/86400;  // 86400 seconds in one day
	        $numberDays = intval($numberDays)+1;
	      $loan_amount=$mbrlnkdgr['loan_amount'];
	        $ri=$mbrlnkdgr['rate_Interest'];
	         $emiInterest=round(((($ri / 100) * $loan_amount)*$numberDays)/365);
	         $emi_principal=$recevAmout-$emiInterest;
	         $outstanding_principa=$loan_amount-$emi_principal;
	          $new_outstang_principal=$loan_amount-$emi_principal;

		 $container=array();
					$container[]=array("daysIntervl"=> $numberDays,
				"emiPrincipal"=>$emi_principal,"emiInterest"=>$emiInterest,"outStandingPrincipal"=>$outstanding_principa,"newOutstandingPrincipal"=>$new_outstang_principal);			
		
		return $container;    
	}
	public function emiLedgerMakinngForNthTime($loanAcNo,$membrID,$paymentDt,$recevAmout)
	{
		$mbrlnkdgr=$this->singelMbrLoanLedgerByLANnMbrId($loanAcNo,$membrID);
		$mbrEmidgr=$this->singelEMILedgrAllDtlsWithLastByLANnMbrID($loanAcNo,$membrID);	
		   	 $lastPaydDate=$mbrEmidgr['payd_date'];
			$now = strtotime($lastPaydDate); // or your date as well
			$your_date = strtotime($paymentDt);
			$datediff =$your_date-  $now ;
			$numberDays = round($datediff / (60 * 60 * 24));
	      $loan_amount=$mbrEmidgr['new_outstang_principal'];
	        $ri=$mbrlnkdgr['rate_Interest'];
	         $emiInterest=round(((($ri / 100) * $loan_amount)*$numberDays)/365);
	         $emi_principal=$recevAmout-$emiInterest;
	         $outstanding_principa=$loan_amount-$emi_principal;
	          $new_outstang_principal=$loan_amount-$emi_principal;

		 $container=array();
					$container[]=array("daysIntervl"=> $numberDays,
				"emiPrincipal"=>$emi_principal,"emiInterest"=>$emiInterest,"outStandingPrincipal"=>$outstanding_principa,"newOutstandingPrincipal"=>$new_outstang_principal);			
		
		return $container;    
	}
	public function receiveEmi()
	{
		 $loan_acunt_no=$_POST['loan_ac_no'];
		 $loanAcountDtls=$this->singelLoanAccountNumber($loan_acunt_no);
		 $loan_type=$loanAcountDtls['loan_type'];		 
		 $cust_id=$_POST['membr_slno'];
		 $lastLoanDtls=$this->singelEMILedgrOfLastEMIDetals($loan_acunt_no,$cust_id);
		 $loan_term=$lastLoanDtls['loan_term']+1;
		 $due_date=$_POST['emi_pmt_dt'];
		 $days_interval=$_POST['day_interval'];
		 $emi_principal=$_POST['emi_principal'];
		 $emi_nterest=$_POST['emi_interest'];
		 $outstanding_principa=$_POST['outstanding_principal'];
		 $new_outstang_principal=$_POST['new_outstanding_principal'];
		 $paid_amount=$_POST['amount_receive'];	
		 $payd_date=$_POST['emi_pmt_dt'];		 
		 $created_by=$_SESSION['sl_no'];
		 $status=1;		
		 $in_time=time();
		 
		 $insert=$this->db->query("INSERT INTO `emi_ledger`(`loan_acunt_no`, `loan_type`, `cust_id`, `loan_term`, `due_date`, `days_interval`, `emi_principal`, `emi_nterest`, `outstanding_principa`, `new_outstang_principal`, `paid_amount`, `status`, `payd_date`, `crated_by`, `in_time`, `up_time`) VALUES ('$loan_acunt_no','$loan_type','$cust_id','$loan_term','$due_date','$days_interval','$emi_principal','$emi_nterest','$outstanding_principa','$new_outstang_principal','$paid_amount','$status','$payd_date','$created_by','$in_time','$in_time')"); 
		  if($insert)
		{	
		return "<h3 style='color:green;'> Successfully Data Inserted</h3>";	
		}
		   
	}
	public function creatNextEMILedgrDtls($loan_account,$member_id,$amount_receive,$pdate)
	{
		$lastEmi=$this->singelEMILedgrAllDtlsBYCustIDNLoanAcLastId($loan_account,$member_id);
		$lastEmiLedger=$this->singelEMILedgrAllDtlsWithLastLoanAmount($loan_account,$member_id);
		$loanLdrDtls=$this->singelMbrLoanLedgerByLANnMbrId($loan_account,$member_id);
		  $date = date('Y-m-d', strtotime('+1 month', strtotime($pdate)));
		  $paymentDate = strtotime($pdate);
		  $year = date('Y', strtotime($date));
	       $month = date('m', strtotime($date));
	        $newDt="$year-"."$month-"."07";	
	        $FormatdnewDt = strtotime($newDt);
            $timeDiff = abs($FormatdnewDt - $paymentDate);
            $numberDays = $timeDiff/86400;  // 86400 seconds in one day
	         $numberDays = intval($numberDays);

	         $loan_amount=$lastEmiLedger['new_outstang_principal'];
	        $ri=$loanLdrDtls['rate_Interest'];
	        $emiInterest=((($ri / 100) * $loan_amount)*$numberDays)/365;
	         $emi_principal=$amount_receive-$emiInterest;
	         $outstanding_principa=$loan_amount-$emi_principal;
	          $new_outstang_principal=$loan_amount-$emi_principal;   		   
             $loanTerm=$lastEmiLedger['loan_term']+1; 	
		 $loan_acunt_no=$loan_account;
		 $cust_saving_acno=$lastEmiLedger['cust_saving_acno'];
		 $cust_id=$member_id;
		 $created_by=$_SESSION['sl_no'];
		 $status=1;		
		 $in_time=time();
		  $insert=$this->db->query("INSERT INTO `emi_ledger`(`loan_acunt_no`, `cust_saving_acno`, `cust_id`, `loan_term`, `due_date`, `days_interval`, `emi_principal`, `emi_nterest`, `outstanding_principa`, `new_outstang_principal`, `status`, `payd_date`, `crated_by`, `in_time`, `up_time`) VALUES ('$loan_acunt_no','$cust_saving_acno','$cust_id','$loanTerm','$newDt','$numberDays','$emi_principal','$emiInterest','$outstanding_principa','$new_outstang_principal','$status','','$created_by','$in_time','$in_time')"); 
		   
	}
	public function singelEMILedgrOfLastEMIDetals($lnacn,$custId)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$lnacn' AND `cust_id`='$custId' ORDER BY id DESC limit 1 ");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrDtlsBYLANnSVACRowCount($lnacn,$savingAcNo)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$lnacn' AND `cust_saving_acno`='$savingAcNo'");
		$rowcount=$show->rowCount($show);
		return $rowcount;
	}
	public function singelEMILedgrDtlsBYLANnMbrIDRowCount($lnacn,$membrID)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE loan_acunt_no='$lnacn' AND `cust_id`='$membrID'");
		$rowcount=$show->rowCount($show);
		return $rowcount;
	}
    public function singelEMILedgrDtls($id)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE id='$id'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	
	public function singelEMILedgrDtlsBYLANnSVACR($lnacn,$cust_id)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$lnacn' AND `cust_id`='$cust_id'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrAllDtls($lnacn,$csa)
	{
		$sql=$this->db->query("select * from `emi_ledger` WHERE loan_acunt_no='$lnacn' AND cust_saving_acno='$csa' ");
		return $fetch=$sql->fetchAll();
	}
	public function singelEMILedgrAllDtlsBYCustIDNLoanAcLastId($lnacn,$cuId)
	{
		$show=$this->db->query("select * from `receive_emi` WHERE `loan_account`='$lnacn' AND `member_id`='$cuId' ORDER BY id DESC limit 1 ");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrAllDtlsWithLastLoanAmount($lnacn,$cuId)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$lnacn' AND `cust_id`='$cuId' ORDER BY id DESC limit 1 ");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrAllDtlsWithLastByLANnSvac($loanAcno,$svAcno)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$loanAcno' AND `cust_saving_acno`='$svAcno' ORDER BY id DESC limit 1 ");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrAllDtlsWithLastByLANnMbrID($loanAcno,$cuId)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$loanAcno' AND `cust_id`='$cuId' ORDER BY id DESC limit 1 ");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function singelEMILedgrAllDtlsBYCustIDNLoanAc($lnacn,$cuId)
	{
		$sql=$this->db->query("select * from `emi_ledger` WHERE `loan_acunt_no`='$lnacn' AND `cust_id`='$cuId' AND `status`='1' ");
		return $fetch=$sql->fetchAll();
	}
	
	public function allEMILedgr()
	{
		$sql=$this->db->query("select * from `emi_ledger` ");
		return $fetch=$sql->fetchAll();
	}
	public function allEMILedgrBYDate($frmDt,$toDt)
	{
		$sql=$this->db->query("select * from `emi_ledger` WHERE `payd_date` BETWEEN '$frmDt' AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	 public function findTotalAmountCashbookReceipts()
	{
		$sql=$this->db->query("select SUM(paid_amount) AS allTotalPaidAmount from `emi_ledger` ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalPaidAmount'];
	}
	public function allClosingBalance()
	{
		$sql=$this->db->query("select * from `opening_balance_receipt` ");
		return $fetch=$sql->fetchAll();
	}
	public function openingBalanceInReceipt($frmDt)
	{
		$year=date('Y', strtotime($frmDt));
		$month=date('m', strtotime($frmDt));
		$show=$this->db->query("SELECT * FROM `opening_balance_receipt` WHERE YEAR(date) = '$year'  AND MONTH(date) = '$month' ");
		$rowcount=$show->rowCount($show);
		if($rowcount>0)
		{
		$singel=$show->fetchAll();
		return $singel[0];
	    }
	    if($rowcount==null)
		{		
		return 0;
	    }
	}
	public function chkClosingBalanceExe($frmDt)
	{
		$year=date('Y', strtotime($frmDt));
		$month=date('m', strtotime($frmDt));
		$show=$this->db->query("SELECT * FROM `opening_balance_receipt` WHERE YEAR(date) = '$year'  AND MONTH(date) = '$month'");
		return $rowcount=$show->rowCount($show);
		
	}
	public function insertClosingBlance($frmDt,$cb)
	{
		$in_time=time();
		$show=$this->db->query("INSERT INTO `opening_balance_receipt`(`balance`, `date`, `created_by`, `in_time`) VALUES ('$cb','$frmDt','1','$in_time')");		
		
	}
	function delClosingBalance()
	{
		$id=$_POST['closigDtlsId'];
		$del=$this->db->query("DELETE FROM `opening_balance_receipt` WHERE `id`='$id' ");
		
	}
    public function findTotalAmountEMILedgr()
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allTotalEmicount from `emi_ledger` ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalEmicount'];
	}
	public function findTotalAmountEMILedgrByAcNo($loanacno,$sv_ac_no)
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allTotalEmicountByAc from `emi_ledger` WHERE `loan_acunt_no`='$loanacno' AND `cust_saving_acno`='$sv_ac_no' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalEmicountByAc'];
	}
	public function findTotalAmountEMIPrincipalLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allTotalEmiPrincipalcountByDt from `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalEmiPrincipalcountByDt'];
	}

	public function findTotalAmountEMIInterestLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_nterest) AS allTotalINTERESTcountByDt from `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalINTERESTcountByDt'];
	}
	public function findTotalAmountMTEMIPrincipalLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allTotalMTEmiPrincipalcountByDt from `emi_ledger` WHERE `loan_type`='M.T' AND `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalMTEmiPrincipalcountByDt'];
	}
	public function findTotalAmountMTEMIInterestLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_nterest) AS allTotalMTINTERESTcountByDt from `emi_ledger` WHERE `loan_type`='M.T' AND `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalMTINTERESTcountByDt'];
	}
	public function findTotalAmountSTEMIPrincipalLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allTotalSTEmiPrincipalcountByDt from `emi_ledger` WHERE `loan_type`='S.T' AND `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalSTEmiPrincipalcountByDt'];
	}
	public function findTotalAmountSTEMIInterestLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_nterest) AS allTotalSTINTERESTcountByDt from `emi_ledger` WHERE `loan_type`='S.T' AND `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalSTINTERESTcountByDt'];
	}
	public function receiveEmiFromMember()
	{
		$member_id=$_POST['membr_slno'];
		$loan_account=$_POST['loanac_no'];
		$emi_for=$_POST['loanterm'];
		$amount_receive=$_POST['amount_receive'];
		$date=$_POST['emi_pmt_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();
		$insert=$this->db->query("INSERT INTO `receive_emi`(`member_id`, `loan_account`, `emi_for`, `amount_receive`, `date`, `receive_by`, `in_time`, `up_time`) VALUES ('$member_id','$loan_account','$emi_for','$amount_receive','$date','$created_by','$in_time','$in_time')");
		$update=$this->db->query("UPDATE `emi_ledger` SET `status`='0',`payd_date`='$date',`crated_by`='$created_by',`up_time`='$in_time' WHERE `cust_id`='$member_id' AND `loan_acunt_no`='$loan_account' AND `loan_term`='$emi_for' ");
        $nextEmiLedger=$this->creatNextEMILedgrDtls($loan_account,$member_id,$amount_receive,$date);
		if($insert && $update)
		{	
		return "<h3 style='color:green;'> Successfully Data Inserted</h3>";	
		}
	}
	public function eMILedgrDtlsByMonthFrVouchr($memID,$year,$month)
	{
		$show=$this->db->query("select * from `emi_ledger` WHERE MONTH(payd_date) = '$month' AND YEAR(payd_date)='$year' AND `cust_id`='$memID'");
		return $fetch=$show->fetchAll();
	}
	public function findAllEmiLedgerLoan($fromDt,$toDt)
	{

		$sql=$this->db->query("SELECT * FROM `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountEMIPrincipalBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(emi_principal) AS allEMIPrincipalByDt from `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allEMIPrincipalByDt'];
	}
	public function findSUMAmountMTEMIPrincipalByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allEMIPrincipalByDt from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='M.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allEMIPrincipalByDt'] );
		}
			
		return $emiPrnciAray;
	}
	public function findSUMAmountSTEMIPrincipalByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allEMISTPrincipalByDt from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allEMISTPrincipalByDt'] );
		}
			
		return $emiPrnciAray;
	}
	 function getMonthsInRange($frmDt, $toDt)
	  {
	    $months = array();
	    while (strtotime($frmDt) <= strtotime($toDt)) {
	    $months[] = array('year' => date('Y', strtotime($frmDt)), 'month' => date('m', strtotime($frmDt)), );
	    $frmDt = date('d M Y', strtotime($frmDt.'+ 1 month'));
	    }

	    return $months;
	    
	   }
	public function findAllEmiLedgerMTLoan($fromDt,$toDt)
	{

		$sql=$this->db->query("SELECT * FROM `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt'  AND '$toDt' AND `loan_type`='M.T' ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllEmiInterestLedgerMTLoanByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_nterest) AS allEmiInterestByMontht from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='M.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$mtEmiInterestAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allEmiInterestByMontht'] );
		}
			
		return $mtEmiInterestAray;
	}
	public function findAllEmiInterestLedgerSTLoanByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_nterest) AS allSTEmiInterestByMontht from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$stmtEmiInterestAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allSTEmiInterestByMontht'] );
		}
			
		return $stmtEmiInterestAray;
	}
	public function findAllEmiLedgerMTLoanByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allMTEmiByMontht from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='M.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiMTMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allMTEmiByMontht'] );
		}
			
		return $emiMTMoneyAray;
	}
	public function findAllEmiLedgerSTLoanByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allMTEmiByMontht from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiMTMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allMTEmiByMontht'] );
		}
			
		return $emiMTMoneyAray;
	}
	public function findSUMSTPrincipalAmountByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS stPrincipalByMonth from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiInterestAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['stPrincipalByMonth'] );
		}
			
		return $emiInterestAray;
	}
	public function findSUMSTInterestAmountByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_nterest) AS stInterestByMonth from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiInterestAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['stInterestByMonth'] );
		}
			
		return $emiInterestAray;
	}
	public function findAllEmiLedgerSTLoan($fromDt,$toDt)
	{

		$sql=$this->db->query("SELECT * FROM `emi_ledger` WHERE `payd_date` BETWEEN '$fromDt'  AND '$toDt' AND `loan_type`='S.T' ");
		return $fetch=$sql->fetchAll();
	}
	function delEmiLedger()
	{
		$id=$_POST['emiDtlsId'];
		$del=$this->db->query("DELETE FROM `emi_ledger` WHERE `id`='$id' ");
		
	}
	public function exportPrincipalDtlsLedgerMTBtDate($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allEMIPrincipalByDt from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='M.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);
		$engMonth=$this->numrcMonth($month);
		$monthYear=$engMonth.'-'.$year;	
		$emiPrnciAray[] = array('Collected Form Members (Principal)' => $monthYear, 'amount'=>$ft['allEMIPrincipalByDt'] );
		}
			
		return $emiPrnciAray;
		
	}
	public function exportPrincipalDtlsLedgerSTBtDate($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(emi_principal) AS allEMIPrincipalByDt from `emi_ledger` WHERE Month(payd_date)='$month' AND YEAR(payd_date)='$year' AND `loan_type`='S.T'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);
		$engMonth=$this->numrcMonth($month);
		$monthYear=$engMonth.'-'.$year;	
		$emiPrnciAray[] = array('Collected Form Members (Principal)' => $monthYear, 'amount'=>$ft['allEMIPrincipalByDt'] );
		}
			
		return $emiPrnciAray;
		
	}	
	public function exportPrincipalDtlsLedgerMTBtDateDepositToBank($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$engMonth=$this->numrcMonth($month);
		    $monthYear=$engMonth.'-'.$year;	
			$sql=$this->db->query("select SUM(bank_amount) AS depositedVCCBByMonth from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='M.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('Deposited To Bank' => $monthYear, 'amount'=>$ft['depositedVCCBByMonth'] );
		}
			
		return $emiPrnciAray;
		
	}
	public function exportPrincipalDtlsLedgerSTBtDateDepositToBank($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$engMonth=$this->numrcMonth($month);
		    $monthYear=$engMonth.'-'.$year;	
			$sql=$this->db->query("select SUM(bank_amount) AS depositedVCCBByMonth from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('Deposited To Bank' => $monthYear, 'amount'=>$ft['depositedVCCBByMonth'] );
		}
			
		return $emiPrnciAray;
		
	}
	public function exportDtlListOfMTLoanBtDate($frmDt,$toDt)
	{
		$get_all=$this->db->query("SELECT * FROM `emi_ledger` WHERE `payd_date` BETWEEN '$frmDt'  AND '$toDt' AND `loan_type`='M.T'  ORDER BY payd_date ASC ");
		$data=array();
		$i=1;
		while($fetch= $get_all->fetch(PDO::FETCH_BOTH))
		{   
		  $singlMbrDtls=$this->singelSocietyMBRDtls($fetch['cust_id']);
          $loanLedgerDetls=$this->singelLoanAccountDtlsByAcount($fetch['loan_acunt_no'],$fetch['cust_id']); 
           if($singlMbrDtls['date_retirment']=='0000-00-00')
           {
            $reterStatus='N/A';
           }
           if($singlMbrDtls['date_retirment']!='0000-00-00')
           {
            $reterStatus=$singlMbrDtls['date_retirment'];
           } 
           $loanIsuDate=date("d-m-Y", strtotime($loanLedgerDetls['loan_date']));  
           $emiDue=$loanLedgerDetls['term_loan']-$fetch['loan_term'];   
		   $data[]=array("Sl No."=>$i,"Name of the Mamber"=>$singlMbrDtls['member_name'],"L/F"=>$singlMbrDtls['sl_no'], "Date of Retirment"=>$reterStatus,"Membership No"=>$singlMbrDtls['register_folio_number'], "Date of issue of loan"=>$loanIsuDate,"Amount of loan issued"=>$loanLedgerDetls['loan_amount'],"Rate of Interest"=>$loanLedgerDetls['rate_Interest'],"No of EMI fixed"=>$loanLedgerDetls['term_loan'],"Amount of EMI fixed"=>$loanLedgerDetls['emi'],"No of EMI Due"=>$emiDue,"No of EMI paid"=>$fetch['loan_term'],"Out Standing Principal"=>$fetch['outstanding_principa'],"Interest"=>'N/A',"Of Which O/D Prin"=>'N/A');   
           $i++;

		}
		return $data;
	}
	public function exportDtlListOfSTLoanBtDate($frmDt,$toDt)
	{
		$get_all=$this->db->query("SELECT * FROM `emi_ledger` WHERE `payd_date` BETWEEN '$frmDt'  AND '$toDt' AND `loan_type`='S.T'  ORDER BY payd_date ASC ");
		$data=array();
		$i=1;
		while($fetch= $get_all->fetch(PDO::FETCH_BOTH))
		{   
		  $singlMbrDtls=$this->singelSocietyMBRDtls($fetch['cust_id']);
          $loanLedgerDetls=$this->singelLoanAccountDtlsByAcount($fetch['loan_acunt_no'],$fetch['cust_id']); 
           if($singlMbrDtls['date_retirment']=='0000-00-00')
           {
            $reterStatus='N/A';
           }
           if($singlMbrDtls['date_retirment']!='0000-00-00')
           {
            $reterStatus=$singlMbrDtls['date_retirment'];
           } 
           $loanIsuDate=date("d-m-Y", strtotime($loanLedgerDetls['loan_date']));  
           $emiDue=$loanLedgerDetls['term_loan']-$fetch['loan_term'];   
		   $data[]=array("Sl No."=>$i,"Name of the Mamber"=>$singlMbrDtls['member_name'],"L/F"=>$singlMbrDtls['sl_no'], "Date of Retirment"=>$reterStatus,"Membership No"=>$singlMbrDtls['register_folio_number'], "Date of issue of loan"=>$loanIsuDate,"Amount of loan issued"=>$loanLedgerDetls['loan_amount'],"Rate of Interest"=>$loanLedgerDetls['rate_Interest'],"No of EMI fixed"=>$loanLedgerDetls['term_loan'],"Amount of EMI fixed"=>$loanLedgerDetls['emi'],"No of EMI Due"=>$emiDue,"No of EMI paid"=>$fetch['loan_term'],"Out Standing Principal"=>$fetch['outstanding_principa'],"Interest"=>'N/A',"Of Which O/D Prin"=>'N/A');   
           $i++;

		}
		return $data;
	}
	public function exporAllEMILedger()
	{
		
		foreach ($this->allEMILedgr() as $key => $row) 
		{ 
		   $snglSociMbr=$this->singelSocietyMBRDtls($row['cust_id']);
		    
           $dueDate=date("d-m-Y", strtotime($row['due_date']));  
            
		   $data[]=array("Row"=>$key+1,"Name"=>$snglSociMbr['member_name'],"Salary Account Number"=>$snglSociMbr['salary_account'], "Loan account Number"=>$row['loan_acunt_no'],"Date of Payment"=>$dueDate, "Emi Principal"=>$row['emi_principal'], "Emi Interest"=>$row['emi_nterest'],"Outstanding Principal"=>$row['new_outstang_principal']); 
		}
		return $data;
	}
	public function exporReceipt($frmDt,$toDt)
	{
		$emiPrincipalSum=$this->findTotalAmountEMIPrincipalLedgrBydate($frmDt,$toDt);
        $emiInterestSum=$this->findTotalAmountEMIInterestLedgrBydate($frmDt,$toDt);
        $toEH=$emiPrincipalSum+$emiInterestSum;
		 $data[]=array("Particulars"=>'EMI',"Bank Amount (Principal)"=>$emiPrincipalSum,"Cash Amount (Interest)"=>$emiInterestSum, "Total Under Each Head"=>$toEH); 		
		return $data;
	}
	//Function END For EMI Ledger
	//Function Start For CGS Ledger
	public function receivCGSMoney()
	{
		$member_slno=$_POST['membr_slno'];
		$loanaccount=$_POST['loan_ac_no'];
		$loanAcountDtls=$this->singelMbrLoanLedgerByLANnMbrId($loanaccount,$member_slno);
		$loan_amount=$loanAcountDtls['loan_amount'];
		$cgs=$_POST['receiving_amount'];
		$date=$_POST['cgsmn_recv_dt'];
		$created_by=$_SESSION['sl_no'];
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `cgs`(`member-Id`, `loanaccount`, `loan_amount`, `cgs`, `date`, `created_by`, `in_time`, `up_time`) VALUES ('$member_slno','$loanaccount','$loan_amount','$cgs','$date','$created_by','$in_time','$in_time')");		
		if($insert)
		{		
		return "<h3 style='color:green;'>C.G.S Successfully Received </h3>";	
		}
	}
	public function allCGSLedgr()
	{
		$sql=$this->db->query("select * from `cgs` ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountCGSedgr()
	{
		$sql=$this->db->query("select SUM(cgs) AS allTotalcgscount from `cgs` ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalcgscount'];
	}
	public function findCGSByLanAcMemberId($loanAc,$memberId)
	{
		$show=$this->db->query("select * from `cgs` WHERE `loanaccount`='$loanAc' AND `member-Id`='$memberId'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function findTotalAmountCGSedgrBYLoanAccount($loanaccount)
	{
		$sql=$this->db->query("select SUM(cgs) AS allTotalcgscount from `cgs` WHERE `loanaccount`='$loanaccount'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalcgscount'];
	}
	public function findTotalAmountCGSLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(cgs) AS allTotalcgsByDt from `cgs` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalcgsByDt'];
	}
	public function findTotalCGSLedgrByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(cgs) AS allCGSMoneyByMontht from `cgs` WHERE Month(date)='$month' AND YEAR(date)='$year'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$CGSMoneyAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allCGSMoneyByMontht'] );
		}
			
		return $CGSMoneyAray;
	}
	public function findTotalCGSLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `cgs` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	//Function END For CGS Ledger
	//Function Start For Expenditure  Ledger
	public function addExpenditure()
	{
		$loan_account_no=$_POST['loan_account_number'];
		$bank_amount=$_POST['bank_amount'];
		$cash_amount=$_POST['cash_ampunt'];
		$total=$_POST['total'];
		$date=$_POST['date'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `expenditure`(`loan_account_no`, `bank_amount`, `cash_amount`, `total`, `date`, `created_by`, `in_time`, `up_time`) VALUES ('$loan_account_no','$bank_amount','$cash_amount','$total','$date','$created_by','$in_time','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function allExpenditure()
	{
		$sql=$this->db->query("select * from `expenditure` ");
		return $fetch=$sql->fetchAll();
	}
	//Function END For Expenditure  Ledger
	//Function Start For V C C B  Interest
	public function addVccbInterest()
	{
		$account_name=$_POST['acount_type'];
		$amount=$_POST['receiving_amount'];
		$recev_date=$_POST['vccbintere_recv_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `vccb_interest`(`account_name`, `amount`, `recev_date`, `created_by`, `in_time`) VALUES ('$account_name','$amount','$recev_date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountBankInterestreceiptVCCBBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalBIRVCCBBByDt from `vccb_interest` WHERE `recev_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalBIRVCCBBByDt'];
	}
	public function findTotalVCCBLedgrBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `vccb_interest` WHERE `recev_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function exportTotalVCCBLedgrBydate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `vccb_interest` WHERE `recev_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalVccbInterest=array();		
		while($vccbInterest= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($vccbInterest['recev_date']));			
		$totalVccbInterest[] = array('Date' => $date, 'Account Name'=>$vccbInterest['account_name'], 'Amount'=>$vccbInterest['amount']);  
          
		}
		return $totalVccbInterest;
		
	}
	//Function END For V C C B   Interest
	//Function Start For Dividend
	public function addDividend()
	{
		$amount=$_POST['receiving_amount'];
		$date=$_POST['divident_recv_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `recevd_dividend`(`amount`, `date`, `creted_by`, `in_time`) VALUES ('$amount','$date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function allDividend()
	{
		$sql=$this->db->query("select * from `recevd_dividend` ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountDividend()
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalDividend from `recevd_dividend`  ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalDividend'];
	}
	public function findTotalAmountDividendBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalDividendByDt from `recevd_dividend` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalDividendByDt'];
	}
	public function findTotalAmountDividendBydateListed($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `recevd_dividend` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function exportTotalAmountDividendByDate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `recevd_dividend` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalDividend=array();		
		while($dividend= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($dividend['date']));			
		$totalDividend[] = array('Date' => $date, 'Amount'=>$dividend['amount']);  
          
		}
		return $totalDividend;
		
	}

	//Function END For Dividend
	
	//Function Start For S.B.I (Current Account)
	public function addSBI()
	{
		$amount=$_POST['receiving_amount'];
		$date=$_POST['sbi_recv_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `sbi_bnk_intrst_recpt`(`receive_amount`, `date`, `creted_by`, `in_time`) VALUES ('$amount','$date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findAllBankInterestreceiptSBIbyDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(receive_amount) AS allTotalBankInterestreceiptSBIByDt from `sbi_bnk_intrst_recpt` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalBankInterestreceiptSBIByDt'];
	}
	public function findAllSBIInterest($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `sbi_bnk_intrst_recpt` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function exportTotalSBIInterestByDate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `sbi_bnk_intrst_recpt` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalSBIInterest=array();		
		while($sbiInterest= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($sbiInterest['date']));			
		$totalSBIInterest[] = array('Date' => $date, 'Amount'=>$sbiInterest['receive_amount']);  
          
		}
		return $totalSBIInterest;
		
	}
	//Function END For S.B.I (Current Account)
	//Function Start For Withdrawal from Bank
	public function withdrawalVccb()
	{
		$name_of_account=$_POST['acount_type'];
		$withdrwl_amount=$_POST['withdrawal_amount'];
		$withdrwl_date=$_POST['withdrawal_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `withdrwl_from_bank_vccb`(`name_of_account`, `withdrwl_amount`, `withdrwl_date`, `created_by`, `in_time`) VALUES ('$name_of_account','$withdrwl_amount','$withdrwl_date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountWithdrawalVccbBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(withdrwl_amount) AS allTotalWithdrawalVccbByDt from `withdrwl_from_bank_vccb` WHERE `withdrwl_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalWithdrawalVccbByDt'];
	}
	public function withdrawalSBI()
	{
		$withdrawal_amount=$_POST['withdrawal_amount'];
		$withdrawal_date=$_POST['withdrawal_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `withdrawal_sbi`(`withdrawal_amount`, `withdrawal_date`, `creted_by`, `in_time`) VALUES ('$withdrawal_amount','$withdrawal_date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountwithdrawalSBIBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(withdrawal_amount) AS allTotalwithdrawalSBIByDt from `withdrawal_sbi` WHERE `withdrawal_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalwithdrawalSBIByDt'];
	}
	public function findAllWithdrawlFromSBI($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `withdrawal_sbi` WHERE `withdrawal_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findAllWithdrawlFromSBIByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(withdrawal_amount) AS allwithdrwalSBIByMontht from `withdrawal_sbi` WHERE Month(withdrawal_date)='$month' AND YEAR(withdrawal_date)='$year'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$withfromSbiAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['allwithdrwalSBIByMontht'] );
		}
			
		return $withfromSbiAray;
	}
	public function findTotalAmountDepositedwalSBIBBydateByList($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `withdrwl_from_bank_vccb` WHERE `withdrwl_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountDepositedwalSBIBBydateByListByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(withdrwl_amount) AS alldepWithSBIByMontht from `withdrwl_from_bank_vccb` WHERE Month(withdrwl_date)='$month' AND YEAR(withdrwl_date)='$year'");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$totalAmountDpVccbAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['alldepWithSBIByMontht'] );
		}
			
		return $totalAmountDpVccbAray;
	}
	public function findTotalAmountDepositedwalVCCBBydateByDate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(withdrwl_amount) AS allDepositedwalVCCBBydateByList from `withdrwl_from_bank_vccb` WHERE `withdrwl_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allDepositedwalVCCBBydateByList'];
	}


	//Function END For Withdrawal from Bank
	//Function Start For Miscellaneous
	public function addMiscellaneous()
	{
		$reson_miscellaneous=$_POST['miscellaneous_reason'];
		$miscellaneous_amount=$_POST['miscellaneous_amount'];
		$miscellaneous_date=$_POST['miscellaneous_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `add_miscellaneous`(`reson_miscellaneous`, `miscellaneous_amount`, `miscellaneous_date`, `created_by`, `in_time`) VALUES ('$reson_miscellaneous','$miscellaneous_amount','$miscellaneous_date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountMiscellaneousBydateByList($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `add_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountMiscellaneousBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(miscellaneous_amount) AS allTotalMiscellaneousByDt from `add_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalMiscellaneousByDt'];
	}
	public function exporMiscellaneousBydateByList($frmDt,$toDt)
	{
		foreach ($this->findTotalAmountMiscellaneousBydateByList($frmDt,$toDt) as  $miscellaneous) {
			$date=date("d-M-Y", strtotime($miscellaneous['miscellaneous_date']));
		    $data[]=array("Date"=>$date,"Reasone"=>$miscellaneous['reson_miscellaneous'],"Amount"=>$miscellaneous['miscellaneous_amount']); 
		        }        
		 		
		return $data;
	}
	
	public function findAllReceiptMiscellaneous()
	{
		$sql=$this->db->query("SELECT * FROM `add_miscellaneous`");
		return $fetch=$sql->fetchAll();
	}
	function delReceiptMiscellaneous()
	{
		$id=$_POST['receiptMisceDele'];
		$del=$this->db->query("DELETE FROM `add_miscellaneous` WHERE `id`='$id' ");
		
	}

	//Function End For Miscellaneous

	//Function Start For Grand Total in Receipts

	public function findTotalGrandTotalinReceiptsBydate($frmDt,$toDt)
	{
		$emiPrincipalSum=$this->findTotalAmountEMIPrincipalLedgrBydate($frmDt,$toDt);
        $emiInterestSum=$this->findTotalAmountEMIInterestLedgrBydate($frmDt,$toDt);
        $toEH=$emiPrincipalSum+$emiInterestSum;	
        $shareMoneySum=$this->findTotalAmountCallMoneyBydate($frmDt,$toDt); 
        $cgsSum=$this->findTotalAmountCGSLedgrBydate($frmDt,$toDt);
        $scdSum=$this->findTotalAmountLoanLedgerBydate($frmDt,$toDt);
	    $shareMoneySumByLN=$this->findTotalAmountCallMoneyBydateAndLoanAcNo($frmDt,$toDt); 
	    $scdWithdrawl=(($scdSum)-($cgsSum+$shareMoneySumByLN));   
	    $totalLoan=$this->findTotalAmountLoanLedgerBydate($frmDt,$toDt); 
	    $totalMemberAdminFee=$this->findAllMembrAdmissionFeesByDate($frmDt,$toDt); 
	    $totalBankInterestreceiptSBI=$this->findAllBankInterestreceiptSBIbyDate($frmDt,$toDt); 
	    $totalBankInterestreceiptVCCB=$this->findTotalAmountBankInterestreceiptVCCBBydate($frmDt,$toDt); 
	    $totalDividend=$this->findTotalAmountDividendBydate($frmDt,$toDt);
	    $totalwithdrawalSBI=$this->findTotalAmountwithdrawalSBIBydate($frmDt,$toDt);
	    $totalwithdrawalVccb=$this->findTotalAmountWithdrawalVccbBydate($frmDt,$toDt); 
	    $totalMiscellaneous=$this->findTotalAmountMiscellaneousBydate($frmDt,$toDt);  
	    $total=($toEH+$shareMoneySum+$cgsSum+$scdWithdrawl+$totalLoan+$totalMemberAdminFee+$totalBankInterestreceiptSBI+$totalBankInterestreceiptVCCB+$totalDividend+$totalwithdrawalSBI+$totalwithdrawalVccb+$totalMiscellaneous);

        return	$total;
	}

	//Function End For Grand Total in Receipts

	//Function Start For Expenditure

	//Function Start For EMI Deposited to VCCB
    public function loanAccountDtls($loanAc)
	{
		$show=$this->db->query("SELECT * FROM `loan_account` WHERE `loan_account_no`='$loanAc'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function addEMIDepositedVCCB()
	{
		$date=$_POST['emi_deposit_vccb_dt'];
		$particulars=$_POST['particulars'];
		$loanAcountDtls=$this->loanAccountDtls($particulars);
		$loan_type=$loanAcountDtls['loan_type'];
		$voucher=$_POST['voucher'];
		$bank_amount=$_POST['bank_amount'];
		$cash_amount=$_POST['cash_amount'];
		$total=$_POST['tueh'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `emi_deposit_vccb`(`date`, `particulars`, `loan_type`, `voucher`, `bank_amount`, `cash_amount`, `total`, `created_by`, `in_time`) VALUES ('$date','$particulars','$loan_type','$voucher','$bank_amount','$cash_amount','$total','$created_by',$in_time)");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findAllVCCBBDeposited()
	{
		$sql=$this->db->query("SELECT * FROM `emi_deposit_vccb` ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalAmountDepositedVCCBBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `emi_deposit_vccb` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}

	public function findSUMMTAmountDepositedVCCBByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(bank_amount) AS depositedVCCBByMonth from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='M.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['depositedVCCBByMonth'] );
		}
			
		return $emiPrnciAray;
	}
	public function findSUMMTInterestAmountDepositedVCCBByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(cash_amount) AS mtInterestSum from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='M.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['mtInterestSum'] );
		}
			
		return $emiPrnciAray;
	}
	public function findSUMSTAmountDepositedVCCBByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(bank_amount) AS depositedVCCBByMonth from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['depositedVCCBByMonth'] );
		}
			
		return $emiPrnciAray;
	}

	public function findSUMSTPrincipalDepositedVCCBByMonth($fromDt,$toDt)
	{
		foreach ($this->getMonthsInRange($fromDt,$toDt) as  $yMCltr) {
			$month=$yMCltr['month'];
			$year=$yMCltr['year'];
			$sql=$this->db->query("select SUM(cash_amount) AS stPrinciDpoVCCBByMonth from `emi_deposit_vccb` WHERE Month(date)='$month' AND YEAR(date)='$year' AND `loan_type`='S.T' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);	
		$emiPrnciAray[] = array('year' => $year, 'month' => $month, 'amount'=>$ft['stPrinciDpoVCCBByMonth'] );
		}
			
		return $emiPrnciAray;
	}

	public function findTotalSumAmountDepositedVCCBBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(total) AS allTotalDepositedVCCBBydate from `emi_deposit_vccb` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalDepositedVCCBBydate'];
	}
	function delEmiDepositedVCCBB()
	{
		$id=$_POST['emiDepVccb'];
		$del=$this->db->query("DELETE FROM `emi_deposit_vccb` WHERE `id`='$id' ");
		
	}
	public function exportTotalAmountDepositedVCCBBtDate($fromDt,$toDt)
	{
		foreach ($this->findTotalAmountDepositedVCCBBydate($fromDt,$toDt) as  $dvr) {
		$date=date("d-m-Y",strtotime($dvr['date']));			
		$amountDepVccb[] = array('Date' => $date, 'Particulars'=>$dvr['particulars'],'Voucher'=>$dvr['voucher'],'Bank Amount (Principal)'=>$dvr['bank_amount'],'Cash Amount (Interest)'=>$dvr['cash_amount'],'Total Under Each Head'=>$dvr['total'] );
		}
			
		return $amountDepVccb;
		
	}

	//Function End For EMI Deposited to VCCB

	//Function Start For Audit Fee

	public function addAuditFee()
	{
		$amount=$_POST['receiving_amount'];
		$receiving_date=$_POST['audit_fee_recv_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `audit_fee`(`amount`, `receiving_date`, `creted_by`, `in_time`) VALUES ('$amount','$receiving_date','$created_by','$created_by')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountaddAuditFeeBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `audit_fee` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalSumAmountAuditFeeBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalAuditFeeBydate from `audit_fee` WHERE `receiving_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalAuditFeeBydate'];
	}
	public function exportTotalAmountAuditFeeByDate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `audit_fee` WHERE `receiving_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalAuditFees=array();		
		while($auditDat= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($auditDat['receiving_date']));			
		$totalAuditFees[] = array('Date' => $date, 'Amount'=>$auditDat['amount']);  
          
		}
		return $totalAuditFees;
		
	}

	//Function End For Audit Fee

	//Function Start Expanses

	public function addExpanses()
	{
		$particulars=$_POST['particulars'];
		$amount=$_POST['expanses_amount'];
		$date=$_POST['expanses_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `expanses`(`particulars`, `amount`, `date`, `created_by`, `in_time`) VALUES ('$particulars','$amount','$date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmounExpansesBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `expanses` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalSumAmounExpansesBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalAmounExpansesBydate from `expanses` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalAmounExpansesBydate'];
	}
	public function exportTotalAmountExpansesByDate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `expanses` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalexpenses=array();		
		while($expenses= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($expenses['date']));			
		$totalexpenses[] = array('Date' => $date, 'Particulars'=>$expenses['particulars'],'Expanses Amount'=>$expenses['amount']);  
          
		}
		return $totalexpenses;
		
	}

	//Function End Expanses

	//Function Start CO-Operative Share
	public function addCOOperativeShare()
	{
		$loan_account_no=$_POST['loan_account_no'];
		$share_amount=$_POST['cop_shr_amount'];
		$date=$_POST['cop_shr_dt'];		
		$created_by=$_SESSION['sl_no'];
		$status=1;		
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `co-operative_share`(`loan_account_no`, `share_amount`, `date`, `created_by`, `in_time`) VALUES ('$loan_account_no','$share_amount','$date','$created_by','$in_time')");

		
		if($insert)
		{	
		 	
		 return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findCOOperativeShare($loanAc)
	{
		$show=$this->db->query("SELECT * FROM `co-operative_share` WHERE `loan_account_no`='$loanAc'");
		$singel=$show->fetchAll();
		return $singel[0];
	}
	public function findTotalAmounCOOperativeShareBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `co-operative_share` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}

	public function findTotalSumAmounCOOperativeShareBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(share_amount) AS allTotalAmounCOOperativeShareBydate from `co-operative_share` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalAmounCOOperativeShareBydate'];
	}
	public function exportTotalCOOperativeShareBydate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `co-operative_share` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalcoops=array();		
		while($coops= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($coops['date']));			
		$totalcoops[] = array('Date' => $date,'Loan Account Number'=>$coops['loan_account_no'],'Share Amount'=>$coops['share_amount']);  
          
		}
		return $totalcoops;
		
	}
	//Function Start SBI Deposited (33974632653)
	public function addSBIDeposited()
	{
		$amount=$_POST['sbi_deposit_amount'];
		$date=$_POST['sbi_deposit_dt'];
		$created_by=$_SESSION['sl_no'];
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `sbi_deposited`(`amount`, `date`, `creted_by`, `in_time`) VALUES ('$amount','$date','$created_by','$in_time')");

		
		if($insert)
		{	
		 	
		 return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalSBIDepositedBydateList($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `sbi_deposited` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
   public function findTotalSBIDepositedBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(amount) AS allTotalSBIDepositedByDt from `sbi_deposited` WHERE `date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalSBIDepositedByDt'];
	}
	public function exportTotalSBIDepositedBydateList($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `sbi_deposited` WHERE `date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totalsbid=array();		
		while($sbid= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($sbid['date']));			
		$totalsbid[] = array('Date' => $date, 'Total Amount'=>$sbid['amount']);  
          
		}
		return $totalsbid;
		
	}

	//Function End For Expenditure SBI Deposited (33974632653)
	//Function Start For Expenditure Deposited To VCCB
	public function addVCCBDeposited()
	{
		$name_of_account=$_POST['acount_type'];
		$deposite_amount=$_POST['deposite_amount'];
		$deposite_date=$_POST['deposite_dt'];
		$created_by=$_SESSION['sl_no'];
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `deposited_vccb`(`name_of_account`, `deposite_amount`, `deposite_date`, `created_by`, `in_time`) VALUES ('$name_of_account','$deposite_amount','$deposite_date','$created_by','$in_time')");

		
		if($insert)
		{	
		 	
		 return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findTotalAmountExpanditureDepositedVCCBBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("SELECT * FROM `deposited_vccb` WHERE `deposite_date` BETWEEN '$fromDt'  AND '$toDt' ");
		return $fetch=$sql->fetchAll();
	}
	public function findTotalSumAmountExpanditureDepositedVCCBBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(deposite_amount) AS allTotalExpDepositedVCCBBydate from `deposited_vccb` WHERE `deposite_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalExpDepositedVCCBBydate'];
	}
	public function exportTotalAmountExpanditureDepositedByDate($fromDt,$toDt)
	{		
		$get_all=$this->db->query("SELECT * FROM `deposited_vccb` WHERE `deposite_date` BETWEEN '$fromDt'  AND '$toDt' ");
		$totaldVccb=array();		
		while($dVccb= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($dVccb['deposite_date']));			
		$totaldVccb[] = array('Date' => $date, 'Name of the Account'=>$dVccb['name_of_account'],  'Amount'=>$dVccb['deposite_amount']);  
          
		}
		return $totaldVccb;
		
	}
	//Function End For Expenditure Deposited To VCCB

	//Function Start For Expenditure  Miscellaneous
	public function addExpenditureMiscellaneous()
	{
		$reson_miscellaneous=$_POST['miscellaneous_reason'];
		$miscellaneous_amount=$_POST['miscellaneous_amount'];
		$miscellaneous_date=$_POST['miscellaneous_dt'];
		$created_by=$_SESSION['sl_no'];	
		$in_time=time();	

		$insert=$this->db->query("INSERT INTO `expenditure_miscellaneous`(`reson_miscellaneous`, `miscellaneous_amount`, `miscellaneous_date`, `created_by`, `in_time`) VALUES ('$reson_miscellaneous','$miscellaneous_amount','$miscellaneous_date','$created_by','$in_time')");
		if($insert)
		{	
		return "<h3 style='color:green;'>Successfully Data Inserted</h3>";	
		}
	}
	public function findAllExpenditureMiscellaneous()
	{
		$sql=$this->db->query("select * from `expenditure_miscellaneous`");		
		return $singel=$sql->fetchAll();
		
	}
	public function findTotalAmountExpenditureMiscellaneousBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(miscellaneous_amount) AS allTotalMiscellaneousByDt from `add_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allTotalMiscellaneousByDt'];
	}
	public function findTotalAmountExpenditureMiscellaneousBydateLIst($fromDt,$toDt)
	{
		$sql=$this->db->query("select * from `expenditure_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt' AND '$toDt' ");		
		return $singel=$sql->fetchAll();
		
	}
	public function findSumOfExpenditureMiscellaneousBydate($fromDt,$toDt)
	{
		$sql=$this->db->query("select SUM(miscellaneous_amount) AS allSumlMiscellaneousByDt from `expenditure_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt' AND '$toDt' ");
		$ft=$sql->fetch(PDO::FETCH_ASSOC);		
		return $ft['allSumlMiscellaneousByDt'];
	}
	function delExpenditureMiscellaneous()
	{
		$id=$_POST['expMiscdel'];
		$del=$this->db->query("DELETE FROM `expenditure_miscellaneous` WHERE `id`='$id' ");
		
	}
	public function exportTotaExpenditureMiscellaneousBydateLIst($fromDt,$toDt)
	{		
		$get_all=$this->db->query("select * from `expenditure_miscellaneous` WHERE `miscellaneous_date` BETWEEN '$fromDt' AND '$toDt' ");
		$totalexpMisc=array();		
		while($expMisc= $get_all->fetch(PDO::FETCH_BOTH))
		{           
		  $date=date("d-m-Y", strtotime($expMisc['miscellaneous_date']));			
		$totalexpMisc[] = array('Date' => $date, 'Miscellaneous Reasone'=>$expMisc['reson_miscellaneous'], 'Amount'=>$expMisc['miscellaneous_amount']);  
          
		}
		return $totalexpMisc;
		
	}

	//Function End For Expenditure  Miscellaneous
	//Function Start For Month
	function numrcMonth($mn)
	{
		if($mn==1)
		{
			$month='January';
		}
		if($mn==2)
		{
			$month='February';
		}
		if($mn==3)
		{
			$month='March';
		}
		if($mn==4)
		{
			$month='April ';
		}
		if($mn==5)
		{
			$month='May';
		}
		if($mn==6)
		{
			$month='June';
		}
		if($mn==7)
		{
			$month='July';
		}
		if($mn==8)
		{
			$month='August';
		}
		if($mn==9)
		{
			$month='September';
		}
		if($mn==10)
		{
			$month='October';
		}
		if($mn==11)
		{
			$month='November';
		}
		if($mn==12)
		{
			$month='December ';
		}
		return $month;
		
	}
}
$object=new main();
?>