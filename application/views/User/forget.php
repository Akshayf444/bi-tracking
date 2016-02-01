
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  
                    <div class="pull-right">
                        <a href="<?php echo site_url() ?>/User/index" class="btn btn-primary btn-link">Login </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="">  Forget Password</h1>
                </div>
            </div>
            
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
               <?php echo form_open('user/sendMail2'); ?>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-xs-9">

                        <div class=" form-group">
Email:
<input type="text" class="form-control" name="email" autofocus="" value="" placeholder="Email"  >

                        </div>
                        <div class="pull-right" style="margin-top: 5px">
                            <input type="submit"  name="submit" value="send" class="btn btn-primary">

                        </div>

                </form>

                
            </div>

        </div>

    </div>
   

