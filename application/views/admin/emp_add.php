

<?php echo form_open('admin/emp_add'); ?>

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
    Territory:<input type="text" class="form-control" value="" name="Territory" placeholder="Enter Territory"/> </div>
          <div class="col-lg-4">
    Gender:<select name="Gender"  class="form-control" placeholder="Enter Gender">
        <option>select</option>
        <option>Male</option>
        <option>Female</option>
    </select> </div>
          <div class="col-lg-4">
    Mobile:<input type="text" class="form-control" value="" name="Mobile" placeholder="Enter Mobile"/> </div>
          <div class="col-lg-4">
    Email_ID:<input type="text" class="form-control" value=""  name="Email_ID" placeholder="Enter Email_ID"/> </div>
          <div class="col-lg-4">
    Username:<input type="text" class="form-control" value="" name="Username" placeholder="Enter Username"  /> </div>
          <div class="col-lg-4">

    Address_1:  <input type="text" class="form-control" value="" name="Address_1" placeholder="Enter Address_1"/> </div>
          <div class="col-lg-4">
    Address_2:  <input type="text" class="form-control" value="" name=" Address_2" placeholder="Enter Address_2"/> </div>
          <div class="col-lg-4">
    City:  <input type="text" class="form-control" value="" name="City" placeholder="Enter City"/> </div>
          <div class="col-lg-4">
    State:  <input type="text" class="form-control" value="" name="State" placeholder="Enter State"/> </div>
          <div class="col-lg-4">
    Division:  <input type="text" class="form-control" value="" name="Division" placeholder="Enter Division"/> </div>
          <div class="col-lg-4">
    Product:  <input type="text" class="form-control" value="" name="Product" placeholder="Enter Product"/> </div>
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

    Profile:  <input type="text" class="form-control" value="" name="Profile" placeholder="Enter  Profile"/> </div>
          <div class="col-lg-4">
    Designation:<select  class="form-control" name="Designation" >
        <option value="-1">Select Designation</option>
        <?php echo $Designation; ?>
    </select>    </div>
          <div class="col-lg-4">

    Date_of_Joining:  <input type="text" class="form-control" value=""  id="datepicker1"name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>
 </div>
          <div class="col-lg-4">
    Reporting_To:  <input type="text" class="form-control" value="" name=" Reporting_To" placeholder="Enter Reporting_To"/> </div>
          <div class="col-lg-4">
    Reporting_VEEVA_ID:<input type="text" class="form-control" value="" name="  Reporting_VEEVA_ID" placeholder="Enter Reporting_VEEVA_ID"/> </div>
          <div class="col-lg-4">
    Reporting_Local_ID:<input type="text" class="form-control" value="" name="  Reporting_Local_ID" placeholder="Enter Reporting_Local_ID"/> </div>
        




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