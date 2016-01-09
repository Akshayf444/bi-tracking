<div class="row">
    <div class="col-lg-3"></div>
    <div class="panel panel-default col-lg-6">
        <?php 
        $attribute=array('id' => 'activate');
        echo form_open('User/password',$attribute); ?>
        <div class="form-group panel-body">
            <input type="text" name="password" class="form-control" placeholder="Enter Your New Password"/>
            <input type="text" name="password2" class="form-control" placeholder="Retype Your Password"/>
        </div>
        <div class="form-group panel-footer">
            <input type="submit" class="btn btn-positive"/>
        </div>
        </form>
    </div>
    <div class="col-lg-3"></div>
</div>
<script>
    $('document').ready(function () {

        $('#activate').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                
                password: {
                    validators: {
                        identical: {
                            field: 'password2',
                            message: 'The password and its Repeat are not the same'
                        }
                    }
                },
                password2: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its Repeat are not the same'
                        }
                    }
                },
               
            }
        });
    });
</script>

<script src="<?php echo asset_url() ?>js/formValidation.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/bootstrap.min.js" type="text/javascript"></script>