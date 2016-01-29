
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
                <?php foreach($table as $tab):?>
                <tr>
                    <td><?php echo $tab->Full_Name?></td>
                </tr>
                <?php endforeach;?>
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