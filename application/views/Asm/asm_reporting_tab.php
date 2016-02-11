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
                    <td><?php echo $row->CT_MRI_available;
        ;
        ?></td>
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
    



<div class="table-responsive panel">
    <?php if (!empty($list)) { ?>
        <table class="table table-bordered table-hover ">
					

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
                <th></th>


            </tr>
<tr>
   <th>JAN</th> 
    <th>FEB</th>
    <th>March</th>
    <th>April</th>
    <th>May</th>
    <th>June</th>
    <th>July</th>
    <th>Aug</th>
    <th>Sep</th>
    <th>Oct</th>
    <th>Nov</th>
    <th>Dec</th>
            <?php
            
            foreach ($his as $row) :
                ?>
                <tr>  
                    <td><?php echo $row->Full_Name; ?></td>
                    <td><?php echo $row->Reporting_To; ?></td>
                    <td><?php echo $row->Zone; ?></td>
                    <td><?php echo $row->No_Of_Beds; ?></td>
                    <td><?php echo $row->CT_MRI_available; ?></td>
                    <td><?php echo $row->CT_MRI_available;
        ;
        ?></td>
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


