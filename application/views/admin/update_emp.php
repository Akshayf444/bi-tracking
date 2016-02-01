

<?php echo form_open('admin/update_emp'); ?>

<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">

    <?php
    if (!empty($rows)) {
        ?>

        <input type="hidden" class="form-control" value="<?php echo $rows['VEEVA_Employee_ID']; ?>" name="VEEVA_Employee_ID" />
        <div class="col-lg-4">
        First Name:  <input type="text" class="form-control" value="<?php echo $rows['First_Name']; ?>" name="First_Name" placeholder="Enter First Name"/> 
        </div>
          <div class="col-lg-4">
        Middle Name:<input type="text" class="form-control"value="<?php echo $rows['Middle_Name']; ?>" name="Middle_Name" placeholder="Enter Middle Name"/>
         </div>
          <div class="col-lg-4">
        Last Name:<input type="text" class="form-control"value="<?php echo $rows['Last_Name'] ?>" name="Last_Name" placeholder="Enter Last Name"/>
         </div>
          <div class="col-lg-4">
        Full Name:<input type="text" class="form-control"value="<?php echo $rows['Full_Name']; ?>" name="Full_Name" placeholder="Enter Full Name"/>
 </div>
          <div class="col-lg-4">
        Territory:<select  class="form-control" name="Territory" >
            <option value=" Select Territory">Select Territory</option>
            <?php echo $Territory ?>
        </select> 
 </div>
          <div class="col-lg-4">

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
          <div class="col-lg-4">
        Mobile:<input type="text" class="form-control"value="<?php echo $rows['Mobile']; ?>" name="Mobile" placeholder="Enter Mobile"/>
         </div>
          <div class="col-lg-4">
        Email_ID:<input type="text" class="form-control"value="<?php echo $rows['Email_ID']; ?>" name="Email_ID" placeholder="Enter Email_ID"/>
         </div>
          <div class="col-lg-4">
        Username:<input type="text" class="form-control"value="<?php echo $rows['Username']; ?>" name="Username" placeholder="Enter Username"/>
 </div>
          <div class="col-lg-4">
        Address_1:  <input type="text" class="form-control" value="<?php echo $rows['Address_1']; ?>" name="Address_1" placeholder="Enter Address_1"/>
         </div>
          <div class="col-lg-4">
        Address_2:  <input type="text" class="form-control" value="<?php echo $rows['Address_2']; ?>" name="Address_2" placeholder="Enter Address_2"/>
         </div>
          <div class="col-lg-4">
        City:  <input type="text" class="form-control" value="<?php echo $rows['City']; ?>" name="City" placeholder="Enter City"/>
         </div>
          <div class="col-lg-4">
        State:  <input type="text" class="form-control" value="<?php echo $rows['State']; ?>" name="State" placeholder="Enter  State"/>
         </div>
          <div class="col-lg-4">
        Division:  <input type="text" class="form-control" value="<?php echo $rows['Division']; ?>" name="Division" placeholder="Enter  Division"/>
         </div>
          <div class="col-lg-4">
        Product:  <input type="text" class="form-control" value="<?php echo $rows['Product']; ?>" name="Product" placeholder="Enter Product"/>
         </div>
          <div class="col-lg-4">
        Zone:<select  class="form-control" name="Zone" >
            <option value=" Select Zone">Select Zone</option>
            <?php echo $zone ?>
        </select> 
         </div>
          <div class="col-lg-4">
        Region:<select  class="form-control" name="Region" >
            <option value="Select Region">Select Region</option>
            <?php echo $region ?>
        </select>
         </div>
          <div class="col-lg-4">
        Profile:  <input type="text" class="form-control" value="<?php echo $rows['Profile']; ?>" name="Profile" placeholder="Enter  Profile"/>
 </div>
          <div class="col-lg-4">
        Designation:<select  class="form-control" name="Designation" >
            <option value="-1">Select Designation</option>
            <?php echo $Designation; ?>
        </select>   
 </div>
          <div class="col-lg-4">
        Date_of_Joining:  <input type="text" class="form-control" value="<?php echo $rows['Date_of_Joining']; ?>" id="datepicker2" name="Date_of_Joining" placeholder="Enter Date_of_Joining"/>
 <?php echo form_open('admin/get_record'); ?>
        </div>
          <div class="col-lg-4">
        Reporting_To: <select  class="form-control" id="country" name="Territory" >
            <option value=" Select Reporting_To">Select Reporting_To </option>
            <?php echo $Reporting_To; ?>
        </select> 
        </div>
          <div class="col-lg-4">
       
        Reporting_VEEVA_ID:<input type="text" class="form-control" value="<?php // echo $shows->Reporting_VEEVA_ID;  ?>" id="cities" name="Reporting_VEEVA_ID" placeholder="Enter Reporting_VEEVA_ID"/>
 </div>
          <div class="col-lg-4">
        Reporting_Local_ID:<input type="text" class="form-control" value="<?php // echo $shows->Reporting_Local_ID; ?>" name="Reporting_Local_ID" placeholder="Enter Reporting_Local_ID"/>
     </div>
         
            <?php } 
    
    
     ?>


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

  
   
        
        
        
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript">// <![CDATA[
 $(document).ready(function(){
 $('#country').change(function(){ //any select change on the dropdown with id country trigger this code
 $("#cities > option").remove(); //first of all clear select items
 var country_id = $('#country').val(); // here we are taking country id of the selected one.
 $.ajax({
 type: "POST",
 url: "<?php base_url() ?>admin/get_record",+country_id, //here we are calling our user controller and get_cities method with the country_id
 
 success: function(cities) //we're calling the response json array 'cities'
 {
 $.each(cities,function(id,city) //here we're doing a foeach loop round each city with id as the key and city as the value
 {
 var opt = $('<option />'); // here we're creating a new select option with for each city
 opt.val(id);
 opt.text(city);
 $('#cities').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
 });
 }
 
 });
 
 });
 });
 // ]]>
</script>
  