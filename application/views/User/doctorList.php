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
<script src="<?php echo asset_url(); ?>js/jquery-1.11.0.js" type="text/javascript"></script>
<script src="<?php echo asset_url(); ?>js/jquery.dataTables.min.js" type="text/javascript"></script>
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
<?php
$attributes = array('id' => 'ProfilingForm');
echo form_open('User/Planning', $attributes);
?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Planning</div>
        <div class="panel-body">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
        </div>
        <div class="panel-footer">
            <button type="button" id="Priority" class="btn btn-negative">Prioritize</button>        
            <button type="submit" id="Save" style="display:none" class="btn btn-primary">Save</button>
            <button type="button" id="Submit" style="display:none" class="btn btn-positive">Submit</button>

        </div>
    </div>
</div>
</form>
<script>

    $(document).ready(function () {
        $(".val").keyup(function () {
            RemainingBalance();
        });

        $('#datatable').dataTable({
            "bPaginate": false,
            "bInfo": false
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
        } else {
            $("#Save").hide();
            $("#Submit").hide();
        }
    }

    $("#Priority").click(function () {
        var formAction = '<?php echo site_url('User/generatePriority'); ?>';
        $("#ProfilingForm").attr('action', formAction);
        $("#ProfilingForm").submit();
    });

    $("#Submit").click(function () {
        $.ajax({
            type: 'POST',
            data: {'Table_Name': 'Rx_Planning'},
            url: '<?php echo site_url('User/updateDraftStatus'); ?>',
            success: function (data) {
                //alert(data);
                if (data != '404') {
                    alert('Data Submitted Successfully.');
                }

            }
        });
    });


</script>