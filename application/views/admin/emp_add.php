<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Add Employee </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php echo form_open('admin/emp_add'); ?>

<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    VEEVA_Employee_ID:  <input type="text" class="form-control" value="" name="VEEVA_Employee_ID" placeholder="Enter VEEVA_Employee_ID" />
    Local_Employee_ID: <input type="text" class="form-control" value="" name="Local_Employee_ID" placeholder="Enter Local_Employee_ID" />
    First Name:  <input type="text" class="form-control" value="" name="First_Name" placeholder="Enter First Name"/>
    Middle Name:<input type="text" class="form-control" value="" name="Middle_Name" placeholder="Enter Middle Name"/>
    Last Name:<input type="text" class="form-control" value="" name="Last_Name" placeholder="Enter Last Name"/>
    Full Name:<input type="text" class="form-control" value="" name="Full_Name" placeholder="Enter Full Name"/>
    Territory:<input type="text" class="form-control" value="" name="Territory" placeholder="Enter Territory"/>
    Gender:<select name="Gender"  class="form-control" placeholder="Enter Gender">
        <option>select</option>
        <option>Male</option>
        <option>Female</option>
    </select>
    Mobile:<input type="text" class="form-control" value="" name="Mobile" placeholder="Enter Mobile"/>
    Email_ID:<input type="text" class="form-control" value=""  name="Email_ID" placeholder="Enter Email_ID"/>
    Username:<input type="text" class="form-control" value="" name="Username" placeholder="Enter Username"  />

    Address_1:  <input type="text" class="form-control" value="" name="Address_1" placeholder="Enter Address_1"/>
    Address_2:  <input type="text" class="form-control" value="" name=" Address_2" placeholder="Enter Address_2"/>
    City:  <input type="text" class="form-control" value="" name="City" placeholder="Enter City"/>
    State:  <input type="text" class="form-control" value="" name="State" placeholder="Enter State"/>
    Division:  <input type="text" class="form-control" value="" name="Division" placeholder="Enter Division"/>
    Product:  <input type="text" class="form-control" value="" name="Product" placeholder="Enter Product"/>

    Zone:<select  class="form-control" name="Zone" >
        <option value="-1">Select Zone</option>
        <?php echo $zone ?>
    </select> 
    Region:<select  class="form-control" name="Region" >
        <option value="-1">Select Region</option>
        <?php echo $region ?>
    </select> 

    Profile:  <input type="text" class="form-control" value="" name="Profile" placeholder="Enter  Profile"/>
    Designation:<select  class="form-control" name="Designation" >
        <option value="-1">Select Designation</option>
        <?php echo $Designation; ?>
    </select>   

    Date_of_Joining:  <input type="text" class="form-control" value=""  id="datepicker1"name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>

    Reporting_To:  <input type="text" class="form-control" value="" name=" Reporting_To" placeholder="Enter Reporting_To"/>
    Reporting_VEEVA_ID:<input type="text" class="form-control" value="" name="  Reporting_VEEVA_ID" placeholder="Enter Reporting_VEEVA_ID"/>
    Reporting_Local_ID:<input type="text" class="form-control" value="" name="  Reporting_Local_ID" placeholder="Enter Reporting_Local_ID"/>




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