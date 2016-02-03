<div class="container" style="margin-top: 2em;">
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
    
<div class="col-lg-4">
<button type="button" class="btn btn-primary pull-right " data-toggle="modal" data-target="#myModal">
  Help
</button>
      </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         
        <h4 class="modal-title" id="myModalLabel">Help</h4>
      </div>
      <div class="modal-body">
          
          <p  style="text-align: center";> For Any Query Regarding The Reporting,Please Contact<b> 022-65657701</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>