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
<!--        <link href="<?php echo asset_url() ?>css/app.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/pygments-manni.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
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

        <?php
        print_r($this->session->all_userdata());
        if ($this->session->userdata('Product_Id') == 1) {
            ?>
            <style>
                .table-view{
                    background-color: red;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 2) {
            ?>
            <style>
                .table-view{
                    background-color: green;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 3) {
            ?>
            <style>
                .table-view{
                    background-color: blue;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 4) {
            ?>
            <style>
                .table-view{
                    background-color: skyblue;
                }
            </style>
            <?php
        } elseif ($this->session->userdata('Product_Id') == 5) {
            ?>
            <style>
                .table-view{
                    background-color: orange;
                }
            </style>
            <?php
        }
        ?>
    </head>
    <body>
        <header class="bar bar-nav">
            <h1 class="title" >  
                <img style="height: 99%" src="<?php echo asset_url() ?>images/travels.png" alt=""/>
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

        <script src="<?php echo asset_url() ?>js/ratchet.min.js" type="text/javascript"></script>

    </body>
    <!--    <a  href="http://www.jqueryajaxphp.com/dynamically-animate-jquery-knob">Tutorial: Dynamically animate jQuery knob</a>-->
</html>

