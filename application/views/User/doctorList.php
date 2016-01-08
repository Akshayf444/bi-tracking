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
            <span class="pull-left">No Of New <?php
                if ($this->Product_Id == '1') {
                    echo "Vials";
                } else {
                    echo "Rx";
                }
                ?> Targeted For <?php echo date('M', strtotime($this->nextMonth)); ?> <?php echo date('Y', strtotime($this->nextYear)); ?> : <b ><input type="text" readonly="readonly" style=" width: 67px;    border: none;" class="ck" value="<?php echo isset($show4['target']) ? $show4['target'] : 0; ?>"></b></span><br><br>
            <span style="    margin-left: -327px;" class="pull-left">Balanced <?php
                if ($this->Product_Id == '1') {
                    echo "Vials";
                } else {
                    echo "Rx";
                }
                ?> To Plan For Jan 2016: <b class="ckk"></b></span>
            <span class="pull-right">
                Sort By
                <select class="form-control">
                    <option>Winability</option>
                    <option>Dependency</option>
                    <option>BI Market Share</option>
                    <option>Planned <?php
                        if ($this->Product_Id == '1') {
                            echo "Vials";
                        } else {
                            echo "Rx";
                        }
                        ?> Of Present Month</option>
                </select>
            </span>
        </li>
    </ul>
</div>
<?php echo form_open('User/Planning'); ?>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Planning</li>
        <li class="table-view-cell ">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
        </li>
        <li class="table-view-cell">
            <br/>


            <button type="submit" class="btn btn-negative">Prioritize</button>
            <button type="submit" style="margin-right:  87px;" class="btn btn-positive pull-right">Submit</button>
            <button type="submit" style="margin-right: 162px;" class="btn btn-primary pull-right">Save</button>
            <br/>
        </li>
    </ul>
</div>
</form>
<script>

    $(document).ready(function () {

        $(".val").keyup(function () {
            var finalval = 0;
            $(".val").each(function () {
                var actual = parseInt($(this).val(), 10) || 0;
                finalval = parseInt(finalval, 10) + actual;
            });

            var grandTotal = $('.ck').val() - finalval;
            $('.ckk').html(grandTotal);
        });

    })
</script>