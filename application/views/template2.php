<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

<!--        <link href="<?php echo asset_url() ?>css/ratchet.css" rel="stylesheet" type="text/css"/>-->
<!--        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css " >-->
<!--        <link href="<?php echo asset_url() ?>css/ratchet-theme-ios.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<!--        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>-->
<!--        <script src="<?php echo asset_url() ?>js/bootstrap.min_1.js" type="text/javascript"></script>-->
        <script src='<?php echo asset_url() ?>js/jquery.bootstrap-growl.min.js' type='text/javascript'></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
        <?php
        echo $this->session->userdata('message') ? $this->session->userdata('message') : '';
        $this->session->unset_userdata('message');
        ?>
        <style>
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
    <body>


        <!DOCTYPE html>
    <html lang="en">

        <title>Bootstrap Case</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img style="" onclick="window.location = '<?php echo $this->Designation == 'BDM' ? site_url('User/dashboard') : site_url('ASM/dashboard'); ?>';" src="<?php echo asset_url() ?>images/travels.png" alt=""/>
             
                        <a class="fa fa-2x fa-arrow-left pull-left" onclick="window.location = '<?php echo isset($backUrl) ? site_url($backUrl) : site_url('User/dashboard'); ?>';" style="padding:8px 0px 0px 0px"></a>
                   
                </div>
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo isset($this->Full_Name) ? ' ' . $this->Full_Name : ''; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li> <a onclick="window.location = '<?php echo site_url('User/BDM_update'); ?>';"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                        <li><a href="#" onclick="window.location = '<?php echo site_url('User/logout'); ?>';"  ><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                    </ul>
                </div>
            </div>

        </nav>

    </html>







    <!--            <h1 class="title" >  
                    <img style="height: 99%" onclick="window.location = '<?php echo $this->Designation == 'BDM' ? site_url('User/dashboard') : site_url('ASM/dashboard'); ?>';" src="<?php echo asset_url() ?>images/travels.png" alt=""/>
                    <ul class="nav navbar-right top-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo isset($this->Full_Name) ? ' ' . $this->Full_Name : ''; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a onclick="window.location = '<?php echo site_url('User/BDM_update'); ?>';"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li>
    
                                <li><a href="#" onclick="window.location = '<?php echo site_url('User/logout'); ?>';"  ><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                                    
    
    <a class="fa fa-2x fa-power-off pull-right" onclick="window.location = '<?php echo site_url('User/logout'); ?>';" style="padding:8px 0px 0px 0px"></a>
    <?php if ($title != 'Main') { ?>
                                                                                            <a class="fa fa-2x fa-arrow-left pull-left" onclick="window.location = '<?php echo isset($backUrl) ? site_url($backUrl) : site_url('User/dashboard'); ?>';" style="padding:8px 0px 0px 0px"></a>
    <?php }
    ?>
                    </div>
                </h1>-->


    <script>
        function goback() {

            window.history.back();
        }
    </script>
    <div class="content" style="padding-right: 0px;padding-left: 0px">

        <?php $this->load->view($content, $view_data); ?>
    </div>

</body>
<!--    <a  href="http://www.jqueryajaxphp.com/dynamically-animate-jquery-knob">Tutorial: Dynamically animate jQuery knob</a>-->
</html>

