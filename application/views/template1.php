<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : ""; ?></title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link href="http://pocketdrugs.com/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/ratchet.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/ratchet-theme-ios.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/app.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>css/pygments-manni.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>

    </head>
    <body>
        <div class="content" style="padding-right: 0px;padding-left: 0px">
            <?php $this->load->view($content, $view_data); ?>
        </div>
        <?php //$this->load->view('footer'); ?>

        <script src="<?php echo asset_url() ?>js/ratchet.min.js" type="text/javascript"></script>
<!--        <script src="<?php echo asset_url() ?>js/segmented-controllers.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/modals.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/popovers.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/push.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/sliders.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/toggles.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/docs.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/docs.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url() ?>js/fingerblast.js" type="text/javascript"></script>-->
    </body>
</html>

