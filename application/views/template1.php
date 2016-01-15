<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/ratchet.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/ratchet-theme-ios.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="content" style="padding-right: 0px;padding-left: 0px">
            <?php $this->load->view($content, $view_data); ?>
        </div>
        <?php //$this->load->view('footer'); ?>

    </body>
</html>

