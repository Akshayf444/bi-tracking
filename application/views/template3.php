<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo asset_url() ?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url() ?>css/skin-blue.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo asset_url() ?>js/jquery.js"></script>
        <script src="<?php echo asset_url() ?>js/jquery-ui.js" type="text/javascript"></script>
         <script src="<?php echo asset_url() ?>js/highcharts.js" type="text/javascript"></script>
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

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form (Optional) -->
                    <!--                    <form action="#" method="get" class="sidebar-form">
                                            <div class="input-group">
                                                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                                <span class="input-group-btn">
                                                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>-->
                    <!-- /.search form -->

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <!--                        <li class="header">HEADER</li>-->
                        <li><a href="<?php echo site_url('Admin/dashboard'); ?>"><span>Dashboard</span></a></li>
                        <li><a href="<?php echo site_url('Admin/emp_view'); ?>"><span>Employee Master</span></a></li>
                        <li><a href="<?php echo site_url('Admin/doc_view'); ?>"><span>Doctor Master</span></a></li>
                        <li><a href="<?php echo site_url('Admin/view_Activity'); ?>"><span>Activity</span></a></li>
                        <li><a href="<?php echo site_url('Admin/profile_view'); ?>"><span>Control Access</span></a></li>
                    </ul><!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

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
                <section class="content">
                    <?php $this->load->view($content, $view_data); ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <!--            <footer class="main-footer">
                             To the right 
                            <div class="pull-right hidden-xs">
            
                            </div>
                             Default to the left  
                            <strong>Copyright &copy; 2015 <a href="#">Instacom</a>.</strong> All rights reserved.
                        </footer>-->

        </div><!-- ./wrapper -->

        <script src="<?php echo asset_url() ?>js/app.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/bootstrap.min_1.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/formValidation.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/bootstrap.min.js" type="text/javascript"></script>


    </body>
</html>