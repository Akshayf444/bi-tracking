<!DOCTYPE html>
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

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo site_url('Admin/dashboard'); ?>" class="logo"><b><img src="<?php echo asset_url() ?>images/Travels.png"></b></a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
<!--                                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <?php $CI = & get_instance(); ?>
                                    <span class="hidden-xs"><?php echo 'Admin'; ?></span>
                                </a>
                                <ul class="dropdown-menu">
<!--                                     The user image in the menu 
                                    <li class="user-header">
                                        <p>
                                            <?php //echo $CI->user_name; ?>

                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                     Menu Body 
                                    <li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </li>-->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
<!--                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>-->
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
             <li>
           <a href="<?php echo site_url('Admin/unlocked_employee'); ?>">
             <i class="fa fa-lock"></i> <span>Blocked Accounts</span> 
              </a>
            </li>
            
                 </ul>
        </section>
        <!-- /.sidebar -->
      </aside>    
            
            
            
      <!-- Content Wrapper. Contains page content -->
          
<!-- ./wrapper -->



                <!-- sidebar: style can be found in sidebar.less -->
              

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo isset($page_title) ? $page_title : ''; ?>
                        <small></small>
                    </h1>
                </section>


                <!-- Main content -->
                <section class="content" style="overflow: scroll;">
                    <?php $this->load->view($content, $view_data); ?>
                    </section>
        </div><!-- ./wrapper -->

      
         <script src="<?php echo asset_url() ?>dashboard/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo asset_url() ?>dashboard/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   
    <!-- AdminLTE App -->
    <script src="<?php echo asset_url() ?>dashboard/dist/js/app.min.js" type="text/javascript"></script>
    
    </body>
</html>