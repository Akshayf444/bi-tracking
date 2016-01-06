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
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Set Expected Rx</div>
        <div class="panel-body">
            <?php echo form_open('User/Set_Target') ?>
            <div class="form-group">
                Total Expected Rx from Doctors in <?php echo $date; ?>
                <input type="text" name="value">
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-positive"/>Submit</button>
        </div>
        </form>

    </div>
    <ul class="table-view">
        <li class="table-view-cell">
            <table class="table table-bordered">
                <tr>
                    <th><?php echo $month_start; ?></th>
                    <th><?php echo $month_between; ?></th>
                    <th><?php echo $month_ends; ?></th>
                    <th><?php echo $current_month; ?></th>
                </tr>
                <tr>
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
                    <td><?php
                        foreach ($show4 as $sh4) {
                            echo $sh4->target;
                        }
                        ?></td>
                </tr>
            </table>
        </li>
    </ul>
</div>

<script>
    $("#product").change(function () {
        $("#rx").show();
    });
</script>