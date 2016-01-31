<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open('ASM/reporting_activity'); ?>
            <div class="col-sm-2 col-md-2"  >
                <select name="rx_id" class="form-control">
                    <option value="-1">Select BDM </option>
                    <?php echo $bdm; ?>
                </select>
            </div>
            <div class="col-sm-2 col-md-2"  >
                <select name="product_id" class="form-control">
                    <option value="-1">Select Product</option>
                    <?php echo $product; ?>
                </select>
            </div>
            <div class="col-sm-1 col-md-1"  >
                <button type="submit" class="btn btn-primary" >FETCH</button>
            </div>
            <div class="col-sm-7 col-md-7"  >
                <p>Please tick the checkbox against the plan to approve and keep unticked to dis-approve </p>
            </div>
            </form>
        </div>
    </div>
</div>
<?php echo form_open('ASM/Approve_reporting_Activity'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    <?php
    if (!empty($Doctorlist)) {
        echo $Doctorlist;
    }
    ?>
    <input type="hidden" name="BDM_ID" value="<?php echo isset($_POST['rx_id']) ? $_POST['rx_id'] : '' ?>">
    <input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>">
</div>
</form>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if (!empty($productlist)) { ?>
        <div class="panel panel-default"> 
            <div class="panel-heading"> Status  </div>
            <div class="panel-body">

                <ul align="center" class="nav nav-tabs ">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        foreach ($productlist as $product) {
                            ?>
                            <li class="<?php echo isset($count) && $count == 1 ? 'active' : ''; ?>"><a data-toggle="tab" style="    padding: 12px;" href="#<?php echo $product->id ?>"><?php echo $product->Brand_Name ?></a></li>
                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;

                        foreach ($productlist as $product) {
                            $ApproveCount = 0;
                            $UnApproveCount = 0;
                            $Pending = 0;
                            $Submitted = 0;
                            ?>

                            <div id="<?php echo $product->id ?>" class="tab-pane fade <?php echo isset($count) && $count == 1 ? 'in active' : ''; ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>BDM Name</th>
                                        <th>Approved</th>
                                        <th>Un-Approved</th>
                                        <th>Pending</th>
                                        <th>Submitted</th>
                                    </tr>
                                    <?php
                                    $Status = $this->asm_model->ActivityReportingStatus($product->id);
                                    if (!empty($Status)) {
                                        foreach ($Status as $value) {
                                            $ApproveCount += $value->ApproveCount;
                                            $UnApproveCount += $value->UnApproveCount;
                                            $Pending += $value->SFACount;
                                            $Submitted += $value->SubmitCount;
                                            echo '<tr><td>' . $value->Full_Name . '</td><td>' . $value->ApproveCount . '</td><td>' . $value->UnApproveCount . '</td><td>' . $value->SFACount . '</td><td>' . $value->SubmitCount . '</td></tr>';
                                        }
                                        echo '<tr><th>Total</th><td>' . $ApproveCount . '</td><td>' . $UnApproveCount . '</td><td>' . $Pending . '</td><td>' . $Submitted . '</td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>


                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>  
    <?php } ?>
</div>
<script>
    $('#check-all').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
</script>
