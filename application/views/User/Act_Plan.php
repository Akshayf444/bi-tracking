<?php echo form_open('User/ActivityPlanning'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Activity Planning</div>
        <div class="panel-body">   
            <?php echo isset($doctorList) && !empty($doctorList) ? $doctorList : ''; ?>
            <input type="hidden" id="Status" name="Status" value="Draft">
        </div>
        <div class="panel-footer">
            <?php if (isset($doctorList) && !empty($doctorList)) { ?>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
            <?php } else {
                
            }
            ?>
        </div>
    </div>
</div>
</form>
<script>
    $("#Submit").click(function () {
        $("#Status").val('Submitted');
        //$("#form1").submit();
    });
</script>