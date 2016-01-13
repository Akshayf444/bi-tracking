<?php echo form_open('User/ActivityPlanning'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Activity Planning</div>
        <div class="panel-body">   
            <?php echo isset($doctorList) && !empty($doctorList) ? $doctorList : ''; ?>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-positive">Submit</button>
        </div>
    </div>
</div>
</form>
<script>
    function sendRequest(Doctor_ID) {
        alert(Doctor_ID);
        $.ajax({
            type: 'get',
            data: {'Doctor_Id': Doctor_ID},
            url: '<?php echo site_url('User/getActivityDetails'); ?>',
            success: function (data) {
                console.log(data);
                $('#result').append(data);
            }
        });
    }

</script>