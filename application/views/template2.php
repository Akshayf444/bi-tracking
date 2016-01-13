<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link href="<?php echo asset_url() ?>css/ratchet.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css " >
        <link href="<?php echo asset_url() ?>css/ratchet-theme-ios.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/bootstrap.min_1.js" type="text/javascript"></script>
        

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
        <header class="bar bar-nav">
            <h1 class="title" >  
                <img style="height: 99%" onclick="window.location = '<?php echo site_url('User/dashboard'); ?>';" src="<?php echo asset_url() ?>images/travels.png" alt=""/>
                <a class="fa fa-2x fa-power-off pull-right" onclick="window.location = '<?php echo site_url('User/logout'); ?>';" style="padding:8px 0px 0px 0px"></a>
                <?php if ($title != 'Main') { ?>
                    <a class="fa fa-2x fa-arrow-left pull-left" onclick="goback()" style="padding:8px 0px 0px 0px"></a>
                <?php }
                ?>
                </div>
            </h1>
        </header>
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

