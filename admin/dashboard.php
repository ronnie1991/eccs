<?php include_once("main.class.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> ECCS | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
           <?php include_once("header.php"); ?>
      
      <!-- Left side column. contains the logo and sidebar -->
      
            <?php include_once("left_asid.php"); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            MEDINIPUR SADAR EAST SCHOOL EMPLOYEES CO-OPERATIVE CREDIT SOCIETY LTD. (Reg.No-7 PAS-MED, Date-08.10.2013)
           
          </h4> 
                
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-suitcase"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Amount Of Loan</span>
                  
                  <span class="info-box-number"><small><?= $object->findSumOfAmounLoanAccount();?></small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->            
             <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-fw fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Member</span>
                  
                  <span class="info-box-number"><?= $object->memberRegisterCount();?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>           
			<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-fw fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Share</span>
                  
                  <span class="info-box-number"><?= $object->findTotalSumOfCallMoney();?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-fw fa-user-secret"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">BOD</span>                  
                  <span class="info-box-number">Last Election- 23.3.2015</span>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="col-md-8">
              <!-- MAP & BOX PANE -->
                <div class="box-header ">
                  <h3 class="box-title">Loan Account</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Account Number</th>
                          <th>Amount</th>
                          <th>Total Emi</th>
                          <th>Loan Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($object->findAllActiveLoanAccountNumber() as $key => $activeLoanAcount) { ?>
                        <tr>
                          <td><b><a href="pages/examples/invoice.html"><?= $activeLoanAcount['loan_account_no']?></a></b></td>
                          <td><span class="label label-danger"><?= $activeLoanAcount['total_loan_amount']?></span></td>
                          <td><span class="label label-success"><?= $activeLoanAcount['total_number_emi']?></span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20"><?= date("d-M-Y", strtotime($activeLoanAcount['loan_date']))?></div></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Load More</a>
                  
                </div><!-- /.box-footer -->
             
            </div><!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Statistics</strong>
                      </p>                      
                      <div class="progress-group">
                        <span class="progress-text">Last AGM</span>
                        <span class="progress-number">Date- <b>28/9/2018</b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Last Half AGM</span>
                        <span class="progress-number">Date- <b>3/3/2018</b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">B.O.D Member</span>
                        <span class="progress-number"><b>9</b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Text</span>
                        <span class="progress-number"><b>250</b>/500</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                        </div>
                      </div><!-- /.progress-group -->

                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 12.25%</span>
                        <h5 class="description-header">M.T Loan</h5>
                        <span class="description-text">R.O.I</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 10.25%</span>
                        <h5 class="description-header">S.T Loan</h5>
                        <span class="description-text">R.O.I</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 10%</span>
                        <h5 class="description-header">Share</h5>
                        <span class="description-text">Loan</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 7%</span>
                        <h5 class="description-header">C.G.S</h5>
                        <span class="description-text">Loan</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

       <?php include_once("footer.php"); ?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
