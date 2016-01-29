
<?php echo form_open('ASM/approveTarget'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Target New Rxn for the month</th>
                    <th><?php
                        if (isset($ck) && $ck == 'Thrombi') {
                            echo "Actilyse";
                        } else {
                            echo "Trajenta";
                        }
                        ?></th>
                    <th><?php
                        if (isset($ck) && $ck == 'Thrombi') {
                            echo "Pradaxa";
                        } else {
                            echo "Jardiance";
                        }
                        ?></th>
                    <th><?php
                        if (isset($ck) && $ck == 'Thrombi') {
                            echo "Metalyse";
                        } else {
                            echo "Trajenta Duo";
                        }
                        ?></th>
                </tr>
                <tr>
                    <th>Name of BDM<th>
                    <th><th>
                </tr>
                <?php
                if (!empty($table)) {
                    $product1_target = '';
                    $product2_target = '';
                    $product3_target = '';
                    foreach ($table as $tab):
                        $nextRow = array_shift($table);

                        if ($nextRow->VEEVA_Employee_ID == $tab->VEEVA_Employee_ID) {
                            $product1_target = $tab->target;
                            $product2_target = $tab->target;
                            $product3_target = $tab->target;
                        }
                        ?>
                        <tr>
                            <td><?php echo $tab->Full_Name ?></td>
                            <td><input type="text" value="<?php echo $product1_target; ?>"></td>
                            <td><input type="text" value="<?php echo $product2_target; ?>"></td>
                            <td><input type="text" value="<?php echo $product3_target; ?>"></td>
                        </tr>
                        <?php
                    endforeach;
                }
                ?>
            </table>
        </div>
    </div>
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