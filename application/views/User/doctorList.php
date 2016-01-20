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
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>
                            <?php
                            if ($this->Product_Id == 1) {
                                $vials = "Vials";
                                $hospital = "Hospital";
                            } else {
                                $vials = "Rx";
                                $hospital = "Doctor";
                            } echo $hospital;
                            ?> List</th>
                        <th>Winability</th>
                        <th>Dependency</th>
                        <?php if ($this->Product_Id == 1) { ?>
                            <th>LYSIS Share</th>
                        <?php } else { ?>
                            <th>BI Market Share</th>
                        <?php } ?>


                        <th><?php echo date('M', strtotime('-3 month')) . $vials; ?> </th>
                        <th><?php echo date('M', strtotime('-2 month')) . $vials; ?></th>
                        <th><?php echo date('M', strtotime('-1 month')) . $vials; ?></th>
                        <th>New <?php echo $vials; ?> Targeted For <?php echo date('M', strtotime($this->nextMonth)); ?> </th>
                        <th>New <?php echo $vials; ?> Targeted For <?php echo date('M', strtotime($this->nextMonth)); ?> </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $month = date('n', strtotime('-1 month'));
                    $lastMonthRx = $this->User_model->countLastMonthRx($month);
                    $currentMonthRx = $this->User_model->countPlannedRx(date('n'));
                    if (isset($result) && !empty($result)) {
                        foreach ($result as $doctor) {
                            $planned_rx = isset($doctor->Planned_Rx) ? $doctor->Planned_Rx : "";
                            $actual_rx = isset($doctor->Actual_Rx) ? $doctor->Actual_Rx : "";


                            $month1 = date('n', strtotime('-3 month'));
                            $month2 = date('n', strtotime('-2 month'));
                            $month3 = date('n', strtotime('-1 month'));
                            $month4 = date('n');
                            $year1 = date('Y', strtotime('-3 month'));
                            $year2 = date('Y', strtotime('-2 month'));
                            $year3 = date('Y', strtotime('-1 month'));
                            $year4 = date('Y');

                            $month1Actual = 0;
                            $month2Actual = 0;
                            $month3Actual = 0;
                            $month4Actual = 0;

                            $last3MonthRx = $this->User_model->Last3MonthsRx($month1, $month2, $month3, $month4, $year1, $year2, $year3, $year4, $doctor->Account_ID);
                            if (!empty($last3MonthRx)) {
                                $count = 1;
                                foreach ($last3MonthRx as $value) {
                                    if ($value->month === $month1) {
                                        $month1Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : 0;
                                    } elseif ($value->month === $month2) {
                                        $month2Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : 0;
                                    } elseif ($value->month === $month3) {
                                        $month3Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : 0;
                                    } elseif ($value->month === $month4) {
                                        $month4Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : 0;
                                    }
                                }
                            }
                            $winability = isset($doctor->Winability) ? $doctor->Winability : '';
                            $month4rx = $month4Actual;
                            if ($lastMonthRx->Actual_Rx > 0) {
                                $dependancy = round(($month3Actual / $lastMonthRx->Actual_Rx ) * 100, 0, PHP_ROUND_HALF_EVEN);
                            } else {
                                $dependancy = 0;
                            }
                            if ($this->Product_Id == 1) {
                                if (isset($doctor->Patient_Seen_month) && $doctor->Patient_Seen_month > 0) {
                                    $BI_Share = round(($month3Actual / $doctor->Patient_Seen_month) * 100, 0, PHP_ROUND_HALF_EVEN);
                                } else {
                                    $BI_Share = '';
                                }
                            } else {
                                if (isset($doctor->Patient_Rxbed_In_Month) && $doctor->Patient_Rxbed_In_Month > 0) {
                                    $BI_Share = round(($month3Actual / $doctor->Patient_Rxbed_In_Month) * 100, 0, PHP_ROUND_HALF_EVEN);
                                } else {
                                    $BI_Share = '';
                                }
                            }
                            ?>
                            <tr <?php
                            if (isset($doctor->Approve_Status) && $doctor->Approve_Status == 'Approved') {
                                echo 'style="background-color:#ff9999;"';
                            } elseif (isset($doctor->Approve_Status) && $doctor->Approve_Status == 'Un-Approved') {
                                echo 'style="background-color: #c6ebd9;"';
                            }
                            ?>>
                                <td><?php echo $doctor->Account_Name; ?><p>Speciality : <?php echo $doctor->Specialty; ?></p></a></td>
                                <td><?php echo $winability; ?></td><td><?php echo $dependancy; ?>%</td>
                                <td><?php echo $BI_Share; ?></td>
                                <td><?php echo $month1Actual; ?></td>
                                <td><?php echo $month2Actual; ?></td>
                                <td><?php echo $month3Actual; ?></td>
                                <td><?php echo $planned_rx; ?></td><td> <input name = "value[]" min="0" class = "val" type = "number" value = "<?php echo $planned_rx; ?>"/><input type = "hidden" name = "doc_id[]" value = "<?php echo $doctor->Account_ID; ?>"/></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php //echo isset($doctorList) ? $doctorList : ''     ?>
            <input type="hidden" id="Status" name="Planning_Status" value="Draft">
            <input type="hidden" id="Approve_Status" name="Approve_Status" value="">
        </div>
        <div class="panel-footer">
            <button type="button" id="Priority" class="btn btn-negative">Prioritize for activities</button>        
            <button type="submit" id="Save" class="btn btn-primary">Save</button>
            <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
            <button type="submit" id="Approve" class="btn btn-primary">Save For Approval</button>
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
    $('#Approve').click(function () {
        $("#Approve_Status").val('SFA');
    });
</script>