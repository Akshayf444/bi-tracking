<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body ">
            <?php echo form_open('ASM/reporting_rx'); ?>
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
<?php echo form_open('ASM/Approvereporting'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if (!empty($show)) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover ">

                <tr style="background-color: #428BCA">

                    <th>Doctor Name</th>
                    <th>Reporting Rx</th>
                    <th><input type="checkbox" id="check-all"></th>
                </tr>

                <?php foreach ($show as $row) :
                    ?>
                    <tr>  

                        <td><?php echo $row->Account_Name; ?></td>  
                    <input type="hidden" name="RXPLAN_ID" value="<?php echo $row->Rxplan_id ?>">
                    <td><?php echo $row->Actual_Rx; ?> <input type="hidden" name="Doctor_Id[]" value="<?php echo $row->Account_ID ?>"> <input type="hidden" name="BDM_ID" value="<?php echo isset($_POST['rx_id']) ? $_POST['rx_id'] : '' ?>"> </td>
                    <td><input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>"><input type="checkbox" id="check-all" <?php echo isset($row->Approve_Status) && $row->Approve_Status == 'Approved' ? 'checked' : '' ?> name="approve_<?php echo $row->Account_ID ?>" value="<?php echo $row->Account_ID ?>"></td>
                    </tr>



                    <?php
                endforeach;
                echo '</table> 
        <button type="submit" class=" btn btn-primary pull-right" > Approve</button>';
            }
            else {
                echo '<h3>Data Not Available</h3>';
            }
            ?>

    </div>

</div>
<script>
    $('#check-all').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
</script>
