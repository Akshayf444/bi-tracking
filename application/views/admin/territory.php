<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <input type="button"   class="btn btn-primary pull-right" value="Add" data-toggle="modal" data-target="#myModal">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Territory</h4>
      </div>
      <div class="modal-body">
          
         <?php echo form_open('admin/territory_add'); ?>
          
    
         
   Territory:  <input type="text" class="form-control"  name="territory" placeholder="Enter Territory" />
     </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
         </form>
      </div>
    </div>
  </div>
</div>
            
</div>
<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover " id="datatable">
        <thead>
      <tr style="background-color: #428BCA">
          <th> S.NO</th>
                    <th>Territory</th>
                    <th>Action</th>
                   
                </tr>
        </thead>
        <tbody>
                    <?php
                    if (!empty($show)) {
                        foreach ($show as $row) :
                            ?><tr>  
                           <td><?php echo $row->id; ?> 
                            <td><?php echo $row->Territory; ?>  
                            
                            <td>  
                                <a class="fa fa-trash-o" onclick="window.location = '<?php echo site_url('admin/terr_del?id=') . $row->id; ?>';"></a> 
                                <a class="fa fa-pencil " onclick="window.location = '<?php  echo site_url('admin/update_terr?id=') . $row->id; ?>';"></a> </td>
                            
                            </tr>
                            
                            
                            
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
