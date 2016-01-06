
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link href="<?php echo asset_url() ?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css " >

        <link href="<?php echo asset_url() ?>css/metisMenu.min.css" rel="stylesheet" type="text/css " >

        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/jquery-ui.js" type="text/javascript"></script>
        <link href="<?php echo asset_url() ?>css/sb-admin-2.css" rel="stylesheet" type="text/css"/>

        <style>
            .form-control{
                height: 32px;
                padding: 3px 3px;
            }
            input[type=text]{
                height: 32px;
                padding: 0px 4px;
            }
        </style>

        <!-- Bootstrap Core CSS -->

        <!-- Custom CSS -->


        <!-- Custom Fonts -->


    </head>

    <body>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img width="160px" height="68px" class="navbar" onclick="window.location = '<?php echo site_url('admin/dashboard'); ?>';" src="<?php echo asset_url() ?>images/travels.png" alt=""/>

                </div>
                <ul class="nav navbar-top navbar-right">
                    <li class="dropdown">


                        <a class="fa fa-2x fa-power-off pull-right" onclick="window.location = '<?php echo site_url('admin/logout'); ?>';" ></a>

                    </li>
                </ul>
                <!-- /.navbar-header -->
                <!--  <ul class="nav navbar top-nav">
                                  
                                
                                                              <a class="fa fa-2x fa-power-off pull-right" onclick="window.location = '<?php echo site_url('admin/logout'); ?>';" ></a>
                                       
                                    </ul>-->
                <!-- /.dropdown-user -->





                <!-- /.navbar-top-links -->

                <div class="navbar sidebar" role="navigation" >
                    <div class="sidebar-nav navbar-collapse">

                        <ul class="nav" id="side-menu">
                            <li>
                                <a onclick="window.location = '<?php echo site_url('admin/dashboard'); ?>';" > Dashboard</a>


                            </li>

                            <li>
                                <a  onclick="window.location = '<?php echo site_url('admin/view_activity'); ?>';" > Activities</a>

                            </li>

                            <li>
                                <a  onclick="window.location = '<?php echo site_url('admin/profile_view'); ?>';" > Profile</a>

                            </li>
                            <li>
                                <a  onclick="window.location = '<?php echo site_url('admin/doc_view'); ?>';" >Doctor</a>

                            </li>
                            <li class="">
                                <a   >Reports</a>
                                <ul class="" role="menu">
                                    <li><a onclick="window.location = '<?php echo site_url('admin/Profile_Completion'); ?>';">Profile Completion Status</a></li>
                                    <li><a onclick="window.location = '<?php echo site_url('admin/Rx_Planning'); ?>';">Rx Planning</a></li>
                                    <li><a href="#">Reporting For Rx</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- /.sidebar-collapse -->
                </div>

                <!-- /.navbar-static-side -->

            </nav>

            <div id="page-wrapper">
                <?php $this->load->view($content, $view_data); ?>
            </div>

        </div>


        <script src="<?php echo asset_url() ?>js/ratchet.min.js" type="text/javascript"></script>

        <script src="<?php echo asset_url() ?>js/docs.min.js" type="text/javascript"></script>
<!--        <script src="<?php echo asset_url() ?>js/fingerblast.js" type="text/javascript"></script>-->


