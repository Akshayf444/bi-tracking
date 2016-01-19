
<div align="center" class="row">
    <div class="col-lg-1"></div>
    <div align="center" class="col-lg-3">
        <div class="panel panel-default">
            <div class=" panel-heading">
                        <?php echo $detail['Full_Name'] ?>
            </div>
            <div class=" panel-body">
                <img alt="image"/>
            </div>
            
        </div>
    </div>
    <h3><?php if(isset($error))
{
    echo $error;
}?></h3>
    <div align="center" class="col-lg-6">
        <ul align="center" class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Basic Detail</a></li>
            <li><a data-toggle="tab" href="#menu1">Change Password</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <?php echo form_open('User/BDM_update'); ?>
        
                <table class="table table-bordered">
                    <tr>
                        <th>Mobile</th>
                        <td><input type="text" class="form-control" name="mobile" value="<?php echo $detail['Mobile']; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Reporting ASM</th>
                        <td><input type="text" class="form-control" readonly=""  value="<?php echo $detail['ASM']; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Reporting ZSM</th>
                        <td><input type="text" class="form-control" readonly=""  value="<?php echo $detail['ZSM']; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Territory</th>
                        <td><input type="text" class="form-control" readonly=""  value="<?php echo $detail['Territory']; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Date Of Birth</th>
                        <td><input type="text" class="form-control" readonly=""  value="<?php echo $detail['DOB']; ?>"/></td>
                    </tr>
                    <tr>
                        <th>Date of Joining</th>
                        <td><input type="text" class="form-control" readonly=""  value="<?php echo $detail['Date_of_Joining']; ?>"/></td>
                    </tr>
                </table>
                <input type="Submit" value="Submit" class="btn btn-positive"/>
                </form>
            </div>
            <div id="menu1" class="tab-pane fade">
                <?php echo form_open('User/pwd_update'); ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Old Password</th>
                        <td><input type="text" name="old" class="form-control" name="mobile" /></td>
                    </tr>
                    <tr>
                        <th>New Password</th>
                        <td><input type="text" name="new" class="form-control" name="mobile" /></td>
                    </tr>
                </table>
                <input type="Submit" value="Submit" class="btn btn-positive"/>
                </form>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </div>
</div>