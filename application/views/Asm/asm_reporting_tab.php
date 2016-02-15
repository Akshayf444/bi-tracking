<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body ">
            <?php echo form_open('ASM/reporting_info'); ?>
            <div class="col-sm-2 col-md-2"  >
                <select name="id" class="form-control">
                    <option value="-1">Select Account </option>
                    <?php echo $show; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Fetch</button>
        </div>
    </div>
</div>
<div class="table-responsive panel">
    <?php if (!empty($list)) { ?>
        <table class="table table-bordered table-hover ">

            <tr>
                <th>BDM Name</th>
                <th>ASM Name</th>
                <th>Zone</th>
                <th>No Of Beds</th>
                <th>In house   CT Scan facility
                </th>
                <th>In house MRI facility
                </th>
                <th>AIS patients/Month
                </th>
                <th></th>


            </tr>

            <?php
            foreach ($list as $row) :
                ?>
                <tr>  
                    <td><?php echo $row->Full_Name; ?></td>
                    <td><?php echo $row->Reporting_To; ?></td>
                    <td><?php echo $row->Zone; ?></td>
                    <td><?php echo $row->No_Of_Beds; ?></td>
                    <td><?php echo $row->CT_MRI_available; ?></td>
                    <td><?php echo $row->CT_MRI_available; ?></td>
                    <td><?php echo $row->Patient_Seen_month; ?></td>

                </tr>
                <?php
            endforeach;
        }
        else {
            echo 'Data Is Not Available';
        }
        ?>
    </table>
</div>

<div class="col-lg-12">


    <div class="table-responsive panel">
        <?php  ?>
        <table class="table table-bordered table-hover ">

            <thead>
            <tr>
                <th>Month</th>
                <th>2015 Yield</th>
                <th>2016 EOGO Plan</th>
                <th>2016 Yield</th>
                <th>2016 EOGO ach%
                </th>
                <th>Lysis Rate %
                </th>
                <th>+/-over last month

                </th>
               


            </tr>
            </thead>
            <tr>
                <th>JAN</th> 
                <td><?php //  echo $his['past'];   ?>88</td>
                <td><?php // echo $rows['present'];   ?> 88</td>
                <td><?php // echo $rows['present'];   ?> 88</td>
                <td><?php // echo $rows['present'];   ?> 88</td>
                <td><?php // echo $rows['present'];   ?> 88</td>
                <td><?php // echo $rows['present'];   ?> 88</td>

            </tr>
            <tr>
                <th>FEB</th>


            </tr>
            <tr>
                <th>March</th></tr>
            <tr>
                <th>April</th></tr>
            <tr>
                <th>May</th></tr>
            <tr>
                <th>June</th></tr>
            <tr>
                <th>July</th></tr>
            <tr>
                <th>Aug</th></tr>
            <tr>
                <th>Sep</th></tr>
            <tr>
                <th>Oct</th></tr>
            <tr>
                <th>Nov</th></tr>
            <tr>
                <th>Dec</th></tr>
            //<?php
//  foreach ($his as $rows) :
       
            ?>
            <tr>  
                 <th>Total</th>
                <td><?php // echo $rows['past']; ?> 88</td>


            </tr>
            <?php
//            endforeach;
//        }
            ?>
        </table>
    </div>
</div>


