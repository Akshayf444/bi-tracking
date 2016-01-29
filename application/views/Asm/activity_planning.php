<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body ">
            <?php echo form_open('ASM/activity_planning'); ?>
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
                <button class="btn btn-primary" >FETCH</button>
            </div>
            <div class="col-sm-7 col-md-7"  >
                <p>Please tick the checkbox against the plan to approve and keep unticked to dis-approve </p>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php
    echo form_open('ASM/ApproveActivity');
    if (!empty($Doctorlist)) {
        echo $Doctorlist;
    }
    ?>
    <input type="hidden" name="BDM_ID" value="<?php echo isset($_POST['rx_id']) ? $_POST['rx_id'] : '' ?>">
    <input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>">
    </form>
</div>
<script>
    $('#check-all').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
</script>