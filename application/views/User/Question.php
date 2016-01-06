<style>
    .table-view .table-view-cell {
        background-position: 0px 100%;
    }
    .col-xs-9, .col-xs-3{
        padding: 0px;
    }
    .table-view-cell {
        padding: 11px 12px 11px 15px;
    }
    .label {
        width:100px;
        text-align:right;
        float:left;
        padding-right:10px;
        font-weight:bold;
    }
    #register-form label.error {
        color:#FB3A3A;
        font-weight:bold;
    }
    h1 {
        font-family: Helvetica;
        font-weight: 100;
        color:#333;
        padding-bottom:20px;
    }
</style>
<script>
    function validateform() {
        var Doctor_id = document.myform.name.value;

        if (Doctor_id == 'Please Select') {
            alert("Please Select Doctor");
            return false;
        }
    }
</script>
<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">

<?php
$attributes = array('id' => 'activate', 'name' => 'myform', 'onsubmit' => 'return validateform()');
echo validation_errors();
echo form_open('User/Profiling', $attributes);
?>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell table-view-divider">Profiling</li>

        <li class="table-view-cell">
            Select Doctor
            <select class="form-control" name="Doctor_id" id="Doctor_id" title="Please select something!">
                <option value="Please Select">Please Select</option>
                <?php echo $doctorList; ?>        
            </select> 
        </li>
        <?php
        if (isset($questionList) && !empty($questionList)) {
            foreach ($questionList as $Question) {
                ?>
                <li class="table-view-cell">
                    <?php echo $Question->Question ?>
                    <?php echo $Question->name ?>
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
    $("#product").change(function () {

        if ($(this).val() == 'Actilyse') {
            $('#span1').html('Stroke/AIS');
            $('#span2').html('-');
        } else if ($(this).val() == 'Pradaxa') {
            $('#span1').html('SPAF');
            $('#span2').html('NOAC');
        } else if ($(this).val() == 'Trajenta') {
            $('#span1').html('Diabetes');
            $('#span2').html('DPP4');
        }
    });
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var currentDate = new Date();
    var nextMonthDate = new Date(currentDate.getYear(), currentDate.getMonth());
    var monthname = months[parseInt(nextMonthDate.getMonth(), 10)]

    $(function () {
        $(".next-month").html('in ' + monthname);
    });
    $("input[name='Patient_Rxbed_In_Week']").keyup(function () {
        $("input[name='Patient_Rxbed_In_Month']").val($(this).val() * 4);
    });



</script>