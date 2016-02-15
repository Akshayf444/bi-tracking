
<?php
$attribute = array('id' => 'valid');
echo form_open('admin/emp_add', $attribute);
?>

<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">

    <div class="col-lg-4">
        VEEVA_Employee_ID:  <input type="text" class="form-control" value="" name="VEEVA_Employee_ID" placeholder="Enter VEEVA_Employee_ID" />
    </div>
    <div class="col-lg-4">
        Local_Employee_ID: <input type="text" class="form-control" value="" name="Local_Employee_ID" placeholder="Enter Local_Employee_ID" /> </div>
    <div class="col-lg-4">
        First Name:  <input type="text" class="form-control" value="" name="First_Name" placeholder="Enter First Name"/> </div>
    <div class="col-lg-4">
        Middle Name:<input type="text" class="form-control" value="" name="Middle_Name" placeholder="Enter Middle Name"/> </div>
    <div class="col-lg-4">
        Last Name:<input type="text" class="form-control" value="" name="Last_Name" placeholder="Enter Last Name"/> </div>
    <div class="col-lg-4">
        Full Name:<input type="text" class="form-control" value="" name="Full_Name" placeholder="Enter Full Name"/> </div>
    <div class="col-lg-4">
        Territory:<select  class="form-control" name="Territory" >
            <option value="-1">Select  Territory</option>
            <?php echo $Territory; ?>
        </select>    </div>
    <div class="col-lg-4">
        Gender:<select name="Gender"  class="form-control" placeholder="Enter Gender">
            <option>select</option>
            <option>Male</option>
            <option>Female</option>
        </select> </div>
    <div class="col-lg-4">
        Mobile:<input type="text" class="form-control" value="" name="Mobile" placeholder="Enter Mobile"/> </div>
    <div class="col-lg-4">
        Email_ID:<input type="text" class="form-control" value="" id="email" name="Email_ID" placeholder="Enter Email_ID"/> </div>
    
    <div class="col-lg-4">

        Address_1:  <input type="text" class="form-control" value="" name="Address_1" placeholder="Enter Address_1"/> </div>
    <div class="col-lg-4">
        Address_2:  <input type="text" class="form-control" value="" name="Address_2" placeholder="Enter Address_2"/> </div>
    <div class="col-lg-4">
        City:  <input type="text" class="form-control" value="" name="City" placeholder="Enter City"/> </div>
    <div class="col-lg-4">
        State:  <input type="text" class="form-control" value="" name="State" placeholder="Enter State"/> </div>
    <div class="col-lg-4">
        Division:<select  class="form-control" name="Division" >
            <option value="-1">Select  Division</option>
            <?php echo $Division; ?>
        </select>    </div>
    <div class="col-lg-4">

        Zone:<select  class="form-control" name="Zone" >
            <option value="-1">Select Zone</option>
            <?php echo $zone ?>
        </select>  </div>
    <div class="col-lg-4">
        Region:<select  class="form-control" name="Region" >
            <option value="-1">Select Region</option>
            <?php echo $region ?>
        </select>  </div>

    <div class="col-lg-4">
        Designation:<select  class="form-control" name="Designation" >
            <option value="-1">Select Designation</option>
            <?php echo $Designation; ?>
        </select>    </div>
    <div class="col-lg-4">

        Date_of_Joining:  <input type="text" class="form-control" value=""  id="datepicker1"name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>
    </div>

    <div class="col-lg-4">
        Profile:<select  class="form-control" name="Profile" id="profile" >
            <option value="-1">Select  Profile</option>
            <?php echo $Profile ?>
        </select>  </div>
    <div class="col-lg-4">
        Reporting_To :<select  class="form-control" name="Reporting_To" id="reporting_to" >
            <option value="-1">Select Reporting_To</option>

        </select>  </div>


    <div class="row">

        <button class="btn btn-lg btn-success pull-right">Submit</button>
    </div>
</div>
</form>
<script>
    $(function () {

        $("#datepicker1").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });


</script>
<script type="text/javascript">
    $('#profile').change(function () {
        var profile = $(this).val();
        $.ajax({
            url: '<?php echo site_url('admin/ajax_data') ?>',
            data: {profile: profile},
            type: 'POST',
            success: function (data) {
                $('#reporting_to').html(data);    //please note this, here we're focusing in that input field
            }
        });
    });

    $('#email').change(function () {
        $("#username").val($(this).val());
        //please note this, here we're focusing in that input field

    });


</script>
<script src="<?php echo asset_url() ?>js/formValidation.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
<script>
    $('document').ready(function () {
        $('#valid').formValidation({
              
                    icon: {
                    },
            fields: {
                VEEVA_Employee_ID: {
                    validators: {
                        notEmpty: {
                            message: 'The VEEVA_Employee_ID is required'
                        }
                    }
                },
                   Local_Employee_ID: {
                    validators: {
                        notEmpty: {
                            message: 'The Local_Employee_ID is required'
                        }
                    }
                },
                 First_Name: {
                    validators: {
                        notEmpty: {
                            message: 'The  First_Name is required'
                        }
                    }
                },     Middle_Name: {
                    validators: {
                        notEmpty: {
                            message: 'The Middle_Name is required'
                        }
                    }
                },  
               Last_Name: {
                    validators: {
                        notEmpty: {
                            message: 'The Last_Name is required'
                        }
                    }
                }, 
                Full_Name: {
                    validators: {
                        notEmpty: {
                            message: 'The Full_Name is required'
                        }
                    }
                },
               
                Territory: {
                    validators: {
                        notEmpty: {
                            message: 'The Territory is required'
                        }
        }
                },
                 Gender: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        }
                    }
                }, 
                Mobile: {
                    validators: {
                        notEmpty: {
                            message: 'The Mobile is required'
                        }
                    }
                }, 
                 Email_ID: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        }
                    }
                },
                
                
                
               
                 Address_1: {
                    validators: {
                        notEmpty: {
                            message: 'The  Address_1 is required'
                        }
                    }
                }, 
                Address_2: {
                    validators: {
                        notEmpty: {
                            message: 'The  Address_2 is required'
                        }
                    }
                },
                City: {
                    validators: {
                        notEmpty: {
                            message: 'The  City is required'
                        }
                    }
                },
                State: {
                    validators: {
                        notEmpty: {
                            message: 'The State is required'
                        }
                    }
                },
                Division: {
                    validators: {
                        notEmpty: {
                            message: 'The  Division is required'
                        }
                    }
                },
                Zone: {
                    validators: {
                        notEmpty: {
                            message: 'The Zone is required'
                        }
                    }
                },
                Region: {
                    validators: {
                        notEmpty: {
                            message: 'The  Region is required'
                        }
                    }
                },
                Designation: {
                    validators: {
                        notEmpty: {
                            message: 'The  Designation is required'
                        }
                    }
                },
             
                Profile: {
                    validators: {
                        notEmpty: {
                            message: 'The Profile is required'
                        }
                    }
                },
                  Reporting_To: {
                    validators: {
                        notEmpty: {
                            message: 'The  Reporting_To is required'
                        }
                    }
                },
             
            }

        });
    });
</script>


