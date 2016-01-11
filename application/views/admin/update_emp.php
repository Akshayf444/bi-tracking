

    <?php echo form_open('admin/update_emp'); ?>

  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
           

        <?php
        if (!empty($rows)) {
            ?>

            <input type="hidden" class="form-control" value="<?php echo $rows['VEEVA_Employee_ID']; ?>" name="VEEVA_Employee_ID" />
             <div class="col-lg-4 ">
            First Name:  <input type="text" class="form-control" value="<?php echo $rows['First_Name']; ?>" name="First_Name" placeholder="Enter First Name"/> 
             </div>
     <div class="col-lg-4 ">
            Middle Name:<input type="text" class="form-control"value="<?php echo $rows['Middle_Name']; ?>" name="Middle_Name" placeholder="Enter Middle Name"/>
             </div>
     <div class="col-lg-4 ">
            Last Name:<input type="text" class="form-control"value="<?php echo $rows['Last_Name'] ?>" name="Last_Name" placeholder="Enter Last Name"/>
             </div>
     <div class="col-lg-4 ">
            Full Name:<input type="text" class="form-control"value="<?php echo $rows['Full_Name']; ?>" name="Full_Name" placeholder="Enter Full Name"/>
             </div>
     <div class="col-lg-4 ">
            Territory:<input type="text" class="form-control"value="<?php echo $rows['Territory']; ?>" name="Territory" placeholder="Enter Territory"/>
 </div>
     <div class="col-lg-4 ">


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
             </div>
     <div class="col-lg-4 ">
            Mobile:<input type="text" class="form-control"value="<?php echo $rows['Mobile']; ?>" name="Mobile" placeholder="Enter Mobile"/>
             </div>
     <div class="col-lg-4 ">
            Email_ID:<input type="text" class="form-control"value="<?php echo $rows['Email_ID']; ?>" name="Email_ID" placeholder="Enter Email_ID"/>
             </div>
     <div class="col-lg-4 ">
            Username:<input type="text" class="form-control"value="<?php echo $rows['Username']; ?>" name="Username" placeholder="Enter Username"/>
 </div>
     <div class="col-lg-4 ">
            Address_1:  <input type="text" class="form-control" value="<?php echo $rows['Address_1']; ?>" name="Address_1" placeholder="Enter Address_1"/>
             </div>
     <div class="col-lg-4 ">
            Address_2:  <input type="text" class="form-control" value="<?php echo $rows['Address_2']; ?>" name="Address_2" placeholder="Enter Address_2"/>
             </div>
     <div class="col-lg-4 ">
            City:  <input type="text" class="form-control" value="<?php echo $rows['City']; ?>" name="City" placeholder="Enter City"/>
             </div>
     <div class="col-lg-4 ">
            State:  <input type="text" class="form-control" value="<?php echo $rows['State']; ?>" name="State" placeholder="Enter  State"/>
             </div>
     <div class="col-lg-4 ">
            Division:  <input type="text" class="form-control" value="<?php echo $rows['Division']; ?>" name="Division" placeholder="Enter  Division"/>
             </div>
     <div class="col-lg-4 ">
            Product:  <input type="text" class="form-control" value="<?php echo $rows['Product']; ?>" name="Product" placeholder="Enter Product"/>
             </div>
     <div class="col-lg-4 ">
            Zone:<select  class="form-control" name="Zone" >
                <option value=" Select Zone">Select Zone</option>
                <?php echo $zone ?>
            </select> 
             </div>
     <div class="col-lg-4 ">
            Region:<select  class="form-control" name="Region" >
                <option value="Select Region">Select Region</option>
                <?php echo $region ?>
            </select>
             </div>
     <div class="col-lg-4 ">
            Profile:  <input type="text" class="form-control" value="<?php echo $rows['Profile']; ?>" name="Profile" placeholder="Enter  Profile"/>
             </div>
     <div class="col-lg-4 ">

            Designation:<select  class="form-control" name="Designation" >
                <option value="-1">Select Designation</option>
                <?php echo $Designation; ?>
            </select>   
 </div>
     <div class="col-lg-4 ">
            Date_of_Joining:  <input type="text" class="form-control" value="<?php echo $rows['Date_of_Joining']; ?>" id="datepicker2" name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>
 </div>
     <div class="col-lg-4 ">
            Reporting_To:  <input type="text" class="form-control" value="<?php echo $rows['Reporting_To']; ?>" name="Reporting_To" placeholder="Enter Reporting_To"/>
 </div>
     <div class="col-lg-4 ">
            Reporting_VEEVA_ID:<input type="text" class="form-control" value="<?php echo $rows['Reporting_VEEVA_ID']; ?>" name="Reporting_VEEVA_ID" placeholder="Enter Reporting_VEEVA_ID"/>
             </div>
     <div class="col-lg-4 ">
            Reporting_Local_ID:<input type="text" class="form-control" value="<?php echo $rows['Reporting_Local_ID']; ?>" name="Reporting_Local_ID" placeholder="Enter Reporting_Local_ID"/>
        <?php } ?>
     
     </div>
  </div>
     
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