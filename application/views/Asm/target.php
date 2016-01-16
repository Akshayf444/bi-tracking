<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <div class="col-sm-4"></div>

            <?php echo form_open('ASM/target'); ?>
            <div class="col-sm-3"  >
                <select id="product_id" name="product_id" class="form-control">
                    <option value="-1">Select Product</option>
                    <?php echo $product; ?>
                </select>
            </div>
            <div class="col-sm-2"  >
                <button class="btn btn-primary" >FETCH</button>
            </div>
            </form>
        </li>
    </ul>
</div>

<?php echo form_open('ASM/approveTarget'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <tr>
            <tr style="background-color: #428BCA">

                <th>BDM Name</th>
                <th> Target Set</th>
                <th><input type="checkbox" id="check-all"></th>
            </tr>

            <?php
            if (isset($result) && !empty($result)) {
                foreach ($result as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value->Full_Name ?></td>
                        <td><?php echo $value->target ?></td>
                        <td><input type="checkbox" class="approve" <?php echo isset($value->Approve_Status) && $value->Approve_Status == 'Approved' ? 'checked' : '' ?> name="approve[]" value="<?php echo $value->VEEVA_Employee_ID ?>"><input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>"></td>
                    <tr>  
                        <?php
                    }
                }
                ?>

            </tr>


        </table>

    </div>

    <button type="submit" class="btn btn-primary pull-right" >Approve</button>

</div>
</form>
<script>
    $('#product_id').change(function () {
        $('input[name="product"]').val($(this).val());
    });

    $("#check-all").change(function () {
        alert();
        if ($(this).prop('checked', true)) {
            $('.approve').each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $('.approve').each(function () {
                $(this).prop('checked', false);
            });
        }
    });
</script>