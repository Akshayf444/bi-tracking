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
<?php echo form_open('User/ActivityPlanning'); ?>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Activity Planning</li>
        <li class="table-view-cell">
            <b>Select Doctor</b>
            <select class="form-control" name="Doctor_Id">     
                <option>Select Doctor</option>
                <?php echo isset($doctorList) ? $doctorList : ''; ?>
            </select>
        </li>
        <li class="table-view-cell"><b>Select Activity</b></li>

        <?php
        if (isset($ActiviyList) && !empty($ActiviyList)) {
            foreach ($ActiviyList as $Activity) {
                ?>

                <li class="table-view-cell">
                    <div class="col-xs-4"><?php echo $Activity->Activity_Name; ?></div>
                    <div class="col-xs-8">
                        <div class="toggle">
                            <label><input type="radio" name="<?php echo $Activity->Activity_id; ?>" value="Yes"><span id="<?php echo $Activity->Activity_id . "-1"; ?>">Yes</span></label>    
                        </div>
                        <div class="toggle">
                            <label><input type="radio" name="<?php echo $Activity->Activity_id; ?>" value="No"><span id="<?php echo $Activity->Activity_id . "-2"; ?>" >No</span></label>
                        </div>
                    </div>
                    <div id="<?php echo "heading" . $Activity->Activity_id; ?>" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name="<?php echo $Activity->Activity_id . 'Detail'; ?>" placeholder="Activity Details"></textarea> </div> 
                        </div> 
                    </div>
                    <div id="<?php echo "reason" . $Activity->Activity_id; ?>" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name="<?php echo $Activity->Activity_id . 'Reason'; ?>" placeholder="Reason"></textarea> </div> 
                        </div> 
                    </div>
                </li>
                <?php
            }
        }
        ?>


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
</script>