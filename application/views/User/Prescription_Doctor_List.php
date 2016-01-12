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
            <span class="pull-left">Total Expected <?php
                if ($this->Product_Id == '1') {
                    echo "Vials";
                } else {
                    echo "Rx";
                }
                ?> For Jan 2016 : <b><?php echo isset($show4['target']) ? $show4['target'] : 0; ?></b></span><br>

            <span class="pull-right">
                Sort By
                <select class="form-control">
                    <option>Winability</option>
                    <option>Dependency/Rx For Last Month</option>
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
<?php echo form_open('User/Reporting'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Reporting</div>
        <div class="panel-body">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
            <input type="hidden" id="Status" name="Status" value="Draft">
        </div>
        <div class="panel-footer">
            <button type="submit" id="Save" class="btn btn-primary">Save</button>
            <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
        </div>
    </div>
</div>
</form>
<script>
    $("#Submit").click(function () {
        $("#Status").val('Submitted');
    });

    $(document).ready(function () {
        $(".val").keyup(function () {
            RemainingBalance();
        });

    });

    $(window).load(function () {
        RemainingBalance();
    });

    function RemainingBalance() {
        var finalval = 0;
        $(".val").each(function () {
            var actual = parseInt($(this).val(), 10) || 0;
            finalval = parseInt(finalval, 10) + actual;
        });

        var grandTotal = $('.ck').val() - finalval;
        $('.ckk').html(grandTotal);
        if (grandTotal == 0) {
            $("#Save").show();
            $("#Submit").show();
        }
    }
</script>