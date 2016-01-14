<link href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="Stylesheet" type="text/css">
<!--<script src="<?php echo asset_url(); ?>js/jquery-1.11.0.js" type="text/javascript"></script>-->
<script src="<?php echo asset_url(); ?>js/jquery.dataTables.min.js" type="text/javascript"></script>
<?php echo form_open('User/Priority'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Set Priority</div>
        <div class="panel-body">
            <?php echo isset($doctorList) ? $doctorList : '' ?>
            <input type="hidden" id="Status" name="Status" value="Draft">
            <div class="panel-footer">    
                <button type="submit" id="Save" class="btn btn-primary">Save</button>
                <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
            </div>
        </div>
    </div>
</div>
</form>
<style>
    #datatable_filter{
        display: none;
    }
    table.dataTable tbody tr {
        background-color: transparent;
    }
</style>
<script>
    var oTable = $('#datatable').dataTable({
        "bPaginate": false,
        "bInfo": false,
        "info": false,
        "columnDefs": [
            {
                "targets": [7],
                "visible": false
            }
        ]
    });

    $("#Submit").click(function () {
        $("#Status").val('Submitted');

    });

</script>