
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

<a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/doc_csv'); ?>';"> Import</a>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('admin/emp_csv'); ?>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  
                    <div class=" form-group">
                      Choose your file:    <input type="file" class="form-control" name="csv"    >

                    </div>
                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

