
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/emp_add'); ?>';"> Add Employee</a>
</div>
<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
        <table class="table table-bordered table-hover " id="datatable">
            <thead>
                <tr style="background-color: #428BCA">
                    <th>Full Name</th>
                    <th>Territory</th>
                    <th>Mobile</th>
                    <th>Product</th>
                    <th>Zone</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($show)) {
                    foreach ($show as $row) :
                        ?><tr>  
                            <td><?php echo $row->Full_Name; ?></td>  
                            <td><?php echo $row->Territory; ?> </td> 
                            <td><?php echo $row->Mobile; ?></td>  
                            <td><?php echo $row->Product; ?></td>
                            <td><?php echo $row->Zone; ?></td>
                            <td>  
                                <a class="fa fa-trash-o" onclick="window.location = '<?php echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID; ?>';"></a> 
                                <a class="fa fa-pencil " onclick="window.location = '<?php echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID; ?>';"></a> 
                                <a class="fa fa-eye " onclick="window.location = '<?php echo site_url('admin/emp_doc?id=') . $row->Territory; ?>';"></a> </td>   </tr>
                                <?php
                            endforeach;
                        }
                        ?>

            </tbody>

        </table>
    </div>
</div>

<script>


    var oTable = $('#datatable').dataTable({
        "bPaginate": false,
        "bInfo": false,
        "info": false,
        "columnDefs": [
            {
                "visible": false
            }
        ]
    });


</script>
