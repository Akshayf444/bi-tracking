<style>
    .table-view .table-view-cell {
        background-position: 0px 100%;
    }
    .col-xs-9, .col-xs-3{
        padding: 0px;
    }
    .table-view-cell {
        padding: 11px 12px 11px 15px;
    }
</style>
<script src="<?php echo asset_url(); ?>js/formValidation.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Set Expected Rx</div>
        <div class="panel-body">
            <?php $attributes = array('id' => 'form1', 'name' => 'myform');
            echo form_open('User/Set_Target', $attributes) ?>
            <div class="form-group">
                Total Expected Rx from Doctors in <?php echo date('M', strtotime($this->nextMonth)); ?>
                <input type="number" name="value">
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-positive"/>Submit</button>
        </div>
        </form>


    </div>

</form>
<ul class="table-view">
    <li class="table-view-cell">

        <table class="table table-bordered">
            <tr>
                <th></th>
                <th><?php echo $month_mid; ?></th>
                <th><?php echo $month_start; ?></th>
                <th><?php echo $month_between; ?></th>
                <th><?php echo $month_ends; ?></th>
<!--                <th><?php echo $current_month; ?></th>-->
            </tr>
            <tr>
                <td>Rx Target :</td>
                <td><?php
                    foreach ($show5 as $sh5) {
                        echo $sh5->target;
                    }
                    ?></td>
                <td><?php
                    foreach ($show1 as $sh1) {
                        echo $sh1->target;
                    }
                    ?></td>
                <td><?php
                    foreach ($show2 as $sh2) {
                        echo $sh2->target;
                    }
                    ?></td>
                <td><?php
                    foreach ($show3 as $sh3) {
                        echo $sh3->target;
                    }
                    ?></td>
<!--                <td><?php
                foreach ($show4 as $sh4) {
                    // echo $sh4->target;
                }
                ?></td>-->
            </tr>
            <tr>
                <td>
                    Actual :
                </td>
                <td><?php
                    foreach ($Actual1 as $sh1) {
                        echo $sh1->Act;
                    }
                    ?></td>
                <td><?php
                    foreach ($Actual2 as $sh2) {
                        echo $sh2->Act;
                    }
                    ?></td>
                <td><?php
                    foreach ($Actual3 as $sh3) {
                        echo $sh3->Act;
                    }
                    ?></td>
                <td><?php
                    foreach ($Actual4 as $sh4) {
                        echo $sh4->Act;
                    }
                    ?></td>
<!--                <td><?php
                foreach ($show4 as $sh4) {
                    // echo $sh4->target;
                }
                ?></td>-->
            </tr>

        </table>
    </li>
</ul>

</div>
<script>
    $('document').ready(function () {
        $('#form1').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                value: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                        integer: {
                            message: 'It Has To Be No'
                        }
                    }
                }

            }
        });
    });

</script>