
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Update ACtivitiy </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php echo form_open('admin/update_act'); ?>


<?php
if (!empty($rows)) {
    ?>
    <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
        <input type="hidden" class="form-control" value="<?php echo $rows['Activity_id']; ?>" name="Act_id" placeholder="Enter Activity_Name"/>
        Name:  <input type="text" class="form-control" value="<?php echo $rows['Activity_Name']; ?>" name="Activity_Name" placeholder="Enter Activity_Name"/>
        Division:<input type="text" class="form-control" value="<?php echo $rows['Division']; ?>" name="Division" placeholder="Enter Division "/>
        Product:<select  class="form-control" name="Product_ID" >
            <option value="-1">Select Product</option>
            <?php echo $Product ?>
        </select>   
    <?php } ?>
    <div class="row">
        <button class="btn btn-lg btn-success pull-right">Submit</button>
    </div>
</div>

</form>
