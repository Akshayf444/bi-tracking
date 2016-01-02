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
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">
            <span class="pull-left">Total Expected Rx For Jan 2016 : <b>200</b></span><br>
            <span class="pull-left">Balanced Rx To Plan For Jan 2016: <b>200</b></span>
            <span class="pull-right">
                Sort By
                <select class="form-control">
                    <option>Rx</option>
                    <option>Priority</option>
                    <option>Winability</option>
                    <option>Dependency</option>
                </select>
            </span>
        </li>
    </ul>
</div>
<?php echo form_open('User/Reporting'); ?>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Planning</li>
        <li class="table-view-cell ">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
        </li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-positive">Submit</button>
            <br/>
        </li>

    </ul>
</div>
</form>