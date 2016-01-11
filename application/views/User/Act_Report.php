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
<?php echo form_open('User/ActivityReporting'); ?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Activity Reporting</div>
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
    $('label').click(function () {
        $(this).children('span').addClass('input-checked');
        $(this).parent('.toggle').siblings('.toggle').children('label').children('span').removeClass('input-checked');

        var id = $(this).children('span').attr('id').split("-");
        id = id[0];

        if ($(this).children('span').text() === 'Yes') {
            $("#heading" + id).show();
            $("#reason" + id).hide();
        } else if ($(this).children('span').text() === 'No') {
            $("#heading" + id).hide();
            $("#reason" + id).show();
        }
    });
//
//    function sendRequest(Doctor_ID) {
//        alert(Doctor_ID);
//        $.ajax({
//            type: 'get',
//            data: {'Doctor_Id': Doctor_ID},
//            url: '<?php echo site_url('User/getActivityDetails'); ?>',
//            success: function (data) {
//                console.log(data);
//                $('#result').append(data);
//            }
//        });
//    }
//

</script>