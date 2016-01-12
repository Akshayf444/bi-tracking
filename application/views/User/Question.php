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

    .btn-default {
        background: none;
        border: none;
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
<script src="<?php echo asset_url(); ?>js/formValidation.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
<link href="<?php echo asset_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<?php
$attributes = array('id' => 'form1', 'name' => 'myform');
echo validation_errors();
echo form_open('User/Profiling', $attributes);
?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Profiling<span class="pull-left"><img id="loader" src="<?php echo asset_url() ?>/images/loader.gif" style="display: none"></span></div>
        <div class="panel-body">
            <div class="form-group">
                <?php
                if (isset($Product_Id) && $Product_Id == 1) {
                    echo 'Select Hospital';
                } else {
                    echo 'Select Doctor';
                }
                ?>

                <select class="form-control" name="Doctor_id" id="Doctor_id" title="Please select something!">
                    <option value="">Please Select</option>
                    <?php echo $doctorList; ?>        
                </select> 
                <input type="hidden" id="Status" name="Status" value="Draft">
            </div>

            <?php
            if (isset($questionList) && !empty($questionList)) {
                foreach ($questionList as $Question) {
                    ?>
                    <div class="form-group">
                        <?php echo $Question->Question ?>
                        <?php echo $Question->name ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="panel-footer">
            <button type="submit" id="Save" class="btn btn-primary">Save</button>
            <button type="submit" id="Submit" class="btn btn-positive">Submit</button>
        </div>
    </div>
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
    $(function () {
        $(".next-month").html('in ' + monthname);
    });
    $("input[name='Patient_Seen']").keyup(function () {
        $("input[name='Patient_Seen_month']").val($(this).val() * 4);
    });

    $(".spaf1").change(function () {

        if ($(this).val() == 'SPAF') {
            $('.spaf').html('SPAF');
        } else if ($(this).val() == 'DVT-PE') {
            $('.spaf').html('DVT-PE');
        } else if ($(this).val() == 'pVTEp') {
            $('.spaf').html('pVTEp');
        }
    });

</script>
<script>
    $('document').ready(function () {
        var seen = parseFloat($('#seen').val());
        $('#form1').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                Win_Q1: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Win_Q2: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Win_Q3: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Patient_Seen_month: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Patient_Rxbed_In_Week: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Doctor_id: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                },
                Patient_Rxbed_In_Month: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
//                        lessThan: {
//                        value: parseFloat(seen),
//                        message: 'The value must be less than or equal to Patient Seen month'
//                    }
                    }
                },
                No_of_Beds: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Value'
                        },
                    }
                }

            }
        });
    });

    $("#Doctor_id").change(function () {
        $('#loader').show();
        $.ajax({
            type: 'POST',
            data: {'Doctor_Id': $(this).val()},
            url: '<?php echo site_url('User/getProfilingData'); ?>',
            success: function (data) {
                //alert(data);
                if (data != '404') {
                    var obj = jQuery.parseJSON(data);
                    $("input[name='Patient_Seen']").val(obj.Patient_Seen);
                    $("input[name='Patient_Seen_month']").val(obj.Patient_Seen_month);
                    $("input[name='Patient_Rxbed_In_Month']").val(obj.Patient_Rxbed_In_Month);
                    $("input[name='Patient_Rxbed_In_Week']").val(obj.Patient_Rxbed_In_Week);
                    $("input[name='No_Of_Beds']").val(obj.No_Of_Beds);

                    if (obj.CT_MRI_available == 'Yes') {
                        $("#CT_MRI_available_yes").prop('checked', true);
                    } else if (obj.CT_MRI_available == 'No') {
                        $("#CT_MRI_available_no").prop('checked', true);
                    }

                    if (obj.Win_Q1 == 'Yes') {
                        $("#Win_Q1_yes").prop('checked', true);
                    } else if (obj.Win_Q1 == 'No') {
                        $("#Win_Q1_no").prop('checked', true);
                    }
                    if (obj.Win_Q2 == 'Yes') {
                        $("#Win_Q2_yes").prop('checked', true);
                    } else if (obj.Win_Q2 == 'No') {
                        $("#Win_Q2_no").prop('checked', true);
                    }
                    if (obj.Win_Q3 == 'Yes') {
                        $("#Win_Q3_yes").prop('checked', true);
                    } else if (obj.Win_Q3 == 'No') {
                        $("#Win_Q3_no").prop('checked', true);
                    }

                    $("input[name='Primary_indication']").each(function () {
                        if ($(this).val() == obj.Primary_indication) {
                            $(this).attr("selected", "selected");
                        }
                    });
                } else {
                    $("input[name='Patient_Seen']").val('');
                    $("input[name='Patient_Seen_month']").val('');
                    $("input[name='Patient_Rxbed_In_Month']").val('');
                    $("input[name='Patient_Rxbed_In_Week']").val('');
                    $("input[name='No_Of_Beds']").val('');

                    $("#CT_MRI_available_yes").prop('checked', false);
                    $("#CT_MRI_available_no").prop('checked', false);
                    $("#Win_Q1_yes").prop('checked', false);
                    $("#Win_Q1_no").prop('checked', false);
                    $("#Win_Q2_yes").prop('checked', false);
                    $("#Win_Q2_no").prop('checked', false);
                    $("#Win_Q3_yes").prop('checked', false);
                    $("#Win_Q3_no").prop('checked', false);

                    $("input[name='Primary_indication']").each(function () {
                        if ($(this).val() == obj.Primary_indication) {
                            //$(this).attr("selected", "selected");
                        }
                    });
                }

                $('#loader').hide();
            }
        });

    });

    $("#Submit").click(function () {
        $("#Status").val('Submitted');
    });
</script>