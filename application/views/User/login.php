<div class="container" style="margin-top: 2em">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">

                    <img  src="<?php echo asset_url() ?>images/travels.png" width="45%" >

                </div>
                <div class="panel-body">
                    <form method="" action="<?php echo site_url('User/dashboard'); ?>">

                        <div class="form-group">
                            <input type="text" class="form-control uname" placeholder="Username" name="username"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control pword" placeholder="Password" name="password" />
                        </div>
                        <button class="btn btn-positive btn-block" type="submit" name="submit" >Sign In</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>