<link href="<?php echo asset_url() ?>css/jquery-ui.css" rel="stylesheet" type="text/css " >
<script src="<?php echo asset_url() ?>js/jquery.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/jquery-ui.js" type="text/javascript"></script>



<div class="container" style="margin-top: 2em;">
    <div class="pull-right" id="mini-notification">Helpline No : <span class="helpline" style = 'color:red;font-weight:bold'>022-65657701</span><br>From 10 am - 6 pm</div>
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-danger" style="text-align:center">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                    <img  src="<?php echo asset_url() ?>images/travels.png" width="45%" >
                </div>
                <div class="panel-body">
                    <?php echo form_open('User/index') ?>

                    <div class="form-group">
                        <input type="text" class="form-control uname" placeholder="Username" name="username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control pword" placeholder="Password" name="password" />
                    </div>
                    <input class="btn btn-success btn-block" type="submit" value="Sign In" >

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <a href="<?php echo site_url('User/forget_pass') ?>" width="45%" class="pull-right" > Forget Password</a>
        </div>
    </div>
</div>

<script>
    $(function () {

        function blinker() {
            $('.helpline').fadeOut(500);
            $('.helpline').fadeIn(500);
        }

        setInterval(blinker, 1000);
    });
</script>
