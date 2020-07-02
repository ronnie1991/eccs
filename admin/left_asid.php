<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php if($singleMbrDetls['membr_img']!='') {?>
                  <img src="../common/member_img/<?=$singleMbrDetls['membr_img'] ?>" class="img-circle" alt="" width="25" height="25">
                 <?php } if($singleMbrDetls['membr_img']==null) { ?>
                  <img src="dist/img/boy.png" class="user-image" alt="">
                 <?php }  ?>
            </div>
            <div class="pull-left info">
              <p><?= $singleMbrDetls['member_name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="active treeview">
              <a href="dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>              
            </li>
			<li class="header">Register Of Members & their Nominees</li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Register Of Members </span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="add_members"><i class="fa fa-plus"></i> Membership Application</a></li>
                <li><a href="member_register_by_date"><i class="fa fa-circle-o"></i>Sort Members by date</a></li>
                <li><a href="member_register"><i class="fa fa-circle-o"></i>View All Members</a></li>
                
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Admission Fees Of Members </span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="receive_members_admision_fee"><i class="fa fa-plus"></i> Receiving Admission Fess</a></li>
                <li><a href="all_receved_admison_fees"><i class="fa fa-circle-o"></i>View All Admission Fess</a></li>
                
              </ul>
            </li>
         <li class="header">Ledger of Shares & C.G.S</li>   
         <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Receipt of Share Money</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="receive_call_money"><i class="fa fa-plus"></i> Receiving Share Money</a></li>
                <li><a href="share_mony_selcet_date"><i class="fa fa-circle-o"></i>Sort Share Money by date</a></li>
                <li><a href="all_call_money"><i class="fa fa-circle-o"></i>View All Share Money</a></li>
                
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Receipt of C.G.S Money</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="receive_cgs_money"><i class="fa fa-plus"></i> Receiving C.G.S Money</a></li>
                <li><a href="all_cgs_money"><i class="fa fa-circle-o"></i>View All C.G.S</a></li>
                
              </ul>
            </li>     
           <li class="header">Ledger OF Loan</li>   
           <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Create New Loan Account</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="creat_new_loan_ac"><i class="fa fa-plus"></i> Add New Loan Account</a></li>            
                <li><a href="all_new_loan_account"><i class="fa fa-circle-o"></i>View All New Loans Account</a></li>
              </ul>
            </li>  
         <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Disbursement OF Loan</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="assigning_loan"><i class="fa fa-plus"></i> Assigning of loan</a></li>
                <li><a href="all_loan_mbr_ldgr"><i class="fa fa-circle-o"></i>View All Disbursement of Loans</a></li>
                
              </ul>
            </li>  
            <li class="header">EMI Ledger Operations</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Receipt of EMI</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="receive_new_emi"><i class="fa fa-plus"></i>Receiving New EMI</a></li>
                <li><a href="viewall_emi_ledgr_slac"><i class="fa fa-circle-o"></i>View All Received EMI</a></li>                
              </ul>
            </li>  
             <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>View EMI Details</span>              
              </a>
              <ul class="treeview-menu">
                <li><a href="viewall_emi_ledgr"><i class="fa fa-plus"></i>View All EMI Ledger</a></li>
                <li><a href="emi_ledger_select_date"><i class="fa fa-circle-o"></i>Sort Ledger by Date</a></li>                
              </ul>
            </li>          
             
            <li class="header">Cash Book Receipts</li> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>CGS Ledger</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="viewall_cgs_ledgr"><i class="fa fa-circle-o"></i>View All CGS Ledger</a></li>                
              </ul>
            </li>
           <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Emi Receipts</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="viewall_cashbook_receipts"><i class="fa fa-circle-o"></i>View All Receipts </a></li>    
               <li><a href="viewall_cashbook_receipts"><i class="fa fa-circle-o"></i>View All Receipts By Month </a></li> 
               </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Loan Receipts</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="viewall_cashbook_loanreceipts_scd"><i class="fa fa-circle-o"></i>View All SCD </a></li>                
               </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Admission Fee Receipts</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="viewall_received_admision_fees"><i class="fa fa-circle-o"></i>View All Admission Fee </a></li>                
               </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Bank Interest Receipts</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="receive_sbi_curentac"><i class="fa fa-circle-o"></i>S.B.I (Current Account)</a></li> 
                <li><a href="receive_vccb_interest"><i class="fa fa-circle-o"></i>V.C.C.B </a></li>               
               </ul>
            </li>            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Dividend From bank</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="receive_dividend"><i class="fa fa-circle-o"></i>Receiving Dividend</a></li>                      
               </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Withdrawal from Bank</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="withdrawal_sbi"><i class="fa fa-circle-o"></i>S.B.I (Current Account)</a></li> 
                <li><a href="withdrawal_vccb"><i class="fa fa-circle-o"></i>V.C.C.B </a></li>                       
               </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Miscellaneous</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="add_miscellaneous"><i class="fa fa-circle-o"></i>Add Miscellaneous</a></li> 
                <li><a href="view_all_recipt_miscellaneous"><i class="fa fa-circle-o"></i>All Recp. Miscellaneous</a></li>
               </ul>
            </li>
            <li class="treeview">
              <a href="total_recepit_date">
                <i class="fa fa-child"></i>
                <span>Total Receipt</span>              
              </a>              
            </li>   
            
            
            <li class="header">Cash Book Expenditure</li> 
           <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>EMI Deposited to VCCB</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="emi_depost_vccb"><i class="fa fa-circle-o"></i>Add EMI Deposited</a></li>
                <li><a href="all_emi_depost_vccb"><i class="fa fa-circle-o"></i>All EMI Deposited</a></li>             
               </ul>
            </li>            
            <li class="treeview">
              <a href="loan_issued_member">
                <i class="fa fa-child"></i>
                <span>Loan Issued to Member</span>              
              </a>              
            </li>

             <li class="treeview">
              <a href="">
                <i class="fa fa-child"></i>
                <span>CO-Operative Share</span>              
              </a> 
              <ul class="treeview-menu">                
                <li><a href="add_co_operative_share"><i class="fa fa-circle-o"></i>Add CO-Operative Share</a></li>             
               </ul>             
            </li>

             <li class="treeview">
              <a href="bank_deposit_loan">
                <i class="fa fa-child"></i>
                <span>Loan (C.G.S) (S.C.D) (Share)</span>              
              </a>              
            </li>

            <li class="treeview">
              <a href="share_deposited_bank">
                <i class="fa fa-child"></i>
                <span>Share Deposited to Bank</span>              
              </a>              
            </li>

             <li class="treeview">
              <a href="adm_fees_dep_bank">
                <i class="fa fa-child"></i>
                <span>Admission Fees Dep. to Bank</span>              
              </a>              
            </li>

             <li class="treeview">
              <a href="sbi_deposited">
                <i class="fa fa-child"></i>
                <span>SBI Deposited (33974632653)</span>              
              </a>              
            </li>
            
            <li class="treeview">
              <a href="deposited_vccb">
                <i class="fa fa-child"></i>
                <span>Deposited to VCCB</span>              
              </a>              
            </li>
             <li class="treeview">
              <a href="all_dividend_to_bank_account">
                <i class="fa fa-child"></i>
                <span>Dividend To Bank Account</span>              
              </a>              
            </li>
            <li class="treeview">
              <a href="add_audit_fee">
                <i class="fa fa-child"></i>
                <span>Audit Fee</span>              
              </a>              
            </li>
            <li class="treeview">
              <a href="add_expanses">
                <i class="fa fa-child"></i>
                <span>Other Expanses</span>              
              </a>              
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Miscellaneous</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="add_expenditure_miscellaneous_"><i class="fa fa-circle-o"></i>Add Miscellaneous</a></li>
                <li><a href="view_expenditure_miscellaneous"><i class="fa fa-circle-o"></i>All Exp. Miscellaneous</a></li>                                    
               </ul>
            </li>
            <li class="treeview">
              <a href="list_closing_balance">
                <i class="fa fa-child"></i>
                <span>List Of Closing Balance</span>              
              </a>              
            </li>
            <li class="treeview">
              <a href="total_expenditure_date">
                <i class="fa fa-child"></i>
                <span>Total Expenditure</span>              
              </a>              
            </li>  
            <li class="header"> Voucher</li> 
             <li class="treeview">
              <a href="select_vouchr_id">
                <i class="fa fa-child"></i>
                <span>Voucher</span>              
              </a>              
            </li> 
            <li class="header"> General Ledger</li> 
             <li class="treeview">
              <a href="receipt_general_ledger_dt">
                <i class="fa fa-child"></i>
                <span>Receipt General Ledger</span>              
              </a>              
            </li> 
             <li class="treeview">
              <a href="payment_general_ledgerdt">
                <i class="fa fa-child"></i>
                <span>Payment General Ledger</span>              
              </a>              
            </li>
            <li class="header"> Detailed List Of Loan</li> 
             <li class="treeview">
              <a href="detaild_list_loan">
                <i class="fa fa-child"></i>
                <span>Detailed List Of M.T Loan</span>              
              </a>              
             </li>
             <li class="treeview">
              <a href="detaild_list_st_loan_date">
                <i class="fa fa-child"></i>
                <span>Detailed List Of S.T Loan</span>              
              </a>              
             </li>
             <li class="header"> Principal Details</li> 
             <li class="treeview">
              <a href="principal_details_eccs">
                <i class="fa fa-child"></i>
                <span>Principal Details M.T</span>              
              </a>              
             </li>
             <li class="treeview">
              <a href="principal_details_st_bydate_eccs">
                <i class="fa fa-child"></i>
                <span>Principal Details S.T</span>              
              </a>              
             </li>
             <?php if($singleMbrDetls['sl_no']=='5') { ?>
             <li class="header"> Admin panel Login Controls</li> 
             <li class="treeview">
              <a href="#">
                <i class="fa fa-child"></i>
                <span>Authoriz a user</span>              
              </a>
              <ul class="treeview-menu">                
                <li><a href="create_login_user"><i class="fa fa-circle-o"></i>Create a Admin User</a></li>
                <li><a href="all_admin_login"><i class="fa fa-circle-o"></i>All Admin User</a></li>                                    
               </ul>              
             </li>
             <?php } ?>
        </section>
        <!-- /.sidebar -->
      </aside>