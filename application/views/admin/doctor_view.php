
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
        <button class="btn btn-primary">Add Doctor</button>
    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>Full_Name</th> 
                    <th>Mobile</th>
                    <th>City</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($show)) {
                    foreach ($show as $row) :
                        ?><tr>  
                            <td><?php echo $row->Account_Name; ?></td>  

                            <td><?php echo $row->Mobile; ?></td>  
                            <td><?php echo $row->City; ?></td>

                            <td>  
                                <a class="fa fa-trash-o" href ="<?php // echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID;      ?>"></a> 
                                <a class="fa fa-pencil " href="<?php // echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID;      ?>"></a> </td></tr>


                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>

        <div class ="row">
            <div class="result">

                <div class="col-lg-12" style="clear: both; margin-bottom: 5px;">
                    <?php
                    echo $html
                    ?>

                </div>
            </div>
        </div>

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

