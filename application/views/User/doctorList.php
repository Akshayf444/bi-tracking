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
                <select class="form-control" id="TableSort">
                    <option value="1">Select Filter</option>
                    <option value="1">Winability</option>
                    <option value="2">Dependency/Rx For Last Month</option>
                    <option value="3">BI Market Share</option>
                    <option value="7">Planned <?php
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
        <div class="panel-body table-responsive">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
            <input type="hidden" id="Status" name="Planning_Status" value="Draft">
            <input type="hidden" id="Approve_Status" name="Approve_Status" value="SFA">
        </div>
        <div class="panel-footer">
            <button type="button" id="Priority" class="btn btn-negative">Prioritize for activities</button>        
            <button type="submit" id="Save" class="btn btn-primary">Save</button>
            <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
            <button type="submit" id="Approve" class="btn btn-primary">Save Approved</button>
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


    $(document).ready(function () {
        $(".val").keyup(function () {
            RemainingBalance();
        });

        var oTable = $('#datatable').dataTable({
            "bPaginate": false,
            "bInfo": false,
            "info": false,
            "columnDefs": [
                {
                    "targets": [7],
                    "visible": false
                }
            ]
        });
        $('#TableSort').on('change', function () {
            var selectedValue = $(this).val();
            oTable.fnSort([[selectedValue, 'desc']]); //Exact value, column, reg
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

        } else {
            $("#Submit").attr('type', 'button');
        }
    }

    $("#Priority").click(function () {
        var formAction = '<?php echo site_url('User/generatePriority'); ?>';
        $("#ProfilingForm").attr('action', formAction);
        $("#ProfilingForm").submit();
    });

    $("#Submit").click(function () {
        var finalval = 0;
        $(".val").each(function () {
            var actual = parseInt($(this).val(), 10) || 0;
            finalval = parseInt(finalval, 10) + actual;
        });

        var grandTotal = $('.ck').val() - finalval;
        $('.ckk').html(grandTotal);
        if (grandTotal == 0) {
            $("#Submit").attr('type', 'submit');
        } else if (grandTotal > 0) {
            var answer = confirm("Planned Rx is Less Than Set Target")
            if (answer) {
                //$("#Submit").attr('type', 'submit');
            }
            else {
                $("#Submit").attr('type', 'button');
            }
        } else if (grandTotal < 0) {
            var answer = confirm("Planned Rx is More Than Set Target")
            if (answer) {
                $("#Submit").attr('type', 'submit');
            }
            else {
                $("#Submit").attr('type', 'submit');
            }
        }

        $("#Status").val('Submitted');

    });
    $('#Approve').click(function(){
        $("#Approve_Status").val('SFA');
    });
</script>