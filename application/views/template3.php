<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo asset_url() ?>dashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo asset_url() ?>dashboard/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
   
    <!-- jvectormap -->
    <link href="<?php echo asset_url() ?>dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
    <!-- Daterange picker -->
     <link href="<?php echo asset_url() ?>dashboard/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   
    <!-- Theme style -->
    <link href="<?php echo asset_url() ?>dashboard/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
     <link href="<?php echo asset_url() ?>dashboard/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b>BI</b>Tracker</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
       
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                  <span class="hidden-xs">   Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
                    <p>
                    Admin
                   
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="<?php echo site_url('Admin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info">
              <p>Admin</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo site_url('Admin/dashboard'); ?>">
                <i class="fa fa-th"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo site_url('Admin/emp_view'); ?>">
                  <i class="ion ion-ios-people-outline"></i>
                <span>Employee Master</span>
                
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('Admin/emp_view'); ?>"><i class="fa fa-circle-o"></i>Employee Master</a></li>
              
                <li><a href="<?php echo site_url('Admin/bdm_wise'); ?>"><i class="fa fa-circle-o"></i> BDM WISE</a></li>
                
              </ul>
            </li>
            <li>
           <a href="<?php echo site_url('Admin/doc_view'); ?>">
                <i class="fa fa-user-md"></i> <span>Doctor Master</span> 
              </a>
            </li>
             <li>
           <a href="<?php echo site_url('Admin/view_Activity'); ?>">
                              <i class="fa fa-folder"></i> <span>View Activity</span> 
 
              </a>
            </li>
             <li>
           <a href="<?php echo site_url('Admin/profile_view'); ?>">
             <i class="fa fa-book"></i> <span>Control Access</span> 
              </a>
            </li>
            
                 </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
          
<!-- ./wrapper -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          <?php echo isset($page_title) ? $page_title : ''; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                        
              

                <!-- Main content -->
               
                    <?php $this->load->view($content, $view_data); ?>
                
               <!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <!--            <footer class="main-footer">
                             To the right 
                            <div class="pull-right hidden-xs">
            
                            </div>
                             Default to the left  
                            <strong>Copyright &copy; 2015 <a href="#">Instacom</a>.</strong> All rights reserved.
                        </footer>-->

      <!-- ./wrapper -->
<script src="<?php echo asset_url() ?>/dashboard/plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo asset_url() ?>/dashboard/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    <!-- FastClick -->
      <script src="<?php echo asset_url() ?>/dashboard/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
   
    <!-- AdminLTE App -->
    <script src="<?php echo asset_url() ?>/dashboard/dist/js/app.min.js" type="text/javascript"></script>
    
    <!-- Sparkline -->
    <script src="<?php echo asset_url() ?>/dashboard/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    
    <!-- jvectormap -->
     <script src="<?php echo asset_url() ?>/dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
   <script src="<?php echo asset_url() ?>/dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
   
    
    <!-- daterangepicker -->
     <script src="<?php echo asset_url() ?>/dashboard/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
   
    
    <!-- datepicker -->
    <script src="<?php echo asset_url() ?>/dashboard/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
   
    <!-- iCheck -->
     <script src="<?php echo asset_url() ?>/dashboard/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
   
    
    <!-- SlimScroll 1.3.0 -->
     <script src="<?php echo asset_url() ?>/dashboard/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo asset_url() ?>/dashboard/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="<?php echo asset_url() ?>/dashboard/dist/js/pages/dashboard2.js" type="text/javascript"></script>-->
    

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo asset_url() ?>/dashboard/dist/js/demo.js" type="text/javascript"></script>
  
  </body>
</html>