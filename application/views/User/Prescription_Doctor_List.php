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

    #datatable_filter{
        display: none;
    }
</style>
<link href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="Stylesheet" type="text/css">
<!--<script src="<?php echo asset_url(); ?>js/jquery-1.11.0.js" type="text/javascript"></script>-->
<script src="<?php echo asset_url(); ?>js/jquery.dataTables.min.js" type="text/javascript"></script>
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
                <select class="form-control" id="TableSort">
                    <option>Select Criteria</option>
                    <option value="4">Planned <?php
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
<style>
    table.dataTable tbody tr {
        background-color: transparent;
    }
</style>
<script>
    $("#Submit").click(function () {
        $("#Status").val('Submitted');

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
        } else if (finalval == 0) {
            $("#Submit").attr('type', 'button');
            alert('Reporting Rx Should Be Greater Than 0');
        }else{
            $("#Submit").attr('type', 'submit');
        }
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

    var oTable = $('#datatable').dataTable({
        "bPaginate": false,
        "bInfo": false,
        "info": false,
    });
    $('#TableSort').on('change', function () {
        var selectedValue = $(this).val();
        oTable.fnSort([[selectedValue, 'desc']]); //Exact value, column, reg
    });
</script>