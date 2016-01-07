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
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Activity Planning</div>
        <div class="panel-body">            
            <table class="table table-bordered">
                <tr>
                    <td>Doctor Name</td>
                    <td>Activity</td>
                </tr>

                    <?php
                    if (isset($doctorList) && !empty($doctorList)) {
                        foreach ($doctorList as $doctor) {
                            ?>
                        <tr>
                            <td><?php echo $doctor->Account_Name ?></td>
                            <td><?php
                                if (isset($ActivityList) && !empty($ActivityList)) {

                                    foreach ($ActivityList as $Activity) {
                                        ?>
                                        <input type="checkbox"> <?php echo $Activity->Activity_Name ?>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>

            </table>

            <!--            <b>Select Doctor</b>
            
            
                        <select class="form-control" name="Doctor_Id" onchange="sendRequest(this.value)">     
                            <option>Select Doctor</option>
<?php //echo isset($doctorList) ? $doctorList : '';    ?>
                        </select>
            
                        </li>
                        <li class="table-view-cell"><b>Select Activity</b></li>
            
                        <li class="table-view-cell">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Doctor Details</th>
                                    <th>Activity</th>
                                </tr>
                                <tr>
                                    <td>Abc</td>
                                    <td><input type="checkbox" name="one"/> Activity 1<br>
                                        <input type="checkbox" name="one"/>   Activity 2
                                <li id="result"></li>
                                </td>
                                </tr>
                            </table>
                        </li>-->
        </div>
        <div class="panel-footer">
            <button type="submit" style="    margin-right: 77px;" class="btn btn-primary">Save</button>
            <button type="submit" class="btn btn-positive">Submit</button>
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