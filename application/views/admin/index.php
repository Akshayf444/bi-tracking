<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

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
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li><!-- end message -->
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                                    </div>
                                                    <h4>
                                                        AdminLTE Design Team
                                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                                    </div>
                                                    <h4>
                                                        Developers
                                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                                    </div>
                                                    <h4>
                                                        Sales Department
                                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                                    </div>
                                                    <h4>
                                                        Reviewers
                                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-user text-red"></i> You changed your username
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li><!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Create a nice theme
                                                        <small class="pull-right">40%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li><!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Some task I need to do
                                                        <small class="pull-right">60%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li><!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Make beautiful transitions
                                                        <small class="pull-right">80%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">80% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li><!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                        <p>
                                            Alexander Pierce - Web Developer
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
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
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Alexander Pierce</p>

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
                            <a href="index.html">
                                <i class="fa fa-th"></i> <span>Dashboard</span> <small class="label pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Employee Master</span>
                                <span class="label label-primary pull-right">4</span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> RBM</a></li>
                                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> ASM</a></li>
                                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> BDM</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="pages/widgets.html">
                                <i class="fa fa-th"></i> <span>Doctor Master</span> <small class="label pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="pages/calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="label pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="pages/mailbox/mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="label pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Multilevel</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                        <li>
                                            <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                            <ul class="treeview-menu">
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            </ul>
                        </li>
                        <li><a href="documentation/index.html"><i class="fa fa-book"></i> Documentation</a></li>
                        <li class="header">LABELS</li>
                        <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Version 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user-md"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doctors </span>
                                    <span class="info-box-number">96852</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-medkit"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Target</span>
                                    <span class="info-box-number">41,410</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sales</span>
                                    <span class="info-box-number">760</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">New Conversion</span>
                                    <span class="info-box-number">2248</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Monthly Plan V/s Actual Report</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <div class="btn-group">
                                            <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Sales: 1 Jan, 2015 - 30 Aug, 2015</strong>
                                            </p>
                                            <div class="chart-responsive">
                                                <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" height="200"></canvas>
                                            </div><!-- /.chart-responsive -->
                                        </div><!-- /.col -->
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Profile Completion</strong>
                                            </p>
                                            <div class="progress-group">
                                                <span class="progress-text">Overall</span>
                                                <span class="progress-number"><b>160</b>/200</span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 70%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Actylase</span>
                                                <span class="progress-number"><b>310</b>/400</span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red" style="width: 40%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Pradaxa</span>
                                                <span class="progress-number"><b>480</b>/800</span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-green" style="width: 650%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Metalyse</span>
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
                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                                <h5 class="description-header"> 35,210.43</h5>
                                                <span class="description-text">TOTAL Target</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">10,390.90</h5>
                                                <span class="description-text">TOTAL Achievement </span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                                <h5 class="description-header">2498</h5>
                                                <span class="description-text">TOTAL Activities Planned</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block">
                                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                                <h5 class="description-header">1200</h5>
                                                <span class="description-text">Total Activities Executed</span>
                                            </div><!-- /.description-block -->
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Main content -->
                    <section class="content">
                        <H3> Actylase Summary </h3>
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Doctors </span>
                                        <span class="info-box-number">96852</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            50% Increase in 30 Days
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Target</span>
                                        <span class="info-box-number">41,410</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            50% Increase in 30 Days
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix visible-sm-block"></div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Sales</span>
                                        <span class="info-box-number">760</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            50% Increase in 30 Days
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">New Conversion</span>
                                        <span class="info-box-number">2248</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            50% Increase in 30 Days
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Main content -->
                        <section class="content">
                            <H3> Prodaxa Summary </h3>
                            <!-- Info boxes -->
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doctors </span>
                                            <span class="info-box-number">96852</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                50% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Target</span>
                                            <span class="info-box-number">41,410</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                50% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix visible-sm-block"></div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Sales</span>
                                            <span class="info-box-number">760</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                50% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">New Conversion</span>
                                            <span class="info-box-number">2248</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                50% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                            <!-- Main content -->
                            <section class="content">
                                <H3> Metalyse Summary </h3>
                                <!-- Info boxes -->
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="info-box bg-yellow">
                                            <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Doctors </span>
                                                <span class="info-box-number">96852</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    50% Increase in 30 Days
                                                </span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="info-box bg-green">
                                            <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Target</span>
                                                <span class="info-box-number">41,410</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    50% Increase in 30 Days
                                                </span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->

                                    <!-- fix for small devices only -->
                                    <div class="clearfix visible-sm-block"></div>

                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="info-box bg-red">
                                            <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Sales</span>
                                                <span class="info-box-number">760</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    50% Increase in 30 Days
                                                </span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="info-box bg-aqua">
                                            <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">New Conversion</span>
                                                <span class="info-box-number">2248</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    50% Increase in 30 Days
                                                </span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->


                                <div class='row'>
                                    <div class='col-md-4'>

                                        <div class="box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Browser Usage</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="pieChart" height="150"></canvas>
                                                        </div><!-- ./chart-responsive -->
                                                    </div><!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                                            <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                                            <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                                            <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                                            <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                                            <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                                                        </ul>
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer no-padding">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                                                    <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                                                </ul>
                                            </div><!-- /.footer -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                                <div class='row'>
                                    <div class='col-md-4'>

                                        <div class="box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Browser Usage</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="pieChart" height="150"></canvas>
                                                        </div><!-- ./chart-responsive -->
                                                    </div><!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                                            <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                                            <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                                            <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                                            <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                                            <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                                                        </ul>
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer no-padding">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                                                    <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                                                </ul>
                                            </div><!-- /.footer -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Latest Orders</h3>
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
                                                                <th>Order ID</th>
                                                                <th>Item</th>
                                                                <th>Status</th>
                                                                <th>Popularity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                                <td>Call of Duty IV</td>
                                                                <td><span class="label label-success">Shipped</span></td>
                                                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                                <td>Samsung Smart TV</td>
                                                                <td><span class="label label-warning">Pending</span></td>
                                                                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                <td>iPhone 6 Plus</td>
                                                                <td><span class="label label-danger">Delivered</span></td>
                                                                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                <td>Samsung Smart TV</td>
                                                                <td><span class="label label-info">Processing</span></td>
                                                                <td><div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                                <td>Samsung Smart TV</td>
                                                                <td><span class="label label-warning">Pending</span></td>
                                                                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                <td>iPhone 6 Plus</td>
                                                                <td><span class="label label-danger">Delivered</span></td>
                                                                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                                <td>Call of Duty IV</td>
                                                                <td><span class="label label-success">Shipped</span></td>
                                                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer clearfix">
                                                <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                                                <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                            </div><!-- /.box-footer -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col -->
                                    <div class="col-md-4">
                                        <!-- PRODUCT LIST -->
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Recently Added Products</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <ul class="products-list product-list-in-box">
                                                    <li class="item">
                                                        <div class="product-img">
                                                            <img src="http://placehold.it/50x50/d2d6de/ffffff" alt="Product Image"/>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                                                            <span class="product-description">
                                                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                                                            </span>
                                                        </div>
                                                    </li><!-- /.item -->
                                                    <li class="item">
                                                        <div class="product-img">
                                                            <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                                                            <span class="product-description">
                                                                26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                                            </span>
                                                        </div>
                                                    </li><!-- /.item -->
                                                    <li class="item">
                                                        <div class="product-img">
                                                            <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                                                            <span class="product-description">
                                                                Xbox One Console Bundle with Halo Master Chief Collection.
                                                            </span>
                                                        </div>
                                                    </li><!-- /.item -->
                                                    <li class="item">
                                                        <div class="product-img">
                                                            <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                                                            <span class="product-description">
                                                                PlayStation 4 500GB Console (PS4)
                                                            </span>
                                                        </div>
                                                    </li><!-- /.item -->
                                                </ul>
                                            </div><!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <a href="javascript::;" class="uppercase">View All Products</a>
                                            </div><!-- /.box-footer -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                            </section><!-- /.content -->
                            </div><!-- /.content-wrapper -->

                            <footer class="main-footer">
                                <div class="pull-right hidden-xs">
                                    <b>Version</b> 2.0
                                </div>
                                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
                            </footer>

                            </div><!-- ./wrapper -->

                            <!-- jQuery 2.1.3 -->
                            <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
                            <!-- Bootstrap 3.3.2 JS -->
                            <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                            <!-- FastClick -->
                            <script src='plugins/fastclick/fastclick.min.js'></script>
                            <!-- AdminLTE App -->
                            <script src="dist/js/app.min.js" type="text/javascript"></script>
                            <!-- Sparkline -->
                            <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
                            <!-- jvectormap -->
                            <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
                            <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
                            <!-- daterangepicker -->
                            <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
                            <!-- datepicker -->
                            <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
                            <!-- iCheck -->
                            <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
                            <!-- SlimScroll 1.3.0 -->
                            <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                            <!-- ChartJS 1.0.1 -->
                            <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

                            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                            <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

                            <!-- AdminLTE for demo purposes -->
                            <script src="dist/js/demo.js" type="text/javascript"></script>
                            </body>
                            </html>