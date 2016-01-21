<style>

    .col-xs-9, .col-xs-3{
        padding: 0px;
    }

    #datatable_filter{
        display: none;
    }
</style>
<link href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="Stylesheet" type="text/css">
<!--<script src="<?php echo asset_url(); ?>js/jquery-1.11.0.js" type="text/javascript"></script>-->
<script src="<?php echo asset_url(); ?>js/jquery.dataTables.min.js" type="text/javascript"></script>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
        <span class="pull-left">Total Expected <?php
            if ($this->Product_Id == '1') {
                echo "Vials";
            } else {
                echo "Rx";
            }
            ?> For <?php echo date('M', strtotime($this->nextMonth)); ?> <?php echo $this->nextYear ?> : <b><?php echo isset($show4['target']) ? $show4['target'] : 0; ?></b></span><br>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
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

    </div>
</div>
<?php echo form_open('User/Reporting'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Reporting</div>
        <div class="panel-body">
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


                        <th><?php echo date('M', strtotime('-3 month')) . $vials; ?> </th>
                        <th><?php echo date('M', strtotime('-2 month')) . $vials; ?></th>
                        <th><?php echo date('M', strtotime('-1 month')) . $vials; ?></th>
                        <th>New <?php echo $vials; ?> Targeted For <?php echo date('M', strtotime($this->nextMonth)); ?> </th>
                        <th>Cumulative Month to Date</th>
                        <th>Actual</th>
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
                                echo 'style="background-color:#c6ebd9;"';
                            } elseif (isset($doctor->Approve_Status) && $doctor->Approve_Status == 'Un-Approved') {
                                echo 'style="background-color: #ff9999;"';
                            }
                            ?>>
                                <td><?php echo $doctor->Account_Name; ?><p>Speciality : <?php echo $doctor->Specialty; ?></p></a></td>
                                <td><?php echo $month1Actual; ?></td>
                                <td><?php echo $month2Actual; ?></td>
                                <td><?php echo $month3Actual; ?></td>
                                <td><?php echo $planned_rx ?><input type = "hidden" name = "doc_id[]" value = "<?php $doctor->Account_ID ?>"/></td>
                                <td><?php echo $month4rx ?></td>
                                <td><?php echo isset($doctor->Daily_Actual_Rx) ? $doctor->Daily_Actual_Rx : ''; ?></td>
                                <td> <input name = "value[]" type = "number" class="val" min="0" value = ""/></td>
                            </tr>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php echo isset($doctorList) ? $doctorList : '' ?>
            <input type="hidden" id="Status" name="Status" value="Draft">
            <input type="hidden" id="Approve_Status" name="Approve_Status" value="">
        </div>
        <div class="panel-footer">
            <button type="submit" id="Save" class="btn btn-primary">Save</button>
            <button type="submit" id="Submit" class="btn btn-danger">Submit</button>
            <button type="submit" id="Approve_Status" class="btn btn-info">Save Approved</button>
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
        } else {
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
    $('#Approve').click(function () {
        $("#Approve_Status").val('SFA');
    });
</script>
