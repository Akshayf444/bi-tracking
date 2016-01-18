<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <div class="col-sm-4"></div>

            <?php echo form_open('ASM/activity_planning'); ?>
            <div class="col-sm-3"  >
                <select name="rx_id" class="form-control">
                    <option value="-1">Select BDM </option>
                    <?php echo $bdm; ?>
                </select>
            </div>
            <div class="col-sm-3"  >
                <select name="product_id" class="form-control">
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
<<<<<<< HEAD

<?php echo form_open('ASM/ApproveActivity'); ?>
<?php
if(!empty($Doctorlist)){
echo $Doctorlist;}
 ?>
<input type="hidden" name="BDM_ID" value="<?php echo isset($_POST['rx_id']) ? $_POST['rx_id'] : '' ?>">
  <input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>">


<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php // if (!empty($Docctorlist)) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover ">

                <tr style="background-color: #428BCA">

                    <th>Doctor Name</th>
                   
                    <th><input type="checkbox" id="check-all"></th>
                </tr>

                <?php // foreach ($Doctorlist as $row) :
                    ?>
                    <tr>  

                        <td><?php // echo $row->Account_Name; ?></td>  
                       
                        <td><input type="hidden" name="product" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>"><input type="checkbox" id="check-all" <?php echo isset($row->Approve_Status) && $row->Approve_Status == 'Approved' ? 'checked' : '' ?> name="approve[]" value="<?php echo $row->Account_ID ?>"></td>
                    </tr>


                    <?php
//                endforeach;
//                echo '</table> 
//        <button type="submit" class=" btn btn-primary pull-right" > Approve</button>';
//            }
//            else {
//                echo '<h3>Data Not Available</h3>';
//            }
            ?>

    </div>

</div>-->
=======
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
>>>>>>> a5644b320ba301ea1156f7f465fd236bf4dc0a15
<script>
    $('#check-all').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
</script>
