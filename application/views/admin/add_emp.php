  
<div class="row">
    
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <a class="btn btn-primary pull-left" onclick="window.location = '<?php echo site_url('admin/emp_add'); ?>';"> Add Employee</a>
 <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/emp_csv'); ?>';"> Import</a>
    <div class="col-lg-9">
<!--        <button type="button" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#myModal">-->
 <!-- 
</button>-->
    </div>

</div>
</div>
<div class="row">
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
      <tr>
      <tr style="background-color: #428BCA">
                    <th>Full Name</th>
                    <th>Territory</th>

                    <th>Mobile</th>

                    <th>Product</th>
                    <th>Zone</th> 
                    <th>Action</th>
                </tr>
                <tr>
                    <?php
                    if (!empty($show)) {
                        foreach ($show as $row) :
                            ?><tr>  
                            <td><?php echo $row->Full_Name; ?></td>  
                            <td><?php echo $row->Territory; ?>  
                            <td><?php echo $row->Mobile; ?></td>  
                            <td><?php echo $row->Product; ?></td>
                            <td><?php echo $row->Zone; ?></td>
                            <td>  
                                <a class="fa fa-trash-o" onclick="window.location = '<?php echo site_url('admin/emp_del?id=') . $row->VEEVA_Employee_ID; ?>';"></a> 
                                <a class="fa fa-pencil " onclick="window.location = '<?php echo site_url('admin/update_emp?id=') . $row->VEEVA_Employee_ID; ?>';"></a> </td>
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>

       
        </table>
    </div>
</div>
</div>
<!-- Modal -->
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
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

      