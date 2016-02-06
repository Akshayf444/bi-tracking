<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/bootstrap.min_1.js" type="text/javascript"></script>
         <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src='<?php echo asset_url() ?>js/jquery.bootstrap-growl.min.js' type='text/javascript'></script>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!--[if lt IE 8]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
    echo $this->session->userdata('message') ? $this->session->userdata('message') : '';
    $this->session->unset_userdata('message');
    ?>
    <body style="background: #cccccc">
        <div class="content" style="padding-right: 0px;padding-left: 0px">
            <?php $this->load->view($content, $view_data); ?>
        </div>
        <?php //$this->load->view('footer'); ?>

    </body>
</html>

