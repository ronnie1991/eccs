<?php 
ob_start();
session_start();
if(!isset($_SESSION['sl_no']))
{
?>
<script type="text/javascript">
window.location='index';
</script>
<?php }
$singleMbrDetls=$object->singelSocietyMBRDtls($_SESSION['sl_no']);
 ?>
<header class="main-header">

        <!-- Logo -->
        <a href="dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EC</b>CS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>MSES</b>ECCS</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if($singleMbrDetls['membr_img']!='') {?>
                  <img src="../common/member_img/<?=$singleMbrDetls['membr_img'] ?>" class="img-circle" alt="" width="25" height="25">
                 <?php } if($singleMbrDetls['membr_img']==null) { ?>
                  <img src="dist/img/boy.png" class="user-image" alt="">
                 <?php }  ?>

                  <span class="hidden-xs"><?= $singleMbrDetls['member_name'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php if($singleMbrDetls['membr_img']!='') {?>
                  <img src="../common/member_img/<?=$singleMbrDetls['membr_img'] ?>" class="img-circle" alt="" width="25" height="25">
                 <?php } if($singleMbrDetls['membr_img']==null) { ?>
                  <img src="dist/img/boy.png" class="img-circle" alt="">
                 <?php }  ?>
                    
                    <p>
                      Name - <?= $singleMbrDetls['member_name'];?>   
                      <small>Member since - <?= date("d-M-Y", strtotime($singleMbrDetls['date_membership']) );?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">SN.-<?= $singleMbrDetls['sl_no'];?></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Mobile-</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"><?= $singleMbrDetls['mobile_number'];?></a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="update_member?memberId=<?= base64_encode($_SESSION['sl_no'])?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>