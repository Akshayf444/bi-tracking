
<?php echo form_open('ASM/approveTarget'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name of BDM</th>
                    <?php
                    if ($this->Division == 'Diabetes') {
                        echo '<th>Trajenta</th>';
                        echo '<th>Jardiance</th>';
                        echo '<th>Trajenta Duo</th>';
                    } else {
                        echo '<th>Actylise</th>';
                        echo '<th>Pradaxa</th>';
                        echo '<th>Metalyse</th>';
                    }
                    ?>
                </tr>

                <?php
                foreach ($table as $tab) {
                    if ($this->Division == 'Diabetes') {
                        $result = $this->asm_model->ASM_Assign_Target($tab->VEEVA_Employee_ID, 4, 5, 6);
                    } else {
                        $result = $this->asm_model->ASM_Assign_Target($tab->VEEVA_Employee_ID, 1, 2, 3);
                    }
                    ?>
                    <tr>
                        <td><input type="hidden" name="VEEVA_Employee_ID[]" value="<?php echo $tab->VEEVA_Employee_ID; ?>"><?php echo $tab->Full_Name ?></td>
                        <?php
                        $target1 = 0;
                        $target2 = 0;
                        $target3 = 0;
                        
                        foreach ($result as $r) {

                            if ($this->Division == 'Diabetes') {
                                if ($r->Product_Id == 4) {
                                    $target1 = $r->target;
                                } elseif ($r->Product_Id == 5) {
                                    $target2 = $r->target;
                                } elseif ($r->Product_Id == 6) {
                                    $target3 = $r->target;
                                }
                            } else {
                                if ($r->Product_Id == 1) {
                                    $target1 = $r->target;
                                } elseif ($r->Product_Id == 2) {
                                    $target2 = $r->target;
                                } elseif ($r->Product_Id == 3) {
                                    $target3 = $r->target;
                                }
                            }
                        }
                        ?>

                        <td><input type="text" name="target1[]" value="<?php echo $target1 ?>"></td>
                        <td><input type="text" name="target2[]" value="<?php echo $target2 ?>"></td>
                        <td><input type="text" name="target3[]" value="<?php echo $target3 ?>"></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <div class="panel-footer">
            <input type="hidden" id="Status" name="Status" value="Draft">
            <input type="submit" id="Assign" class="btn btn-success" value="Assign">
            <input type="submit" class="btn btn-primary" value="Save">
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

    $("#Assign").click(function () {
        $("#Status").val('Submitted');
    });
</script>