<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE, NO-STORE, must-revalidate">
        <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <META HTTP-EQUIV="EXPIRES" CONTENT=0>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css " >
        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/jquery-ui.css" rel="stylesheet" type="text/css " >

        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/jquery-ui.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/bootstrap.min_1.js" type="text/javascript"></script>
        <script src='<?php echo asset_url() ?>js/jquery.bootstrap-growl.min.js' type='text/javascript'></script>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?php
        echo $this->session->userdata('message') ? $this->session->userdata('message') : '';
        $this->session->unset_userdata('message');
        ?>
        <style>
            .navbar {
                border-bottom: 1px solid #e7e7e7;
                border-radius: 0px; 
                min-height: 46px;
            }
            .form-control{
                height: 32px;
                padding: 3px 3px;
            }
            input[type=text],input[type=number]{
                height: 32px;
                padding: 0px 4px;
            }
            .panel{
                margin-top: 10px;
            }
            .panel{
                margin-bottom: 10px;
                margin-top: 0px;
            }
            .panel-heading{
                text-align: center;
                font-size: 18px;
                font-weight: bold;
            }
            a{
                cursor: pointer;
            }

            .nav>li>a {
                position: relative;
                display: block;
                padding: 0px 6px;
            }
            .col-md-3{
                padding: 0;
            }
        </style>

        <?php
        if ($this->session->userdata('Product_Id') == 1) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: #79B61C;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 2) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: #4E88BC;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 3) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: #EFC083;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 4) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: skyblue;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 5) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: #20B2AA;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 6) {
            ?>
            <style>
                .table-view,.panel-body{
                    background-color: #9999ff;
                }
            </style>
        <?php } ?>
    </head>
    <body style="background: #ECEFF1">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div  class="navbar-header col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

                    <div  class="col-md-1 col-sm-1 col-xs-1 col-lg-1" style="padding: 0">
                        <a class="fa fa-2x fa-arrow-left" onclick="window.location = '<?php echo isset($backUrl) ? site_url($backUrl) : site_url('User/dashboard'); ?>';" style="padding:8px 0px 0px 0px"></a>
                    </div>
                    <div align="middle" class="col-md-8 col-sm-9 col-xs-9 col-lg-9"> 
                        <img  style="" onclick="window.location = '<?php echo $this->Designation == 'BDM' ? site_url('User/dashboard') : site_url('ASM/dashboard'); ?>';" src="<?php echo asset_url() ?>images/Boehringer.png" alt=""/>
                    </div>
                    <div class="col-md-3 col-sm-2 col-xs-3 col-lg-2">
                        <div class="dropdown pull-right" style="top:10px">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo isset($this->Full_Name) ? ' ' . $this->Full_Name : ''; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li> <a onclick="window.location = '<?php
                                    if ($this->Designation == 'BDM') {
                                        echo site_url('User/BDM_update');
                                    } else {
                                        if ($this->Designation == 'ASM') {
                                            echo site_url('ASM/ASM_update');
                                        }
                                    }
                                    ?>';"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                                <li><a href="#" onclick="window.location = '<?php echo site_url('User/logout'); ?>';"  ><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </nav>
<?php $this->load->view($content, $view_data); ?>
    </body>
</html>