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
        padding: 3px 11px 5px 13px;
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
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Activity Planning</li>
        <li class="table-view-cell">
            <b>Select Doctor</b>


            <select class="form-control" name="Doctor_Id" onchange="sendRequest(this.value)">     
                <option>Select Doctor</option>
                <?php echo isset($doctorList) ? $doctorList : ''; ?>
            </select>

        </li>
        <li class="table-view-cell"><b>Select Activity</b></li>
        <li id="result"></li>
        <li class="table-view-cell">
            <br/>
            <button type="submit" class="btn btn-positive">Submit</button>
            <br/>
        </li>
    </ul>
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