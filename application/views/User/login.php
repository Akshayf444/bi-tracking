<div class="container" style="margin-top: 2em;">
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-danger" style="text-align:center">' .$message .'</div>';
    }
    ?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
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
</div>