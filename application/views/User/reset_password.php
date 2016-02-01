
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  
                   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="">  Reset Password</h1>
                </div>
            </div>
            
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
               <?php echo form_open('user/Reset_Password'); ?>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-xs-9">

                        <div class=" form-group">
Password:
<input type="password" class="form-control" name="password" autofocus="" value="" id="pass1
       "placeholder="Password"  >

                        </div>
                             <div class=" form-group">
 Confirm Password:
 <input type="password" class="form-control" name="c_password" autofocus="" value=""  id="pass2"placeholder="Confirm Password"  >

                        </div>
                        <div class="pull-right" style="margin-top: 5px">
                            <input type="submit"  name="submit" value="Reset" onclick="myFunction()" class="btn btn-primary">

                        </div>

                </form>

                
            </div>

        </div>

    </div>
   
<script>
    function myFunction() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        if (pass1 != pass2) {
            //alert("Passwords Do not match");
            document.getElementById("pass1").style.borderColor = "#E34234";
            document.getElementById("pass2").style.borderColor = "#E34234";
        }
        
    }
</script>
