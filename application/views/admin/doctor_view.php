<div class="row">
    <div class="col-lg-12">
        <button class="btn btn-primary">Add Doctor</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>Full_Name</th> 
                <th>Mobile</th>
                <th>City</th> 
                <th>Action</th>
            </tr>
            <tr>
                <?php
                if (!empty($show)) {
                    foreach ($show as $row) :
                        ?><tr>  
                        <td><?php echo $row->Account_Name; ?></td>  

                        <td><?php echo $row->Mobile; ?></td>  
                        <td><?php echo $row->City; ?></td>

                        <td>  
                            <a class="fa fa-trash-o" href ="<?php // echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID;   ?>"></a> 
                            <a class="fa fa-pencil " href="<?php // echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID;   ?>"></a> </td>
                            <?php
                        endforeach;
                    }
                    ?>
            </tr>
        </table>
    </div>
</div>

