<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Update Employee </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

    <?php echo form_open('admin/update_emp'); ?>

     <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">

        <?php
        if (!empty($rows)) {
            ?>

            <input type="hidden" class="form-control" value="<?php echo $rows['VEEVA_Employee_ID']; ?>" name="VEEVA_Employee_ID" />
            First Name:  <input type="text" class="form-control" value="<?php echo $rows['First_Name']; ?>" name="First_Name" placeholder="Enter First Name"/> 
            Middle Name:<input type="text" class="form-control"value="<?php echo $rows['Middle_Name']; ?>" name="Middle_Name" placeholder="Enter Middle Name"/>
            Last Name:<input type="text" class="form-control"value="<?php echo $rows['Last_Name'] ?>" name="Last_Name" placeholder="Enter Last Name"/>
            Full Name:<input type="text" class="form-control"value="<?php echo $rows['Full_Name']; ?>" name="Full_Name" placeholder="Enter Full Name"/>
            Territory:<input type="text" class="form-control"value="<?php echo $rows['Territory']; ?>" name="Territory" placeholder="Enter Territory"/>



            Gender:<select name="Gender" class="form-control" >
                <option value="Female" <?php
                if ($rows['Gender'] == 'Female') {
                    echo 'selected';
                }
                ?>>Female</option>


                <option value="Male" <?php
                if ($rows['Gender'] == 'Male') {
                    echo 'selected';
                }
                ?>>Male</option>
            </select>
            Mobile:<input type="text" class="form-control"value="<?php echo $rows['Mobile']; ?>" name="Mobile" placeholder="Enter Mobile"/>
            Email_ID:<input type="text" class="form-control"value="<?php echo $rows['Email_ID']; ?>" name="Email_ID" placeholder="Enter Email_ID"/>
            Username:<input type="text" class="form-control"value="<?php echo $rows['Username']; ?>" name="Username" placeholder="Enter Username"/>

            Address_1:  <input type="text" class="form-control" value="<?php echo $rows['Address_1']; ?>" name="Address_1" placeholder="Enter Address_1"/>
            Address_2:  <input type="text" class="form-control" value="<?php echo $rows['Address_2']; ?>" name="Address_2" placeholder="Enter Address_2"/>
            City:  <input type="text" class="form-control" value="<?php echo $rows['City']; ?>" name="City" placeholder="Enter City"/>
            State:  <input type="text" class="form-control" value="<?php echo $rows['State']; ?>" name="State" placeholder="Enter  State"/>
            Division:  <input type="text" class="form-control" value="<?php echo $rows['Division']; ?>" name="Division" placeholder="Enter  Division"/>
            Product:  <input type="text" class="form-control" value="<?php echo $rows['Product']; ?>" name="Product" placeholder="Enter Product"/>
            Zone:<select  class="form-control" name="Zone" >
                <option value=" Select Zone">Select Zone</option>
                <?php echo $zone ?>
            </select> 
            Region:<select  class="form-control" name="Region" >
                <option value="Select Region">Select Region</option>
                <?php echo $region ?>
            </select>
            Profile:  <input type="text" class="form-control" value="<?php echo $rows['Profile']; ?>" name="Profile" placeholder="Enter  Profile"/>

            Designation:<select  class="form-control" name="Designation" >
                <option value="-1">Select Designation</option>
                <?php echo $Designation; ?>
            </select>   

            Date_of_Joining:  <input type="text" class="form-control" value="<?php echo $rows['Date_of_Joining']; ?>" id="datepicker2" name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>

            Reporting_To:  <input type="text" class="form-control" value="<?php echo $rows['Reporting_To']; ?>" name="Reporting_To" placeholder="Enter Reporting_To"/>

            Reporting_VEEVA_ID:<input type="text" class="form-control" value="<?php echo $rows['Reporting_VEEVA_ID']; ?>" name="Reporting_VEEVA_ID" placeholder="Enter Reporting_VEEVA_ID"/>
            Reporting_Local_ID:<input type="text" class="form-control" value="<?php echo $rows['Reporting_Local_ID']; ?>" name="Reporting_Local_ID" placeholder="Enter Reporting_Local_ID"/>
        <?php } ?>
     
    
           <div class="row">
        <button class="btn btn-lg btn-success pull-right">Submit</button>
        </div>
</div>

</form>
<script>
    $(function () {
        $("#datepicker").datepicker();
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
    });


</script>