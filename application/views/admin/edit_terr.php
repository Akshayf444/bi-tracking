<div class="row">
    <?php echo form_open('admin/update_terr'); ?>
    <?php
    if (!empty($rows)) {
        ?>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <input type="hidden" class="form-control" value="<?php echo $rows['id']; ?>" name="terrid" />
          Territory:  <input type="text" class="form-control" value="<?php echo $rows['territory']; ?>" name="territory" placeholder="Enter Territory"/>
            
        <?php } ?> </div>
          <div class="row">
               <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <button type="submit" class="btn btn-success pull-right">Submit</button>
        </div>
          </div>
    
</form>
</div>