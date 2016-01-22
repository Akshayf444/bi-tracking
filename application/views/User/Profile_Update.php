

<div align="center" class="col-md-4 col-lg-4">
    <div class="panel panel-success">
        <div class=" panel-heading">
            <?php echo $detail['Full_Name'] ?>
        </div>
        <div class=" panel-body">
            <img alt="image"/>
        </div>

    </div>
</div>
<h3><?php
    if (isset($error)) {
        echo $error;
    }
    ?></h3>
<div align="center" class="col-lg-8 col-md-8">
    <ul align="center" class="nav nav-tabs ">
        <li class="active"><a data-toggle="tab" style="    padding: 12px;" href="#home">Basic Detail</a></li>
        <li><a data-toggle="tab" style="    padding: 12px;" href="#menu1">Change Password</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <?php echo form_open('User/BDM_update'); ?>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Mobile</th>
                        <td><input type="text" class="form-control" maxlength="10" minlength="10" name="mobile" value="<?php echo $detail['Mobile']; ?>"/></td>
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
                </tbody>
            </table>
            <input type="Submit" value="Submit" class="btn btn-success pull-right"/>
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
            <input type="Submit" value="Submit" class="btn btn-success pull-right"/>
            </form>
        </div>

    </div>
</div>
