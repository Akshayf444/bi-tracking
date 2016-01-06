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
<ul class="table-view ">
    <li class="table-view-cell table-view-divider"> Doctor List</li>
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php // echo site_url('admin/emp_add'); ?>';"> Add Doctor</a>
    <ul class="table-view-cell">
        <li class="table-view-cell">
            <table class="table table-borderedb">
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
                                <a class="fa fa-trash-o" onclick="window.location = '<?php // echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID; ?>';"></a> 
                                <a class="fa fa-pencil " onclick="window.location = '<?php // echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID; ?>';"></a> </td>
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>
            </table>
        </li>
    </ul>
</div>



