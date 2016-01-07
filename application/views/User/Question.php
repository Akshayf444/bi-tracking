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
<script src="<?php echo asset_url(); ?>js/formValidation.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<?php
$attributes = array('id' => 'form1', 'name' => 'myform', 'onsubmit' => 'return validateform()');
echo validation_errors();
echo form_open('User/Profiling', $attributes);
?>
<div class="col-lg-12 col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">Profiling</div>
        <div class="panel-body">
            <div class="form-group">
                Select Doctor
                <select class="form-control" name="Doctor_id" id="Doctor_id" title="Please select something!">
                    <option value="">Please Select</option>
                    <?php echo $doctorList; ?>        
                </select> 
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
            <button type="submit" name="Save1" class="btn btn-primary">Save</button>
            <button type="submit" name="Save" class="btn btn-positive">Submit</button>
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



</script>
<script>
    $('document').ready(function () {
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
                Patient_Seen: {
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

</script>