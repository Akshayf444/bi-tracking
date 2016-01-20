<style>
    label{
        margin-bottom: 0px;
    }

    .toggle {
        margin:4px;
        background-color:#EFEFEF;
        border-radius:20px;
        border:1px solid #EFEFEF;
        overflow:auto;
        float:left;

    }

    .toggle label {
        float:left;
        //width:2.0em;

    }

    .toggle label span {
        text-align: center;
        padding: 0px 11px 5px 13px;
        display: block;
        cursor: pointer;
        overflow: hidden;
    }

    .toggle label input {
        visibility: hidden;
        position:absolute;
        top:-20px;
    }

    .toggle .input-checked {
        background-color:#000;
        color:red;
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
    }
</style>
<script src="<?php echo asset_url(); ?>js/bootstrap.min_1.js" type="text/javascript"></script>
<?php echo form_open('User/ActivityReporting'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Activity Reporting</div>
        <div class="panel-body">   
            <?php echo isset($doctorList) && !empty($doctorList) ? $doctorList : '<h1>No Activity Planned</h1>'; ?>

            <input type="hidden" id="Status" name="Status" value="Draft">
            <input type="hidden" id="Approve_Status" name="Approve_Status" value="">
        </div>
        <?php if (isset($doctorList) && $doctorList != '') { ?>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
                <button type="submit" id="Approve_Status" class="btn btn-negative">Save For Approval</button>
            </div>
        <?php } ?>
    </div>
</div>
</form>
<script>
    $('label').click(function () {
        $(this).children('span').addClass('input-checked');
        $(this).parent('.toggle').siblings('.toggle').children('label').children('span').removeClass('input-checked');

        var id = $(this).children('span').attr('id').split("-");
        id = id[0];

        if ($(this).children('span').text() === 'Yes') {
            $("#heading" + id).show();
            $("#act" + id).attr('required', true);
            $("#reason" + id).hide();
            $("#res" + id).attr('required', false);
        } else if ($(this).children('span').text() === 'No') {
            $("#heading" + id).hide();
            $("#res" + id).attr('required', true);
            $("#reason" + id).show();
            $("#act" + id).attr('required', false);
        }
    });

    $("#Submit").click(function () {
        $("#Status").val('Submitted');
        //$("#form1").submit();
    });

</script>