
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
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Doctor List </h1>
    </div>
     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php // echo site_url('admin/emp_add'); ?>';"> Add Doctor</a>
     </div>
     <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
                <tr>
                    <th>Full Name</th>
                    

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
                                <a class="fa fa-trash-o" onclick="window.location = '<?php // echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID; ?>';"></a> 
                                <a class="fa fa-pencil " onclick="window.location = '<?php // echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID; ?>';"></a> </td>
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>
            </table>
         </table>
  </div>

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

