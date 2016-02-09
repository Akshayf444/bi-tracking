
<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
    <div class="table-responsive">
    <table class="table table-bordered table-hover ">
      <tr>
      <tr style="background-color: #428BCA">
                    <th>Full Name</th>
                    <th>Target</th>

                    
                </tr>
                <tr>
                    <?php
                    if (!empty($show)) {
                        foreach ($show as $row) :
                            ?><tr>  
                            <td><?php echo $row->Full_Name; ?></td>  
                            
                            <td>  
                                <a class="btn btn-primary" onclick="window.location = '<?php echo site_url('admin/asm_target_by_bdm?id=') . $row->VEEVA_Employee_ID; ?>';">Target</a> 
                               
                                <?php
                            endforeach;
                        }
                        ?>
                </tr>


        </table>
    </div>
</div>