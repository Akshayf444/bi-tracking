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
        <h1 class="page-header"> Activity List </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <a class="btn btn-primary pull-right" onclick="window.location = '<?php echo site_url('admin/add_activity'); ?>';"> Add  Activity</a>
 </div>
  <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
   
                    <tr>
                        <th>Name</th>
                        <th>Division</th>

                        <th>Product</th>

                      
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php 
                       
                        if (!empty($show)) {
                            foreach ($show as $row) :
                                ?><tr>  
                                <td><?php echo $row->Activity_Name; ?></td>  
                                <td><?php echo $row->Division; ?>  
                                <td><?php echo $row->Brand_Name; ?></td>  
                                
                              
                                <td>  
                                    <a class="fa fa-trash-o" onclick="window.location = '<?php  echo site_url('admin/act_del?id=') . $row->Activity_id; ?>';"></a> 
                                    <a class="fa fa-pencil " onclick="window.location = '<?php echo site_url('admin/update_act?id=') . $row->Activity_id; ?>';"></a> </td>
                                    <?php
                                endforeach;
                            }
                            ?>
                    </tr>
                </table>
    </div>
    </div>


